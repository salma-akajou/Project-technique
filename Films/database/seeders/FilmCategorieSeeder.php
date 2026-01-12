<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                $relation = array_combine($header, $row);

                DB::table('film_categories')->insert([
                    'id' => $relation['id'],
                    'film_id' => $relation['film_id'],
                    'categorie_id' => $relation['categorie_id'],
                    'created_at' => $relation['created_at'],
                    'updated_at' => $relation['updated_at']
                ]);
            }

            fclose($handle);
        }
    }
}
