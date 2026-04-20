<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.articles.index') }}" class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-emerald-900 @hover:bg-emerald-50 transition-all group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h2 class="font-black text-2xl text-emerald-950 leading-tight">
                    {{ __('Edit Artikel') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl shadow-emerald-900/5 sm:rounded-[2.5rem] border border-white/50">
                <div class="p-10 text-emerald-950 font-black border-b border-white/50 bg-gradient-to-r from-emerald-50/50 to-transparent flex items-center justify-between italic">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit: {{ $article->title }}
                    </div>
                    @if($article->is_published)
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[10px] font-black uppercase tracking-wider italic">Tayang Sejak {{ $article->published_at->format('d M Y') }}</span>
                    @else
                        <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded-full text-[10px] font-black uppercase tracking-wider italic">Draft</span>
                    @endif
                </div>
                <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PATCH')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Perspective -->
                        <div class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Judul Artikel</label>
                                <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition duration-300">
                                @error('title') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Slug (Permalink)</label>
                                <input type="text" name="slug" id="slug" required value="{{ old('slug', $article->slug) }}"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition duration-300 font-mono text-sm">
                                @error('slug') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Gambar Unggulan</label>
                                
                                <div class="relative group" x-data="{ imageUrl: null }">
                                    {{-- Container Drop Zone --}}
                                    <div class="px-6 py-10 border-2 border-dashed border-gray-200 rounded-2xl text-center bg-gray-50 hover:bg-emerald-50/50 hover:border-emerald-200 transition-all cursor-pointer relative overflow-hidden" 
                                         id="drop-zone"
                                         @click="$refs.imageInput.click()">
                                        
                                        {{-- Current/Placeholder View --}}
                                        <template x-if="!imageUrl">
                                            <div class="space-y-4">
                                                @if($article->image)
                                                    <div class="mb-4 relative group/old w-fit mx-auto">
                                                        <img src="{{ Storage::url($article->image) }}" alt="Current" class="h-40 w-64 object-cover rounded-xl shadow-md border-4 border-white">
                                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/old:opacity-100 transition rounded-xl flex items-center justify-center text-white text-xs font-bold italic uppercase tracking-widest">Gambar Saat Ini</div>
                                                    </div>
                                                    <p class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Klik atau geser untuk mengganti</p>
                                                @else
                                                    <svg class="w-10 h-10 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                                    <p class="text-sm text-gray-500">Klik untuk menambahkan gambar.</p>
                                                @endif
                                            </div>
                                        </template>

                                        {{-- New Image Preview --}}
                                        <template x-if="imageUrl">
                                            <div class="animate-fade-in relative group/preview">
                                                <img :src="imageUrl" class="max-h-64 mx-auto rounded-xl shadow-2xl border-4 border-emerald-400 object-cover">
                                                <div class="mt-4">
                                                    <p class="text-xs font-black text-emerald-900 uppercase tracking-widest mb-1 italic">Pratinjau Gambar Baru</p>
                                                    <p class="text-[10px] text-emerald-600 font-bold mb-2 uppercase tracking-tight" x-text="$refs.imageInput.files[0]?.name"></p>
                                                    <button type="button" @click.stop="imageUrl = null; $refs.imageInput.value = ''" class="mt-2 text-[10px] font-black text-red-500 uppercase tracking-[0.2em] hover:text-red-700 transition">Batalkan Perubahan</button>
                                                </div>
                                            </div>
                                        </template>

                                        <input type="file" name="image" id="image" x-ref="imageInput" class="hidden" accept="image/*"
                                               @change="const file = $event.target.files[0]; if(file) { imageUrl = URL.createObjectURL(file) }">
                                    </div>
                                </div>

                                @error('image') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Right Perspective -->
                        <div class="space-y-6">
                            <div>
                                <label for="content" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Konten / Isi Artikel</label>
                                <textarea name="content" id="content" required rows="12"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition duration-300">{{ old('content', $article->content) }}</textarea>
                                @error('content') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center gap-4 p-6 bg-emerald-50 rounded-2xl border border-emerald-100">
                                <input type="checkbox" name="is_published" id="is_published" {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                                    class="w-5 h-5 text-emerald-600 rounded focus:ring-emerald-500/20">
                                <label for="is_published" class="font-bold text-emerald-900 select-none cursor-pointer">Terbitkan?</label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="px-12 py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:bg-emerald-700 hover:scale-[1.02] active:scale-95 transition-all duration-300 text-lg">
                            Perbarui Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
