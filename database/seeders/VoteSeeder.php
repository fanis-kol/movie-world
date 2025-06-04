<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie;
use App\Models\Vote;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $movies = Movie::all();

        foreach ($users as $user) {
            // Each user will vote on 10 random movies
            $randomMovies = $movies->random(10);

            foreach ($randomMovies as $movie) {
                Vote::create([
                    'user_id' => $user->id,
                    'movie_id' => $movie->id,
                    'vote' => rand(-1, 1), // -1 = hate, 0 = neutral, 1 = like
                ]);
            }
        }
    }
}
