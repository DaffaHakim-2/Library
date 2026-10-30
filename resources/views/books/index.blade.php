<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm rounded-lg">

                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                    <form action="{{ route('books.index') }}" method="GET"
                          class="flex flex-wrap items-center gap-2">

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari judul, penulis, atau ISBN..."
                            class="border border-gray-300 rounded px-3 py-2"
                        >

                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                            Cari
                        </button>

                        <a href="{{ route('books.index') }}"
                           class="border border-gray-300 hover:bg-gray-100 px-4 py-2 rounded">
                            Reset
                        </a>
                    </form>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('books.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                            + Tambah Buku
                        </a>
                    @endif
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border p-3">No.</th>
                                <th class="border p-3">Judul</th>
                                <th class="border p-3">Penulis</th>
                                <th class="border p-3">Kategori</th>
                                <th class="border p-3">Tahun</th>
                                <th class="border p-3">ISBN</th>
                                <th class="border p-3">Stok</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($books as $book)
                                <tr>
                                    <td class="border p-3 text-center">
                                        {{ $books->firstItem() + $loop->index }}
                                    </td>

                                    <td class="border p-3">{{ $book->title }}</td>
                                    <td class="border p-3">{{ $book->author }}</td>
                                    <td class="border p-3">
                                        {{ $book->category->name ?? '-' }}
                                    </td>
                                    <td class="border p-3 text-center">{{ $book->year }}</td>
                                    <td class="border p-3">{{ $book->isbn }}</td>
                                    <td class="border p-3 text-center">{{ $book->stock }}</td>

 <td class="border p-3">
    <div class="flex flex-wrap items-center gap-2">

        {{-- Tombol Detail --}}
        <a href="{{ route('books.show', $book) }}"
           class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-3 py-2
                  text-sm font-medium text-white transition hover:bg-blue-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5
                         c4.478 0 8.268 2.943 9.542 7
                         -1.274 4.057-5.064 7-9.542 7
                         -4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            Detail
        </a>

        {{-- Tombol Edit --}}
        <a href="{{ route('books.edit', $book) }}"
           class="inline-flex items-center gap-1 rounded-lg bg-amber-500 px-3 py-2
                  text-sm font-medium text-white transition hover:bg-amber-600">
            <svg class="h-4 w-4" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11
                         a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4
                         9.5-9.5z" />
            </svg>
            Edit
        </a>

        {{-- Form Hapus --}}
        <form action="{{ route('books.destroy', $book) }}"
              method="POST"
              class="form-delete-book">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="inline-flex items-center gap-1 rounded-lg bg-red-600 px-3 py-2
                           text-sm font-medium text-white transition hover:bg-red-700">
                <svg class="h-4 w-4" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                             a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                             M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3
                             M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>

                </div>
            </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="border p-4 text-center">
                                        Belum ada data buku.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
