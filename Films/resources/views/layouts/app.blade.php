<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films App</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-slate-900 dark:text-white">
    <!-- Header -->
    <header class="flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full bg-white border-b border-gray-200 text-sm py-4 dark:bg-slate-900 dark:border-gray-700">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:px-6 lg:px-8" aria-label="Global">
            <div class="relative flex items-center justify-between">
                <a class="flex-none text-xl font-semibold dark:text-white" href="{{ route('home') }}">Films App</a>
                <div class="flex items-center gap-5">
                    <a class="font-medium text-gray-600 hover:text-gray-400 dark:text-gray-400 dark:hover:text-gray-500" href="{{ route('home') }}" aria-current="page">Home</a>
                    <!-- Admin Dashboard Button -->
                    <a href="{{ route('films.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                        Dashboard Admin
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main id="content" class="min-h-screen">
        @yield('content')
    </main>

    <footer class="mt-auto py-6 w-full max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 border-t border-gray-200 dark:border-gray-700">
        <p class="text-gray-500 text-sm text-center">© {{ date('Y') }} Films App. All rights reserved.</p>
    </footer>
    <script>
        // Re-init lucide icons on dynamic content changes if needed
        document.addEventListener('DOMContentLoaded', () => {
             // Lucide icons are inited in app.js, but if we have ajax we might need to re-init.
             // We will handle that in the specific ajax scripts.
        });
    </script>
</body>
</html>