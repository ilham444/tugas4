<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $materi->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Detail Materi -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold mb-2">{{ $materi->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Diupload pada {{ $materi->created_at->format('d F Y') }} dalam kategori <span class="font-semibold">{{ $materi->kategori->name }}</span>
                        </p>
                        <p class="mb-4">{{ $materi->description }}</p>
                        
                        <!-- Tampilan File (Contoh untuk PDF dan Video) -->
                        @php $fileExtension = pathinfo($materi->file_path, PATHINFO_EXTENSION); @endphp
                        @if(in_array($fileExtension, ['mp4', 'webm']))
                            <video controls class="w-full rounded-lg">
                                <source src="{{ Storage::url($materi->file_path) }}" type="video/mp4">
                                Browser Anda tidak mendukung tag video.
                            </video>
                        @elseif($fileExtension == 'pdf')
                            <iframe src="{{ Storage::url($materi->file_path) }}" class="w-full h-screen rounded-lg" frameborder="0"></iframe>
                        @else
                            <a href="{{ Storage::url($materi->file_path) }}" target="_blank" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Download/Lihat File
                            </a>
                        @endif
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700 my-6">

                    <!-- Bagian Komentar -->
                    <div>
                        <h4 class="text-xl font-bold mb-4">Diskusi / Komentar</h4>
                        
                        <!-- Form Tambah Komentar -->
                        <form action="{{ route('komentar.store') }}" method="POST" class="mb-6">
                            @csrf
                            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                            <textarea name="body" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-900 dark:border-gray-700 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Tulis komentar Anda di sini..." required></textarea>
                            <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Kirim Komentar
                            </button>
                        </form>

                        <!-- Daftar Komentar -->
                        <div class="space-y-4">
                            @forelse ($materi->komentars as $komentar)
                                <div class="flex space-x-3">
                                    <div class="flex-shrink-0">
                                        {{-- Placeholder untuk avatar --}}
                                        <div class="h-10 w-10 rounded-full bg-gray-400 dark:bg-gray-600 flex items-center justify-center font-bold text-white">
                                            {{ strtoupper(substr($komentar->user->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <div class="bg-gray-100 dark:bg-gray-700 rounded-lg px-4 py-2">
                                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $komentar->user->name }}</p>
                                            <p class="text-gray-800 dark:text-gray-200">{{ $komentar->body }}</p>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $komentar->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Belum ada komentar.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>