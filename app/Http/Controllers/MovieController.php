<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;


class MovieController extends Controller
{

    public function index(Request $request)
    {
        $query = Movie::with('genre');

         if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                ->orWhere('director', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('genre_filter') && $request->genre_filter != '') {
            $query->where('genre_id', $request->genre_filter);
        }

        $movieCount = Movie::count();
        $genreCount = Genre::count();

        $movies = $query->latest()->get();
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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('movies-photos', 'public');
            $validated['photo'] = $photoPath;
        }

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
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

         if ($request->hasFile('photo')) {
             if ($movie->photo) {
                Storage::disk('public')->delete($movie->photo);
            }
            $photoPath = $request->file('photo')->store('movies-photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $movie->update($validated);

        return redirect()->back()->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->back()->with('success', 'Movie successfully moved to trash.');
    }

     public function trash()
    {
        $movie = Movie::onlyTrashed()->with('genre')->latest('deleted_at')->get();
        $genre = Genre::all();

        return view('trash', compact('movie', 'genre'));
    }

    public function restore($id)
    {
        $movie = Movie::withTrashed()->findOrFail($id);
        $movie->restore();

        return redirect()->route('movies.trash')->with('success', 'Movie restored successfully.');
    }

    public function forceDelete($id)
    {
        $movie = Movie::withTrashed()->findOrFail($id);

        if ($movie->photo) {
            Storage::disk('public')->delete($movie->photo);
        }

        $movie->forceDelete();

        return redirect()->route('movies.trash')->with('success', 'Movie permanently deleted.');
    }

    public function export(Request $request)
    {
        $query = Movie::with('genre');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('imdb_id', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('genre_filter') && $request->genre_filter != '') {
            $query->where('genre_id', $request->genre_filter);
        }

        $movies = $query->latest()->get();

        $filename = 'movies_export_' . date('Y-m-d_His') . '.pdf';

        $html = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Movies Export</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    padding: 20px;
                    background-color: #f5f5f5;
                }
                .container {
                    max-width: 1200px;
                    margin: 0 auto;
                    background-color: white;
                    padding: 30px;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                }
                h1 {
                    color: #333;
                    text-align: center;
                    margin-bottom: 10px;
                }
                .export-info {
                    text-align: center;
                    color: #666;
                    margin-bottom: 30px;
                    font-size: 14px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th {
                    background-color: #4472C4;
                    color: white;
                    padding: 12px;
                    text-align: left;
                    font-weight: bold;
                    border: 1px solid #2e5c9a;
                }
                td {
                    padding: 10px 12px;
                    border: 1px solid #ddd;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                tr:hover {
                    background-color: #f0f0f0;
                }
                .footer {
                    margin-top: 20px;
                    padding: 15px;
                    background-color: #f0f0f0;
                    border-radius: 5px;
                    text-align: center;
                    font-weight: bold;
                    color: #333;
                }
                @media print {
                    body {
                        background-color: white;
                    }
                    .container {
                        box-shadow: none;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Movies Export Report</h1>
                <div class="export-info">
                    Exported on: ' . date('F d, Y \a\t h:i A') . '<br>
                    Total Records: ' . $movies->count() . '
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Imdb_id</th>
                            <th>Release Year</th>
                            <th>Director</th>
                            <th>Genre</th>
                            <th>Inserted At</th>
                        </tr>
                    </thead>
                    <tbody>';

                $number = 1;
                foreach ($movies as $movie) {
                    $html .= '<tr>
                    <td>' . $number++ . '</td>
                    <td>' . htmlspecialchars($movie->title) . '</td>
                    <td>' . htmlspecialchars($movie->description) . '</td>
                    <td>' . htmlspecialchars($movie->imdb_id) . '</td>
                    <td>' . htmlspecialchars($movie->release_year) . '</td>
                    <td>' . htmlspecialchars($movie->director) . '</td>
                    <td>' . htmlspecialchars(optional($movie->genre)->name ?? 'No Genre') . '</td>
                    <td>' . $movie->created_at->format('Y-m-d H:i:s') . '</td>
                </tr>';
                }

                $html .= '</tbody>
                </table>

                <div class="footer">
                    Total Movies: ' . $movies->count() . '
                </div>
            </div>
        </body>
        </html>';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->stream($filename, ['Attachment' => true]);
    }
}