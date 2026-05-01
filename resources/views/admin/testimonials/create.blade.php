<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-emerald-950 leading-tight">
            {{ __('Tambah Testimoni') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl shadow-2xl sm:rounded-[2.5rem] border border-white/50 p-8">
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="mb-6 px-6 py-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl font-bold">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Nama</label>
                            <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Peran / Jabatan (Opsional)</label>
                            <input type="text" name="role" value="{{ old('role') }}" placeholder="Contoh: Donatur Tetap" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Ulasan / Testimoni</label>
                            <textarea name="content" required rows="4" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">{{ old('content') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Foto / Avatar (Opsional)</label>
                            <input type="file" name="avatar" accept="image/*" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded text-emerald-600 focus:ring-emerald-500">
                            <label for="is_active" class="font-bold text-gray-700">Aktifkan Testimoni</label>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
