<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian: "{{ $query }}" — {{ config('app.name', 'Donasi Musholla') }}</title>
    <meta name="description" content="Hasil pencarian untuk '{{ $query }}' di Musholla Al-Kautsar.">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <style>
        body { font-family: 'Outfit', sans-serif; }
        
        .search-hero-gradient {
            background: radial-gradient(circle at 50% -20%, rgba(16,185,129,0.15) 0%, transparent 70%);
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass-container {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .result-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .result-card:hover {
            transform: translateY(-8px);
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.1);
        }
        .dark .result-card:hover {
            border-color: rgba(16, 185, 129, 0.4);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 1rem;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.25em;
            transition: all 0.2s;
        }

        .search-input-focus:focus-within {
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        /* Override @tailwindcss/forms plugin defaults */
        .glass-container input[type="text"] {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            background: transparent !important;
            padding: 0 !important;
        }
        .glass-container input[type="text"]:focus {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
            --tw-ring-shadow: none !important;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 scroll-smooth transition-colors duration-500 antialiased">

    <!-- Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] rounded-full bg-emerald-600/10 blur-[150px] animate-pulse"></div>
        <div class="absolute bottom-[10%] right-[-10%] w-[800px] h-[800px] rounded-full bg-amber-500/5 blur-[180px]"></div>
    </div>

    @include('partials.navbar')

    <main class="pt-40 pb-32 relative z-10 min-h-screen">
        <!-- Search Hero -->
        <section class="search-hero-gradient pb-20">
            <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
                <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-3 text-[10px] font-black text-emerald-800/40 dark:text-emerald-400/40 mb-8 uppercase tracking-[0.3em]">
                    <a href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Beranda</a>
                    <span class="opacity-30">/</span>
                    <span class="text-zinc-900/80 dark:text-white/80">Pencarian</span>
                </div>

                <p class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.4em] mb-4">
                    {{ $totalResults > 0 ? $totalResults . ' Hasil Ditemukan' : 'Mulai Menjelajah' }}
                </p>
                <h1 class="text-5xl md:text-7xl font-black tracking-tighter text-zinc-900 dark:text-white mb-12 leading-[1.1] md:leading-[1]">
                    @if($query)
                        "{{ $query }}"
                    @else
                        Cari Apapun
                    @endif
                </h1>

                <!-- CLEAN SEARCH BAR ON RESULTS PAGE -->
                <form action="{{ route('search') }}" method="GET" class="relative max-w-2xl mx-auto">
                    <div class="glass-container search-input-focus flex items-center gap-4 px-6 py-4 rounded-[2rem] shadow-xl shadow-emerald-900/5 dark:shadow-black/40 transition-all duration-300">
                        <svg class="w-6 h-6 text-emerald-500/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            name="q"
                            value="{{ $query }}"
                            placeholder="Ketik kata kunci di sini..."
                            class="flex-1 bg-transparent outline-none text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-white/20 font-semibold text-lg md:text-xl tracking-tight"
                        >
                        @if($query)
                            <a href="{{ route('search') }}" class="w-8 h-8 flex items-center justify-center text-zinc-300 dark:text-white/20 hover:text-red-500 hover:bg-red-500/10 rounded-full transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                        <button type="submit" class="px-7 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-2xl transition-all active:scale-95 text-xs uppercase tracking-widest shadow-lg shadow-emerald-600/20">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-24">

            @if(!$query || strlen(trim($query)) < 2)
                <!-- Empty State: No Query -->
                <div class="text-center py-24">
                    <div class="w-24 h-24 mx-auto mb-10 bg-emerald-50 dark:bg-white/5 rounded-[2.5rem] flex items-center justify-center shadow-inner">
                        <svg class="w-12 h-12 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-zinc-900 dark:text-white mb-4">Temukan apa yang Anda cari</h2>
                    <p class="text-zinc-500 dark:text-white/40 font-medium max-w-sm mx-auto leading-relaxed">Ketikkan minimal 2 karakter untuk melihat hasil yang relevan dari Musholla Al-Kautsar.</p>
                </div>

            @elseif($totalResults === 0)
                <!-- Empty State: No Results -->
                <div class="text-center py-24">
                    <div class="w-24 h-24 mx-auto mb-10 bg-zinc-100 dark:bg-white/5 rounded-[2.5rem] flex items-center justify-center">
                        <svg class="w-12 h-12 text-zinc-300 dark:text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-zinc-900 dark:text-white mb-4">Ups! Tidak ditemukan hasil</h2>
                    <p class="text-zinc-500 dark:text-white/40 font-medium mb-10">Kami tidak menemukan hasil untuk <span class="text-emerald-600 dark:text-emerald-400 font-bold">"{{ $query }}"</span>. Coba kata kunci lainnya.</p>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('campaigns.index') }}" class="px-6 py-3 bg-white dark:bg-white/5 border border-zinc-200 dark:border-white/10 text-emerald-700 dark:text-emerald-400 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-emerald-50 transition shadow-sm">Donasi</a>
                        <a href="{{ route('articles.index') }}" class="px-6 py-3 bg-white dark:bg-white/5 border border-zinc-200 dark:border-white/10 text-emerald-700 dark:text-emerald-400 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-emerald-50 transition shadow-sm">Artikel</a>
                    </div>
                </div>

            @else

                {{-- ============================================================ --}}
                {{-- SECTION: Program Donasi --}}
                {{-- ============================================================ --}}
                @if($campaigns->count() > 0)
                <section>
                    <div class="flex items-center gap-4 mb-10">
                        <span class="section-badge bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            Program Donasi
                        </span>
                        <span class="text-[10px] font-bold text-zinc-400 dark:text-white/20 uppercase tracking-widest">{{ $campaigns->count() }} program</span>
                        <div class="flex-1 h-px bg-zinc-200 dark:bg-white/5"></div>
                        <a href="{{ route('campaigns.index') }}" class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] hover:text-emerald-800 transition">Lihat Semua →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($campaigns as $campaign)
                            <a href="{{ route('donasi.index', $campaign->slug) }}" class="result-card group bg-white dark:bg-zinc-900/40 border border-zinc-200 dark:border-white/5 rounded-[2.5rem] overflow-hidden shadow-xl shadow-emerald-900/5 flex flex-col">
                                @if($campaign->image)
                                    <div class="aspect-[4/3] overflow-hidden relative">
                                        <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                        @if($campaign->end_date)
                                            <span class="absolute bottom-4 left-4 px-3 py-1 bg-white/10 backdrop-blur-md border border-white/20 text-white text-[9px] font-black uppercase tracking-widest rounded-full">
                                                Sampai {{ $campaign->end_date->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <div class="p-8 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-xl font-black text-zinc-900 dark:text-white leading-tight tracking-tight mb-3 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $campaign->title }}</h3>
                                        @if($campaign->description)
                                            <p class="text-sm text-zinc-500 dark:text-white/40 line-clamp-2 leading-relaxed">{{ strip_tags($campaign->description) }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-6 flex items-center gap-2 text-emerald-600 dark:text-emerald-400 text-xs font-black uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-all transform translate-x-[-10px] group-hover:translate-x-0">
                                        Lihat Detail
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- ============================================================ --}}
                {{-- SECTION: Artikel --}}
                {{-- ============================================================ --}}
                @if($articles->count() > 0)
                <section>
                    <div class="flex items-center gap-4 mb-10">
                        <span class="section-badge bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Artikel
                        </span>
                        <span class="text-[10px] font-bold text-zinc-400 dark:text-white/20 uppercase tracking-widest">{{ $articles->count() }} artikel</span>
                        <div class="flex-1 h-px bg-zinc-200 dark:bg-white/5"></div>
                        <a href="{{ route('articles.index') }}" class="text-[10px] font-black text-amber-600 dark:text-amber-400 uppercase tracking-[0.2em] hover:text-amber-800 transition">Lihat Semua →</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($articles as $article)
                            <a href="{{ route('articles.show', $article->slug) }}" class="result-card group bg-white dark:bg-zinc-900/40 border border-zinc-200 dark:border-white/5 rounded-[2.5rem] overflow-hidden shadow-xl shadow-emerald-900/5 flex flex-col">
                                @if($article->image)
                                    <div class="aspect-[4/3] overflow-hidden relative">
                                        <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                        <span class="absolute bottom-4 left-4 px-3 py-1 bg-white/10 backdrop-blur-md border border-white/20 text-white text-[9px] font-black uppercase tracking-widest rounded-full">
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                @else
                                    <div class="aspect-[4/3] bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/10 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-amber-300/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                    </div>
                                @endif
                                <div class="p-8 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-xl font-black text-zinc-900 dark:text-white leading-tight tracking-tight mb-3 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">{{ $article->title }}</h3>
                                        <p class="text-sm text-zinc-500 dark:text-white/40 line-clamp-2 leading-relaxed">{{ strip_tags($article->content) }}</p>
                                    </div>
                                    <div class="mt-6 flex items-center gap-2 text-amber-600 dark:text-amber-400 text-xs font-black uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-all transform translate-x-[-10px] group-hover:translate-x-0">
                                        Baca Artikel
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- ============================================================ --}}
                {{-- SECTION: Galeri --}}
                {{-- ============================================================ --}}
                @if($galleries->count() > 0)
                <section>
                    <div class="flex items-center gap-4 mb-10">
                        <span class="section-badge bg-violet-100 dark:bg-violet-500/10 text-violet-700 dark:text-violet-400 border border-violet-200 dark:border-violet-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Galeri
                        </span>
                        <span class="text-[10px] font-bold text-zinc-400 dark:text-white/20 uppercase tracking-widest">{{ $galleries->count() }} foto</span>
                        <div class="flex-1 h-px bg-zinc-200 dark:bg-white/5"></div>
                        <a href="{{ route('galleries.index') }}" class="text-[10px] font-black text-violet-600 dark:text-violet-400 uppercase tracking-[0.2em] hover:text-violet-800 transition">Lihat Semua →</a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($galleries as $gallery)
                            <a href="{{ route('galleries.index') }}" class="result-card group relative aspect-square rounded-[2rem] overflow-hidden bg-white dark:bg-white/5 border border-zinc-200 dark:border-white/5 shadow-lg">
                                @if($gallery->image)
                                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                                    <div>
                                        @if($gallery->title)
                                            <p class="text-white text-base font-black leading-tight mb-1">{{ $gallery->title }}</p>
                                        @endif
                                        <div class="flex items-center gap-2 text-white/60 text-[9px] font-bold uppercase tracking-[0.2em]">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            Lihat Foto
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif

            @endif
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
