{{-- File: resources/views/headlines/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Berita Terkini dari MediaStack') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tampilkan pesan error jika ada --}}
            {{-- @if (session('mediastack_error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('mediastack_error') }}</span>
                </div>
            @endif --}}

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (!empty($articles) && !isset($articles['error']))
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($articles as $article)
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow p-4 flex flex-col">
                                    {{-- Gambar Berita (jika tersedia di API) --}}
                                    @if (!empty($article['image']))
                                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] ?? 'Gambar Berita' }}"
                                             class="w-full h-48 object-cover rounded-md mb-4"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"> {{-- Sembunyikan jika gambar error --}}
                                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 rounded-md mb-4 items-center justify-center" style="display: none;">
                                            <span class="text-gray-400 dark:text-gray-500">Gambar tidak tersedia</span>
                                        </div>
                                    @else
                                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-600 rounded-md mb-4 flex items-center justify-center">
                                            <span class="text-gray-400 dark:text-gray-500">Gambar tidak tersedia</span>
                                        </div>
                                    @endif

                                    {{-- Judul Berita --}}
                                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">
                                        <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer" class="hover:underline">
                                            {{ $article['title'] ?? 'Judul Tidak Tersedia' }}
                                        </a>
                                    </h3>

                                    {{-- Sumber dan Penulis --}}
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                                        <span>Sumber: {{ $article['source'] ?? 'N/A' }}</span>
                                        @if (!empty($article['author']))
                                            | <span>Penulis: {{ $article['author'] }}</span>
                                        @endif
                                    </div>

                                    {{-- Tanggal Publikasi --}}
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                        @if (!empty($article['published_at']))
                                            Dipublikasikan pada: {{ \Carbon\Carbon::parse($article['published_at'])->translatedFormat('d M Y, H:i') }}
                                        @else
                                            Tanggal tidak tersedia
                                        @endif
                                    </div>

                                    {{-- Deskripsi Singkat --}}
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 flex-grow">
                                        {{ Str::limit($article['description'] ?? '', 150) }}
                                    </p>

                                    {{-- Tombol Baca Selengkapnya (mengarahkan ke sumber asli) --}}
                                    <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                       class="mt-auto self-start text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-200 font-semibold text-sm">
                                        Baca Selengkapnya di Sumber Asli &rarr;
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @elseif (isset($articles['error']))
                         <p class="text-center text-red-500 dark:text-red-400">
                            Gagal memuat berita: {{ $articles['error'] }}
                            @if(isset($articles['status'])) (Status: {{ $articles['status'] }}) @endif
                        </p>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400">
                            Tidak ada berita terkini yang dapat ditampilkan saat ini.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
