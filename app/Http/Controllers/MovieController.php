<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function index(Request $request){
        $query = Movie::with('user')
            ->withCount([
                'votes as likes_count' => fn ($q) => $q->where('vote', 1),
                'votes as hates_count' => fn ($q) => $q->where('vote', -1),
            ]);
        switch ($request->get('sort')) {
            case 'likes':
                $query->orderByDesc('likes_count');
                break;
            case 'hates':
                $query->orderByDesc('hates_count');
                break;
            default:
                $query->orderByDesc('created_at');
        }


        $movies = $query->paginate(10);
        $allMovies = Movie::all()->count();

        if ($request->ajax()) {
            $html = '';
            foreach ($movies as $movie) {
                $html .= view('partials.movie-card', compact('movie'))->render();
            }
            return response($html);
        }

        return view('welcome', compact('movies', 'allMovies'));
    }

    public function loadMore(Request $request){
        $query = $this->moviesQuery();
        $query = $this->applySorting($query, $request->get('sort'));
        $movies = $query->paginate(10);

        $html = '';
        foreach ($movies as $movie) {
            $html .= view('partials.movie-card', ['movie' => $movie])->render();
        }

        return response($html);
    }


    protected function moviesQuery(){
        return Movie::with('user')
            ->withCount([
                'votes as likes_count' => fn($q) => $q->where('vote', 1),
                'votes as hates_count' => fn($q) => $q->where('vote', -1),
            ]);
    }


    protected function applySorting($query, $sort)
    {
        switch ($sort) {
            case 'likes':
                return $query->orderByDesc('likes_count');
            case 'hates':
                return $query->orderByDesc('hates_count');
            default:
                return $query->orderByDesc('created_at');
        }
    }

}
