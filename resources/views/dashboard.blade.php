<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::user()->hasAdminAccess())
    {{-- ============================================================ --}}
    {{-- ADMIN DASHBOARD (PENGUASA & STAFF) --}}
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
                            <h2 class="text-3xl font-black tracking-tight mt-1">Dashboard {{ Auth::user()->role === 'admin' ? 'Admin' : 'Pengawas' }}</h2>
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
                        @if(Auth::user()->isAdmin())
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
                        @endif
                        <a href="{{ route('admin.campaigns.index') }}" class="p-8 bg-white rounded-2xl border border-gray-100 hover:border-amber-200 hover:bg-amber-50/30 transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-amber-600 rounded-xl flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg text-amber-900">Program Donasi</h3>
                                    <p class="text-amber-700 text-sm">Kelola program & konfirmasi donasi donatur di dalamnya.</p>
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
    @endif

</x-app-layout>
