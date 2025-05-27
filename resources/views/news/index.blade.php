<x-app-layout>
    <x-slot name="header">
        {{-- Gunakan Flexbox untuk menyejajarkan judul dan tombol --}}
        <div class="flex justify-between items-center">
            {{-- Judul Halaman --}}
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar Berita Lokal') }}
            </h2>

            {{-- Tombol Tambah Berita Baru (hanya untuk user yang sudah login) --}}
            @auth
                <div>
                    <a href="{{ route('news.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark transition ease-in-out duration-150">
                        {{ __('+ Tambah Berita Baru') }}
                    </a>
                </div>
            @endauth
        </div>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- >>> AWAL HERO SECTION BARU (Gaya Homepage untuk Utama, Gaya Kartu untuk Sampingan) <<< --}}
            @if ($heroMainNews)
                <section class="mb-10">
                    <div class="flex flex-col lg:flex-row gap-3">
                        {{-- Kolom Kiri: Berita Utama Hero (Gaya Homepage Hero) --}}
                        <div class="w-full">
                            <div
                                class="bg-gray-700 rounded-lg shadow-lg overflow-hidden relative h-80 sm:h-96 md:h-[500px] flex flex-col justify-end text-white p-6 sm:p-8">
                                @if ($heroMainNews->image_path)
                                    <img src="{{ asset('storage/' . $heroMainNews->image_path) }}"
                                        alt="{{ $heroMainNews->title }}"
                                        class="absolute inset-0 w-full h-full object-cover">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent">
                                    </div> {{-- Gradient overlay lebih kuat --}}
                                @else
                                    {{-- Fallback jika tidak ada gambar, bisa beri warna latar saja --}}
                                    <div class="absolute inset-0 bg-slate-700"></div>
                                @endif
                                <div class="relative z-10">
                                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-2 leading-tight">
                                        <a href="{{ route('news.show', $heroMainNews->slug) }}" class="hover:underline">
                                            {{ $heroMainNews->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm sm:text-md text-gray-200 mb-3">
                                        Oleh {{ $heroMainNews->user->name ?? 'Anonim' }} <span
                                            class="mx-1">&bull;</span>
                                        {{ $heroMainNews->published_at->translatedFormat('d M Y') }}
                                    </p>
                                    <a href="{{ route('news.show', $heroMainNews->slug) }}"
                                        class="text-sm font-semibold text-primary-light hover:text-white hover:underline">
                                        Baca Selengkapnya &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if ($heroSideNews->count() > 0)
                            <div class="lg:w-1/3 w-full flex flex-col space-y-2">
                                @foreach ($heroSideNews as $sideNews)
                                    {{-- AWAL KARTU MINI-HERO SAMPINGAN --}}
                                    <a href="{{ route('news.show', $sideNews->slug) }}"
                                        class=" rounded-lg shadow-lg overflow-hidden relative lg:h-auto flex-1 flex flex-col justify-end text-white p-4 hover:shadow-xl bg-slate-700">
                                        {{-- Latar fallback jika tidak ada gambar --}}

                                        @if ($sideNews->image_path)
                                            <img src="{{ asset('storage/' . $sideNews->image_path) }}"
                                                alt="{{ $sideNews->title }}"
                                                class="absolute inset-0 w-full h-full object-cover">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent opacity-90">
                                            </div> {{-- Gradient overlay --}}
                                        @else
                                            {{-- Jika tidak ada gambar, pastikan teks tetap terlihat di atas bg-slate-700 --}}
                                        @endif

                                        <div class="relative z-10">
                                            <h4
                                                class="text-sm font-semibold mb-0.5 leading-tight group-hover:underline">
                                                {{ Str::limit($sideNews->title, 50) }} {{-- Batasi judul agar pas --}}
                                            </h4>
                                            <p class="text-xs text-gray-300">
                                                {{ $sideNews->published_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </a>
                                    {{-- AKHIR KARTU MINI-HERO SAMPINGAN --}}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endif
            {{-- >>> AKHIR HERO SECTION BARU <<< --}}

            {{-- Kontainer untuk Daftar Berita --}}
            <div class=" text-gray-900 dark:text-gray-100">
                @if ($allNews->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Di dalam <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> --}}
                        @foreach ($allNews as $newsItem)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col transition-shadow duration-300 hover:shadow-xl dark:border dark:border-gray-700">
                                <a href="{{ route('news.show', $newsItem->slug) }}">
                                    @if ($newsItem->image_path)
                                        <img src="{{ asset('storage/' . $newsItem->image_path) }}"
                                            alt="{{ $newsItem->title }}" class="w-full h-48 object-cover">
                                        {{-- Tinggi gambar bisa disesuaikan (h-48 = 12rem) --}}
                                    @else
                                        <div
                                            class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
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
                                        <span>Oleh: {{ $newsItem->user->name ?? 'Anonim' }}</span>
                                        <span class="mx-1">&bull;</span>
                                        <span>{{ $newsItem->published_at ? $newsItem->published_at->diffForHumans() : 'Belum dipublikasi' }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-4 flex-grow">
                                        {{ Str::limit(strip_tags($newsItem->content), 100) }}
                                    </p>

                                    {{-- Tombol Aksi (Edit, Hapus) dan Baca Selengkapnya --}}
                                    <div
                                        class="mt-auto pt-3 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
                                        <div>
                                            @can('update', $newsItem)
                                                <a href="{{ route('news.edit', $newsItem->slug) }}"
                                                    class="text-xs font-medium text-yellow-600 dark:text-yellow-400 hover:underline me-3">
                                                    Edit
                                                </a>
                                            @endcan
                                            @can('delete', $newsItem)
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
                                            @endcan
                                        </div>
                                        <a href="{{ route('news.show', $newsItem->slug) }}"
                                            class="text-sm font-semibold text-primary hover:underline">
                                            Baca &rarr;
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- ... (Akhir dari grid, lalu paginasi) ... --}}
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

</x-app-layout>
