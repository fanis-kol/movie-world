<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Auth;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->moviesQuery();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        $query = $this->applySorting($query, $request->get('sort'));

        $movies = $query->paginate(10);
        $allMovies = Movie::count();

        if ($request->ajax()) {
            $html = '';
            foreach ($movies as $movie) {
                $html .= view('partials.movie-card', compact('movie'))->render();
            }
            return response($html);
        }

        return view('welcome', compact('movies', 'allMovies'));
    }

    public function loadMore(Request $request)
    {
        $query = $this->moviesQuery();

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->get('user_id'));
        }

        $query = $this->applySorting($query, $request->get('sort'));

        $movies = $query->paginate(10);

        $html = '';
        foreach ($movies as $movie) {
            $html .= view('partials.movie-card', ['movie' => $movie])->render();
        }

        return response($html);
    }

    public function newMovie()
    {
        $user = Auth::user();

        if(!$user){
            return redirect('/login');
        }

        return view('new-movie', compact('user'));
    }

    public function storeMovie(Request $request)
    {
        try {

            $user = Auth::user();

            if(!$user){
                return redirect('/login');
            }

            $validated = $request->validate([
                'title' => 'required|string|max:60',
                'description' => 'required|string|max:250',
            ]);

            $movie = new Movie($validated);
            $movie->user_id = $user->id;
            $movie->save();

            return redirect('/')->with('success', 'Movie added successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An unexpected error occurred: ' . $e->getMessage())
                ->withInput();
        }
    }


    protected function moviesQuery()
    {
        return Movie::with('user')
            ->withCount([
                'votes as likes_count' => fn($q) => $q->where('vote', 1),
                'votes as hates_count' => fn($q) => $q->where('vote', -1),
            ]);
    }

    protected function applySorting($query, $sort)
    {
        return match ($sort) {
            'likes' => $query->orderByDesc('likes_count'),
            'hates' => $query->orderByDesc('hates_count'),
            default => $query->orderByDesc('created_at'),
        };
    }
}
