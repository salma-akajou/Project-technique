@foreach($films as $film)
<tr>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $film->titre }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $film->directeur }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $film->description }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
        <div class="flex flex-wrap gap-1">
            @forelse($film->categories as $cat)
                <span class="inline-flex items-center gap-x-1.5 py-1 px-2 rounded-lg text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $cat->nom }}
                </span>
            @empty
                <span class="text-gray-400">Aucune</span>
            @endforelse
        </div>
    </td>
</tr>
@endforeach
