<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicFilmController;

Route::get('/', [PublicFilmController::class, 'home'])->name('public.home');
Route::get('/accueil', [PublicFilmController::class, 'home']);

Route::get('/films/{film}', [PublicFilmController::class, 'show'])->name('films.show');
