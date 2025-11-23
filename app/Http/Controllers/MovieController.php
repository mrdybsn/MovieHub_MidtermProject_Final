<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    public function index()
    {
        $movieCount = Movie::count();
        $genreCount = Genre::count();
        
        $movies = Movie::with('genre')->latest()->get();
        $genres = Genre::all();
        $activeGenres = Genre::count();

        return view('dashboard', compact('movies', 'genres', 'activeGenres'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies',
            'description' => 'required|string',
            'imdb_id' => 'nullable|string|unique:movies',
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'director' => 'required|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
        ]);

        Movie::create($validated);

        return redirect()->back()->with('success', 'Movie added successfully.');
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies,title,' . $movie->id,
            'description' => 'required|string',
            'imdb_id' => 'nullable|string|unique:movies,imdb_id,' . $movie->id,
            'release_year' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'director' => 'required|string|max:255',
            'genre_id' => 'nullable|exists:genres,id',
        ]);

        $movie->update($validated);

        return redirect()->back()->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->back()->with('success', 'Movie deleted successfully.');
    }
}