@extends('layouts.app')

@section('content')
<div class="bg-white border-b border-gray-200">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
    <div class="max-w-2xl text-center mx-auto">
      <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl">
        {{ __('films.discover_cinema') }}
      </h1>
      <p class="mt-4 text-lg text-gray-600">
        {{ __('films.explore_collection') }}
      </p>
    </div>
  </div>
</div>

<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div id="filmsContainer">
        <div class="mb-5 sm:mb-10 text-center">
            <h2 class="text-2xl font-bold md:text-3xl text-gray-800">
                {{ __('films.featured_films') }}
            </h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @include('partials.films-cards', ['films' => $films])
        </div>

        @if($films->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $films->links('partials.pagination') }}
        </div>
        @endif
    </div>
</div>

@endsection
