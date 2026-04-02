<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.users.index') }}" class="w-10 h-10 rounded-xl bg-white/50 backdrop-blur-md flex items-center justify-center text-emerald-950 hover:bg-emerald-500 hover:text-white transition-all shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h2 class="font-black text-2xl text-emerald-950 leading-tight border-l-2 border-emerald-500/20 pl-4">
                    Detail <span class="text-emerald-600">{{ $user->name }}</span>
                </h2>
            </div>
            <div class="px-6 py-2 bg-emerald-500/10 backdrop-blur-md rounded-full border border-emerald-500/20 text-emerald-900 text-[10px] font-black uppercase tracking-widest shadow-sm">
                ID Pengguna: #{{ $user->id }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative overflow-hidden min-h-screen">
        <!-- Liquid Decorative Blobs -->
        <div class="absolute top-20 -left-20 w-[500px] h-[500px] bg-emerald-400/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-20 -right-20 w-[500px] h-[500px] bg-amber-400/5 blur-[120px] rounded-full animate-pulse delay-700"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <!-- Profile Card -->
            <div class="bg-white/30 backdrop-blur-3xl p-10 sm:rounded-[3rem] border border-white/60 shadow-[0_8px_32px_0_rgba(6,78,59,0.05)] mb-12">
                <div class="flex flex-col md:flex-row items-center gap-10">
                    <div class="w-40 h-40 rounded-[2.5rem] bg-emerald-700 p-1 shadow-2xl relative group">
                        <div class="w-full h-full rounded-[2.2rem] overflow-hidden border-4 border-white">
                            @if($user->profile_picture)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($user->profile_picture) }}" alt="A" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-white text-5xl font-black">{{ substr($user->name, 0, 1) }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1 text-center md:text-left">
                        <div class="inline-block px-4 py-1 bg-white/50 rounded-full text-[10px] font-black uppercase tracking-widest text-emerald-700 border border-emerald-100 shadow-sm mb-4">
                            @if($user->role === 'admin') 🛡️ Administrator @else 🤝 Donatur Musholla @endif
                        </div>
                        <h1 class="text-4xl font-black text-emerald-950 mb-2 tracking-tight">{{ $user->name }}</h1>
                        <p class="text-emerald-900/60 font-bold mb-6 italic">{{ $user->email }}</p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="p-4 bg-white/50 rounded-3xl border border-white">
                                <div class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Total Donasi</div>
                                <div class="text-lg font-black text-emerald-700">Rp {{ number_format($user->donations()->where('status', 'confirmed')->sum('amount'), 0, ',', '.') }}</div>
                            </div>
                            <div class="p-4 bg-white/50 rounded-3xl border border-white">
                                <div class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Transaksi</div>
                                <div class="text-lg font-black text-emerald-700">{{ $user->donations->count() }} Kali</div>
                            </div>
                            <div class="p-4 bg-white/50 rounded-3xl border border-white">
                                <div class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Bergabung</div>
                                <div class="text-sm font-black text-emerald-900">{{ $user->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donation History -->
            <h3 class="text-xl font-black text-emerald-950 mb-6 flex items-center gap-3">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat Donasi
            </h3>

            <div class="bg-white/40 backdrop-blur-2xl sm:rounded-[3rem] border border-white/60 overflow-hidden shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-emerald-950/40 text-[10px] font-black uppercase tracking-[0.3em] border-b border-emerald-500/5">
                                <th class="px-8 py-6">ID Transaksi</th>
                                <th class="px-8 py-6">Tanggal</th>
                                <th class="px-8 py-6">Jumlah</th>
                                <th class="px-8 py-6">Status</th>
                                <th class="px-8 py-6 text-right">Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody class="font-sans">
                            @forelse($user->donations as $donation)
                                <tr class="border-b border-emerald-500/5 hover:bg-white/40 transition-colors group">
                                    <td class="px-8 py-6 font-mono text-xs font-bold text-emerald-950/40">#TRX-{{ $donation->id }}</td>
                                    <td class="px-8 py-6">
                                        <div class="text-emerald-950 font-bold text-sm">{{ $donation->created_at->format('d M Y') }}</div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $donation->created_at->format('H:i') }} WIB</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-emerald-700 font-black text-lg">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @if($donation->status === 'confirmed')
                                            <span class="px-4 py-1 bg-emerald-500/10 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-500/20">Selesai</span>
                                        @elseif($donation->status === 'pending')
                                            <span class="px-4 py-1 bg-amber-500/10 text-amber-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-amber-500/20">Pending</span>
                                        @else
                                            <span class="px-4 py-1 bg-red-500/10 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-500/20">Gagal</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        @if($donation->proof_path)
                                            <a href="{{ \Illuminate\Support\Facades\Storage::url($donation->proof_path) }}" target="_blank"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-700 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-emerald-600 transition-all shadow-lg shadow-emerald-900/20">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat Bukti
                                            </a>
                                        @else
                                            <span class="text-[10px] font-black text-gray-300 uppercase italic tracking-widest">Tidak Ada Bukti</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <p class="text-emerald-950/20 italic font-black text-2xl tracking-tighter uppercase">Belum ada donasi dari user ini</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
