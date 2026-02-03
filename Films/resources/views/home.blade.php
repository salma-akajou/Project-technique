@extends('layouts.app')

@section('content')
<div class="bg-white border border-gray-200 rounded-xl shadow-sm max-w-[85rem] mx-auto">
    <div class="p-4 sm:p-7">
        <div class="border-b border-gray-200 pb-4 mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ __('Dashboard') }}</h2>
        </div>

        <div>
            @if (session('status'))
            <div class="bg-green-100 border border-green-200 text-sm text-green-800 rounded-lg p-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <p class="text-gray-600">
                {{ __('You are logged in!') }}
            </p>
        </div>
    </div>
</div>
@endsection


