<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'EduPlatform') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Transisi bisa membuat UI terasa lebih lambat, opsional untuk dihapus */
        /* *, ::before, ::after { transition: all 0.3s ease-in-out; } */
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <div class="min-h-screen flex flex-col">

        {{-- Sticky Navbar --}}
        <nav class="sticky top-0 z-50 bg-white dark:bg-gray-800 shadow-md">
            @include('layouts.navigation')
        </nav>

        {{-- Header Halaman --}}
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    {{-- Bagian Kiri: Slot untuk judul halaman --}}
                    <div>
                        {{ $header }}
                    </div>

                    {{-- ===================== PERBAIKAN DI SINI ===================== --}}
                    
                    {{-- Bagian Kanan: Wadah untuk tombol-tombol aksi global --}}
                    {{-- Tampilkan tombol ini HANYA jika pengguna adalah admin --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <div class="flex items-center gap-3 flex-shrink-0">
                                {{-- Tombol Tambah Soal Quiz --}}
                                <a href="{{ route('admin.questions.create') }}"
                                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Tambah Soal</span>
                                </a>

                                {{-- Tombol Tambah Modul --}}
                                <a href="{{ route('admin.modul.create') }}"
                                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                                    </svg>
                                    <span>Tambah Modul</span>
                                </a>
                            </div>
                        @endif
                    @endauth
                    {{-- ======================= AKHIR PERBAIKAN ======================= --}}
                </div>
            </div>
        </header>
        @endif

        {{-- Konten Utama --}}
        <main class="flex-grow">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-white dark:bg-gray-800 text-center text-sm py-4 mt-8 border-t border-gray-200 dark:border-gray-700">
            <span class="text-gray-500 dark:text-gray-400">© {{ date('Y') }} EduPlatform. All rights reserved.</span>
        </footer>

    </div>
    
    {{-- Stack untuk script tambahan dari halaman lain --}}
    @stack('scripts')
</body>

</html>