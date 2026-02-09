<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Films</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">
    <nav class="sticky top-0 z-50 glass bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Films
                    </a>
                </div>

                <div class="flex items-center space-x-6">
                    @auth
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-700">
                                Bonjour,
                            </span>
                            @if (Auth::user()->is_admin)
                                <span class="inline-flex items-center rounded-full bg-red-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                    Admin
                                </span>
                            @else
                                <span class="inline-flex items-center rounded-full bg-sky-600 px-2.5 py-0.5 text-xs font-semibold text-white">
                                    Rédacteur
                                </span>
                            @endif
                        </div>
                    @endauth

                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors">{{ __('Login') }}</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors">{{ __('Register') }}</a>
                        @endif
                    @else
                        <div class="relative inline-flex" data-user-menu>
                            <button type="button" data-user-menu-button class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition-colors flex items-center gap-x-1 focus:outline-none">
                                {{ Auth::user()->name }}
                                <svg class="size-4 transition-transform" data-user-menu-icon xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                            </button>
                            <div class="absolute right-0 top-full mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-[9999] hidden" data-user-menu-dropdown>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
