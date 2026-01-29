<div class="min-w-full overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('films.fields.title') }}</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('films.fields.director') }}</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('films.fields.description') }}</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('films.fields.categories') }}</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('films.fields.action') }}</th>
            </tr>
        </thead>
        
        <tbody class="divide-y divide-gray-200">
            @foreach($films as $film)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center gap-x-3">
                        @if($film->image)
                            <img src="{{ asset('storage/'.$film->image) }}" class="size-10 rounded-lg object-cover" alt="">
                        @else
                            <div class="size-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400">
                                <i data-lucide="image" class="size-5"></i>
                            </div>
                        @endif
                        <span class="text-sm font-semibold text-gray-800">{{ $film->titre }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                    {{ $film->directeur }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate" title="{{ $film->description }}">
                    {{ \Illuminate\Support\Str::limit($film->description, 50) }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex gap-1 flex-wrap">
                        @foreach($film->categories as $cat)
                            <span class="inline-flex items-center gap-x-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $cat->nom }}
                            </span>
                        @endforeach
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                    <div class="flex justify-end gap-x-2">
                        <button type="button" @click="openModal({{ $film->id }})" class="size-8 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 transition-all">
                            <i data-lucide="edit-3" class="size-4 text-blue-600"></i>
                        </button>
                        <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="inline" @submit.prevent="if(confirm('{{ __('films.messages.confirm_delete') }}')) $el.submit()">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="size-8 inline-flex items-center justify-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 transition-all">
                                <i data-lucide="trash-2" class="size-4 text-red-500"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($films->hasPages())
<div class="px-6 py-4 border-t border-gray-200">
    {{ $films->links('partials.pagination') }}
</div>
@endif
