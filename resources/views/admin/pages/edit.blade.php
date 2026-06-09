<x-app-layout>
    @push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-container.ql-snow { min-height: 400px; font-family: 'Outfit', sans-serif; font-size: 1.1rem; }

        /* === Custom Spacing Picker — polished === */
        .ql-snow .ql-picker.ql-spacing { width: 86px; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-label { padding-left: 6px; display: flex; align-items: center; gap: 2px; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-label::before { content: 'Spasi'; font-size: 13px; font-weight: 600; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-options { width: auto; min-width: 120px; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-item { padding: 4px 10px; font-size: 13px; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-item[data-value="rapat"]::before { content: '🟢 Rapat'; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-item[data-value="normal"]::before { content: '🟡 Normal'; }
        .ql-snow .ql-picker.ql-spacing .ql-picker-item[data-value="longgar"]::before { content: '🔴 Longgar'; }
        .ql-picker.ql-spacing .ql-picker-item::before { content: '⚪ Default'; }

        /* === Biarkan spacing kelihatan di dalam editor === */
        .ql-editor p.ql-spacing-rapat { margin-bottom: 0.35rem !important; }
        .ql-editor p.ql-spacing-normal { margin-bottom: 0.75rem !important; }
        .ql-editor p.ql-spacing-longgar { margin-bottom: 1.5rem !important; }
    </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-black text-2xl text-emerald-950 leading-tight">
            {{ __('Edit Halaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2.5rem] border border-white/50 p-8">
                <form action="{{ route('admin.pages.update', $page) }}" method="POST" id="page-form">
                    @csrf @method('PUT')
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Judul</label>
                            <input type="text" name="title" id="title" required value="{{ old('title', $page->title) }}" readonly class="w-full px-4 py-3 bg-gray-100 text-gray-500 border border-gray-200 rounded-xl cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Slug</label>
                            <input type="text" name="slug" id="slug" required value="{{ old('slug', $page->slug) }}" readonly class="w-full px-4 py-3 bg-gray-100 text-gray-500 border border-gray-200 rounded-xl font-mono text-sm cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Konten</label>
                            <div id="editor-container"></div>
                            <textarea name="content" id="content" class="hidden">{{ old('content', $page->content) }}</textarea>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-blot-formatter@1.0.5/dist/quill-blot-formatter.min.js"></script>
    <script>
        Quill.register('modules/blotFormatter', QuillBlotFormatter.default);

        // Register custom Spasi (line spacing) format
        var Parchment = Quill.import('parchment');
        var SpacingStyle = new Parchment.Attributor.Class('spacing', 'ql-spacing', {
            scope: Parchment.Scope.BLOCK,
            whitelist: ['rapat', 'normal', 'longgar']
        });
        Quill.register('formats/spacing', SpacingStyle, true);

        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                blotFormatter: {},
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'align': [] }],
                        [{ 'spacing': [false, 'rapat', 'normal', 'longgar'] }],
                        ['link', 'image'],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler,
                        spacing: function(value) {
                            var range = quill.getSelection();
                            if (!range) return;
                            // Ambil seluruh baris/paragraf yang kena selection, lalu format semuanya
                            var lines = quill.getLines(range.index, range.length);
                            lines.forEach(function(line) {
                                var lineRange = quill.getIndex(line);
                                quill.formatText(lineRange, line.length(), 'spacing', value || false);
                            });
                        }
                    }
                }
            }
        });

        var contentInput = document.getElementById('content');
        if (contentInput.value) {
            quill.root.innerHTML = contentInput.value;
        }

        function imageHandler() {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = () => {
                var file = input.files[0];
                if (file) {
                    var formData = new FormData();
                    formData.append('image', file);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route("admin.pages.uploadImage") }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            let range = quill.getSelection(true);
                            quill.insertEmbed(range.index, 'image', result.url);
                        } else {
                            alert('Gagal mengunggah gambar');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal mengunggah gambar');
                    });
                }
            };
        }

        document.getElementById('page-form').addEventListener('submit', function() {
            contentInput.value = quill.root.innerHTML;
        });
    </script>
    @endpush
</x-app-layout>
