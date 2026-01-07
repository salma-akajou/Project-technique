<?php

namespace App\Http\Controllers;

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
        $filters = $request->only(['search', 'categorie_id']);
        $films = $this->filmService->getAll($filters);
        $categories = $this->categorieService->getAll();

        if ($request->ajax()) {
            return view('partials.films-cards', compact('films'))->render();
        }

        return view('public.home', compact('films', 'categories'));
    }

    public function show($id)
    {
        $film = $this->filmService->getAll()->find($id); 
        return view('public.show', compact('film'));
    }
}
