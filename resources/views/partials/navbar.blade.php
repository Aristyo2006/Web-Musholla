@props(['transparentTheme' => false])

<!-- Unified Header Navbar -->
<header class="fixed w-full z-40 transition-all duration-500 {{ !$transparentTheme ? 'bg-emerald-950/90 backdrop-blur-md shadow-lg border-b border-emerald-900/50' : 'bg-transparent border-b border-transparent shadow-none' }}" id="main-header">
    <nav class="w-full relative transition-all duration-500 {{ !$transparentTheme ? 'py-1' : '' }}" id="nav-container">
        @if($transparentTheme)
            <div id="navbar-blur-bg" class="absolute inset-0 transition-all duration-500 opacity-0 bg-emerald-950/80 backdrop-blur-md pointer-events-none"></div>
        @endif

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center relative z-10" id="nav-content">
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="flex items-center gap-3 hover:scale-105 transition-all">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Musholla Al-Kautsar" class="h-12 w-auto drop-shadow-sm">
                    <div class="flex flex-col leading-tight">
                        <span class="text-xl font-black text-white tracking-tighter">AL-KAUTSAR</span>
                        <span class="text-[10px] text-emerald-300 font-bold tracking-[0.2em] uppercase">Musholla & Community</span>
                    </div>
                </a>
            </div>
            
            <div class="hidden lg:flex items-center gap-8 text-white font-medium">
                <a href="{{ url('/#hero') }}" class="hover:text-amber-400 transition">Beranda</a>
                <a href="{{ route('campaigns.index') }}" class="hover:text-amber-400 transition">Program Donasi</a>
                <a href="{{ route('galleries.index') }}" class="hover:text-amber-400 transition">Galeri</a>
                <a href="{{ url('/#articles') }}" class="hover:text-amber-400 transition">Artikel</a>
                
                @if (Route::has('login'))
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('dashboard') }}" class="px-5 py-2 {{ $transparentTheme ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-emerald-800 hover:bg-emerald-700 border border-emerald-700' }} rounded-full transition shadow-lg shadow-emerald-900/20 text-sm">Dashboard Admin</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="hover:text-amber-400 transition text-sm">Masuk</a>
                    @endauth
                @endif
                <a href="{{ route('campaigns.index') }}" class="px-6 py-2 rounded-full bg-amber-500 text-emerald-950 font-bold shadow-lg shadow-amber-500/20 hover:scale-105 hover:bg-amber-400 transition-all text-sm">
                    Donasi Sekarang
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden flex flex-col gap-1.5 z-50 p-2" id="mobile-menu-btn" aria-label="Toggle Menu">
                <span class="w-6 h-0.5 bg-white transition-all duration-300 origin-center" id="line1"></span>
                <span class="w-6 h-0.5 bg-white transition-all duration-300" id="line2"></span>
                <span class="w-4 h-0.5 bg-white transition-all duration-300 self-end origin-center" id="line3"></span>
            </button>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="fixed inset-0 bg-emerald-950/95 backdrop-blur-xl z-[45] flex flex-col pt-32 px-8 gap-8 text-white transition-all duration-500 translate-x-full lg:hidden overflow-y-auto pb-12">
            <a href="{{ url('/#hero') }}" class="text-3xl font-black hover:text-amber-400 transition" onclick="toggleMenu()">Beranda</a>
            <a href="{{ route('campaigns.index') }}" class="text-3xl font-black hover:text-amber-400 transition" onclick="toggleMenu()">Program Donasi</a>
            <a href="{{ route('galleries.index') }}" class="text-3xl font-black hover:text-amber-400 transition" onclick="toggleMenu()">Galeri</a>
            <a href="{{ url('/#articles') }}" class="text-3xl font-black hover:text-amber-400 transition" onclick="toggleMenu()">Artikel</a>
            
            <div class="h-px w-full bg-white/10 my-4"></div>
            
            @if (Route::has('login'))
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('dashboard') }}" class="text-xl font-bold text-emerald-400" onclick="toggleMenu()">Dashboard Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xl font-bold text-red-400">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-3xl font-black hover:text-amber-400 transition" onclick="toggleMenu()">Masuk</a>
                @endauth
            @endif
            
            <a href="{{ route('campaigns.index') }}" class="mt-4 px-8 py-5 bg-amber-500 text-emerald-950 text-center font-black rounded-3xl shadow-2xl shadow-amber-500/20 active:scale-95 transition-all text-xl" onclick="toggleMenu()">
                Donasi Sekarang
            </a>
        </div>
    </nav>
</header>

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
