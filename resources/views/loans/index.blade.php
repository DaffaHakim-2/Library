
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Data Peminjaman Buku
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola transaksi peminjaman dan pengembalian buku perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
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

            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">

                {{-- Header dan pencarian --}}
                <div class="p-6 border-b border-gray-100">

                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800">
                                Daftar Peminjaman
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Seluruh transaksi peminjaman buku.
                            </p>
                        </div>

                        <a href="{{ route('loans.create') }}"
                           class="inline-flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm transition">
                            <span class="text-lg">+</span>
                            Tambah Peminjaman
                        </a>

                    </div>

                    {{-- Pencarian --}}
                    <form action="{{ route('loans.index') }}"
                          method="GET"
                          class="flex flex-col sm:flex-row gap-2 mt-5">

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari peminjam atau judul buku..."
                            class="w-full sm:max-w-md border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >

                        <div class="flex gap-2">
                            <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-lg transition">
                                Cari
                            </button>

                            <a href="{{ route('loans.index') }}"
                               class="border border-gray-300 hover:bg-gray-100 text-gray-700 font-medium px-5 py-2.5 rounded-lg transition">
                                Reset
                            </a>
                        </div>

                    </form>
                </div>

                {{-- Tabel peminjaman --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">

                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-5 py-4 text-center">No.</th>
                                <th class="px-5 py-4">Peminjam</th>
                                <th class="px-5 py-4">Judul Buku</th>
                                <th class="px-5 py-4">Tanggal Pinjam</th>
                                <th class="px-5 py-4">Batas Pengembalian</th>
                                <th class="px-5 py-4">Tanggal Dikembalikan</th>
                                <th class="px-5 py-4 text-center">Status</th>
                                <th class="px-5 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($loans as $loan)
                                <tr class="hover:bg-gray-50 transition">

                                    {{-- Nomor --}}
                                    <td class="px-5 py-4 text-center">
                                        {{ $loans->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Peminjam --}}
                                    <td class="px-5 py-4">
                                        <div class="font-semibold text-gray-800">
                                            {{ $loan->user->name ?? '-' }}
                                        </div>
                                    </td>

                                    {{-- Judul buku --}}
                                    <td class="px-5 py-4">
                                        <div class="font-medium text-gray-800">
                                            {{ $loan->book->title ?? '-' }}
                                        </div>
                                    </td>

                                    {{-- Tanggal pinjam --}}
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        {{ $loan->loan_date?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    {{-- Batas pengembalian --}}
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        {{ $loan->return_date?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    {{-- Tanggal dikembalikan --}}
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        {{ $loan->actual_return_date?->format('d-m-Y') ?? '-' }}
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-5 py-4 text-center whitespace-nowrap">

                                        @if ($loan->status === 'dipinjam')
                                            <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-800 px-3 py-1.5 rounded-full text-xs font-semibold">
                                                <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                                                Dipinjam
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 bg-green-100 text-green-800 px-3 py-1.5 rounded-full text-xs font-semibold">
                                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                                Dikembalikan
                                            </span>
                                        @endif

                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-5 py-4">
                                        <div class="flex items-center justify-center gap-2">

                                            {{-- Detail --}}
                                            <a href="{{ route('loans.show', $loan) }}"
                                               title="Detail peminjaman"
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

                                            {{-- Kembalikan --}}
                                            @if ($loan->status === 'dipinjam')
                                                <form action="{{ route('loans.return', $loan) }}"
                                                      method="POST"
                                                      class="form-return-loan">
                                                    @csrf

                                                    <button type="submit"
                                                            title="Kembalikan buku"
                                                            class="inline-flex items-center justify-center bg-green-100 hover:bg-green-200 text-green-700 w-9 h-9 rounded-lg transition">

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

                                                    </button>
                                                </form>
                                            @endif

                                            {{-- Hapus riwayat --}}
                                            @if ($loan->status === 'dikembalikan')
                                                <form action="{{ route('loans.destroy', $loan) }}"
                                                      method="POST"
                                                      class="form-delete-loan">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            title="Hapus riwayat"
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
                                            @endif

                                        </div>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-10 text-center">

                                        <div class="text-gray-400 text-4xl mb-2">
                                            📚
                                        </div>

                                        <p class="font-semibold text-gray-600">
                                            Belum ada transaksi peminjaman.
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Tambahkan transaksi peminjaman untuk mulai mengelola data.
                                        </p>

                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $loans->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
