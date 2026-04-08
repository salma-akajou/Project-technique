<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Film;


class Categorie extends Model
{
    use HasFactory;

    protected $fillable= [ 'nom' ];

    public function films(){
        return $this->belongsToMany(Film::class);
    }
}
