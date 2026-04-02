<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - {{ config('app.name', 'Donasi Musholla') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .article-content { 
            line-height: 1.9; 
            font-size: 1.15rem;
            color: #374151;
        }
        .article-content h2 { 
            font-size: 2.25rem; 
            font-weight: 800; 
            color: #111827; 
            margin-top: 3rem; 
            margin-bottom: 1.5rem;
            letter-spacing: -0.025em;
        }
        .article-content p { margin-bottom: 2rem; }
        .article-content img { border-radius: 2rem; margin: 3rem auto; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1); }
        .article-content blockquote {
            border-left: 6px solid #10b981;
            padding-left: 2rem;
            font-style: italic;
            font-size: 1.5rem;
            color: #064e3b;
            margin: 3rem 0;
            font-weight: 500;
        }
    </style>
</head>
<body class="bg-white text-gray-900 scroll-smooth">
    @include('partials.navbar')

    <main class="pt-40 pb-24">
        <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-sm font-medium text-gray-400 mb-10 overflow-hidden whitespace-nowrap">
                <a href="/" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <a href="{{ route('articles.index') }}" class="hover:text-emerald-600 transition-colors">Artikel</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="text-emerald-800 truncate">{{ $article->title }}</span>
            </nav>

            <!-- Hero Section -->
            <header class="mb-12 md:mb-16">
                <div class="flex items-center gap-4 mb-6 md:mb-8">
                    <span class="px-4 md:px-5 py-1.5 md:py-2 bg-emerald-50 text-emerald-700 text-[10px] md:text-xs font-black uppercase tracking-widest rounded-full shadow-sm">Update Cerita</span>
                    <span class="text-gray-400 font-bold text-[10px] md:text-sm tracking-tighter">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                </div>
                
                <h1 class="text-4xl xs:text-5xl md:text-7xl font-black text-gray-900 leading-[1.1] tracking-tighter mb-8 md:mb-12">
                    {{ $article->title }}
                </h1>

                <div class="flex items-center justify-between py-6 md:py-8 border-y border-gray-100 mb-8 md:mb-12">
                    <div class="flex items-center gap-3 md:gap-4">
                        <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl md:rounded-2xl bg-emerald-700 flex items-center justify-center text-white text-lg md:text-xl font-black overflow-hidden shadow-xl shadow-emerald-900/10">
                            @if($article->user && $article->user->profile_picture)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($article->user->profile_picture) }}" alt="A" class="w-full h-full object-cover">
                            @else
                                {{ substr($article->user->name ?? 'A', 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-0.5">Penulis</p>
                            <h4 class="text-lg font-black text-gray-900 tracking-tight">{{ $article->user->name ?? 'Admin Musholla' }}</h4>
                        </div>
                    </div>
                </div>

                @if($article->image)
                    <div class="relative w-full aspect-[21/9] rounded-[3rem] overflow-hidden shadow-2xl shadow-emerald-900/10">
                        <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif
            </header>

            <!-- Content Area -->
            <div class="article-content prose prose-emerald prose-xl max-w-none">
                {!! nl2br($article->content) !!}
            </div>

            </div>
        </article>

        <!-- Related Stories -->
        @if($relatedArticles->count() > 0)
        <section class="mt-32 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-3xl font-black text-gray-900 mb-12 flex items-center justify-between">
                Cerita Lainnya
                <a href="{{ route('articles.index') }}" class="text-base text-emerald-600 font-bold hover:underline">Lihat Semua</a>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($relatedArticles as $related)
                    <a href="{{ route('articles.show', $related->slug) }}" class="group block">
                        <div class="aspect-video rounded-[2rem] overflow-hidden mb-6 shadow-lg shadow-emerald-900/5">
                            <img src="{{ $related->image ? Storage::url($related->image) : '/images/hero.png' }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 line-clamp-2 group-hover:text-emerald-700 transition-colors">{{ $related->title }}</h4>
                    </a>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    @include('partials.footer')
</body>
</html>
