<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerita & Berita - {{ config('app.name', 'Donasi Musholla') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 scroll-smooth selection:bg-emerald-500 selection:text-white transition-colors duration-500">
    {{-- Decorative Background Blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/10 blur-[150px] animate-pulse transition-opacity duration-500"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[700px] h-[700px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[200px] transition-opacity duration-500"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('/images/pattern-dark.svg')] opacity-[0.01] dark:opacity-[0.03] transition-opacity duration-500"></div>
    </div>

    @include('partials.navbar')

    <main class="pt-32 sm:pt-40 pb-32 relative z-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Header section -->
            <div class="mb-20 text-center max-w-3xl mx-auto animate-fade-in">
                <div class="bg-emerald-500/10 dark:bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] px-5 py-2 rounded-full inline-block mb-6 shadow-2xl">Kabar Terbaru</div>
                <h1 class="text-4xl sm:text-7xl font-black text-zinc-900 dark:text-white mb-6 leading-tight tracking-tight">Kabar & Cerita <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400 dark:from-emerald-400 dark:to-amber-300 italic px-2">Inspiratif</span></h1>
                <p class="text-xl sm:text-2xl text-zinc-500 dark:text-emerald-100/40 leading-relaxed font-medium italic">Ikuti perkembangan terbaru dan kisah-kisah inspiratif dari Musholla Al-Kautsar.</p>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" 
                       class="group h-full flex flex-col bg-white dark:bg-white/5 backdrop-blur-3xl rounded-[3rem] overflow-hidden border border-emerald-100 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:shadow-[0_50px_100px_-20px_rgba(16,185,129,0.1)] dark:hover:shadow-[0_50px_100px_-20px_rgba(16,185,129,0.2)] hover:border-emerald-500/30">
                        <div class="h-72 overflow-hidden relative">
                            <img src="{{ $article->image ? Storage::url($article->image) : '/images/hero.png' }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/20 to-transparent"></div>
                            
                            <!-- Category Badge -->
                            <div class="absolute top-6 left-6">
                                <span class="px-4 py-2 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg">Kabar</span>
                            </div>
                        </div>
                        
                        <div class="p-10 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span class="text-zinc-400 dark:text-emerald-100/30 text-xs font-bold tracking-wider capitalize">
                                    {{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <h3 class="text-2xl font-black mb-6 line-clamp-2 leading-tight text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300">
                                {{ $article->title }}
                            </h3>

                            <p class="text-zinc-500 dark:text-emerald-100/40 text-base mb-10 line-clamp-3 leading-relaxed font-medium">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <div class="mt-auto pt-8 border-t border-emerald-100/50 dark:border-white/5 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-emerald-600 dark:bg-emerald-500 flex items-center justify-center text-white text-xs font-black overflow-hidden shadow-lg transform group-hover:rotate-6 transition-transform duration-500">
                                        @if($article->user && $article->user->profile_picture)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($article->user->profile_picture) }}"
                                                alt="A" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($article->user->name ?? 'A', 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-sm text-zinc-900 dark:text-white truncate max-w-[120px]">{{ $article->user->name ?? 'Admin Musholla' }}</span>
                                        <span class="text-[10px] text-zinc-400 dark:text-emerald-100/20 font-medium uppercase tracking-tighter">Kontributor</span>
                                    </div>
                                </div>
                                <div class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-white/5 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-600 dark:group-hover:bg-emerald-500 group-hover:text-white dark:group-hover:text-zinc-950 transition-all duration-500">
                                    <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-40 text-center bg-white/5 backdrop-blur-2xl rounded-[4rem] border border-white/10 shadow-2xl">
                        <div class="w-24 h-24 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-8 text-emerald-400 border border-emerald-500/10">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black text-white mb-2">Belum ada artikel</h3>
                        <p class="text-emerald-100/20 text-lg">Nantikan kabar terbaru dari kami segera.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination section -->
            <div class="mt-20">
                {{ $articles->links() }}
            </div>
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
