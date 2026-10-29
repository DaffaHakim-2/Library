<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoanController extends Controller
{
    /**
     * Daftar peminjaman:
     * Admin melihat semua transaksi.
     * Anggota hanya melihat transaksinya sendiri.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $search = $request->input('search');

        $loans = Loan::with(['user', 'book'])
            ->when($user->role !== 'admin', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('book', function ($bookQuery) use ($search) {
                        $bookQuery->where('title', 'like', "%{$search}%");
                    });

                    if (auth()->user()->role === 'admin') {
                        $q->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                    }
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('loans.index', compact('loans', 'search'));
    }

    /**
     * Formulir peminjaman.
     */
    public function create()
    {
        $user = auth()->user();

        // Anggota hanya boleh mengajukan peminjaman untuk dirinya.
        $users = $user->role === 'admin'
            ? User::orderBy('name')->get()
            : collect([$user]);

        $books = Book::where('stock', '>', 0)
            ->orderBy('title')
            ->get();

        return view('loans.create', compact('users', 'books'));
    }

    /**
     * Simpan peminjaman dan kurangi stok.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'book_id' => ['required', 'integer', 'exists:books,id'],
            'loan_date' => ['required', 'date'],
            'return_date' => [
                'required',
                'date',
                'after_or_equal:loan_date',
            ],
        ];

        // Hanya admin yang boleh memilih peminjam.
        if ($user->role === 'admin') {
            $rules['user_id'] = [
                'required',
                'integer',
                'exists:users,id',
            ];
        }

        $validated = $request->validate($rules);

        // Abaikan user_id dari request anggota.
        $borrowerId = $user->role === 'admin'
            ? $validated['user_id']
            : $user->id;

        DB::transaction(function () use ($validated, $borrowerId) {
            $book = Book::whereKey($validated['book_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($book->stock < 1) {
                throw ValidationException::withMessages([
                    'book_id' => 'Stok buku habis. Silakan pilih buku lain.',
                ]);
            }

            Loan::create([
                'user_id' => $borrowerId,
                'book_id' => $book->id,
                'loan_date' => $validated['loan_date'],
                'return_date' => $validated['return_date'],
                'status' => 'dipinjam',
            ]);

            $book->decrement('stock');
        });

        return redirect()
            ->route('loans.index')
            ->with('success', 'Peminjaman berhasil dicatat dan stok buku diperbarui.');
    }

    /**
     * Detail transaksi hanya dapat dilihat oleh admin
     * atau pemilik transaksi.
     */
    public function show(Loan $loan)
    {
        $user = auth()->user();

        abort_unless(
            $user->role === 'admin' || (int) $loan->user_id === (int) $user->id,
            403,
            'Kamu tidak memiliki izin melihat transaksi ini.'
        );

        $loan->load(['user', 'book']);

        return view('loans.show', compact('loan'));
    }

    /**
     * Edit transaksi hanya untuk admin.
     * Route-nya juga harus dilindungi middleware admin.
     */
    public function edit(Loan $loan)
    {
        return redirect()
            ->route('loans.show', $loan)
            ->with('error', 'Transaksi tidak dapat diedit. Gunakan proses pengembalian.');
    }

    /**
     * Update transaksi tidak diizinkan.
     */
    public function update(Request $request, Loan $loan)
    {
        return redirect()
            ->route('loans.show', $loan)
            ->with('error', 'Transaksi tidak dapat diperbarui melalui formulir edit.');
    }

    /**
     * Pengembalian buku hanya untuk admin.
     */
    public function returnBook(Loan $loan)
    {
        abort_unless(
            auth()->user()->role === 'admin',
            403,
            'Hanya admin yang dapat memproses pengembalian.'
        );

        DB::transaction(function () use ($loan) {
            $lockedLoan = Loan::whereKey($loan->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedLoan->status === 'dikembalikan') {
                throw ValidationException::withMessages([
                    'loan' => 'Buku ini sudah tercatat dikembalikan.',
                ]);
            }

            $book = Book::whereKey($lockedLoan->book_id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedLoan->update([
                'status' => 'dikembalikan',
                'actual_return_date' => now()->toDateString(),
            ]);

            $book->increment('stock');
        });

        return redirect()
            ->route('loans.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok diperbarui.');
    }

    /**
     * Hapus riwayat hanya jika buku sudah dikembalikan.
     */
    public function destroy(Loan $loan)
    {
        abort_unless(
            auth()->user()->role === 'admin',
            403,
            'Hanya admin yang dapat menghapus transaksi.'
        );

        if ($loan->status !== 'dikembalikan') {
            return redirect()
                ->route('loans.index')
                ->with('error', 'Peminjaman aktif tidak dapat dihapus. Proses pengembalian terlebih dahulu.');
        }

        $loan->delete();

        return redirect()
            ->route('loans.index')
            ->with('success', 'Riwayat peminjaman berhasil dihapus.');
    }
}
