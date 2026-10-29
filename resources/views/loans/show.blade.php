
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Detail Peminjaman
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap transaksi peminjaman buku.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header peminjaman --}}
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
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>
                        </div>

                        <div>
                            <p class="text-blue-100 text-sm">
                                Transaksi Peminjaman
                            </p>

                            <h3 class="text-2xl sm:text-3xl font-bold mt-1">
                                {{ $loan->book->title ?? 'Buku tidak ditemukan' }}
                            </h3>

                            <p class="text-blue-100 text-sm mt-1">
                                Peminjam: {{ $loan->user->name ?? '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Status --}}
                    <div>
                        @if ($loan->status === 'dipinjam')
                            <span class="inline-flex items-center gap-2 bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-semibold text-sm">
                                <span class="w-2.5 h-2.5 bg-yellow-500 rounded-full"></span>
                                Dipinjam
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 bg-green-100 text-green-800 px-4 py-2 rounded-full font-semibold text-sm">
                                <span class="w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                                Dikembalikan
                            </span>
                        @endif
                    </div>

                </div>
            </div>

            {{-- Informasi peminjam dan buku --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

                {{-- Data peminjam --}}
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">

                    <div class="flex items-center gap-3 mb-5">
                        <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0H5z" />
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-gray-800">
                            Informasi Peminjam
                        </h3>
                    </div>

                    <div class="space-y-4">

                        <div>
                            <p class="text-sm text-gray-500 mb-1">
                                Nama Peminjam
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $loan->user->name ?? '-' }}
                            </p>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <p class="text-sm text-gray-500 mb-1">
                                Email
                            </p>
                            <p class="font-medium text-gray-800 break-all">
                                {{ $loan->user->email ?? '-' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Data buku --}}
                <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">

                    <div class="flex items-center gap-3 mb-5">
                        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332-.477-4.5 1.253" />
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-gray-800">
                            Informasi Buku
                        </h3>
                    </div>

                    <div class="space-y-4">

                        <div>
                            <p class="text-sm text-gray-500 mb-1">
                                Judul Buku
                            </p>
                            <p class="font-semibold text-gray-800">
                                {{ $loan->book->title ?? '-' }}
                            </p>
                        </div>

                        <div class="border-t border-gray-100 pt-4">
                            <p class="text-sm text-gray-500 mb-1">
                                Penulis
                            </p>
                            <p class="font-medium text-gray-800">
                                {{ $loan->book->author ?? '-' }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Informasi tanggal --}}
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl overflow-hidden mb-6">

                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        Informasi Peminjaman
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Rincian waktu peminjaman dan pengembalian buku.
                    </p>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <div class="bg-blue-50 rounded-xl p-5">
                        <p class="text-sm text-blue-600 font-medium mb-2">
                            Tanggal Pinjam
                        </p>
                        <p class="text-xl font-bold text-gray-800">
                            {{ $loan->loan_date?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div class="bg-yellow-50 rounded-xl p-5">
                        <p class="text-sm text-yellow-700 font-medium mb-2">
                            Batas Pengembalian
                        </p>
                        <p class="text-xl font-bold text-gray-800">
                            {{ $loan->return_date?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                    <div class="bg-green-50 rounded-xl p-5">
                        <p class="text-sm text-green-700 font-medium mb-2">
                            Tanggal Dikembalikan
                        </p>
                        <p class="text-xl font-bold text-gray-800">
                            {{ $loan->actual_return_date?->format('d-m-Y') ?? '-' }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- Status peminjaman --}}
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-6">

                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    Status Transaksi
                </h3>

                @if ($loan->status === 'dipinjam')
                    <div class="flex items-start gap-3 bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                        <div class="text-yellow-600 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-yellow-800">
                                Buku masih dalam peminjaman
                            </p>
                            <p class="text-sm text-yellow-700 mt-1">
                                Buku ini belum tercatat dikembalikan. Silakan lakukan proses pengembalian setelah buku diterima.
                            </p>
                        </div>
                    </div>
                @else
                    <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-xl p-4">
                        <div class="text-green-600 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-6 h-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M9 12l2 2 4-4m5-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-green-800">
                                Buku sudah dikembalikan
                            </p>
                            <p class="text-sm text-green-700 mt-1">
                                Transaksi peminjaman ini telah selesai.
                            </p>
                        </div>
                    </div>
                @endif

                {{-- Tombol aksi --}}
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 mt-6">

                    <a href="{{ route('loans.index') }}"
                       class="inline-flex items-center justify-center gap-2 border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-5 py-2.5 rounded-lg transition">

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

                        Kembali ke Daftar
                    </a>

                    @if ($loan->status === 'dipinjam')
                        <form action="{{ route('loans.return', $loan) }}"
                              method="POST"
                              class="form-return-loan">
                            @csrf

                            <button type="submit"
                                    class="inline-flex w-full sm:w-auto items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M9 12l2 2 4-4m5-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                Kembalikan Buku
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
