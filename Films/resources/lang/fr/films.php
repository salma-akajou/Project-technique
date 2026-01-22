<?php

return [
    'titles' => [
        'admin_dashboard' => 'Administration des Films',
        'admin_subtitle' => 'Ajouter, modifier ou supprimer des films.',
        'discover_cinema' => 'Découvrez le Cinéma',
        'explore_collection' => 'Explorez notre vaste collection de films, filtrée par vos catégories préférées.',
        'featured_films' => 'Notre Sélection de Films',
        'films' => 'Liste des Films',
        'add_film' => 'Ajouter un film',
        'edit_film' => 'Modifier le Film',
    ],

    'buttons' => [
        'add' => 'Ajouter',
        'update' => 'Modifier',
        'delete' => 'Supprimer',
        'cancel' => 'Annuler',
        'save' => 'Enregistrer',
        'details' => 'Détails',
        'back_home' => 'Retour à l\'accueil',
        'upload_file' => 'Télécharger un fichier',
    ],

    'fields' => [
        'search' => 'Rechercher ...',
        'all_categories' => 'Toutes les catégories',
        'title' => 'Titre',
        'category' => 'Catégorie',
        'categories' => 'Catégories',
        'director' => 'Directeur',
        'description' => 'Description',
        'image' => 'Image',
        'action' => 'Action',
        'image_help' => 'PNG, JPG jusqu\'à 10MB',
    ],

    'messages' => [
        'confirm_delete' => 'Êtes-vous sûr ?',
        'success' => [
            'created' => 'Film ajouté avec succès',
            'updated' => 'Film modifié avec succès',
            'deleted' => 'Film supprimé avec succès',
        ],
    ],

    'categories' => [
        'drame' => 'Drame',
        'comedie' => 'Comédie',
        'horreur' => 'Horreur',
        'science_fiction' => 'Science-Fiction',
        'animation' => 'Animation',
        'action' => 'Action',
    ],

    'validation' => [
        'titre_required' => 'Le titre du film est obligatoire.',
        'titre_string' => 'Le titre doit être une chaîne de caractères.',
        'titre_max' => 'Le titre ne peut pas dépasser 255 caractères.',
        'description_string' => 'La description doit être une chaîne de caractères.',
        'directeur_required' => 'Le nom du directeur est obligatoire.',
        'directeur_string' => 'Le nom du directeur doit être une chaîne de caractères.',
        'directeur_max' => 'Le nom du directeur ne peut pas dépasser 255 caractères.',
        'image_type' => 'L\'image doit être au format : jpg, jpeg, png ou gif.',
        'image_size' => 'L\'image ne doit pas dépasser 2 Mo.',
        'image_invalid' => 'Le fichier téléchargé n\'est pas une image valide.',
        'categories_required' => 'Veuillez sélectionner au moins une catégorie.',
        'categories_invalid' => 'Une ou plusieurs catégories sélectionnées sont invalides.',
    ],

    'menu' => [
        'films' => 'Films',
        'home' => 'Accueil',
    ],
];
