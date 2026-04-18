<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::user()->isAdmin())
    {{-- ============================================================ --}}
    {{-- ADMIN DASHBOARD (EXISTING) --}}
    {{-- ============================================================ --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl shadow-emerald-900/5 sm:rounded-[2.5rem] border border-white/50">
                <div class="p-10 text-emerald-950 border-b border-white/50 flex justify-between items-center bg-gradient-to-r from-emerald-50/50 to-transparent">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 bg-emerald-700 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-emerald-900/20">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-emerald-600 uppercase tracking-widest">Selamat Datang Kembali</p>
                            <h2 class="text-3xl font-black tracking-tight mt-1">Admin Musholla</h2>
                        </div>
                    </div>
                    @if(session('error'))
                        <div class="flex items-center gap-2 bg-red-50 text-red-600 px-4 py-2 rounded-full font-black text-xs uppercase tracking-tighter shadow-sm border border-red-100">
                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                        <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 shadow-sm">
                            <div class="text-emerald-600 font-bold text-xs uppercase tracking-widest mb-1">Total Dana Terkumpul</div>
                            <div class="text-2xl font-black text-emerald-950">Rp {{ number_format($totalConfirmedAmount ?? 0, 0, ',', '.') }}</div>
                        </div>
                        <div class="p-6 bg-amber-50 rounded-3xl border border-amber-100 shadow-sm">
                            <div class="text-amber-600 font-bold text-xs uppercase tracking-widest mb-1">Donasi Pending</div>
                            <div class="text-2xl font-black text-amber-950">{{ $pendingDonationsCount ?? 0 }} Transaksi</div>
                        </div>
                        <div class="p-6 bg-emerald-50 rounded-3xl border border-emerald-100 shadow-sm">
                            <div class="text-emerald-600 font-bold text-xs uppercase tracking-widest mb-1">Total Donatur</div>
                            <div class="text-2xl font-black text-emerald-950">{{ $totalDonors ?? 0 }} Orang</div>
                        </div>
                        <div class="p-6 bg-amber-50 rounded-3xl border border-amber-100 shadow-sm">
                            <div class="text-amber-600 font-bold text-xs uppercase tracking-widest mb-1">Total Program</div>
                            <div class="text-2xl font-black text-amber-950">{{ $totalCampaigns ?? 0 }} Aktif</div>
                        </div>
                    </div>
                    <div class="bg-white rounded-[2.5rem] border border-emerald-50 p-8 shadow-xl shadow-emerald-900/5 mb-10 overflow-hidden relative">
                        <div class="flex justify-between items-center mb-8">
                            <div>
                                <h3 class="text-xl font-black text-emerald-950">Statistik Donasi Harian</h3>
                                <p class="text-sm text-gray-500 font-medium">Tren donasi terverifikasi dalam 30 hari terakhir.</p>
                            </div>
                            <div class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">LIVE DATA</div>
                        </div>
                        <div class="h-[350px] w-full">
                            <canvas id="donationChart"></canvas>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <a href="{{ route('admin.articles.index') }}" class="p-8 bg-white rounded-2xl border border-gray-100 hover:border-emerald-200 hover:bg-emerald-50/30 transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v4a2 2 0 002 2h4"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-emerald-900">Kelola Artikel</h3>
                                    <p class="text-emerald-700 text-sm">Buat, edit, dan hapus artikel atau berita musholla.</p>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('admin.donations.index') }}" class="p-8 bg-white rounded-2xl border border-gray-100 hover:border-amber-200 hover:bg-amber-50/30 transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-amber-900">Kelola Donasi</h3>
                                    <p class="text-amber-700 text-sm">Pantau dan catat donasi masuk dari para donatur.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const ctx = document.getElementById('donationChart').getContext('2d');
                        const gradient = ctx.createLinearGradient(0, 0, 0, 350);
                        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)');
                        gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: @json($chartLabels),
                                datasets: [{
                                    label: 'Donasi (Rp)',
                                    data: @json($chartData),
                                    borderColor: '#10b981', borderWidth: 4,
                                    fill: true, backgroundColor: gradient, tension: 0.4,
                                    pointRadius: 6, pointBackgroundColor: '#fff',
                                    pointBorderColor: '#10b981', pointBorderWidth: 3,
                                    pointHoverRadius: 8, pointHoverBackgroundColor: '#10b981',
                                    pointHoverBorderColor: '#fff', pointHoverBorderWidth: 4
                                }]
                            },
                            options: {
                                responsive: true, maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: { callback: function(v) { return 'Rp ' + (v/1000).toLocaleString() + 'k'; }, font: { weight: 'bold' } },
                                        grid: { color: 'rgba(0,0,0,0.05)' }
                                    },
                                    x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } }
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    @else
    {{-- ============================================================ --}}
    {{-- DONOR DASHBOARD (NEW PREMIUM DESIGN) --}}
    {{-- ============================================================ --}}
    <style>
        .donor-hero {
            background: linear-gradient(135deg, #064E3B 0%, #065F46 40%, #0F766E 100%);
        }
        .glass-card {
            background: rgba(255,255,255,0.07);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .stat-card {
            background: rgba(255,255,255,0.06);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.12);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            background: rgba(255,255,255,0.12);
            transform: translateY(-2px);
        }
        .glow-amber { box-shadow: 0 0 40px -10px rgba(245, 158, 11, 0.4); }
        .glow-emerald { box-shadow: 0 0 40px -10px rgba(16, 185, 129, 0.3); }
        .pulse-ring {
            animation: pulse-ring 2.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }
        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(245,158,11,0.4); }
            70% { box-shadow: 0 0 0 12px rgba(245,158,11,0); }
            100% { box-shadow: 0 0 0 0 rgba(245,158,11,0); }
        }
        .donor-table tr { transition: background 0.2s; }
        .donor-table tbody tr:hover { background: rgba(16,185,129,0.05); }
        .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 800; letter-spacing: 0.05em; text-transform: uppercase; }
        .badge-confirmed { background: rgba(16,185,129,0.15); color: #059669; border: 1px solid rgba(16,185,129,0.3); }
        .badge-pending { background: rgba(245,158,11,0.15); color: #d97706; border: 1px solid rgba(245,158,11,0.3); }
        .badge-rejected { background: rgba(239,68,68,0.15); color: #dc2626; border: 1px solid rgba(239,68,68,0.3); }
        .fade-in { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity:0; transform:translateY(16px);} to{opacity:1;transform:translateY(0);} }
    </style>

    <div class="min-h-screen" style="background: #f0fdf4;">
        {{-- HERO SECTION --}}
        <div class="donor-hero relative overflow-hidden">
            {{-- Decorative blobs --}}
            <div class="absolute top-[-60px] right-[-60px] w-80 h-80 rounded-full opacity-10" style="background: radial-gradient(circle, #d97706, transparent);"></div>
            <div class="absolute bottom-[-40px] left-[-40px] w-60 h-60 rounded-full opacity-10" style="background: radial-gradient(circle, #34d399, transparent);"></div>

            <div class="max-w-5xl mx-auto px-6 py-12 md:py-16 relative z-10">
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-8">
                    {{-- Avatar --}}
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <div class="w-28 h-28 rounded-[2rem] overflow-hidden ring-4 ring-white/20 shadow-xl pulse-ring glow-amber">
                                @if(Auth::user()->profile_picture)
                                    <img src="{{ Storage::url(Auth::user()->profile_picture) }}" alt="Foto Profil" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center text-white text-4xl font-black">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('profile.edit') }}" class="absolute -bottom-2 -right-2 w-9 h-9 bg-amber-500 rounded-xl flex items-center justify-center text-white shadow-lg hover:bg-amber-400 transition-all hover:scale-110 glow-amber" title="Edit Profil">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </a>
                        </div>
                    </div>

                    {{-- Identity --}}
                    <div class="text-center sm:text-left">
                        <div class="inline-flex items-center gap-2 bg-amber-500/20 border border-amber-400/30 rounded-full px-4 py-1.5 mb-3">
                            <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <span class="text-amber-300 text-[11px] font-black uppercase tracking-widest">Donatur Musholla</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight leading-tight">
                            {{ Auth::user()->name }}
                        </h1>
                        <p class="text-emerald-200/70 mt-1 text-sm font-medium">{{ Auth::user()->email }}</p>
                        <div class="mt-4 flex flex-wrap justify-center sm:justify-start gap-3">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 hover:bg-white/20 border border-white/20 rounded-2xl text-white text-sm font-bold transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                Edit Profil
                            </a>
                            <a href="{{ route('campaigns.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-400 rounded-2xl text-emerald-950 text-sm font-black transition-all hover:scale-105 shadow-lg glow-amber">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                Donasi Lagi
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Stats Row --}}
                <div class="grid grid-cols-3 gap-4 mt-10">
                    <div class="stat-card rounded-[1.5rem] p-5 text-center fade-in" style="animation-delay:0.1s">
                        <div class="text-2xl md:text-3xl font-black text-white">Rp {{ number_format($totalPersonalAmount ?? 0, 0, ',', '.') }}</div>
                        <div class="text-emerald-300/80 text-[11px] font-bold uppercase tracking-widest mt-1">Total Disumbangkan</div>
                    </div>
                    <div class="stat-card rounded-[1.5rem] p-5 text-center fade-in" style="animation-delay:0.2s">
                        <div class="text-2xl md:text-3xl font-black text-white">{{ $totalPersonalCount ?? 0 }}</div>
                        <div class="text-emerald-300/80 text-[11px] font-bold uppercase tracking-widest mt-1">Donasi Terkonfirmasi</div>
                    </div>
                    <div class="stat-card rounded-[1.5rem] p-5 text-center fade-in" style="animation-delay:0.3s">
                        @if(($pendingPersonal ?? 0) > 0)
                            <div class="text-2xl md:text-3xl font-black text-amber-400">{{ $pendingPersonal }}</div>
                        @else
                            <div class="text-2xl md:text-3xl font-black text-white">0</div>
                        @endif
                        <div class="text-emerald-300/80 text-[11px] font-bold uppercase tracking-widest mt-1">Menunggu Konfirmasi</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CONTENT --}}
        <div class="max-w-5xl mx-auto px-6 py-10 space-y-8">

            {{-- CHART CARD --}}
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-emerald-100/50 overflow-hidden fade-in" style="animation-delay:0.4s">
                <div class="p-8 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-black text-gray-900 tracking-tight">Kontribusi Saya</h2>
                            <p class="text-gray-500 text-sm mt-1">Riwayat donasi terkonfirmasi dalam 30 hari terakhir</p>
                        </div>
                        <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-100 px-4 py-2 rounded-full">
                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></div>
                            <span class="text-emerald-700 text-[11px] font-black uppercase tracking-widest">30 Hari</span>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    <div class="h-72 w-full">
                        <canvas id="userDonationChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- HISTORY TABLE --}}
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-emerald-100/50 overflow-hidden fade-in" style="animation-delay:0.55s">
                <div class="p-8 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-black text-gray-900 tracking-tight">Riwayat Donasi</h2>
                        <p class="text-gray-500 text-sm mt-1">Semua transaksi yang pernah kamu lakukan</p>
                    </div>
                    <a href="{{ route('campaigns.index') }}" class="text-emerald-600 hover:text-emerald-500 text-sm font-black flex items-center gap-1 transition">
                        Donasi Baru
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>

                @if($donationHistory->isEmpty())
                    <div class="p-16 text-center">
                        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-gray-800 mb-2">Belum Ada Donasi</h3>
                        <p class="text-gray-500 text-sm max-w-xs mx-auto">Mulai perjalanan kebaikanmu bersama Musholla Al-Kautsar.</p>
                        <a href="{{ route('campaigns.index') }}" class="inline-flex mt-6 items-center gap-2 px-8 py-3.5 bg-emerald-600 text-white font-black rounded-2xl hover:bg-emerald-500 transition-all hover:scale-105 shadow-lg shadow-emerald-900/20">
                            Lihat Program Donasi
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full donor-table">
                            <thead>
                                <tr class="bg-gray-50/80">
                                    <th class="px-8 py-4 text-left text-[11px] font-black text-gray-500 uppercase tracking-widest">Program</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-black text-gray-500 uppercase tracking-widest">Jumlah</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-black text-gray-500 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-black text-gray-500 uppercase tracking-widest">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-[11px] font-black text-gray-500 uppercase tracking-widest">Bukti</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($donationHistory as $donation)
                                <tr>
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-xl overflow-hidden flex-shrink-0 bg-emerald-50">
                                                @if($donation->campaign && $donation->campaign->image)
                                                    <img src="{{ Storage::url($donation->campaign->image) }}" alt="" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full bg-emerald-100 flex items-center justify-center">
                                                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-black text-gray-900 text-sm">{{ $donation->campaign->title ?? 'Program Donasi' }}</div>
                                                @if($donation->notes)
                                                    <div class="text-gray-400 text-xs mt-0.5 truncate max-w-[180px]">{{ $donation->notes }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="font-black text-gray-900 text-sm">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($donation->status === 'confirmed')
                                            <span class="status-badge badge-confirmed">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                                                Terkonfirmasi
                                            </span>
                                        @elseif($donation->status === 'pending')
                                            <span class="status-badge badge-pending">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Menunggu
                                            </span>
                                        @else
                                            <span class="status-badge badge-rejected">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="text-gray-600 text-sm font-bold">{{ $donation->created_at->format('d M Y') }}</span>
                                        <div class="text-gray-400 text-xs">{{ $donation->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($donation->proof_path)
                                            <a href="{{ Storage::url($donation->proof_path) }}" target="_blank"
                                               class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-black rounded-xl transition-all border border-emerald-100 hover:border-emerald-200">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm2.458-6.58A9 9 0 115.982 18.418"></path></svg>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-gray-300 text-xs font-bold">—</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($donationHistory->hasPages())
                    <div class="p-6 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-gray-500 text-sm">Menampilkan {{ $donationHistory->firstItem() }}–{{ $donationHistory->lastItem() }} dari {{ $donationHistory->total() }} donasi</span>
                        <div class="flex gap-2">
                            @if($donationHistory->onFirstPage())
                                <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 text-sm font-bold cursor-not-allowed">← Sebelumnya</span>
                            @else
                                <a href="{{ $donationHistory->previousPageUrl() }}" class="px-4 py-2 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-bold transition">← Sebelumnya</a>
                            @endif
                            @if($donationHistory->hasMorePages())
                                <a href="{{ $donationHistory->nextPageUrl() }}" class="px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold transition">Selanjutnya →</a>
                            @else
                                <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 text-sm font-bold cursor-not-allowed">Selanjutnya →</span>
                            @endif
                        </div>
                    </div>
                    @endif
                @endif
            </div>

            {{-- MOTIVATIONAL FOOTER --}}
            <div class="rounded-[2.5rem] overflow-hidden relative fade-in" style="animation-delay:0.7s; background: linear-gradient(135deg, #064E3B, #0F766E);">
                <div class="absolute top-0 right-0 w-64 h-64 opacity-10" style="background: radial-gradient(circle, #fbbf24, transparent); transform: translate(30%, -30%);"></div>
                <div class="p-10 md:p-12 flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <div class="text-amber-400 flex-shrink-0">
                        <svg class="w-16 h-16 opacity-80" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.593c-5.63-5.539-11-10.297-11-14.402 0-3.791 3.068-5.191 5.281-5.191 1.312 0 4.151.501 5.719 4.457 1.59-3.968 4.464-4.447 5.726-4.447 2.54 0 5.274 1.621 5.274 5.181 0 4.069-5.136 8.625-11 14.402z"/></svg>
                    </div>
                    <div class="text-center md:text-left">
                        <p class="text-amber-300 text-sm font-black uppercase tracking-widest mb-2">Ayat Motivasi</p>
                        <p class="text-white text-xl md:text-2xl font-bold leading-relaxed italic">
                            "Perumpamaan orang yang menginfakkan hartanya di jalan Allah seperti sebutir biji yang menumbuhkan tujuh tangkai, pada setiap tangkai ada seratus biji."
                        </p>
                        <p class="text-emerald-300/70 text-sm font-bold mt-3">— QS. Al-Baqarah: 261</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('userDonationChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 280);
            gradient.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
            gradient.addColorStop(0.6, 'rgba(16, 185, 129, 0.08)');
            gradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($userChartLabels),
                    datasets: [{
                        label: 'Donasi Saya (Rp)',
                        data: @json($userChartData),
                        borderColor: '#10b981',
                        borderWidth: 3,
                        fill: true,
                        backgroundColor: gradient,
                        tension: 0.5,
                        pointRadius: 5,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 2.5,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#10b981',
                        pointHoverBorderColor: '#fff',
                        pointHoverBorderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#064E3B',
                            titleColor: '#6ee7b7',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 12,
                            callbacks: {
                                label: function(c) { return ' Rp ' + Number(c.raw).toLocaleString('id-ID'); }
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
                                font: { weight: '700', size: 11 },
                                color: '#6b7280'
                            },
                            grid: { color: 'rgba(0,0,0,0.04)' }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                maxTicksLimit: 10,
                                font: { weight: '700', size: 11 },
                                color: '#9ca3af'
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endif

</x-app-layout>
