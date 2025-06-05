<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function index(){
        $movies = $this->moviesQuery()->paginate(10);

        return view('welcome', compact('movies'));
    }

    public function loadMore(Request $request)
    {
        $movies = $this->moviesQuery()->paginate(10);

        $html = '';
        foreach ($movies as $movie) {
            $html .= view('partials.movie-card', ['movie' => $movie])->render();
        }

        return response($html);
    }


    protected function moviesQuery()
    {
        return Movie::with('user')
            ->withCount([
                'votes as likes_count' => fn($q) => $q->where('vote', 1),
                'votes as hates_count' => fn($q) => $q->where('vote', -1),
            ]);
    }
}
