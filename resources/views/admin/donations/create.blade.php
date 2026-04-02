<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Catat Donasi Baru') }}
            </h2>
            <a href="{{ route('admin.donations.index') }}" class="text-gray-600 hover:text-amber-900 font-bold text-sm">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[3rem] border border-gray-100 p-12">
                <div class="mb-10 text-center">
                    <div class="w-20 h-20 bg-amber-50 mx-auto rounded-3xl flex items-center justify-center text-amber-600 mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 mb-2">Pencatatan Donasi</h3>
                    <p class="text-gray-400">Gunakan formulir ini untuk mencatat donasi yang diterima secara manual atau tunai.</p>
                </div>

                <form action="{{ route('admin.donations.store') }}" method="POST" class="space-y-8">
                    @csrf
                    
                    <div>
                        <label for="donator_name" class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Nama Donatur</label>
                        <input type="text" name="donator_name" id="donator_name" required placeholder="Hamba Allah / Nama Lengkap"
                            class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl ring-1 ring-gray-200 focus:ring-2 focus:ring-amber-500 outline-none transition duration-300 font-bold text-gray-700">
                    </div>

                    <div>
                        <label for="amount" class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Nominal Donasi (IDR)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-6 flex items-center text-gray-400 font-bold">Rp</div>
                            <input type="number" name="amount" id="amount" required placeholder="500.000"
                                class="w-full pl-16 pr-6 py-4 bg-gray-50 border-0 rounded-2xl ring-1 ring-gray-200 focus:ring-2 focus:ring-amber-500 outline-none transition duration-300 font-mono font-bold text-gray-700">
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Catatan / Doa (Opsional)</label>
                        <textarea name="notes" id="notes" rows="4" placeholder="Semoga berkah untuk semua..."
                            class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl ring-1 ring-gray-200 focus:ring-2 focus:ring-amber-500 outline-none transition duration-300 font-bold text-gray-700"></textarea>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Status Donasi</label>
                        <select name="status" id="status" class="w-full px-6 py-4 bg-gray-50 border-0 rounded-2xl ring-1 ring-gray-200 focus:ring-2 focus:ring-amber-500 outline-none transition duration-300 font-bold text-gray-700">
                            <option value="confirmed">Confirmed (Berhasil Diterima)</option>
                            <option value="pending">Pending (Menunggu Verifikasi)</option>
                            <option value="cancelled">Cancelled (Batal)</option>
                        </select>
                    </div>

                    <div class="pt-10">
                        <button type="submit" class="w-full py-5 bg-emerald-600 text-white font-black rounded-3xl shadow-xl shadow-emerald-900/20 hover:bg-emerald-700 hover:scale-[1.02] active:scale-95 transition-all duration-300 text-lg uppercase tracking-widest leading-none flex items-center justify-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Catatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
