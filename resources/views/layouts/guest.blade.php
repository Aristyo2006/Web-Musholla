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
            .emerald-gradient { background: linear-gradient(135deg, #064E3B 0%, #065F46 100%); }
            .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="antialiased text-gray-900 border-none outline-none">
        @include('partials.navbar', ['transparentTheme' => false])

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-24 sm:pt-0 emerald-gradient p-4 relative overflow-hidden">
            <!-- Unified Hero-style Background -->
            <div class="absolute inset-0 z-0">
                <img src="/images/hero.png" alt="Hero Background"
                    class="w-full h-full object-cover opacity-50 scale-105 blur-sm">
                <div class="absolute inset-0 bg-emerald-950/40"></div>
            </div>

            <!-- Decorative Elements (Mesh effect) -->
            <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none z-0">
                <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-white rounded-full blur-[150px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] bg-emerald-400 rounded-full blur-[200px]"></div>
            </div>

            <div class="w-full sm:max-w-md mt-16 md:mt-10 px-10 py-12 bg-white/10 backdrop-blur-2xl border border-white/20 shadow-[0_25px_50px_rgba(0,0,0,0.5)] overflow-hidden sm:rounded-[4rem] z-10 animate-fade-in">
                {{ $slot }}
            </div>
            
            <div class="mt-8 z-10">
                 <a href="/" class="text-emerald-100/60 hover:text-white text-sm transition font-black flex items-center gap-2 uppercase tracking-widest">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Halaman Utama
                 </a>
            </div>
        </div>
    </body>
</html>
