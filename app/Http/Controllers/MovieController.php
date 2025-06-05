<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function index(){
        $movies = Movie::with('user')->paginate(10);

        return view('welcome', compact('movies'));
    }

    public function loadMore(Request $request)
    {
        $movies = Movie::with('user')->paginate(10);

        $html = '';
        foreach ($movies as $movie) {
            $html .= view('partials.movie-card', ['movie' => $movie])->render();
        }

        return response($html);
    }
}
