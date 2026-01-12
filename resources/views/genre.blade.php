<x-layouts.app :title="__('MovieHub - Genres')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl p-6">

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

        <div class="relative h-full flex-1 overflow-hidden rounded-2xl bg-[#2C2654]/50 backdrop-blur-sm border border-[#4A3F73]/50">
            <div class="flex h-full flex-col p-8">

                <!-- Add New Genre Form -->
                <div class="mb-8 rounded-xl bg-gradient-to-br from-[#2C2654]/80 to-[#1A1539]/80 p-8 border border-[#4A3F73]/50 backdrop-blur-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#7B68A8] to-[#5B4D87] rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white">Add New Genre</h2>
                    </div>

                    <form action="{{ route('genres.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid gap-6 md:grid-cols-3">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-300">Genre Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="e.g., Action, Drama, Comedy" required
                                       class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#7B68A8] focus:outline-none focus:ring-2 focus:ring-[#7B68A8]/20 transition-all">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-medium text-gray-300">Description</label>
                                <input type="text" name="description" value="{{ old('description') }}"
                                       placeholder="Brief description of the genre"
                                       class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white placeholder-gray-500 focus:border-[#7B68A8] focus:outline-none focus:ring-2 focus:ring-[#7B68A8]/20 transition-all">
                                @error('description')
                                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="group px-8 py-3 bg-gradient-to-r from-[#7B68A8] to-[#5B4D87] hover:from-[#5B4D87] hover:to-[#4A3F73] rounded-lg font-semibold text-white transition-all duration-300 shadow-lg hover:shadow-[#7B68A8]/50 hover:scale-105 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add Genre
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Genre List -->
                <div class="flex-1 overflow-auto">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-white">Genre Categories</h2>
                        <div class="px-4 py-2 bg-[#4A3F73]/50 rounded-lg border border-[#5B4D87]">
                            <span class="text-sm text-gray-300">{{ $genres->count() }} genres</span>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto rounded-xl border border-[#4A3F73]/50">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="bg-[#1A1539]/50 border-b border-[#4A3F73]">
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300 w-12"></th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-300 w-16">#</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-300">Genre Name</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-300 w-40">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#4A3F73]/50">
                                @forelse($genres as $genre)
                                    <tr class="bg-[#2C2654]/30 hover:bg-[#4A3F73]/30 transition-colors cursor-pointer" id="genre-row-{{ $genre->id }}" onclick="toggleGenreRow({{ $genre->id }})">
                                        <td class="px-6 py-4 text-center">
                                            <svg id="expand-icon-{{ $genre->id }}" class="w-5 h-5 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </td>
                                        <td class="px-6 py-4 text-center text-sm text-gray-400">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-[#7B68A8] to-[#5B4D87] rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="genre-name-display text-sm font-medium text-white">{{ $genre->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-center" onclick="event.stopPropagation()">
                                            <button onclick="editGenre({{ $genre->id }}, '{{ $genre->name }}', '{{ addslashes($genre->description) }}')"
                                                    class="text-[#9B7BB5] hover:text-[#7B68A8] transition-colors font-medium">
                                                Edit
                                            </button>
                                            <span class="mx-2 text-[#4A3F73]">|</span>
                                            <form action="{{ route('genres.destroy', $genre) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Are you sure? This will unassign all movies from this genre.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors font-medium">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr id="genre-detail-{{ $genre->id }}" class="hidden bg-[#1A1539]/50">
                                        <td colspan="4" class="px-6 py-6">
                                            <div class="rounded-lg bg-[#2C2654]/50 p-6 border border-[#4A3F73]/50">
                                                <h4 class="text-lg font-semibold text-white mb-3">Description</h4>
                                                <p class="text-gray-300 leading-relaxed">
                                                    {{ $genre->description ?? 'No description available' }}
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-16 h-16 bg-[#4A3F73]/50 rounded-full flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <p class="text-gray-400">No genres found. Add your first genre above!</p>
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

    <!-- Edit Genre Modal -->
    <div id="editGenreModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 backdrop-blur-sm p-6">
        <div class="w-full max-w-2xl rounded-2xl bg-[#2C2654] border border-[#4A3F73] shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-[#7B68A8] to-[#5B4D87] p-6">
                <h2 class="text-2xl font-bold text-white">Edit Genre</h2>
            </div>

            <form id="editGenreForm" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2 mb-6">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-gray-300">Genre Name</label>
                        <input type="text" id="edit_name" name="name" required
                               class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#7B68A8] focus:outline-none focus:ring-2 focus:ring-[#7B68A8]/20">
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-gray-300">Description</label>
                        <textarea id="edit_description" name="description" rows="3"
                                  class="w-full rounded-lg bg-[#1A1539]/50 border border-[#4A3F73] px-4 py-3 text-white focus:border-[#7B68A8] focus:outline-none focus:ring-2 focus:ring-[#7B68A8]/20"></textarea>
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEditModal()"
                            class="px-6 py-3 bg-[#4A3F73] hover:bg-[#5B4D87] rounded-lg font-medium text-white transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-[#7B68A8] to-[#5B4D87] hover:from-[#5B4D87] hover:to-[#4A3F73] rounded-lg font-semibold text-white transition-all shadow-lg hover:shadow-[#7B68A8]/50">
                        Update Genre
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

        // Toggle genre row expansion
        function toggleGenreRow(id) {
            const detailRow = document.getElementById(`genre-detail-${id}`);
            const icon = document.getElementById(`expand-icon-${id}`);
            
            if (detailRow.classList.contains('hidden')) {
                detailRow.classList.remove('hidden');
                icon.style.transform = 'rotate(90deg)';
            } else {
                detailRow.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function editGenre(id, name, description) {
            document.getElementById('editGenreModal').classList.remove('hidden');
            document.getElementById('editGenreModal').classList.add('flex');
            document.getElementById('editGenreForm').action = `/genres/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description || '';
        }

        function closeEditModal() {
            document.getElementById('editGenreModal').classList.add('hidden');
            document.getElementById('editGenreModal').classList.remove('flex');
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('editGenreModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</x-layouts.app>