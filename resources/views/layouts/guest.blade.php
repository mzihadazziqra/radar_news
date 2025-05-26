{{-- File: resources/views/layouts/guest.blade.php (Versi Kartu Lebih Lebar) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        {{-- Ini adalah KARTU yang lebih lebar untuk konten (misalnya, form register/login) --}}
        {{-- Ganti sm:max-w-md menjadi ukuran yang lebih lebar, contoh: sm:max-w-4xl --}}
        <div class="w-full sm:max-w-4xl mt-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{-- $slot akan diisi oleh konten dari register.blade.php --}}
            {{-- Padding (px, py) akan dihandle oleh konten di dalam slot jika diperlukan per panel --}}
            {{ $slot }}
        </div>
    </div>
</body>

</html>
