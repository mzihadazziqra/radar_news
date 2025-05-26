{{-- File: resources/views/news/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        {{-- Kita bisa tampilkan judul berita di header jika mau, atau biarkan generik --}}
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $news->title }} {{-- Menampilkan judul berita di header --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <article class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Gambar Berita (jika ada) --}}
                    @if ($news->image_path)
                        <img src="{{ asset('storage/' . $news->image_path) }}" alt="{{ $news->title }}"
                            class="w-full max-h-[400px] object-cover rounded-md mb-6 shadow">
                    @endif

                    {{-- Judul Berita Utama --}}
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $news->title }}
                    </h1>

                    {{-- Meta Info: Kategori, Penulis, Tanggal Publikasi --}}
                    <div class="mb-6 text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-semibold">Kategori:</span>
                        <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            {{ $news->category->name ?? 'Tidak ada kategori' }}
                        </a>
                        <span class="mx-2">|</span>
                        <span class="font-semibold">Oleh:</span>
                        <span>{{ $news->user->name ?? 'Tidak diketahui' }}</span>
                        <span class="mx-2">|</span>
                        <span class="font-semibold">Dipublikasikan:</span>
                        <span>{{ $news->published_at ? $news->published_at->format('d M Y, H:i') : 'N/A' }}</span>
                    </div>

                    {{-- Konten Berita --}}
                    {{-- Menggunakan {!! !!} jika konten mungkin berisi HTML dan kamu ingin merendernya. --}}
                    {{-- Hati-hati dengan XSS jika konten berasal dari sumber yang tidak terpercaya. --}}
                    {{-- Untuk saat ini kita anggap konten aman atau hanya teks biasa. --}}
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($news->content)) !!} {{-- Mengubah baris baru menjadi <br> dan escape HTML --}}
                    </div>

                    @auth {{-- Pastikan user login dulu sebelum cek @can --}}
                        <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700 flex items-center space-x-3">
                            @can('update', $news)
                                <a href="{{ route('news.edit', $news->slug) }}"
                                    class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Edit Berita
                                </a>
                            @endcan

                            @can('delete', $news)
                                <form method="POST" action="{{ route('news.destroy', $news->slug) }}"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                        Hapus Berita
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endauth

                    {{-- Tombol Kembali ke Daftar Berita --}}
                    <div class="mt-8">
                        <a href="{{ route('news.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-400 active:bg-gray-600 focus:outline-none focus:border-gray-600 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            &larr; Kembali ke Daftar Berita
                        </a>
                    </div>

                </article>
            </div>
        </div>
    </div>
</x-app-layout>
