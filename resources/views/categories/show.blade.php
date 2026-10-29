
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Detail Kategori
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap kategori dan daftar buku di dalamnya.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header kategori --}}
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-6 sm:p-8 text-white shadow-sm mb-6">

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-5">

                    <div class="flex items-center gap-4">
                        <div class="bg-white/20 rounded-xl p-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-10 h-10"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M4 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-blue-100 text-sm">
                                Kategori Buku
                            </p>
                            <h3 class="text-2xl sm:text-3xl font-bold mt-1">
                                {{ $category->name }}
                            </h3>
                        </div>
                    </div>

                    <a href="{{ route('categories.edit', $category) }}"
                       class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 hover:bg-blue-50 font-semibold px-5 py-2.5 rounded-lg transition">
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
                        Edit Kategori
                    </a>

                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">

                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-blue-100 text-blue-600 rounded-xl p-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-7 h-7"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Jumlah Buku
                            </p>
                            <h4 class="text-2xl font-bold text-gray-800">
                                {{ $category->books->count() }}
                                <span class="text-sm font-normal text-gray-500">Buku</span>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">
                    <div class="flex items-center gap-4">
                        <div class="bg-indigo-100 text-indigo-600 rounded-xl p-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-7 h-7"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14H4V6a1 1 0 011-1z" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Status Kategori
                            </p>
                            <h4 class="text-lg font-bold text-gray-800">
                                Aktif
                            </h4>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Deskripsi --}}
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6 mb-6">

                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    Deskripsi Kategori
                </h3>

                <p class="text-gray-600 leading-relaxed">
                    {{ $category->description ?: 'Belum ada deskripsi untuk kategori ini.' }}
                </p>

            </div>

            {{-- Daftar buku --}}
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden">

                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        Daftar Buku dalam Kategori
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Buku-buku yang terdaftar pada kategori {{ $category->name }}.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">

                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-4 text-center">No.</th>
                                <th class="px-6 py-4">Judul Buku</th>
                                <th class="px-6 py-4">Penulis</th>
                                <th class="px-6 py-4 text-center">Stok</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($category->books as $book)
                                <tr class="hover:bg-gray-50 transition">

                                    <td class="px-6 py-4 text-center">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-gray-800">
                                            {{ $book->title }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $book->author }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center justify-center min-w-9 px-3 py-1 rounded-full
                                            {{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $book->stock }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('books.show', $book) }}"
                                           title="Detail buku"
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
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268-2.943 9.542 0c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                                            </svg>

                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="text-gray-400 text-4xl mb-2">
                                            📚
                                        </div>

                                        <p class="font-semibold text-gray-600">
                                            Belum ada buku dalam kategori ini.
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Tambahkan buku dan pilih kategori ini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

            {{-- Tombol kembali --}}
            <div class="flex justify-end mt-6">
                <a href="{{ route('categories.index') }}"
                   class="inline-flex items-center gap-2 border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-5 py-2.5 rounded-lg transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7" />
                    </svg>

                    Kembali ke Kategori
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
