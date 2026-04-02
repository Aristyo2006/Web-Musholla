<x-guest-layout>
    <div class="mb-8 text-center text-white">
        <h2 class="text-3xl font-black mb-2">Lupa Sandi?</h2>
        <p class="text-emerald-100/60 text-sm">Jangan khawatir, kami akan membantu memulihkan akses Anda.</p>
    </div>

    <div class="mb-6 text-sm text-emerald-100/80 bg-white/5 p-4 rounded-2xl border border-white/10 italic">
        {{ __('Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan penghalusan sandi yang baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-emerald-100 uppercase tracking-[0.2em] mb-2 px-1">Alamat Email Terdaftar</label>
            <x-text-input id="email" class="block w-full bg-white/5 border-white/10 text-white placeholder-emerald-100/30 focus:ring-amber-500/50 focus:border-amber-500 rounded-2xl py-4 transition-all" 
                type="email" name="email" :value="old('email')" required autofocus placeholder="admin@musholla.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-4 px-1">
            <x-primary-button class="w-full justify-center py-5 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-emerald-950 font-black rounded-2xl shadow-xl shadow-amber-900/40 hover:scale-[1.02] active:scale-95 transition-all text-sm uppercase tracking-widest border-0">
                {{ __('Kirim Tautan Atur Ulang') }}
            </x-primary-button>
        </div>

        <div class="text-center pt-6 border-t border-white/10">
            <a href="{{ route('login') }}" class="text-emerald-100/40 text-[10px] uppercase tracking-widest hover:text-amber-500 transition-colors">
                ← Kembali ke Login
            </a>
        </div>
    </form>
</x-guest-layout>
