
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5
                             c4.478 0 8.268 2.943 9.542 7
                             -1.274 4.057-5.064 7-9.542 7
                             -4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>

            <div>
                <h2 class="font-bold text-xl text-gray-800">
                    Detail Buku
                </h2>
                <p class="text-sm text-gray-500">
                    Informasi lengkap mengenai koleksi buku perpustakaan.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- KARTU UTAMA --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- HEADER BUKU --}}
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 sm:p-8">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">

                        <div class="bg-white/20 rounded-2xl p-5">
                            <svg class="w-12 h-12 text-white"
                                 fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M12 7v14m0-14C10.832 5.778
                                         9.246 5 7.5 5 5.836 5
                                         4.5 5.672 4.5 6.5v12
                                         c0-.828 1.336-1.5 3-1.5
                                         1.746 0 3.332.778 4.5 2
                                         m0-12c1.168-1.222
                                         2.754-2 4.5-2 1.664 0
                                         3 .672 3 1.5v12
                                         c0-.828-1.336-1.5-3-1.5
                                         -1.746 0-3.332.778-4.5 2"/>
                            </svg>
                        </div>

                        <div class="text-white">
                            <p class="text-blue-100 text-sm mb-1">
                                Informasi Koleksi Buku
                            </p>

                            <h3 class="text-2xl sm:text-3xl font-bold">
                                {{ $book->title }}
                            </h3>

                            <p class="text-blue-100 mt-2">
                                Oleh {{ $book->author }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- RINGKASAN --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-6 border-b border-gray-100">

                    <div class="bg-blue-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">Kategori</p>
                        <p class="font-bold text-blue-700">
                            {{ $book->category->name ?? '-' }}
                        </p>
                    </div>

                    <div class="bg-green-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">Stok Buku</p>
                        <p class="font-bold text-green-700 text-xl">
                            {{ $book->stock }}
                            <span class="text-sm font-normal">buku</span>
                        </p>
                    </div>

                    <div class="bg-purple-50 rounded-xl p-4">
                        <p class="text-sm text-gray-500 mb-1">Tahun Terbit</p>
                        <p class="font-bold text-purple-700 text-xl">
                            {{ $book->year }}
                        </p>
                    </div>

                </div>

                {{-- DETAIL INFORMASI --}}
                <div class="p-6 sm:p-8">

                    <h4 class="text-lg font-bold text-gray-800 mb-5">
                        Informasi Lengkap
                    </h4>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div class="border border-gray-100 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                Judul Buku
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $book->title }}
                            </p>
                        </div>

                        <div class="border border-gray-100 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                Penulis
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $book->author }}
                            </p>
                        </div>

                        <div class="border border-gray-100 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                Penerbit
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $book->publisher ?: '-' }}
                            </p>
                        </div>

                        <div class="border border-gray-100 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                ISBN
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $book->isbn }}
                            </p>
                        </div>

                        <div class="border border-gray-100 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                Ketersediaan
                            </p>

                            @if ($book->stock > 0)
                                <span class="inline-flex items-center px-3 py-1
                                             rounded-full text-sm font-semibold
                                             bg-green-100 text-green-700">
                                    Tersedia
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1
                                             rounded-full text-sm font-semibold
                                             bg-red-100 text-red-700">
                                    Stok Habis
                                </span>
                            @endif
                        </div>

                        <div class="border border-gray-100 rounded-xl p-4">
                            <p class="text-sm text-gray-500 mb-2">
                                Jumlah Stok
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $book->stock }} buku
                            </p>
                        </div>

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mt-6">
                        <h4 class="text-lg font-bold text-gray-800 mb-3">
                            Deskripsi Buku
                        </h4>

                        <div class="bg-gray-50 border border-gray-100
                                    rounded-xl p-5 text-gray-700
                                    leading-relaxed whitespace-pre-line">
                            {{ $book->description ?: 'Belum ada deskripsi untuk buku ini.' }}
                        </div>
                    </div>

                </div>

                {{-- FOOTER TOMBOL --}}
                <div class="bg-gray-50 border-t border-gray-100 px-6 py-5
                            flex flex-wrap justify-end gap-3">

                    <a href="{{ route('books.index') }}"
                       class="inline-flex items-center gap-2 px-5 py-3
                              rounded-xl border border-gray-300
                              text-gray-700 font-semibold
                              hover:bg-gray-100 transition">

                        <svg class="w-5 h-5" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>

                        Kembali
                    </a>

                    <a href="{{ route('books.edit', $book) }}"
                       class="inline-flex items-center gap-2 px-5 py-3
                              rounded-xl bg-amber-500 text-white
                              font-semibold hover:bg-amber-600
                              shadow-sm transition">

                        <svg class="w-5 h-5" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11
                                     a2 2 0 002 2h11a2 2 0 002-2v-5
                                     M18.5 2.5a2.121 2.121 0 013 3
                                     L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>

                        Edit Buku
                    </a>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
