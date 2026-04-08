<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Film;
use App\Models\Categorie;
use App\Models\User;
use App\Services\FilmService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;

class FilmServiceTest extends TestCase
{
    use RefreshDatabase;

    protected FilmService $service;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FilmService(new Film());
        $this->user = User::factory()->create();
    }

    public function test_it_can_get_all_films()
    {
        Film::factory()->count(10)->create(['user_id' => $this->user->id]);

        $result = $this->service->getAll();

        $this->assertEquals(10, $result->total());
    }

    public function test_it_can_filter_films_by_title()
    {
        Film::factory()->create([
            'titre' => 'Inception Test',
            'user_id' => $this->user->id
        ]);
        Film::factory()->count(3)->create(['user_id' => $this->user->id]);

        $result = $this->service->getAll([
            'search' => 'Inception'
        ]);

        $this->assertTrue($result->total() > 0);
        $this->assertEquals('Inception Test', $result->first()->titre);
    }

    public function test_it_can_filter_films_by_category()
    {
        $categorie = Categorie::factory()->create(['nom' => 'Science-fiction']);
        $film = Film::factory()->create(['user_id' => $this->user->id]);
        $film->categories()->attach($categorie);

        Film::factory()->create(['user_id' => $this->user->id]);

        $result = $this->service->getAll([
            'categorie_id' => $categorie->id
        ]);

        $this->assertEquals(1, $result->total());
        $this->assertTrue($result->first()->categories->contains('id', $categorie->id));
    }

    public function test_it_can_update_a_film()
    {
        $film = Film::factory()->create(['user_id' => $this->user->id]);
        $newTitle = 'Titre Test ' . uniqid();

        $this->service->update($film, [
            'titre' => $newTitle
        ]);

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'titre' => $newTitle
        ]);
    }

    public function test_it_can_delete_a_film()
    {
        $film = Film::factory()->create(['user_id' => $this->user->id]);

        $this->service->delete($film);

        $this->assertDatabaseMissing('films', [
            'id' => $film->id
        ]);
    }

    public function test_it_returns_paginated_films()
    {
        Film::factory()->count(5)->create(['user_id' => $this->user->id]);

        $result = $this->service->getAll();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertNotNull($result->total());
    }
}
