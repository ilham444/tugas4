<x-app-layout>
    <x-slot name="header">
        {{-- Header sudah sangat bagus, tidak ada perubahan di sini --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Manajemen Modul') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola, filter, dan cari semua modul di platform.</p>
            </div>
            <a href="{{ route('admin.modul.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-all duration-200 hover:shadow-lg hover:-translate-y-px">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                <span>Tambah Modul</span>
            </a>
        </div>
    </x-slot>

    {{-- Notifikasi Toast (pertahankan, ini sudah bagus) --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.enter.duration.300ms x-transition.leave.duration.300ms class="fixed top-24 right-5 bg-green-500 text-white py-2 px-4 rounded-xl text-sm shadow-lg z-50">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200 dark:border-gray-700/50">
                <div class="p-6 md:p-8 space-y-6">
                    
                    {{-- Panel Kontrol (Filter & Pencarian) --}}
                    {{-- [POLISH] Memberi sedikit padding bawah dan garis pemisah untuk hirarki yang lebih jelas --}}
                    <div class="pb-6 border-b border-gray-200 dark:border-gray-700">
                        <form action="{{ route('admin.modul.index') }}" method="GET">
                            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                                <div class="w-full md:w-1/2 lg:w-2/5">
                                    <label for="search" class="sr-only">Cari</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"><svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.25a5.75 5.75 0 100 11.5 5.75 5.75 0 000-11.5zM1.5 9a7.5 7.5 0 1113.346 4.422l3.403 3.402a.75.75 0 11-1.06 1.06l-3.403-3.402A7.5 7.5 0 011.5 9z" clip-rule="evenodd" /></svg></div>
                                        <input type="text" name="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500 transition-all" placeholder="Cari berdasarkan judul..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <label for="kategori" class="text-sm font-medium text-gray-700 dark:text-gray-300">Kategori:</label>
                                    <select name="kategori" id="kategori" class="text-sm rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500" onchange="this.form.submit()">
                                        <option value="">Semua</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" @selected(request('kategori') == $kategori->id)>{{ $kategori->name }}</option> 
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Data Modul -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            {{-- [POLISH] Memberi background pada header tabel agar lebih menonjol --}}
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th scope="col" class="w-5/12 px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Judul</th>
                                    <th scope="col" class="w-2/12 px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Kategori</th>
                                    <th scope="col" class="w-2/12 px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Detail</th>
                                    <th scope="col" class="w-2/12 px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Dibuat</th>
                                    <th scope="col" class="w-1/12 relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($moduls as $item)
                                    {{-- [POLISH] Menambahkan transisi yang lebih halus dan efek 'lift' saat hover --}}
                                    <tr class="group relative transition-all duration-200 ease-in-out hover:shadow-md hover:bg-gray-50 dark:hover:bg-gray-900/50 hover:-translate-y-px">
                                        <td class="px-6 py-4 align-middle">
                                            <a href="{{ route('admin.modul.materi.index', $item) }}" class="absolute inset-0 z-0"></a>
                                            <div class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                {{ $item->title }}
                                            </div>
                                            <div class="text-sm text-gray-500 mt-1 truncate">{{ $item->description }}</div>
                                        </td>
                                        <td class="px-6 py-4 align-middle">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                                {{ $item->kategori->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 align-middle">
                                            <div class="flex items-center gap-2">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <span>{{ $item->estimated }} menit</span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" /></svg>
                                                <span>{{ $item->materis->count() }} materi</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 align-middle">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right align-middle">
                                            <div x-data="{ open: false, deleting: false }" class="relative z-10">
                                                <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-800 dark:hover:text-white hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full transition-colors">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                                                </button>
                                                {{-- [POLISH] Dropdown sekarang muncul dengan animasi 'pop' dan ikon ditambahkan di setiap item --}}
                                                <div x-show="open" @click.away="open = false" 
                                                     x-transition:enter="transition ease-out duration-100"
                                                     x-transition:enter-start="transform opacity-0 scale-95"
                                                     x-transition:enter-end="transform opacity-100 scale-100"
                                                     x-transition:leave="transition ease-in duration-75"
                                                     x-transition:leave-start="transform opacity-100 scale-100"
                                                     x-transition:leave-end="transform opacity-0 scale-95"
                                                     x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 ring-1 ring-black ring-opacity-5 z-20 text-left">
                                                    <a href="{{ route('admin.modul.materi.index', $item) }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"><svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" /></svg>Materi</a>
                                                    <a href="{{ route('admin.modul.edit', $item) }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"><svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" /></svg>Edit</a>
                                                    <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                                                    <button @click="deleting = true; open = false" class="flex items-center gap-3 w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors"><svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>Hapus</button>
                                                </div>
                                                {{-- Modal Konfirmasi Hapus (sudah sangat bagus) --}}
                                                <div x-show="deleting" x-cloak x-transition.opacity ...>...</div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>...</tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($moduls->hasPages())
                        {{-- [POLISH] Memberi pembatas atas untuk memisahkan paginasi dari tabel --}}
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            {{ $moduls->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>