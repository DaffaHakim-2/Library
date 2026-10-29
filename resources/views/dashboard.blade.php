
<x-app-layout>

    <div class="space-y-6">

        {{-- Judul Dashboard --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Dashboard Perpustakaan
            </h1>
            <p class="mt-1 text-sm text-gray-500">
                Ringkasan informasi dan aktivitas perpustakaan.
            </p>
        </div>

        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

            {{-- Total Buku --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-blue-500">
                <p class="text-sm text-gray-500">Judul Buku</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ number_format($totalBooks) }}
                </p>
                <a href="{{ route('books.index') }}"
                   class="inline-block mt-4 text-sm text-blue-600 hover:underline">
                    Lihat daftar buku →
                </a>
            </div>

            {{-- Total Stok --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-indigo-500">
                <p class="text-sm text-gray-500">Total Stok Buku</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ number_format($totalStock) }}
                </p>
                <p class="text-sm text-gray-400 mt-4">
                    Jumlah seluruh eksemplar
                </p>
            </div>

            {{-- Total Kategori --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
                <p class="text-sm text-gray-500">Kategori Buku</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ number_format($totalCategories) }}
                </p>
                <a href="{{ route('categories.index') }}"
                   class="inline-block mt-4 text-sm text-purple-600 hover:underline">
                    Lihat kategori →
                </a>
            </div>

            {{-- Total Pengguna --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
                <p class="text-sm text-gray-500">Pengguna Terdaftar</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ number_format($totalUsers) }}
                </p>
                <p class="text-sm text-gray-400 mt-4">
                    Seluruh akun pengguna
                </p>
            </div>

            {{-- Peminjaman Aktif --}}
            <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-orange-500">
                <p class="text-sm text-gray-500">Peminjaman Aktif</p>
                <p class="text-3xl font-bold text-gray-800 mt-2">
                    {{ number_format($activeLoans) }}
                </p>
                <a href="{{ route('loans.index') }}"
                   class="inline-block mt-4 text-sm text-orange-600 hover:underline">
                    Lihat peminjaman →
                </a>
            </div>

        </div>

        {{-- Peminjaman Terbaru --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-gray-200 flex flex-wrap items-center justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        Peminjaman Terbaru
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Lima transaksi terakhir yang tercatat.
                    </p>
                </div>

                <a href="{{ route('loans.index') }}"
                   class="text-sm text-blue-600 hover:underline">
                    Lihat semua →
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Peminjam
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Judul Buku
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Tanggal Pinjam
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                                Status
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-100">

                        @forelse ($latestLoans as $loan)
                            <tr class="hover:bg-gray-50">

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $loan->user->name ?? 'Pengguna tidak ditemukan' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $loan->book->title ?? 'Buku tidak ditemukan' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $loan->loan_date
                                        ? \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($loan->status === 'dipinjam')
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-10 text-center text-sm text-gray-500">
                                    Belum ada transaksi peminjaman.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-app-layout>
