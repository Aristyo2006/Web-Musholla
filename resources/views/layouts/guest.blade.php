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
        <!-- Header Identik -->
        <header class="fixed w-full z-50 transition-all duration-300" id="main-header">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center bg-white/20 backdrop-blur-md rounded-full mt-4 mx-4 border border-white/20 transition-all">
                <div class="flex items-center gap-2">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-emerald-700 rounded-lg flex items-center justify-center group-hover:bg-emerald-600 transition-colors">
                            <x-application-logo class="w-6 h-6 text-white" />
                        </div>
                        <span class="text-xl font-black text-white tracking-tight">DonasiMusholla</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center gap-8 text-white font-medium">
                    <a href="{{ url('/') }}#hero" class="hover:text-amber-400 transition">Beranda</a>
                    <a href="{{ url('/') }}#carousel" class="hover:text-amber-400 transition">Galeri</a>
                    <a href="{{ url('/') }}#articles" class="hover:text-amber-400 transition">Artikel</a>
                    <div class="flex items-center gap-4">
                        @if(request()->routeIs('login'))
                            <a href="{{ route('register') }}" class="px-5 py-2 bg-amber-600 rounded-full hover:bg-amber-700 transition shadow-lg text-sm font-bold">Daftar</a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 bg-emerald-600 rounded-full hover:bg-emerald-700 transition shadow-lg text-sm font-bold">Masuk</a>
                        @endif
                    </div>
                </div>
            </nav>
        </header>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-24 sm:pt-0 emerald-gradient p-4 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div class="absolute top-10 left-10 w-64 h-64 bg-white rounded-full blur-[120px]"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-400 rounded-full blur-[150px]"></div>
            </div>

            <div class="w-full sm:max-w-md mt-10 px-10 py-12 bg-white/10 backdrop-blur-2xl border border-white/20 shadow-[0_25px_50px_rgba(0,0,0,0.4)] overflow-hidden sm:rounded-[3rem] z-10 animate-fade-in">
                {{ $slot }}
            </div>
            
            <div class="mt-8 z-10">
                 <a href="/" class="text-emerald-100/60 hover:text-white text-sm transition font-medium flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Halaman Utama
                 </a>
            </div>
        </div>
    </body>
</html>
