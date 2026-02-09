<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@films.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Rédacteur User',
            'email' => 'redacteur@films.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        $this->call([
            UserSeeder::class,
            CategorieSeeder::class,
            FilmSeeder::class,
            FilmCategorieSeeder::class,
            
        ]);
    }
}
