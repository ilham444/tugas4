{{-- File: resources/views/layouts/navigation.blade.php (Perbaikan) --}}

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            {{-- Bagian Kiri: Logo & Link Navigasi Utama --}}
            <div class="flex items-center gap-6">
                {{-- Logo --}}
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 flex-shrink-0">
                    <x-application-logo class="block h-9 w-auto fill-current text-indigo-600 dark:text-indigo-400" />
                    <span class="font-bold text-lg text-indigo-700 dark:text-indigo-300 hidden md:inline">EduPlatform</span>
                </a>

                {{-- Navigation Links (Desktop) --}}
                <div class="hidden sm:flex space-x-6 items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')">
                        📊 {{ __('Dashboard') }}
                    </x-nav-link>

                    {{-- Tampilkan menu ini HANYA untuk Admin --}}
                    @if(auth()->user()->role === 'admin')
                        <x-nav-link :href="route('admin.modul.index')" :active="request()->routeIs('admin.modul.*')">
                            📚 {{ __('Manajemen Modul') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')">
                            🗂️ {{ __('Manajemen Kategori') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.questions.index')" :active="request()->routeIs('admin.questions.*')">
                            ✍️ {{ __('Manajemen Quiz') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.quiz_results.index')" :active="request()->routeIs('admin.quiz_results.index')">
                            🏆 {{ __('Hasil Quiz') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            {{-- Bagian Kanan: Dropdown Pengaturan Pengguna (Desktop) --}}
            <div class="hidden sm:flex items-center space-x-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center px-3 py-2 text-sm font-medium rounded-md text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">👤 {{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                🔓 {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Responsive Navigation Menu (Mobile) --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard')">
                📊 {{ __('Dashboard') }}
            </x-responsive-nav-link>

            {{-- Tampilkan menu ini HANYA untuk Admin (Responsive) --}}
            @if(auth()->user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.modul.index')" :active="request()->routeIs('admin.modul.*')">
                    📚 {{ __('Manajemen Modul') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.kategori.index')" :active="request()->routeIs('admin.kategori.*')">
                    🗂️ {{ __('Manajemen Kategori') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.questions.index')" :active="request()->routeIs('admin.questions.*')">
                    ✍️ {{ __('Manajemen Quiz') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.quiz_results.index')" :active="request()->routeIs('admin.quiz_results.index')">
                    🏆 {{ __('Hasil Quiz') }}
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- Responsive Settings Options --}}
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">👤 {{ __('Profile') }}</x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        🔓 {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>