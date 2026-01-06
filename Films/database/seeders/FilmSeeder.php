<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Categorie;
use App\Models\User;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file= database_path('seeders/data/films.csv');
        $rows= array_map('str_getcsv', file($file));
        $header= array_shift($rows);

        $categories= Categorie::all();

        foreach($rows as $row){
            $data= array_combine($header, $row);
            $user = User::where('email', $data['user_email'])->first();

            $film = Film::create([
                'titre' => $data['titre'],
                'description' => $data['description'],
                'directeur' => $data['directeur'],
                'image' => $data['image'],
                'user_id' => $user->id
            ]);

            $film->categories()->attach($categories->random(2));
        }
    }
}
