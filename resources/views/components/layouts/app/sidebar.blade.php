<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gradient-to-br from-[#1A1539] via-[#2C2654] to-[#1A1539]">
        <!-- Animated Background -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-[#7B68A8] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#9B7BB5] rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse delay-1000"></div>
        </div>

        <flux:sidebar sticky stashable class="border-e border-[#4A3F73]/50 bg-[#1A1539]/80 backdrop-blur-xl">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-4 mb-4" wire:navigate>
                <div class="w-10 h-10 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                    </svg>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-[#9B7BB5] to-white bg-clip-text text-transparent">MovieHub</span>
            </a>

            <!-- Navigation -->
            <flux:navlist variant="outline" class="px-4">
                <flux:navlist.group :heading="__('Platform')" class="grid gap-1">
                    <flux:navlist.item 
                        icon="home" 
                        :href="route('dashboard')" 
                        :current="request()->routeIs('dashboard')" 
                        wire:navigate
                        class="rounded-lg transition-all hover:bg-[#7B68A8]/10 data-[current]:bg-gradient-to-r data-[current]:from-[#9B7BB5] data-[current]:to-[#7B68A8] data-[current]:text-white">
                        {{ __('Dashboard') }}
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="tag"
                        :href="route('genres.index')"
                        :current="request()->routeIs('genres.*')"
                        wire:navigate
                        class="rounded-lg transition-all hover:bg-[#7B68A8]/10 data-[current]:bg-gradient-to-r data-[current]:from-[#9B7BB5] data-[current]:to-[#7B68A8] data-[current]:text-white">
                        {{ __('Genres') }}
                    </flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <!-- Footer Links -->
            <flux:navlist variant="outline" class="px-4">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="rounded-lg hover:bg-[#2C2654]/50 transition-colors text-gray-400 hover:text-gray-200">
                    {{ __('Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="rounded-lg hover:bg-[#2C2654]/50 transition-colors text-gray-400 hover:text-gray-200">
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <div class="hidden lg:block px-4 pt-4 border-t border-[#4A3F73]/50">
                <flux:dropdown position="top" align="start">
                    <button class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-[#2C2654]/50 transition-colors">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center font-semibold text-white shadow-lg">
                            {{ auth()->user()->initials() }}
                        </div>
                        <div class="flex-1 text-left">
                            <div class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gray-300 truncate">{{ auth()->user()->email }}</div>
                        </div>
                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <flux:menu class="w-[220px] !bg-white dark:!bg-[#1A1539] border border-gray-200 dark:border-[#4A3F73] rounded-lg overflow-hidden shadow-xl">
                        <div class="p-3 border-b border-gray-200 dark:border-[#4A3F73] bg-gray-50 dark:bg-[#2C2654]/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center font-semibold text-white">
                                    {{ auth()->user()->initials() }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ auth()->user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        <flux:menu.item href="{{ route('settings.profile') }}" icon="cog" wire:navigate class="hover:bg-gray-100 dark:hover:bg-[#4A3F73]/50 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                            {{ __('Settings') }}
                        </flux:menu.item>

                        <div class="border-t border-gray-200 dark:border-[#4A3F73] my-1"></div>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full hover:bg-red-50 dark:hover:bg-red-500/10 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                                {{ __('Log Out') }}
                            </flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            </div>
        </flux:sidebar>

        <!-- Mobile Header -->
        <flux:header class="lg:hidden bg-[#1A1539]/80 backdrop-blur-xl border-b border-[#4A3F73]/50">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                    </svg>
                </div>
                <span class="text-lg font-bold bg-gradient-to-r from-[#9B7BB5] to-white bg-clip-text text-transparent">MovieHub</span>
            </div>

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <button class="flex items-center gap-2 p-2 rounded-lg hover:bg-[#2C2654]/50 transition-colors">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center font-semibold text-white text-sm">
                        {{ auth()->user()->initials() }}
                    </div>
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <flux:menu class="!bg-white dark:!bg-[#1A1539] border border-gray-200 dark:border-[#4A3F73] rounded-lg overflow-hidden shadow-xl">
                    <div class="p-3 border-b border-gray-200 dark:border-[#4A3F73] bg-gray-50 dark:bg-[#2C2654]/50">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center font-semibold text-white">
                                {{ auth()->user()->initials() }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-600 dark:text-gray-400 truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>

                    <flux:menu.item href="{{ route('settings.profile') }}" icon="cog" wire:navigate class="hover:bg-gray-100 dark:hover:bg-[#4A3F73]/50 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">
                        {{ __('Settings') }}
                    </flux:menu.item>

                    <div class="border-t border-gray-200 dark:border-[#4A3F73] my-1"></div>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full hover:bg-red-50 dark:hover:bg-red-500/10 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>