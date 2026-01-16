<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = database_path('seeders/data/film_categories.csv');

        if (($handle = fopen($file, 'r')) !== false) {
            $header = fgetcsv($handle, 1000, ',');

            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (count($header) !== count($row)) continue;
                
                $relation = array_combine($header, $row);

                $film = Film::find($relation['film_id']);
                if ($film) {
                    $film->categories()->syncWithoutDetaching([$relation['categorie_id']]);
                }
            }

            fclose($handle);
        }
    }
}
