@extends('layouts.app')

@section('content')
<div class="mx-auto">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('films.titles.films') }}
            </h1>
            <p class="text-sm text-gray-500">{{ __('films.titles.admin_subtitle') }}</p>
        </div>
        <button onclick="openModal()" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow-md transition-all">
            <i data-lucide="plus" class="size-4"></i>
            {{ __('films.buttons.add') }}
        </button>
</div>

    <div id="tableContainer" class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <div class="px-6 py-4 flex flex-col md:flex-row md:items-center justify-end gap-3 border-b border-gray-200">
            <div class="relative w-full md:w-64">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                    <i data-lucide="search" class="size-4 text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" class="py-2 px-3 ps-10 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800" placeholder="{{ __('films.fields.search') }}">
            </div>
            
            <div class="w-full md:w-48">
                <select id="categorySelect" class="py-2 px-3 pe-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800">
                    <option value="">{{ __('films.fields.all_categories') }}</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="filmsTableWrapper">
            @include('partials.films-table')
        </div>
    </div>
</div>

@include('partials.form-modal')

@endsection

@section('scripts')
    @vite('resources/js/admin.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($errors->any())
                window.openModal();
            @endif
        });
    </script>
@endsection
