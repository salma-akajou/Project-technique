<?php

return [
    'titles' => [
        'admin_dashboard' => 'Films Dashboard',
        'admin_subtitle' => 'Add, edit or delete films.',
        'discover_cinema' => 'Discover Cinema',
        'explore_collection' => 'Explore our vast collection of films, filtered by your favorite categories.',
        'featured_films' => 'Our Film Selection',
        'films' => 'Films List',
        'add_film' => 'Add a Film',
        'edit_film' => 'Edit Film',
    ],

    'buttons' => [
        'add' => 'Add',
        'update' => 'Update',
        'delete' => 'Delete',
        'cancel' => 'Cancel',
        'save' => 'Save',
        'details' => 'Details',
        'back_home' => 'Back to Home',
        'upload_file' => 'Upload a file',
    ],

    'fields' => [
        'search' => 'Search ...',
        'all_categories' => 'All Categories',
        'title' => 'Title',
        'category' => 'Category',
        'categories' => 'Categories',
        'director' => 'Director',
        'description' => 'Description',
        'image' => 'Image',
        'action' => 'Action',
        'image_help' => 'PNG, JPG up to 10MB',
    ],

    'messages' => [
        'confirm_delete' => 'Are you sure?',
        'success' => [
            'created' => 'Film created successfully',
            'updated' => 'Film updated successfully',
            'deleted' => 'Film deleted successfully',
        ],
    ],

    'categories' => [
        'drame' => 'Drama',
        'comedie' => 'Comedy',
        'horreur' => 'Horror',
        'science_fiction' => 'Science-Fiction',
        'animation' => 'Animation',
        'action' => 'Action',
    ],

    'validation' => [
        'titre_required' => 'The film title is required.',
        'titre_string' => 'The title must be a string.',
        'titre_max' => 'The title may not exceed 255 characters.',
        'description_string' => 'The description must be a string.',
        'directeur_required' => 'The director name is required.',
        'directeur_string' => 'The director name must be a string.',
        'directeur_max' => 'The director name may not exceed 255 characters.',
        'image_type' => 'The image must be of type: jpg, jpeg, png, or gif.',
        'image_size' => 'The image size may not exceed 2MB.',
        'image_invalid' => 'The uploaded file is not a valid image.',
        'categories_required' => 'Please select at least one category.',
        'categories_invalid' => 'One or more selected categories are invalid.',
    ],

    'menu' => [
        'films' => 'Films',
        'home' => 'Home',
    ],
];
