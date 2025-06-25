<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Manajemen Modul') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Kelola, filter, dan cari semua modul di platform.</p>
            </div>
            <a href="{{ route('admin.modul.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                </svg>
                <span>Tambah Modul</span>
            </a>
        </div>
    </x-slot>

    {{-- Notifikasi Toast (pertahankan, ini sudah bagus) --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition class="fixed top-24 right-5 bg-green-500 text-white py-2 px-4 rounded-xl text-sm shadow-lg z-50">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-2xl border border-gray-200 dark:border-gray-700/50">
                <div class="p-6 md:p-8 space-y-6">
                    <!-- Panel Kontrol Tabel (Filter & Pencarian) -->
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="w-full md:w-1/2 lg:w-2/5">
                            <label for="search" class="sr-only">Cari</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.25a5.75 5.75 0 100 11.5 5.75 5.75 0 000-11.5zM1.5 9a7.5 7.5 0 1113.346 4.422l3.403 3.402a.75.75 0 11-1.06 1.06l-3.403-3.402A7.5 7.5 0 011.5 9z" clip-rule="evenodd" /></svg>
                                </div>
                                <input type="text" name="search" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Cari berdasarkan judul...">
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <label for="kategori-filter" class="text-sm font-medium text-gray-700 dark:text-gray-300">Kategori:</label>
                            <select id="kategori-filter" class="text-sm rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Semua</option>
                                {{-- @foreach($kategoris as $kategori) <option value="{{ $kategori->id }}">{{ $kategori->name }}</option> @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <!-- Tabel Data Modul -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-gray-200 dark:border-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Judul</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Detail</th>
                                    <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">Dibuat</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($moduls as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-900/50 transition-colors">
                                        <td class="px-6 py-4 align-top">
                                            <a href="{{ route('admin.modul.materi.index', $item) }}" class="group">
                                                <div class="text-base font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                                                    {{ $item->title }}
                                                </div>
                                                <div class="text-sm text-gray-500 mt-1">{{ Str::limit($item->description, 60) }}</div>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 align-top">
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300">
                                                {{ $item->kategori->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300 align-top">
                                            <div class="flex items-center gap-2">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                <span>{{ $item->estimated }} menit</span>
                                            </div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" /></svg>
                                                <span>{{ $item->materis->count() }} materi</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 align-top">
                                            {{ $item->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right align-top">
                                            <div x-data="{ open: false, deleting: false }" class="relative">
                                                <button @click="open = !open" class="p-2 text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full transition">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>
                                                </button>
                                                {{-- Dropdown Menu Aksi --}}
                                                <div x-show="open" @click.away="open = false" x-transition x-cloak class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-1 ring-1 ring-black ring-opacity-5 z-20 text-left">
                                                    <a href="{{ route('admin.modul.materi.index', $item) }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Materi</a>
                                                    <a href="{{ route('admin.modul.edit', $item) }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Edit</a>
                                                    <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>
                                                    <button @click="deleting = true; open = false" class="flex items-center gap-3 w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">Hapus</button>
                                                </div>

                                                {{-- Modal Konfirmasi Hapus --}}
                                                <div x-show="deleting" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
                                                    <div @click.away="deleting = false" class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8 max-w-md w-full">
                                                        <div class="text-center">
                                                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                                                                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126z" /></svg>
                                                            </div>
                                                            <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">Konfirmasi Penghapusan</h3>
                                                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">Anda yakin ingin menghapus modul <span class="font-semibold">"{{ $item->title }}"</span>? Tindakan ini tidak dapat diurungkan.</p>
                                                        </div>
                                                        <div class="mt-6 grid grid-cols-2 gap-4">
                                                            <button @click="deleting = false" type="button" class="w-full px-4 py-2.5 text-sm font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">Batal</button>
                                                            <form action="{{ route('admin.modul.destroy', $item) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="w-full px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Ya, Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-24 text-center">
                                            <div class="flex flex-col items-center max-w-sm mx-auto">
                                                <svg class="h-16 w-16 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" /></svg>
                                                <h3 class="mt-4 text-lg font-semibold text-gray-800 dark:text-gray-200">Tidak Ada Data Modul</h3>
                                                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan modul baru untuk menampilkannya di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginasi -->
                    @if ($moduls->hasPages())
                        <div class="mt-2">
                            {{ $moduls->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>