<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Data ditampilkan untuk 30 hari terakhir.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{-- route('admin.settings') --}}" class="p-2 text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.438 1.001s.145.761.438 1.001l1.003.827c.424.35.534.954.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.217-.456c-.355-.133-.75-.072-1.075.124a6.57 6.57 0 01-.22.127c-.332.183-.582.495-.645.87l-.213 1.281c-.09.543-.56.94-1.11.94h-2.593c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.437-1.001s-.145-.761-.437-1.001l-1.004-.827a1.125 1.125 0 01-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.075-.124a6.553 6.553 0 01.22-.127c.332-.183.582-.495-.645-.87l.213-1.281z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </a>
                <a href="{{ route('admin.materi.create')}}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition-colors">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" /></svg>
                    <span>Tambah Materi</span>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- 1. Kartu Statistik dengan Grafik Mini -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    // Ganti dengan data asli. `trend` bisa 'up', 'down', atau 'neutral'.
                    $stats = [
                        ['title' => 'Pengguna Aktif', 'value' => '1,024', 'icon' => 'user-group', 'change' => '+5.2%', 'trend' => 'up'],
                        ['title' => 'Materi Dilihat', 'value' => '25,4k', 'icon' => 'eye', 'change' => '+12.1%', 'trend' => 'up'],
                        ['title' => 'Komentar Baru', 'value' => '128', 'icon' => 'chat-bubble-left-right', 'change' => '-1.5%', 'trend' => 'down'],
                        ['title' => 'Penjualan', 'value' => 'Rp 12,5 jt', 'icon' => 'currency-dollar', 'change' => 'Stabil', 'trend' => 'neutral'],
                    ];
                @endphp

                @foreach ($stats as $stat)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700/50">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-semibold text-gray-500 dark:text-gray-400">{{ $stat['title'] }}</h3>
                        @if ($stat['icon'] == 'user-group') <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m-7.14-4.08a3 3 0 10-5.73-2.774 3 3 0 005.73 2.774zM3.12 15.12a3 3 0 013.741-.479m6.84-2.592a9.094 9.094 0 013.741.479m-9.868-3.849a3 3 0 015.73-2.774 3 3 0 015.73 2.774m-5.73-2.774v-1.386a2.25 2.25 0 00-1.358-2.097L12 3.45m-2.25 6.086a2.25 2.25 0 00-1.358 2.097v1.386m0 0A2.25 2.25 0 0112 18.75h0a2.25 2.25 0 01-2.25-2.25v-1.386z" /></svg> @endif
                        @if ($stat['icon'] == 'eye') <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg> @endif
                        @if ($stat['icon'] == 'chat-bubble-left-right') <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193l-3.72 3.72a1.125 1.125 0 01-1.59 0l-3.72-3.72A1.125 1.125 0 013 16.894v-4.286c0-.97.616-1.813 1.5-2.097M16.5 9.75c0 .621-.504 1.125-1.125 1.125H8.625c-.621 0-1.125-.504-1.125-1.125v-1.5c0-.621.504-1.125 1.125-1.125h6.75c.621 0 1.125.504 1.125 1.125v1.5z" /></svg> @endif
                        @if ($stat['icon'] == 'currency-dollar') <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> @endif
                    </div>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $stat['value'] }}</p>
                    <div class="flex items-center gap-1 text-xs mt-2">
                        <span class="{{ $stat['trend'] === 'up' ? 'text-green-600' : ($stat['trend'] === 'down' ? 'text-red-600' : 'text-gray-500') }} flex items-center">
                            @if ($stat['trend'] === 'up') <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg> @endif
                            @if ($stat['trend'] === 'down') <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17l5-5m0 0l-5-5m5 5H6" /></svg> @endif
                            {{ $stat['change'] }}
                        </span>
                        <span class="text-gray-500 dark:text-gray-400">vs bulan lalu</span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- 2. Tabel Pengguna Terbaru dengan Filter & Aksi -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700/50">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Pengguna Terbaru</h3>
                        <div class="w-full md:w-auto flex items-center gap-3">
                            <input type="text" placeholder="Cari pengguna..." class="w-full md:w-64 p-2 text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 focus:ring-indigo-500 focus:border-indigo-500">
                            <a href="{{-- route('admin.users.index') --}}" class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:underline whitespace-nowrap">Lihat Semua</a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Materi Diikuti</th>
                                    <th scope="col" class="px-6 py-3">Bergabung</th>
                                    <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $users = [['name' => 'John Doe', 'email' => 'john@example.com', 'status' => 'Aktif', 'materi' => 12, 'join' => '20 Nov 2023'], ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'status' => 'Tidak Aktif', 'materi' => 2, 'join' => '18 Nov 2023'], ['name' => 'Peter Jones', 'email' => 'peter@example.com', 'status' => 'Aktif', 'materi' => 25, 'join' => '15 Nov 2023']];
                                @endphp
                                @foreach ($users as $user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=random" alt="">
                                            <div>
                                                <div class="font-semibold text-gray-900 dark:text-white">{{ $user['name'] }}</div>
                                                <div class="text-xs text-gray-500">{{ $user['email'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $user['status'] == 'Aktif' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300' }}">{{ $user['status'] }}</span>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-300">{{ $user['materi'] }}</td>
                                    <td class="px-6 py-4">{{ $user['join'] }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white"><svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>