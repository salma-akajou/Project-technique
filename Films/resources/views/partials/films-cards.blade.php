@forelse($films as $film)
    <div class="bg-white rounded-lg shadow p-4">
        <img 
            src="{{ asset('storage/' . $film->image) }}" 
            alt="{{ $film->titre }}" 
            class="w-full h-48 object-cover rounded mb-2"
        >

        <h3 class="text-lg font-bold mb-1">{{ $film->titre }}</h3>

        <p class="text-gray-600 text-sm mb-2">{{ $film->description }}</p>

        <p class="text-gray-800 text-sm font-semibold">{{ $film->directeur }}</p>

        <!-- Badges categories -->
        <div class="flex flex-wrap gap-2 mt-2">
            @foreach($film->categories as $categorie)
                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded">
                    {{ $categorie->nom }}
                </span>
            @endforeach
        </div>

        <a href="{{ route('films.show', $film->id) }}" class="text-blue-500 mt-2 inline-block text-sm">
            {{ __('messages.details') }}
        </a>
    </div>
@empty
    <p>{{ __('messages.no_results') }}</p>
@endforelse
