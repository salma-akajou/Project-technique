@forelse($films as $film)
    <a class="groupflex flex-col h-full bg-white border border-gray-200 shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7]" href="{{ route('films.show', $film->id) }}">
        <div class="h-52 flex flex-col justify-center items-center bg-gray-100 rounded-t-xl overflow-hidden relative">
             @if($film->image)
                <img src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->titre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out">
             @else
                <i data-lucide="film" class="size-12 text-gray-400"></i>
             @endif
        </div>
        <div class="p-4 md:p-6">
            <span class="block mb-1 text-xs font-semibold uppercase text-blue-600 dark:text-blue-500">
                {{ $film->categories->pluck('nom')->join(', ') }}
            </span>
            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 dark:hover:text-white">
                {{ $film->titre }}
            </h3>
            <p class="mt-3 text-gray-500 dark:text-gray-400 line-clamp-3">
                {{ $film->description }}
            </p>
        </div>
        <div class="mt-auto flex border-t border-gray-200 divide-x divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
            <div class="w-full py-3 px-4 flex items-center gap-x-3 text-sm font-medium text-gray-600 dark:text-gray-400">
                 <i data-lucide="user" class="size-4"></i>
                 {{ $film->directeur }}
            </div>
             <div class="w-full py-3 px-4 flex items-center justify-end gap-x-3 text-sm font-medium text-blue-600 dark:text-blue-500">
                 {{ __('messages.details') }}
                 <i data-lucide="chevron-right" class="size-4"></i>
            </div>
        </div>
    </a>
@empty
    <div class="col-span-full text-center p-10 bg-white border border-dashed border-gray-200 rounded-xl dark:bg-slate-900 dark:border-gray-700">
         <i data-lucide="film-x" class="mx-auto h-10 w-10 text-gray-400"></i>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('messages.no_results') }}</p>
    </div>
@endforelse
