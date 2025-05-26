{{-- File: resources/views/welcome.blade.php --}}
<x-app-layout> {{-- Menggunakan layout utama jika ingin ada navigasi standar --}}
                 {{-- Atau gunakan layout yang lebih sederhana jika homepage punya desain khusus --}}

    {{-- Hapus atau sesuaikan bagian header slot jika tidak diperlukan untuk homepage --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Homepage') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang di Portal Berita Kami!</h1>
                    <p class="text-gray-600 dark:text-gray-400">Temukan berita terkini dari berbagai sumber dan kontribusi lokal.</p>
                </div>
            </div>

            <section class="mb-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 ">Berita Terkini</h2>
                    <a href="{{ route('headlines.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>
                @if (!empty($externalHeadlines) && !isset($externalHeadlines['error']) && count($externalHeadlines) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach (array_slice($externalHeadlines, 0, 3) as $article) {{-- Tampilkan 3 berita saja di homepage --}}
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col">
                                @if (!empty($article['image']))
                                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] ?? 'Gambar Berita' }}"
                                         class="w-full h-40 object-cover rounded-md mb-4"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-40 bg-gray-200 dark:bg-gray-600 rounded-md mb-4 items-center justify-center" style="display: none;">
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">Gambar tidak tersedia</span>
                                    </div>
                                @else
                                    <div class="w-full h-40 bg-gray-200 dark:bg-gray-600 rounded-md mb-4 flex items-center justify-center">
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">Gambar tidak tersedia</span>
                                    </div>
                                @endif
                                <h3 class="text-md font-semibold mb-1 text-gray-900 dark:text-white leading-tight">
                                    <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                                        {{ Str::limit($article['title'] ?? 'Judul Tidak Tersedia', 60) }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $article['source'] ?? 'N/A' }}</p>
                                {{-- <p class="text-xs text-gray-600 dark:text-gray-300 flex-grow">{{ Str::limit($article['description'] ?? '', 70) }}</p> --}}
                            </div>
                        @endforeach
                    </div>
                @elseif (isset($externalHeadlines['error']))
                    <p class="text-center text-sm text-red-500 dark:text-red-400">Gagal memuat berita terkini.</p>
                @else
                    <p class="text-center text-sm text-gray-500 dark:text-gray-400">Tidak ada berita terkini untuk ditampilkan.</p>
                @endif
            </section>

            <section>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Berita Lokal Terbaru</h2>
                    <a href="{{ route('news.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                        Lihat Semua &rarr;
                    </a>
                </div>
                @if ($localNews->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($localNews->take(3) as $newsItem) {{-- Tampilkan 3 berita saja di homepage --}}
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col">
                                @if ($newsItem->image_path)
                                    <img src="{{ asset('storage/' . $newsItem->image_path) }}" alt="{{ $newsItem->title }}"
                                         class="w-full h-40 object-cover rounded-md mb-4">
                                @else
                                    <div class="w-full h-40 bg-gray-200 dark:bg-gray-600 rounded-md mb-4 flex items-center justify-center">
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">Tidak ada gambar</span>
                                    </div>
                                @endif
                                <h3 class="text-md font-semibold mb-1 text-gray-900 dark:text-white leading-tight">
                                    <a href="{{ route('news.show', $newsItem->slug) }}" class="hover:underline">
                                        {{ Str::limit($newsItem->title, 60) }}
                                    </a>
                                </h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                    {{ $newsItem->category->name ?? 'N/A' }} | Oleh: {{ $newsItem->user->name ?? 'N/A' }}
                                </p>
                                {{-- <p class="text-xs text-gray-600 dark:text-gray-300 flex-grow">{{ Str::limit(strip_tags($newsItem->content), 70) }}</p> --}}
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-sm text-gray-500 dark:text-gray-400">Belum ada berita lokal untuk ditampilkan.</p>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>
