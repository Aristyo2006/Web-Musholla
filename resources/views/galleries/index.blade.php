<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri - Donasi Musholla</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="/js/liquid-glass-svg.js"></script>
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
                     onclick="openModal('{{ Storage::url($gallery->image) }}', '{{ addslashes($gallery->title) }}')">
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
    <div id="image-modal" class="fixed inset-0 z-[60] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-500 bg-black/95 backdrop-blur-sm">
        <div class="absolute inset-0 cursor-zoom-out" onclick="closeModal()"></div>
        <div id="modal-container" class="relative max-w-[95vw] sm:max-w-5xl max-h-[90vh] flex flex-col items-center scale-90 transition-transform duration-500 ease-out">
            <button onclick="closeModal()" class="absolute -top-14 right-0 text-white/50 hover:text-white transition-all text-5xl font-light hover:rotate-90">×</button>
            
            <div class="relative bg-black/20 rounded-[2.5rem] overflow-hidden shadow-[0_0_80px_rgba(0,0,0,0.5)] border border-white/10 group/modal">
                <!-- img h-auto and w-auto lets it maintain natural proportions -->
                <img id="modal-img" src="" alt="Full view" class="block max-w-full max-h-[85vh] h-auto w-auto object-contain">
                
                <!-- Inner Caption Overlay -->
                <div class="absolute bottom-6 left-6 right-6">
                    <div class="bg-emerald-950/40 backdrop-blur-xl border border-white/10 px-8 py-5 rounded-3xl inline-block shadow-2xl animate-fade-in-up">
                        <span class="text-amber-500 text-[10px] uppercase font-black tracking-[0.3em] block mb-1">DOKUMENTASI</span>
                        <h3 id="modal-caption" class="text-white text-2xl font-bold tracking-tight"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interaction Script -->
    <script>
        function openModal(src, title) {
            const modal = document.getElementById('image-modal');
            const modalImg = document.getElementById('modal-img');
            const modalCaption = document.getElementById('modal-caption');
            const container = document.getElementById('modal-container');
            
            modalImg.src = src;
            modalCaption.innerText = title;
            
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            
            setTimeout(() => {
                container.classList.remove('scale-90');
                container.classList.add('scale-100');
            }, 10);
            
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('image-modal');
            const container = document.getElementById('modal-container');
            
            container.classList.remove('scale-100');
            container.classList.add('scale-90');
            
            setTimeout(() => {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
            }, 150);
            
            setTimeout(() => {
                document.body.style.overflow = 'auto';
            }, 500);
        }
    </script>
    @include('partials.footer')
</body>
</html>
