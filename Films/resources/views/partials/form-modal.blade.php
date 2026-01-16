<div id="modalBackdrop" class="fixed inset-0 bg-gray-900/50 hidden z-50 transition-all backdrop-blur-sm opacity-0"></div>

<div id="filmModal" class="fixed inset-0 hidden z-[70] overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div id="modalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg transform opacity-0 scale-95 transition-all duration-300">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 id="modalTitle" class="text-xl font-bold text-gray-800">
                    {{ __('films.add_film') }}
                </h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i data-lucide="x" class="size-5"></i>
                </button>
            </div>

            <form id="filmForm" action="{{ route('films.store') }}" 
                data-store-url="{{ route('films.store') }}"
                data-add-title="{{ __('films.add_film') }}" 
                data-edit-title="{{ __('films.update') }}"
                method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                @csrf
                <div id="methodField"></div>
                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.title') }}</label>
                    <input type="text" name="titre" id="titre" required class="py-2.5 px-4 block w-full border border-slate-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.director') }}</label>
                    <input type="text" name="directeur" id="directeur" required class="py-2.5 px-4 block w-full border border-slate-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.description') }}</label>
                    <textarea name="description" id="description" rows="3" class="py-2.5 px-4 block w-full border border-slate-500 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2">{{ __('films.categories') }}</label>
                    <div class="grid grid-cols-2 gap-3 max-h-32 overflow-y-auto p-1">
                        @foreach($categories as $categorie)
                            @php
                                $catKey = Str::slug($categorie->nom, '_');
                                if ($catKey === 'action') $catKey = 'action_cat';
                            @endphp
                            <label class="flex items-center gap-x-2 cursor-pointer group">
                                <input type="checkbox" name="categories[]" value="{{ $categorie->id }}" id="cat_{{ $categorie->id }}" class="shrink-0 size-4 border border-slate-500 rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-600 group-hover:text-blue-600 transition-colors">
                                    {{ Lang::has('films.'.$catKey) ? __('films.'.$catKey) : $categorie->nom }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">{{ __('films.image') }}</label>
                    <div id="imagePreviewContainer" class="hidden mb-3">
                        <img id="imagePreview" src="" class="size-20 object-cover rounded-lg border border-gray-200">
                    </div>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl transition-colors hover:border-blue-500 group">
                        <div class="space-y-1 text-center">
                            <i data-lucide="upload-cloud" class="mx-auto size-8 text-gray-400 group-hover:text-blue-500"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                                    <span>{{ __('films.upload_file') }}</span>
                                    <input id="image" name="image" type="file" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">{{ __('films.image_size') }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-x-3 pt-6 border-t border-gray-100 mt-6">
                    <button type="button" onclick="closeModal()" class="py-2.5 px-6 text-sm font-semibold rounded-xl border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 transition-colors">
                        {{ __('films.cancel') }}
                    </button>
                    <button type="submit" class="py-2.5 px-6 text-sm font-semibold rounded-xl border border-transparent bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">
                        {{ __('films.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
