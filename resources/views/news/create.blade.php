{{-- File: resources/views/news/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tambah Berita Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        {{-- Kontainer kartu dibuat lebih lebar, misal max-w-5xl --}}
        <div class="max-w-7xl px-4 mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg dark:border dark:border-gray-700">
                <div class="p-6 md:p-8">
                    {{-- >>> AWAL KODE PESAN SUKSES <<< --}}
                    @if (session('success'))
                        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm dark:bg-green-800 dark:text-green-200 dark:border-green-600"
                            role="alert">
                            <div class="flex">
                                <div class="py-1">
                                    {{-- Ikon Centang (opsional) --}}
                                    <svg class="fill-current h-6 w-6 text-green-500 dark:text-green-400 mr-4"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM6.7 9.29L9 11.6l4.3-4.3 1.4 1.42L9 14.4l-3.7-3.7 1.4-1.42z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold">Sukses!</p>
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- >>> AKHIR DARI KODE PESAN SUKSES <<< --}}
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- Kontainer untuk dua kolom --}}
                        <div class="flex flex-col lg:flex-row lg:gap-x-8">

                            {{-- KOLOM KIRI: Judul, Kategori, Gambar --}}
                            <div class="lg:w-2/5 space-y-6">
                                <div> {{-- Tambahkan div pembungkus untuk setiap field group --}}
                                    <label for="title"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        required
                                        class="block w-full text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400
                                                  focus:ring-primary focus:border-primary
                                                  dark:focus:ring-primary-dark dark:focus:border-primary-dark">
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="category_id"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                                    <select name="category_id" id="category_id" required
                                        class="block w-full text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400
                                                   focus:ring-primary focus:border-primary
                                                   dark:focus:ring-primary-dark dark:focus:border-primary-dark">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="image"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gambar
                                        (Opsional)</label>
                                    <input type="file" name="image" id="image"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="file_input_help">PNG,
                                        JPG, GIF, WEBP (MAX. 2MB).</p>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>


                                {{-- Tombol Simpan --}}
                                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-start">
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-2.5 bg-primary hover:bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-primary-dark transition ease-in-out duration-150">
                                        {{ __('Simpan Berita') }}
                                    </button>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: Konten Berita --}}
                            <div class="lg:w-3/5 mt-6 lg:mt-0 flex flex-col">
                                <div class="flex-grow flex flex-col">
                                    <label for="content_editor" {{-- Label sekarang untuk trix-editor --}}
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konten
                                        Berita</label>
                                    <input id="content" type="hidden" name="content" value="{{ old('content') }}">

                                    {{-- Trix Editor --}}
                                    <trix-editor id="content_editor" input="content"
                                        class="block w-full rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus-within:ring-1 focus-within:ring-primary focus-within:border-primary dark:focus-within:ring-primary-dark dark:focus-within:border-primary-darkflex-grow trix-content">
                                    </trix-editor>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
