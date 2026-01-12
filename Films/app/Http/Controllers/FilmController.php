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
        // 1. Validation
        $data = $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'directeur' => 'required',
            'image' => 'nullable|image',
            'categories' => 'required|array'
        ]);

        $data['user_id'] = 1; 

        // 2. Création
        $this->filmService->create($data);

        // 3. Réponse AJAX (pour ton live coding)
        if ($request->ajax()) {
            return response()->json([
                'html' => view('films._table_body', ['films' => $this->filmService->getAll()])->render(),
                'message' => __('messages.success')
            ]);
        }

        // 4. Redirection classique
        return redirect()->route('films.index')->with('success', __('messages.success'));
    }
}
