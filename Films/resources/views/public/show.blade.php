@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('home') }}" class="inline-flex items-center gap-x-2 text-sm text-gray-500 hover:text-blue-600 mb-6 transition-colors">
        <i data-lucide="arrow-left" class="size-4"></i>
        {{ __('messages.back_home') }}
    </a>

    <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm">
        <div class="flex flex-col lg:flex-row">
            <div class="lg:w-2/5 aspect-[3/4] bg-gray-100">
                @if($film->image)
                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->titre }}">
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        <i data-lucide="film" class="size-20"></i>
                    </div>
                @endif
            </div>
            <div class="lg:w-3/5 p-8 lg:p-12">
                <div class="flex gap-2 mb-4">
                    @foreach($film->categories as $categorie)
                        <span class="py-1 px-3 bg-blue-50 text-blue-600 rounded-full text-xs font-bold uppercase tracking-wider">
                            {{ $categorie->nom }}
                        </span>
                    @endforeach
                </div>

                <h1 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-6">
                    {{ $film->titre }}
                </h1>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('messages.director') }}</h3>
                        <p class="text-gray-700 font-medium flex items-center gap-x-2">
                             <i data-lucide="user" class="size-4 text-blue-600"></i>
                             {{ $film->directeur }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('messages.description') }}</h3>
                        <p class="text-gray-600 leading-relaxed italic">
                            "{{ $film->description }}"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
