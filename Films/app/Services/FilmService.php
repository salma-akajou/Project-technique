<?php
namespace App\Services;
use App\Models\Film;

class FilmService
{
    public function getAll(array $filters = []){
        $query= Film::query();
        //rechercher par titre
        if(!empty($filters['search'])){
            $query->where('titre','like', '%' .$filters['search'] . '%');
        }
        
        //filtrer par categories
        if(!empty($filters['categorie_id'])){
            $query->whereHas('categories', function($q) use ($filters){
                $q->where('categories.id', $filters['categorie_id']);
            });
        }
        //pagination
        return $query->paginate(5);
    }

    public function create(array $data){
        //Upload image
        if(!empty($data['image'])){
            $data['image']= $data['image']->store('films', 'public');
        }

        $film= Film::create($data);

        //associer les categories
        if(!empty($data['categories'])){
            $film->categories()->sync($data['categories']);
        }
        return $film;
    }

    public function update(Film $film, array $data){
        if(!empty($data['image'])){
            $data['image']= $data['image']->store('films', 'public');
        }

        $film->update($data);

        if(!empty($data['categories'])){
            $film->categories()->sync($data['categories']);
        }
    }

    public function delete(Film $film){
        $film->delete();
    }

}