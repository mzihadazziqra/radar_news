{{-- File: resources/views/news/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Berita: ') }} {{ $news->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- MODIFIKASI ACTION FORMULIR DAN TAMBAHKAN @method('PUT') --}}
                    <form method="POST" action="{{ route('news.update', $news->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Penting untuk memberitahu Laravel bahwa ini adalah request PUT/PATCH --}}

                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                            {{-- MODIFIKASI VALUE UNTUK MENAMPILKAN DATA LAMA --}}
                            <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('title')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kategori</label>
                            <select name="category_id" id="category_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    {{-- MODIFIKASI UNTUK MEMILIH KATEGORI YANG SESUAI DENGAN DATA LAMA --}}
                                    <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konten</label>
                            {{-- MODIFIKASI UNTUK MENAMPILKAN DATA LAMA DI TEXTAREA --}}
                            <textarea name="content" id="content" rows="5" required
                                      class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image" id="image"
                                   class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            @error('image')
                                <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                            @enderror
                            {{-- Menampilkan gambar saat ini jika ada --}}
                            @if ($news->image_path)
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Gambar saat ini:</p>
                                    <img src="{{ asset('storage/' . $news->image_path) }}" alt="Gambar saat ini" class="mt-2 w-48 h-auto rounded">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            {{-- MODIFIKASI TEKS TOMBOL --}}
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Simpan Perubahan') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
