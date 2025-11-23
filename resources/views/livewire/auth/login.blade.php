<x-layouts.auth>
    <div class="flex flex-col gap-6">
        <!-- Header -->
        <div class="text-center mb-2">
            <a href="/" class="inline-block mb-4 group">
                <div class="w-16 h-16 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-2xl flex items-center justify-center shadow-2xl shadow-[#9B7BB5]/30 group-hover:shadow-[#9B7BB5]/50 transition-all duration-300 group-hover:scale-110">
                    <svg class="w-9 h-9 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                    </svg>
                </div>
            </a>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-[#9B7BB5] to-white bg-clip-text text-transparent mb-2">
                {{ __('Welcome Back') }}
            </h1>
            <p class="text-gray-400">{{ __('Enter your email and password below to log in') }}</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="rounded-xl bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-500/20 p-4 backdrop-blur-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-green-300 font-medium text-sm">{{ session('status') }}</span>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                    {{ __('Email address') }}
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="email@example.com"
                    class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all"
                >
                @error('email')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="block text-sm font-medium text-gray-300">
                        {{ __('Password') }}
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#9B7BB5] hover:text-[#7B68A8] transition-colors" wire:navigate>
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        required
                        autocomplete="current-password"
                        placeholder="{{ __('Password') }}"
                        class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 pr-12 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all"
                    >
                    <button 
                        type="button" 
                        onclick="togglePassword()"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-300 transition-colors"
                    >
                        <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <label class="flex items-center gap-3 cursor-pointer group">
                <div class="relative">
                    <input 
                        type="checkbox" 
                        name="remember" 
                        id="remember"
                        {{ old('remember') ? 'checked' : '' }}
                        class="peer sr-only"
                    >
                    <div class="w-5 h-5 border-2 border-[#4A3F73] rounded group-hover:border-[#7B68A8] peer-checked:border-[#9B7BB5] peer-checked:bg-[#9B7BB5] transition-all flex items-center justify-center">
                        <svg class="w-3 h-3 text-white hidden peer-checked:block" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <span class="text-sm text-gray-300 group-hover:text-white transition-colors">
                    {{ __('Remember me') }}
                </span>
            </label>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full mt-2 px-8 py-3 bg-gradient-to-r from-[#9B7BB5] to-[#7B68A8] hover:from-[#7B68A8] hover:to-[#5B4D87] rounded-lg font-semibold text-white transition-all duration-300 shadow-lg hover:shadow-[#9B7BB5]/50 hover:scale-[1.02] flex items-center justify-center gap-2"
                data-test="login-button"
            >
                <span>{{ __('Log in') }}</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>
        </form>

        @if (Route::has('register'))
            <div class="text-center">
                <span class="text-sm text-gray-400">{{ __("Don't have an account?") }}</span>
                <a href="{{ route('register') }}" class="text-sm text-[#9B7BB5] hover:text-[#7B68A8] font-medium transition-colors ml-1" wire:navigate>
                    {{ __('Sign up') }}
                </a>
            </div>
        @endif
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeOffIcon = document.getElementById('eye-off-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeOffIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeOffIcon.classList.add('hidden');
            }
        }

        // Auto-hide status message after 5 seconds
        const statusMessage = document.querySelector('[class*="from-green-500"]');
        if (statusMessage) {
            setTimeout(() => {
                statusMessage.style.transition = 'opacity 0.5s';
                statusMessage.style.opacity = '0';
                setTimeout(() => statusMessage.remove(), 500);
            }, 5000);
        }
    </script>
</x-layouts.auth>