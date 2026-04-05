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
    <script src="/js/liquid-glass-svg.js"></script>
    <style>
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

<body class="bg-gray-50 text-gray-900">

    @include('partials.navbar', ['transparentTheme' => true])

    <!-- Hero Section -->
    <section id="hero" class="relative h-screen flex items-center justify-center overflow-hidden emerald-gradient">
        <div class="absolute inset-0 z-0">
            <img src="/images/hero.png" alt="Hero Background"
                class="w-full h-full object-cover opacity-50 scale-105 blur-sm">
            <div class="absolute inset-0 bg-emerald-950/40"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-gray-50"></div>
        </div>
        <div class="relative z-10 max-w-5xl px-6 text-center">
            <h1 class="text-4xl xs:text-5xl sm:text-7xl lg:text-8xl font-black text-white hero-title mb-6 md:mb-10 animate-fade-in-up leading-[1.1] tracking-tight"
                style="animation-delay: 0.1s">
                {!! nl2br(e($settings['hero_title'] ?? "Selamat Datang di Website\n")) !!}<span
                    class="gold-accent italic">{{ $settings['hero_subtitle_accent'] ?? 'Musholla Al-Kautsar' }}</span>
            </h1>
            <p class="text-lg md:text-2xl text-emerald-50/80 mb-10 md:mb-16 max-w-2xl mx-auto animate-fade-in-up leading-relaxed"
                style="animation-delay: 0.2s">
                {{ $settings['hero_subtitle'] ?? 'Mari bersama-sama membangun rumah Allah untuk bekal di akhirat kelak.' }}
            </p>
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
        class="relative py-20 md:py-48 bg-white overflow-hidden lg:min-h-[700px] flex flex-col lg:flex-row lg:items-center">
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
                    class="absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-white via-white/60 to-transparent hidden lg:block pointer-events-none">
                </div>
                <!-- Gradient Mask (Mobile) -->
                <div
                    class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-white via-white/20 to-transparent lg:hidden pointer-events-none">
                </div>
            </div>
        </div>

        <!-- Content Container -->
        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="w-full lg:w-1/2 pr-0 lg:pr-16 animate-fade-in-up">
                <div
                    class="bg-amber-500 text-emerald-950 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full inline-block mb-6 md:mb-8 shadow-sm">
                    Sejarah & Profil</div>
                <h2 class="text-3xl md:text-6xl font-black text-emerald-950 tracking-tight mb-6 md:mb-8 leading-[1.1]">
                    {{ $settings['about_title'] ?? 'Tentang Musholla Al-Kautsar' }}
                </h2>
                <div class="text-gray-600 text-base md:text-xl leading-relaxed space-y-6 lg:max-w-lg">
                    {!! nl2br(e($settings['about_content'] ?? 'Musholla Al-Kautsar adalah pusat kegiatan ibadah dan ukhuwah islamiyah bagi masyarakat sekitar.')) !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Photo Carousel Section -->
    <section id="carousel" class="py-20 md:py-32 bg-gray-50 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 md:mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-gray-900 mb-4 md:mb-6 leading-tight">Galeri</h2>
                <p class="text-gray-500 max-w-xl mx-auto text-base md:text-lg italic">Footer Text 2.</p>
            </div>

            <!-- Carousel Wrapper (Allows buttons to scale without clipping) -->
            <div class="relative h-[400px] md:h-[700px] group">
                <!-- Inner Clipping Container for Images -->
                <div
                    class="absolute inset-0 rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-2xl border-[6px] md:border-[12px] border-white ring-1 ring-black/5">
                    <!-- Carousel Items -->
                    @forelse($featuredGalleries as $key => $gallery)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }} absolute inset-0">
                            <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 inset-x-0 p-6 md:p-12 bg-gradient-to-t from-emerald-950/90 via-emerald-950/40 to-transparent">
                                @if($gallery->badge)
                                    <div class="bg-amber-500 text-[10px] font-bold px-3 py-1 rounded-full w-fit mb-3 md:mb-4">
                                        {{ strtoupper($gallery->badge) }}
                                    </div>
                                @endif
                                <h3 class="text-white text-2xl md:text-4xl font-bold mb-2 tracking-tight">
                                    {{ $gallery->title }}
                                </h3>
                                <p class="text-emerald-100/80 text-sm md:text-base line-clamp-2 md:line-clamp-none">
                                    {{ $gallery->description }}
                                </p>
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
                    class="absolute left-6 top-1/2 -translate-y-1/2 w-16 h-16 rounded-full flex items-center justify-center text-white transition-all z-20 group"
                    id="btn-prev">
                    <div class="glass-btn-bg absolute inset-0 pointer-events-none rounded-full"
                        style="clip-path: circle(49.8%);"></div>
                    <svg class="w-8 h-8 relative z-10 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="nextSlide()"
                    class="absolute right-6 top-1/2 -translate-y-1/2 w-16 h-16 rounded-full flex items-center justify-center text-white transition-all z-20 group"
                    id="btn-next">
                    <div class="glass-btn-bg absolute inset-0 pointer-events-none rounded-full"
                        style="clip-path: circle(49.8%);"></div>
                    <svg class="w-8 h-8 relative z-10 group-hover:scale-110 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
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
    <section id="articles" class="py-24 md:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8">
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-20 gap-6 md:gap-8">
                <div>
                    <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4 md:mb-6 leading-tight tracking-tight">
                        Artikel Terbaru</h2>
                    <p class="text-gray-500 text-lg md:text-xl italic">Lorem Ipsum Dolor Sit Amet.
                    </p>
                </div>
                <a href="{{ route('articles.index') }}"
                    class="group flex items-center gap-2 text-emerald-800 font-bold text-base md:text-lg hover:text-emerald-600 transition-all">
                    Lihat Selengkapnya
                    <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                        class="group h-full flex flex-col bg-gray-50 rounded-[2.5rem] p-4 transition-all hover:bg-emerald-50 border border-transparent hover:border-emerald-100 hover:shadow-2xl hover:shadow-emerald-950/5">
                        <div class="h-72 overflow-hidden rounded-[2rem] mb-8 shadow-xl">
                            <img src="{{ $article->image ? Storage::url($article->image) : '/images/hero.png' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                        <div class="px-4 pb-4 flex flex-col flex-grow">
                            <div class="flex items-center gap-4 mb-4">
                                <span
                                    class="px-4 py-1.5 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-lg">Update</span>
                                <span
                                    class="text-gray-400 text-xs font-bold">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                            </div>
                            <h3
                                class="text-2xl font-bold mb-4 line-clamp-2 leading-tight group-hover:text-emerald-900 transition-colors text-gray-800">
                                {{ $article->title }}
                            </h3>
                            <p class="text-gray-600 text-base mb-8 line-clamp-3 leading-relaxed">
                                {{ Str::limit(strip_tags($article->content), 120) }}
                            </p>
                            <div class="mt-auto pt-4 border-t border-gray-200/60 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-emerald-700 flex items-center justify-center text-white text-[10px] font-black overflow-hidden shadow-inner">
                                        @if($article->user && $article->user->profile_picture)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($article->user->profile_picture) }}"
                                                alt="A" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($article->user->name ?? 'A', 0, 1) }}
                                        @endif
                                    </div>
                                    <span
                                        class="font-bold text-sm text-gray-700 truncate max-w-[120px]">{{ $article->user->name ?? 'Admin' }}</span>
                                </div>
                                <div
                                    class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            <div class="mt-12 md:mt-20">
                <div
                    class="bg-gradient-to-br from-emerald-950 to-emerald-900 rounded-[2.5rem] md:rounded-[3rem] p-8 md:p-16 flex flex-col md:flex-row items-center justify-between gap-8 md:gap-10 shadow-2xl shadow-emerald-950/20 relative overflow-hidden text-center md:text-left">
                    <!-- Decorative element -->
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 blur-[100px] rounded-full -mr-32 -mt-32">
                    </div>

                    <div class="relative z-10 max-w-2xl px-2 md:px-0">
                        <h3
                            class="text-2xl md:text-4xl font-black text-white mb-3 md:mb-4 leading-tight tracking-tight">
                            Mari Selesaikan <span class="text-emerald-400 font-bold italic">Pembangunan Musholla (Nanti
                                bisa diganti)</span>
                        </h3>
                        <p class="text-emerald-100/70 text-base md:text-xl font-medium italic leading-relaxed">"Footer
                            Text"</p>
                    </div>

                    <div class="relative z-10 flex-shrink-0 w-full md:w-auto">
                        <a href="{{ route('campaigns.index') }}"
                            class="inline-flex items-center justify-center gap-3 w-full md:w-auto px-10 py-5 bg-emerald-500 text-white font-black text-lg rounded-3xl hover:bg-emerald-400 hover:scale-105 active:scale-95 transition-all shadow-xl shadow-emerald-950/40 group">
                            Donasi Sekarang
                            <svg class="w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none"
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

            // Liquid Glass for Carousel Buttons (Keep it for buttons only)
            if (typeof LiquidGlassSVG !== 'undefined') {
                const btns = document.querySelectorAll('#btn-prev, #btn-next');
                btns.forEach(btn => {
                    const bg = btn.querySelector('.glass-btn-bg');
                    let isHovered = false;

                    const updateBtnFilter = () => {
                        const rect = bg.getBoundingClientRect();
                        const filterUrl = LiquidGlassSVG.getDisplacementFilter({
                            height: Math.ceil(rect.height),
                            width: Math.ceil(rect.width),
                            radius: rect.width / 2,
                            depth: isHovered ? 3 : 4,
                            strength: isHovered ? 50 : 80,
                            chromaticAberration: isHovered ? 60 : 30
                        });

                        bg.style.backdropFilter = `blur(${isHovered ? '6px' : '4px'}) url("${filterUrl}")`;
                        bg.style.webkitBackdropFilter = `blur(${isHovered ? '6px' : '4px'}) url("${filterUrl}")`;
                        bg.style.backgroundColor = isHovered ? 'rgba(255, 255, 255, 0.05)' : 'rgba(255, 255, 255, 0.08)';
                        bg.style.borderRadius = '9999px';
                        bg.style.clipPath = 'circle(49.8%)';
                        bg.style.border = isHovered ? '1px solid rgba(255, 255, 255, 0.4)' : '1px solid rgba(255, 255, 255, 0.15)';
                    };

                    updateBtnFilter();
                    new ResizeObserver(updateBtnFilter).observe(bg);

                    btn.addEventListener('mouseenter', () => { isHovered = true; updateBtnFilter(); });
                    btn.addEventListener('mouseleave', () => { isHovered = false; updateBtnFilter(); });
                });
            }
        });
    </script>
</body>

</html>