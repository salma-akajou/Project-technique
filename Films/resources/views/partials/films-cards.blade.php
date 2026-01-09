@foreach($films as $film)
<a href="{{ route('films.show', $film->id) }}" class="group flex flex-col bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md transition-all overflow-hidden">
    <div class="aspect-video relative overflow-hidden bg-gray-100">
        @if($film->image)
            <img src="{{ asset('storage/'.$film->image) }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500" alt="{{ $film->titre }}">
        @else
            <div class="flex items-center justify-center h-full text-gray-400">
                <i data-lucide="clapperboard" class="size-12"></i>
            </div>
        @endif
        
        
        <div class="absolute top-3 right-3 flex gap-1">
            @foreach($film->categories->take(2) as $cat)
                <span class="py-1 px-2.5 bg-white/90 backdrop-blur rounded-full text-[10px] font-bold text-blue-600 uppercase tracking-wider">
                    {{ $cat->nom }}
                </span>
            @endforeach
        </div>
    </div>

    <div class="p-5">
        <h3 class="text-lg font-bold text-gray-800 group-hover:text-blue-600 transition-colors">
            {{ $film->titre }}
        </h3>
        <p class="mt-2 text-sm text-gray-500 line-clamp-2">
            {{ $film->description }}
        </p>
        
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
            <div class="flex items-center gap-x-2">
                <div class="size-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                    <i data-lucide="user" class="size-3"></i>
                </div>
                <span class="text-xs font-medium text-gray-600">{{ $film->directeur }}</span>
            </div>
            <div class="flex items-center text-blue-600 font-semibold text-sm">
                {{ __('messages.details') }}
                <i data-lucide="chevron-right" class="size-4 ms-1 group-hover:translate-x-1 transition-all"></i>
            </div>
        </div>
    </div>
</a>
@endforeach
