@extends('layouts.app')

@section('content')
<div class="mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ __('messages.dashboard') }}
        </h1>
        <p class="text-sm text-gray-500">{{ __('messages.welcome_admin') }}</p>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 size-[46px] bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="film" class="size-6"></i>
                </div>
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{ __('messages.total_films') }}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800">
                            {{ $totalFilms }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div class="flex-shrink-0 size-[46px] bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                    <i data-lucide="layers" class="size-6"></i>
                </div>
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            {{ __('messages.total_categories') }}
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800">
                            {{ $totalCategories }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm">
        <div class="p-4 md:p-5 flex justify-between items-center border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">
                {{ __('messages.recent_films') }}
            </h2>
            <a href="{{ route('films.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700">
                {{ __('messages.view_all') }}
            </a>
        </div>
        <div class="p-4 md:p-5">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase">{{ __('messages.title') }}</th>
                            <th class="px-6 py-3 text-start text-xs font-semibold text-gray-500 uppercase">{{ __('messages.director') }}</th>
                            <th class="px-6 py-3 text-end text-xs font-semibold text-gray-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentFilms as $film)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $film->titre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $film->directeur }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-end text-sm text-gray-500">{{ $film->created_at->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
