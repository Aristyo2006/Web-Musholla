<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-emerald-900 leading-tight">
            {{ __('Edit Program Donasi: ') }} <span class="text-emerald-600">{{ $campaign->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-emerald-100 p-8">
                <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-6">
                        <label for="title" class="block font-bold text-gray-700 mb-2">Judul Program <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $campaign->title) }}" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block font-bold text-gray-700 mb-2">Penjelasan Lengkap Program <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="5" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">{{ old('description', $campaign->description) }}</textarea>
                        @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="target_amount" class="block font-bold text-gray-700 mb-2">Target Dana (Rp) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="number" name="target_amount" id="target_amount" value="{{ old('target_amount', $campaign->target_amount) }}" min="0" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="end_date" class="block font-bold text-gray-700 mb-2">Batas Waktu Tutup <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $campaign->end_date ? $campaign->end_date->format('Y-m-d') : '') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div class="mb-8 p-4 border border-gray-100 rounded-2xl bg-gray-50/50">
                        <label for="image" class="block font-bold text-gray-700 mb-2">Banner Program</label>
                        <div class="flex items-start gap-6">
                            @if($campaign->image)
                                <div class="w-32 h-auto shrink-0 rounded-xl overflow-hidden shadow-sm border border-gray-200">
                                    <img src="{{ Storage::url($campaign->image) }}" alt="Banner" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="flex-grow">
                                <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition-all border border-gray-200 rounded-xl cursor-pointer">
                                <p class="text-gray-400 text-xs mt-2">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                @error('image') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-8 space-y-4">
                        <div class="bg-emerald-50 p-4 rounded-xl border border-emerald-100 flex items-start gap-3">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $campaign->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 mt-1 cursor-pointer">
                            <div>
                                <label for="is_active" class="font-bold text-emerald-900 cursor-pointer">Program Aktif</label>
                                <p class="text-emerald-700 text-xs mt-1">Jika dicentang, program donasi ini akan langsung terbuka dan bisa menerima donasi dari publik (Tampil di Landing Page).</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.campaigns.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
