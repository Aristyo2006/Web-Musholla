<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-emerald-900 leading-tight">
            {{ __('Manajemen Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-emerald-100">
                <div class="p-8 text-gray-900">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-2xl font-bold text-emerald-900 mb-2">Koleksi Foto</h3>
                            <p class="text-gray-500">Kelola foto-foto untuk halaman galeri dan carousel utama.</p>
                        </div>
                        <a href="{{ route('admin.galleries.create') }}" class="px-6 py-3 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 transition shadow-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Foto
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-emerald-50 text-emerald-900 p-4 rounded-xl mb-6 flex items-center justify-between border border-emerald-200">
                            <strong class="font-bold">{{ session('success') }}</strong>
                            <button onclick="this.parentElement.style.display='none'" class="text-emerald-700 hover:text-emerald-900 font-bold">&times;</button>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @forelse($galleries as $gallery)
                            <div class="bg-gray-50 rounded-[2rem] p-3 border border-gray-100 shadow-sm relative group overflow-hidden">
                                <div class="h-48 rounded-[1.5rem] overflow-hidden mb-4 relative">
                                    <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                    @if($gallery->is_featured)
                                        <div class="absolute top-3 left-3 bg-amber-500 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-lg">
                                            CAROUSEL UTAMA
                                        </div>
                                    @endif
                                </div>
                                <div class="px-2">
                                    <h4 class="font-bold text-gray-900 text-lg mb-1 truncate">{{ $gallery->title ?? 'Tanpa Judul' }}</h4>
                                    <p class="text-gray-500 text-xs mb-4 truncate">{{ $gallery->description ?? 'Tidak ada deskripsi' }}</p>
                                    <div class="flex items-center justify-between border-t border-gray-200 pt-3">
                                        <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-emerald-600 hover:text-emerald-800 text-sm font-semibold flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-20 text-center">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada foto</h3>
                                <p class="text-gray-500">Mulai unggah foto progres pembangunan Musholla.</p>
                            </div>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
