<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">

        <!-- Success Message -->
        @if(session('success'))
            <div id="successMessage" class="rounded-xl bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-500/20 p-4 backdrop-blur-sm transition-all duration-500">
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

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-3">
            <!-- Total Movies Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] p-6 shadow-2xl hover:shadow-[#9B7BB5]/50 transition-all duration-300 hover:scale-105">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white/80 mb-2">Total Movies</p>
                        <h3 class="text-4xl font-bold text-white">{{ $movies->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Active Genres Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#7B68A8] to-[#5B4D87] p-6 shadow-2xl hover:shadow-[#7B68A8]/50 transition-all duration-300 hover:scale-105">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white/80 mb-2">Active Genres</p>
                        <h3 class="text-4xl font-bold text-white">{{ $activeGenres }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Genres Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-[#5B4D87] to-[#4A3F73] p-6 shadow-2xl hover:shadow-[#5B4D87]/50 transition-all duration-300 hover:scale-105">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-white/80 mb-2">Total Genres</p>
                        <h3 class="text-4xl font-bold text-white">{{ $genres->count() }}</h3>
                    </div>
                    <div class="w-14 h-14 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform duration-300">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movie Management Section -->
        <div class="relative flex-1 overflow-hidden rounded-2xl bg-[#2C2654]/50 backdrop-blur-sm border border-[#4A3F73]/50">
            <div class="flex h-full flex-col p-8">
                <!-- Add New Movie Form -->
                <div class="mb-8 rounded-xl bg-gradient-to-br from-[#2C2654]/80 to-[#1A1539]/80 p-8 border border-[#4A3F73]/50 backdrop-blur-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#9B7BB5] to-[#7B68A8] rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Add New Movie</h2>
                    </div>

                    <form action="{{ route('movies.store') }}" method="POST" class="grid gap-6 md:grid-cols-2">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">Movie Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Enter movie title" required 
                                   class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all">
                            @error('title')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">IMDB ID (Optional)</label>
                            <input type="text" name="imdb_id" value="{{ old('imdb_id') }}" placeholder="e.g., tt1234567" 
                                   class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all">
                            @error('imdb_id')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">Director</label>
                            <input type="text" name="director" value="{{ old('director') }}" placeholder="Enter director name" required 
                                   class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all">
                            @error('director')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">Release Year</label>
                            <input type="number" name="release_year" value="{{ old('release_year') }}" placeholder="e.g., 2024" required 
                                   class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all">
                            @error('release_year')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-gray-300">Genre (Optional)</label>
                            <select name="genre_id" 
                                    class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all">
                                <option value="">Select a genre</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('genre_id')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-medium text-gray-300">Description</label>
                            <textarea name="description" rows="3" placeholder="Enter movie description" required 
                                      class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20 transition-all">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="group px-8 py-3 bg-gradient-to-r from-[#9B7BB5] to-[#7B68A8] hover:from-[#7B68A8] hover:to-[#5B4D87] rounded-lg font-semibold text-white transition-all duration-300 shadow-lg hover:shadow-[#9B7BB5]/50 hover:scale-105 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Movie
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Movie List -->
                <div class="flex-1 overflow-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white">Movie Collection</h2>
                        <div class="px-4 py-2 bg-[#4A3F73]/50 rounded-lg border border-[#5B4D87]">
                            <span class="text-sm text-gray-300">{{ $movies->count() }} movies</span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto rounded-xl border border-[#4A3F73]/50">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="bg-[#1A1539]/50 border-b border-[#4A3F73]">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 w-12"></th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">#</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Title</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">IMDB ID</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Director</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Year</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Genre</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#4A3F73]/50">
                                @forelse($movies as $movie)
                                    <tr class="bg-[#2C2654]/30 hover:bg-[#4A3F73]/30 transition-colors cursor-pointer" onclick="toggleMovieRow({{ $movie->id }})">
                                        <td class="px-6 py-4 text-center">
                                            <svg id="expand-icon-{{ $movie->id }}" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-sm font-medium text-white">{{ $movie->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-300">
                                            @if($movie->imdb_id)
                                                <a href="https://www.imdb.com/title/{{ $movie->imdb_id }}" target="_blank" class="text-[#9B7BB5] hover:text-[#7B68A8] hover:underline transition-colors" onclick="event.stopPropagation()">
                                                    {{ $movie->imdb_id }}
                                                </a>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-300">{{ $movie->director }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-300">{{ $movie->release_year }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @if($movie->genre)
                                                <span class="px-3 py-1 bg-[#9B7BB5]/20 text-[#9B7BB5] rounded-full text-xs font-medium border border-[#9B7BB5]/30">
                                                    {{ $movie->genre->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-500">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center" onclick="event.stopPropagation()">
                                            <button onclick="editMovie({{ $movie->id }}, '{{ addslashes($movie->title) }}', '{{ addslashes($movie->imdb_id ?? '') }}', '{{ addslashes($movie->director) }}', {{ $movie->release_year }}, '{{ addslashes($movie->description) }}', {{ $movie->genre_id ?? 'null' }})"
                                                    class="text-[#9B7BB5] hover:text-[#7B68A8] transition-colors font-medium">
                                                Edit
                                            </button>
                                            <span class="mx-2 text-[#4A3F73]">|</span>
                                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this movie?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors font-medium">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr id="movie-detail-{{ $movie->id }}" class="hidden bg-[#1A1539]/50">
                                        <td colspan="8" class="px-6 py-6">
                                            <div class="rounded-lg bg-[#2C2654]/50 p-6 border border-[#4A3F73]/50">
                                                <h4 class="text-lg font-semibold text-white mb-3">Description</h4>
                                                <p class="text-gray-300 leading-relaxed">{{ $movie->description }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-16 h-16 bg-[#4A3F73]/50 rounded-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-400">No movies found. Add your first movie above!</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Movie Modal -->
    <div id="editMovieModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-6">
        <div class="w-full max-w-2xl rounded-2xl bg-[#2C2654] border border-[#4A3F73] shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-[#9B7BB5] to-[#7B68A8] p-6">
                <h2 class="text-2xl font-bold text-white">Edit Movie</h2>
            </div>

            <form id="editMovieForm" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2 mb-6">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-300">Title</label>
                        <input type="text" id="edit_title" name="title" required
                               class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20">
                        @error('title')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-300">IMDB ID (Optional)</label>
                        <input type="text" id="edit_imdb_id" name="imdb_id" placeholder="e.g., tt1234567"
                               class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20">
                        @error('imdb_id')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-300">Director</label>
                        <input type="text" id="edit_director" name="director" required
                               class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20">
                        @error('director')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-300">Release Year</label>
                        <input type="number" id="edit_release_year" name="release_year" required
                               class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20">
                        @error('release_year')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-300">Genre (Optional)</label>
                        <select id="edit_genre_id" name="genre_id"
                                class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20">
                            <option value="">Select a genre</option>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        @error('genre_id')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-300">Description</label>
                        <textarea id="edit_description" name="description" rows="3" required
                                  class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#9B7BB5] focus:outline-none focus:ring-2 focus:ring-[#9B7BB5]/20"></textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditMovieModal()"
                            class="px-6 py-3 bg-[#4A3F73] hover:bg-[#5B4D87] rounded-lg font-medium text-white transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-[#9B7BB5] to-[#7B68A8] hover:from-[#7B68A8] hover:to-[#5B4D87] rounded-lg font-semibold text-white transition-all shadow-lg hover:shadow-[#9B7BB5]/50">
                        Update Movie
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-hide success message after 3 seconds
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

        // Toggle movie row expansion
        function toggleMovieRow(id) {
            const detailRow = document.getElementById(`movie-detail-${id}`);
            const icon = document.getElementById(`expand-icon-${id}`);
            
            if (detailRow.classList.contains('hidden')) {
                detailRow.classList.remove('hidden');
                icon.style.transform = 'rotate(90deg)';
            } else {
                detailRow.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function editMovie(id, title, imdbId, director, releaseYear, description, genreId) {
            document.getElementById('editMovieModal').classList.remove('hidden');
            document.getElementById('editMovieModal').classList.add('flex');
            document.getElementById('editMovieForm').action = `/movies/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_imdb_id').value = imdbId || '';
            document.getElementById('edit_director').value = director;
            document.getElementById('edit_release_year').value = releaseYear;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_genre_id').value = genreId || '';
        }

        function closeEditMovieModal() {
            document.getElementById('editMovieModal').classList.add('hidden');
            document.getElementById('editMovieModal').classList.remove('flex');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditMovieModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('editMovieModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditMovieModal();
            }
        });
    </script>
</x-layouts.app>