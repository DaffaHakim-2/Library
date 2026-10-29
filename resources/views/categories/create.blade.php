<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kategori
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">

                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block mb-2">
                            Nama Kategori
                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               maxlength="255"
                               class="w-full border rounded px-3 py-2">

                        @error('name')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block mb-2">
                            Deskripsi
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded">
                        Simpan
                    </button>

                    <a href="{{ route('categories.index') }}"
                       class="ml-2 border px-4 py-2 rounded">
                        Kembali
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>