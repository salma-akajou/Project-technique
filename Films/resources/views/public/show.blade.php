@extends('layouts.app')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-4 md:p-5 dark:bg-slate-900 dark:border-gray-700">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            
            <!-- Image Section -->
            <div class="w-full h-96 bg-gray-100 rounded-xl overflow-hidden relative dark:bg-gray-800">
                @if($film->image)
                    <img src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->titre }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-full">
                        <i data-lucide="image-off" class="size-16 text-gray-400"></i>
                    </div>
                @endif
            </div>

            <!-- Content Section -->
            <div>
                 <div class="mb-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-x-1 text-sm text-gray-600 decoration-2 hover:underline font-medium dark:text-blue-500">
                        <i data-lucide="arrow-left" class="size-4"></i>
                        {{ __('messages.back_home') }}
                    </a>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ $film->titre }}
                </h1>

                <div class="flex flex-wrap gap-2 mb-6">
                     @foreach($film->categories as $categorie)
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                            {{ $categorie->nom }}
                        </span>
                    @endforeach
                </div>

                 <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('messages.description') ?? 'Description' }}</h3>
                        <p class="mt-1 text-gray-600 dark:text-gray-400">
                            {{ $film->description }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                         <div class="flex items-center gap-x-3">
                            <span class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center dark:bg-gray-800">
                                <i data-lucide="clapperboard" class="size-4 text-gray-500"></i>
                            </span>
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $film->directeur }}</p>
                                <p class="text-xs text-gray-500">{{ __('messages.directeur') }}</p>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@endsection
