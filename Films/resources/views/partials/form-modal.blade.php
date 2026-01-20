<div id="modalBackdrop" class="fixed inset-0 bg-gray-900/50 hidden z-50 transition-all backdrop-blur-sm opacity-0"></div>

<div id="filmModal" class="fixed inset-0 hidden z-[70] overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div id="modalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform opacity-0 scale-95 transition-all duration-300">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800">
                    {{ __('films.titles.add_film') }}
                </h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <form id="filmForm" action="{{ route('films.store') }}" 
                data-store-url="{{ route('films.store') }}"
                data-add-title="{{ __('films.titles.add_film') }}" 
                data-edit-title="{{ __('films.titles.edit_film') }}"
                method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div id="methodField"></div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.fields.title') }}</label>
                    <input type="text" name="titre" id="titre" value="{{ old('titre') }}" class="py-2.5 px-4 block w-full border @error('titre') border-red-500 @else border-slate-500 @enderror rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('titre')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.fields.director') }}</label>
                    <input type="text" name="directeur" id="directeur" value="{{ old('directeur') }}" class="py-2.5 px-4 block w-full border @error('directeur') border-red-500 @else border-slate-500 @enderror rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                    @error('directeur')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.fields.description') }}</label>
                    <textarea name="description" id="description" rows="3" class="py-2.5 px-4 block w-full border @error('description') border-red-500 @else border-slate-500 @enderror rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">{{ __('films.fields.categories') }}</label>
                    <div class="grid grid-cols-2 gap-3 max-h-32 overflow-y-auto p-1">
                        @foreach($categories as $categorie)
                            @php
                                $catKey = Str::slug($categorie->nom, '_');
                            @endphp
                            <label class="flex items-center gap-x-2 cursor-pointer group">
                                <input type="checkbox" name="categories[]" value="{{ $categorie->id }}" id="cat_{{ $categorie->id }}" 
                                    @checked(is_array(old('categories')) && in_array($categorie->id, old('categories')))
                                    class="shrink-0 size-4 border border-slate-500 rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-600 group-hover:text-blue-600 transition-colors">
                                    {{ Lang::has('films.categories.'.$catKey) ? __('films.categories.'.$catKey) : $categorie->nom }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('categories')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.fields.image') }}</label>
                    <div id="imagePreviewContainer" class="hidden mb-3">
                        <img id="imagePreview" src="" class="size-20 object-cover rounded-lg border border-gray-200">
                    </div>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl transition-colors hover:border-blue-500 group">
                        <div class="space-y-1 text-center">
                            <i data-lucide="upload-cloud" class="mx-auto size-8 text-gray-400 group-hover:text-blue-500"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>{{ __('films.buttons.upload_file') }}</span>
                                    <input id="image" name="image" type="file" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">{{ __('films.fields.image_help') }}</p>
                            @error('image')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-x-3 pt-6 border-t border-gray-100 mt-6">
                    <button type="button" onclick="closeModal()" class="py-2.5 px-6 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 transition-colors">
                        {{ __('films.buttons.cancel') }}
                    </button>
                    <button type="submit" class="py-2.5 px-6 text-sm font-semibold rounded-xl border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                        {{ __('films.buttons.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
