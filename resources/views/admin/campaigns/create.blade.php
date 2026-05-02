<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-emerald-900 leading-tight">
            {{ __('Buat Program Donasi Baru') }}
        </h2>
    </x-slot>

    @push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border: 1px solid #e5e7eb;
            border-top-left-radius: 1.5rem;
            border-top-right-radius: 1.5rem;
            background: #f9fafb;
            padding: 12px;
            border-bottom: none;
        }
        .ql-container.ql-snow {
            border: 1px solid #e5e7eb;
            border-bottom-left-radius: 1.5rem;
            border-bottom-right-radius: 1.5rem;
            min-height: 300px;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            background: white;
        }
        .ql-editor { min-height: 300px; }
        .ql-editor.ql-blank::before { color: #9ca3af; font-style: normal; }
    </style>
    @endpush

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-3xl border border-emerald-100 p-8">
                <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="title" class="block font-bold text-gray-700 mb-2">Judul Program <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" required class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" placeholder="Contoh: Pembebasan Lahan Parkir">
                        @error('title') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block font-bold text-gray-700 mb-2">Penjelasan Lengkap Program <span class="text-red-500">*</span></label>
                        <div id="editor-container" class="bg-gray-50 rounded-2xl"></div>
                        <textarea name="description" id="description" class="hidden" required></textarea>
                        @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="target_amount" class="block font-bold text-gray-700 mb-2">Target Dana (Rp) <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="number" name="target_amount" id="target_amount" min="0" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" placeholder="Contoh: 50000000">
                        </div>
                        <div>
                            <label for="end_date" class="block font-bold text-gray-700 mb-2">Batas Waktu Tutup <span class="text-gray-400 font-normal">(Opsional)</span></label>
                            <input type="date" name="end_date" id="end_date" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div class="mb-8 p-6 border border-emerald-100 rounded-[2rem] bg-emerald-50/20" x-data="{ bannerUrl: null }">
                        <label for="image" class="block font-black text-emerald-900 mb-4 uppercase tracking-widest text-xs">Banner Utama Program <span class="text-red-500">*</span></label>
                        
                        <div x-show="bannerUrl" class="mb-4 animate-fade-in">
                            <div class="relative w-full aspect-video rounded-2xl overflow-hidden shadow-2xl border-2 border-emerald-200">
                                <img :src="bannerUrl" class="w-full h-full object-cover">
                                <button type="button" @click="bannerUrl = null; $refs.bannerInput.value = ''" class="absolute top-4 right-4 w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>

                        <div x-show="!bannerUrl" @click="$refs.bannerInput.click()" class="cursor-pointer border-4 border-dashed border-emerald-200 rounded-[2rem] p-10 flex flex-col items-center justify-center bg-white hover:bg-emerald-50 hover:border-emerald-400 transition-all group">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <p class="font-bold text-emerald-900">Pilih Banner Utama</p>
                            <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-widest font-black">Saran: 16:9 (1200x675px)</p>
                        </div>

                        <input type="file" name="image" id="image" required accept="image/*" x-ref="bannerInput" class="hidden" 
                               @change="const file = $event.target.files[0]; if(file) { bannerUrl = URL.createObjectURL(file) }">
                        @error('image') <span class="text-red-500 text-sm mt-3 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8 p-6 bg-amber-50/30 rounded-[2.5rem] border border-amber-100/50" 
                         x-data="{ 
                            files: [],
                            addFiles(event) {
                                const selectedFiles = Array.from(event.target.files);
                                selectedFiles.forEach(file => {
                                    if (!this.files.some(f => f.name === file.name && f.size === file.size)) {
                                        this.files.push({
                                            file: file,
                                            url: URL.createObjectURL(file),
                                            name: file.name
                                        });
                                    }
                                });
                                this.updateInput();
                            },
                            removeFile(index) {
                                URL.revokeObjectURL(this.files[index].url);
                                this.files.splice(index, 1);
                                this.updateInput();
                            },
                            updateInput() {
                                const dt = new DataTransfer();
                                this.files.forEach(f => dt.items.add(f.file));
                                this.$refs.docInput.files = dt.files;
                            }
                         }">
                        <label class="block font-bold text-amber-900 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Dokumentasi & Galeri Program <span class="text-gray-400 font-normal ml-auto text-xs">(Opsional)</span>
                        </label>

                        <input type="file" name="documentation_images[]" x-ref="docInput" multiple accept="image/*" class="hidden" @change="addFiles">
                        
                        {{-- Drag & Drop / Click Zone --}}
                        <div @click="$refs.docInput.click()" 
                             class="group cursor-pointer border-4 border-dashed border-amber-200/50 rounded-[2rem] p-10 flex flex-col items-center justify-center bg-white/50 hover:bg-amber-100/50 hover:border-amber-400/50 transition-all duration-500 mb-8">
                            <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-lg">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                            <p class="font-black text-amber-900 uppercase tracking-widest text-sm">Tambah Foto Dokumentasi</p>
                            <p class="text-[10px] text-amber-700/40 mt-2 font-bold uppercase tracking-widest">Klik untuk memilih (bisa cicil foto satu per satu)</p>
                        </div>

                        {{-- Selected Files Preview --}}
                        <div x-show="files.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4 animate-fade-in-up">
                            <template x-for="(file, index) in files" :key="index">
                                <div class="relative aspect-video rounded-2xl overflow-hidden border border-amber-200 shadow-xl group/item">
                                    <img :src="file.url" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-zinc-950/40 opacity-0 group-hover/item:opacity-100 transition-opacity"></div>
                                    <button type="button" @click="removeFile(index)" class="absolute top-2 right-2 w-8 h-8 bg-red-600 text-white rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <div x-show="files.length === 0" class="text-center py-4">
                            <p class="text-[10px] font-black text-amber-700/20 uppercase tracking-[0.3em]">Belum ada foto dipilih</p>
                        </div>

                        @error('documentation_images') <span class="text-red-500 text-sm mt-4 block font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-8 p-6 bg-emerald-50/50 rounded-2xl border border-emerald-100">
                        <label class="block font-bold text-emerald-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Pengaturan Form Donasi (Wajib Diisi di Web)
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="show_name" value="1" checked class="rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500">
                                <span class="text-sm font-bold text-emerald-800 group-hover:text-emerald-600 transition-colors">Nama</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="show_email" value="1" checked class="rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500">
                                <span class="text-sm font-bold text-emerald-800 group-hover:text-emerald-600 transition-colors">Email</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="show_message" value="1" checked class="rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500">
                                <span class="text-sm font-bold text-emerald-800 group-hover:text-emerald-600 transition-colors">Pesan</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="checkbox" name="show_address" value="1" checked class="rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500">
                                <span class="text-sm font-bold text-emerald-800 group-hover:text-emerald-600 transition-colors">Alamat</span>
                            </label>
                        </div>
                        <p class="text-[10px] text-emerald-600 mt-4 leading-relaxed font-medium">Field yang dicentang akan muncul di website dan wajib diisi oleh donatur. Jika Nama tidak dicentang, sistem akan otomatis mencatatnya sebagai "Anonymous".</p>
                    </div>

                    <div class="mb-8 space-y-4">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-start gap-3">
                            <input type="checkbox" name="is_active" id="is_active" value="1" checked class="rounded border-gray-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 mt-1 cursor-pointer">
                            <div>
                                <label for="is_active" class="font-bold text-gray-900 cursor-pointer">Program Aktif</label>
                                <p class="text-gray-500 text-xs mt-1">Jika dicentang, program donasi ini akan langsung terbuka dan bisa menerima donasi dari publik (Tampil di Landing Page).</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                        <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 hover:-translate-y-1 transition-all duration-300">
                            Simpan Program Baru
                        </button>
                        <a href="{{ route('admin.campaigns.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tuliskan deskripsi lengkap program di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['link', 'clean']
                ]
            }
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', function() {
            document.getElementById('description').value = quill.root.innerHTML;
        });
    </script>
    @endpush
</x-app-layout>
