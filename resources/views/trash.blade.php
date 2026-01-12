<x-layouts.app :title="__('MovieHub - Trash')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">

        @if(session('success'))
            <div id="successMessage" class="rounded-xl bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-500/20 p-4 backdrop-blur-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="text-green-300 font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-[#9B7BB5] to-white bg-clip-text text-transparent">Trash</h1>
                <p class="mt-1 text-sm text-gray-400">Manage deleted movies - restore or permanently delete</p>
            </div>
            <a href="{{ route('dashboard') }}"
               class="px-6 py-3 bg-gradient-to-r from-[#5B4D87] to-[#4A3F73] hover:from-[#4A3F73] hover:to-[#2C2654] rounded-lg font-medium text-white transition-all shadow-lg hover:scale-105">
                Back to Dashboard
            </a>
        </div>

        <!-- Stats Card -->
        <div class="rounded-2xl bg-gradient-to-br from-red-600/20 to-red-800/20 border border-red-500/30 p-6 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-red-500/20 rounded-xl flex items-center justify-center">
                    <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-400">Movies in Trash</p>
                    <h3 class="mt-1 text-3xl font-bold text-white">{{ $movie->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Trash Content -->
        <div class="relative flex-1 overflow-hidden rounded-2xl bg-[#2C2654]/50 backdrop-blur-sm border border-[#4A3F73]/50">
            <div class="flex h-full flex-col p-8">
                <h2 class="mb-6 text-2xl font-bold text-white">Deleted Movies</h2>

                @if($movie->isEmpty())
                    <div class="flex flex-1 items-center justify-center rounded-lg border-2 border-dashed border-[#4A3F73] p-12">
                        <div class="text-center">
                            <div class="mx-auto w-24 h-24 bg-[#4A3F73]/30 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-white mb-2">Trash is empty</h3>
                            <p class="text-sm text-gray-400">No deleted movies found.</p>
                        </div>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-xl border border-[#4A3F73]/50">
                        <table class="w-full">
                            <thead class="bg-[#1A1539]/50 border-b border-[#4A3F73]">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Poster</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Movie</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Details</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Genre</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Deleted At</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#4A3F73]/50">
                                @foreach($movie as $movie)
                                    <tr class="bg-[#2C2654]/30 hover:bg-[#4A3F73]/30 transition-colors">
                                        <td class="px-6 py-4">
                                            @if($movie->photo)
                                                <img src="{{ Storage::url($movie->photo) }}" alt="{{ $movie->title }}"
                                                     class="h-16 w-12 rounded object-cover ring-2 ring-[#4A3F73]">
                                            @else
                                                <div class="h-16 w-12 rounded bg-gradient-to-br from-[#7B68A8] to-[#5B4D87] flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-white">{{ $movie->title }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-300">{{ $movie->director }}</div>
                                            <div class="text-xs text-gray-500">{{ $movie->release_year }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($movie->genre)
                                                <span class="px-3 py-1 bg-[#9B7BB5]/20 text-[#9B7BB5] rounded-full text-xs font-medium border border-[#9B7BB5]/30">
                                                    {{ $movie->genre->name }}
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-500">No genre</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300">
                                            {{ $movie->deleted_at->format('M d, Y') }}
                                            <div class="text-xs text-gray-500">
                                                {{ $movie->deleted_at->format('h:i A') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-end gap-2">
                                                <form method="POST" action="{{ route('movies.restore', $movie->id) }}">
                                                    @csrf
                                                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap px-4 py-2 rounded-lg text-xs font-semibold bg-gradient-to-r from-green-500 to-emerald-600 hover:from-emerald-600 hover:to-green-700 text-white shadow-md transition hover:scale-105">
                                                        Restore
                                                    </button>

                                                </form>

                                                <form method="POST" action="{{ route('movies.force-delete', $movie->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center justify-center whitespace-nowrap px-4 py-2 rounded-lg text-xs font-semibold bg-gradient-to-r from-red-500 to-red-700 hover:from-red-600 hover:to-red-800 text-white shadow-md transition hover:scale-105">
                                                        Delete&nbsp;Forever
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.getElementById('successMessage');
            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.opacity = '0';
                    setTimeout(function() {
                        successMessage.remove();
                    }, 500);
                }, 3000);
            }
        });
    </script>
</x-layouts.app>