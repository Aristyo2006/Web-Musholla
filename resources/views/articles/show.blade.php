<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - {{ config('app.name', 'Donasi Musholla') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .article-content { 
            line-height: 1.9; 
            font-size: 1.25rem;
        }
        .article-content h1 { 
            font-size: 2.75rem; 
            font-weight: 900; 
            margin-top: 3.5rem; 
            margin-bottom: 2rem;
            letter-spacing: -0.025em;
            color: #064E3B;
        }
        .dark .article-content h1 { color: #f8fafc; }
        .article-content h2 { 
            font-size: 2.25rem; 
            font-weight: 800; 
            margin-top: 3rem; 
            margin-bottom: 1.5rem;
            letter-spacing: -0.025em;
        }
        .article-content p { margin-bottom: 2rem; }
        .article-content h3 {
            font-size: 1.65rem;
            font-weight: 800;
            margin-top: 2.25rem;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }
        .article-content ul,
        .article-content ol {
            margin: 0 0 2rem 1.75rem;
        }
        .article-content ul { list-style-type: disc; }
        .article-content ol { list-style-type: decimal; }
        .article-content li {
            margin-bottom: 0.75rem;
        }
        .article-content a {
            color: #059669;
            text-decoration: underline;
            text-underline-offset: 0.2em;
        }
        .article-content strong {
            font-weight: 800;
            color: inherit;
        }
        .article-content em { font-style: italic; }
        .article-content img { border-radius: 2rem; margin: 3rem auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1); max-width: 100%; height: auto; }
        .article-content blockquote {
            border-left: 6px solid #10b981;
            padding-left: 2rem;
            font-style: italic;
            font-size: 1.5rem;
            margin: 3rem 0;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 scroll-smooth selection:bg-emerald-500 selection:text-white transition-colors duration-500">
    {{-- Decorative Background Blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-5%] left-[-5%] w-[500px] h-[500px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/5 blur-[120px] transition-all duration-500"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[600px] h-[600px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[150px] transition-all duration-500"></div>
    </div>

    @include('partials.navbar')

    <main class="pt-32 sm:pt-48 pb-32 relative z-10">
        <article class="max-w-5xl mx-auto px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-3 text-xs font-black text-emerald-700/40 dark:text-emerald-400/40 mb-10 overflow-hidden whitespace-nowrap uppercase tracking-widest transition-colors duration-500">
                <a href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Beranda</a>
                <span class="text-zinc-900/10 dark:text-white/10">/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">Artikel</a>
                <span class="text-zinc-900/10 dark:text-white/10">/</span>
                <span class="text-zinc-900/60 dark:text-white/60 truncate">{{ $article->title }}</span>
            </nav>

            <!-- Hero Section -->
            <header class="mb-16 md:mb-24">
                <div class="flex items-center gap-5 mb-8 md:mb-12">
                    <span class="px-5 py-2 bg-emerald-600/10 dark:bg-emerald-500/10 border border-emerald-600/20 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] rounded-full shadow-2xl transition-all duration-500">Update Cerita</span>
                    <span class="text-zinc-400 dark:text-white/20 font-black text-[10px] uppercase tracking-widest transition-colors duration-500">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                </div>
                
                <h1 class="text-4xl xs:text-5xl md:text-8xl font-black text-zinc-900 dark:text-white leading-[1] tracking-tighter mb-12 md:mb-20 transition-colors duration-500">
                    {{ $article->title }}
                </h1>

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 py-10 border-y border-emerald-100 dark:border-white/5 mb-12 md:mb-20 transition-colors duration-500">
                    <div class="flex items-center gap-4 md:gap-6">
                        <div class="w-16 h-16 md:w-20 md:h-20 rounded-3xl bg-white dark:bg-white/5 border border-emerald-200 dark:border-white/10 flex items-center justify-center text-zinc-900 dark:text-white text-xl md:text-2xl font-black overflow-hidden shadow-2xl backdrop-blur-xl transition-all duration-500">
                            @if($article->user && $article->user->profile_picture)
                                <img src="{{ asset('storage/' . $article->user->profile_picture) }}" alt="A" class="w-full h-full object-cover">
                            @else
                                {{ substr($article->user->name ?? 'A', 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-emerald-700/40 dark:text-emerald-400/40 uppercase tracking-[0.3em] mb-1.5 transition-colors duration-500">Ditulis Oleh</p>
                            <h4 class="text-xl md:text-2xl font-black text-zinc-900 dark:text-white tracking-tight transition-colors duration-500">{{ $article->user->name ?? 'Admin Musholla' }}</h4>
                        </div>
                    </div>
                    
                    {{-- Share Buttons (Placeholder visual) --}}
                    <div class="flex items-center gap-3">
                        <div class="px-6 py-3 bg-white dark:bg-white/5 border border-emerald-200 dark:border-white/10 rounded-2xl text-zinc-400 dark:text-white/40 text-xs font-black uppercase tracking-widest hover:bg-emerald-50 dark:hover:bg-white/10 transition-all cursor-pointer shadow-xl duration-500">Bagikan Cerita</div>
                    </div>
                </div>

                @if($article->image)
                    <div class="relative w-full aspect-[21/9] rounded-[3.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.2)] dark:shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] border border-emerald-100 dark:border-white/5 transition-all duration-500">
                        <div class="absolute inset-0 bg-emerald-950/10 dark:bg-emerald-950/20 mix-blend-multiply"></div>
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover grayscale-[0.1] dark:grayscale-0">
                    </div>
                @endif
            </header>

            <!-- Content Area - Wrapped in Glass Card -->
            <div class="relative bg-white dark:bg-white/[0.02] backdrop-blur-3xl rounded-[4rem] border border-emerald-100 dark:border-white/5 p-8 md:p-20 shadow-2xl transition-all duration-500">
                <div class="article-content prose dark:prose-invert prose-emerald prose-2xl max-w-none text-zinc-700 dark:text-emerald-50/80 !leading-[1.8] font-medium transition-colors duration-500">
                    {!! $article->content !!}
                </div>
            </div>

            </div>
        </article>

        <!-- Related Stories -->
        @if($relatedArticles->count() > 0)
        <section class="mt-48 max-w-7xl mx-auto px-6 lg:px-8">
            <h3 class="text-4xl font-black text-zinc-900 dark:text-white mb-16 flex items-center justify-between tracking-tight transition-colors duration-500">
                Cerita <span class="bg-white dark:bg-white/5 border border-emerald-100 dark:border-white/10 px-6 py-2 rounded-full ml-4 shadow-xl">Lainnya</span>
                <a href="{{ route('articles.index') }}" class="text-xs text-emerald-700 dark:text-emerald-400 font-black uppercase tracking-widest hover:text-emerald-900 dark:hover:text-white transition-all border-b border-emerald-400/20 pb-1">Lihat Semua</a>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($relatedArticles as $related)
                    <a href="{{ route('articles.show', $related->slug) }}" class="group block h-full bg-white dark:bg-white/5 backdrop-blur-3xl rounded-[2.5rem] overflow-hidden border border-emerald-100 dark:border-white/10 hover:border-emerald-500/20 transition-all duration-500 hover:scale-[1.02] shadow-2xl shadow-emerald-950/5 dark:shadow-none hover:bg-emerald-50 dark:hover:bg-white/[0.08]">
                        <div class="aspect-video overflow-hidden relative">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : '/images/hero.png' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/40 via-transparent to-transparent opacity-60"></div>
                        </div>
                        <div class="p-8">
                            <h4 class="text-xl font-black text-zinc-900 dark:text-white leading-tight line-clamp-2 group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors tracking-tight">{{ $related->title }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    @include('partials.footer')
</body>
</html>
