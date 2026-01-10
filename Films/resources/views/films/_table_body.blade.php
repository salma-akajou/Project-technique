@foreach($films as $film)
<tr>
    <td>{{ $film->titre }}</td>
    <td>{{ $film->description }}</td>
    <td>{{ $film->directeur }}</td>
    <td>
        @if($film->image)
            <img src="{{ asset('storage/' . $film->image) }}" width="50">
        @endif
    </td>
    <td>
        @foreach($film->categories as $cat)
            <span style="background: #eee; padding: 2px 5px; margin-right: 5px; font-size: 12px;">{{ $cat->nom }}</span>
        @endforeach
    </td>
</tr>
@endforeach
