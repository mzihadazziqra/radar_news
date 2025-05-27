{{-- File: resources/views/welcome.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <section class="mb-12" x-data="{
            activeSlide: 0,
            slides: {{ $heroSlides->count() }},
            autoplay: true, // Set ke true jika ingin autoplay
            autoplayInterval: 5000, // Interval autoplay dalam milidetik (5 detik)

            nextSlide() {
                this.activeSlide = (this.activeSlide + 1) % this.slides;
            },
            prevSlide() {
                this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides;
            },
            initAutoplay() {
                if (this.autoplay && this.slides > 1) {
                    setInterval(() => {
                        this.nextSlide();
                    }, this.autoplayInterval);
                }
            }
        }" x-init="initAutoplay()">
            <div>
                {{-- Kontainer untuk Slide Carousel --}}
                <div
                    class="rounded-lg shadow-lg overflow-hidden relative
                    h-[350px] sm:h-[400px] md:h-[450px] lg:h-[500px] {{-- Tinggi tetap untuk konsistensi --}}
                    bg-gray-700 flex items-center justify-center">

                    @if ($heroSlides->count() > 0)
                        @foreach ($heroSlides as $index => $slide)
                            {{-- Setiap Slide --}}
                            <div x-show="activeSlide === {{ $index }}"
                                x-transition:enter="transition ease-out duration-500 transform"
                                x-transition:enter-start="opacity-50 translate-x-full" {{-- Mulai dari kanan luar, sedikit transparan --}}
                                x-transition:enter-end="opacity-100 translate-x-0" {{-- Masuk ke posisi normal, opak penuh --}}
                                x-transition:leave="transition ease-in duration-500 transform"
                                x-transition:leave-start="opacity-100 translate-x-0" {{-- Mulai dari posisi normal, opak penuh --}}
                                x-transition:leave-end="opacity-50 -translate-x-full" {{-- Keluar ke kiri luar, sedikit transparan --}}
                                class="absolute inset-0 w-full h-full text-center flex flex-col justify-end items-center pb-12 md:pb-16 px-6 bg-gray-800">

                                {{-- Gambar Latar Slide --}}
                                @if ($slide->image_path)
                                    <img src="{{ asset('storage/' . $slide->image_path) }}" alt="{{ $slide->title }}"
                                        class="absolute inset-0 w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent opacity-80">
                                    </div> {{-- Gradient overlay dari bawah --}}
                                @endif

                                {{-- Konten Teks Slide --}}
                                <div class="relative z-10">
                                    <h2
                                        class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2 sm:mb-3 leading-tight max-w-3xl mx-auto">
                                        <a href="{{ route('news.show', $slide->slug) }}" class="hover:underline">
                                            {{ $slide->title }}
                                        </a>
                                    </h2>
                                    <p class="text-sm sm:text-md text-gray-200 mb-4 sm:mb-6 max-w-2xl mx-auto">
                                        @if ($slide->image_path)
                                            Oleh {{ $slide->user->name ?? 'Anonim' }}
                                            <span class="mx-1 hidden sm:inline">&bull;</span>
                                            <span
                                                class="block sm:inline mt-1 sm:mt-0">{{ $slide->published_at->translatedFormat('d M Y') }}</span>
                                        @else
                                            {{ Str::limit(strip_tags($slide->content), 100) }}
                                        @endif
                                    </p>
                                    <a href="{{ route('news.show', $slide->slug) }}"
                                        class="inline-block px-6 py-2.5 text-xs sm:text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-md shadow-lg transform hover:scale-105 transition-transform duration-200 ease-in-out">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        {{-- Tombol Navigasi Prev/Next (Opsional) --}}
                        <button @click="prevSlide()" aria-label="Previous slide"
                            class="absolute left-0 top-1/2 -translate-y-1/2 z-20 p-2 sm:p-4 m-2 bg-black/30 hover:bg-black/50 rounded-full text-white focus:outline-none transition-colors">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextSlide()" aria-label="Next slide"
                            class="absolute right-0 top-1/2 -translate-y-1/2 z-20 p-2 sm:p-4 m-2 bg-black/30 hover:bg-black/50 rounded-full text-white focus:outline-none transition-colors">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    @else
                        {{-- Fallback jika tidak ada hero slides --}}
                        <div class="text-center flex flex-col justify-center items-center h-full">
                            <h2 class="text-3xl font-bold text-gray-300 mb-3">Berita Unggulan</h2>
                            <p class="text-gray-400">Tidak ada berita unggulan untuk ditampilkan saat ini.</p>
                        </div>
                    @endif
                </div>

                {{-- Indikator Titik Carousel (Dinamis) --}}
                @if ($heroSlides->count() > 1) {{-- Hanya tampilkan jika lebih dari 1 slide --}}
                    <div class="flex justify-center space-x-2 mt-6">
                        @foreach ($heroSlides as $index => $slide)
                            <button @click="activeSlide = {{ $index }}"
                                :class="{
                                    'bg-primary ring-2 ring-primary ring-offset-2 dark:ring-offset-gray-800 w-3 h-3': activeSlide ===
                                        {{ $index }},
                                    'bg-gray-300 dark:bg-gray-600 hover:bg-gray-400 w-2.5 h-2.5': activeSlide !==
                                        {{ $index }}
                                }"
                                class="rounded-full focus:outline-none transition-all duration-300 ease-in-out"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        {{-- File: resources/views/welcome.blade.php (Bagian Grid Berita Lokal) --}}
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Berita Lokal Terbaru</h2>
                <a href="{{ route('news.index') }}" class="text-sm text-primary hover:underline">
                    Lihat Semua &rarr;
                </a>
            </div>
            @if ($localNewsPaginated->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($localNewsPaginated as $newsItem)
                        {{-- >>> AWAL KARTU BERITA BARU <<< --}}
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-shadow duration-300 hover:shadow-xl dark:border dark:border-gray-700">
                            <a href="{{ route('news.show', $newsItem->slug) }}">
                                @if ($newsItem->image_path)
                                    <img src="{{ asset('storage/' . $newsItem->image_path) }}"
                                        alt="{{ $newsItem->title }}" class="w-full h-40 sm:h-48 object-cover">
                                    {{-- Sesuaikan tinggi gambar jika perlu --}}
                                @else
                                    <div
                                        class="w-full h-40 sm:h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
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
                                <h3
                                    class="text-md sm:text-lg font-semibold mb-2 text-gray-900 dark:text-white leading-tight">
                                    <a href="{{ route('news.show', $newsItem->slug) }}"
                                        class="hover:text-primary dark:hover:text-primary-light transition-colors">
                                        {{ Str::limit($newsItem->title, 55) }}
                                    </a>
                                </h3>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mb-3">
                                    <span class="font-medium">{{ $newsItem->category->name ?? 'Umum' }}</span>
                                    <span class="mx-1">&bull;</span>
                                    <span>{{ $newsItem->published_at->diffForHumans() }}</span> {{-- Tampilkan waktu relatif --}}
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 flex-grow">
                                    {{ Str::limit(strip_tags($newsItem->content), 80) }}
                                </p>
                                <a href="{{ route('news.show', $newsItem->slug) }}"
                                    class="text-sm font-semibold text-primary hover:underline mt-auto self-start">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </div>
                        {{-- >>> AKHIR KARTU BERITA BARU <<< --}}
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 dark:text-gray-400">Belum ada berita lokal untuk ditampilkan.</p>
            @endif
        </section>

        {{-- >>> AWAL SEKSI BERITA INTERNASIONAL (MEDIASTACK) <<< --}}
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Berita Internasional</h2>
                <a href="{{ route('headlines.index') }}" class="text-sm text-primary hover:underline">
                    Lihat Semua &rarr; {{-- Link ke halaman daftar berita MediaStack --}}
                </a>
            </div>
            @if (!empty($externalHeadlines) && !isset($externalHeadlines['error']) && count($externalHeadlines) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($externalHeadlines as $article)
                        <div
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-shadow duration-300 hover:shadow-xl dark:border dark:border-gray-700">
                            <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer">
                                @if (!empty($article['image']))
                                    <img src="{{ $article['image'] }}"
                                        alt="{{ $article['title'] ?? 'Gambar Berita Internasional' }}"
                                        class="w-full h-40 sm:h-48 object-cover"
                                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder-news.png') }}';">
                                    {{-- Fallback jika gambar API error --}}
                                @else
                                    <div
                                        class="w-full h-40 sm:h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        {{-- SVG Placeholder Gambar --}}
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
                                <h3
                                    class="text-md sm:text-lg font-semibold mb-2 text-gray-900 dark:text-white leading-tight">
                                    <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                        class="hover:text-primary dark:hover:text-primary-light transition-colors">
                                        {{ Str::limit($article['title'] ?? 'Judul Tidak Tersedia', 55) }}
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
                                    {{ Str::limit($article['description'] ?? '', 80) }}
                                </p>
                                <a href="{{ $article['url'] ?? '#' }}" target="_blank" rel="noopener noreferrer"
                                    class="text-sm font-semibold text-primary hover:underline mt-auto self-start">
                                    Baca di Sumber Asli &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif (isset($externalHeadlines['error']))
                <p class="text-center text-sm text-red-500 dark:text-red-400">Gagal memuat berita internasional.</p>
            @else
                <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada berita internasional untuk
                    ditampilkan.</p>
            @endif
        </section>
        {{-- >>> AKHIR SEKSI BERITA INTERNASIONAL (MEDIASTACK) <<< --}}

    </div>
</x-app-layout>
