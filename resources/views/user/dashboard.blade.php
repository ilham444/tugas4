<x-app-layout>
    {{-- Definisi Variabel Warna Tema (Sudah Bagus, tidak ada perubahan) --}}
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

    <div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
        {{-- [REFINED] SECTION: Header Halaman dengan Aksi Tambahan --}}
        <header class="bg-white dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700/50 shadow-sm">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3">
                             <div class="bg-primary/10 p-2 rounded-lg">
                                <svg class="h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h7.5" /></svg>
                             </div>
                            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white">Dashboard</h1>
                        </div>
                        <p class="mt-2 text-md text-gray-600 dark:text-gray-400">
                            Selamat datang kembali, <span class="font-semibold text-primary">{{ Auth::user()->name }}</span>!
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="#materi-list" class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark text-white font-semibold py-2 px-4 rounded-lg transition-colors shadow-sm">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                            Mulai Belajar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                    {{-- Kolom Konten Utama (Materi) --}}
                    <div class="lg:col-span-2 space-y-8" x-data="{ activeFilter: 'all' }" id="materi-list">

                        {{-- Judul dan Filter yang lebih rapi --}}
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Jelajahi Materi</h2>
                            <div class="flex items-center gap-2 overflow-x-auto pb-2 -mb-2">
                                <button @click="activeFilter = 'all'"
                                    :class="activeFilter === 'all' ? 'bg-primary text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'"
                                    class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">
                                    Semua
                                </button>
                                @foreach($kategoris as $kategori)
                                    <button @click="activeFilter = '{{ $kategori->id }}'"
                                        :class="activeFilter === '{{ $kategori->id }}' ? 'bg-primary text-white shadow-sm' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700'"
                                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">
                                        {{ $kategori->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Daftar Materi -->
                        @if($kategoris->isEmpty() || $kategoris->every(fn($kategori) => $kategori->moduls->isEmpty()))
                            {{-- Tampilan Jika Tidak Ada Materi (Sudah Bagus) --}}
                            <div class="text-center py-20 px-6 bg-white dark:bg-gray-800 rounded-xl border border-dashed border-gray-300 dark:border-gray-700">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-200">Belum Ada Materi</h3>
                                <p class="mt-1 text-sm text-gray-500">Materi baru akan segera ditambahkan. Silakan cek kembali nanti.</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($kategoris->pluck('moduls')->flatten() as $item)
                                    {{-- Kartu Materi (Sudah Bagus, sedikit penyesuaian spasi) --}}
                                    <div x-show="activeFilter === 'all' || activeFilter === '{{ $item->kategori->id }}'"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         class="group flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                                        <div class="overflow-hidden">
                                            <img src="{{ $item->thumbnail ? Storage::url($item->thumbnail) : 'https://via.placeholder.com/400x200.png?text=EduPlatform' }}" alt="{{ $item->title }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300 ease-in-out">
                                        </div>
                                        <div class="p-5 flex flex-col flex-grow">
                                            <span class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">{{ $item->kategori->name }}</span>
                                            <h4 class="font-bold text-lg text-gray-900 dark:text-white flex-grow group-hover:text-primary transition-colors">{{ $item->title }}</h4>
                                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mt-4 mb-5 space-x-4">
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
                        {{-- [UPGRADE] Menggabungkan Kartu Kuis dan Latihan menjadi satu --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Uji Pengetahuan</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">Asah pemahaman Anda melalui kuis umum atau latihan spesifik per topik.</p>

                            {{-- Kuis Umum (dari kartu gradien sebelumnya) --}}
                            <a href="{{ route('quiz.start') }}" class="group flex items-center justify-center gap-2 w-full text-center px-4 py-3 bg-indigo-500 hover:bg-indigo-600 text-white font-semibold rounded-lg transition-colors mb-5">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.25 22.5l-.648-1.938a3.375 3.375 0 00-2.6-2.6L11.25 18l1.938-.648a3.375 3.375 0 002.6-2.6L16.25 13l.648 1.938a3.375 3.375 0 002.6 2.6l1.938.648-1.938.648a3.375 3.375 0 00-2.6 2.6z" /></svg>
                                Ikuti Kuis Umum
                            </a>

                            <hr class="border-gray-200 dark:border-gray-700">

                            {{-- Daftar Latihan Spesifik --}}
                            <div class="mt-5 space-y-3">
                                @forelse($latihans as $latihan)
                                    <a href="{{ route('latihan.show', $latihan->id) }}"
                                       class="group block p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-primary dark:hover:border-primary-dark hover:bg-indigo-50 dark:hover:bg-gray-700/50 transition-all duration-300">
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-3">
                                                <svg class="h-5 w-5 text-gray-400 group-hover:text-primary transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                                                <div>
                                                    <p class="font-semibold text-gray-800 dark:text-gray-200 group-hover:text-primary transition-colors">{{ $latihan->judul }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $latihan->soals_count }} Soal</p>
                                                </div>
                                            </div>
                                            <svg class="h-5 w-5 text-gray-400 group-hover:text-primary transition-all duration-300 transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center py-4 px-3 text-sm text-gray-500 dark:text-gray-400">
                                        Saat ini belum ada latihan spesifik yang tersedia.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- [UPGRADE] Kartu Info: Pencapaian Saya dengan contoh implementasi --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Pencapaian Saya</h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Materi Selesai</span>
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">3 dari 4 Modul</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-primary h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Poin Belajar</span>
                                        <span class="text-sm font-bold text-primary">1,250 Poin</span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Terus kumpulkan poin dengan menyelesaikan materi dan kuis!</p>
                                </div>
                            </div>
                        </div>
                    </aside>

                </div>
            </div>
        </main>
    </div>
</x-app-layout>