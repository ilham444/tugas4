<x-app-layout>
    {{-- Slot for the dynamic page title in the browser tab --}}
    <x-slot name="title">{{ $modul->title }} - EduPlatform</x-slot>

    {{-- SECTION: Page Header --}}
    <div class="bg-white dark:bg-gray-800/50 shadow-sm">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumbs for Navigation --}}
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('user.dashboard') }}"
                            class="text-sm font-medium text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-white">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2 dark:text-gray-300">
                                {{ $modul->title }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
            {{-- Main Page Title --}}
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                {{ $modul->title }}
            </h1>
        </div>
    </div>

    {{-- SECTION: Main Content --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 xl:gap-12">

                <!-- ============================================= -->
                <!-- Main Content Column (Left, 2/3) -->
                <!-- ============================================= -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Dynamic Content Player (Video/PDF/Image/Other) -->
                    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                        {{-- Ensure there is a file uploaded before trying to display it --}}
                        @if($modul->thumbnail)
                            @php
                                $fileExtension = strtolower(pathinfo($modul->thumbnail, PATHINFO_EXTENSION));
                            @endphp

                            @switch($fileExtension)
                                @case('mp4')
                                @case('webm')
                                @case('ogg')
                                    {{-- Video Player --}}
                                    <div class="aspect-w-16 aspect-h-9 bg-black">
                                        <video controls controlsList="nodownload" class="w-full h-full object-contain">
                                            <source src="{{ $modul->thumbnail }}" type="video/{{ $fileExtension }}">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                    @break

                                @case('pdf')
                                    {{-- PDF Viewer --}}
                                    <div class="aspect-w-4 aspect-h-5" style="height: 80vh;">
                                        <iframe src="{{ $modul->thumbnail }}#toolbar=0" class="w-full h-full" frameborder="0"></iframe>
                                    </div>
                                    @break

                                @case('png')
                                @case('jpg')
                                @case('jpeg')
                                @case('webp')
                                @case('gif')
                                    {{-- Image Viewer --}}
                                    <div class="bg-gray-100 dark:bg-gray-900">
                                        <img src="{{ $modul->thumbnail }}" alt="Thumbnail for {{ $modul->title }}" class="w-full h-auto max-h-[80vh] object-contain" />
                                    </div>
                                    @break

                                @default
                                    {{-- Fallback view for files that cannot be previewed --}}
                                    <div class="p-10 text-center bg-gray-50 dark:bg-gray-800 flex flex-col items-center justify-center min-h-[350px]">
                                        <div class="bg-indigo-100 dark:bg-indigo-500/10 p-4 rounded-full">
                                            <svg class="h-12 w-12 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                        </div>
                                        <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">Preview Not Available</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This file cannot be displayed directly in the browser.</p>
                                        <a href="{{ $modul->thumbnail }}" download
                                            class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-md transition-colors"></a>
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 2.75a.75.75 0 00-1.5 0v8.614L6.295 8.235a.75.75 0 10-1.09 1.03l4.25 4.5a.75.75 0 001.09 0l4.25-4.5a.75.75 0 00-1.09-1.03l-2.955 3.129V2.75z" /><path d="M3.5 12.75a.75.75 0 00-1.5 0v2.5A2.75 2.75 0 004.75 18h10.5A2.75 2.75 0 0018 15.25v-2.5a.75.75 0 00-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5z" /></svg>
                                            Download File ({{ strtoupper($fileExtension) }})
                                        </a>
                                    </div>
                            @endswitch
                        @else
                            {{-- View if there is no file at all --}}
                            <div class="p-10 text-center bg-gray-50 dark:bg-gray-800 flex flex-col items-center justify-center min-h-[350px]">
                                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-full">
                                    <svg class="h-12 w-12 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3.75v3.75m3.75-3.75v3.75M9 11.25h6M12 15.75h.008v.008H12v-.008zM12 2.25l.16.021a.75.75 0 01.32 1.506l-.16-.021A.75.75 0 0112 2.25z" /></svg>
                                </div>
                                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-gray-200">No Content Available</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This module does not have any content to display yet.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Description & Materials List Area (with Tabs) -->
                    <div x-data="{ tab: 'description' }" class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700">
                        <div class="border-b border-gray-200 dark:border-gray-700">
                            <nav class="-mb-px flex space-x-6 px-6" aria-label="Tabs">
                                <button @click="tab = 'description'" :class="tab === 'description' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors focus:outline-none">Description</button>
                                <button @click="tab = 'materi'" :class="tab === 'materi' ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:hover:text-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors focus:outline-none">Materials ({{ $modul->materis->count() }})</button>
                            </nav>
                        </div>
                        <div class="p-6 md:p-8">
                            {{-- Description Tab Content --}}
                            <div x-show="tab === 'description'" class="prose prose-indigo dark:prose-invert max-w-none">
                                {{-- NOTE: Using `{!! ... !!}` to render HTML. Ensure data is sanitized on the backend for security (XSS). --}}
                                {!! $modul->description !!}
                            </div>
                            {{-- Materials Tab Content --}}
                            <div x-show="tab === 'materi'" x-cloak>
                                @if($modul->materis->isNotEmpty())
                                    <ul class="space-y-3">
                                        @foreach($modul->materis as $materi)
                                            <li>
                                                <a href="{{ route('user.modul.materi.show', [$modul, $materi->slug]) }}" class="flex items-center justify-between bg-gray-50 dark:bg-gray-900/50 hover:bg-gray-100 dark:hover:bg-gray-700/50 rounded-lg px-4 py-3 transition-colors">
                                                    <span class="font-semibold text-indigo-700 dark:text-indigo-400">{{ $loop->iteration }}. {{ $materi->title }}</span>
                                                    <span class="inline-flex items-center gap-1 text-sm text-indigo-600 dark:text-indigo-400">
                                                        View <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-gray-500 dark:text-gray-400 text-center py-8">
                                        No materials have been added to this module yet.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================= -->
                <!-- Information Column (Right, 1/3) - Sidebar -->
                <!-- ============================================= -->
                <aside class="lg:col-span-1 space-y-8">
                    <!-- Module Status & Information Panel -->
                    <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl border border-gray-200 dark:border-gray-700 p-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Start this Module</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Start learning with the first material in this module and proceed in order.</p>

                                {{-- Using isNotEmpty() for cleaner checking --}}
                                @if($modul->materis->isNotEmpty())
                                    @php $firstMateri = $modul->materis->first(); @endphp
                                    <a href="{{ route('user.modul.materi.show', [$modul, $firstMateri->slug]) }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 font-semibold rounded-lg transition-all bg-indigo-600 hover:bg-indigo-700 text-white shadow-md">
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" /></svg>
                                        Start Learning
                                    </a>
                                    <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">
                                        First material: <span class="font-semibold">{{ $firstMateri->title }}</span>
                                    </div>
                                @else
                                    <div class="text-gray-500 dark:text-gray-400 text-center py-4 border border-dashed dark:border-gray-700 rounded-lg">
                                        No materials in this module yet.
                                    </div>
                                @endif
                            </div>
                            <hr class="dark:border-gray-700">
                            <ul class="text-sm space-y-4">
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2.5 font-medium text-gray-600 dark:text-gray-300"><svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg> Category</span>
                                    {{-- Using optional() or "?->" to prevent errors if the category is null --}}
                                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 dark:bg-indigo-900/50 dark:text-indigo-300 rounded text-xs font-medium">{{ $modul->kategori?->name ?? 'N/A' }}</span>
                                </li>
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2.5 font-medium text-gray-600 dark:text-gray-300"><svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Published On</span>
                                    <span class="text-gray-800 dark:text-gray-200">{{ $modul->created_at->format('d F Y') }}</span>
                                </li>
                                @if($modul->thumbnail)
                                <li class="flex items-center justify-between">
                                    <span class="flex items-center gap-2.5 font-medium text-gray-600 dark:text-gray-300"><svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg> File Type</span>
                                    <span class="text-gray-800 dark:text-gray-200">{{ strtoupper($fileExtension) }}</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
