<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
        @include('partials.theme-manager')
        @include('partials.favicons')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Outfit', sans-serif; }
            .bg-emerald-subtle { background-color: #f0fdf4; }
            .emerald-gradient { background: linear-gradient(135deg, #064E3B 0%, #065F46 100%); }
            .gold-accent { color: #D97706; }
        </style>

        @stack('styles')
    </head>
    <body class="antialiased bg-gray-50/50">
        <div class="min-h-screen relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-emerald-100/30 blur-[120px] rounded-full -z-10 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-1/3 h-1/3 bg-amber-50/50 blur-[100px] rounded-full -z-10 pointer-events-none"></div>

            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative z-10">
                {{ $slot }}
            </main>
        </div>

        @stack('scripts')
    </body>
</html>
