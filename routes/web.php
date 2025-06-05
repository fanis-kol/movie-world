<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;

use Illuminate\Support\Facades\Route;


Route::get('/', [MovieController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/load-more', [MovieController::class, 'loadMore']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
