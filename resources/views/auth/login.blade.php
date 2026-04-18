<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-black text-white mb-2">Selamat Datang</h2>
        <p class="text-emerald-100/60 text-sm italic">Silakan masuk untuk mengelola kebaikan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-xs font-black text-emerald-100 uppercase tracking-widest mb-2 px-1">Alamat Email</label>
            <x-text-input id="email" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all" 
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@musholla.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-black text-emerald-100 uppercase tracking-widest mb-2 px-1">Kata Sandi</label>
            <x-text-input id="password" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between px-1">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-white/20 bg-white/5 text-amber-500 shadow-sm focus:ring-amber-500/50 transition-all cursor-pointer" name="remember">
                <span class="ms-2 text-sm text-emerald-100/80 group-hover:text-white transition-colors">{{ __('Ingat Saya') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-emerald-100/60 hover:text-amber-400 rounded-md focus:outline-none transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa Sandi?') }}
                </a>
            @endif
        </div>

        <div class="pt-4 px-1">
            <x-primary-button class="w-full justify-center py-5 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-emerald-950 font-black rounded-2xl shadow-xl shadow-amber-900/40 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest border-0">
                {{ __('Masuk Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-6 border-t border-white/10">
            <p class="text-emerald-100/40 text-xs">Belum punya akun? 
                <a href="{{ route('register') }}" class="text-amber-500 font-bold hover:text-amber-400 underline underline-offset-4 transition-colors">Daftar Akun</a>
            </p>
        </div>
    </form>
</x-guest-layout>
