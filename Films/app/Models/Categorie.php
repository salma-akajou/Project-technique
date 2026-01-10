<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Film;


class Categorie extends Model
{
    
    protected $fillable= [ 'nom' ];

    public function films(){
        return $this->belongsToMany(Film::class);
    }
}
