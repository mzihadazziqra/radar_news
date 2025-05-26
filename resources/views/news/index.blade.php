{{-- File: resources/views/news/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Berita Lokal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tombol untuk Tambah Berita Baru (Hanya tampil jika user login) --}}
            @auth
                <div class="mb-6 text-right">
                    <a href="{{ route('news.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('+ Tambah Berita Baru') }}
                    </a>
                </div>
            @endauth

            {{-- Kontainer untuk Daftar Berita --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($allNews->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($allNews as $newsItem)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col">
                                    {{-- Gambar Berita --}}
                                    @if ($newsItem->image_path)
                                        <img src="{{ asset('storage/' . $newsItem->image_path) }}"
                                            alt="{{ $newsItem->title }}"
                                            class="w-full h-48 object-cover rounded-md mb-4">
                                    @else
                                        {{-- Placeholder jika tidak ada gambar --}}
                                        <div
                                            class="w-full h-48 bg-gray-200 dark:bg-gray-600 rounded-md mb-4 flex items-center justify-center">
                                            <span class="text-gray-400 dark:text-gray-500">Tidak ada gambar</span>
                                        </div>
                                    @endif

                                    {{-- Judul Berita --}}
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">
                                        <a href="{{ route('news.show', $newsItem->slug) }}" class="hover:underline">
                                            {{ $newsItem->title }}
                                        </a>
                                    </h3>

                                    {{-- Kategori dan Penulis --}}
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                        <span>Kategori: {{ $newsItem->category->name ?? 'Tidak ada kategori' }}</span> |
                                        <span>Oleh: {{ $newsItem->user->name ?? 'Tidak diketahui' }}</span>
                                    </div>

                                    {{-- Tanggal Publikasi --}}
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                        Dipublikasikan pada:
                                        {{ $newsItem->published_at ? $newsItem->published_at->format('d M Y, H:i') : 'N/A' }}
                                    </div>

                                    {{-- Cuplikan Konten (opsional) --}}
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex-grow">
                                        {{ Str::limit(strip_tags($newsItem->content), 100) }}
                                    </p>

                                    <div class="mt-4 flex items-center justify-start space-x-2">
                                        @can('update', $newsItem)
                                            {{-- Cek apakah user bisa mengupdate berita ini --}}
                                            <a href="{{ route('news.edit', $newsItem->slug) }}"
                                                class="px-3 py-1 text-xs font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete', $newsItem)
                                            {{-- Cek apakah user bisa menghapus berita ini --}}
                                            <form method="POST" action="{{ route('news.destroy', $newsItem->slug) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 text-xs font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800 dark:focus:ring-red-900">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </div>

                                    {{-- Tombol Baca Selengkapnya (mengarahkan ke halaman detail berita nanti) --}}
                                    <a href="{{ route('news.show', $newsItem->slug) }}"
                                        class="mt-auto self-start text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 font-semibold text-sm">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{-- Link Paginasi --}}
                        <div class="mt-8">
                            {{ $allNews->links() }}
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">
                            Belum ada berita yang ditambahkan.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
