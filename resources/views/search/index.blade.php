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

        /* --- Card Backgrounds (defined here so they always work) --- */
        .result-card {
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .result-card {
            background: rgba(24, 24, 27, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: none;
        }
        .result-card:hover {
            transform: translateY(-6px);
            border-color: rgba(16, 185, 129, 0.3);
        }
        .dark .result-card:hover {
            border-color: rgba(16, 185, 129, 0.25);
        }

        /* --- Section Badge --- */
        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 1.25rem;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.25em;
        }

        /* --- Search Bar --- */
        .search-bar-container {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0,0,0,0.06);
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }
        .dark .search-bar-container {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: none;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 scroll-smooth transition-colors duration-500 antialiased overflow-x-hidden">

    <!-- Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-5%] w-[500px] h-[500px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/10 blur-[120px] transition-all duration-500"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[150px] transition-all duration-500"></div>
    </div>

    @include('partials.navbar')

    <main class="pt-40 pb-32 relative z-10 min-h-screen">
        <!-- Search Header Section -->
        <section class="pb-16 md:pb-24">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">
                <!-- Breadcrumb -->
                <div class="flex items-center justify-center gap-3 text-[10px] font-black text-emerald-800/30 dark:text-emerald-400/30 mb-10 uppercase tracking-[0.3em]">
                    <a href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Beranda</a>
                    <span class="opacity-30">/</span>
                    <span class="text-zinc-900/60 dark:text-white/60">Hasil Pencarian</span>
                </div>

                <div class="text-center space-y-4 mb-12">
                    <p class="text-[11px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.5em]">
                        {{ $totalResults > 0 ? $totalResults . ' HASIL DITEMUKAN' : 'HASIL PENCARIAN' }}
                    </p>
                    <h1 class="text-4xl md:text-7xl font-black tracking-tighter text-zinc-900 dark:text-white leading-[1.1]">
                        @if($query)
                            "{{ $query }}"
                        @else
                            Cari Apapun
                        @endif
                    </h1>
                </div>

                <!-- SEARCH BAR -->
                <form action="{{ route('search') }}" method="GET" class="relative max-w-2xl mx-auto">
                    <div class="search-bar-container flex items-center gap-4 px-6 py-4 rounded-3xl transition-all duration-500">
                        <svg class="w-6 h-6 text-emerald-500/60 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input
                            type="text"
                            name="q"
                            value="{{ $query }}"
                            placeholder="Apa yang ingin Anda cari?"
                            class="flex-1 bg-transparent border-none focus:ring-0 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-white/20 font-bold text-lg md:text-xl tracking-tight p-0"
                        >
                        @if($query)
                            <a href="{{ route('search') }}" class="w-8 h-8 flex items-center justify-center text-zinc-400 dark:text-white/20 hover:text-red-500 transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                        <button type="submit" class="px-8 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-black rounded-2xl transition-all active:scale-95 text-xs uppercase tracking-widest shadow-xl shadow-emerald-600/20">
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-24">

            @if(!$query || strlen(trim($query)) < 2)
                <!-- Empty State -->
                <div class="text-center py-24">
                    <div class="w-24 h-24 mx-auto mb-10 bg-emerald-100/50 dark:bg-emerald-500/5 rounded-[2.5rem] flex items-center justify-center border border-emerald-500/10">
                        <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-zinc-900 dark:text-white mb-4">Mulai Pencarian Anda</h2>
                    <p class="text-zinc-500 dark:text-emerald-100/20 font-medium max-w-sm mx-auto leading-relaxed italic">Gunakan kata kunci untuk menemukan program donasi, artikel edukatif, atau dokumentasi galeri kami.</p>
                </div>

            @elseif($totalResults === 0)
                <!-- No Results -->
                <div class="text-center py-24">
                    <div class="w-24 h-24 mx-auto mb-10 bg-zinc-100 dark:bg-white/5 rounded-[2.5rem] flex items-center justify-center">
                        <svg class="w-10 h-10 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-zinc-900 dark:text-white mb-4">Tidak Ada Hasil</h2>
                    <p class="text-zinc-500 dark:text-emerald-100/20 font-medium mb-12">Kata kunci <span class="text-emerald-600 dark:text-emerald-400 font-bold">"{{ $query }}"</span> tidak menemukan kecocokan apapun.</p>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <a href="{{ route('campaigns.index') }}" class="px-8 py-4 bg-emerald-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:scale-105 transition shadow-lg">Lihat Program</a>
                        <a href="{{ route('articles.index') }}" class="px-8 py-4 bg-white dark:bg-white/5 border border-zinc-200 dark:border-white/10 text-emerald-700 dark:text-emerald-400 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-emerald-50 transition">Baca Artikel</a>
                    </div>
                </div>

            @else

                {{-- SECTION: Program Donasi --}}
                @if($campaigns->count() > 0)
                <section>
                    <div class="flex items-center justify-between mb-12 border-b border-zinc-100 dark:border-white/5 pb-6">
                        <div class="flex items-center gap-4">
                            <span class="section-badge bg-emerald-100 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                Program Donasi
                            </span>
                            <span class="text-[10px] font-bold text-zinc-400 dark:text-white/20 uppercase tracking-widest">{{ $campaigns->count() }} TEMUAN</span>
                        </div>
                        <a href="{{ route('campaigns.index') }}" class="text-[10px] font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-[0.2em] hover:opacity-70 transition">LIHAT SEMUA —</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($campaigns as $campaign)
                            <a href="{{ route('donasi.index', $campaign->slug) }}" class="result-card group rounded-[2.5rem] overflow-hidden flex flex-col">
                                @if($campaign->image)
                                    <div class="aspect-[4/3] overflow-hidden relative">
                                        <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    </div>
                                @endif
                                <div class="p-8 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-xl font-black text-zinc-900 dark:text-white leading-tight mb-4 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $campaign->title }}</h3>
                                        @if($campaign->description)
                                            <p class="text-sm text-zinc-500 dark:text-emerald-100/30 line-clamp-2 leading-relaxed italic">{{ strip_tags($campaign->description) }}</p>
                                        @endif
                                    </div>
                                    <div class="mt-8 flex items-center gap-3">
                                        <span class="w-8 h-0.5 bg-emerald-500 rounded-full group-hover:w-12 transition-all duration-500"></span>
                                        <span class="text-emerald-600 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest">Lihat Detail</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- SECTION: Artikel --}}
                @if($articles->count() > 0)
                <section>
                    <div class="flex items-center justify-between mb-12 border-b border-zinc-100 dark:border-white/5 pb-6">
                        <div class="flex items-center gap-4">
                            <span class="section-badge bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Artikel
                            </span>
                            <span class="text-[10px] font-bold text-zinc-400 dark:text-white/20 uppercase tracking-widest">{{ $articles->count() }} TEMUAN</span>
                        </div>
                        <a href="{{ route('articles.index') }}" class="text-[10px] font-black text-amber-600 dark:text-amber-400 uppercase tracking-[0.2em] hover:opacity-70 transition">LIHAT SEMUA —</a>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($articles as $article)
                            <a href="{{ route('articles.show', $article->slug) }}" class="result-card group rounded-[2.5rem] overflow-hidden flex flex-col">
                                @if($article->image)
                                    <div class="aspect-[4/3] overflow-hidden relative">
                                        <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    </div>
                                @endif
                                <div class="p-8 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 mb-4">
                                            <div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div>
                                            <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-widest">{{ $article->created_at->format('d M Y') }}</span>
                                        </div>
                                        <h3 class="text-xl font-black text-zinc-900 dark:text-white leading-tight mb-4 group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">{{ $article->title }}</h3>
                                        <p class="text-sm text-zinc-500 dark:text-emerald-100/30 line-clamp-2 leading-relaxed italic">{{ strip_tags($article->content) }}</p>
                                    </div>
                                    <div class="mt-8 flex items-center gap-3">
                                        <span class="w-8 h-0.5 bg-amber-500 rounded-full group-hover:w-12 transition-all duration-500"></span>
                                        <span class="text-amber-600 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest">Baca Artikel</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
                @endif

                {{-- SECTION: Galeri --}}
                @if($galleries->count() > 0)
                <section>
                    <div class="flex items-center justify-between mb-12 border-b border-zinc-100 dark:border-white/5 pb-6">
                        <div class="flex items-center gap-4">
                            <span class="section-badge bg-violet-100 dark:bg-violet-500/10 text-violet-700 dark:text-violet-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Galeri Foto
                            </span>
                            <span class="text-[10px] font-bold text-zinc-400 dark:text-white/20 uppercase tracking-widest">{{ $galleries->count() }} TEMUAN</span>
                        </div>
                        <a href="{{ route('galleries.index') }}" class="text-[10px] font-black text-violet-600 dark:text-violet-400 uppercase tracking-[0.2em] hover:opacity-70 transition">LIHAT SEMUA —</a>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                        @foreach($galleries as $gallery)
                            <a href="{{ route('galleries.index') }}" class="result-card group relative aspect-square rounded-3xl overflow-hidden">
                                @if($gallery->image)
                                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-6">
                                    <p class="text-white text-xs font-black leading-tight mb-2 line-clamp-2 uppercase tracking-tighter">{{ $gallery->title ?? 'Untitled' }}</p>
                                    <div class="flex items-center gap-2 text-emerald-400 text-[8px] font-black uppercase tracking-[0.2em]">
                                        LIHAT FOTO
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
