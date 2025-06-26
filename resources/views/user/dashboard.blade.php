<x-app-layout>
    {{-- Definisi Variabel Warna Tema (Sudah Bagus) --}}
    <style>
        :root {
            --color-primary: 63 66 241;      /* Indigo-600 */
            --color-primary-dark: 79 70 229;  /* Indigo-500 */
        }
        .text-primary { color: rgb(var(--color-primary)); }
        .bg-primary { background-color: rgb(var(--color-primary)); }
        .border-primary { border-color: rgb(var(--color-primary)); }
        .ring-primary { --tw-ring-color: rgb(var(--color-primary)); }
        .hover\:bg-primary-dark:hover { background-color: rgb(var(--color-primary-dark)); }

        .dark .text-primary { color: rgb(var(--color-primary-dark)); }
        .dark .bg-primary { background-color: rgb(var(--color-primary-dark)); }
        .dark .border-primary { border-color: rgb(var(--color-primary-dark)); }
        .dark .ring-primary { --tw-ring-color: rgb(var(--color-primary-dark)); }
        .dark .hover\:bg-primary-dark:hover { background-color: rgb(63 66 241); }
    </style>

    <div class="bg-gray-100 dark:bg-gray-900 min-h-screen">
        {{-- [UPGRADE] SECTION: Header Halaman yang Lebih Dinamis --}}
        <header class="bg-gradient-to-br from-indigo-50 dark:from-gray-800 to-white dark:to-gray-800/50 shadow-sm">
            <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                        <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                            Selamat datang kembali, <span class="font-semibold text-primary">{{ Auth::user()->name }}</span>. Siap untuk belajar hal baru?
                        </p>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- Kolom Konten Utama (Materi) --}}
                    <div class="lg:col-span-2 space-y-8" x-data="{ activeFilter: 'all' }">

                        {{-- [UPGRADE] Judul dan Filter dalam satu baris untuk efisiensi ruang --}}
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Jelajahi Materi</h2>
                            <div class="flex items-center gap-2 overflow-x-auto pb-2 -mb-2">
                                <button @click="activeFilter = 'all'"
                                    :class="activeFilter === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'"
                                    class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">
                                    Semua
                                </button>
                                @foreach($kategoris as $kategori)
                                    <button @click="activeFilter = '{{ $kategori->id }}'"
                                        :class="activeFilter === '{{ $kategori->id }}' ? 'bg-primary text-white shadow-sm' : 'bg-white dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'"
                                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">
                                        {{ $kategori->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Daftar Materi -->
                        @if($kategoris->isEmpty() || $kategoris->every(fn($kategori) => $kategori->moduls->isEmpty()))
                            {{-- Tampilan Jika Tidak Ada Materi --}}
                            <div class="text-center py-20 px-6 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-200">Belum Ada Materi</h3>
                                <p class="mt-1 text-sm text-gray-500">Materi baru akan segera ditambahkan. Silakan cek kembali nanti.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($kategoris->pluck('moduls')->flatten() as $item)
                                    {{-- [UPGRADE] Kartu Materi dengan Desain yang Lebih Menarik --}}
                                    <div x-show="activeFilter === 'all' || activeFilter === '{{ $item->kategori->id }}'" 
                                         x-transition:enter="transition ease-out duration-300" 
                                         x-transition:enter-start="opacity-0 transform scale-95" 
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         class="group flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                                        
                                        {{-- Thumbnail dengan efek zoom on hover --}}
                                        <div class="overflow-hidden">
                                            <img src="{{ $item->thumbnail ? Storage::url($item->thumbnail) : 'https://via.placeholder.com/400x200.png?text=EduPlatform' }}" alt="{{ $item->title }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                                        </div>
                                        
                                        <div class="p-5 flex flex-col flex-grow">
                                            <span class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">{{ $item->kategori->name }}</span>
                                            <h4 class="font-bold text-lg text-gray-900 dark:text-white flex-grow group-hover:text-primary transition-colors">{{ $item->title }}</h4>
                                            
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-4 mb-5 space-x-4">
                                                <div class="flex items-center gap-1.5" title="Estimasi Waktu"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> @estimasi($item->estimated)</div>
                                                <div class="flex items-center gap-1.5" title="Jumlah Materi"><svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg> {{ $item->materis->count() }} Materi</div>
                                            </div>

                                            <a href="{{ route('user.modul.show', $item->slug) }}" class="mt-auto w-full text-center bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-300">Mulai Belajar</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Kolom Sidebar (Aksi dan Info Tambahan) --}}
                    <aside class="space-y-8 lg:sticky lg:top-24">
                        {{-- [UPGRADE] Kartu Quiz dengan Desain Gradien yang Menarik --}}
                        <div class="relative overflow-hidden p-6 rounded-xl shadow-sm bg-gradient-to-br from-indigo-500 to-purple-600 text-white">
                            <h3 class="text-lg font-bold mb-2">Uji Pengetahuan Anda</h3>
                            <p class="text-sm opacity-80 mb-4">Tes pemahaman Anda dengan mengikuti kuis singkat.</p>
                            <a href="{{ route('quiz.start') }}" class="inline-block w-full text-center px-4 py-2 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg backdrop-blur-sm transition-colors">
                                Mulai Kuis Sekarang!
                            </a>
                        </div>
                        
                        {{-- Kartu Info: Pencapaian Saya (Kode Asli Sudah Bagus) --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">...</div>
                    </aside>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>