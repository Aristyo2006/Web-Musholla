<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donasi Musholla - Mari Beramal Jariyah</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <script src="/js/liquid-glass-svg.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Outfit', sans-serif;
            scroll-behavior: smooth;
        }

        .emerald-gradient {
            background: linear-gradient(135deg, #064E3B 0%, #065F46 100%);
        }

        .gold-accent {
            color: #D97706;
        }

        .carousel-item {
            position: absolute;
            inset: 0;
            opacity: 0;
            transform: translateX(100%);
            transition: transform 0.9s ease-in-out, opacity 0.5s ease;
            pointer-events: none;
        }

        .carousel-item.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
            z-index: 10;
        }

        .carousel-item.prev-slide {
            transform: translateX(-100%);
            opacity: 0;
        }

        .glass-btn-bg {
            /* Bouncy spring-like transition */
            transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            transform-origin: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1), inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        button:hover .glass-btn-bg {
            transform: scale(1.15);
            background-color: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.2);
        }

        button:active .glass-btn-bg {
            transform: scale(0.85);
            /* Shrink on click */
            transition-duration: 0.1s;
            /* Faster response for click */
            box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.2);
        }

        .hero-title {
            line-height: 1.2;
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        /* Mouse Scroll Animation */
        .mouse-scroll {
            width: 26px;
            height: 42px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            position: relative;
        }

        .mouse-scroll .dot {
            width: 4px;
            height: 4px;
            background-color: #D97706;
            /* Gold color */
            border-radius: 50%;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            animation: scroll-dot 2s infinite;
        }

        @keyframes scroll-dot {
            0% {
                transform: translate(-50%, 0);
                opacity: 0;
            }

            30% {
                opacity: 1;
            }

            60% {
                transform: translate(-50%, 15px);
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        .scroll-text {
            letter-spacing: 0.25em;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 selection:bg-emerald-500 selection:text-white transition-colors duration-500 overflow-x-hidden">

    @include('partials.navbar', ['transparentTheme' => true])

    <!-- Hero Section -->
    <section id="hero"
        class="relative min-h-[110vh] flex items-center justify-center overflow-hidden emerald-gradient pt-32 pb-20">
        <div class="absolute inset-0 z-0">
            <img src="/images/hero.png" alt="Hero Background"
                class="w-full h-full object-cover opacity-30 dark:opacity-50 scale-105 blur-sm">
            <div class="absolute inset-0 bg-emerald-950/20 dark:bg-emerald-950/40"></div>
            <div
                class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-slate-50 dark:to-zinc-950 transition-colors duration-500">
            </div>
        </div>
        <div class="relative z-10 max-w-5xl px-6 text-center">
            <h1 class="text-4xl xs:text-5xl sm:text-7xl lg:text-8xl font-black text-white hero-title mb-6 md:mb-10 animate-fade-in-up leading-[1.1] tracking-tight"
                style="animation-delay: 0.1s">
                @php
                    $accentText = trim($settings['hero_subtitle_accent'] ?? 'Yayasan Al-Kautsar');
                    $parts = explode(' ', $accentText, 2);
                @endphp
                {!! nl2br(e($settings['hero_title'] ?? "Selamat Datang di Website\n")) !!}
                <span class="gold-accent italic">
                    {{ $parts[0] }}<br>
                    <span style="white-space:nowrap">{{ $parts[1] ?? '' }}</span>
                </span>
            </h1>
            <p class="text-lg md:text-2xl text-emerald-50/80 mb-10 md:mb-16 max-w-2xl mx-auto animate-fade-in-up leading-relaxed"
                style="animation-delay: 0.2s">
                {{ $settings['hero_subtitle'] ?? 'Mari bersama-sama membangun rumah Allah untuk bekal di akhirat kelak.' }}
            </p>

            <div class="flex flex-col items-center gap-4 mt-8 animate-fade-in-up" style="animation-delay: 0.3s">
                <a href="{{ $latestCampaign ? route('donasi.index', $latestCampaign->slug) : route('campaigns.index') }}"
                    class="px-10 py-5 bg-emerald-500 hover:bg-amber-500 text-white font-black text-xs uppercase tracking-[0.2em] rounded-2xl shadow-[0_20px_40px_-10px_rgba(16,185,129,0.3)] transition-all active:scale-95">
                    Donasi Sekarang
                </a>
                <p class="text-[10px] font-bold text-emerald-50/40 uppercase tracking-widest italic">
                    Donasi Terbaru: <span
                        class="text-amber-400/80">{{ $latestCampaign->title ?? 'Program Musholla' }}</span>
                </p>
            </div>
            <div class="mt-12 md:mt-24 flex flex-col items-center gap-6 animate-fade-in-up"
                style="animation-delay: 0.4s">
                <div class="flex flex-col items-center gap-3">
                    <span
                        class="text-emerald-50/50 text-[9px] md:text-[10px] font-black uppercase tracking-[0.4em] scroll-text">
                        <span class="hidden md:inline">Scroll untuk selengkapnya</span>
                        <span class="md:hidden">Geser kebawah selengkapnya</span>
                    </span>
                    <div class="mouse-scroll border-emerald-50/20">
                        <div class="dot bg-amber-500"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kita Section -->
    <section id="about"
        class="relative py-20 md:py-48 bg-white dark:bg-zinc-950 overflow-hidden lg:min-h-[800px] flex flex-col lg:flex-row lg:items-center transition-colors duration-500">
        <!-- Full Image Back Side (Right Side) -->
        <div class="lg:absolute lg:right-0 lg:top-0 lg:w-1/2 lg:h-full w-full h-[350px] mb-8 lg:mb-0">
            <div class="relative h-full w-full">
                @if(isset($settings['about_image']))
                    <img src="{{ Storage::url($settings['about_image']) }}" alt="Musholla"
                        class="w-full h-full object-cover">
                @else
                    <img src="/images/hero.png" alt="Musholla" class="w-full h-full object-cover">
                @endif

                <!-- Premium Soft Gradient Mask (Desktop) -->
                <div
                    class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-white dark:from-zinc-950 via-white/60 dark:via-zinc-950/60 to-transparent hidden lg:block pointer-events-none transition-colors duration-500">
                </div>
                <!-- Gradient Mask (Mobile) -->
                <div
                    class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-white dark:from-zinc-950 via-white/20 dark:via-zinc-950/20 to-transparent lg:hidden pointer-events-none transition-colors duration-500">
                </div>
            </div>
        </div>

        <!-- Content Container -->
        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="w-full lg:w-1/2 pr-0 lg:pr-16 animate-fade-in-up">
                <div
                    class="bg-emerald-600 dark:bg-amber-500 text-white dark:text-emerald-950 text-[10px] font-black uppercase tracking-widest px-6 py-2.5 rounded-full inline-block mb-10 shadow-xl">
                    Sejarah & Profil</div>
                <h2
                    class="text-4xl md:text-7xl font-black text-zinc-900 dark:text-white tracking-tighter mb-10 leading-[1.05]">
                    {{ $settings['about_title'] ?? 'Tentang Musholla Al-Kautsar' }}
                </h2>
                <div
                    class="text-zinc-600 dark:text-emerald-100/40 text-xl md:text-2xl leading-relaxed space-y-8 lg:max-w-xl font-medium italic">
                    {!! nl2br(e($settings['about_content'] ?? 'Musholla Al-Kautsar adalah pusat kegiatan ibadah dan ukhuwah islamiyah bagi masyarakat sekitar.')) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Photo Carousel Section -->
    <section id="carousel"
        class="py-24 md:py-40 bg-slate-50 dark:bg-zinc-950 overflow-hidden relative transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 md:mb-24">
                <h2
                    class="text-4xl md:text-6xl font-black text-zinc-900 dark:text-white mb-6 md:mb-8 tracking-tighter leadgin-tight">
                    Pojok <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400 dark:from-emerald-400 dark:to-amber-300">Galeri</span>
                </h2>
                <p
                    class="text-zinc-500 dark:text-emerald-100/30 max-w-2xl mx-auto text-lg md:text-xl font-medium italic">
                    "Setiap sudut pembangunan adalah saksi bisu perjuangan kita bersama untuk rumah Allah."</p>
            </div>

            <!-- Carousel Wrapper (Allows buttons to scale without clipping) -->
            <div class="relative h-[500px] md:h-[700px] group">
                <!-- Inner Clipping Container for Images -->
                <div
                    class="absolute inset-0 rounded-[3rem] md:rounded-[4rem] overflow-hidden shadow-2xl border-[8px] md:border-[20px] border-white dark:border-white/5 ring-1 ring-zinc-900/5 dark:ring-white/10 transition-all duration-500">
                    <!-- Carousel Items -->
                    @forelse($featuredGalleries as $key => $gallery)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }} absolute inset-0">
                            <img src="{{ Storage::url($gallery->image) }}"
                                alt="{{ $gallery->title ?? ($gallery->campaign->title ?? 'Dokumentasi') }}"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 inset-x-0 w-full px-6 py-10 md:p-12 bg-gradient-to-t from-emerald-950/95 via-emerald-950/40 to-transparent">

                                {{-- Width Container for Mobile Overlap Avoidance --}}
                                <div class="max-w-[70%] md:max-w-none mx-auto md:mx-0">
                                    {{-- Badges --}}
                                    <div class="flex flex-wrap items-center gap-2 mb-3 md:mb-4">
                                        @if($gallery->campaign_id)
                                            <div
                                                class="bg-emerald-500 text-white text-[8px] md:text-[10px] font-black px-3 py-1 rounded-full w-fit uppercase tracking-widest flex items-center gap-1.5 shadow-lg">
                                                <span class="w-1 h-1 bg-white rounded-full animate-pulse"></span>
                                                DONASI
                                            </div>
                                        @endif
                                        @if($gallery->badge)
                                            <div
                                                class="bg-amber-500 text-emerald-950 text-[8px] md:text-[10px] font-black px-3 py-1 rounded-full w-fit uppercase tracking-widest shadow-lg">
                                                {{ strtoupper($gallery->badge) }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 md:gap-6">
                                        <div class="max-w-3xl">
                                            <h3
                                                class="text-white text-base md:text-5xl font-black mb-1 md:mb-3 tracking-tighter leading-tight drop-shadow-2xl">
                                                {{ $gallery->title ?? ($gallery->campaign->title ?? 'Musholla Al-Kautsar') }}
                                            </h3>
                                            <p
                                                class="text-emerald-50/80 text-[10px] md:text-xl font-medium line-clamp-2 md:line-clamp-3 italic max-w-2xl">
                                                {{ $gallery->description ?? '' }}
                                            </p>
                                        </div>

                                        @if($gallery->campaign)
                                            <div class="flex-shrink-0 pt-2 md:pt-0">
                                                <a href="{{ route('donasi.index', $gallery->campaign->slug) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2.5 md:px-6 md:py-4 bg-emerald-500 hover:bg-amber-500 text-white hover:text-emerald-950 font-black text-[9px] md:text-sm uppercase tracking-widest rounded-xl md:rounded-2xl transition-all duration-500 shadow-xl group/btn">
                                                    Donasi Sekarang
                                                    <svg class="w-3 h-3 md:w-4 md:h-4 group-hover/btn:translate-x-1 transition-transform"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active absolute inset-0">
                            <img src="/images/hero.png" alt="Musholla Hero" class="w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 inset-x-0 p-6 md:p-12 bg-gradient-to-t from-emerald-950/90 via-emerald-950/40 to-transparent">
                                <div class="bg-amber-500 text-[10px] font-bold px-3 py-1 rounded-full w-fit mb-3 md:mb-4">
                                    FOTO UTAMA</div>
                                <h3 class="text-white text-2xl md:text-4xl font-bold mb-2 tracking-tight">Desain Arsitektur
                                    Modern</h3>
                                <p class="text-emerald-100/80 text-sm md:text-base line-clamp-2 md:line-clamp-none">
                                    Memadukan nilai tradisional dengan estetika modern yang minimalis.</p>
                            </div>
                        </div>
                        <div class="carousel-item absolute inset-0">
                            <img src="/images/interior.png" alt="Musholla Interior" class="w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 inset-x-0 p-6 md:p-12 bg-gradient-to-t from-emerald-950/90 via-emerald-950/40 to-transparent">
                                <div class="bg-amber-500 text-[10px] font-bold px-3 py-1 rounded-full w-fit mb-3 md:mb-4">
                                    INTERIOR</div>
                                <h3 class="text-white text-2xl md:text-4xl font-bold mb-2 tracking-tight">Interior yang
                                    Menenangkan</h3>
                                <p class="text-emerald-100/80 text-sm md:text-base line-clamp-2 md:line-clamp-none">
                                    Pencahayaan alami untuk menambah kekhusyukan dalam beribadah.</p>
                            </div>
                        </div>
                        <div class="carousel-item absolute inset-0">
                            <img src="/images/community.png" alt="Musholla Community" class="w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 inset-x-0 p-6 md:p-12 bg-gradient-to-t from-emerald-950/90 via-emerald-950/40 to-transparent">
                                <div class="bg-amber-500 text-[10px] font-bold px-3 py-1 rounded-full w-fit mb-3 md:mb-4">
                                    KOMUNITAS</div>
                                <h3 class="text-white text-2xl md:text-4xl font-bold mb-2 tracking-tight">Pusat Ukhuwah
                                    Islamiyah</h3>
                                <p class="text-emerald-100/80 text-sm md:text-base line-clamp-2 md:line-clamp-none">Menjadi
                                    tempat berkumpulnya umat untuk berkarya dan berbagi ilmu.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Navigation Controls (Outside clipping container) -->
                <button onclick="prevSlide()"
                    class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-16 md:h-16 rounded-full flex items-center justify-center text-white transition-all z-20 group"
                    id="btn-prev">
                    <div class="glass-btn-bg absolute inset-0 pointer-events-none rounded-full"
                        style="clip-path: circle(49.8%);"></div>
                    <svg class="w-5 h-5 md:w-8 md:h-8 relative z-10 group-hover:scale-110 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="nextSlide()"
                    class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 w-10 h-10 md:w-16 md:h-16 rounded-full flex items-center justify-center text-white transition-all z-20 group"
                    id="btn-next">
                    <div class="glass-btn-bg absolute inset-0 pointer-events-none rounded-full"
                        style="clip-path: circle(49.8%);"></div>
                    <svg class="w-5 h-5 md:w-8 md:h-8 relative z-10 group-hover:scale-110 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dots -->
                <div class="absolute top-10 right-10 flex gap-2 z-20">
                    @php
                        $totalSlides = $featuredGalleries->isEmpty() ? 3 : $featuredGalleries->count();
                    @endphp
                    @for($i = 0; $i < $totalSlides; $i++)
                        <div class="carousel-dot {{ $i === 0 ? 'w-16 bg-amber-500' : 'w-8 bg-white/30' }} h-1 rounded-full cursor-pointer transition-all duration-300"
                            onclick="showSlide({{ $i }})"></div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section id="articles" class="py-24 md:py-48 bg-white dark:bg-zinc-950 transition-colors duration-500 relative">
        {{-- Mesh Glows for Light Mode --}}
        <div
            class="absolute inset-0 overflow-hidden pointer-events-none opacity-50 dark:opacity-0 transition-opacity duration-500">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-100 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-amber-50 blur-[120px] rounded-full"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 relative z-10">
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-20 gap-6 md:gap-8">
                <div>
                    <h2
                        class="text-4xl md:text-7xl font-black text-zinc-900 dark:text-white mb-6 md:mb-10 leading-tight tracking-tight">
                        Artikel <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400 dark:from-emerald-400 dark:to-amber-300 italic px-2">Terbaru</span>
                    </h2>
                    <p class="text-zinc-500 dark:text-emerald-100/30 text-xl font-medium italic">Ikuti setiap jengkal
                        kemajuan dan kebahagiaan dari Musholla Al-Kautsar.
                    </p>
                </div>
                <a href="{{ route('articles.index') }}"
                    class="group flex items-center gap-4 text-emerald-700 dark:text-emerald-400 font-black text-lg md:text-xl hover:text-emerald-900 dark:hover:text-white transition-all">
                    Arsip Kabar
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-500/10 dark:bg-white/5 border border-emerald-500/20 dark:border-white/10 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-600 dark:group-hover:bg-emerald-500 group-hover:text-white dark:group-hover:text-emerald-950 transition-all duration-500 shadow-xl shadow-emerald-500/5">
                        <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="group h-full flex flex-col bg-white dark:bg-white/5 backdrop-blur-3xl rounded-[3rem] overflow-hidden border border-emerald-100 dark:border-white/10 transition-all duration-500 hover:scale-[1.02] hover:shadow-[0_50px_100px_-20px_rgba(16,185,129,0.1)] dark:hover:shadow-[0_50px_100px_-20px_rgba(16,185,129,0.2)] hover:border-emerald-500/30">
                        <div class="h-72 overflow-hidden relative">
                            <img src="{{ $article->image ? Storage::url($article->image) : '/images/hero.png' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/20 to-transparent"></div>

                            <!-- Category Badge -->
                            <div class="absolute top-6 left-6">
                                <span
                                    class="px-4 py-2 bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg">Update</span>
                            </div>
                        </div>

                        <div class="p-10 flex flex-col flex-grow">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                <span
                                    class="text-zinc-400 dark:text-emerald-100/30 text-xs font-bold tracking-wider capitalize">
                                    {{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : $article->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <h3
                                class="text-2xl font-black mb-6 line-clamp-2 leading-tight text-zinc-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300">
                                {{ $article->title }}
                            </h3>

                            <p
                                class="text-zinc-500 dark:text-emerald-100/40 text-base mb-10 line-clamp-3 leading-relaxed font-medium">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>

                            <div
                                class="mt-auto pt-8 border-t border-emerald-100/50 dark:border-white/5 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-10 h-10 rounded-2xl bg-emerald-600 dark:bg-emerald-500 flex items-center justify-center text-white text-xs font-black overflow-hidden shadow-lg transform group-hover:rotate-6 transition-transform duration-500">
                                        @if($article->user && $article->user->profile_picture)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($article->user->profile_picture) }}"
                                                alt="A" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($article->user->name ?? 'A', 0, 1) }}
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-sm text-zinc-900 dark:text-white truncate max-w-[120px]">{{ $article->user->name ?? 'Admin Musholla' }}</span>
                                        <span
                                            class="text-[10px] text-zinc-400 dark:text-emerald-100/20 font-medium uppercase tracking-tighter">Kontributor</span>
                                    </div>
                                </div>
                                <div
                                    class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-white/5 flex items-center justify-center text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-600 dark:group-hover:bg-emerald-500 group-hover:text-white dark:group-hover:text-zinc-950 transition-all duration-500">
                                    <svg class="w-5 h-5 group-hover:translate-x-0.5 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Subtle Donation CTA -->
            <div class="mt-24 md:mt-32">
                <div
                    class="bg-gradient-to-br from-emerald-700 to-emerald-900 dark:from-emerald-950 dark:to-emerald-900 rounded-[3rem] md:rounded-[4rem] p-8 md:p-24 flex flex-col md:flex-row items-center justify-between gap-12 md:gap-16 shadow-2xl shadow-emerald-900/20 relative overflow-hidden text-center md:text-left transition-all duration-700 border border-white/10">
                    <!-- Decorative element -->
                    <div
                        class="absolute top-0 right-0 w-96 h-96 bg-white/10 dark:bg-emerald-500/10 blur-[120px] rounded-full -mr-32 -mt-32">
                    </div>

                    <div class="relative z-10 max-w-2xl px-2 md:px-0">
                        <h3
                            class="text-4xl md:text-6xl font-black text-white mb-6 md:mb-8 leading-tight tracking-tighter">
                            Mari Shodaqo <span class="text-amber-400 font-bold italic">Jariah...</span>
                        </h3>
                        <p
                            class="text-emerald-50/70 dark:text-emerald-100/70 text-xl md:text-2xl font-medium italic leading-relaxed">
                            "Sedekah Anda adalah tabungan terbaik untuk masa depan dunia dan akhirat."</p>
                    </div>

                    <div class="relative z-10 flex-shrink-0 w-full md:w-auto">
                        <a href="{{ route('campaigns.index') }}"
                            class="inline-flex items-center justify-center gap-4 w-full md:w-auto px-8 md:px-12 py-6 md:py-7 bg-white dark:bg-emerald-500 text-emerald-950 dark:text-white font-black text-xl rounded-[2rem] hover:bg-emerald-50 dark:hover:bg-emerald-400 hover:scale-105 active:scale-95 transition-all shadow-2xl shadow-black/20 group">
                            Donasi Sekarang
                            <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')

    <!-- Floating Donation Button (Mobile & Desktop) -->
    <div x-data="{ show: false }" @scroll.window="show = (window.pageYOffset > 400)" x-show="show" x-cloak
        x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0 translate-y-10 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-10 scale-90" class="fixed bottom-10 right-6 z-30">

        {{-- Universal: Back to Top --}}
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" id="btn-back-to-top"
            class="relative flex items-center justify-center w-14 h-14 md:w-16 md:h-16 transition-all duration-500 group active:scale-90 rounded-full shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
            <div class="glass-btn-bg absolute inset-0 rounded-full pointer-events-none transition-all duration-500 z-0"
                style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(255,255,255,0.2); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); will-change: backdrop-filter, background-color;">
            </div>
            <svg class="w-5 h-5 md:w-6 md:h-6 text-white relative z-10 transition-transform duration-500 group-hover:-translate-y-1"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18">
                </path>
            </svg>
        </button>
    </div>

    <script>
        // Carousel Logic
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const dots = document.querySelectorAll('.carousel-dot');

        function showSlide(index) {
            const oldSlide = currentSlide;
            currentSlide = index;

            slides.forEach((slide, i) => {
                slide.classList.remove('active', 'prev-slide');
                if (i < index) {
                    slide.classList.add('prev-slide');
                }

                if (dots[i]) {
                    dots[i].classList.remove('bg-amber-500', 'w-16');
                    dots[i].classList.add('bg-white/30', 'w-8');
                }

                if (i === index) {
                    slide.classList.add('active');
                    if (dots[i]) {
                        dots[i].classList.add('bg-amber-500', 'w-16');
                        dots[i].classList.remove('bg-white/30', 'w-8');
                    }
                }
            });
        }

        function nextSlide() {
            if (slides.length === 0) return;
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            if (slides.length === 0) return;
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        // Initialize dots
        if (slides.length > 0) {
            showSlide(0);
        }

        // Auto Cycle Carousel
        setInterval(nextSlide, 6000);

        // Navbar & Carousel Effects
        document.addEventListener('DOMContentLoaded', () => {
            const navbarBlur = document.getElementById('navbar-blur-bg');
            const mainHeader = document.getElementById('main-header');

            // Standard Navbar Blur Scroll Effect
            if (navbarBlur) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        navbarBlur.classList.remove('opacity-0');
                        navbarBlur.classList.add('opacity-100');
                        mainHeader.classList.add('shadow-lg', 'border-white/10');
                        mainHeader.classList.remove('border-transparent', 'shadow-none');
                    } else {
                        navbarBlur.classList.add('opacity-0');
                        navbarBlur.classList.remove('opacity-100');
                        mainHeader.classList.remove('shadow-lg', 'border-white/10');
                        mainHeader.classList.add('border-transparent', 'shadow-none');
                    }
                });
            }

            // Liquid Glass for Buttons
            if (typeof LiquidGlassSVG !== 'undefined') {
                const glassElements = [
                    { selector: '#btn-prev, #btn-next, #btn-back-to-top', radius: 'circle' }
                ];

                glassElements.forEach(group => {
                    const elements = document.querySelectorAll(group.selector);
                    elements.forEach(el => {
                        const bg = el.querySelector('.glass-btn-bg');
                        let isHovered = false;

                        const updateBtnFilter = () => {
                            const rect = bg.getBoundingClientRect();
                            const isCircle = group.radius === 'circle';
                            const radius = isCircle ? rect.width / 2 : rect.height / 2; // capsule ends are height / 2

                            const filterUrl = LiquidGlassSVG.getDisplacementFilter({
                                height: Math.ceil(rect.height),
                                width: Math.ceil(rect.width),
                                radius: radius,
                                depth: isHovered ? 5 : 5,
                                strength: isHovered ? 120 : 120, // Stronger refraction
                                chromaticAberration: isHovered ? 30 : 30
                            });

                            // Sharper blur based on user preference
                            bg.style.backdropFilter = `blur(${isHovered ? '2px' : '2px'}) url("${filterUrl}")`;
                            bg.style.webkitBackdropFilter = `blur(${isHovered ? '2px' : '2px'}) url("${filterUrl}")`;

                            const isDark = document.documentElement.classList.contains('dark');
                            const circleLightBg = isHovered ? 'rgba(6, 78, 59, 0.95)' : 'rgba(6, 78, 59, 0.82)';
                            const circleDarkBg = isHovered ? 'rgba(255, 255, 255, 0.12)' : 'rgba(255, 255, 255, 0.08)';

                            const lightColor = isHovered ? 'rgba(4, 37, 26, 0.4)' : 'rgba(5, 70, 48, 0.42)';
                            const darkColor = isHovered ? 'rgba(16, 185, 129, 0.01)' : 'rgba(16, 185, 129, 0.1)';

                            if (isCircle) {
                                bg.style.backgroundColor = isDark ? circleDarkBg : circleLightBg;
                                bg.style.borderRadius = '9999px';
                                bg.style.clipPath = 'circle(49.8%)';
                                bg.style.border = isDark
                                    ? (isHovered ? '1px solid rgba(255, 255, 255, 0.4)' : '1px solid rgba(255, 255, 255, 0.15)')
                                    : (isHovered ? '1px solid rgba(16, 185, 129, 0.5)' : '1px solid rgba(6, 78, 59, 0.3)');
                            } else {
                                bg.style.backgroundColor = isDark ? darkColor : lightColor;
                                bg.style.border = '1px solid rgba(255,255,255,0.2)';
                                bg.style.borderRadius = '9999px';
                            }
                        };

                        updateBtnFilter();
                        new ResizeObserver(updateBtnFilter).observe(bg);
                        window.addEventListener('scroll', updateBtnFilter);
                        el.addEventListener('mouseenter', () => { isHovered = true; updateBtnFilter(); });
                        el.addEventListener('mouseleave', () => { isHovered = false; updateBtnFilter(); });
                    });
                });
            }
        });
    </script>
</body>

</html>