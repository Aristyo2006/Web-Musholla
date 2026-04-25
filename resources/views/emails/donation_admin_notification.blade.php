<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Donasi Baru</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1f2937; }
        .wrapper { padding: 40px 20px; }
        .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #e5e7eb; box-shadow: 0 4px 24px rgba(0,0,0,0.06); }
        .header { background: linear-gradient(135deg, #1e3a5f, #1d4ed8); padding: 36px 40px; text-align: center; }
        .system-badge { display: inline-block; background-color: #fbbf24; color: #1e3a5f; font-weight: 900; padding: 6px 16px; border-radius: 100px; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; }
        .header h1 { color: #ffffff; font-size: 24px; font-weight: 800; }
        .header p { color: rgba(255,255,255,0.7); font-size: 14px; margin-top: 8px; }
        .body { padding: 36px 40px; }
        .alert-box { background: #eff6ff; border: 1px solid #bfdbfe; border-left: 4px solid #3b82f6; border-radius: 10px; padding: 16px 20px; margin-bottom: 28px; }
        .alert-box p { font-size: 14px; color: #1e40af; line-height: 1.6; }
        .text { font-size: 15px; color: #4b5563; line-height: 1.7; margin-bottom: 16px; }
        .detail-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 24px; margin: 24px 0; }
        .detail-title { font-size: 11px; font-weight: 900; color: #6b7280; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 13px; color: #9ca3af; font-weight: 600; }
        .detail-value { font-size: 14px; color: #111827; font-weight: 700; text-align: right; }
        .amount-value { font-size: 22px; color: #059669; font-weight: 900; }
        .cta-area { text-align: center; margin: 32px 0; }
        .cta-btn { display: inline-block; background: linear-gradient(135deg, #059669, #047857); color: #ffffff; text-decoration: none; font-weight: 900; font-size: 14px; padding: 16px 40px; border-radius: 100px; letter-spacing: 1px; text-transform: uppercase; }
        .cta-url { margin-top: 12px; font-size: 12px; color: #9ca3af; word-break: break-all; }
        .divider { border: none; border-top: 1px solid #f3f4f6; margin: 28px 0; }
        .footer { background: #f9fafb; padding: 24px 40px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { font-size: 12px; color: #9ca3af; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <!-- Header -->
            <div class="header">
                <div class="system-badge">🔔 Notifikasi Sistem</div>
                <h1>Ada Donasi Baru Masuk!</h1>
                <p>Yayasan Al-Kautsar — Sistem Manajemen Donasi</p>
            </div>

            <!-- Body -->
            <div class="body">
                <div class="alert-box">
                    <p>
                        <strong>Tindakan diperlukan:</strong> Seorang donatur baru telah mengirimkan bukti transfer.
                        Silakan periksa dan lakukan konfirmasi melalui dashboard admin.
                    </p>
                </div>

                <!-- Detail Donatur -->
                <div class="detail-box">
                    <div class="detail-title">👤 Informasi Donatur</div>
                    <div class="detail-row">
                        <span class="detail-label">Nama</span>
                        <span class="detail-value">{{ $donation->donator_name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $donation->email ?? '— (tidak diisi)' }}</span>
                    </div>
                    @if($donation->donator_address)
                    <div class="detail-row">
                        <span class="detail-label">Alamat</span>
                        <span class="detail-value">{{ $donation->donator_address }}</span>
                    </div>
                    @endif
                    @if($donation->notes)
                    <div class="detail-row">
                        <span class="detail-label">Pesan</span>
                        <span class="detail-value">{{ $donation->notes }}</span>
                    </div>
                    @endif
                </div>

                <!-- Detail Donasi -->
                <div class="detail-box">
                    <div class="detail-title">💰 Detail Donasi</div>
                    <div class="detail-row">
                        <span class="detail-label">No. Referensi</span>
                        <span class="detail-value">{{ $donation->order_id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Program / Kampanye</span>
                        <span class="detail-value">{{ $donation->campaign ? $donation->campaign->title : 'Donasi Umum' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Metode</span>
                        <span class="detail-value">Transfer Manual</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Masuk</span>
                        <span class="detail-value">{{ $donation->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nominal</span>
                        <span class="detail-value amount-value">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <hr class="divider">

                <!-- CTA -->
                <div class="cta-area">
                    <p class="text" style="margin-bottom: 20px;">Klik tombol di bawah untuk membuka dashboard admin dan melakukan konfirmasi:</p>
                    <a href="{{ route('admin.donations.index') }}" class="cta-btn">
                        Buka Dashboard Admin
                    </a>
                    <p class="cta-url">{{ route('admin.donations.index') }}</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>
                    Email ini dikirim otomatis oleh sistem donasi <strong>Yayasan Al-Kautsar</strong>.<br>
                    Jangan balas email ini secara langsung.<br>
                    © {{ date('Y') }} Yayasan Al-Kautsar — admin@yysalkautsar.or.id
                </p>
            </div>
        </div>
    </div>
</body>
</html>
