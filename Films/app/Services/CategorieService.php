<?php

namespace App\Services;
use App\Models\Categorie;

class CategorieService
{
    public function getAll()
    {
        return Categorie::all();
    }
}