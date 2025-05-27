{{-- resources/views/vendor/pagination/tailwind.blade.php (Contoh setelah dimodifikasi agar lebih mirip desain) --}}
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}"
        class="flex items-center justify-between sm:justify-center">
        {{-- Tombol Previous (Sederhana dengan ikon) --}}
        @if ($paginator->onFirstPage())
            <span
                class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 me-1 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                &lsaquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 me-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                &lsaquo;
            </a>
        @endif

        {{-- Nomor Halaman --}}
        <div class="flex space-x-1">
            @foreach ($elements as $element)
                @if (is_string($element))
                    {{-- "..." separator --}}
                    <span
                        class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">{{ $element }}</span>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm font-semibold text-white bg-primary border border-transparent rounded-md cursor-default">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Tombol Next (Sederhana dengan ikon) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 ms-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
                &rsaquo;
            </a>
        @else
            <span
                class="relative inline-flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 ms-1 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-gray-500">
                &rsaquo;
            </span>
        @endif
    </nav>
@endif
