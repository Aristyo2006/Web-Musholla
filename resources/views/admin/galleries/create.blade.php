<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-emerald-900 leading-tight">
            {{ __('Unggah Foto Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-emerald-100 p-8">
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="image" class="block font-bold text-gray-700 mb-2">Foto / Gambar Baru <span class="text-red-500">*</span></label>
                        <div id="image-preview" class="mb-4 hidden">
                            <div class="relative w-48 aspect-video rounded-2xl overflow-hidden shadow-lg border-2 border-emerald-100">
                                <img src="" id="preview-tag" class="w-full h-full object-cover">
                                <button type="button" onclick="clearImage()" class="absolute top-2 right-2 w-6 h-6 bg-red-600 text-white rounded-full flex items-center justify-center shadow-xl hover:scale-110 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>
                        <input type="file" name="image" id="image" required accept="image/*" onchange="previewImage(event)" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all border border-gray-200 rounded-xl cursor-pointer">
                        @error('image') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="title" class="block font-bold text-gray-700 mb-2">Judul Foto</label>
                        <input type="text" name="title" id="title" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" placeholder="Contoh: Proses Pengecoran Atap">
                        @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="badge" class="block font-bold text-gray-700 mb-2">Label/Badge (Opsional)</label>
                        <input type="text" name="badge" id="badge" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" placeholder="Khusus Carousel. Contoh: INTERIOR">
                        @error('badge') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block font-bold text-gray-700 mb-2">Deskripsi Singkat</label>
                        <textarea name="description" id="description" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" placeholder="Jelaskan sedikit tentang progres foto ini..."></textarea>
                        @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="campaign_id" class="block font-bold text-gray-700 mb-2">Hubungkan ke Program Donasi (Opsional)</label>
                        <select name="campaign_id" id="campaign_id" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                            <option value="">-- Tidak Dihubungkan --</option>
                            @foreach($campaigns as $campaign)
                                <option value="{{ $campaign->id }}">{{ $campaign->title }}</option>
                            @endforeach
                        </select>
                        <p class="text-gray-400 text-xs mt-1">Jika dihubungkan, foto ini akan muncul sebagai dokumentasi di halaman donasi program tersebut.</p>
                        @error('campaign_id') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6 space-y-4">
                        <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100 flex items-start gap-3">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 mt-1 cursor-pointer">
                            <div>
                                <label for="is_featured" class="font-bold text-emerald-900 cursor-pointer">Jadikan Carousel Utama</label>
                                <p class="text-emerald-700 text-xs mt-1">Jika dicentang, foto ini akan muncul di halaman utama (Beranda) sebagai bagian dari slide interaktif.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label for="order" class="block font-bold text-gray-700 mb-2">Urutan Tampil (Opsional)</label>
                        <input type="number" name="order" id="order" value="0" class="w-full md:w-1/3 rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        <p class="text-gray-400 text-xs mt-1">Angka terkecil (0) akan tampil paling awal/depan.</p>
                        @error('order') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                            Unggah Foto
                        </button>
                        <a href="{{ route('admin.galleries.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const img = document.getElementById('preview-tag');
            const file = event.target.files[0];
            
            if(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function clearImage() {
            const preview = document.getElementById('image-preview');
            const input = document.getElementById('image');
            input.value = '';
            preview.classList.add('hidden');
        }
    </script>
    @endpush
</x-app-layout>
