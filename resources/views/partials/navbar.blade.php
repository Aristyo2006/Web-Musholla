@props(['transparentTheme' => false])

<!-- Unified Header Navbar -->
<header
    class="fixed w-full z-40 transition-all duration-500 {{ !$transparentTheme ? 'bg-emerald-900/90 backdrop-blur-md shadow-lg border-b border-emerald-800' : 'bg-transparent border-b border-transparent shadow-none' }}"
    id="main-header">
    <nav class="w-full relative transition-all duration-500 {{ !$transparentTheme ? 'py-1' : '' }}" id="nav-container">
        @if($transparentTheme)
            <div id="navbar-blur-bg"
                class="absolute inset-0 transition-all duration-500 opacity-0 bg-emerald-900/90 backdrop-blur-md pointer-events-none border-b border-emerald-800">
            </div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center relative z-10"
            id="nav-content">
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-3 hover:scale-105 transition-all">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Musholla Al-Kautsar"
                        class="h-12 w-auto drop-shadow-[0_0_8px_rgba(255,255,255,0.3)] opacity-100 transition-all duration-500">
                    <div class="flex flex-col leading-none">
                        <span class="text-[9px] font-black text-amber-500 uppercase tracking-[0.3em] mb-1">Yayasan</span>
                        <span class="text-xl font-black tracking-tighter text-white">AL-KAUTSAR</span>
                    </div>
                </a>
            </div>

            <div class="hidden lg:flex items-center gap-8 text-white font-medium">
                <a href="{{ url('/#hero') }}" class="hover:text-amber-400 transition">Beranda</a>
                <a href="{{ route('campaigns.index') }}" class="hover:text-amber-400 transition">Program Donasi</a>
                <a href="{{ route('galleries.index') }}" class="hover:text-amber-400 transition">Galeri</a>
                <a href="{{ route('articles.index') }}" class="hover:text-amber-400 transition">Artikel</a>

                @if (Route::has('login'))
                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.away="open = false"
                                class="flex items-center gap-2 px-5 py-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-full transition text-sm font-bold backdrop-blur-md">
                                <div
                                    class="w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center text-emerald-950 text-[10px] font-black overflow-hidden shadow-inner">
                                    @if(Auth::user()->profile_picture)
                                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    @endif
                                </div>
                                <span class="max-w-[100px] truncate">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </button>

                            <div x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                class="absolute right-0 mt-3 w-48 bg-white dark:bg-emerald-950 rounded-2xl shadow-xl shadow-emerald-900/20 border border-zinc-100 dark:border-zinc-800 overflow-hidden z-50">

                                @if(Auth::user()->hasAdminAccess())
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/50 hover:text-emerald-600 dark:hover:text-amber-400 font-medium transition-colors">
                                        Dashboard {{ Auth::user()->role === 'admin' ? 'Admin' : 'Pengawas' }}
                                    </a>
                                @else
                                    <a href="{{ route('akun') }}"
                                        class="block px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-emerald-50 dark:hover:bg-emerald-900/50 hover:text-emerald-600 dark:hover:text-amber-400 font-medium transition-colors">
                                        Profil Saya
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 font-medium transition-colors border-t border-zinc-100 dark:border-zinc-800">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="hover:text-emerald-600 dark:hover:text-amber-400 transition text-sm">Masuk</a>
                    @endauth
                @endif

                <a href="{{ route('campaigns.index') }}"
                    class="ml-2 px-6 py-2 rounded-full bg-emerald-600 dark:bg-amber-500 text-white dark:text-emerald-950 font-bold shadow-lg shadow-emerald-600/20 dark:shadow-amber-500/20 hover:scale-105 hover:bg-emerald-700 dark:hover:bg-amber-400 transition-all text-sm">
                    Donasi Sekarang
                </a>

                {{-- Search Button --}}
                <button id="search-open-btn" aria-label="Buka Pencarian"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 border border-white/20 transition-all text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                {{-- Theme Toggle Desktop --}}
                <div class="">
                    @include('partials.theme-toggle')
                </div>
            </div>

            <!-- Mobile Actions -->
            <div class="flex lg:hidden items-center gap-2">
                {{-- Mobile Search Button --}}
                <button id="search-open-btn-mobile" aria-label="Buka Pencarian"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-zinc-900/5 dark:bg-white/10 hover:bg-zinc-900/10 dark:hover:bg-white/20 transition-all text-zinc-900 dark:text-white border border-zinc-900/10 dark:border-white/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <!-- Mobile Menu Button -->
                <button class="flex flex-col gap-1.5 z-50 p-2" id="mobile-menu-btn" aria-label="Toggle Menu">
                    <span class="w-6 h-0.5 bg-zinc-900 dark:bg-white transition-all duration-300 origin-center"
                        id="line1"></span>
                    <span class="w-6 h-0.5 bg-zinc-900 dark:bg-white transition-all duration-300" id="line2"></span>
                    <span class="w-4 h-0.5 bg-zinc-900 dark:bg-white transition-all duration-300 self-end origin-center"
                        id="line3"></span>
                </button>
            </div>
        </div>

    </nav>
</header>

<!-- Mobile Menu Drawer (Moved outside header to fix backdrop-filter containing block issue) -->
<div id="mobile-menu"
    class="fixed inset-0 bg-white/95 dark:bg-emerald-950/95 backdrop-blur-xl z-[45] flex flex-col pt-32 px-8 gap-8 text-zinc-900 dark:text-white transition-all duration-500 translate-x-full lg:hidden overflow-y-auto pb-12">

    <!-- Dedicated Close Button for Mobile -->
    <div class="absolute top-8 left-8">
        @include('partials.theme-toggle')
    </div>

    <button onclick="toggleMenu()"
        class="absolute top-8 right-8 p-3 bg-zinc-900/5 dark:bg-white/10 rounded-full hover:bg-zinc-900/10 dark:hover:bg-white/20 transition-all border border-zinc-900/10 dark:border-white/20"
        aria-label="Close Menu">
        <svg class="w-8 h-8 text-zinc-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <a href="{{ url('/#hero') }}"
        class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Beranda</a>
    <a href="{{ route('campaigns.index') }}"
        class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Program Donasi</a>
    <a href="{{ route('galleries.index') }}"
        class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Galeri</a>
    <a href="{{ route('articles.index') }}"
        class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Artikel</a>

    <div class="h-px w-full bg-zinc-900/5 dark:bg-white/10 my-4"></div>

    @if (Route::has('login'))
        @auth
            @if(Auth::user()->hasAdminAccess())
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-emerald-600 dark:text-emerald-400"
                    onclick="toggleMenu()">Dashboard {{ Auth::user()->role === 'admin' ? 'Admin' : 'Pengawas' }}</a>
            @else
                <a href="{{ route('akun') }}" class="flex items-center gap-3 text-xl font-bold text-emerald-600 dark:text-amber-400"
                    onclick="toggleMenu()">
                    <div
                        class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-emerald-950 text-sm font-black overflow-hidden flex-shrink-0 shadow-lg shadow-amber-500/20">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ Storage::url(Auth::user()->profile_picture) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                    Akun Saya
                </a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-xl font-bold text-red-500 dark:text-red-400">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
                onclick="toggleMenu()">Masuk</a>
        @endauth
    @endif

    <a href="{{ route('campaigns.index') }}"
        class="mt-4 px-8 py-5 bg-emerald-600 dark:bg-amber-500 text-white dark:text-emerald-950 text-center font-black rounded-3xl shadow-2xl shadow-emerald-600/20 dark:shadow-amber-500/20 active:scale-95 transition-all text-xl"
        onclick="toggleMenu()">
        Donasi Sekarang
    </a>
</div>

<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const line1 = document.getElementById('line1');
    const line2 = document.getElementById('line2');
    const line3 = document.getElementById('line3');
    let isMenuOpen = false;

    function toggleMenu() {
        isMenuOpen = !isMenuOpen;
        if (isMenuOpen) {
            mobileMenu.classList.remove('translate-x-full');
            line1.classList.add('rotate-45', 'translate-y-2');
            line2.classList.add('opacity-0');
            line3.classList.add('-rotate-45', '-translate-y-2', 'w-6');
            document.body.style.overflow = 'hidden';
        } else {
            mobileMenu.classList.add('translate-x-full');
            line1.classList.remove('rotate-45', 'translate-y-2');
            line2.classList.remove('opacity-0');
            line3.classList.remove('-rotate-45', '-translate-y-2', 'w-6');
            document.body.style.overflow = '';
        }
    }

    mobileMenuBtn.addEventListener('click', toggleMenu);
</script>

<style>
    /* Clean Search Overlay Animations */
    .search-content {
        transition: all 0.4s cubic-bezier(0.2, 1, 0.3, 1);
    }

    /* Force BW Backdrop */
    #search-overlay-bg {
        background-color: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(24px) grayscale(100%) !important;
        -webkit-backdrop-filter: blur(24px) grayscale(100%) !important;
    }

    .dark #search-overlay-bg {
        background-color: rgba(1, 17, 8, 0.53) !important;
    }

    /* Custom glass effect that adapts to light/dark */
    .adaptive-glass {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .dark .adaptive-glass {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .adaptive-input {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
        background: transparent !important;
    }

    .adaptive-input::placeholder {
        color: rgba(6, 78, 59, 0.3);
    }

    .dark .adaptive-input::placeholder {
        color: rgba(255, 255, 255, 0.3);
    }

    .adaptive-input:focus {
        border: none !important;
        box-shadow: none !important;
        outline: none !important;
        ring: none !important;
    }

    .adaptive-chip {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.2s;
    }

    .dark .adaptive-chip {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .adaptive-chip:hover {
        background: rgba(16, 185, 129, 0.1);
        border-color: rgba(16, 185, 129, 0.3);
        transform: translateY(-2px);
    }
</style>

<!-- ===== ADAPTIVE CLEAN SEARCH OVERLAY ===== -->
<div id="search-overlay" style="display:none;"
    class="fixed inset-0 z-[9999] flex flex-col items-center justify-start pt-40 md:pt-48 px-4 md:px-6"
    aria-hidden="true">

    <!-- Background Layer (Adaptive) -->
    <div class="absolute inset-0 transition-opacity duration-300 bg-white/80 dark:bg-black/80" id="search-overlay-bg"
        style="opacity:0;"></div>

    <!-- Close Button -->
    <button id="search-close-btn"
        class="absolute top-6 right-6 md:top-8 md:right-8 w-10 h-10 md:w-12 md:h-12 flex items-center justify-center rounded-full bg-black/5 dark:bg-white/5 border border-black/5 dark:border-white/10 text-emerald-900/50 dark:text-white/50 hover:text-emerald-600 dark:hover:text-white hover:bg-white transition-all z-20"
        aria-label="Tutup Pencarian">
        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div class="search-content w-full max-w-3xl z-10" style="opacity:0; transform:translateY(20px);">
        <!-- Hint Label -->
        <p
            class="text-center text-[10px] md:text-[11px] font-bold text-emerald-800/50 dark:text-emerald-400/60 uppercase tracking-[0.2em] md:tracking-[0.3em] mb-6 md:mb-8 select-none">
            Cari Program, Artikel, atau Galeri
        </p>

        <!-- ADAPTIVE SEARCH BAR -->
        <form action="{{ route('search') }}" method="GET" id="search-overlay-form">
            <div
                class="adaptive-glass flex items-center gap-2 md:gap-4 px-3 md:px-6 py-2.5 md:py-4 rounded-2xl md:rounded-3xl shadow-2xl shadow-emerald-900/10 dark:shadow-black/50 focus-within:border-emerald-500/50 transition-all">
                <!-- Search Icon (Hidden on very small screens to save space) -->
                <svg class="hidden xs:block w-5 h-5 md:w-6 md:h-6 text-emerald-600 dark:text-emerald-400/70 flex-shrink-0"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>

                <!-- Input -->
                <input type="text" name="q" id="search-overlay-input" placeholder="Apa yang ingin dicari?"
                    autocomplete="off" spellcheck="false"
                    class="adaptive-input flex-1 min-w-0 bg-transparent text-emerald-950 dark:text-white text-base md:text-2xl lg:text-3xl font-medium outline-none tracking-tight">

                <!-- Submit Button -->
                <button type="submit"
                    class="flex-shrink-0 px-3 md:px-6 py-1.5 md:py-2.5 bg-emerald-600 dark:bg-emerald-500 hover:bg-emerald-500 dark:hover:bg-emerald-400 text-white dark:text-emerald-950 font-bold rounded-xl md:rounded-2xl transition-all active:scale-95 text-[10px] md:text-sm uppercase tracking-wider shadow-lg shadow-emerald-600/20">
                    Cari
                </button>
            </div>
        </form>

        <!-- Quick Explore -->
        <div class="mt-10 md:mt-12 flex flex-col items-center gap-5">
            {{-- Divider with Label --}}
            <div class="flex items-center gap-4 w-full max-w-sm">
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent"></div>
                <span class="text-[9px] font-black uppercase tracking-[0.4em] text-emerald-600/40 dark:text-emerald-400/30 select-none">
                    Jelajahi
                </span>
                <div class="flex-1 h-px bg-gradient-to-r from-transparent via-emerald-500/20 to-transparent"></div>
            </div>

            {{-- Icon Chips --}}
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('campaigns.index') }}"
                    class="group flex items-center gap-2.5 px-5 py-2.5 rounded-2xl border transition-all duration-300 hover:scale-105 active:scale-95"
                    style="background: rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.2); color: rgba(16,185,129,0.8);"
                    onmouseover="this.style.background='rgba(16,185,129,0.18)'; this.style.borderColor='rgba(16,185,129,0.5)'; this.style.color='rgb(16,185,129)';"
                    onmouseout="this.style.background='rgba(16,185,129,0.08)'; this.style.borderColor='rgba(16,185,129,0.2)'; this.style.color='rgba(16,185,129,0.8)';">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    <span class="text-xs font-black uppercase tracking-wider">Program Donasi</span>
                </a>
                <a href="{{ route('articles.index') }}"
                    class="group flex items-center gap-2.5 px-5 py-2.5 rounded-2xl border transition-all duration-300 hover:scale-105 active:scale-95"
                    style="background: rgba(245,158,11,0.08); border-color: rgba(245,158,11,0.2); color: rgba(245,158,11,0.8);"
                    onmouseover="this.style.background='rgba(245,158,11,0.18)'; this.style.borderColor='rgba(245,158,11,0.5)'; this.style.color='rgb(245,158,11)';"
                    onmouseout="this.style.background='rgba(245,158,11,0.08)'; this.style.borderColor='rgba(245,158,11,0.2)'; this.style.color='rgba(245,158,11,0.8)';">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <span class="text-xs font-black uppercase tracking-wider">Artikel</span>
                </a>
                <a href="{{ route('galleries.index') }}"
                    class="group flex items-center gap-2.5 px-5 py-2.5 rounded-2xl border transition-all duration-300 hover:scale-105 active:scale-95"
                    style="background: rgba(139,92,246,0.08); border-color: rgba(139,92,246,0.2); color: rgba(139,92,246,0.8);"
                    onmouseover="this.style.background='rgba(139,92,246,0.18)'; this.style.borderColor='rgba(139,92,246,0.5)'; this.style.color='rgb(139,92,246)';"
                    onmouseout="this.style.background='rgba(139,92,246,0.08)'; this.style.borderColor='rgba(139,92,246,0.2)'; this.style.color='rgba(139,92,246,0.8)';">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="text-xs font-black uppercase tracking-wider">Galeri Foto</span>
                </a>
            </div>
        </div>

        <!-- Keyboard hint -->
        <p class="text-center mt-10 text-[9px] text-emerald-900/15 dark:text-white/15 font-bold tracking-[0.4em] uppercase select-none">
            ESC tutup &nbsp;·&nbsp; Ctrl+K buka
        </p>
    </div>
</div>

<script>
    const searchOverlay = document.getElementById('search-overlay');
    const searchOverlayBg = document.getElementById('search-overlay-bg');
    const searchOpenBtn = document.getElementById('search-open-btn');
    const searchOpenBtnMobile = document.getElementById('search-open-btn-mobile');
    const searchCloseBtn = document.getElementById('search-close-btn');
    const searchInput = document.getElementById('search-overlay-input');
    const searchContent = searchOverlay ? searchOverlay.querySelector('.search-content') : null;

    function openSearch() {
        // Show the overlay immediately via display
        searchOverlay.style.display = 'flex';
        searchOverlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Animate in with requestAnimationFrame for clean transition
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                if (searchOverlayBg) searchOverlayBg.style.opacity = '1';
                if (searchContent) {
                    searchContent.style.opacity = '1';
                    searchContent.style.transform = 'translateY(0)';
                }
            });
        });

        setTimeout(() => searchInput && searchInput.focus(), 200);
    }

    function closeSearch() {
        // Fade out
        if (searchOverlayBg) searchOverlayBg.style.opacity = '0';
        if (searchContent) {
            searchContent.style.opacity = '0';
            searchContent.style.transform = 'translateY(16px)';
        }
        searchOverlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';

        // Remove from DOM flow after transition
        setTimeout(() => {
            searchOverlay.style.display = 'none';
        }, 320);
    }

    if (searchOpenBtn) searchOpenBtn.addEventListener('click', openSearch);
    if (searchOpenBtnMobile) searchOpenBtnMobile.addEventListener('click', openSearch);
    if (searchCloseBtn) searchCloseBtn.addEventListener('click', closeSearch);

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeSearch();
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            openSearch();
        }
    });

    searchOverlay.addEventListener('click', function (e) {
        if (e.target === searchOverlay || e.target === searchOverlayBg) closeSearch();
    });
</script>