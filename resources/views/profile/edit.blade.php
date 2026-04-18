@if(Auth::user()->isAdmin())
{{-- Admin: pakai layout admin biasa --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@else
{{-- Donor: pakai layout publik --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profil - Donasi Musholla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
        }

        /* Override Breeze Styles for Dark Theme */
        .profile-card label { color: #52525b !important; font-weight: 800 !important; font-size: 0.75rem !important; text-transform: uppercase !important; letter-spacing: 0.05em !important; margin-bottom: 0.5rem !important; display: block !important; }
        .dark .profile-card label { color: #f8fafc !important; }
        .profile-card p { color: #71717a !important; font-size: 0.875rem !important; font-weight: 500 !important; margin-top: 0.25rem !important; }
        .dark .profile-card p { color: rgba(110, 231, 183, 0.4) !important; }
        .profile-card h2 { color: #18181b !important; }
        .dark .profile-card h2 { color: #ffffff !important; }
        .profile-card header h2 { display: none; } /* Hide duplicate title from partial */
        .profile-card header p { display: none; } /* Hide duplicate desc from partial */
        
        .profile-card input[type="text"], 
        .profile-card input[type="email"], 
        .profile-card input[type="password"] {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 1rem !important;
            color: #18181b !important;
            padding: 0.875rem 1.25rem !important;
            transition: all 0.3s ease !important;
            width: 100% !important;
            outline: none !important;
        }

        .dark .profile-card input[type="text"], 
        .dark .profile-card input[type="email"], 
        .dark .profile-card input[type="password"] {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }
        
        .profile-card input:focus {
            background: #f8fafc !important;
            border-color: #10b981 !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1) !important;
        }
        .dark .profile-card input:focus {
            background: rgba(255, 255, 255, 0.1) !important;
        }

        .profile-card .btn-save, 
        .profile-card button[type="submit"] {
            background: #f59e0b !important;
            color: #064e3b !important;
            font-weight: 900 !important;
            font-size: 0.875rem !important;
            text-transform: uppercase !important;
            padding: 0.75rem 2rem !important;
            border-radius: 1rem !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.2) !important;
        }

        .profile-card button:hover {
            background: #fbbf24 !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 15px 20px -5px rgba(245, 158, 11, 0.3) !important;
        }

        .profile-card .status-message { color: #10b981 !important; font-weight: 700 !important; margin-top: 1rem !important; display: block !important; }

        /* File input specific */
        .profile-card input[type="file"] {
            color: #71717a !important;
            font-size: 0.75rem !important;
        }
        .dark .profile-card input[type="file"] {
            color: rgba(255, 255, 255, 0.4) !important;
        }
        .profile-card input[type="file"]::-webkit-file-upload-button {
            background: rgba(16, 185, 129, 0.1) !important;
            color: #059669 !important;
            border: 1px solid rgba(16, 185, 129, 0.2) !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.75rem !important;
            font-weight: 800 !important;
            margin-right: 1rem !important;
            cursor: pointer !important;
        }
        .dark .profile-card input[type="file"]::-webkit-file-upload-button {
            color: #10b981 !important;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 min-h-screen text-zinc-900 dark:text-white transition-colors duration-500">

    @include('partials.navbar', ['transparentTheme' => false])

    <div class="pt-28 pb-20 min-h-screen relative overflow-hidden">
        {{-- Background Blobs --}}
        <div class="absolute top-[10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-emerald-600/5 dark:bg-emerald-500/10 blur-[120px] pointer-events-none transition-all duration-1000"></div>
        <div class="absolute bottom-[10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-amber-500/5 dark:bg-amber-500/5 blur-[120px] pointer-events-none transition-all duration-1000"></div>

        <div class="max-w-2xl mx-auto px-6 relative z-10">

            {{-- Page Header --}}
            <div class="mb-8 flex items-center gap-4">
                <a href="{{ route('akun') }}"
                   class="flex items-center gap-2 text-emerald-700 dark:text-emerald-400 hover:text-emerald-950 dark:hover:text-emerald-300 text-sm font-black transition group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Akun
                </a>
            </div>

            <div class="mb-10">
                <h1 class="text-3xl md:text-5xl font-black text-zinc-900 dark:text-white tracking-tighter transition-colors duration-500">Edit Profil</h1>
                <p class="text-zinc-500 dark:text-emerald-300/40 mt-2 font-medium italic transition-colors duration-500">Perbarui informasi akunmu untuk pengalaman yang lebih personil.</p>
            </div>

            {{-- Profile Info Card --}}
            <div class="profile-card bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[3rem] shadow-2xl shadow-emerald-950/5 dark:shadow-black/20 border border-emerald-100 dark:border-white/10 overflow-hidden mb-8 transition-all duration-500">
                <div class="p-8 border-b border-emerald-50 dark:border-white/5 bg-emerald-50/20 dark:bg-white/[0.02] transition-colors duration-500">
                    <h2 class="text-lg font-black text-zinc-900 dark:text-white uppercase tracking-tight transition-colors duration-500">Informasi Profil</h2>
                    <p class="text-zinc-400 dark:text-emerald-300/40 text-sm mt-1 font-medium transition-colors duration-500">Perbarui nama, foto, dan alamat email akun kamu.</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Password Card --}}
            <div class="profile-card bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[3rem] shadow-2xl shadow-emerald-950/5 dark:shadow-black/20 border border-emerald-100 dark:border-white/10 overflow-hidden mb-8 transition-all duration-500">
                <div class="p-8 border-b border-emerald-50 dark:border-white/5 bg-emerald-50/20 dark:bg-white/[0.02] transition-colors duration-500">
                    <h2 class="text-lg font-black text-zinc-900 dark:text-white uppercase tracking-tight transition-colors duration-500">Ubah Kata Sandi</h2>
                    <p class="text-zinc-400 dark:text-emerald-300/40 text-sm mt-1 font-medium transition-colors duration-500">Pastikan menggunakan kata sandi yang kuat agar akunmu aman.</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="profile-card bg-red-500/[0.03] backdrop-blur-2xl rounded-[2.5rem] shadow-2xl shadow-red-900/10 border border-red-500/20 overflow-hidden">
                <div class="p-8 border-b border-red-500/10 bg-red-500/[0.05]">
                    <h2 class="text-lg font-black text-red-500 uppercase tracking-tight">Hapus Akun</h2>
                    <p class="text-red-500/40 text-sm mt-0.5 font-medium">Setelah dihapus, semua data akunmu akan hilang permanen.</p>
                </div>
                <div class="p-8">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>

    @include('partials.footer')

    {{-- True Fullscreen Deletion Overlay for Donors - Minimalist Version --}}
    {{-- True Fullscreen Deletion Overlay for Donors - Optimized Animation --}}
    <div x-data="{ open: false, step: 1 }" 
         x-on:open-delete-overlay.window="open = true; step = 1"
         x-on:close-delete-overlay.window="open = false; step = 0"
         x-on:keydown.escape.window="open = false"
         class="relative">
        
        <div x-show="open" 
             x-cloak
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-[99999] flex items-center justify-center p-6"
             style="display: none;">
            
            {{-- Fixed Backdrop --}}
            <div class="fixed inset-0 bg-white/80 dark:bg-black/85 backdrop-blur-[40px] transition-colors duration-500"></div>
            
            {{-- Step 1: Warning Card --}}
            <div x-show="open && step === 1"
                 x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500 delay-100"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-12"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative w-full max-w-lg bg-white dark:bg-zinc-900/95 border border-emerald-100 dark:border-white/10 rounded-[4rem] p-10 sm:p-14 shadow-2xl overflow-hidden text-center transition-all duration-500">
                
                <div class="absolute top-0 left-0 w-full h-1.5 bg-red-600/50"></div>

                <div class="w-24 h-24 bg-red-500/10 rounded-full flex items-center justify-center mb-10 mx-auto border border-red-500/10">
                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                
                <h2 class="text-4xl font-black text-zinc-900 dark:text-white mb-4 tracking-tighter uppercase transition-colors duration-500">Hapus Akun?</h2>
                <p class="text-zinc-500 dark:text-emerald-100/40 text-xl mb-12 font-medium leading-relaxed italic transition-colors duration-500">
                    Tindakan ini tidak bisa dibatalkan. Seluruh riwayat donasi Anda akan terhapus secara permanen.
                </p>

                <div class="flex flex-col gap-4">
                    <button 
                        x-on:click.prevent="step = 2"
                        class="w-full bg-red-600 hover:bg-red-500 text-white font-black py-6 rounded-3xl transition-all text-base uppercase tracking-widest shadow-xl shadow-red-900/40"
                    >
                        Konfirmasi Hapus
                    </button>
                    <button 
                        x-on:click="open = false"
                        class="w-full bg-emerald-50 dark:bg-white/5 hover:bg-emerald-100 dark:hover:bg-white/10 text-zinc-400 dark:text-white/50 font-black py-5 rounded-3xl transition-all text-sm uppercase tracking-widest duration-500"
                    >
                        Kembali
                    </button>
                </div>
            </div>

            {{-- Step 2: Password Verification --}}
            <div x-show="open && step === 2"
                 x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 class="relative w-full max-w-md bg-white dark:bg-zinc-900 border border-emerald-100 dark:border-white/10 rounded-[4rem] p-12 shadow-2xl text-center transition-all duration-500">
                
                <div class="w-20 h-20 bg-emerald-50 dark:bg-white/5 rounded-full flex items-center justify-center mb-8 mx-auto border border-emerald-100 dark:border-white/10 text-emerald-600 dark:text-white transition-all duration-500">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-black text-zinc-900 dark:text-white mb-3 uppercase tracking-tighter transition-colors duration-500">Verifikasi</h2>
                <p class="text-zinc-500 dark:text-emerald-300/40 text-lg mb-10 font-medium italic transition-colors duration-500">
                    Masukkan password Anda.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full bg-emerald-50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 text-zinc-900 dark:text-white text-center text-3xl placeholder-zinc-200 dark:placeholder-white/5 rounded-2xl py-8 px-8 focus:border-red-600 focus:ring-4 focus:ring-red-600/10 transition-all outline-none font-black mb-10 duration-500"
                        placeholder="••••••••"
                        required
                        autofocus
                    />

                    <div class="flex flex-col gap-4">
                        <button 
                            type="submit"
                            class="w-full bg-red-600 hover:bg-red-500 text-white font-black py-6 rounded-3xl transition-all text-sm uppercase tracking-widest shadow-xl shadow-red-900/40"
                        >
                            Hapus Permanen
                        </button>
                        <button 
                            type="button" 
                            x-on:click="step = 1"
                            class="text-zinc-400 dark:text-white/20 hover:text-zinc-600 dark:hover:text-white/40 font-black py-2 text-xs uppercase tracking-widest transition-colors duration-500"
                        >
                            Sebelumnya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
@endif

