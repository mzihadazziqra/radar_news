{{-- File: resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Berita Saya') }} {{-- Judul diubah --}}
            </h2>
            {{-- Tombol Tambah Berita Baru tetap di sini untuk akses mudah --}}
            <div>
                <a href="{{ route('news.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark transition ease-in-out duration-150">
                    {{ __('+ Tambah Berita Baru') }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg mb-6 dark:border dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Halo, {{ $user->name }}!</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        @if ($userNewsCount > 0)
                            Anda telah menulis total <strong>{{ $userNewsCount }}</strong> berita. Luar biasa!
                        @else
                            Anda belum menulis berita apapun. Ayo mulai menulis!
                        @endif
                    </p>
                </div>
            </div>

            {{-- Grid Berita Milik Pengguna --}}
            @if ($userNews->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($userNews as $newsItem)
                        {{-- Menggunakan struktur kartu yang sama dengan news.index.blade.php --}}
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-shadow duration-300 hover:shadow-xl dark:border dark:border-gray-700">
                            <a href="{{ route('news.show', $newsItem->slug) }}">
                                @if ($newsItem->image_path)
                                    <img src="{{ asset('storage/' . $newsItem->image_path) }}"
                                        alt="{{ $newsItem->title }}" class="w-full h-48 object-cover">
                                @else
                                    <div
                                        class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                            </a>
                            <div class="p-4 sm:p-5 flex flex-col flex-grow">
                                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white leading-tight">
                                    <a href="{{ route('news.show', $newsItem->slug) }}"
                                        class="hover:text-primary dark:hover:text-primary-light transition-colors">
                                        {{ Str::limit($newsItem->title, 60) }}
                                    </a>
                                </h3>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                    <span class="font-medium">{{ $newsItem->category->name ?? 'Umum' }}</span>
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    <span>Dipublikasikan:
                                        {{ $newsItem->published_at ? $newsItem->published_at->diffForHumans() : 'Belum dipublikasi' }}</span>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 flex-grow">
                                    {{ Str::limit(strip_tags($newsItem->content), 100) }}
                                </p>
                                <div
                                    class="mt-auto pt-3 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                    <div>
                                        {{-- Tombol Edit dan Hapus akan selalu relevan karena ini berita milik user --}}
                                        <a href="{{ route('news.edit', $newsItem->slug) }}"
                                            class="text-xs font-medium text-yellow-600 dark:text-yellow-400 hover:underline me-3">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('news.destroy', $newsItem->slug) }}"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-xs font-medium text-red-600 dark:text-red-400 hover:underline">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                    <a href="{{ route('news.show', $newsItem->slug) }}"
                                        class="text-sm font-semibold text-primary hover:underline">
                                        Baca &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Link Paginasi untuk Berita Pengguna --}}
                <div class="mt-8">
                    {{ $userNews->links() }}
                </div>
            @elseif (!$userNewsCount > 0)
                {{-- Tampilkan jika user belum punya berita sama sekali (setelah pesan welcome) --}}
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center dark:border dark:border-gray-700">
                    <p class="text-gray-500 dark:text-gray-400">
                        Anda belum memiliki berita yang dipublikasikan.
                    </p>
                </div>
            @endif
            {{-- Jika ada error API atau kondisi lain, bisa ditambahkan penanganannya di sini --}}
        </div>
    </div>
</x-app-layout>
