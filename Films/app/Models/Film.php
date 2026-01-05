<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use App\Models\User;

class Film extends Model
{
    protected $fillable = [
        'titre', 'description', 'directeur', 'image', 'user_id'
    ];

    public function categories(){
        return $this->belongsToMany(Categorie::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
