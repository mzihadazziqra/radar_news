{{-- File: resources/views/news/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Berita') }}: {{ Str::limit($news->title, 30) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- Lebar konsisten dengan create & halaman lain --}}
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg dark:border dark:border-gray-700">
                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('news.update', $news->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Method untuk update --}}

                        <div class="flex flex-col lg:flex-row lg:gap-x-8">

                            {{-- KOLOM KIRI: Judul, Kategori, Gambar --}}
                            <div class="lg:w-2/5 space-y-6">
                                <div>
                                    <label for="title"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                                    <input type="text" name="title" id="title"
                                        value="{{ old('title', $news->title) }}" {{-- Isi dengan data lama --}} required
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
                                                {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                {{-- Pilih kategori lama --}}
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="image"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ganti
                                        Gambar (Opsional)</label>
                                    <input type="file" name="image" id="image"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="file_input_help">PNG,
                                        JPG, GIF, WEBP (MAX. 2MB). Biarkan kosong jika tidak ingin mengganti gambar.</p>
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                    @if ($news->image_path)
                                        <div class="mt-4">
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Gambar saat ini:
                                            </p>
                                            <img src="{{ asset('storage/' . $news->image_path) }}" alt="Gambar saat ini"
                                                class="w-40 h-auto rounded-md shadow">
                                        </div>
                                    @endif
                                </div>

                                {{-- Tombol submit --}}
                                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700 flex justify-start">
                                    <button type="submit"
                                        class="inline-flex items-center px-6 py-2.5 bg-primary hover:bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-primary-dark transition ease-in-out duration-150">
                                        {{ __('Simpan Perubahan') }}
                                    </button>
                                </div>
                            </div>

                            {{-- KOLOM KANAN: Konten Berita --}}
                            <div class="lg:w-3/5 mt-6 lg:mt-0 flex flex-col">
                                <div class="flex-grow flex flex-col">
                                    <label for="content_editor"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konten
                                        Berita</label>

                                    <input id="content" type="hidden" name="content"
                                        value="{{ old('content', $news->content) }}"> {{-- Isi dengan konten lama --}}

                                    <trix-editor id="content_editor" input="content"
                                        class="block w-full rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                                               focus-within:ring-1 focus-within:ring-primary focus-within:border-primary
                                               dark:focus-within:ring-primary-dark dark:focus-within:border-primary-dark
                                               flex-grow trix-content"></trix-editor>

                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                            </div>
                        </div> {{-- Akhir dari flex dua kolom --}}


                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
