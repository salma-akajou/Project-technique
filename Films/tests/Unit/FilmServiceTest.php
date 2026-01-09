<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Film;
use App\Models\User;
use App\Services\FilmService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FilmServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_get_all_films()
    {
        // Arrange
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        Film::create([
            'titre' => 'Film 1',
            'description' => 'Desc 1',
            'directeur' => 'Dir 1',
            'user_id' => $user->id,
        ]);

        Film::create([
            'titre' => 'Film 2',
            'description' => 'Desc 2',
            'directeur' => 'Dir 2',
            'user_id' => $user->id,
        ]);

        $service = new FilmService();

        $result = $service->getAll();

        // Assert
        $this->assertEquals(2, $result->total());
    }

    public function test_it_can_filter_films_by_title()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
            'password' => bcrypt('password'),
        ]);

        Film::create([
            'titre' => 'Avatar',
            'description' => 'Desc',
            'directeur' => 'James',
            'user_id' => $user->id,
        ]);

        Film::create([
            'titre' => 'Titanic',
            'description' => 'Desc',
            'directeur' => 'James',
            'user_id' => $user->id,
        ]);

        $service = new FilmService();

        $result = $service->getAll(['search' => 'Ava']);

        $this->assertEquals(1, $result->total());
    }

    public function test_it_can_create_a_film()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $service = new FilmService();

        $data = [
            'titre' => 'Nouveau Film',
            'description' => 'Nouvelle desc',
            'directeur' => 'New Director',
            'user_id' => $user->id,
        ];

        $film = $service->create($data);

        $this->assertDatabaseHas('films', [
            'titre' => 'Nouveau Film',
            'user_id' => $user->id,
        ]);
    }

    public function test_it_can_update_a_film()
    {
        $user = User::create([
            'name' => 'User Update',
            'email' => 'update@example.com',
            'password' => bcrypt('password'),
        ]);

        $film = Film::create([
            'titre' => 'Ancien titre',
            'description' => 'Ancienne desc',
            'directeur' => 'Ancien dir',
            'user_id' => $user->id,
        ]);

        $service = new FilmService();

        $service->update($film, [
            'titre' => 'Nouveau titre',
        ]);

        $this->assertDatabaseHas('films', [
            'id' => $film->id,
            'titre' => 'Nouveau titre',
        ]);
    }

    public function test_it_can_delete_a_film()
    {
        $user = User::create([
            'name' => 'User Delete',
            'email' => 'delete@example.com',
            'password' => bcrypt('password'),
        ]);

        $film = Film::create([
            'titre' => 'Film à supprimer',
            'description' => 'Desc',
            'directeur' => 'Dir',
            'user_id' => $user->id,
        ]);

        $service = new FilmService();

        $service->delete($film);

        $this->assertDatabaseMissing('films', [
            'id' => $film->id,
        ]);
    }
}
