<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-black text-2xl text-emerald-950 leading-tight">
                {{ __('Tentang Kami') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl shadow-emerald-900/5 sm:rounded-[2.5rem] border border-white/50">
                <div class="p-8">
                    @if (session('success'))
                        <div class="mb-6 px-6 py-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-bold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest">Judul</th>
                                    <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest">Slug</th>
                                    <th class="py-4 px-6 font-black text-gray-400 text-xs uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pages as $page)
                                    <tr class="border-b border-gray-50 hover:bg-emerald-50/30 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-900">{{ $page->title }}</td>
                                        <td class="py-4 px-6 text-gray-500 font-mono text-sm">{{ $page->slug }}</td>
                                        <td class="py-4 px-6 text-right space-x-3">
                                            <a href="{{ route('admin.pages.edit', $page) }}" class="text-emerald-600 hover:text-emerald-900 font-bold text-sm uppercase tracking-widest">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-12 text-center text-gray-500 italic">Belum ada halaman yang dibuat.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
