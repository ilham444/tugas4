<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul halaman dinamis, dengan fallback ke nama aplikasi --}}
    <title>{{ $title ?? config('app.name', 'EduPlatform') }}</title>

    <!-- Fonts: Menggunakan Poppins agar konsisten dengan tema EduPlatform -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles & Scripts dari Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS untuk menerapkan font Poppins dan transisi halus -->
    <style>
        /* Menerapkan font Poppins ke seluruh body */
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Transisi yang lebih halus untuk semua elemen saat berganti mode (light/dark) */
        *, ::before, ::after {
            transition: background-color .3s, border-color .3s, color .3s, fill .3s, stroke .3s;
            transition-timing-function: cubic-bezier(.4,0,.2,1);
        }
    </style>
</head>
<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        
        {{-- Memasukkan file navigasi --}}
        @include('layouts.navigation')

        {{-- Header Halaman (Jika ada) --}}
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{-- Slot untuk konten header, seperti judul halaman --}}
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Konten Utama Halaman --}}
        <main>
            {{-- Slot utama di mana konten dari setiap halaman (misal: dashboard.blade.php) akan ditampilkan --}}
            {{ $slot }}
        </main>

    </div>

</body>
</html>