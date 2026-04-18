<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Saya - Donasi Musholla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.theme-manager')
    @include('partials.favicons')
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
        }
        .donor-hero { background: transparent; }
        .stat-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.12);
            transition: all 0.3s ease;
        }
        .stat-card:hover { background: rgba(255,255,255,0.13); transform: translateY(-3px); }
        .glow-amber { box-shadow: 0 0 40px -10px rgba(245, 158, 11, 0.4); }
        .pulse-ring { animation: pulse-ring 2.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite; }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(245,158,11,0.4); }
            70% { box-shadow: 0 0 0 12px rgba(245,158,11,0); }
            100% { box-shadow: 0 0 0 0 rgba(245,158,11,0); }
        }
        .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; }
        .badge-confirmed { background: rgba(16,185,129,0.15); color: #059669; border: 1px solid rgba(16,185,129,0.3); }
        .badge-pending { background: rgba(245,158,11,0.15); color: #d97706; border: 1px solid rgba(245,158,11,0.3); }
        .badge-rejected { background: rgba(239,68,68,0.15); color: #dc2626; border: 1px solid rgba(239,68,68,0.3); }
        .donor-table tr { transition: background 0.2s; }
        .donor-table tbody tr:hover { background: rgba(16,185,129,0.04); }
        .fade-in { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity:0; transform:translateY(20px);} to{opacity:1;transform:translateY(0);} }
    </style>
</head>
<body class="bg-slate-50 dark:bg-zinc-950 text-zinc-900 dark:text-emerald-50 transition-colors duration-500">

    @include('partials.navbar', ['transparentTheme' => false])

    {{-- ===== HERO PROFILE SECTION ===== --}}
    <div class="donor-hero relative overflow-hidden pt-28 pb-0">
        {{-- Decorative blobs --}}
        <div class="absolute top-[-80px] right-[-80px] w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #f59e0b, transparent);"></div>
        <div class="absolute bottom-0 left-[-60px] w-72 h-72 rounded-full bg-emerald-600/5 dark:opacity-10 dark:bg-[radial-gradient(circle,_#10b981,_transparent)] transition-all duration-1000"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] rounded-full opacity-[0.02] dark:opacity-[0.03] pointer-events-none bg-emerald-600 dark:bg-white blur-[100px] transition-all duration-1000"></div>

        <div class="max-w-5xl mx-auto px-6 pb-0 relative z-10">
            {{-- Profile Row --}}
            <div class="flex flex-col sm:flex-row items-center sm:items-end gap-8 pb-10">
                {{-- Avatar --}}
                <div class="flex-shrink-0">
                    <div class="relative">
                        <div class="w-32 h-32 rounded-[2.5rem] overflow-hidden ring-4 ring-white dark:ring-white/20 shadow-2xl pulse-ring glow-amber transition-all duration-500">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Foto Profil" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-amber-400 via-amber-500 to-amber-600 flex items-center justify-center text-white text-5xl font-black">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('profile.edit') }}"
                           class="absolute -bottom-2 -right-2 w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-white shadow-lg hover:bg-amber-400 transition-all hover:scale-110 glow-amber"
                           title="Edit Profil">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Identity --}}
                <div class="text-center sm:text-left flex-1">
                    <div class="inline-flex items-center gap-2 bg-emerald-600/10 dark:bg-amber-500/20 border border-emerald-600/20 dark:border-amber-400/30 rounded-full px-4 py-1.5 mb-3 transition-colors duration-500">
                        <svg class="w-3 h-3 text-emerald-600 dark:text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        <span class="text-emerald-700 dark:text-amber-300 text-[11px] font-black uppercase tracking-widest transition-colors duration-500">Donatur Musholla</span>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-black text-zinc-900 dark:text-white tracking-tighter leading-tight transition-colors duration-500">{{ Auth::user()->name }}</h1>
                    <p class="text-zinc-500 dark:text-emerald-200/60 mt-1 text-sm md:text-base font-medium italic transition-colors duration-500">{{ Auth::user()->email }}</p>
                    <div class="mt-8 flex flex-wrap justify-center sm:justify-start gap-4">
                        <a href="{{ route('profile.edit') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-white/10 hover:bg-emerald-50 dark:hover:bg-white/20 border border-emerald-100 dark:border-white/20 rounded-2xl text-zinc-900 dark:text-white text-sm font-black transition-all hover:scale-105 shadow-xl shadow-emerald-950/5 dark:shadow-none duration-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Profil
                        </a>
                        <a href="{{ route('campaigns.index') }}"
                           class="inline-flex items-center gap-4 px-8 py-3 bg-emerald-600 dark:bg-amber-500 hover:bg-emerald-700 dark:hover:bg-amber-400 rounded-2xl text-white dark:text-emerald-950 text-sm font-black transition-all hover:scale-105 shadow-2xl glow-emerald dark:glow-amber duration-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            Donasi Lagi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Stats Strip --}}
            <div class="grid grid-cols-3 gap-6 border-t border-emerald-100 dark:border-white/10 pt-10 pb-12 transition-colors duration-500">
                <div class="bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[2rem] p-6 text-center border border-emerald-100 dark:border-white/10 shadow-2xl shadow-emerald-900/5 dark:shadow-none fade-in transition-all duration-500 hover:scale-[1.02]" style="animation-delay:0.1s">
                    <div class="text-xl md:text-3xl font-black text-emerald-700 dark:text-white transition-colors duration-500">Rp {{ number_format($totalPersonalAmount ?? 0, 0, ',', '.') }}</div>
                    <div class="text-zinc-400 dark:text-emerald-300/70 text-[10px] font-black uppercase tracking-widest mt-2 transition-colors duration-500">Total Disumbangkan</div>
                </div>
                <div class="bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[2rem] p-6 text-center border border-emerald-100 dark:border-white/10 shadow-2xl shadow-emerald-900/5 dark:shadow-none fade-in transition-all duration-500 hover:scale-[1.02]" style="animation-delay:0.2s">
                    <div class="text-xl md:text-3xl font-black text-emerald-700 dark:text-white transition-colors duration-500">{{ $totalPersonalCount ?? 0 }}</div>
                    <div class="text-zinc-400 dark:text-emerald-300/70 text-[10px] font-black uppercase tracking-widest mt-2 transition-colors duration-500">Donasi Terkonfirmasi</div>
                </div>
                <div class="bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[2rem] p-6 text-center border border-emerald-100 dark:border-white/10 shadow-2xl shadow-emerald-900/5 dark:shadow-none fade-in transition-all duration-500 hover:scale-[1.02]" style="animation-delay:0.3s">
                    @if(($pendingPersonal ?? 0) > 0)
                        <div class="text-xl md:text-3xl font-black text-amber-600 dark:text-amber-400 transition-colors duration-500">{{ $pendingPersonal }}</div>
                    @else
                        <div class="text-xl md:text-3xl font-black text-emerald-700 dark:text-white transition-colors duration-500">0</div>
                    @endif
                    <div class="text-zinc-400 dark:text-emerald-300/70 text-[10px] font-black uppercase tracking-widest mt-2 transition-colors duration-500">Menunggu Verifikasi</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="max-w-5xl mx-auto px-6 py-10 space-y-10 relative z-10">

        {{-- CHART --}}
        <div class="bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[3.5rem] shadow-2xl shadow-emerald-950/5 dark:shadow-black/20 border border-emerald-100 dark:border-white/10 overflow-hidden fade-in transition-all duration-500" style="animation-delay:0.4s">
            <div class="p-8 md:p-12 border-b border-emerald-50 dark:border-white/5 flex items-center justify-between bg-emerald-50/20 dark:bg-white/[0.02] transition-colors duration-500">
                <div>
                    <h2 class="text-2xl font-black text-zinc-900 dark:text-white tracking-tighter transition-colors duration-500">Grafik Kontribusi</h2>
                    <p class="text-zinc-400 dark:text-emerald-300/40 text-sm mt-1 font-medium italic transition-colors duration-500">Donasi terkonfirmasi dalam 30 hari terakhir</p>
                </div>
                <div class="flex items-center gap-3 bg-emerald-600/10 dark:bg-emerald-500/10 border border-emerald-600/20 dark:border-emerald-500/20 px-5 py-2.5 rounded-full transition-all duration-500">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-600 dark:bg-emerald-400 animate-pulse"></div>
                    <span class="text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase tracking-widest transition-colors duration-500">Rekapitulasi</span>
                </div>
            </div>
            <div class="p-8 md:p-12">
                <div class="h-80 w-full">
                    <canvas id="userDonationChart"></canvas>
                </div>
            </div>
        </div>

        {{-- HISTORY TABLE --}}
        <div class="bg-white dark:bg-white/5 backdrop-blur-2xl rounded-[3.5rem] shadow-2xl shadow-emerald-950/5 dark:shadow-black/20 border border-emerald-100 dark:border-white/10 overflow-hidden fade-in transition-all duration-500" style="animation-delay:0.55s">
            <div class="p-10 border-b border-emerald-50 dark:border-white/5 flex items-center justify-between bg-emerald-50/20 dark:bg-white/[0.02] transition-colors duration-500">
                <div>
                    <h2 class="text-2xl font-black text-zinc-900 dark:text-white tracking-tighter transition-colors duration-500">Riwayat Berbagi</h2>
                    <p class="text-zinc-400 dark:text-emerald-300/40 text-sm mt-1 font-medium italic transition-colors duration-500">Daftar kebaikan yang telah Anda tanam</p>
                </div>
                <a href="{{ route('campaigns.index') }}" class="text-emerald-700 dark:text-amber-400 hover:scale-105 transition-all flex items-center gap-2">
                    <div class="px-6 py-3 bg-emerald-600 dark:bg-amber-500 text-white dark:text-emerald-950 text-xs font-black uppercase tracking-widest rounded-2xl shadow-xl transition-all duration-500">Baru</div>
                </a>
            </div>

            @if($donationHistory->isEmpty())
                <div class="p-24 text-center">
                    <div class="w-24 h-24 bg-emerald-600/5 dark:bg-white/5 rounded-full flex items-center justify-center mx-auto mb-8 border border-emerald-600/10 dark:border-white/10 transition-colors duration-500">
                        <svg class="w-12 h-12 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-zinc-900 dark:text-white mb-4 tracking-tighter transition-colors duration-500">Mari Mulai Kebaikan</h3>
                    <p class="text-zinc-400 dark:text-emerald-300/30 text-base max-w-xs mx-auto mb-10 transition-colors duration-500">Mulai perjalanan tabungan akhiratmu bersama Musholla Al-Kautsar.</p>
                    <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-4 px-10 py-5 bg-emerald-600 dark:bg-amber-500 text-white dark:text-emerald-950 font-black rounded-2xl hover:scale-105 transition-all shadow-2xl duration-500">
                        Lihat Program Donasi
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-emerald-50/50 dark:bg-white/5 transition-colors duration-500">
                                <th class="px-10 py-6 text-left text-[10px] font-black text-emerald-700/40 dark:text-emerald-300/30 uppercase tracking-widest transition-colors duration-500">Program</th>
                                <th class="px-6 py-6 text-left text-[10px] font-black text-emerald-700/40 dark:text-emerald-300/30 uppercase tracking-widest transition-colors duration-500">Jumlah</th>
                                <th class="px-6 py-6 text-left text-[10px] font-black text-emerald-700/40 dark:text-emerald-300/30 uppercase tracking-widest transition-colors duration-500">Status</th>
                                <th class="px-6 py-6 text-left text-[10px] font-black text-emerald-700/40 dark:text-emerald-300/30 uppercase tracking-widest transition-colors duration-500">Tanggal</th>
                                <th class="px-6 py-6 text-left text-[10px] font-black text-emerald-700/40 dark:text-emerald-300/30 uppercase tracking-widest transition-colors duration-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100 dark:divide-white/5 transition-colors duration-500">
                            @foreach($donationHistory as $donation)
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-5">
                                        <div class="w-14 h-14 rounded-2xl overflow-hidden flex-shrink-0 bg-emerald-50 dark:bg-white/5 border border-emerald-100 dark:border-white/10 transition-colors duration-500">
                                            @if($donation->campaign && $donation->campaign->image)
                                                <img src="{{ Storage::url($donation->campaign->image) }}" alt="" class="w-full h-full object-cover grayscale-[0.2] dark:grayscale-0">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-black text-zinc-900 dark:text-white text-base tracking-tighter leading-tight transition-colors duration-500">{{ $donation->campaign->title ?? 'Program Donasi' }}</div>
                                            @if($donation->notes)
                                                <div class="text-zinc-400 dark:text-emerald-300/40 text-xs mt-1 truncate max-w-[250px] font-medium italic transition-colors duration-500">{{ $donation->notes }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-8">
                                    <span class="font-black text-emerald-700 dark:text-white text-lg tracking-tighter transition-colors duration-500">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-8">
                                    @if($donation->status === 'confirmed')
                                        <span class="status-badge bg-emerald-600/10 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-400 border border-emerald-600/20 dark:border-emerald-500/20 transition-all duration-500">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                            Confirmed
                                        </span>
                                    @elseif($donation->status === 'pending')
                                        <span class="status-badge bg-amber-500/10 text-amber-600 dark:text-amber-500 border border-amber-500/20 transition-all duration-500">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Pending
                                        </span>
                                    @else
                                        <span class="status-badge bg-red-500/10 text-red-600 dark:text-red-500 border border-red-500/20 transition-all duration-500">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-6 py-8">
                                    <div class="text-zinc-900 dark:text-white font-black transition-colors duration-500">{{ $donation->created_at->format('d M Y') }}</div>
                                    <div class="text-zinc-300 dark:text-emerald-300/30 text-[10px] font-black uppercase tracking-widest mt-1 transition-colors duration-500">{{ $donation->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-8">
                                    @if($donation->proof_path)
                                        <a href="{{ Storage::url($donation->proof_path) }}" target="_blank"
                                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-50 dark:bg-white/5 hover:bg-emerald-100 dark:hover:bg-white/10 text-emerald-700 dark:text-emerald-300 text-[10px] uppercase font-black tracking-widest rounded-xl transition-all border border-emerald-100 dark:border-white/5 hover:border-emerald-200 dark:hover:border-white/10 shadow-lg shadow-emerald-950/5 dark:shadow-none duration-500">
                                            Review
                                        </a>
                                    @else
                                        <span class="text-zinc-200 dark:text-white/10 text-xs font-black">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($donationHistory->hasPages())
                <div class="p-10 border-t border-emerald-50 dark:border-white/5 flex items-center justify-between bg-emerald-50/20 dark:bg-white/[0.02] transition-colors duration-500">
                    <span class="text-zinc-400 dark:text-emerald-300/30 text-[10px] font-black uppercase tracking-widest transition-colors duration-500">{{ $donationHistory->firstItem() }}–{{ $donationHistory->lastItem() }} of {{ $donationHistory->total() }} donations</span>
                    <div class="flex gap-3">
                        @if($donationHistory->onFirstPage())
                            <span class="px-6 py-3 rounded-2xl bg-emerald-100/50 dark:bg-white/5 text-zinc-300 dark:text-white/20 text-xs font-black cursor-not-allowed border border-emerald-100 dark:border-white/5 transition-all duration-500">← Prev</span>
                        @else
                            <a href="{{ $donationHistory->previousPageUrl() }}" class="px-6 py-3 rounded-2xl bg-white dark:bg-white/10 hover:bg-emerald-50 dark:hover:bg-white/20 text-zinc-900 dark:text-white text-xs font-black transition-all border border-emerald-100 dark:border-white/10 shadow-xl shadow-black/5 duration-500">← Prev</a>
                        @endif
                        @if($donationHistory->hasMorePages())
                            <a href="{{ $donationHistory->nextPageUrl() }}" class="px-6 py-3 rounded-2xl bg-emerald-600 dark:bg-amber-500 hover:bg-emerald-700 dark:hover:bg-amber-400 text-white dark:text-emerald-950 text-xs font-black transition-all shadow-2xl duration-500">Next →</a>
                        @else
                            <span class="px-6 py-3 rounded-2xl bg-emerald-100/50 dark:bg-white/5 text-zinc-300 dark:text-white/20 text-xs font-black cursor-not-allowed border border-emerald-100 dark:border-white/5 transition-all duration-500">Next →</span>
                        @endif
                    </div>
                </div>
                @endif
            @endif
        </div>

        {{-- QURAN MOTIVASI --}}
        <div class="rounded-[3.5rem] overflow-hidden relative fade-in transition-all duration-1000 shadow-2xl shadow-emerald-950/20" style="animation-delay:0.7s; background: linear-gradient(135deg, #065F46, #064E3B);">
            <div class="absolute top-0 right-0 w-80 h-80 opacity-20" style="background: radial-gradient(circle, #fbbf24, transparent); transform: translate(30%, -30%);"></div>
            <div class="p-12 md:p-16 flex flex-col md:flex-row items-center gap-12 relative z-10">
                <div class="text-amber-400 flex-shrink-0 animate-pulse">
                    <svg class="w-20 h-20 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
                </div>
                <div class="text-center md:text-left">
                    <p class="text-amber-300 text-xs font-black uppercase tracking-[0.3em] mb-4">Ayat Motivasi</p>
                    <p class="text-white text-xl md:text-3xl font-black leading-[1.4] tracking-tight italic">
                        "Perumpamaan orang yang menginfakkan hartanya di jalan Allah seperti sebutir biji yang menumbuhkan tujuh tangkai, pada setiap tangkai ada seratus biji."
                    </p>
                    <p class="text-emerald-200/50 text-sm font-black mt-6 uppercase tracking-widest">— QS. Al-Baqarah: 261</p>
                </div>
            </div>
        </div>

        <div class="h-8"></div>
    </div>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('userDonationChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 280);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
            gradient.addColorStop(0.7, 'rgba(16, 185, 129, 0.05)');
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            const isDark = document.documentElement.classList.contains('dark');
            const primaryColor = '#10b981';
            const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
            const textColor = isDark ? 'rgba(255,255,255,0.3)' : 'rgba(0,0,0,0.3)';
            const tooltipBg = isDark ? '#064E3B' : '#ffffff';
            const tooltipText = isDark ? '#ffffff' : '#064E3B';

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($userChartLabels),
                    datasets: [{
                        label: 'Donasi Saya (Rp)',
                        data: @json($userChartData),
                        borderColor: primaryColor,
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: gradient,
                        tension: 0.5,
                        pointRadius: 6,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: primaryColor,
                        pointBorderWidth: 3,
                        pointHoverRadius: 9,
                        pointHoverBackgroundColor: primaryColor,
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: tooltipBg,
                            titleColor: primaryColor,
                            bodyColor: tooltipText,
                            padding: 16,
                            cornerRadius: 20,
                            displayColors: false,
                            shadowBlur: 30,
                            shadowColor: 'rgba(0,0,0,0.1)',
                            callbacks: {
                                label: function(c) { return '  Rp ' + Number(c.raw).toLocaleString('id-ID'); }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10000,
                            ticks: {
                                callback: function(v) {
                                    if (v === 0) return 'Rp 0';
                                    if (v >= 1000000) return 'Rp ' + (v/1000000).toFixed(1) + 'jt';
                                    if (v >= 1000) return 'Rp ' + (v/1000) + 'rb';
                                    return 'Rp ' + v;
                                },
                                font: { weight: '800', size: 10, family: 'Outfit' },
                                color: textColor
                            },
                            grid: { color: gridColor }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                maxTicksLimit: 10,
                                font: { weight: '800', size: 10, family: 'Outfit' },
                                color: textColor
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
