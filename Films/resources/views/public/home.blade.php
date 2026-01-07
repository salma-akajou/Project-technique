@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <input 
            type="text" 
            id="searchInput" 
            placeholder="{{ __('messages.search_title') }}" 
            class="border rounded p-2 w-full md:w-1/3"
        >

        <select id="categorieSelect" class="border rounded p-2 w-full md:w-1/4">
            <option value="">{{ __('messages.all_categories') }}</option>
            @foreach($categories as $categorie)
                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
            @endforeach
        </select>
    </div>

    <div id="filmsContainer" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @include('partials.films-cards', ['films' => $films])
    </div>

</div>
@endsection
