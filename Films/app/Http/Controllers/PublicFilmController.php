<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Services\FilmService;
use App\Services\CategorieService;

class PublicFilmController extends Controller
{
    protected $filmService;
    protected $categorieService;

    public function __construct(FilmService $filmService, CategorieService $categorieService)
    {
        $this->filmService = $filmService;
        $this->categorieService = $categorieService;
    }


    public function home(Request $request)
    {
        $films = $this->filmService->getAll();
        return view('public.home', compact('films'));
    }

    public function show(Film $film)
    {
        return view('public.show', compact('film'));
    }
}
