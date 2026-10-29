
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Peminjaman Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($users->isEmpty())
                    <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                        Belum ada pengguna terdaftar. Tambahkan pengguna terlebih dahulu.
                    </div>
                @endif

                @if ($books->isEmpty())
                    <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                        Tidak ada buku dengan stok tersedia.
                    </div>
                @endif

                <form action="{{ route('loans.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block font-medium mb-2">
                            Peminjam
                        </label>

                        <select id="user_id" name="user_id"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                            <option value="">-- Pilih Peminjam --</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}"
                                    {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} 
                                </option>
                            @endforeach
                        </select>

                        @error('user_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="book_id" class="block font-medium mb-2">
                            Buku
                        </label>

                        <select id="book_id" name="book_id"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                            <option value="">-- Pilih Buku --</option>

                            @foreach ($books as $book)
                                <option value="{{ $book->id }}"
                                    {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                    {{ $book->title }} — Stok: {{ $book->stock }}
                                </option>
                            @endforeach
                        </select>

                        @error('book_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="loan_date" class="block font-medium mb-2">
                            Tanggal Pinjam
                        </label>

                        <input type="date" id="loan_date" name="loan_date"
                               value="{{ old('loan_date', now()->toDateString()) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>

                        @error('loan_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="return_date" class="block font-medium mb-2">
                            Batas Pengembalian
                        </label>

                        <input type="date" id="return_date" name="return_date"
                               value="{{ old('return_date', now()->addDays(7)->toDateString()) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>

                        @error('return_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3 mt-6">
                        <button type="submit"
                                @disabled($users->isEmpty() || $books->isEmpty())
                                class="bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white px-5 py-2 rounded">
                            Simpan Peminjaman
                        </button>

                        <a href="{{ route('loans.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
