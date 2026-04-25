<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Donasi Musholla</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <script src="/js/liquid-glass-svg.js"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .modal-image-frame {
            position: relative;
            isolation: isolate;
            touch-action: none;
        }
        .modal-magnifier-lens {
            position: absolute;
            top: 0;
            left: 0;
            width: clamp(124px, 14vw, 172px);
            aspect-ratio: 1;
            border-radius: 9999px;
            pointer-events: none;
            opacity: 0;
            transform: translate3d(-50%, -50%, 0) scale(0.92);
            transition:
                opacity 220ms ease,
                transform 320ms cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 320ms cubic-bezier(0.22, 1, 0.36, 1);
            overflow: hidden;
            z-index: 20;
            border: 3px solid rgba(255, 255, 255, 0.8);
            box-shadow:
                0 20px 45px rgba(15, 23, 42, 0.24),
                inset 0 0 0 2px rgba(255, 255, 255, 0.22);
            background-color: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            background-repeat: no-repeat;
            will-change: transform, opacity, left, top, background-position, background-size;
        }
        .dark .modal-magnifier-lens {
            border-color: rgba(255, 255, 255, 0.55);
            box-shadow:
                0 20px 45px rgba(0, 0, 0, 0.45),
                inset 0 0 0 2px rgba(255, 255, 255, 0.08);
            background-color: rgba(6, 78, 59, 0.08);
        }
        .modal-magnifier-lens.is-active {
            opacity: 1;
            transform: translate3d(-50%, -50%, 0) scale(1);
            box-shadow:
                0 28px 60px rgba(15, 23, 42, 0.28),
                inset 0 0 0 2px rgba(255, 255, 255, 0.26);
        }
        .modal-magnifier-lens::before {
            content: '';
            position: absolute;
            inset: 6%;
            border-radius: inherit;
            border: 1px solid rgba(255, 255, 255, 0.45);
            mix-blend-mode: screen;
        }
        .modal-magnifier-lens::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background:
                radial-gradient(circle at 34% 28%, rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0.12) 18%, rgba(255, 255, 255, 0) 38%),
                linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        }
        .modal-magnifier-liquid {
            position: absolute;
            inset: 0;
            border-radius: inherit;
            z-index: 1;
            background:
                radial-gradient(circle at 36% 30%, rgba(255, 255, 255, 0.22), rgba(255, 255, 255, 0.04) 30%, rgba(255, 255, 255, 0) 55%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.08), rgba(255, 255, 255, 0.02));
            backdrop-filter: blur(0px);
            -webkit-backdrop-filter: blur(0px);
            pointer-events: none;
            mix-blend-mode: screen;
        }
        .modal-magnifier-handle {
            position: absolute;
            right: 14%;
            bottom: -18%;
            width: 68px;
            height: 16px;
            border-radius: 9999px;
            transform: rotate(38deg);
            background: linear-gradient(90deg, rgba(245, 158, 11, 0.95), rgba(5, 150, 105, 0.95));
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.18);
        }
        .dark .modal-magnifier-handle {
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.35);
        }
        .modal-magnifier-hint {
            position: absolute;
            left: 1rem;
            bottom: 1rem;
            z-index: 15;
            pointer-events: none;
            transition: opacity 180ms ease, transform 180ms ease;
        }
        .modal-image-frame.is-magnifying .modal-magnifier-hint {
            opacity: 0;
            transform: translateY(6px);
        }
        .modal-scroll-area::-webkit-scrollbar {
            width: 4px;
        }
        .modal-scroll-area::-webkit-scrollbar-track {
            background: transparent;
        }
        .modal-scroll-area::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .dark .modal-scroll-area::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.05);
        }
        .modal-scroll-area::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.2);
        }
        .dark .modal-scroll-area::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        /* Firefox */
        .modal-scroll-area {
            scrollbar-width: thin;
            scrollbar-color: rgba(0, 0, 0, 0.1) transparent;
        }
        .dark .modal-scroll-area {
            scrollbar-color: rgba(255, 255, 255, 0.05) transparent;
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 bg-fixed selection:bg-emerald-500 selection:text-white transition-colors duration-500">
    {{-- Decorative Background Blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[-5%] left-[-5%] w-[500px] h-[500px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/10 blur-[120px] transition-all duration-500"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[150px] transition-all duration-500"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('/images/pattern-dark.svg')] opacity-[0.01] dark:opacity-[0.03] transition-opacity duration-500"></div>
    </div>
    
    @include('partials.navbar', ['transparentTheme' => false])

    <main class="pt-40 pb-32 px-6 lg:px-8 max-w-7xl mx-auto min-h-screen relative z-10">
        <div class="text-center max-w-3xl mx-auto mb-24 animate-fade-in-up">
            <div class="bg-emerald-600/10 dark:bg-emerald-500/10 border border-emerald-600/20 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] px-6 py-2.5 rounded-full inline-block mx-auto mb-8 shadow-2xl transition-all duration-500">Dokumentasi Kita</div>
            <h1 class="text-5xl md:text-8xl font-black text-zinc-900 dark:text-white tracking-tight mb-8 leading-tight">Galeri <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-emerald-400 dark:from-emerald-400 dark:to-amber-300 italic px-2">Kegiatan</span></h1>
            <p class="text-zinc-500 dark:text-emerald-100/30 text-xl md:text-2xl font-medium italic transition-colors duration-500 leading-relaxed">Melihat lebih dekat setiap momen dan progres pembangunan yang kita capai bersama.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleries as $gallery)
                <div class="group relative rounded-[3rem] overflow-hidden shadow-2xl shadow-emerald-950/5 dark:shadow-none aspect-square bg-white dark:bg-white/5 gallery-card border border-emerald-100 dark:border-white/5 cursor-pointer hover:border-emerald-500/30 transition-all duration-700 hover:scale-[1.02]" 
                     data-src="{{ Storage::url($gallery->image) }}"
                     data-title="{{ $gallery->title }}"
                     data-description="{{ $gallery->description ?? '' }}"
                     data-badge="{{ strtoupper($gallery->badge ?? '') }}"
                     data-campaign-slug="{{ $gallery->campaign->slug ?? '' }}"
                     data-campaign-title="{{ $gallery->campaign->title ?? '' }}">
                    <!-- Base Image -->
                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="absolute inset-0 w-full h-full object-cover transition-all duration-1000 group-hover:scale-110 grayscale-[0.2] group-hover:grayscale-0">
                    
                    {{-- Solid Gradient Overlay (No Blur) --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/90 via-zinc-950/20 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-700 z-10"></div>

                    <!-- Hover Overlay (Glass Effect Container) -->
                    <div class="absolute inset-x-0 bottom-0 p-10 flex flex-col justify-end transition-all duration-500 translate-y-10 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 z-20">
                        @if($gallery->badge)
                            <div class="bg-emerald-500/90 backdrop-blur text-[10px] font-black tracking-widest px-4 py-1.5 rounded-full w-fit mb-4 text-white shadow-xl uppercase">{{ strtoupper($gallery->badge) }}</div>
                        @endif
                        <h3 class="text-white text-3xl font-black mb-3 tracking-tight">{{ $gallery->title ?? 'Tidak Ada Judul' }}</h3>
                        <div class="flex items-center gap-3">
                            <span class="w-10 h-1 bg-emerald-500 rounded-full"></span>
                            <span class="text-emerald-400 font-black text-[10px] uppercase tracking-widest">Lihat Detail</span>
                        </div>
                    </div>


                </div>
            @empty
                <div class="col-span-full py-40 text-center bg-white dark:bg-white/5 backdrop-blur-3xl rounded-[4rem] border border-emerald-100 dark:border-white/10 shadow-2xl transition-all duration-500">
                    <div class="w-24 h-24 bg-emerald-600/10 dark:bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-8 text-emerald-600 dark:text-emerald-400 border border-emerald-600/10 transition-colors duration-500">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-3xl font-black text-zinc-300 dark:text-white/40 uppercase tracking-tighter transition-colors duration-500">Belum ada dokumentasi foto.</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Fullscreen Gallery Modal -->
    <div id="image-modal" class="fixed inset-0 z-[9999] opacity-0 pointer-events-none transition-all duration-700 backdrop-blur-3xl bg-white/90 dark:bg-zinc-950/90 flex items-start justify-center p-4 md:p-12 pt-28 md:pt-32 pb-20 overflow-y-auto lg:overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 bg-[url('/images/pattern-dark.svg')] opacity-[0.02] dark:opacity-[0.05] pointer-events-none transition-opacity duration-500"></div>

        <!-- Close Button (Minimalist Fixed) -->
        <button onclick="closeModal()" class="fixed top-6 right-6 md:top-10 md:right-10 z-[100] group flex items-center gap-3 text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-white transition-all bg-white/50 dark:bg-emerald-500/5 backdrop-blur-xl p-2 rounded-2xl border border-emerald-100/50 dark:border-emerald-500/20 shadow-xl">
            <div class="w-10 h-10 md:w-12 md:h-12 flex items-center justify-center bg-emerald-600 dark:bg-emerald-500 text-white dark:text-emerald-950 rounded-xl group-hover:scale-110 transition-transform duration-500">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            <span class="font-black text-[10px] uppercase tracking-widest pr-2 hidden md:block group-hover:translate-x-1 transition-transform">Tutup</span>
        </button>

        <div id="modal-container" class="relative w-full max-w-7xl mx-auto flex flex-col lg:flex-row items-center lg:items-start justify-center gap-8 lg:gap-16 scale-90 transition-all duration-700 ease-out">
            
            <!-- Image Area (Fixed/Static) -->
            <div id="modal-image-frame" class="modal-image-frame relative w-full lg:flex-1 lg:sticky lg:top-32 flex items-center justify-center rounded-[3rem] overflow-hidden bg-white/50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 group transition-all duration-500 shadow-2xl">
                <img id="modal-img" src="" alt="Full view" class="block w-full h-auto max-h-[45vh] md:max-h-[65vh] lg:max-h-[80vh] object-contain group-hover:scale-[1.02] transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950/10 dark:from-zinc-950/20 to-transparent pointer-events-none transition-colors duration-500"></div>
                <div id="modal-magnifier-hint" class="modal-magnifier-hint inline-flex items-center gap-3 px-4 py-2 rounded-full bg-white/65 dark:bg-zinc-950/45 backdrop-blur-xl border border-white/40 dark:border-white/10 text-[10px] font-black uppercase tracking-[0.24em] text-emerald-700 dark:text-emerald-300 shadow-xl">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Arahkan untuk zoom
                </div>
                <div id="modal-magnifier-lens" class="modal-magnifier-lens hidden" aria-hidden="true">
                    <div id="modal-magnifier-liquid" class="modal-magnifier-liquid"></div>
                    <div class="modal-magnifier-handle"></div>
                </div>
            </div>

            <!-- Content Area (Independent Scroll) -->
            <div class="w-full lg:w-[450px] flex flex-col lg:max-h-[80vh]">
                <div class="modal-scroll-area overflow-visible lg:overflow-y-auto space-y-10 text-left pr-6 pt-2 scrollbar-thin scrollbar-thumb-emerald-500/20 scrollbar-track-transparent">
                    <div class="space-y-6">
                        <div id="modal-badge-container" class="hidden">
                            <span id="modal-badge" class="px-5 py-2 bg-emerald-600/10 dark:bg-emerald-500/10 border border-emerald-600/20 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-[0.3em] rounded-full shadow-2xl"></span>
                        </div>
                        
                        <h2 id="modal-caption" class="text-4xl md:text-6xl font-black text-zinc-900 dark:text-white leading-[1.1] tracking-tighter transition-colors duration-500"></h2>
                        <div class="h-1.5 w-24 bg-gradient-to-r from-emerald-600 to-amber-500 rounded-full"></div>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-6 top-0 bottom-0 w-1 bg-emerald-100 dark:bg-white/5 rounded-full">
                            <div class="h-1/4 bg-emerald-600 dark:bg-emerald-500 rounded-full"></div>
                        </div>
                        <p id="modal-desc" class="text-zinc-500 dark:text-emerald-100/40 text-lg md:text-xl font-medium leading-relaxed italic"></p>
                    </div>

                    <!-- Donasi Section in Modal -->
                    <div id="modal-donation-container" class="hidden pt-6">
                        <div class="bg-emerald-600/5 dark:bg-emerald-500/5 border border-emerald-600/10 dark:border-emerald-500/10 rounded-[2.5rem] p-8 md:p-10 backdrop-blur-xl">
                            <p class="text-[10px] font-black text-emerald-700/60 dark:text-emerald-400/40 uppercase tracking-[0.3em] mb-4">Berkontribusi untuk Program Ini</p>
                            <h4 id="modal-campaign-name" class="text-2xl font-black text-zinc-900 dark:text-white mb-8 tracking-tighter leading-tight"></h4>
                            <a id="modal-donation-btn" href="#" class="group/btn relative flex items-center justify-center gap-3 w-full py-5 rounded-[2rem] bg-emerald-600 dark:bg-emerald-500 hover:bg-emerald-700 dark:hover:bg-amber-500 text-white dark:text-emerald-950 font-black shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                                <span class="relative z-10 uppercase tracking-widest text-sm">Donasi Sekarang</span>
                                <svg class="w-5 h-5 relative z-10 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover/btn:animate-[shimmer_2s_infinite]"></div>
                            </a>
                        </div>
                    </div>

                    <div class="pt-10 flex items-center gap-4 text-emerald-300/10 font-black uppercase tracking-[0.5em] text-[10px]">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span>Al-Kautsar Archive</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interaction Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('image-modal');
            const modalImg = document.getElementById('modal-img');
            const modalCaption = document.getElementById('modal-caption');
            const modalDesc = document.getElementById('modal-desc');
            const modalBadgeContainer = document.getElementById('modal-badge-container');
            const modalBadge = document.getElementById('modal-badge');
            const container = document.getElementById('modal-container');
            const modalDonationContainer = document.getElementById('modal-donation-container');
            const modalCampaignName = document.getElementById('modal-campaign-name');
            const modalDonationBtn = document.getElementById('modal-donation-btn');
            const modalImageFrame = document.getElementById('modal-image-frame');
            const modalMagnifierLens = document.getElementById('modal-magnifier-lens');
            const modalMagnifierLiquid = document.getElementById('modal-magnifier-liquid');
            const modalMagnifierHint = document.getElementById('modal-magnifier-hint');
            const lensZoom = 2.6;
            const lensPadding = 4;
            const mobileLensOffset = 84;
            const clamp = (value, min, max) => Math.min(Math.max(value, min), max);
            let hideMagnifierTimer = null;
            let touchMagnifierActive = false;

            const updateMagnifierFilter = () => {
                if (typeof LiquidGlassSVG === 'undefined') {
                    modalMagnifierLiquid.style.backdropFilter = 'blur(0px)';
                    modalMagnifierLiquid.style.webkitBackdropFilter = 'blur(0px)';
                    return;
                }

                const lensRect = modalMagnifierLens.getBoundingClientRect();
                if (!lensRect.width || !lensRect.height) {
                    return;
                }

                const rimFilterUrl = LiquidGlassSVG.getDisplacementFilter({
                    height: Math.ceil(lensRect.height),
                    width: Math.ceil(lensRect.width),
                    radius: lensRect.width / 2,
                    depth: 3,
                    strength: 95,
                    chromaticAberration: 16
                });

                modalMagnifierLiquid.style.backdropFilter = `blur(0.5px) url("${rimFilterUrl}")`;
                modalMagnifierLiquid.style.webkitBackdropFilter = `blur(0.5px) url("${rimFilterUrl}")`;
            };

            const hideMagnifier = () => {
                modalImageFrame.classList.remove('is-magnifying');
                modalMagnifierLens.classList.remove('is-active');
                touchMagnifierActive = false;
                if (hideMagnifierTimer) {
                    clearTimeout(hideMagnifierTimer);
                }
                hideMagnifierTimer = setTimeout(() => {
                    modalMagnifierLens.classList.add('hidden');
                    hideMagnifierTimer = null;
                }, 220);
            };

            const showMagnifier = () => {
                if (hideMagnifierTimer) {
                    clearTimeout(hideMagnifierTimer);
                    hideMagnifierTimer = null;
                }
                modalImageFrame.classList.add('is-magnifying');
                modalMagnifierLens.classList.remove('hidden');
                updateMagnifierFilter();
                requestAnimationFrame(() => {
                    modalMagnifierLens.classList.add('is-active');
                });
            };

            const updateMagnifier = (clientX, clientY) => {
                if (!modalImg.src) {
                    hideMagnifier();
                    return;
                }

                const imageRect = modalImg.getBoundingClientRect();
                const frameRect = modalImageFrame.getBoundingClientRect();

                if (!imageRect.width || !imageRect.height) {
                    hideMagnifier();
                    return;
                }

                const insideImage = (
                    clientX >= imageRect.left &&
                    clientX <= imageRect.right &&
                    clientY >= imageRect.top &&
                    clientY <= imageRect.bottom
                );

                if (!insideImage) {
                    hideMagnifier();
                    return;
                }

                showMagnifier();

                const lensSize = modalMagnifierLens.offsetWidth;
                const lensRadius = lensSize / 2;
                const relativeX = clientX - imageRect.left;
                const relativeY = clientY - imageRect.top;
                const minX = Math.min(lensRadius + lensPadding, imageRect.width / 2);
                const maxX = Math.max(imageRect.width - lensRadius - lensPadding, imageRect.width / 2);
                const minY = Math.min(lensRadius + lensPadding, imageRect.height / 2);
                const maxY = Math.max(imageRect.height - lensRadius - lensPadding, imageRect.height / 2);
                const clampedX = clamp(relativeX, minX, maxX);
                const clampedY = clamp(relativeY, minY, maxY);
                const shouldOffsetForTouch = window.innerWidth < 768 && ('ontouchstart' in window || navigator.maxTouchPoints > 0);
                const visualY = shouldOffsetForTouch
                    ? clamp(clampedY - mobileLensOffset, minY, maxY)
                    : clampedY;
                const lensLeft = (imageRect.left - frameRect.left) + clampedX;
                const lensTop = (imageRect.top - frameRect.top) + visualY;
                const bgX = -((clampedX * lensZoom) - lensRadius);
                const bgY = -((clampedY * lensZoom) - lensRadius);

                modalMagnifierLens.style.left = `${lensLeft}px`;
                modalMagnifierLens.style.top = `${lensTop}px`;
                modalMagnifierLens.style.backgroundImage = `url("${modalImg.currentSrc || modalImg.src}")`;
                modalMagnifierLens.style.backgroundSize = `${imageRect.width * lensZoom}px ${imageRect.height * lensZoom}px`;
                modalMagnifierLens.style.backgroundPosition = `${bgX}px ${bgY}px`;
            };

            // Find all gallery cards
            const cards = document.querySelectorAll('.gallery-card');

            cards.forEach(card => {
                card.addEventListener('click', () => {
                    const src = card.getAttribute('data-src');
                    const title = card.getAttribute('data-title');
                    const desc = card.getAttribute('data-description');
                    const badge = card.getAttribute('data-badge');

                    modalImg.src = src;
                    modalCaption.innerText = title;
                    modalDesc.innerText = desc || 'Dokumentasi detail mengenai progres pembangunan dan kegiatan di lingkungan Musholla Al-Kautsar.';
                    
                    if(badge && badge !== '') {
                        modalBadge.innerText = badge.toLowerCase();
                        modalBadgeContainer.classList.remove('hidden');
                    } else {
                        modalBadgeContainer.classList.add('hidden');
                    }

                    const campaignSlug = card.getAttribute('data-campaign-slug');
                    const campaignTitle = card.getAttribute('data-campaign-title');

                    if(campaignSlug && campaignSlug !== '') {
                        modalCampaignName.innerText = campaignTitle;
                        modalDonationBtn.href = '/donasi/' + campaignSlug;
                        modalDonationContainer.classList.remove('hidden');
                    } else {
                        modalDonationContainer.classList.add('hidden');
                    }
                    
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'pointer-events-auto');
                    hideMagnifier();
                    
                    setTimeout(() => {
                        container.classList.remove('scale-90');
                        container.classList.add('scale-100');
                    }, 10);
                    
                    document.body.style.overflow = 'hidden';
                });
            });

            // Global close function available to the window
            window.closeModal = function() {
                hideMagnifier();
                container.classList.remove('scale-100');
                container.classList.add('scale-90');
                
                setTimeout(() => {
                    modal.classList.remove('opacity-100', 'pointer-events-auto');
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    document.body.style.overflow = '';
                }, 150);
            };

            modalImageFrame.addEventListener('mousemove', (event) => {
                updateMagnifier(event.clientX, event.clientY);
            });

            modalImageFrame.addEventListener('mouseleave', () => {
                hideMagnifier();
            });

            modalImageFrame.addEventListener('touchstart', (event) => {
                const touch = event.touches[0];
                if (touch) {
                    touchMagnifierActive = true;
                    updateMagnifier(touch.clientX, touch.clientY);
                }
            }, { passive: true });

            modalImageFrame.addEventListener('touchmove', (event) => {
                const touch = event.touches[0];
                if (touch) {
                    if (touchMagnifierActive) {
                        event.preventDefault();
                    }
                    updateMagnifier(touch.clientX, touch.clientY);
                }
            }, { passive: false });

            modalImageFrame.addEventListener('touchend', hideMagnifier, { passive: true });
            modalImageFrame.addEventListener('touchcancel', hideMagnifier, { passive: true });

            modalImg.addEventListener('load', () => {
                hideMagnifier();
            });

            new ResizeObserver(() => {
                updateMagnifierFilter();
            }).observe(modalMagnifierLens);
        });
    </script>
    @include('partials.footer')
</body>
</html>
