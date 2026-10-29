<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku dan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $books = Book::with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('books.index', compact('books', 'search'));
    }

    /**
     * Menampilkan formulir tambah buku.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('books.create', compact('categories'));
    }

    /**
     * Menyimpan buku baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'publisher'   => ['nullable', 'string', 'max:255'],
            'year'        => ['required', 'integer', 'digits:4'],
            'isbn'        => ['required', 'string', 'max:255', 'unique:books,isbn'],
            'stock'       => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail buku.
     */
    public function show(Book $book)
    {
        $book->load('category');

        return view('books.show', compact('book'));
    }

    /**
     * Menampilkan formulir edit buku.
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();

        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Memperbarui data buku.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'author'      => ['required', 'string', 'max:255'],
            'publisher'   => ['nullable', 'string', 'max:255'],
            'year'        => ['required', 'integer', 'digits:4'],
            'isbn'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('books', 'isbn')->ignore($book->id),
            ],
            'stock'       => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    /**
     * Menghapus buku jika belum memiliki riwayat peminjaman.
     */
    public function destroy(Book $book)
    {
        if ($book->loans()->exists()) {
            return redirect()
                ->route('books.index')
                ->with('error', 'Buku tidak dapat dihapus karena memiliki riwayat peminjaman.');
        }

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
