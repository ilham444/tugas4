{{--
CATATAN PENGEMBANG:
- Menggunakan CSS Custom Properties (Variables) untuk tema warna yang konsisten.
- Menggunakan Alpine.js untuk interaktivitas filter kategori. Pastikan Alpine.js sudah terpasang di proyek Anda.
- Layout diubah menjadi 2 kolom di layar besar (lg) untuk pengalaman dashboard yang lebih baik.
- Menambahkan modul baru: "Lanjutkan Belajar", "Pencapaian Saya", dan Sidebar.
--}}

<x-app-layout>
    {{-- Mendefinisikan warna tema utama untuk kemudahan kustomisasi --}}
    <style>
        :root {
            --color-primary: 63 66 241;
            /* Indigo-600 */
            --color-primary-dark: 79 70 229;
            /* Indigo-500 */
        }

        .text-primary {
            color: rgb(var(--color-primary));
        }

        .bg-primary {
            background-color: rgb(var(--color-primary));
        }

        .border-primary {
            border-color: rgb(var(--color-primary));
        }

        .ring-primary {
            --tw-ring-color: rgb(var(--color-primary));
        }

        .hover\:bg-primary-dark:hover {
            background-color: rgb(var(--color-primary-dark));
        }

        .dark .text-primary {
            color: rgb(var(--color-primary-dark));
        }

        .dark .bg-primary {
            background-color: rgb(var(--color-primary-dark));
        }

        .dark .border-primary {
            border-color: rgb(var(--color-primary-dark));
        }

        .dark .ring-primary {
            --tw-ring-color: rgb(var(--color-primary-dark));
        }

        .dark .hover\:bg-primary-dark:hover {
            background-color: rgb(63 66 241);
        }

        /* Indigo-600 */
    </style>

    <div class="bg-gray-100 dark:bg-gray-900">
        {{-- Header disambut dengan Aksi Utama --}}
        <div class="bg-white dark:bg-gray-800/50 shadow-sm">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                        <p class="mt-1 text-gray-500 dark:text-gray-400">Selamat datang kembali,
                            {{ Auth::user()->name }}. Siap untuk belajar hal baru?
                        </p>
                    </div>
                    {{-- KARTU AKSI UTAMA: Lanjutkan Belajar --}}

                </div>
            </div>
        </div>

        <main class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <!-- Kolom Konten Utama (2/3) -->
                    <div class="lg:col-span-2 space-y-8">

                        <!-- Filter Kategori Interaktif -->
                        <div x-data="{ activeFilter: 'all' }"
                            class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="flex items-center gap-2 overflow-x-auto pb-2">
                                <button @click="activeFilter = 'all'"
                                    :class="activeFilter === 'all' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'"
                                    class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">Semua
                                    Materi</button>
                                @foreach($kategoris as $kategori)
                                    <button @click="activeFilter = '{{ $kategori->id }}'"
                                        :class="activeFilter === '{{ $kategori->id }}' ? 'bg-primary text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'"
                                        class="px-4 py-2 text-sm font-semibold rounded-lg transition-colors whitespace-nowrap">{{ $kategori->name }}</button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Daftar Materi -->
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Jelajahi Materi</h2>
                            @if($kategoris->isEmpty() || $kategoris->every(fn($kategori) => $kategori->moduls->isEmpty()))
                                {{-- Tampilan Kosong --}}
                                <div
                                    class="text-center py-20 px-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-200">Belum ada materi
                                        untuk ditampilkan</h3>
                                    <p class="mt-1 text-sm text-gray-500">Silakan cek kembali nanti atau hubungi
                                        administrator.</p>
                                </div>
                            @else
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        {{-- SKELETON LOADER (Tampilkan saat loading data) --}}
                                        {{-- @if($isLoading)
                                        @for ($i = 0; $i < 4; $i++) <div
                                            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-4 animate-pulse">
                                            <div class="h-40 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                                            <div class="mt-4 h-5 w-3/4 bg-gray-200 dark:bg-gray-700 rounded"></div>
                                            <div class="mt-2 h-4 w-1/2 bg-gray-200 dark:bg-gray-700 rounded"></div>
                                            <div class="mt-4 h-10 bg-gray-200 dark:bg-gray-700 rounded-lg"></div>
                                    </div>
                                    @endfor
                                    @endif --}}

                                    {{-- KARTU MATERI SEBENARNYA --}}
                                    @foreach($kategoris->pluck('moduls')->flatten() as $item)
                                        <div
                                            class="group flex flex-col bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                                            <a href="{{ route('user.materi.show', $item->slug) }}" class="block overflow-hidden">
                                                <!-- <img class="h-48 w-full object-cover transition-transform duration-500 ease-in-out group-hover:scale-110" src="https://source.unsplash.com/600x400/?{{ urlencode($item->kategori->name) }},technology,{{ rand(1, 100) }}" alt="">
                                                                                                                                                        </a> -->
                                                <div class="p-5 flex flex-col flex-grow">
                                                    <span
                                                        class="text-xs font-semibold text-primary uppercase tracking-wider mb-2">{{ $item->kategori->name }}</span>
                                                    <h4 class="font-bold text-lg text-gray-900 dark:text-white flex-grow">
                                                        {{ $item->title }}
                                                    </h4>
                                                    {{-- Meta Data --}}
                                                    <div
                                                        class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-4 mb-5 space-x-4">
                                                        <div class="flex items-center gap-1.5"><svg class="h-4 w-4" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg> @estimasi($item->estimated) </div>
                                                        <div class="flex items-center gap-1.5"><svg class="h-4 w-4" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                                            </svg> 15 Pelajaran</div>
                                                        <div class="flex items-center gap-1.5"><svg class="h-4 w-4" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                                                </path>
                                                            </svg> Menengah</div>
                                                    </div>
                                                    <a href="{{ route('user.materi.show', $item->slug) }}"
                                                        class="mt-auto w-full text-center bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-300">
                                                        Lihat Materi
                                                    </a>
                                                </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                    </div>

                </div>

                <!-- Kolom Sidebar (1/3) -->
                <aside class="space-y-8">
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Pencapaian Saya</h3>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            @php $achievements = [['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'name' => 'Pemula Cepat'], ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'name' => '10 Materi Selesai'], ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-12v4m-2-2h4m6 4v4m-2-2h4M17 3l-1.17.59a2 2 0 00-1.66 1.66L14 7m-2 10l-1.17.59a2 2 0 01-1.66 1.66L9 21m-4-8l.59-1.17a2 2 0 011.66-1.66L9 10m10-2l.59-1.17a2 2 0 00-1.66-1.66L17 3', 'name' => 'Ahli Frontend']]; @endphp
                            @foreach($achievements as $ach)
                                <div>
                                    <div
                                        class="mx-auto bg-amber-100 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400 w-14 h-14 rounded-full flex items-center justify-center">
                                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                            stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $ach['icon'] }}">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-xs mt-2 text-gray-500 dark:text-gray-400">{{ $ach['name'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </aside>

            </div>
    </div>
    </main>
    </div>
</x-app-layout>
