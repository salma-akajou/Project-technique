@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-6">
    <img src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->titre }}" class="w-full h-64 object-cover rounded mb-4">

    <h1 class="text-2xl font-bold mb-2">{{ $film->titre }}</h1>

    <p class="text-gray-700 mb-2">{{ $film->description }}</p>

    <p class="text-gray-800 font-semibold mb-2">{{ __('messages.directeur') }}: {{ $film->directeur }}</p>

    <div class="flex flex-wrap gap-2 mb-4">
        @foreach($film->categories as $categorie)
            <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded">
                {{ $categorie->nom }}
            </span>
        @endforeach
    </div>

    <a href="{{ route('home') }}" class="text-blue-500 hover:underline">{{ __('messages.back_home') }}</a>
</div>
@endsection
