<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <nav class="flex text-sm text-emerald-600/60 mb-2 font-bold uppercase tracking-widest"
                    aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="{{ route('admin.campaigns.index') }}"
                                class="hover:text-emerald-600 transition-colors">Program</a></li>
                        <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg></li>
                        <li class="text-emerald-900">Detail Laporan</li>
                    </ol>
                </nav>
                <h2 class="font-black text-3xl text-emerald-900 leading-tight">
                    {{ $campaign->title }}
                </h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.donations.create', ['campaign_id' => $campaign->id]) }}"
                    class="px-6 py-3 bg-amber-500 text-white font-black rounded-2xl shadow-xl shadow-amber-200 hover:bg-amber-600 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5 font-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Catat Manual
                </a>
                <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                    class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-2xl shadow-sm hover:bg-gray-50 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Program
                </a>
                <a href="{{ route('admin.campaigns.export', $campaign) }}"
                    class="px-6 py-3 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl shadow-emerald-200 hover:bg-emerald-700 transition-all flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Simpan Excel
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Quick Stats Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div
                    class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-emerald-50 relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <p class="text-sm font-bold text-emerald-600/60 uppercase tracking-widest mb-2 relative z-10">Total
                        Terkumpul</p>
                    <h3 class="text-3xl font-black text-emerald-900 relative z-10">Rp
                        {{ number_format($campaign->donations()->where('status', 'confirmed')->sum('amount'), 0, ',', '.') }}
                    </h3>
                    <div class="mt-4 w-full bg-emerald-50 h-2 rounded-full overflow-hidden relative z-10">
                        @php
                            $percent = $campaign->target_amount > 0 ? min(100, ($campaign->donations()->where('status', 'confirmed')->sum('amount') / $campaign->target_amount) * 100) : 100;
                        @endphp
                        <div class="bg-emerald-500 h-full rounded-full transition-all duration-1000"
                            style="width: {{ $percent }}%"></div>
                    </div>
                    <p class="mt-2 text-xs font-bold text-emerald-600 relative z-10">{{ number_format($percent, 1) }}%
                        dari target Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-emerald-50 relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <p class="text-sm font-bold text-amber-600/60 uppercase tracking-widest mb-2 relative z-10">Jumlah
                        Donatur</p>
                    <h3 class="text-3xl font-black text-gray-900 relative z-10">{{ $donations->count() }} Orang</h3>
                    <p class="mt-4 text-xs font-bold text-amber-600 relative z-10">Telah memberikan kontribusi</p>
                </div>

                <div
                    class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-emerald-50 relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700">
                    </div>
                    <p class="text-sm font-bold text-blue-600/60 uppercase tracking-widest mb-2 relative z-10">Status
                        Program</p>
                    <div class="flex items-center gap-2 relative z-10">
                        <div
                            class="w-3 h-3 rounded-full {{ $campaign->is_active ? 'bg-emerald-500' : 'bg-red-500' }} animate-pulse">
                        </div>
                        <h3 class="text-2xl font-black text-gray-900">{{ $campaign->is_active ? 'Aktif' : 'Non-aktif' }}
                        </h3>
                    </div>
                    <p class="mt-4 text-xs font-bold text-blue-600 relative z-10">Terakhir update:
                        {{ $campaign->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="bg-white p-8 md:p-10 rounded-[3rem] shadow-2xl shadow-emerald-900/5 border border-emerald-50">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">Tren Akumulasi Donasi</h3>
                        <p class="text-gray-500 font-medium">Pertumbuhan saldo terkumpul seiring waktu</p>
                    </div>
                    <div class="px-4 py-2 bg-emerald-50 border border-emerald-100 rounded-xl">
                        <span class="text-emerald-700 font-bold text-sm">Garis Akumulasi Total</span>
                    </div>
                </div>
                <div class="h-[400px] w-full">
                    <canvas id="cumulativeChart"></canvas>
                </div>
            </div>

            <!-- Donators Table Section -->
            <div
                class="bg-white rounded-[3rem] shadow-2xl shadow-emerald-900/5 border border-emerald-50 overflow-hidden">
                <div class="p-8 md:p-10 border-b border-gray-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">Daftar Kontribusi Lengkap</h3>
                        <p class="text-gray-500 font-medium">Semua data donatur yang sudah terkonfirmasi</p>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-gray-400 text-[11px] font-black uppercase tracking-widest">
                                <th class="py-5 px-6 border-r border-gray-50">NAMA DONATUR</th>
                                <th class="py-5 px-4 border-r border-gray-50">JUMLAH (RP)</th>
                                <th class="py-5 px-4 border-r border-gray-50 text-center">STATUS</th>
                                <th class="py-5 px-4 border-r border-gray-50">TANGGAL</th>
                                <th class="py-5 px-4 text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 divide-y divide-gray-50">
                            @forelse($donationsLatest as $index => $donation)
                                <tr class="hover:bg-emerald-50/30 transition-colors group">
                                    <td class="py-5 px-6 border-r border-gray-50">
                                        <span class="font-black text-emerald-900 block">{{ $donation->donator_name }}</span>
                                        <span class="text-xs text-gray-400 font-medium">{{ $donation->email ?? 'No Email' }}</span>
                                        <p class="text-gray-600 italic line-clamp-1 group-hover:line-clamp-none transition-all cursor-default text-xs mt-1">"{{ $donation->notes ?? '-' }}"</p>
                                        @if($donation->proof_path)
                                            <button onclick="window.dispatchEvent(new CustomEvent('open-image-modal', { detail: '{{ Storage::url($donation->proof_path) }}' }))" type="button" class="inline-flex items-center gap-1.5 mt-2 px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-[10px] font-black shadow-sm hover:bg-amber-200 transition-all border border-amber-200 uppercase tracking-widest cursor-pointer">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Bukti
                                            </button>
                                        @endif
                                    </td>
                                    <td class="py-5 px-4 border-r border-gray-50 font-black text-emerald-600 text-lg whitespace-nowrap">
                                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-5 px-4 border-r border-gray-50 text-center">
                                        @if($donation->status === 'confirmed')
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-wider">Berhasil</span>
                                        @elseif($donation->status === 'pending')
                                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-wider">Pending</span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-black uppercase tracking-wider">Batal</span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-4 border-r border-gray-50">
                                        <span class="text-gray-400 font-bold block mb-1 text-xs uppercase whitespace-nowrap">{{ $donation->created_at->format('d M Y, H:i') }}</span>
                                    </td>
                                    <td class="py-5 px-4">
                                        <div class="flex flex-col gap-2 items-center justify-center">
                                            @if($donation->status === 'pending')
                                                <form action="{{ route('admin.donations.approve', $donation) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-[10px] uppercase tracking-widest flex items-center justify-center gap-1 shadow-lg shadow-emerald-200 transition-all w-full">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" onsubmit="return confirm('Hapus donasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-lg text-[10px] uppercase tracking-widest flex items-center justify-center gap-1 transition-all w-full">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 text-center text-gray-400 font-bold italic text-sm">
                                        Belum ada data donasi tercatat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($donationsLatest->hasPages())
                    <div class="px-10 py-8 bg-gray-50 border-t border-gray-100">
                        {{ $donationsLatest->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Scripts for Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('cumulativeChart').getContext('2d');

            // Generate gradient for the line
            const borderGradient = ctx.createLinearGradient(0, 0, ctx.canvas.width, 0);
            borderGradient.addColorStop(0, '#10b981');
            borderGradient.addColorStop(1, '#059669');

            // Generate gradient for the fill
            const fillGradient = ctx.createLinearGradient(0, 0, 0, 400);
            fillGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
            fillGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

            const data = @json($chartData);

            new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: [{
                        label: 'Akumulasi Donasi',
                        data: data.map(item => ({
                            x: item.t,
                            y: item.y
                        })),
                        borderColor: borderGradient,
                        borderWidth: 5,
                        backgroundColor: fillGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#10b981',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: '#10b981',
                        pointHoverBorderColor: '#ffffff',
                        pointHoverBorderWidth: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(6, 78, 59, 0.9)',
                            titleFont: { size: 14, weight: 'bold', family: 'Outfit' },
                            bodyFont: { size: 16, weight: 'black', family: 'Outfit' },
                            padding: 16,
                            borderRadius: 16,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                displayFormats: {
                                    day: 'D MMM'
                                }
                            },
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: { weight: 'bold', family: 'Outfit' },
                                color: '#94a3b8'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(241, 245, 249, 1)',
                                drawBorder: false
                            },
                            ticks: {
                                font: { weight: 'bold', family: 'Outfit' },
                                color: '#94a3b8',
                                callback: function (value) {
                                    if (value >= 1000000) return 'Rp ' + (value / 1000000) + 'jt';
                                    if (value >= 1000) return 'Rp ' + (value / 1000) + 'rb';
                                    return 'Rp ' + value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- Alpine Image Modal (Teleported to Body to cover Navbar) -->
    <div x-data="{ open: false, imageUrl: '', scale: 1, isDragging: false, startX: 0, startY: 0, translateX: 0, translateY: 0 }" 
         @open-image-modal.window="open = true; imageUrl = $event.detail; scale = 1; translateX = 0; translateY = 0;">
        <template x-teleport="body">
            <div x-show="open" 
                 style="display: none;"
                 class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-emerald-950/90 backdrop-blur-md"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                
                <div class="relative w-full max-w-4xl max-h-[90vh] bg-white rounded-3xl shadow-2xl flex flex-col overflow-hidden" @click.away="open = false; scale=1; translateX=0; translateY=0;">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 bg-gray-50 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Bukti Transfer Donasi
                    </h3>
                    <div class="flex items-center gap-2">
                        <button @click="scale = Math.min(scale + 0.25, 3)" class="w-8 h-8 bg-gray-200 hover:bg-emerald-100 text-gray-700 hover:text-emerald-700 rounded-full flex items-center justify-center transition" title="Zoom In">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg>
                        </button>
                        <button @click="scale = Math.max(scale - 0.25, 0.5)" class="w-8 h-8 bg-gray-200 hover:bg-emerald-100 text-gray-700 hover:text-emerald-700 rounded-full flex items-center justify-center transition" title="Zoom Out">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path></svg>
                        </button>
                        <div class="w-px h-5 bg-gray-300 mx-1"></div>
                        <button @click="open = false" class="w-8 h-8 bg-red-100 hover:bg-red-500 text-red-600 hover:text-white rounded-full flex items-center justify-center transition" title="Tutup">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Image Container -->
                <div class="overflow-hidden w-full flex-grow flex items-center justify-center bg-gray-100 p-4 relative"
                     x-ref="scrollContainer"
                     :class="{ 'cursor-grab': !isDragging, 'cursor-grabbing': isDragging }"
                     @mousedown="isDragging = true; startX = $event.pageX - translateX; startY = $event.pageY - translateY;"
                     @mousemove="if(!isDragging) return; $event.preventDefault(); translateX = $event.pageX - startX; translateY = $event.pageY - startY;"
                     @mouseup="isDragging = false"
                     @mouseleave="isDragging = false">
                    <img :src="imageUrl" :style="`transform: translate(${translateX}px, ${translateY}px) scale(${scale}); transform-origin: center; pointer-events: none;`" class="max-w-full h-auto object-contain shadow-sm transition-transform duration-75">
                </div>
            </div>
        </div>
        </template>
    </div>
</x-app-layout>