<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donasi {{ $campaign->title }} - Musholla Al-Kautsar</title>
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
        }
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 bg-fixed selection:bg-emerald-500 selection:text-white transition-colors duration-500">
    {{-- Decorative Background Blobs --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div
            class="absolute top-[5%] left-[-5%] w-[500px] h-[500px] rounded-full bg-emerald-600/5 dark:bg-emerald-600/10 blur-[120px] transition-all duration-500">
        </div>
        <div
            class="absolute bottom-[10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[150px] transition-all duration-500">
        </div>
    </div>

    <!-- Top Alert Notification / Toast -->
    <div id="toast"
        class="fixed top-24 left-1/2 -translate-x-1/2 z-50 transform transition-all duration-300 opacity-0 -translate-y-10 pointer-events-none">
        <div
            class="bg-emerald-600 text-white px-6 py-3 rounded-full shadow-2xl shadow-emerald-900/30 flex items-center gap-3 font-bold border border-emerald-500/50">
            <svg class="w-5 h-5 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span id="toast-message">Menyambungkan ke pembayaran...</span>
        </div>
    </div>

    @include('partials.navbar', ['transparentTheme' => false])

    <!-- Anonim Confirmation Modal -->
    <div id="anonim-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-6"
        style="animation: none;">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-zinc-950/60 backdrop-blur-md" onclick="closeAnonimModal()" id="anonim-backdrop"
            style="opacity:0; transition: opacity 0.3s ease;"></div>
        <!-- Modal Box -->
        <div id="anonim-box"
            class="relative bg-white dark:bg-zinc-900 rounded-[2.5rem] p-8 max-w-sm w-full shadow-2xl shadow-emerald-900/20 border border-emerald-100 dark:border-white/10 text-center"
            style="opacity:0; transform: scale(0.85) translateY(20px); transition: opacity 0.35s cubic-bezier(0.34,1.56,0.64,1), transform 0.35s cubic-bezier(0.34,1.56,0.64,1);">
            <div
                class="w-16 h-16 bg-emerald-50 dark:bg-emerald-900/30 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-black text-zinc-900 dark:text-white mb-2 tracking-tight">Kirim sebagai Anonim?</h3>
            <p class="text-zinc-500 dark:text-zinc-400 text-sm leading-relaxed mb-8">
                Anda tidak mengisi informasi donatur. Donasi akan tercatat atas nama <span
                    class="font-black text-emerald-600">"Anonim"</span>. Lanjutkan?
            </p>
            <div class="flex gap-3">
                <button onclick="closeAnonimModal()"
                    class="flex-1 py-3 rounded-2xl border border-gray-200 dark:border-white/10 text-zinc-600 dark:text-zinc-400 font-bold text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-all">
                    Batal, Isi Dulu
                </button>
                <button onclick="confirmAnonim()"
                    class="flex-1 py-3 rounded-2xl bg-emerald-600 text-white font-black text-sm hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-900/20">
                    Ya, Kirim!
                </button>
            </div>
        </div>
    </div>

    <main class="pt-32 pb-32 px-6 lg:px-8 max-w-7xl mx-auto min-h-screen relative z-10 transition-all duration-500">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-start">

            {{-- Left Column: Content & Documentation --}}
            <div class="lg:col-span-8 space-y-12">
                {{-- Hero Carousel Section --}}
                @php
                    $carouselSlides = [];
                    if ($campaign->image) {
                        $carouselSlides[] = ['url' => asset('storage/' . $campaign->image), 'title' => 'Banner Program'];
                    }
                    foreach ($campaign->galleries as $photo) {
                        if ($photo->image) {
                            $carouselSlides[] = ['url' => asset('storage/' . $photo->image), 'title' => $photo->title ?? 'Dokumentasi'];
                        }
                    }
                @endphp
                <div class="relative group" x-data="{
                    activeSlide: 0,
                    slides: {{ Js::from($carouselSlides) }},
                    next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
                    prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length }
                }" x-init="setInterval(() => { if(slides.length > 1) next() }, 5000)">

                    {{-- Carousel Container --}}
                    <div
                        class="relative aspect-[4/3] md:aspect-[21/9] lg:aspect-video rounded-[3rem] overflow-hidden border border-emerald-100 dark:border-white/10 shadow-2xl shadow-emerald-900/10">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute inset-0">
                                <img :src="slide.url" :alt="slide.title" class="w-full h-full object-cover">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-zinc-950/80 via-zinc-950/20 to-transparent">
                                </div>

                                {{-- Slide Info --}}
                                <div
                                    class="absolute bottom-6 left-6 right-6 md:bottom-10 md:left-10 md:right-10 animate-fade-in-up">
                                    <p class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.4em] mb-3"
                                        x-text="slide.title"></p>
                                    <h2
                                        class="text-xl md:text-3xl font-black text-white tracking-tighter leading-tight max-w-2xl">
                                        {{ $campaign->title }}
                                    </h2>
                                </div>
                            </div>
                        </template>

                        {{-- Navigation Arrows --}}
                        <div x-show="slides.length > 1"
                            class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                            <button @click="prev()"
                                class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-emerald-600 transition-all pointer-events-auto shadow-2xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button @click="next()"
                                class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-emerald-600 transition-all pointer-events-auto shadow-2xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi Section --}}
                <div class="animate-fade-in-up" style="animation-delay: 0.2s">
                    <div
                        class="bg-emerald-600/10 dark:bg-amber-500/10 border border-emerald-600/20 dark:border-amber-500/20 text-emerald-700 dark:text-amber-500 text-[10px] font-black uppercase tracking-[0.3em] px-5 py-2 rounded-full inline-block mb-6 transition-all duration-500">
                        Program Donasi</div>
                    <h1
                        class="text-3xl md:text-5xl font-black text-zinc-900 dark:text-white tracking-tighter mb-8 leading-tight">
                        {{ $campaign->title }}
                    </h1>
                    <div class="prose-content text-zinc-500 dark:text-emerald-100/60 text-lg md:text-xl font-medium leading-relaxed">
                        {!! $campaign->description ?? '<p class="italic">Bantu wujudkan program kebaikan ini melalui donasi terbaik Anda.</p>' !!}
                    </div>

                    <style>
                        .prose-content h2 { @apply text-2xl font-black text-emerald-950 dark:text-white mt-8 mb-4 tracking-tighter; }
                        .prose-content h3 { @apply text-xl font-bold text-emerald-900 dark:text-emerald-400 mt-6 mb-3 tracking-tight; }
                        .prose-content p { @apply mb-4; }
                        .prose-content ul { @apply list-disc ml-6 mb-6 space-y-2; }
                        .prose-content ol { @apply list-decimal ml-6 mb-6 space-y-2; }
                        .prose-content blockquote { @apply border-l-4 border-emerald-500 pl-6 py-2 italic bg-emerald-50/50 dark:bg-emerald-950/30 rounded-r-2xl mb-6; }
                    </style>

                    {{-- Progress Bar Section --}}
                    @if($campaign->target_amount)
                        @php
                            $collected = $campaign->donations_sum_amount ?? 0;
                            $percentage = min(100, ($collected / $campaign->target_amount) * 100);
                        @endphp
                        <div class="mt-12 space-y-4">
                            <div class="flex justify-between items-end">
                                <div>
                                    <p class="text-[10px] font-black text-emerald-700/40 dark:text-emerald-400/40 uppercase tracking-widest mb-1.5">Dana Terkumpul</p>
                                    <p class="text-3xl font-black text-emerald-600 dark:text-emerald-400 tracking-tighter transition-colors">Rp {{ number_format($collected, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-xl font-black text-emerald-950 dark:text-white bg-emerald-100 dark:bg-white/5 px-4 py-2 rounded-2xl border border-emerald-200 dark:border-white/10 shadow-xl">{{ number_format($percentage, 0) }}%</div>
                            </div>
                            <div class="h-6 bg-emerald-950/5 dark:bg-white/5 rounded-full overflow-hidden border border-emerald-900/10 dark:border-white/10 p-1">
                                <div class="h-full bg-gradient-to-r from-emerald-600 via-emerald-500 to-emerald-400 dark:from-amber-500 dark:via-amber-400 dark:to-amber-300 rounded-full shadow-lg transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endif

                    {{-- Target Dana Meta --}}
                    <div
                        class="pt-10 grid grid-cols-2 gap-6 border-t border-emerald-100 dark:border-white/5 mt-10 pb-10">
                        <div>
                            <p
                                class="text-[10px] font-black text-emerald-700/40 dark:text-emerald-400/40 uppercase tracking-widest mb-1.5">
                                Target Dana</p>
                            <p
                                class="text-2xl font-black text-emerald-950 dark:text-white tracking-tighter transition-colors">
                                Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p
                                class="text-[10px] font-black text-emerald-700/40 dark:text-emerald-400/40 uppercase tracking-widest mb-1.5">
                                Status</p>
                            <span
                                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500 text-emerald-950 text-[9px] font-black uppercase tracking-widest">
                                <span class="w-1 h-1 rounded-full bg-emerald-950 animate-pulse"></span>
                                AKTIF
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Donation Form (Slim & Sticky) --}}
            <div class="lg:col-span-4 lg:sticky lg:top-32 mt-12 lg:mt-0">
                <div
                    class="bg-white dark:bg-zinc-900 border border-emerald-100 dark:border-white/10 rounded-[2.5rem] p-6 md:p-8 shadow-2xl shadow-emerald-900/5 relative overflow-hidden transition-all duration-500">
                    <form id="donation-form" onsubmit="event.preventDefault(); submitDonation();" class="space-y-6">
                        @csrf

                        <div class="space-y-4">
                            <label
                                class="block text-[10px] font-black text-emerald-600 uppercase tracking-widest ml-1">Pilih
                                Nominal</label>
                            <div class="grid grid-cols-3 gap-2 px-1">
                                <button type="button" onclick="setNominal(10000, this)"
                                    class="preset-btn py-4 rounded-2xl bg-emerald-50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 text-emerald-800 dark:text-white font-black hover:bg-emerald-100 transition-all text-xs tracking-tighter">10K</button>
                                <button type="button" onclick="setNominal(50000, this)"
                                    class="preset-btn py-4 rounded-2xl bg-emerald-50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 text-emerald-800 dark:text-white font-black hover:bg-emerald-100 transition-all text-xs tracking-tighter">50K
                                    </tton>
                                    <button type="button" onclick="setNominal(100000, this)"
                                        class="preset-btn py-4 rounded-2xl bg-emerald-50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 text-emerald-800 dark:text-white font-black hover:bg-emerald-100 transition-all text-xs tracking-tighter">100K</button>
                            </div>
                            <div class="relative group">
                                <span
                                    class="absolute left-6 top-1/2 -translate-y-1/2 text-emerald-500 font-black text-lg">Rp</span>
                                <input type="number" id="amount" name="amount" required min="10000"
                                    class="w-full bg-emerald-50/50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 rounded-3xl pl-16 pr-6 py-5 text-zinc-900 dark:text-white focus:border-emerald-500 outline-none font-black text-xl tracking-tighter transition-all"
                                    placeholder="0" oninput="clearPresetActive()">
                            </div>
                        </div>

                        <div
                            class="space-y-4 p-5 bg-emerald-50/20 dark:bg-white/[0.02] rounded-3xl border border-emerald-100/50 dark:border-white/5">
                            <label
                                class="block text-center text-[9px] font-black text-emerald-400 uppercase tracking-widest mb-2">Informasi
                                Donatur</label>
                            <div class="space-y-4">
                                @if($campaign->show_name)
                                    <div class="relative group">
                                        <input type="text" id="donator_name" name="donator_name"
                                            class="w-full bg-white dark:bg-zinc-800/50 border border-emerald-100 dark:border-white/10 rounded-2xl px-5 py-4 text-xs font-bold focus:border-emerald-500 outline-none transition-all"
                                            placeholder="Nama Lengkap (kosongkan untuk Anonim)"
                                            onfocus="showInfoSuggestion('donator_name')">
                                        @auth
                                            <div id="donator_name_suggestion"
                                                class="hidden absolute left-0 -bottom-10 z-20 bg-emerald-600 text-white px-3 py-1.5 rounded-lg shadow-xl text-[9px] font-black uppercase tracking-widest cursor-pointer"
                                                onclick="useInfo('donator_name', '{{ Auth::user()->name }}')">Gunakan Nama Saya
                                            </div>
                                        @endauth
                                    </div>
                                @endif
                                @if($campaign->show_email)
                                    <input type="email" id="email" name="email"
                                        class="w-full bg-white dark:bg-zinc-800/50 border border-emerald-100 dark:border-white/10 rounded-2xl px-5 py-4 text-xs font-bold focus:border-emerald-500 outline-none transition-all"
                                        placeholder="Email (kosongkan untuk Anonim)">
                                @endif
                                @if($campaign->show_address)
                                    <input type="text" id="donator_address" name="donator_address"
                                        class="w-full bg-white dark:bg-zinc-800/50 border border-emerald-100 dark:border-white/10 rounded-2xl px-5 py-4 text-xs font-bold focus:border-emerald-500 outline-none transition-all"
                                        placeholder="Alamat (kosongkan untuk Anonim)">
                                @endif
                                @if($campaign->show_message)
                                    <textarea id="notes" name="notes" rows="2"
                                        class="w-full bg-white dark:bg-zinc-800/50 border border-emerald-100 dark:border-white/10 rounded-2xl px-6 py-4 text-xs font-medium italic focus:border-emerald-500 outline-none transition-all"
                                        placeholder="Doa & Pesan (opsional)"></textarea>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-5">
                            <p
                                class="text-[9px] font-black text-emerald-400 uppercase tracking-widest text-center border-b border-emerald-100 dark:border-white/5 pb-2">
                                Transfer Manual</p>
                            <div x-data="{ copied: false }"
                                class="bg-emerald-50/50 dark:bg-zinc-800/80 p-5 rounded-2xl border border-emerald-100 dark:border-white/10 relative group/card transition-all">
                                <div class="flex flex-col items-center gap-1">
                                    <div class="flex items-center gap-3">
                                        <p class="text-xl font-black text-emerald-900 dark:text-white tracking-widest"
                                            id="account-number">7721422813</p>
                                        <button type="button" @click="
                                                navigator.clipboard.writeText('7721422813');
                                                copied = true;
                                                setTimeout(() => copied = false, 2000);
                                            "
                                            class="p-2 bg-emerald-100 dark:bg-white/10 hover:bg-emerald-200 dark:hover:bg-white/20 text-emerald-700 dark:text-amber-500 rounded-xl transition-all active:scale-90"
                                            title="Copy No. Rekening">
                                            <svg x-show="!copied" class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3">
                                                </path>
                                            </svg>
                                            <svg x-show="copied" style="display: none;" class="w-4 h-4 text-emerald-500"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p
                                        class="text-[9px] font-bold text-emerald-700/60 dark:text-emerald-400 uppercase tracking-widest italic group-hover/card:text-emerald-500 transition-colors">
                                        BCA a.n YAYASAN AL KAUTSAR TAMAN</p>
                                </div>
                                <div x-show="copied" x-transition x-cloak
                                    class="absolute -top-10 left-1/2 -translate-x-1/2 bg-zinc-900 text-white text-[10px] font-bold px-3 py-1.5 rounded-full shadow-2xl pointer-events-none">
                                    Berhasil Disalin!
                                </div>
                            </div>
                            <div class="relative h-20 group">
                                <input type="file" id="proof" name="proof" required accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                    onchange="previewImage(event)">
                                <div class="h-full border-2 border-dashed border-emerald-200 dark:border-white/10 rounded-2xl flex items-center justify-center bg-emerald-50/30 dark:bg-white/5 group-hover:bg-emerald-100 transition-all overflow-hidden"
                                    id="upload-btn-container">
                                    <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest"
                                        id="upload-btn">Upload Bukti Transfer *</p>
                                    <div id="image-preview-container" class="hidden absolute inset-0">
                                        <img id="image-preview" src="#" class="w-full h-full object-cover">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" id="submit-btn"
                            class="w-full py-5 rounded-3xl bg-emerald-500 hover:bg-amber-500 text-emerald-950 font-black text-sm uppercase tracking-widest shadow-xl transition-all active:scale-95 duration-500">Kirim
                            Konfirmasi</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function showInfoSuggestion(id) {
            const suggestion = document.getElementById(id + '_suggestion');
            if (suggestion) {
                suggestion.classList.remove('hidden');
                // Auto hide after 5 seconds
                setTimeout(() => hideSuggestion(id), 5000);
            }
        }

        function hideSuggestion(id) {
            const suggestion = document.getElementById(id + '_suggestion');
            if (suggestion) {
                suggestion.classList.add('hidden');
            }
        }

        function useInfo(id, value) {
            document.getElementById(id).value = value;
            hideSuggestion(id);
        }

        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').innerText = message;

            if (isError) {
                toast.firstElementChild.classList.remove('bg-emerald-600', 'border-emerald-500/50');
                toast.firstElementChild.classList.add('bg-red-600', 'border-red-500/50');
            } else {
                toast.firstElementChild.classList.remove('bg-red-600', 'border-red-500/50');
                toast.firstElementChild.classList.add('bg-emerald-600', 'border-emerald-500/50');
            }

            toast.classList.remove('opacity-0', '-translate-y-10');
            toast.classList.add('opacity-100', 'translate-y-0');

            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-10');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 3500);
        }

        function clearPresetActive() {
            document.querySelectorAll('.preset-btn').forEach(btn => {
                btn.classList.remove('bg-emerald-600', 'dark:bg-emerald-500', 'text-white', 'border-emerald-600', 'dark:border-emerald-500');
                btn.classList.add('bg-emerald-50', 'dark:bg-white/5', 'text-emerald-700', 'dark:text-white', 'border-emerald-100', 'dark:border-white/10');
            });
        }

        function setNominal(amount, btn) {
            document.getElementById('amount').value = amount;
            clearPresetActive();
            btn.classList.remove('bg-emerald-50', 'dark:bg-white/5', 'text-emerald-700', 'dark:text-white', 'border-emerald-100', 'dark:border-white/10');
            btn.classList.add('bg-emerald-600', 'dark:bg-emerald-500', 'text-white', 'border-emerald-600', 'dark:border-emerald-500');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2048000) {
                    showToast('Ukuran file maksimal 2MB!', true);
                    cancelUpload();
                    return;
                }
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview-container').classList.remove('hidden');
                    document.getElementById('upload-btn').innerHTML = "Ganti Foto Bukti";
                }
                reader.readAsDataURL(file);
            }
        }

        function cancelUpload() {
            document.getElementById('proof').value = "";
            document.getElementById('image-preview-container').classList.add('hidden');
            document.getElementById('upload-btn').innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg> Upload Bukti Transfer <span class="text-red-500">*</span>`;
        }

        function isAllInfoEmpty() {
            const name = document.getElementById('donator_name');
            const email = document.getElementById('email');
            const address = document.getElementById('donator_address');
            const notes = document.getElementById('notes');
            return (
                (!name || !name.value.trim()) &&
                (!email || !email.value.trim()) &&
                (!address || !address.value.trim()) &&
                (!notes || !notes.value.trim())
            );
        }

        function showAnonimModal() {
            const modal = document.getElementById('anonim-modal');
            const backdrop = document.getElementById('anonim-backdrop');
            const box = document.getElementById('anonim-box');
            modal.classList.remove('hidden');
            requestAnimationFrame(() => {
                backdrop.style.opacity = '1';
                box.style.opacity = '1';
                box.style.transform = 'scale(1) translateY(0)';
            });
        }

        function closeAnonimModal() {
            const modal = document.getElementById('anonim-modal');
            const backdrop = document.getElementById('anonim-backdrop');
            const box = document.getElementById('anonim-box');
            backdrop.style.opacity = '0';
            box.style.opacity = '0';
            box.style.transform = 'scale(0.85) translateY(20px)';
            setTimeout(() => modal.classList.add('hidden'), 350);
        }

        function confirmAnonim() {
            const name = document.getElementById('donator_name');
            if (name) name.value = 'Anonim';
            closeAnonimModal();
            doSendDonation();
        }

        async function submitDonation() {
            const proofFile = document.getElementById('proof').files[0];
            if (!proofFile) {
                showToast('Mohon unggah bukti transfer gambar!', true);
                return;
            }

            const amount = document.getElementById('amount').value;
            if (!amount || parseInt(amount) < 10000) {
                showToast('Nominal donasi minimal Rp 10.000!', true);
                return;
            }

            if (isAllInfoEmpty()) {
                showAnonimModal();
                return;
            }

            doSendDonation();
        }

        async function doSendDonation() {
            const btn = document.getElementById('submit-btn');
            const originalText = btn.innerHTML;

            btn.disabled = true;
            btn.classList.add('opacity-50', 'scale-95');
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-emerald-950 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;

            const proofFile = document.getElementById('proof').files[0];
            const formData = new FormData();
            formData.append('amount', document.getElementById('amount').value);

            if (document.getElementById('donator_name')) {
                formData.append('donator_name', document.getElementById('donator_name').value || 'Anonim');
            }
            if (document.getElementById('email')) {
                formData.append('email', document.getElementById('email').value);
            }
            if (document.getElementById('donator_address')) {
                formData.append('donator_address', document.getElementById('donator_address').value);
            }
            if (document.getElementById('notes')) {
                formData.append('notes', document.getElementById('notes').value);
            }

            formData.append('proof', proofFile);

            try {
                const response = await fetch("{{ route('api.donasi.manual', $campaign) }}", {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showToast('Berhasil upload, admin akan memverifikasi dalam 1x24 jam!');
                    setTimeout(() => window.location.href = "{{ route('campaigns.index') }}", 4000);
                } else {
                    showToast(data.message || 'Gagal mengunggah foto.', true);
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    btn.classList.remove('opacity-50', 'scale-95');
                }
            } catch (err) {
                showToast('Gagal menghubungi server.', true);
                btn.disabled = false;
                btn.innerHTML = originalText;
                btn.classList.remove('opacity-50', 'scale-95');
            }
        }
    </script>
    <!-- Floating Donation Trigger (Mobile) -->
    @if($campaign->target_amount)
        @php
            $fabCollected = $campaign->donations_sum_amount ?? 0;
            $fabPercentage = min(100, ($fabCollected / $campaign->target_amount) * 100);
        @endphp
        <div x-data="{ atForm: false }" x-init="
                const observer = new IntersectionObserver((entries) => {
                    atForm = entries[0].isIntersecting;
                }, { threshold: 0.1 });
                observer.observe(document.getElementById('donation-form'));
             " x-show="!atForm" x-cloak
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-10 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-10 scale-95"
            class="md:hidden fixed bottom-6 right-4 left-4 z-30">

            <a href="#donation-form" id="fab-donasi"
                class="relative flex flex-row items-center gap-4 px-5 py-4 text-white active:scale-95 transition-all duration-300 rounded-[2rem] overflow-hidden"
                style="background: rgba(6, 30, 20, 0.85); border: 1px solid rgba(52, 211, 153, 0.25); box-shadow: 0 20px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.05) inset;">

                {{-- Liquid Glass Background --}}
                <div class="glass-btn-bg absolute inset-0 pointer-events-none z-0"
                    style="border-radius: 2rem; transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); will-change: backdrop-filter;">
                </div>

                {{-- Left: Progress Info --}}
                <div class="relative z-10 flex-1 min-w-0">
                    <p class="text-[8px] font-black uppercase tracking-[0.2em] text-emerald-400 mb-0.5">Dana Terkumpul</p>
                    <p class="text-sm font-black text-white tracking-tighter leading-none truncate">Rp {{ number_format($fabCollected, 0, ',', '.') }}</p>

                    {{-- Progress Bar --}}
                    <div class="mt-2 h-2 rounded-full overflow-hidden" style="background: rgba(255,255,255,0.15);">
                        <div class="h-full rounded-full" style="width: {{ $fabPercentage }}%; background: linear-gradient(to right, #10b981, #f59e0b); transition: width 1s ease; min-width: 4px;"></div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="relative z-10 w-px h-10 bg-white/10 flex-shrink-0"></div>

                {{-- Right: CTA --}}
                <div class="relative z-10 flex flex-col items-center gap-1 flex-shrink-0">
                    <div class="text-base font-black text-white leading-none">{{ number_format($fabPercentage, 0) }}<span class="text-emerald-400 text-xs">%</span></div>
                    <span class="text-[8px] font-black uppercase tracking-widest text-emerald-300">Donasi</span>
                    <svg class="w-3 h-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </a>
        </div>
    @else
        <div x-data="{ atForm: false }" x-init="
                const observer = new IntersectionObserver((entries) => {
                    atForm = entries[0].isIntersecting;
                }, { threshold: 0.1 });
                observer.observe(document.getElementById('donation-form'));
             " x-show="!atForm" x-cloak
            x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-y-10 scale-90"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-10 scale-90"
            class="md:hidden fixed bottom-10 right-6 z-30">
            <a href="#donation-form" id="fab-donasi"
                class="relative flex items-center justify-center px-8 py-5 text-white transition-all duration-500 group active:scale-95 rounded-full shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
                <div class="glass-btn-bg absolute inset-0 rounded-full pointer-events-none transition-all duration-500 z-0"
                    style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(255,255,255,0.2); transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); will-change: backdrop-filter, background-color;">
                </div>
                <span class="relative z-10 text-[11px] font-black uppercase tracking-[0.2em] text-white drop-shadow-md">Donasi Sekarang</span>
            </a>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof LiquidGlassSVG !== 'undefined') {
                const fab = document.getElementById('fab-donasi');
                if (!fab) return;
                const bg = fab.querySelector('.glass-btn-bg');
                if (!bg) return;
                let isHovered = false;

                const updateFilter = () => {
                    const rect = bg.getBoundingClientRect();
                    const filterUrl = LiquidGlassSVG.getDisplacementFilter({
                        height: Math.ceil(rect.height),
                        width: Math.ceil(rect.width),
                        radius: 32, // 2rem = 32px to match rounded-[2rem]
                        depth: 5,
                        strength: 80,
                        chromaticAberration: 15
                    });

                    bg.style.backdropFilter = `blur(2px) url("${filterUrl}")`;
                    bg.style.webkitBackdropFilter = `blur(2px) url("${filterUrl}")`;
                };

                updateFilter();
                new ResizeObserver(updateFilter).observe(bg);
                window.addEventListener('scroll', updateFilter);
                fab.addEventListener('mouseenter', () => { isHovered = true; updateFilter(); });
                fab.addEventListener('mouseleave', () => { isHovered = false; updateFilter(); });
            }
        });
    </script>
</body>

</html>