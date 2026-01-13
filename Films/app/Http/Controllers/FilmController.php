<?php

namespace App\Http\Controllers;

use App\Services\FilmService;
use App\Services\CategorieService;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    protected $filmService;
    protected $catService;

    public function __construct(FilmService $filmService, CategorieService $catService)
    {
        $this->filmService = $filmService;
        $this->catService = $catService;
    }

    public function index(Request $request)
    {
        $films = $this->filmService->getAll(['search' => $request->search]);
        $categories = $this->catService->getAll();

        if ($request->ajax()) {
            return view('films._table_body', compact('films'))->render();
        }

        return view('films.index', compact('films', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'directeur' => 'required',
            'image' => 'nullable|image',
            'categories' => 'required|array'
        ]);

        $data['user_id'] = 1; 

        $this->filmService->create($data);

        if ($request->ajax()) {
            return view('films._table_body', ['films' => $this->filmService->getAll()]);
        }

        return redirect()->route('films.index')->with('success', __('films_views.success'));
    }
}
