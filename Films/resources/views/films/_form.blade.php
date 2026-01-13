<form id="filmForm" action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" data-success="{{ __('films_views.success') }}">
    @csrf
    <div class="space-y-4">
        <!-- Titre -->
        <div class="mb-4 sm:mb-8">
            <label for="titre" class="block mb-2 text-sm font-medium">{{ __('films_attributes.titre') }}</label>
            <input type="text" id="titre" name="titre" required class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="{{ __('films_attributes.titre') }}">
        </div>

        <!-- Directeur -->
        <div class="mb-4 sm:mb-8">
            <label for="directeur" class="block mb-2 text-sm font-medium">{{ __('films_attributes.directeur') }}</label>
            <input type="text" id="directeur" name="directeur" required class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="{{ __('films_attributes.directeur') }}">
        </div>

        <!-- Description -->
        <div class="mb-4 sm:mb-8">
            <label for="description" class="block mb-2 text-sm font-medium">{{ __('films_attributes.description') }}</label>
            <div class="mt-1">
                <textarea id="description" name="description" required rows="3" class="py-2.5 sm:py-3 px-4 block w-full border-gray-200 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" placeholder="{{ __('films_attributes.description') }}"></textarea>
            </div>
        </div>

        <!-- Image -->
        <div class="mb-4 sm:mb-8">
            <label for="image" class="block mb-2 text-sm font-medium">{{ __('films_attributes.image') }}</label>
            <input type="file" name="image" id="image" class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                file:bg-gray-50 file:border-0
                file:me-4
                file:py-3 file:px-4">
        </div>

        <!-- Categories -->
        <div class="mb-4 sm:mb-8">
            <label class="block mb-2 text-sm font-medium">{{ __('films_attributes.categories') }}</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($categories as $cat)
                    <div class="flex">
                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}" id="cat-{{ $cat->id }}" class="shrink-0 mt-0.5 border-gray-200 rounded-sm text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <label for="cat-{{ $cat->id }}" class="text-sm text-gray-500 ms-3">{{ $cat->nom }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</form>
