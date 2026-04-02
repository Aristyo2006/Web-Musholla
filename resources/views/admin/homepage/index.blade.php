<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-emerald-900 leading-tight">
            {{ __('Manajemen Konten Homepage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center gap-3 animate-fade-in-up">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Section 1: Hero -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-[2rem] border border-emerald-100 p-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-emerald-950">Bagian Hero Utama</h3>
                            <p class="text-sm text-gray-500">Teks yang muncul paling atas di halaman depan.</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Judul Utama (H1)</label>
                            <textarea name="hero_title" rows="3" class="w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-200 transition-all font-medium" placeholder="Contoh: Selamat Datang di Website Musholla Al-Kautsar">{{ $settings['hero_title'] ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Sub-judul / Deskripsi Kecil</label>
                            <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? '' }}" class="w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-200 transition-all font-medium" placeholder="Contoh: Mari Bersama Membangun Rumah Allah...">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Tentang Kita -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-[2rem] border border-emerald-100 p-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-emerald-950">Bagian Tentang Musholla</h3>
                            <p class="text-sm text-gray-500">Konten profil musholla dan foto pendukung.</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Judul Section</label>
                            <input type="text" name="about_title" value="{{ $settings['about_title'] ?? 'Tentang Musholla Al-Kautsar' }}" class="w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-200 transition-all font-medium">
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 mb-2">Isi Konten</label>
                            <textarea name="about_content" rows="6" class="w-full rounded-2xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-200 transition-all font-medium" placeholder="Tuliskan sejarah atau visi misi musholla...">{{ $settings['about_content'] ?? '' }}</textarea>
                        </div>
                        
                        <div x-data="{ photoName: null, photoPreview: null }" class="pt-4">
                            <label class="block font-bold text-gray-700 mb-4">Foto Musholla (Gradient Fade Effect)</label>
                            
                            <input type="file" class="hidden" x-ref="photo" 
                                   name="about_image"
                                   @change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                                   ">

                            <div class="flex items-start gap-8">
                                <div class="w-48 h-32 rounded-2xl overflow-hidden bg-gray-100 border-2 border-dashed border-gray-200 flex items-center justify-center relative group">
                                    <!-- Current Photo -->
                                    <template x-if="!photoPreview">
                                        @if(isset($settings['about_image']))
                                            <img src="{{ Storage::url($settings['about_image']) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </template>
                                    <!-- Preview Photo -->
                                    <template x-if="photoPreview">
                                        <img :src="photoPreview" class="w-full h-full object-cover">
                                    </template>
                                    
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                        <span class="text-white text-xs font-bold">Ganti Foto</span>
                                    </div>
                                </div>

                                <div class="flex-grow">
                                    <button type="button" @click="$refs.photo.click()" class="px-6 py-3 bg-emerald-50 text-emerald-700 font-bold rounded-xl border border-emerald-100 hover:bg-emerald-100 transition-all flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                        Pilih Foto Baru
                                    </button>
                                    <p class="text-xs text-gray-400">Rekomendasi: Resolusi Landscape (4:3 atau 16:9), Maks 2MB.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 pb-12">
                    <button type="submit" class="px-10 py-4 bg-emerald-600 text-white font-black rounded-2xl shadow-xl shadow-emerald-900/20 hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                        Simpan Perubahan Homepage
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
