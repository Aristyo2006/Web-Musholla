<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Program Donasi - Musholla Al-Kautsar</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 bg-fixed selection:bg-emerald-500 selection:text-white transition-colors duration-500 overflow-x-hidden">
    {{-- Decorative Background Blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/10 blur-[150px] animate-pulse transition-opacity duration-500"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[700px] h-[700px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[200px] transition-opacity duration-500"></div>
    </div>
    
    @include('partials.navbar', ['transparentTheme' => false])

    <main class="pt-40 pb-32 px-6 lg:px-8 max-w-7xl mx-auto min-h-screen relative z-10">
        <div class="text-center mb-24 animate-fade-in">
            <div class="bg-emerald-600/10 dark:bg-amber-500/10 border border-emerald-600/20 dark:border-amber-500/20 text-emerald-700 dark:text-amber-500 text-[10px] font-black uppercase tracking-[0.3em] px-6 py-2.5 rounded-full inline-block mx-auto mb-8 shadow-2xl transition-all duration-500">Pilih Tabung Pahalamu</div>
            <h1 class="text-3xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tight mb-8 leading-tight">Program <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400 dark:from-emerald-400 dark:to-amber-300 italic px-4">Donasi Aktif</span></h1>
            <p class="text-zinc-500 dark:text-emerald-100/30 text-xl md:text-2xl max-w-3xl mx-auto font-medium leading-relaxed italic transition-colors duration-500">Mari bersama-sama membangun peradaban umat melalui setiap rupiah tabungan kebaikan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <!-- Campaign Card -->
                <div class="bg-white dark:bg-white/5 backdrop-blur-3xl rounded-[3.5rem] overflow-hidden shadow-2xl shadow-emerald-900/5 dark:shadow-none border border-emerald-100 dark:border-white/10 hover:border-emerald-500/30 dark:hover:border-emerald-500/30 hover:bg-emerald-50/50 dark:hover:bg-white/[0.08] hover:scale-[1.02] transition-all duration-500 flex flex-col group relative">
                    <!-- Image Area -->
                    <div class="relative h-72 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/50 dark:from-zinc-950/90 via-transparent to-transparent opacity-80 z-10 transition-colors duration-500"></div>
                        @if($campaign->image)
                            <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000 grayscale-[0.2] group-hover:grayscale-0">
                        @else
                            <div class="w-full h-full bg-emerald-900/40 flex items-center justify-center text-emerald-300">
                                <svg class="w-24 h-24 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        
                        <!-- Mini Badge -->
                        @if($campaign->end_date)
                            <div class="absolute top-8 right-8 z-20 bg-emerald-500/90 backdrop-blur text-white text-[10px] font-black uppercase tracking-widest px-4 py-2 rounded-full shadow-2xl">
                                {{ \Carbon\Carbon::parse($campaign->end_date)->diffForHumans() }}
                            </div>
                        @endif
                    </div>

                    <!-- Content Area -->
                    <div class="p-10 flex-grow flex flex-col relative z-20">
                        <h2 class="text-3xl font-black text-zinc-900 dark:text-white mb-4 leading-tight group-hover:text-emerald-700 dark:group-hover:text-emerald-400 transition-colors tracking-tighter">{{ $campaign->title }}</h2>
                        <p class="text-zinc-500 dark:text-emerald-100/30 text-base mb-8 line-clamp-3 leading-relaxed font-medium italic transition-colors duration-500">"{{ $campaign->description }}"</p>

                        <!-- Progress Bar Area -->
                        <div class="mt-auto">
                            @if($campaign->target_amount)
                                @php
                                    $collected = $campaign->donations_sum_amount ?? 0;
                                    $percentage = min(100, ($collected / $campaign->target_amount) * 100);
                                @endphp
                                <div class="flex justify-between items-end mb-3">
                                    <div class="text-emerald-700/60 dark:text-emerald-300/60 font-black text-[10px] uppercase tracking-widest transition-colors duration-500">Dana Terkumpul</div>
                                    <div class="text-xs font-black bg-emerald-600/10 dark:bg-amber-500/20 text-emerald-700 dark:text-amber-500 px-3 py-1 rounded-xl border border-emerald-600/20 dark:border-amber-500/20 transition-all duration-500">{{ number_format($percentage, 0) }}%</div>
                                </div>
                                <div class="h-5 bg-emerald-950/5 dark:bg-white/5 rounded-full overflow-hidden border border-emerald-900/10 dark:border-white/10 shadow-inner mb-4 p-1 transition-colors duration-500">
                                    <div class="h-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400 dark:from-amber-500 dark:via-amber-400 dark:to-amber-300 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.3)] dark:shadow-[0_0_15px_rgba(245,158,11,0.5)] transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-zinc-400 dark:text-white/40 font-black mb-8 uppercase tracking-tighter transition-colors duration-500">
                                    <span class="text-emerald-700 dark:text-white">Rp {{ number_format($collected, 0, ',', '.') }}</span>
                                    <span>Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                </div>
                            @else
                                <!-- No Target Display -->
                                @php $collected = $campaign->donations_sum_amount ?? 0; @endphp
                                <div class="p-6 bg-emerald-600/5 dark:bg-emerald-500/5 rounded-3xl border border-emerald-600/10 dark:border-emerald-500/10 mb-8 text-center backdrop-blur-xl transition-all duration-500">
                                    <span class="block text-[10px] uppercase tracking-[0.2em] text-emerald-700/60 dark:text-emerald-400/40 font-black mb-2 transition-colors duration-500">Total Terkumpul:</span>
                                    <span class="block text-3xl font-black text-emerald-700 dark:text-emerald-400 tracking-tighter transition-colors duration-500">Rp {{ number_format($collected, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <a href="{{ route('donasi.index', $campaign->slug) }}" class="group/btn relative flex items-center justify-center gap-3 w-full py-5 rounded-[2rem] bg-emerald-600 dark:bg-emerald-500 hover:bg-emerald-700 dark:hover:bg-amber-500 text-white dark:text-emerald-950 font-black shadow-[0_20px_40px_-10px_rgba(5,150,105,0.4)] dark:shadow-[0_20px_40px_-10px_rgba(16,185,129,0.3)] hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10 uppercase tracking-widest text-sm">Berdonasi Sekarang</span>
                                <svg class="w-5 h-5 relative z-10 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                {{-- Button Shine Effect --}}
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/btn:animate-[shimmer_2s_infinite]"></div>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-40 text-center bg-white dark:bg-white/5 backdrop-blur-3xl rounded-[4rem] border border-emerald-100 dark:border-white/10 shadow-2xl transition-all duration-500">
                    <div class="w-24 h-24 bg-emerald-600/10 dark:bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-8 text-emerald-600 dark:text-emerald-400 border border-emerald-600/10 transition-colors duration-500">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <p class="text-3xl font-black text-zinc-300 dark:text-white/40 uppercase tracking-tighter transition-colors duration-500">Belum ada program donasi aktif.</p>
                </div>
            @endforelse
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
