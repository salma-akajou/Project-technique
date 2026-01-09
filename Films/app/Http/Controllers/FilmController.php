<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Services\FilmService;
use App\Services\CategorieService;

class FilmController extends Controller
{
    protected $filmService;
    protected $categorieService;

    public function __construct(FilmService $filmService, CategorieService $categorieService)
    {
        $this->filmService = $filmService;
        $this->categorieService = $categorieService;
    }
    
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'categorie_id']);
        $films = $this->filmService->getAll($filters); 
        $categories = $this->categorieService->getAll();

        if ($request->ajax()) {
            return view('partials.films-table', compact('films'))->render();
        }

        return view('admin.index', compact('films', 'categories'));
    }

    public function dashboard()
    {
        $totalFilms = Film::count();
        $recentFilms = Film::latest()->take(5)->get();
        $totalCategories = \App\Models\Categorie::count();
        
        return view('admin.dashboard', compact('totalFilms', 'recentFilms', 'totalCategories'));
    }

    public function create()
    {
        $categories = $this->categorieService->getAll();
        return view('admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'directeur' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $validated['user_id'] = auth()->id() ?? 1;
        $this->filmService->create($validated);

        return redirect()->route('films.index')
            ->with('success', __('messages.film_created')); 
    }

    public function edit(Film $film)
    {
        $categories = $this->categorieService->getAll();
        
        if (request()->ajax()) {
            return response()->json([
                'film' => $film,
                'categories' => $film->categories->pluck('id')
            ]);
        }
        
        return view('admin.edit', compact('film', 'categories'));
    }

    public function update(Request $request, Film $film)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'directeur' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $this->filmService->update($film, $validated);

        return redirect()->route('films.index')
            ->with('success', __('messages.film_updated')); 
    }

    public function destroy(Film $film)
    {
        $this->filmService->delete($film);

        return redirect()->route('films.index')
            ->with('success', __('messages.film_deleted')); 
    }
}
