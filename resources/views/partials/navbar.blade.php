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
                        <span class="text-[9px] font-black text-amber-500 uppercase tracking-[0.3em] mb-1">Musholla</span>
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
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('dashboard') }}"
                                class="px-5 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full transition shadow-lg shadow-emerald-950/20 text-sm font-bold border border-emerald-500/30">Dashboard Admin</a>
                        @else
                            <a href="{{ route('akun') }}"
                                class="flex items-center gap-2 px-5 py-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white rounded-full transition text-sm font-bold backdrop-blur-md">
                                <div class="w-6 h-6 rounded-full bg-amber-500 flex items-center justify-center text-emerald-950 text-[10px] font-black overflow-hidden shadow-inner">
                                    @if(Auth::user()->profile_picture)
                                        <img src="{{ Storage::url(Auth::user()->profile_picture) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    @endif
                                </div>
                                Akun Saya
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="hover:text-emerald-600 dark:hover:text-amber-400 transition text-sm">Masuk</a>
                    @endauth
                @endif
                
                <a href="{{ route('campaigns.index') }}"
                    class="ml-2 px-6 py-2 rounded-full bg-emerald-600 dark:bg-amber-500 text-white dark:text-emerald-950 font-bold shadow-lg shadow-emerald-600/20 dark:shadow-amber-500/20 hover:scale-105 hover:bg-emerald-700 dark:hover:bg-amber-400 transition-all text-sm">
                    Donasi Sekarang
                </a>

                {{-- Theme Toggle Desktop --}}
                <div class="ml-4">
                    @include('partials.theme-toggle')
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden flex flex-col gap-1.5 z-50 p-2" id="mobile-menu-btn" aria-label="Toggle Menu">
                <span class="w-6 h-0.5 bg-zinc-900 dark:bg-white transition-all duration-300 origin-center" id="line1"></span>
                <span class="w-6 h-0.5 bg-zinc-900 dark:bg-white transition-all duration-300" id="line2"></span>
                <span class="w-4 h-0.5 bg-zinc-900 dark:bg-white transition-all duration-300 self-end origin-center" id="line3"></span>
            </button>
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

    <button onclick="toggleMenu()" class="absolute top-8 right-8 p-3 bg-zinc-900/5 dark:bg-white/10 rounded-full hover:bg-zinc-900/10 dark:hover:bg-white/20 transition-all border border-zinc-900/10 dark:border-white/20" aria-label="Close Menu">
        <svg class="w-8 h-8 text-zinc-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <a href="{{ url('/#hero') }}" class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Beranda</a>
    <a href="{{ route('campaigns.index') }}" class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Program Donasi</a>
    <a href="{{ route('galleries.index') }}" class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Galeri</a>
    <a href="{{ route('articles.index') }}" class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
        onclick="toggleMenu()">Artikel</a>

    <div class="h-px w-full bg-zinc-900/5 dark:bg-white/10 my-4"></div>

    @if (Route::has('login'))
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-emerald-600 dark:text-emerald-400"
                    onclick="toggleMenu()">Dashboard Admin</a>
            @else
                <a href="{{ route('akun') }}" class="flex items-center gap-3 text-xl font-bold text-emerald-600 dark:text-amber-400"
                    onclick="toggleMenu()">
                    <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-emerald-950 text-sm font-black overflow-hidden flex-shrink-0 shadow-lg shadow-amber-500/20">
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
            <a href="{{ route('login') }}" class="text-3xl font-black hover:text-emerald-600 dark:hover:text-amber-400 transition"
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