<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;

use Illuminate\Support\Facades\Route;


Route::get('/', [MovieController::class, 'index']);

Route::get('/load-more', [MovieController::class, 'loadMore']);

Route::get('/new-movie', [MovieController::class, 'newMovie'])->name('new.movie');
Route::post('/store-movie', [MovieController::class, 'storeMovie'])->name('store.movie');
Route::post('/vote', [MovieController::class, 'voteMovie'])->name('vote.movie');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
