@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('messages.title') }}</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">{{ session('success') }}</div>
    @endif

    <div style="display: flex; justify-content: space-between; margin-bottom: 20px;">
        <input type="text" id="search" placeholder="{{ __('messages.search_placeholder') }}" style="padding: 10px; width: 300px;">
        <button id="openModal" style="padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer;">
            {{ __('messages.add_film') }}
        </button>
    </div>

    <table border="1" style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f4f4f4;">
                <th>{{ __('messages.titre') }}</th>
                <th>{{ __('messages.description') }}</th>
                <th>{{ __('messages.directeur') }}</th>
                <th>{{ __('messages.image') }}</th>
                <th>{{ __('messages.categories') }}</th>
            </tr>
        </thead>
        <tbody id="films-table">
            @include('films._table_body')
        </tbody>
    </table>
</div>

<div id="filmModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); overflow-y: auto;">
    <div style="background: white; width: 400px; margin: 50px auto; padding: 20px; border-radius: 5px;">
        @include('films._form')
    </div>
</div>
@endsection
