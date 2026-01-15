<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Film;
use App\Services\FilmService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FilmServiceTest extends TestCase
{
    use DatabaseTransactions;

    protected FilmService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FilmService();
    }

    public function test_it_can_get_all_films()
    {
        $result = $this->service->getAll();

        $this->assertGreaterThan(0, $result->total());
    }

    public function test_it_can_filter_films_by_title()
    {
        $result = $this->service->getAll([
            'search' => 'Inception'
        ]);

        $this->assertEquals(1, $result->total());
    }

    public function test_it_can_filter_films_by_category()
    {
    $categorie = \App\Models\Categorie::where('nom', 'Science-fiction')->first();

    $result = $this->service->getAll([
        'categorie_id' => $categorie->id
    ]);

    $this->assertGreaterThan(0, $result->total());
    }

    public function test_it_can_update_a_film()
    {
        $film = Film::first();

        $this->service->update($film, [
            'titre' => 'Titre Test'
        ]);

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'titre' => 'Titre Test'
        ]);
    }

    public function test_it_can_delete_a_film()
    {
        $film = Film::first();

        $this->service->delete($film);

        $this->assertDatabaseMissing('films', [
            'id' => $film->id
        ]);
    }
}