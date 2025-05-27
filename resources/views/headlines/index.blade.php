{{-- File: resources/views/headlines/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Berita Internasional') }}
            </h2>
            {{-- Tidak ada tombol "+ Tambah Berita Baru" di sini --}}
        </div>
    </x-slot>

    <div class="py-8"> {{-- Padding vertikal konsisten --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"> {{-- Padding horizontal konsisten --}}

            @if ($apiError)
                <div class="bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-200 px-4 py-3 rounded-lg relative mb-6"
                    role="alert">
                    <strong class="font-bold">Oops!</strong>
                    <span class="block sm:inline">{{ $apiError }}</span>
                </div>
            @endif

            @if (!empty($articles) && count($articles) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($articles as $article)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-shadow duration-300 hover:shadow-xl dark:border dark:border-gray-700">
                            <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                @if (!empty($article['image']))
                                    <img src="{{ $article['image'] }}"
                                        alt="{{ $article['title'] ?? 'Gambar Berita Internasional' }}"
                                        class="w-full h-48 object-cover" {{-- Tinggi gambar disamakan dengan kartu lain --}}
                                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder-news.png') }}';">
                                    {{-- Fallback jika gambar API error --}}
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
                                    <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                        class="hover:text-primary dark:hover:text-primary-light transition-colors">
                                        {{ Str::limit($article['title'] ?? 'Judul Tidak Tersedia', 60) }}
                                    </a>
                                </h3>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    <span class="font-medium">{{ $article['source'] ?? 'Tidak Diketahui' }}</span>
                                    @if (!empty($article['published_at']))
                                        <span class="mx-1">&bull;</span>
                                        <span>{{ \Carbon\Carbon::parse($article['published_at'])->diffForHumans() }}</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 flex-grow">
                                    {{ Str::limit($article['description'] ?? '', 100) }}
                                </p>
                                <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                    class="text-sm font-semibold text-primary hover:underline mt-auto self-start">
                                    Baca di Sumber Asli &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Karena kita mengambil jumlah tetap (limit 12) dari API dan API MediaStack (free) tidak mudah dipaginasi --}}
                {{-- dengan cara Laravel, kita tidak tampilkan Paginator::links() di sini untuk sementara. --}}
                {{-- Jika ingin ada tombol "Load More" atau paginasi manual, itu perlu implementasi berbeda. --}}
            @elseif (!$apiError)
                {{-- Jika tidak ada error tapi juga tidak ada artikel --}}
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-400">
                        Tidak ada berita internasional untuk ditampilkan saat ini.
                    </p>
                </div>
            @endif
            {{-- Jika $apiError ada, pesan error sudah ditampilkan di atas --}}
        </div>
    </div>
</x-app-layout>
