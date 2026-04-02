<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donasi {{ $campaign->title }} - Musholla Al-Kautsar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 bg-[url('/images/pattern-light.svg')] bg-[length:20px_20px] bg-fixed">
    
    <!-- Top Alert Notification / Toast -->
    <div id="toast" class="fixed top-24 left-1/2 -translate-x-1/2 z-50 transform transition-all duration-300 opacity-0 -translate-y-10 pointer-events-none">
        <div class="bg-emerald-600 text-white px-6 py-3 rounded-full shadow-2xl shadow-emerald-900/30 flex items-center gap-3 font-bold border border-emerald-500/50">
            <svg class="w-5 h-5 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span id="toast-message">Menyambungkan ke pembayaran...</span>
        </div>
    </div>

    @include('partials.navbar', ['transparentTheme' => false])

    <main class="pt-32 pb-24 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto min-h-screen">
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="bg-amber-500 text-emerald-950 text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full inline-block mx-auto mb-4 shadow-lg">Langkah Kebaikan Anda</div>
            <h1 class="text-4xl md:text-5xl font-black text-emerald-950 tracking-tight mb-4">Donasi: {{ $campaign->title }}</h1>
            <p class="text-gray-600 text-lg">{{ $campaign->description ?? 'Bantu wujudkan program kebaikan ini. Setiap rupiah yang Anda sumbangkan adalah tabungan akhirat yang mengalir abadi.' }}</p>
        </div>

        <div class="bg-white/90 backdrop-blur-md rounded-[2.5rem] shadow-2xl p-8 md:p-12 border border-emerald-100">
            <form id="donation-form" onsubmit="event.preventDefault(); submitDonation();">
                @csrf
                
                <!-- Nominal Section -->
                <div class="mb-8 relative">
                    <label class="block text-emerald-950 font-bold mb-4">Pilih Nominal Donasi <span class="text-red-500">*</span></label>
                    
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <button type="button" onclick="setNominal(50000, this)" class="preset-btn py-4 rounded-2xl border-2 border-emerald-100 font-bold text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300 transition-all text-lg">50k</button>
                        <button type="button" onclick="setNominal(100000, this)" class="preset-btn py-4 rounded-2xl border-2 border-emerald-100 font-bold text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300 transition-all text-lg">100k</button>
                        <button type="button" onclick="setNominal(500000, this)" class="preset-btn py-4 rounded-2xl border-2 border-emerald-100 font-bold text-emerald-700 hover:bg-emerald-50 hover:border-emerald-300 transition-all text-lg">500k</button>
                    </div>

                    <div class="relative flex items-center">
                        <span class="absolute left-6 text-xl text-gray-400 font-bold">Rp</span>
                        <input type="number" id="amount" name="amount" required min="10000" class="w-full pl-16 pr-6 py-5 rounded-2xl border border-gray-200 text-2xl font-black text-emerald-950 shadow-inner focus:border-emerald-400 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-all placeholder:text-gray-300 placeholder:font-normal" placeholder="0" oninput="clearPresetActive()">
                    </div>
                </div>

                <!-- Personal Info -->
                <div class="mb-8 p-6 bg-gray-50 rounded-3xl border border-gray-100">
                    <label class="block text-emerald-950 font-bold mb-4">Informasi Donatur</label>
                    <div class="space-y-4">
                        <div>
                            <input type="text" id="donator_name" name="donator_name" required class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all placeholder:text-gray-400 font-medium" placeholder="Nama Lengkap (Contoh: Hamba Allah)">
                        </div>
                        <div>
                            <input type="email" id="email" name="email" required class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all placeholder:text-gray-400 font-medium" placeholder="Alamat Email (Wajib untuk mengirim tanda terima)">
                        </div>
                    </div>
                </div>

                <!-- Manual Upload Section -->
                <div id="manual-section" class="mb-10 p-8 rounded-3xl border-2 border-dashed border-emerald-200 bg-emerald-50/30 hover:bg-emerald-50 transition-colors">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4 text-emerald-600 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h4 class="font-bold text-emerald-950 text-xl mb-1">Transfer Bank Mandiri</h4>
                        <p class="text-gray-600 mb-6 tracking-wider font-mono bg-white inline-block px-5 py-3 rounded-xl border border-gray-200 shadow-sm text-lg">137-00-1234567-8 <br><span class="text-xs font-sans text-gray-400 uppercase tracking-normal">a/n Musholla Al-Kautsar</span></p>
                        
                        <div class="relative mt-2">
                            <input type="file" id="proof" name="proof" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(event)">
                            <div class="py-4 px-6 bg-white border border-gray-200 rounded-2xl flex items-center justify-center gap-3 font-bold text-emerald-700 shadow-sm pointer-events-none" id="upload-btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Upload Bukti Transfer <span class="text-red-500">*</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-4 px-8" id="upload-text">Format Gambar JPG/PNG. Maksimal 2MB.</p>
                        
                        <div id="image-preview-container" class="hidden mt-6 relative">
                            <img id="image-preview" src="#" alt="Preview" class="w-full h-48 object-cover rounded-2xl shadow-lg border-2 border-emerald-100">
                            <button type="button" onclick="cancelUpload()" class="absolute -top-3 -right-3 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white shadow-lg font-bold hover:scale-110 transition-transform">×</button>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submit-btn" class="w-full py-5 rounded-[1.5rem] bg-amber-500 hover:bg-amber-400 text-emerald-950 font-black text-xl shadow-xl shadow-amber-500/20 hover:shadow-amber-500/40 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-2">
                    Kirim Konfirmasi Donasi
                    <svg class="w-6 h-6 outline-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </form>
        </div>
    </main>

    <script>
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').innerText = message;
            
            if(isError) {
                toast.firstElementChild.classList.remove('bg-emerald-600', 'border-emerald-500/50');
                toast.firstElementChild.classList.add('bg-red-600', 'border-red-500/50');
            } else {
                toast.firstElementChild.classList.remove('bg-red-600', 'border-red-500/50');
                toast.firstElementChild.classList.add('bg-emerald-600', 'border-emerald-500/50');
            }

            toast.classList.remove('opacity-0', '-translate-y-10');
            toast.classList.add('opacity-100', 'translate-y-0');
            
            setTimeout(() => {
                toast.classList.add('opacity-0', '-translate-y-10');
                toast.classList.remove('opacity-100', 'translate-y-0');
            }, 3500);
        }

        function clearPresetActive() {
            document.querySelectorAll('.preset-btn').forEach(btn => {
                btn.classList.remove('bg-emerald-500', 'text-white', 'border-emerald-500');
                btn.classList.add('bg-transparent', 'text-emerald-700', 'border-emerald-100');
            });
        }

        function setNominal(amount, btn) {
            document.getElementById('amount').value = amount;
            clearPresetActive();
            btn.classList.remove('bg-transparent', 'text-emerald-700', 'border-emerald-100');
            btn.classList.add('bg-emerald-500', 'text-white', 'border-emerald-500');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                if(file.size > 2048000) {
                    showToast('Ukuran file maksimal 2MB!', true);
                    cancelUpload();
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                    document.getElementById('image-preview-container').classList.remove('hidden');
                    document.getElementById('upload-btn').innerHTML = "Ganti Foto Bukti";
                }
                reader.readAsDataURL(file);
            }
        }

        function cancelUpload() {
            document.getElementById('proof').value = "";
            document.getElementById('image-preview-container').classList.add('hidden');
            document.getElementById('upload-btn').innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg> Upload Bukti Transfer <span class="text-red-500">*</span>`;
        }

        async function submitDonation() {
            const btn = document.getElementById('submit-btn');
            const originalText = btn.innerHTML;
            
            const proofFile = document.getElementById('proof').files[0];
            if(!proofFile) {
                showToast('Mohon unggah bukti transfer gambar!', true);
                return;
            }

            btn.disabled = true;
            btn.classList.add('opacity-50', 'scale-95');
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-emerald-950 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;

            const formData = new FormData();
            formData.append('amount', document.getElementById('amount').value);
            formData.append('donator_name', document.getElementById('donator_name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('proof', proofFile);

            try {
                const response = await fetch("{{ route('api.donasi.manual', $campaign) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                });

                const data = await response.json();

                if(response.ok && data.success) {
                    showToast('Berhasil upload, admin akan memverifikasi dalam 1x24 jam!');
                    setTimeout(() => window.location.href = "{{ route('campaigns.index') }}", 4000);
                } else {
                    showToast(data.message || 'Gagal mengunggah foto.', true);
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                    btn.classList.remove('opacity-50', 'scale-95');
                }
            } catch(err) {
                showToast('Gagal menghubungi server.', true);
                btn.disabled = false;
                btn.innerHTML = originalText;
                btn.classList.remove('opacity-50', 'scale-95');
            }
        }
    </script>
    @include('partials.footer')
</body>
</html>
