<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-emerald-950 leading-tight">
                {{ __('Testimoni') }}
            </h2>
            <a href="{{ route('admin.testimonials.create') }}" class="px-6 py-2 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 transition-all text-sm uppercase tracking-widest">
                + Tambah Testimoni
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2.5rem] border border-white/50 p-8">
                @if (session('success'))
                    <div class="mb-6 px-6 py-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest">Nama</th>
                                <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest">Ulasan</th>
                                <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest">Status</th>
                                <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($testimonials as $item)
                                <tr class="border-b border-gray-50 hover:bg-emerald-50/30">
                                    <td class="py-4 px-6 font-bold text-gray-900">
                                        <div class="flex items-center gap-3">
                                            @if($item->avatar)
                                                <img src="{{ Storage::url($item->avatar) }}" class="w-10 h-10 rounded-full object-cover">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">{{ substr($item->name, 0, 1) }}</div>
                                            @endif
                                            <div>
                                                <div>{{ $item->name }}</div>
                                                <div class="text-xs text-gray-500 font-normal">{{ $item->role }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-500 italic">
                                        "{{ Str::limit($item->content, 20) }}"
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right space-x-3">
                                        <a href="{{ route('admin.testimonials.edit', $item) }}" class="text-emerald-600 font-bold text-sm uppercase">Edit</a>
                                        <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus testimoni ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 font-bold text-sm uppercase">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3" class="py-12 text-center text-gray-500 italic">Belum ada testimoni.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
