<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerita & Berita - {{ config('app.name', 'Donasi Musholla') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 scroll-smooth">
    @include('partials.navbar')

    <main class="pt-24 sm:pt-32 pb-24">
        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8">
            <!-- Header section -->
            <div class="mb-12 md:mb-16 text-center max-w-3xl mx-auto">
                <h1 class="text-3xl sm:text-5xl font-black text-gray-900 mb-4 md:mb-6 leading-tight tracking-tight tracking-tight">Kabar & Cerita <span class="text-emerald-600">Musholla</span></h1>
                <p class="text-base sm:text-xl text-gray-500 leading-relaxed italic">Ikuti perkembangan terbaru dan kisah-kisah inspiratif dari pembangunan serta kegiatan Musholla Al-Kautsar.</p>
            </div>

            <!-- Articles Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" 
                       class="group h-full flex flex-col bg-white rounded-[2.5rem] p-4 transition-all hover:shadow-2xl hover:shadow-emerald-900/5 border border-transparent hover:border-emerald-100/50">
                        <div class="h-64 overflow-hidden rounded-[2rem] mb-8 shadow-sm">
                            <img src="{{ $article->image ? Storage::url($article->image) : '/images/hero.png' }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="px-4 pb-4 flex flex-col flex-grow">
                            <div class="flex items-center gap-4 mb-4">
                                <span class="px-4 py-1.5 bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase rounded-lg">Kabar</span>
                                <span class="text-gray-400 text-xs font-medium">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                            </div>
                            <h3 class="text-2xl font-bold mb-4 line-clamp-2 leading-tight text-gray-800 group-hover:text-emerald-900 transition-colors">
                                {{ $article->title }}
                            </h3>
                            <p class="text-gray-500 text-base mb-8 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-emerald-700 flex items-center justify-center text-white text-[10px] font-black overflow-hidden shadow-inner">
                                        @if($article->user && $article->user->profile_picture)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($article->user->profile_picture) }}" alt="A" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($article->user->name ?? 'A', 0, 1) }}
                                        @endif
                                    </div>
                                    <span class="font-bold text-sm text-gray-600 truncate max-w-[120px]">{{ $article->user->name ?? 'Admin' }}</span>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-700 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-32 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Belum ada artikel</h3>
                        <p class="text-gray-500">Nantikan kabar terbaru dari kami segera.</p>
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
