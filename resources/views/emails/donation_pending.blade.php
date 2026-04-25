<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Diterima - Menunggu Konfirmasi</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f0fdf4; color: #1f2937; }
        .wrapper { padding: 40px 20px; }
        .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #d1fae5; box-shadow: 0 4px 24px rgba(16,185,129,0.08); }
        .header { background: linear-gradient(135deg, #064e3b, #047857); padding: 40px 40px 32px; text-align: center; }
        .logo-badge { display: inline-block; background-color: #f59e0b; color: #022c22; font-weight: 900; padding: 6px 18px; border-radius: 100px; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; }
        .header h1 { color: #ffffff; font-size: 26px; font-weight: 800; line-height: 1.3; }
        .body { padding: 36px 40px; }
        .greeting { font-size: 18px; font-weight: 700; color: #065f46; margin-bottom: 16px; }
        .text { font-size: 15px; color: #4b5563; line-height: 1.7; margin-bottom: 16px; }
        .status-box { background: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 20px 24px; margin: 28px 0; display: flex; align-items: flex-start; gap: 14px; }
        .status-icon { font-size: 24px; flex-shrink: 0; }
        .status-title { font-size: 13px; font-weight: 800; color: #92400e; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .status-desc { font-size: 14px; color: #78350f; line-height: 1.6; }
        .detail-box { background: #f0fdf4; border: 1px solid #d1fae5; border-radius: 14px; padding: 24px; margin: 24px 0; }
        .detail-title { font-size: 11px; font-weight: 900; color: #6b7280; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #d1fae5; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 13px; color: #6b7280; font-weight: 600; }
        .detail-value { font-size: 14px; color: #065f46; font-weight: 700; text-align: right; }
        .amount-value { font-size: 22px; color: #047857; font-weight: 900; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 28px 0; }
        .closing { font-size: 15px; color: #4b5563; line-height: 1.7; }
        .closing strong { color: #065f46; }
        .footer { background: #f9fafb; padding: 24px 40px; text-align: center; border-top: 1px solid #f3f4f6; }
        .footer p { font-size: 12px; color: #9ca3af; line-height: 1.6; }
        .footer strong { color: #6b7280; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <!-- Header -->
            <div class="header">
                <div class="logo-badge">Yayasan Al-Kautsar</div>
                <h1>Donasi Anda Telah Kami Terima 🙏</h1>
            </div>

            <!-- Body -->
            <div class="body">
                <p class="greeting">Assalamu'alaikum, {{ $donation->donator_name }}!</p>
                <p class="text">
                    Terima kasih atas kepercayaan dan kebaikan hati Anda. Donasi Anda untuk program
                    <strong>{{ $donation->campaign ? $donation->campaign->title : 'Yayasan Al-Kautsar' }}</strong>
                    telah berhasil kami terima dan saat ini sedang menunggu verifikasi dari tim admin kami.
                </p>

                <!-- Status Alert -->
                <div class="status-box">
                    <div class="status-icon">⏳</div>
                    <div>
                        <div class="status-title">Menunggu Konfirmasi Admin</div>
                        <div class="status-desc">
                            Tim kami sedang memproses donasi Anda. Anda akan mendapatkan email konfirmasi
                            setelah donasi berhasil diverifikasi, biasanya dalam waktu <strong>1×24 jam</strong>.
                        </div>
                    </div>
                </div>

                <!-- Detail Donasi -->
                <div class="detail-box">
                    <div class="detail-title">📋 Detail Donasi</div>
                    <div class="detail-row">
                        <span class="detail-label">No. Referensi</span>
                        <span class="detail-value">{{ $donation->order_id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nama Donatur</span>
                        <span class="detail-value">{{ $donation->donator_name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tujuan Program</span>
                        <span class="detail-value">{{ $donation->campaign ? $donation->campaign->title : 'Donasi Umum' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Metode Pembayaran</span>
                        <span class="detail-value">Transfer Manual</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Tanggal Pengiriman</span>
                        <span class="detail-value">{{ $donation->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nominal Donasi</span>
                        <span class="detail-value amount-value">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <hr class="divider">

                <p class="closing">
                    Semoga Allah subhanahu wa ta'ala menerima dan melipatgandakan pahala amal jariyah Anda.
                    Jika ada pertanyaan, silakan balas email ini atau hubungi kami langsung.<br><br>
                    Jazākallāhu Khayran,<br>
                    <strong>Tim Yayasan Al-Kautsar</strong>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>
                    Email ini dikirim secara otomatis oleh sistem donasi <strong>Yayasan Al-Kautsar</strong>.<br>
                    © {{ date('Y') }} Yayasan Al-Kautsar — admin@yysalkautsar.or.id
                </p>
            </div>
        </div>
    </div>
</body>
</html>
