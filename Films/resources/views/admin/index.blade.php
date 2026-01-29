@extends('layouts.app')

@section('content')
<div class="mx-auto" x-data="adminComponent()">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                {{ __('films.titles.films') }}
            </h1>
            <p class="text-sm text-gray-500">{{ __('films.titles.admin_subtitle') }}</p>
        </div>
        <button @click="openModal()" class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow-md transition-all">
            <i data-lucide="plus" class="size-4"></i>
            {{ __('films.buttons.add') }}
        </button>
</div>

    <div id="tableContainer" class="bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="px-6 py-4 flex flex-col md:flex-row md:items-center justify-end gap-3 border-b border-gray-200">
            <div class="relative w-full md:w-64">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                    <i data-lucide="search" class="size-4 text-gray-400"></i>
                </div>
                <input type="text" 
                       x-model="search" 
                       @input.debounce.300ms="fetchFilms()"
                       class="py-2 px-3 ps-10 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800" 
                       placeholder="{{ __('films.fields.search') }}">
            </div>
            
            <div class="w-full md:w-48">
                <select id="indexCategorySelect" 
                        @change="categorie_id = $event.target.value"
                        data-hs-select='{
                    "placeholder": "{{ __('films.fields.all_categories') }}",
                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-2 px-3 pe-9 flex text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500",
                    "dropdownClasses": "mt-2 z-[1000] w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto",
                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50",
                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span><span data-title></span></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"></polyline></svg></span></div>",
                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                }' class="hidden">
                    <option value="all">{{ __('films.fields.all_categories') }}</option>
                    @foreach($categories as $categorie)
                        @php
                            $catKey = Str::slug($categorie->nom, '_');
                            $catName = Lang::has('films.categories.'.$catKey) ? __('films.categories.'.$catKey) : $categorie->nom;
                        @endphp
                        <option value="{{ $categorie->id }}">{{ $catName }}</option>
                    @endforeach
                </select>
                <input type="hidden" x-model="categorie_id">
            </div>
        </div>
        <div id="filmsTableWrapper" 
             x-init="filmsTable = $el.innerHTML" 
             x-html="filmsTable">
            @include('partials.films-table')
        </div>
    </div>
    @include('partials.form-modal')
</div>
@endsection

@section('scripts')
@endsection
