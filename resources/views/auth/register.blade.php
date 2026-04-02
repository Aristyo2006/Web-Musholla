<x-guest-layout>
    <div class="mb-8 text-center text-white">
        <h2 class="text-3xl font-black mb-2">Daftar Akun</h2>
        <p class="text-emerald-100/60 text-sm italic">Bergabunglah untuk menebar manfaat bersama.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em] mb-2 px-1">Nama Lengkap</label>
            <x-text-input id="name" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all" 
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Fulan bin Fulan" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em] mb-2 px-1">Alamat Email</label>
            <x-text-input id="email" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all" 
                type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@musholla.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em] mb-2 px-1">Kata Sandi</label>
            <x-text-input id="password" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Min. 8 Karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em] mb-2 px-1">Konfirmasi Sandi</label>
            <x-text-input id="password_confirmation" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi Sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-6 px-1">
            <x-primary-button class="w-full justify-center py-5 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-emerald-950 font-black rounded-2xl shadow-xl shadow-amber-900/40 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest border-0">
                {{ __('Daftar Sekarang') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-6 border-t border-white/10">
            <p class="text-emerald-100/40 text-[10px] uppercase tracking-widest">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-amber-500 font-black hover:text-amber-400 underline underline-offset-4 transition-colors">Masuk Di Sini</a>
            </p>
        </div>
    </form>
</x-guest-layout>
