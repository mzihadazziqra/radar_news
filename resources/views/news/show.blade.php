{{-- File: resources/views/news/show.blade.php --}}
<x-app-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- max-w-4xl agar konten artikel tidak terlalu lebar --}}

            {{-- Pesan Sukses (jika ada, misal setelah update) --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md shadow-sm dark:bg-green-800 dark:text-green-200 dark:border-green-600"
                    role="alert">
                    <div class="flex">
                        <div class="py-1">
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

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg dark:border dark:border-gray-700">
                <article class="p-6 md:p-8 text-gray-900 dark:text-gray-100">

                    {{-- 1. JUDUL BERITA UTAMA --}}
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                        {{ $news->title }}
                    </h1>

                    {{-- 2. INFORMASI META (Kategori, Penulis, Tanggal) --}}
                    <div
                        class="mb-6 pb-4 border-b border-gray-200 dark:border-gray-700 text-sm text-gray-600 dark:text-gray-400">
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                            @if ($news->category)
                                <span class="font-medium">Kategori:
                                    <a href="#"
                                        class="text-primary hover:underline">{{ $news->category->name }}</a>
                                    {{-- Nanti kita bisa buat link ke halaman kategori --}}
                                </span>
                            @endif
                            <span>Oleh: <span class="font-medium">{{ $news->user->name ?? 'Tim Redaksi' }}</span></span>
                            <span>Dipublikasikan: <span
                                    class="font-medium">{{ $news->published_at ? $news->published_at->translatedFormat('d F Y, H:i') : 'Tanggal tidak tersedia' }}</span></span>
                        </div>
                    </div>

                    {{-- 3. GAMBAR UTAMA BERITA (jika ada) --}}
                    @if ($news->image_path)
                        <figure class="my-6 md:my-8">
                            <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}"
                                class="w-full h-auto max-h-[500px] object-contain rounded-lg mx-auto">
                            {{-- object-contain agar gambar tidak terpotong, atau object-cover jika ingin memenuhi area --}}
                            {{-- max-h-[500px] untuk membatasi tinggi gambar jika terlalu besar --}}
                        </figure>
                    @endif

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700"></div>


                    {{-- 4. KONTEN BERITA --}}
                    {{-- Menggunakan kelas 'prose' dari Tailwind Typography untuk styling teks yang baik --}}
                    {{-- dan 'trix-content' jika konten dibuat dengan Trix Editor --}}
                    <div class="prose prose-lg dark:prose-invert max-w-none trix-content leading-relaxed">
                        {!! $news->content !!} {{-- Menampilkan konten HTML dari Trix Editor --}}
                    </div>

                    {{-- Tombol Aksi (Edit/Hapus) dan Kembali --}}
                    <div
                        class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('news.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                            &larr; Kembali ke Daftar Berita
                        </a>
                        @auth
                            <div class="flex items-center space-x-3">
                                @can('update', $news)
                                    <a href="{{ route('news.edit', $news->slug) }}"
                                        class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400 transition ease-in-out duration-150">
                                        Edit
                                    </a>
                                @endcan
                                @can('delete', $news)
                                    <form method="POST" action="{{ route('news.destroy', $news->slug) }}"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @endauth
                    </div>

                </article>
            </div>
        </div>
    </div>
</x-app-layout>
