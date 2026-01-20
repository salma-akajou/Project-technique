<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
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


    public function create()
    {
        $categories = $this->categorieService->getAll();
        return view('admin.create', compact('categories'));
    }

    public function store(StoreFilmRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id() ?? 1;
        $this->filmService->create($validated);

        return redirect()->route('films.index')
            ->with('success', __('films.messages.success.created')); 
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

    public function update(UpdateFilmRequest $request, Film $film)
    {
        $validated = $request->validated();
        $this->filmService->update($film, $validated);

        return redirect()->route('films.index')
            ->with('success', __('films.messages.success.updated')); 
    }

    public function destroy(Film $film)
    {
        $this->filmService->delete($film);

        return redirect()->route('films.index')
            ->with('success', __('films.messages.success.deleted')); 
    }
}
