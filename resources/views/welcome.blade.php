<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MovieHub - Your Ultimate Movie Management System</title>
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700,800" rel="stylesheet" />
        
        <style>
            @layer base {
                * { box-sizing: border-box; margin: 0; padding: 0; }
                body { 
                    font-family: 'Inter', system-ui, sans-serif;
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                }
                h1, h2, h3 { font-family: 'Poppins', sans-serif; }
            }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'movie-purple-light': '#9B7BB5',
                            'movie-purple': '#7B68A8',
                            'movie-purple-dark': '#5B4D87',
                            'movie-indigo': '#4A3F73',
                            'movie-navy': '#2C2654',
                            'movie-navy-dark': '#1A1539',
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-gradient-to-br from-movie-navy-dark via-movie-navy to-movie-indigo text-white min-h-screen">
        <!-- Animated Background -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-movie-purple rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-movie-purple-light rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-movie-purple-dark rounded-full mix-blend-multiply filter blur-3xl opacity-25 animate-pulse delay-500"></div>
        </div>

        <header class="relative z-10 w-full max-w-7xl mx-auto px-6 pt-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-movie-purple-light to-movie-purple rounded-lg flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-movie-purple-light to-white bg-clip-text text-transparent">MovieHub</span>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-gradient-to-r from-movie-purple to-movie-purple-dark hover:from-movie-purple-dark hover:to-movie-indigo rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-movie-purple/50 hover:scale-105">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-300 hover:text-white transition-colors duration-300">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-movie-purple to-movie-purple-dark hover:from-movie-purple-dark hover:to-movie-indigo rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-movie-purple/50 hover:scale-105">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            @endif
        </header>

        <main class="relative z-10 flex items-center justify-center min-h-[calc(100vh-100px)] px-6">
            <div class="max-w-6xl w-full grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-movie-purple/20 backdrop-blur-sm border border-movie-purple/30 rounded-full">
                        <div class="w-2 h-2 bg-movie-purple-light rounded-full animate-pulse"></div>
                        <span class="text-sm text-movie-purple-light">Your Ultimate Movie Management Platform</span>
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                        Organize Your
                        <span class="block bg-gradient-to-r from-movie-purple-light via-white to-movie-purple-light bg-clip-text text-transparent animate-gradient">
                            Movie Collection
                        </span>
                    </h1>
                    
                    <p class="text-xl text-gray-300 leading-relaxed">
                        Discover, manage, and catalog your favorite films with MovieHub. 
                        The modern way to keep track of your cinematic journey.
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('login') }}" class="group px-8 py-4 bg-gradient-to-r from-movie-purple to-movie-purple-dark hover:from-movie-purple-dark hover:to-movie-indigo rounded-xl font-semibold transition-all duration-300 shadow-2xl hover:shadow-movie-purple/50 hover:scale-105 flex items-center gap-2">
                            Start Managing Movies
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        
                        <a href="https://laravel.com/docs" target="_blank" class="px-8 py-4 bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 rounded-xl font-semibold transition-all duration-300 hover:scale-105">
                            Learn More
                        </a>
                    </div>

                    <!-- Feature Pills -->
                    <div class="flex flex-wrap gap-3 pt-4">
                        <div class="px-4 py-2 bg-white/5 backdrop-blur-sm rounded-full border border-white/10 flex items-center gap-2">
                            <svg class="w-4 h-4 text-movie-purple-light" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Genre Management</span>
                        </div>
                        <div class="px-4 py-2 bg-white/5 backdrop-blur-sm rounded-full border border-white/10 flex items-center gap-2">
                            <svg class="w-4 h-4 text-movie-purple-light" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Smart Cataloging</span>
                        </div>
                        <div class="px-4 py-2 bg-white/5 backdrop-blur-sm rounded-full border border-white/10 flex items-center gap-2">
                            <svg class="w-4 h-4 text-movie-purple-light" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Easy Organization</span>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="relative hidden lg:block">
                    <div class="relative">
                        <!-- Movie Cards Stack -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="relative w-80 h-96">
                                <!-- Card 3 (Back) -->
                                <div class="absolute top-8 left-8 w-full h-full bg-gradient-to-br from-movie-indigo to-movie-navy rounded-2xl shadow-2xl transform rotate-6 opacity-40"></div>
                                
                                <!-- Card 2 (Middle) -->
                                <div class="absolute top-4 left-4 w-full h-full bg-gradient-to-br from-movie-purple-dark to-movie-indigo rounded-2xl shadow-2xl transform rotate-3 opacity-60"></div>
                                
                                <!-- Card 1 (Front) -->
                                <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-movie-purple via-movie-purple-dark to-movie-indigo rounded-2xl shadow-2xl overflow-hidden">
                                    <div class="p-6 h-full flex flex-col justify-between">
                                        <div class="space-y-4">
                                            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                                <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold mb-2">Movie Title</h3>
                                                <p class="text-movie-purple-light text-sm">Director Name • 2024</p>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-2">
                                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs">Action</span>
                                                <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs">Drama</span>
                                            </div>
                                            <p class="text-sm text-white/80 line-clamp-3">
                                                Manage your entire movie collection with ease. Add, edit, and organize films by genre, director, and year.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <style>
            @keyframes gradient {
                0%, 100% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
            }
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient 3s ease infinite;
            }
        </style>
    </body>
</html>