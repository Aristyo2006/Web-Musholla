<x-app-layout>
    @push('styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .ql-container.ql-snow { min-height: 400px; font-family: 'Outfit', sans-serif; font-size: 1.1rem; }
    </style>
    @endpush

    <x-slot name="header">
        <h2 class="font-black text-2xl text-emerald-950 leading-tight">
            {{ __('Tambah Halaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-[2.5rem] border border-white/50 p-8">
                <form action="{{ route('admin.pages.store') }}" method="POST" id="page-form">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Judul</label>
                            <input type="text" name="title" id="title" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Slug</label>
                            <input type="text" name="slug" id="slug" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl font-mono text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase">Konten</label>
                            <div id="editor-container"></div>
                            <textarea name="content" id="content" class="hidden"></textarea>
                        </div>
                        <div class="flex justify-end pt-4">
                            <button type="submit" class="px-8 py-3 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        document.getElementById('title').addEventListener('input', function() {
            let slug = this.value.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
            document.getElementById('slug').value = slug;
        });

        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: {
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image'],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

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
            document.getElementById('content').value = quill.root.innerHTML;
        });
    </script>
    @endpush
</x-app-layout>
