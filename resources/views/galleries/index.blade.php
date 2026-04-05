<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Donasi Musholla</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="/js/liquid-glass-svg.js"></script>
    <style>
        .modal-scroll-area::-webkit-scrollbar {
            width: 4px;
        }
        .modal-scroll-area::-webkit-scrollbar-track {
            background: transparent;
        }
        .modal-scroll-area::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
        }
        .modal-scroll-area::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        /* Firefox */
        .modal-scroll-area {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.05) transparent;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 bg-[url('/images/pattern-light.svg')] bg-[length:20px_20px] bg-fixed">
    @include('partials.navbar', ['transparentTheme' => false])

    <main class="pt-24 sm:pt-32 pb-24 px-6 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
            <h1 class="text-3xl sm:text-5xl font-black text-emerald-950 tracking-tight mb-4 leading-tight">Galeri Dokumentasi</h1>
            <p class="text-gray-500 text-base sm:text-lg italic">Melihat lebih dekat setiap momen dan progres pembangunan yang kita capai bersama demi kenyamanan ibadah umat.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galleries as $gallery)
                <div class="group relative rounded-3xl overflow-hidden shadow-xl aspect-square md:aspect-[4/3] bg-emerald-900 gallery-card border border-emerald-900/10 cursor-pointer" 
                     data-src="{{ Storage::url($gallery->image) }}"
                     data-title="{{ $gallery->title }}"
                     data-description="{{ $gallery->description ?? '' }}"
                     data-badge="{{ strtoupper($gallery->badge ?? '') }}">
                    <!-- Base Image -->
                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <!-- Hover Overlay (Glass Effect Container) -->
                    <div class="absolute inset-x-0 bottom-0 p-6 flex flex-col justify-end transition-all duration-500 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 z-20">
                        @if($gallery->badge)
                            <div class="bg-amber-500 text-[10px] font-bold px-3 py-1 rounded-full w-fit mb-3 text-emerald-950 shadow-lg">{{ strtoupper($gallery->badge) }}</div>
                        @else
                            <div class="w-fit mb-3 h-6"></div> <!-- spacer -->
                        @endif
                        <h3 class="text-white text-2xl font-bold mb-2 drop-shadow-md">{{ $gallery->title ?? 'Tidak Ada Judul' }}</h3>
                        @if($gallery->description)
                            <p class="text-emerald-50 text-sm line-clamp-3 drop-shadow-sm">{{ $gallery->description }}</p>
                        @endif
                    </div>

                    <!-- Silky Smooth Standard Blur -->
                    <div class="absolute inset-x-0 bottom-0 h-full pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-700 ease-in-out z-10"
                         style="will-change: opacity;">
                        <div class="w-full h-full backdrop-blur-lg bg-emerald-950/60"
                             style="mask-image: linear-gradient(to top, black 20%, transparent 80%);
                                    -webkit-mask-image: linear-gradient(to top, black 20%, transparent 80%);"></div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-500">Belum ada dokumentasi foto saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Image Modal -->
    <div id="image-modal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 md:p-8 lg:p-12 opacity-0 pointer-events-none transition-all duration-500 bg-black/90">
        <div class="absolute inset-0 cursor-zoom-out" onclick="closeModal()"></div>
        
        <!-- SVG Filter Definition for Liquid Glass (Animated) -->
        <svg class="hidden">
            <defs>
                <filter id="liquid-glass-filter" x="-20%" y="-20%" width="140%" height="140%">
                    <feTurbulence type="fractalNoise" baseFrequency="0.015" numOctaves="3" result="noise" seed="5">
                        <animate attributeName="baseFrequency" dur="15s" values="0.015;0.018;0.015" repeatCount="indefinite" />
                    </feTurbulence>
                    <feDisplacementMap in="SourceGraphic" in2="noise" scale="35" xChannelSelector="R" yChannelSelector="G" />
                </filter>
            </defs>
        </svg>
        
        <!-- Premium Modal Container (Separated Cards Layout) -->
        <div id="modal-container" class="relative max-w-7xl w-full max-h-full flex flex-col lg:flex-row items-center justify-center gap-6 lg:gap-10 scale-90 transition-transform duration-500 ease-out p-4">
            
            <button onclick="closeModal()" class="fixed top-8 right-8 z-[70] text-white/30 hover:text-white transition-all text-6xl font-light hover:rotate-90">×</button>
            
            <!-- Image Card (Left/Top) -->
            <div class="relative w-full lg:max-w-[calc(100%-480px)] flex-shrink animate-fade-in-left flex items-center justify-center">
                <img id="modal-img" src="" alt="Full view" class="block w-auto h-auto max-w-full max-h-[50vh] lg:max-h-[85vh] object-contain rounded-[2.5rem] shadow-[0_20px_60px_rgba(0,0,0,0.6)]">
            </div>

            <!-- Story Description Card (Right/Bottom) -->
            <div id="modal-sidebar" class="relative z-0 w-full lg:w-[450px] flex-shrink-0 border border-white/10 p-8 md:p-12 rounded-[3rem] shadow-[0_20px_60px_rgba(0,0,0,0.6)] animate-fade-in-right overflow-hidden flex flex-col max-h-[40vh] lg:max-h-[85vh]">
                
                <!-- Dedicated Liquid Filter Element (Background ONLY) -->
                <div class="absolute inset-0 z-[-1] bg-neutral-900/40" style="backdrop-filter: blur(25px); -webkit-backdrop-filter: blur(25px); filter: url(#liquid-glass-filter);"></div>
                
                <div class="modal-scroll-area w-full h-full overflow-y-auto pr-4 md:pr-6 flex flex-col gap-6">
                    <div class="flex flex-col gap-4">
                        <h3 id="modal-caption" class="text-white text-4xl md:text-5xl font-black tracking-tight leading-tight"></h3>
                        
                        <!-- Badge (Floating glass) -->
                        <div id="modal-badge-container">
                            <div id="modal-badge" class="bg-amber-500 text-[10px] md:text-[11px] font-black tracking-[0.3em] px-5 py-2 rounded-full w-fit text-emerald-950 shadow-xl inline-block uppercase"></div>
                        </div>
                    </div>
                    
                    <div class="w-full h-px bg-white/10 my-2 flex-shrink-0"></div>
                    
                    <div id="modal-desc" class="text-gray-300 text-base md:text-lg leading-relaxed font-medium"></div>
                    
                    <div class="mt-8 flex items-center gap-4 text-white/20 font-bold uppercase tracking-widest text-[10px] mt-auto">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span>Musholla Al-Kautsar Documentation</span>
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
            const modalBadge = document.getElementById('modal-badge');
            const modalBadgeContainer = document.getElementById('modal-badge-container');
            const container = document.getElementById('modal-container');

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
                    
                    modal.classList.remove('opacity-0', 'pointer-events-none');
                    modal.classList.add('opacity-100', 'pointer-events-auto');
                    
                    setTimeout(() => {
                        container.classList.remove('scale-90');
                        container.classList.add('scale-100');
                    }, 10);
                    
                    document.body.style.overflow = 'hidden';
                });
            });

            // Global close function available to the window
            window.closeModal = function() {
                container.classList.remove('scale-100');
                container.classList.add('scale-90');
                
                setTimeout(() => {
                    modal.classList.remove('opacity-100', 'pointer-events-auto');
                    modal.classList.add('opacity-0', 'pointer-events-none');
                    document.body.style.overflow = '';
                }, 150);
            };
        });
    </script>
    @include('partials.footer')
</body>
</html>
