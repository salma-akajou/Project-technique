<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\PublicFilmController;

Route::get('/', [PublicFilmController::class, 'home'])->name('home');
Route::get('/films/{film}', [PublicFilmController::class, 'show'])->name('films.show');


Route::get('/admin/dashboard', [FilmController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/admin/films/create', [FilmController::class, 'create'])->name('films.create');
Route::post('/admin/films', [FilmController::class, 'store'])->name('films.store');
Route::get('/admin/films/{film}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/admin/films/{film}', [FilmController::class, 'update'])->name('films.update');
Route::delete('/admin/films/{film}', [FilmController::class, 'destroy'])->name('films.destroy');