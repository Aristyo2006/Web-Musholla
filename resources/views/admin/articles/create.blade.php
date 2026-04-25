<x-app-layout>
    @push('styles')
    <!-- Quill Snow Theme -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* Modern Premium Editor Styling */
        .ql-toolbar.ql-snow {
            border: 1px solid rgb(229 231 235) !important;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            background: linear-gradient(180deg, #ffffff, #f0fdf4) !important;
            padding: 1rem !important;
            border-bottom: none !important;
        }

        .ql-container.ql-snow {
            border: 1px solid rgb(229 231 235) !important;
            border-bottom-left-radius: 1rem !important;
            border-bottom-right-radius: 1rem !important;
            min-height: 22rem;
            font-family: 'Outfit', sans-serif !important;
            font-size: 1.05rem !important;
            background: white !important;
            transition: all 0.3s ease;
        }

        .ql-editor {
            min-height: 22rem;
            line-height: 1.8 !important;
            color: #1a2e26 !important;
            padding: 2rem !important;
        }

        .ql-editor.ql-blank::before {
            color: #94a3b8 !important;
            font-style: italic !important;
            left: 2rem !important;
            opacity: 0.6;
        }

        /* Focus State */
        .article-editor-wrapper:focus-within .ql-toolbar.ql-snow {
            border-color: #10b981 !important;
        }
        .article-editor-wrapper:focus-within .ql-container.ql-snow {
            border-color: #10b981 !important;
            box-shadow: 0 10px 30px -10px rgba(16, 185, 129, 0.1);
        }

        /* Customizing Toolbar Buttons */
        .ql-snow .ql-stroke { stroke: #064e3b !important; stroke-width: 1.5px !important; }
        .ql-snow .ql-fill { fill: #064e3b !important; }
        .ql-snow.ql-toolbar button:hover .ql-stroke { stroke: #10b981 !important; }
        .ql-snow.ql-toolbar button:hover .ql-fill { fill: #10b981 !important; }
        .ql-snow.ql-toolbar button.ql-active .ql-stroke { stroke: #10b981 !important; stroke-width: 2.5px !important; }

        .ql-picker.ql-header .ql-picker-label::before { content: 'Format' !important; font-weight: 700; color: #064e3b; }
        .ql-picker.ql-header .ql-picker-item[data-value="1"]::before { content: 'Heading 1' !important; }
        .ql-picker.ql-header .ql-picker-item[data-value="2"]::before { content: 'Heading 2' !important; }
        .ql-picker.ql-header .ql-picker-item::before { content: 'Normal' !important; }

        /* Typography inside editor */
        .ql-editor h1 { font-size: 2.5rem !important; font-weight: 900 !important; margin-bottom: 1.5rem !important; color: #064e3b !important; }
        .ql-editor h2 { font-size: 1.8rem !important; font-weight: 800 !important; margin-bottom: 1.25rem !important; color: #064e3b !important; }
        .ql-editor p { margin-bottom: 1.25rem !important; }
        .ql-editor blockquote {
            border-left: 4px solid #10b981 !important;
            padding-left: 1.5rem !important;
            font-style: italic !important;
            color: #4b5563 !important;
            background: #f0fdf4 !important;
            margin: 1.5rem 0 !important;
            padding: 1rem 1.5rem !important;
            border-radius: 0 1rem 1rem 0 !important;
        }
    </style>
    @endpush

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.articles.index') }}" class="w-10 h-10 bg-white rounded-xl shadow-sm border border-gray-100 flex items-center justify-center text-emerald-900 hover:bg-emerald-50 transition-all group">
                    <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <h2 class="font-black text-2xl text-emerald-950 leading-tight">
                    {{ __('Tambah Artikel Baru') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl shadow-emerald-900/5 sm:rounded-[2.5rem] border border-white/50">
                <div class="p-10 text-emerald-950 font-black border-b border-white/50 bg-gradient-to-r from-emerald-50/50 to-transparent flex items-center gap-3 italic">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Formulir Artikel Baru
                </div>
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6" id="article-form">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Perspective -->
                        <div class="space-y-6">
                            <div>
                                <label for="title" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Judul Artikel</label>
                                <input type="text" name="title" id="title" required placeholder="Contoh: Berbagi di Bulan Ramadhan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition duration-300">
                                @error('title') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="slug" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Slug (Permalink)</label>
                                <input type="text" name="slug" id="slug" required placeholder="berbagi-di-bulan-ramadhan"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition duration-300 font-mono text-sm">
                                @error('slug') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Gambar Unggulan</label>
                                <div class="relative group" x-data="{ imageUrl: null }">
                                    <div class="px-6 py-10 border-2 border-dashed border-gray-200 rounded-2xl text-center bg-gray-50 hover:bg-emerald-50/50 hover:border-emerald-200 transition-all cursor-pointer relative overflow-hidden" 
                                         id="drop-zone"
                                         @click="$refs.imageInput.click()">
                                        
                                        {{-- Icon & Placeholder --}}
                                        <div x-show="!imageUrl" class="space-y-4">
                                            <svg class="w-10 h-10 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            <p class="text-sm text-gray-500">Klik atau geser gambar ke sini.</p>
                                            <p class="text-xs text-gray-400 mt-1">Saran: 1200x800px, Tanpa Batasan Ukuran</p>
                                        </div>

                                        {{-- Image Preview --}}
                                        <div x-show="imageUrl" class="relative group/preview animate-fade-in">
                                            <img :src="imageUrl" class="max-h-64 mx-auto rounded-xl shadow-lg border border-emerald-100 object-cover">
                                            <div class="mt-4">
                                                <p class="text-sm font-bold text-emerald-900" x-text="$refs.imageInput.files[0]?.name"></p>
                                                <button type="button" @click.stop="imageUrl = null; $refs.imageInput.value = ''" class="mt-2 text-xs font-black text-red-500 uppercase tracking-widest hover:text-red-700 transition">Hapus & Ganti</button>
                                            </div>
                                        </div>

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
                                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Konten / Isi Artikel</label>
                                <div class="article-editor-wrapper">
                                    <div id="editor-container"></div>
                                </div>
                                <textarea name="content" id="content" required class="hidden">{{ old('content') }}</textarea>
                                @error('content') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center gap-4 p-6 bg-emerald-50 rounded-2xl border border-emerald-100">
                                <input type="checkbox" name="is_published" id="is_published" class="w-5 h-5 text-emerald-600 rounded focus:ring-emerald-500/20">
                                <label for="is_published" class="font-bold text-emerald-900 select-none cursor-pointer">Terbitkan Sekarang?</label>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="px-12 py-4 bg-emerald-600 text-white font-bold rounded-2xl shadow-xl hover:bg-emerald-700 hover:scale-[1.02] active:scale-95 transition-all duration-300 text-lg">
                            Simpan Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        // Simple auto-slug implementation
        document.getElementById('title').addEventListener('input', function() {
            let slug = this.value.toLowerCase()
                .replace(/[^\w ]+/g, '')
                .replace(/ +/g, '-');
            document.getElementById('slug').value = slug;
        });

        // Initialize Quill Editor
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tuliskan berita atau artikel lengkap di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'link'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Sync Quill content to hidden textarea
        var contentInput = document.getElementById('content');
        
        // Load initial content if exists (for old input)
        if (contentInput.value) {
            quill.root.innerHTML = contentInput.value;
        }

        // On form submit, sync content
        document.getElementById('article-form').addEventListener('submit', function() {
            contentInput.value = quill.root.innerHTML;
        });

        // Optional: Real-time sync
        quill.on('text-change', function() {
            contentInput.value = quill.root.innerHTML;
        });
    </script>
    @endpush
</x-app-layout>
