<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Donasi') }}
            </h2>
            <a href="{{ route('admin.donations.create') }}" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition font-bold text-sm">
                + Catat Donasi Manual
            </a>
        </div>
    </x-slot>

    <div class="py-12 text-emerald-950 font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
            <!-- Summary Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="emerald-gradient p-10 rounded-[2.5rem] shadow-2xl shadow-emerald-900/20 text-white relative overflow-hidden group hover:scale-[1.02] transition-all duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="text-emerald-100 text-xs font-black uppercase tracking-[0.2em] mb-3">Total Donasi Terkumpul</div>
                        <div class="text-4xl font-black tracking-tight italic">Rp {{ number_format($totalDonation, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="bg-white/70 backdrop-blur-md p-10 rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-white/50 group hover:scale-[1.02] transition-all duration-300">
                    <div class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-3">Total Transaksi</div>
                    <div class="text-4xl font-black text-emerald-950 tracking-tight">{{ $donations->count() }}</div>
                </div>
                <div class="bg-white/70 backdrop-blur-md p-10 rounded-[2.5rem] shadow-xl shadow-emerald-900/5 border border-white/50 group hover:scale-[1.02] transition-all duration-300">
                    <div class="text-gray-400 text-xs font-black uppercase tracking-[0.2em] mb-3">Menunggu Konfirmasi</div>
                    <div class="text-4xl font-black text-amber-500 tracking-tight">{{ $donations->where('status', 'pending')->count() }}</div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl shadow-emerald-900/5 sm:rounded-[3rem] border border-white/50">
                <div class="p-12">
                    @if(session('success'))
                        <div class="mb-8 px-6 py-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl text-sm font-black flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-4">
                            <thead>
                                <tr class="text-gray-400 text-[10px] font-black uppercase tracking-[0.2em]">
                                    <th class="px-6 py-2">Donatur</th>
                                    <th class="px-6 py-2">Nominal</th>
                                    <th class="px-6 py-2">Status</th>
                                    <th class="px-6 py-2">Tanggal</th>
                                    <th class="px-6 py-2 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($donations as $donation)
                                    <tr class="bg-gray-50/50 hover:bg-gray-50 transition rounded-2xl group">
                                        <td class="px-6 py-5 first:rounded-l-2xl">
                                            <div class="font-bold text-gray-900">{{ $donation->donator_name }}</div>
                                            <div class="text-xs text-gray-400 italic">"{{ $donation->notes ?? '-' }}"</div>
                                            @if($donation->proof_path)
                                                <button onclick="window.dispatchEvent(new CustomEvent('open-image-modal', { detail: '{{ Storage::url($donation->proof_path) }}' }))" type="button" class="inline-flex items-center gap-1.5 mt-3 px-3 py-1.5 bg-amber-100 text-amber-700 rounded-lg text-xs font-black shadow-sm hover:bg-amber-200 transition-all border border-amber-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    Lihat Bukti Transfer
                                                </button>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 font-mono font-bold text-emerald-700">
                                            Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($donation->status === 'confirmed')
                                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-wider">Berhasil</span>
                                            @elseif($donation->status === 'pending')
                                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase tracking-wider">Pending</span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-black uppercase tracking-wider">Batal</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 text-sm text-gray-500">
                                            {{ $donation->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-5 text-right last:rounded-r-2xl">
                                            <div class="flex gap-4 justify-end">
                                                @if($donation->status === 'pending')
                                                    <form action="{{ route('admin.donations.approve', $donation) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-xs tracking-tighter flex items-center gap-1 shadow-lg shadow-emerald-200 transition-all">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            Approve & Kirim Email
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-20 text-center">
                                            <div class="text-gray-300 mb-4">
                                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <p class="text-gray-400 italic">Belum ada data donasi yang tercatat.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <!-- Toolbar -->
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
                
                <!-- Image Container with Zoom & Pan -->
                <div class="overflow-hidden w-full flex-grow flex items-center justify-center bg-gray-100 p-4 select-none relative"
                     x-ref="scrollContainer"
                     :class="{ 'cursor-grab': !isDragging, 'cursor-grabbing': isDragging }"
                     @mousedown="isDragging = true; startX = $event.pageX - translateX; startY = $event.pageY - translateY;"
                     @mousemove="if(!isDragging) return; $event.preventDefault(); translateX = $event.pageX - startX; translateY = $event.pageY - startY;"
                     @mouseup="isDragging = false"
                     @mouseleave="isDragging = false">
                    <img :src="imageUrl" :style="`transform: translate(${translateX}px, ${translateY}px) scale(${scale}); transform-origin: center; pointer-events: none;`" class="max-w-full h-auto object-contain shadow-sm transition-transform duration-75" alt="Bukti Transfer">
                </div>
            </div>
        </div>
    </template>
    </div>
</x-app-layout>
