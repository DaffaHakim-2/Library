
<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                Edit Kategori
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Perbarui informasi kategori buku perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Informasi kategori --}}
            <div class="mb-6 bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-3">
                <div class="bg-blue-100 text-blue-600 rounded-lg p-2">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                </div>

                <div>
                    <h3 class="font-semibold text-blue-800">
                        Edit Informasi Kategori
                    </h3>
                    <p class="text-sm text-blue-700 mt-1">
                        Silakan ubah nama kategori atau deskripsi sesuai kebutuhan.
                    </p>
                </div>
            </div>

            {{-- Form edit --}}
            <div class="bg-white shadow-sm rounded-2xl border border-gray-100 overflow-hidden">

                <div class="px-6 py-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">
                        Form Edit Kategori
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Lengkapi informasi kategori di bawah ini.
                    </p>
                </div>

                <form action="{{ route('categories.update', $category) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="p-6 space-y-6">

                        {{-- Error validasi --}}
                        @if ($errors->any())
                            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                                <p class="font-semibold mb-2">
                                    Terdapat kesalahan pada input:
                                </p>

                                <ul class="list-disc pl-5 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Nama kategori --}}
                        <div>
                            <label for="name"
                                   class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Kategori
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $category->name) }}"
                                required
                                maxlength="255"
                                placeholder="Contoh: Pemrograman"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('name') border-red-500 @enderror"
                            >

                            @error('name')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="text-xs text-gray-400 mt-2">
                                Masukkan nama kategori buku.
                            </p>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label for="description"
                                   class="block text-sm font-semibold text-gray-700 mb-2">
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                placeholder="Tuliskan deskripsi kategori..."
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('description') border-red-500 @enderror"
                            >{{ old('description', $category->description) }}</textarea>

                            @error('description')
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                            <p class="text-xs text-gray-400 mt-2">
                                Deskripsi bersifat opsional.
                            </p>
                        </div>

                    </div>

                    {{-- Tombol --}}
                    <div class="px-6 py-5 bg-gray-50 border-t border-gray-100 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">

                        <a href="{{ route('categories.index') }}"
                           class="inline-flex items-center justify-center border border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold px-5 py-2.5 rounded-lg transition">
                            Batal
                        </a>

                        <button type="submit"
                                class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow-sm transition">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>

                    </div>
                </form>
            </div>

            <p class="text-xs text-gray-400 text-center mt-5">
                Pastikan informasi kategori sudah benar sebelum menyimpan perubahan.
            </p>

        </div>
    </div>
</x-app-layout>
