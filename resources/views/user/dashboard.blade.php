<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Materi Pembelajaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- FORM PENCARIAN -->
            <div class="mb-6">
                <form action="{{ route('user.dashboard') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Cari judul materi..." 
                            class="w-full p-3 pl-10 rounded-lg border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" 
                            value="{{ request('search') }}">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>
            <!-- AKHIR FORM PENCARIAN -->

            @if($kategoris->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Belum ada materi yang tersedia saat ini.
                    </div>
                </div>
            @else
                @foreach($kategoris as $kategori)
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">{{ $kategori->name }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($kategori->materis as $item)
                                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                                    <div class="p-6">
                                        <h4 class="font-bold text-xl mb-2 text-gray-900 dark:text-gray-100">{{ $item->title }}</h4>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4 h-20 overflow-hidden">{{ Str::limit($item->description, 100) }}</p>
                                        <a href="{{ route('user.materi.show', $item) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 dark:text-gray-400">Tidak ada materi dalam kategori ini.</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>
