<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file= database_path('seeders/data/users.csv');
        $rows= array_map('str_getcsv', file($file));
        $header= array_shift($rows);

        foreach($rows as $row){
            $data= array_combine($header, $row);

            User::create([
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
    }
}
