<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-emerald-950 leading-tight">
                {{ __('Monitoring User') }}
            </h2>
            <div class="px-4 py-2 bg-white/50 backdrop-blur-sm rounded-xl border border-white/50 text-emerald-900 text-xs font-bold uppercase tracking-widest shadow-sm">
                Total User: {{ $users->count() }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative" x-data="{ showDeleteModal: false, deleteAction: '' }">
        <!-- Liquid Delete Confirmation Modal -->
        <div x-show="showDeleteModal" 
            x-transition:enter="transition ease-out duration-300" 
            x-transition:enter-start="opacity-0 scale-95" 
            x-transition:enter-end="opacity-100 scale-100" 
            x-transition:leave="transition ease-in duration-200" 
            x-transition:leave-start="opacity-100 scale-100" 
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-emerald-950/20 backdrop-blur-sm"
            style="display: none;">
            
            <div class="bg-white/80 backdrop-blur-3xl p-8 rounded-[3rem] border border-white max-w-sm w-full shadow-[0_20px_50px_rgba(6,78,59,0.2)] relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-500/10 blur-3xl rounded-full"></div>
                
                <div class="relative z-10 text-center">
                    <div class="w-16 h-16 bg-red-50 rounded-2xl flex items-center justify-center text-red-500 mx-auto mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-emerald-950 mb-2 uppercase tracking-tighter">Hapus User?</h3>
                    <p class="text-gray-500 text-sm font-bold mb-8">Tindakan ini permanen. Seluruh data terkait user ini akan dihapus.</p>
                    
                    <div class="flex gap-4">
                        <button @click="showDeleteModal = false" class="flex-1 py-4 bg-gray-100 text-gray-500 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-200 transition-all">Batal</button>
                        <form :action="deleteAction" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-4 bg-red-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-900/20">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liquid Decorative Blobs -->
        <div class="absolute top-0 -left-20 w-96 h-96 bg-emerald-300/20 blur-[100px] rounded-full animate-blob"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-amber-300/10 blur-[100px] rounded-full animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/40 backdrop-blur-3xl overflow-hidden shadow-[0_8px_32px_0_rgba(6,78,59,0.1)] sm:rounded-[3rem] border border-white/60">
                <div class="p-10 text-emerald-950">
                    @if(session('success'))
                        <div class="mb-6 px-4 py-3 bg-emerald-500/10 backdrop-blur-md border border-emerald-500/20 text-emerald-700 rounded-2xl text-sm font-black flex items-center gap-2">
                             <svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                             {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-6 px-4 py-3 bg-red-500/10 backdrop-blur-md border border-red-500/20 text-red-700 rounded-2xl text-sm font-black flex items-center gap-2">
                             <svg class="w-5 h-5 font-bold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                             {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-separate border-spacing-y-4">
                            <thead>
                                <tr class="text-emerald-900/40 text-[10px] font-black uppercase tracking-[0.3em]">
                                    <th class="px-8 py-2">Pengguna</th>
                                    <th class="px-8 py-2">Role & Akses</th>
                                    <th class="px-8 py-2 text-center">Total Donasi</th>
                                    <th class="px-8 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="font-sans">
                                @forelse($users as $user)
                                    <tr class="bg-white/30 backdrop-blur-md hover:bg-white/60 transition-all duration-500 rounded-[2rem] shadow-sm border border-white/20 group">
                                        <td class="px-8 py-6 first:rounded-l-[2rem]">
                                            <a href="{{ route('admin.users.show', $user) }}" class="flex items-center gap-4 group/item">
                                                <div class="w-14 h-14 rounded-2xl bg-emerald-700 rotate-3 group-hover/item:rotate-0 transition-transform duration-500 flex items-center justify-center text-white text-xl font-black shadow-lg shadow-emerald-900/20 overflow-hidden relative">
                                                    @if($user->profile_picture)
                                                        <img src="{{ Storage::url($user->profile_picture) }}" alt="A" class="w-full h-full object-cover">
                                                    @else
                                                        {{ substr($user->name, 0, 1) }}
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-black text-emerald-950 text-lg tracking-tight group-hover/item:text-emerald-600 transition-colors">{{ $user->name }}</div>
                                                    <div class="text-xs text-emerald-600/60 font-bold">{{ $user->email }}</div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="flex items-center justify-center gap-2">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" onchange="this.form.submit()" 
                                                    class="bg-white/50 border-none rounded-full px-4 py-1 text-[10px] font-black uppercase tracking-widest focus:ring-2 focus:ring-emerald-500/20 cursor-pointer shadow-sm
                                                    @if($user->role === 'admin') text-amber-600 bg-amber-50 @elseif($user->role === 'pengawas') text-blue-600 bg-blue-50 @else text-emerald-600 bg-emerald-50 @endif">
                                                    <option value="donatur" {{ $user->role === 'donatur' ? 'selected' : '' }}>Donatur</option>
                                                    <option value="pengawas" {{ $user->role === 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                </select>
                                                @if($user->role === 'admin')
                                                     <div class="w-2 h-2 rounded-full bg-amber-400 animate-pulse shadow-[0_0_8px_rgba(251,191,36,0.8)]"></div>
                                                @elseif($user->role === 'pengawas')
                                                     <div class="w-2 h-2 rounded-full bg-blue-400 animate-pulse shadow-[0_0_8px_rgba(37,99,235,0.8)]"></div>
                                                @endif
                                            </form>
                                        </td>
                                        <td class="px-8 py-6 text-center">
                                            <a href="{{ route('admin.users.show', $user) }}" class="inline-block px-4 py-2 bg-emerald-500/10 rounded-2xl border border-emerald-500/5 hover:bg-emerald-500/20 transition-all">
                                                <span class="text-emerald-700 font-black text-sm tracking-tighter text-left block">Rp {{ number_format($user->donations_sum_amount ?? 0, 0, ',', '.') }}</span>
                                                <div class="text-[9px] text-emerald-500/60 font-bold uppercase tracking-widest mt-0.5 text-left">{{ $user->donations_count }} Transaksi</div>
                                            </a>
                                        </td>
                                        <td class="px-8 py-6 last:rounded-r-[2rem]">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('admin.users.show', $user) }}" class="w-10 h-10 rounded-xl bg-white/50 flex items-center justify-center text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 transition-all shadow-sm">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </a>
                                                <button type="button" 
                                                    @click="deleteAction = '{{ route('admin.users.destroy', $user) }}'; showDeleteModal = true"
                                                    class="w-10 h-10 rounded-xl bg-white/50 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-all shadow-sm">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-20 text-center">
                                            <p class="text-emerald-950/20 italic font-black text-2xl tracking-tighter">BELUM ADA USER LAIN</p>
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

    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
    </style>
</x-app-layout>
