<x-app-layout>
    <x-slot name="title">{{ $materi->title }} - EduPlatform</x-slot>

    {{-- Header --}}
    <div class="bg-white dark:bg-gray-800/50 shadow-sm">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" d="m1 9 4-4-4-4"/></svg>
                            <span class="ml-1 text-sm font-medium text-gray-700 dark:text-gray-300">{{ $materi->kategori->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $materi->title }}</h1>
        </div>
    </div>

    {{-- Konten --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Konten Utama --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Preview File --}}
                    <div class="relative bg-white dark:bg-gray-900 shadow-xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        @php
                            $fileExtension = strtolower(pathinfo($materi->file_path, PATHINFO_EXTENSION));
                            $fileUrl = asset('storage/' . $materi->file_path);
                        @endphp

                        @if(in_array($fileExtension, ['mp4', 'webm', 'ogg']))
                            <video controls class="w-full h-auto">
                                <source src="{{ $fileUrl }}" type="video/{{ $fileExtension }}">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        @elseif($fileExtension === 'pdf')
                            <iframe src="{{ $fileUrl }}#toolbar=0" class="w-full" style="height: 80vh;" frameborder="0"></iframe>

                        @else
                            <div class="p-6 text-center text-gray-500 dark:text-gray-300">
                                File tidak bisa dipratinjau.
                            </div>
                        @endif

                        {{-- Tombol Download --}}
                        <div class="absolute top-4 right-4">
                            <a href="{{ $fileUrl }}" download target="_blank"
                               class="inline-flex items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4"/>
                                </svg>
                                Unduh File
                            </a>
                        </div>
                    </div>

                    {{-- Deskripsi & Komentar --}}
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border p-6 space-y-6">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">Deskripsi Materi</h2>
                        <p class="prose dark:prose-invert">{!! nl2br(e($materi->description)) !!}</p>

                        <hr class="border-gray-300 dark:border-gray-600">

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Diskusi ({{ $materi->komentars->count() }})</h3>

                        {{-- Form Komentar --}}
                        <form action="{{ route('komentar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                            <textarea name="body" rows="3" class="w-full border rounded-lg p-3 text-sm" placeholder="Tulis komentar..." required></textarea>
                            <button type="submit" class="mt-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-semibold">Kirim</button>
                        </form>

                        {{-- Daftar Komentar --}}
                        <div class="space-y-4 mt-6">
                            @forelse ($materi->komentars as $komentar)
                                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="font-semibold text-gray-800 dark:text-white">{{ $komentar->user->name }}</span>
                                        <span class="text-gray-500 dark:text-gray-400">{{ $komentar->created_at->diffForHumans() }}</span>

                                    </div>
                                    <p class="mt-2 text-gray-700 dark:text-gray-200">{{ $komentar->body }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">Belum ada komentar.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow border">
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Informasi Materi</h4>
                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                            <li><strong>Kategori:</strong> {{ $materi->kategori->name }}</li>
                            <li><strong>Format:</strong> {{ strtoupper($fileExtension) }}</li>
                            <li><strong>Diunggah:</strong> {{ $materi->created_at->format('d M Y') }}</li>
                        </ul>
                    </div>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
