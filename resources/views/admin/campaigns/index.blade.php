<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <h2 class="font-bold text-xl text-emerald-900 leading-tight">
                {{ __('Manajemen Program Donasi (Campaigns)') }}
            </h2>
            <a href="{{ route('admin.campaigns.create') }}" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl shadow-lg shadow-emerald-200 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Program Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Success -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-emerald-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-emerald-50/50 text-emerald-900 border-b border-emerald-100">
                                <th class="py-4 px-6 font-bold">Program</th>
                                <th class="py-4 px-6 font-bold">Target & Terkumpul</th>
                                <th class="py-4 px-6 font-bold">Batas Waktu</th>
                                <th class="py-4 px-6 font-bold">Status</th>
                                <th class="py-4 px-6 font-bold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($campaigns as $campaign)
                                <tr class="hover:bg-emerald-50/50 transition-colors cursor-pointer group" 
                                    onclick="window.location='{{ route('admin.campaigns.show', $campaign) }}'">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center gap-4">
                                            @if($campaign->image)
                                                <img src="{{ Storage::url($campaign->image) }}" class="w-16 h-16 rounded-xl object-cover border border-gray-100">
                                            @else
                                                <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="font-bold text-gray-900 line-clamp-1 group-hover:text-emerald-700 transition-colors">{{ $campaign->title }}</h3>
                                                <p class="text-xs text-gray-500 mt-1">/donasi/{{ $campaign->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <p class="font-bold text-emerald-600">Rp {{ number_format($campaign->donations_sum_amount ?? 0, 0, ',', '.') }}</p>
                                        <p class="text-sm text-gray-500 mt-1">dari Rp {{ $campaign->target_amount ? number_format($campaign->target_amount, 0, ',', '.') : '~' }}</p>
                                    </td>
                                    <td class="py-4 px-6 font-medium text-gray-700">
                                        {{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'Tanpa Batas' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($campaign->is_active)
                                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200">Aktif</span>
                                        @else
                                            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full border border-red-200">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="inline-block" 
                                              onclick="event.stopPropagation()"
                                              onsubmit="return confirm('Yakin ingin menghapus program ini? Semua data donasi di dalamnya mungkin akan hilang atau orphan!')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all transform hover:scale-110" title="Hapus Program">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 px-6 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 mb-4 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                            <span class="text-lg font-bold text-gray-500">Belum ada Program Donasi.</span>
                                        </div>
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
