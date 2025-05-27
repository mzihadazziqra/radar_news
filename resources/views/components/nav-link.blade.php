{{-- File: resources/views/components/nav-link.blade.php (REVISI UNTUK GAYA TRADISIONAL) --}}
@props(['active', 'href' => '#'])

@php
$isCurrentLinkActive = $active ?? false;

// Kelas dasar untuk semua link navigasi
$baseClasses = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out';
// Padding px-1 pt-1 dan border-b-2 adalah gaya standar Breeze untuk link dengan garis bawah

$activeClasses = '';
$inactiveClasses = '';

if ($isCurrentLinkActive) {
    // Gaya untuk SEMUA link yang aktif: teks primer, border bawah primer
    $activeClasses = 'border-primary text-primary dark:border-primary-light dark:text-primary-light focus:border-primary-dark';
    // Ganti primary-light dan primary-dark dengan variasi warna primer jika ada, atau gunakan primary saja
    // Contoh sederhana: 'border-primary text-primary dark:border-primary dark:text-primary focus:border-primary'

} else {
    // Gaya untuk SEMUA link yang tidak aktif: teks abu-abu, border transparan, hover
    $inactiveClasses = 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700';
}

$finalClasses = $baseClasses . ' ' . ($isCurrentLinkActive ? $activeClasses : $inactiveClasses);
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $finalClasses]) }}>
    {{ $slot }}
</a>
