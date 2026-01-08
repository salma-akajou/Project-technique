@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[1] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
  <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
    <div class="mt-5 max-w-2xl text-center mx-auto">
      <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
        {{ __('messages.discover_cinema') }}
      </h1>
    </div>
    <div class="mt-5 max-w-3xl text-center mx-auto">
      <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('messages.explore_collection') }}</p>
    </div>
  </div>
</div>
<!-- End Hero -->

<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <!-- Films Grid -->
    <div id="filmsContainer" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @include('partials.films-cards', ['films' => $films])
    </div>

</div>
@endsection
