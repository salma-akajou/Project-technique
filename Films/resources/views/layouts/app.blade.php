<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-white border-b border-gray-200 text-sm py-4 shadow-sm">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:px-6 lg:px-8" aria-label="Global">
            <div class="relative flex items-center justify-between">
                <a class="text-2xl font-black text-blue-600 tracking-tighter" href="{{ route('home') }}">
                    FILMS
                </a>
                <div class="flex items-center gap-5">
                    @if(!Request::is('admin*'))
                        <a class="font-medium text-gray-600 hover:text-blue-600" href="{{ route('home') }}">Home</a>
                        <a href="{{ route('films.index') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 transition-all">
                            {{ __('films.admin_dashboard') }}
                        </a>
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <div class="flex-grow flex flex-col max-w-[85rem] w-full mx-auto px-4 sm:px-6 lg:px-8">
        <main class="flex-grow py-10">
            @if(session('success'))
                <div class="mb-4">
                    <div class="bg-teal-50 border-t-2 border-teal-500 rounded-lg p-4" role="alert">
                        <div class="flex">
                            <div class="ms-3">
                                <p class="text-sm text-teal-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <footer class="mt-auto py-5 border-t border-gray-200 bg-white">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-gray-500 text-sm text-center">© {{ date('Y') }} Films. All rights reserved.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
