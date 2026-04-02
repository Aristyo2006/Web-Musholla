<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Program Donasi - Musholla Al-Kautsar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 bg-[url('/images/pattern-light.svg')] bg-[length:20px_20px] bg-fixed">
    
    @include('partials.navbar', ['transparentTheme' => false])

    <main class="pt-32 pb-24 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">
        <div class="text-center mb-16 animate-fade-in-up">
            <div class="bg-amber-500 text-emerald-950 text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full inline-block mx-auto mb-4 shadow-lg">Pilih Tambung Pahalamu</div>
            <h1 class="text-4xl md:text-5xl font-black text-emerald-950 tracking-tight mb-4">Program Donasi Aktif</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Mari berkontribusi dalam berbagai program kebaikan yang sedang berjalan di Musholla Al-Kautsar. Setiap peran Anda sangat kami hargai.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($campaigns as $campaign)
                <!-- Campaign Card -->
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-emerald-50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col group">
                    <!-- Image Area -->
                    <div class="relative h-64 overflow-hidden">
                        <div class="absolute inset-0 bg-emerald-900/20 group-hover:bg-transparent transition-colors z-10"></div>
                        @if($campaign->image)
                            <img src="{{ Storage::url($campaign->image) }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-emerald-100 flex items-center justify-center text-emerald-300">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        @endif
                        
                        <!-- Mini Badge -->
                        @if($campaign->end_date)
                            <div class="absolute top-6 right-6 z-20 bg-white/90 backdrop-blur text-emerald-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                {{ \Carbon\Carbon::parse($campaign->end_date)->diffForHumans() }}
                            </div>
                        @endif
                    </div>

                    <!-- Content Area -->
                    <div class="p-8 flex-grow flex flex-col">
                        <h2 class="text-2xl font-black text-emerald-950 mb-3 leading-tight">{{ $campaign->title }}</h2>
                        <p class="text-gray-500 mb-6 line-clamp-3 leading-relaxed">{{ $campaign->description }}</p>

                        <!-- Progress Bar (Optional Target) -->
                        <div class="mt-auto">
                            @if($campaign->target_amount)
                                @php
                                    $collected = $campaign->donations_sum_amount ?? 0;
                                    $percentage = min(100, ($collected / $campaign->target_amount) * 100);
                                @endphp
                                <div class="flex justify-between items-end mb-2">
                                    <div class="text-emerald-700 font-bold">Terkumpul</div>
                                    <div class="text-sm font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-lg border border-emerald-200">{{ number_format($percentage, 0) }}%</div>
                                </div>
                                <div class="h-4 bg-gray-100 rounded-full overflow-hidden border border-gray-200 shadow-inner mb-3">
                                    <div class="h-full bg-gradient-to-r from-amber-400 to-amber-500 rounded-full" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-500 font-bold mb-6">
                                    <span>Rp {{ number_format($collected, 0, ',', '.') }}</span>
                                    <span>Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                                </div>
                            @else
                                <!-- No Target Display -->
                                @php $collected = $campaign->donations_sum_amount ?? 0; @endphp
                                <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100 mb-6 text-center">
                                    <span class="block text-xs uppercase tracking-wider text-emerald-600 font-bold mb-1">Total Terkumpul:</span>
                                    <span class="block text-xl font-black text-emerald-700">Rp {{ number_format($collected, 0, ',', '.') }}</span>
                                </div>
                            @endif

                            <a href="{{ route('donasi.index', $campaign->slug) }}" class="block w-full text-center py-4 rounded-2xl bg-amber-500 hover:bg-amber-400 text-emerald-950 font-black shadow-lg shadow-amber-500/20 hover:shadow-amber-500/40 hover:-translate-y-1 transition-all">
                                Berdonasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-1 md:col-span-2 lg:col-span-3 py-12 text-center bg-white rounded-3xl border border-emerald-100 shadow-sm">
                    <svg class="w-16 h-16 mx-auto mb-4 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <p class="text-xl font-bold text-gray-400">Belum ada program donasi yang aktif saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>

    @include('partials.footer')
</body>
</html>
