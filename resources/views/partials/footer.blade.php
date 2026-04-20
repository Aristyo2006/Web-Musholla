<!-- Unified Footer -->
<footer
    class="bg-emerald-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 pt-24 pb-12 rounded-t-[5rem] mt-20 border-t border-emerald-100 dark:border-white/5 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-20">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-4 mb-8">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Musholla Al-Kautsar"
                        class="h-16 w-auto drop-shadow-2xl grayscale dark:grayscale-0 transition-all duration-500">
                    <div class="flex flex-col leading-none">
                        <span
                            class="text-[10px] font-black text-amber-500 uppercase tracking-[0.4em] mb-2 transition-colors">Musholla</span>
                        <span
                            class="text-3xl font-black text-emerald-900 dark:text-white tracking-tighter transition-colors duration-500">AL-KAUTSAR</span>
                    </div>
                </div>
                <p
                    class="text-zinc-500 dark:text-emerald-300/40 text-xl leading-relaxed max-w-md mb-12 font-medium italic transition-colors duration-500">
                    Wadah kebaikan untuk membangun masa depan Musholla Al-Kautsar yang lebih nyaman bagi seluruh jamaah.
                </p>
                <div class="flex gap-6">
                    <a href="https://www.instagram.com/alkautsar.tamanjimbaran/" target="_blank"
                        class="w-14 h-14 bg-white dark:bg-white/5 border border-emerald-100 dark:border-white/10 rounded-3xl flex items-center justify-center text-zinc-400 hover:text-white hover:bg-emerald-600 hover:border-emerald-500 transition-all duration-300 shadow-xl shadow-emerald-900/5 dark:shadow-none">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>
            </div>
            <div>
                <h4
                    class="text-emerald-900 dark:text-white font-black text-lg mb-8 uppercase tracking-[0.2em] decoration-emerald-500 decoration-4 underline-offset-[12px] underline transition-colors duration-500">
                    Navigasi</h4>
                <ul
                    class="space-y-6 text-zinc-500 dark:text-emerald-300/40 font-black text-sm uppercase tracking-widest transition-colors duration-500">
                    <li><a href="{{ url('/') }}"
                            class="hover:text-emerald-600 dark:hover:text-amber-400 transition-all hover:translate-x-1 inline-block">Beranda</a>
                    </li>
                    <li><a href="{{ route('campaigns.index') }}"
                            class="hover:text-emerald-600 dark:hover:text-amber-400 transition-all hover:translate-x-1 inline-block">Program
                            Donasi</a></li>
                    <li><a href="{{ route('galleries.index') }}"
                            class="hover:text-emerald-600 dark:hover:text-amber-400 transition-all hover:translate-x-1 inline-block">Galeri</a>
                    </li>
                    <li><a href="{{ url('/#articles') }}"
                            class="hover:text-emerald-600 dark:hover:text-amber-400 transition-all hover:translate-x-1 inline-block">Artikel
                            Terbaru</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4
                    class="text-emerald-900 dark:text-white font-black text-lg mb-8 uppercase tracking-[0.2em] decoration-emerald-500 decoration-4 underline-offset-[12px] underline transition-colors duration-500">
                    Lokasi</h4>
                <p
                    class="text-zinc-500 dark:text-emerald-300/40 leading-loose mb-10 font-bold italic transition-colors duration-500">
                    Musholla Al-Kautsar<br>
                    Jl. Kebaikan No. 123,<br>
                    Kota Denpasar, Bali
                </p>
            </div>
        </div>
        <div
            class="mt-24 pt-10 border-t border-emerald-100 dark:border-white/5 flex flex-col md:flex-row justify-between items-center text-zinc-400 dark:text-emerald-300/20 text-[10px] gap-6 font-black uppercase tracking-[0.3em] transition-colors duration-500">
            <p>&copy; {{ date('Y') }} Musholla Al-Kautsar. Seluruh Hak Cipta Dilindungi.</p>
            <div class="flex gap-8">
                <span
                    class="hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer transition-colors">Privacy
                    Policy</span>
                <span class="hover:text-emerald-600 dark:hover:text-emerald-400 cursor-pointer transition-colors">Terms
                    of Service</span>
            </div>
        </div>
    </div>
</footer>