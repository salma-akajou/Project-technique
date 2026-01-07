@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[1] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
    <div class="mt-5 max-w-2xl text-center mx-auto">
      <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
        Discover <span class="bg-clip-text bg-gradient-to-tl from-blue-600 to-violet-600 text-transparent">Cinema</span>
      </h1>
    </div>
    <div class="mt-5 max-w-3xl text-center mx-auto">
      <p class="text-lg text-gray-600 dark:text-gray-400">Explore our vast collection of films, filtered by your favorite categories.</p>
    </div>
  </div>
</div>
<!-- End Hero -->

<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Search & Filter Controls -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-4 bg-white border border-gray-200 shadow-sm rounded-xl p-4 dark:bg-slate-900 dark:border-gray-700">
        <div class="w-full md:w-1/2 relative">
            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                <i data-lucide="search" class="shrink-0 size-4 text-gray-400 dark:text-gray-500"></i>
            </div>
            <input 
                type="text" 
                id="searchInput" 
                class="py-3 px-4 ps-11 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600" 
                placeholder="{{ __('messages.search_title') }}"
            >
        </div>

        <div class="w-full md:w-1/4">
             <select id="categorieSelect" class="py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                <option value="">{{ __('messages.all_categories') }}</option>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Films Grid -->
    <div id="filmsContainer" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @include('partials.films-cards', ['films' => $films])
    </div>

</div>
@endsection
