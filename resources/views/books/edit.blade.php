
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="bg-amber-100 text-amber-600 p-3 rounded-xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11
                             a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-xl text-gray-800">
                    Edit Buku
                </h2>
                <p class="text-sm text-gray-500">
                    Perbarui informasi dan data buku perpustakaan.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- INFORMASI HALAMAN --}}
            <div class="mb-6 bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0
                             11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-semibold text-blue-800">Informasi</p>
                    <p class="text-sm text-blue-700">
                        Silakan periksa kembali data buku sebelum menyimpan perubahan.
                    </p>
                </div>
            </div>

            {{-- FORM EDIT --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        Formulir Edit Buku
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Data buku: {{ $book->title }}
                    </p>
                </div>

                <form action="{{ route('books.update', $book) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="p-6">

                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                                <p class="font-semibold text-red-700 mb-2">
                                    Terdapat kesalahan pada formulir:
                                </p>
                                <ul class="list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- INFORMASI UTAMA --}}
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 mb-4">
                                Informasi Utama
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div class="md:col-span-2">
                                    <label for="title"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        Judul Buku <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="title" name="title"
                                           value="{{ old('title', $book->title) }}"
                                           placeholder="Masukkan judul buku"
                                           class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                  outline-none transition"
                                           required>
                                    @error('title')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="author"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        Penulis <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="author" name="author"
                                           value="{{ old('author', $book->author) }}"
                                           placeholder="Nama penulis"
                                           class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                  outline-none transition"
                                           required>
                                    @error('author')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="category_id"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <select id="category_id" name="category_id"
                                            class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                   focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                   outline-none transition"
                                            required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="publisher"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        Penerbit
                                    </label>
                                    <input type="text" id="publisher" name="publisher"
                                           value="{{ old('publisher', $book->publisher) }}"
                                           placeholder="Nama penerbit"
                                           class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                  outline-none transition">
                                    @error('publisher')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="year"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tahun Terbit <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="year" name="year"
                                           value="{{ old('year', $book->year) }}"
                                           min="1000" max="9999"
                                           placeholder="Contoh: 2026"
                                           class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                  outline-none transition"
                                           required>
                                    @error('year')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="isbn"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        ISBN <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="isbn" name="isbn"
                                           value="{{ old('isbn', $book->isbn) }}"
                                           placeholder="Nomor ISBN"
                                           class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                  outline-none transition"
                                           required>
                                    @error('isbn')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="stock"
                                           class="block text-sm font-semibold text-gray-700 mb-2">
                                        Stok Buku <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="stock" name="stock"
                                           value="{{ old('stock', $book->stock) }}"
                                           min="0"
                                           placeholder="Jumlah stok"
                                           class="w-full rounded-xl border border-gray-300 px-4 py-3
                                                  focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                                  outline-none transition"
                                           required>
                                    @error('stock')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- DESKRIPSI --}}
                        <div class="border-t border-gray-100 pt-6">
                            <label for="description"
                                   class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi Buku
                            </label>
                            <textarea id="description" name="description" rows="5"
                                      placeholder="Tuliskan deskripsi buku..."
                                      class="w-full rounded-xl border border-gray-300 px-4 py-3
                                             focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                             outline-none transition">{{ old('description', $book->description) }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- TOMBOL --}}
                    <div class="bg-gray-50 border-t border-gray-100 px-6 py-5
                                flex flex-wrap justify-end gap-3">

                        <a href="{{ route('books.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl
                                  border border-gray-300 text-gray-700 font-semibold
                                  hover:bg-gray-100 transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-3 rounded-xl
                                       bg-blue-600 text-white font-semibold
                                       hover:bg-blue-700 shadow-sm transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
