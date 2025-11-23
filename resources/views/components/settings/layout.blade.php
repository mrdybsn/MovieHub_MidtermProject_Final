<div class="flex h-full w-full p-6">
    <div class="flex flex-col md:flex-row gap-6 w-full">
        <!-- Settings Sidebar Navigation -->
        <div class="w-full md:w-64 shrink-0">
            <div class="rounded-xl bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 p-4 sticky top-6">
                <h3 class="text-lg font-bold text-white mb-4 px-2">Settings</h3>
                
                <nav class="space-y-1">
                    <a href="{{ route('settings.profile') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('settings.profile') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                       wire:navigate>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="font-medium">Profile</span>
                    </a>

                    <a href="{{ route('settings.password') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('settings.password') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                       wire:navigate>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span class="font-medium">Password</span>
                    </a>

                    <a href="{{ route('settings.appearance') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('settings.appearance') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                       wire:navigate>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        <span class="font-medium">Appearance</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="flex-1">
            <div class="rounded-xl bg-slate-800/50 backdrop-blur-sm border border-slate-700/50 p-8">
                @if(isset($heading))
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-white mb-2">{{ $heading }}</h1>
                        @if(isset($subheading))
                            <p class="text-slate-400">{{ $subheading }}</p>
                        @endif
                    </div>
                @endif

                <div class="w-full max-w-2xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>