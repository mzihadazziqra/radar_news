{{-- resources/views/components/dropdown-link.blade.php --}}
@props(['active' => false]) {{-- Hapus 'href' jika tidak digunakan, atau biarkan jika ada kasus pakai --}}

@php
    // Kelas dasar untuk link dropdown
    $classes =
        'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-600 transition duration-150 ease-in-out';
    //                                                                      ^^^^^^^^^^^^^^^^^^^^^^^  ^^^^^^^^^^^^^^^^^^^^^^^^^^^ dark mode text & hover bg

    // Jika ada state 'active' untuk dropdown link (jarang dipakai, tapi jaga-jaga)
    if ($active) {
        // $classes .= ' bg-gray-100 dark:bg-gray-900'; // Contoh jika ada state aktif
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
