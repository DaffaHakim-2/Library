
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Data Kategori Buku
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola kategori buku yang tersedia di perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-green-700">
                    <span class="font-semibold">Berhasil!</span>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-5 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <span class="font-semibold">Gagal!</span>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">

                {{-- Header tabel --}}
                <div class="p-6 border-b border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Daftar Kategori
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Daftar seluruh kategori buku perpustakaan.
                            </p>
                        </div>

                        <a href="{{ route('categories.create') }}"
                           class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm transition">
                            <span class="text-lg">+</span>
                            Tambah Kategori
                        </a>
                    </div>

                    {{-- Pencarian --}}
                    <form action="{{ route('categories.index') }}"
                          method="GET"
                          class="flex flex-col sm:flex-row gap-2 mt-5">

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari nama kategori..."
                            class="w-full sm:max-w-md border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >

                        <div class="flex gap-2">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg transition">
                                Cari
                            </button>

                            <a href="{{ route('categories.index') }}"
                               class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-medium px-5 py-2.5 rounded-lg transition">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Tabel kategori --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 text-center">No.</th>
                                <th class="px-6 py-4">Nama Kategori</th>
                                <th class="px-6 py-4 text-center">Jumlah Buku</th>
                                <th class="px-6 py-4">Deskripsi</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($categories as $category)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 text-center">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-gray-800">
                                            {{ $category->name }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center min-w-9 px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                            {{ $category->books_count }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 max-w-xs">
                                        {{ $category->description ?: '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">

                                            {{-- Detail --}}
                                            <a href="{{ route('categories.show', $category) }}"
                                               title="Detail kategori"
                                               class="inline-flex items-center justify-center bg-blue-100 hover:bg-blue-200 text-blue-700 w-9 h-9 rounded-lg transition">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-5 h-5"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('categories.edit', $category) }}"
                                               title="Edit kategori"
                                               class="inline-flex items-center justify-center bg-yellow-100 hover:bg-yellow-200 text-yellow-700 w-9 h-9 rounded-lg transition">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     class="w-5 h-5"
                                                     fill="none"
                                                     viewBox="0 0 24 24"
                                                     stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                </svg>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('categories.destroy', $category) }}"
                                                  method="POST"
                                                  class="form-delete-category">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        title="Hapus kategori"
                                                        class="inline-flex items-center justify-center bg-red-100 hover:bg-red-200 text-red-700 w-9 h-9 rounded-lg transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                         class="w-5 h-5"
                                                         fill="none"
                                                         viewBox="0 0 24 24"
                                                         stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="text-gray-400 text-4xl mb-2">
                                            📂
                                        </div>
                                        <p class="font-semibold text-gray-600">
                                            Belum ada data kategori.
                                        </p>
                                        <p class="text-sm text-gray-400 mt-1">
                                            Silakan tambahkan kategori baru.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $categories->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
