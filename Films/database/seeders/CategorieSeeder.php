<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categorie;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file= database_path('seeders/data/categories.csv');
        $rows= array_map('str_getcsv', file($file));
        $header= array_shift($rows);

        foreach($rows as $row){
            $data= array_combine($header, $row);

            Categorie::create([
                'nom'=>$data['nom']
            ]);
        }
    }
}
