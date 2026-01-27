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
                    <select id="categories-select" name="categories[]" multiple="" data-hs-select='{
                        "placeholder": "",
                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300",
                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50",
                        "mode": "tags",
                        "wrapperClasses": "relative ps-0.5 pe-9 min-h-[46px] flex items-center flex-wrap text-nowrap w-full border border-gray-400 rounded-lg text-start text-sm focus:border-blue-500 focus:ring-blue-500 bg-white",
                        "tagsItemTemplate": "<div class=\"flex flex-nowrap items-center relative z-10 bg-white border border-gray-200 rounded-full p-1 m-1 order-1\"><div class=\"whitespace-nowrap text-gray-800 px-2\" data-title></div><div class=\"inline-flex shrink-0 justify-center items-center size-5 ms-2 rounded-full text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm cursor-pointer\" data-remove><svg class=\"shrink-0 size-3\" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M18 6 6 18\"/><path d=\"m6 6 12 12\"/></svg></div></div>",
                        "tagsInputId": "hs-tags-input",
                        "tagsInputClasses": "py-2 px-2 min-w-[50px] !border-none !ring-0 text-sm outline-none bg-transparent order-last",
                        "optionTemplate": "<div class=\"flex items-center\"><div><div class=\"text-sm font-semibold text-gray-800 \" data-title></div></div><div class=\"ms-auto\"><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-4 text-blue-600\" xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" viewBox=\"0 0 16 16\"><path d=\"M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z\"/></svg></span></div></div>",
                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                    }' class="hidden">
                        @foreach($categories as $categorie)
                            @php
                                $catKey = Str::slug($categorie->nom, '_');
                                $catName = Lang::has('films.categories.'.$catKey) ? __('films.categories.'.$catKey) : $categorie->nom;
                            @endphp
                            <option value="{{ $categorie->id }}" @selected(is_array(old('categories')) && in_array($categorie->id, old('categories')))>
                                {{ $catName }}
                            </option>
                        @endforeach
                    </select>
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
