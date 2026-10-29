
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Buku
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">

                @if ($categories->isEmpty())
                    <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                        Belum ada kategori. Tambahkan kategori terlebih dahulu.
                    </div>
                @endif

                <form action="{{ route('books.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block font-medium mb-2">Judul Buku</label>
                        <input type="text" id="title" name="title"
                               value="{{ old('title') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="author" class="block font-medium mb-2">Penulis</label>
                        <input type="text" id="author" name="author"
                               value="{{ old('author') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>
                        @error('author')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="block font-medium mb-2">Kategori</label>
                        <select id="category_id" name="category_id"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="publisher" class="block font-medium mb-2">Penerbit</label>
                        <input type="text" id="publisher" name="publisher"
                               value="{{ old('publisher') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2">
                        @error('publisher')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="year" class="block font-medium mb-2">Tahun Terbit</label>
                        <input type="number" id="year" name="year"
                               value="{{ old('year') }}"
                               min="1000" max="9999"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>
                        @error('year')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="isbn" class="block font-medium mb-2">ISBN</label>
                        <input type="text" id="isbn" name="isbn"
                               value="{{ old('isbn') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>
                        @error('isbn')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="stock" class="block font-medium mb-2">Stok Buku</label>
                        <input type="number" id="stock" name="stock"
                               value="{{ old('stock', 0) }}"
                               min="0"
                               class="w-full border border-gray-300 rounded px-3 py-2"
                               required>
                        @error('stock')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium mb-2">Deskripsi</label>
                        <textarea id="description" name="description" rows="4"
                                  class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap gap-3 mt-6">
                        <button type="submit"
                                @disabled($categories->isEmpty())
                                class="bg-green-600 hover:bg-green-700 disabled:opacity-50 text-white px-5 py-2 rounded">
                            Simpan Buku
                        </button>

                        <a href="{{ route('books.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
