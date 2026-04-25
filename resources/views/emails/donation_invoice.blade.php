<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Dikonfirmasi - Yayasan Al-Kautsar</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f0fdf4; color: #1f2937; }
        .wrapper { padding: 40px 20px; }
        .card { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 20px; overflow: hidden; border: 1px solid #d1fae5; box-shadow: 0 4px 24px rgba(16,185,129,0.08); }
        .header { background: linear-gradient(135deg, #064e3b, #047857); padding: 40px 40px 32px; text-align: center; }
        .logo-badge { display: inline-block; background-color: #f59e0b; color: #022c22; font-weight: 900; padding: 6px 18px; border-radius: 100px; font-size: 11px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px; }
        .header h1 { color: #ffffff; font-size: 26px; font-weight: 800; line-height: 1.3; }
        .header .checkmark { font-size: 48px; margin-bottom: 12px; display: block; }
        .body { padding: 36px 40px; }
        .greeting { font-size: 18px; font-weight: 700; color: #065f46; margin-bottom: 16px; }
        .text { font-size: 15px; color: #4b5563; line-height: 1.7; margin-bottom: 16px; }
        .confirmed-box { background: #ecfdf5; border: 1px solid #6ee7b7; border-radius: 14px; padding: 24px; margin: 28px 0; text-align: center; }
        .confirmed-label { font-size: 11px; font-weight: 900; color: #059669; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 10px; }
        .confirmed-amount { font-size: 38px; font-weight: 900; color: #047857; }
        .confirmed-campaign { font-size: 14px; color: #6b7280; margin-top: 8px; }
        .detail-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 24px; margin: 24px 0; }
        .detail-title { font-size: 11px; font-weight: 900; color: #6b7280; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 16px; }
        .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { font-size: 13px; color: #9ca3af; font-weight: 600; }
        .detail-value { font-size: 14px; color: #111827; font-weight: 700; text-align: right; }
        .doa-box { background: linear-gradient(135deg, #064e3b08, #04785708); border: 1px dashed #6ee7b7; border-radius: 14px; padding: 24px; margin: 28px 0; text-align: center; }
        .doa-text { font-size: 15px; color: #065f46; line-height: 1.8; font-style: italic; }
        .divider { border: none; border-top: 1px solid #e5e7eb; margin: 28px 0; }
        .closing { font-size: 15px; color: #4b5563; line-height: 1.7; }
        .closing strong { color: #065f46; }
        .footer { background: #f0fdf4; padding: 24px 40px; text-align: center; border-top: 1px solid #d1fae5; }
        .footer p { font-size: 12px; color: #9ca3af; line-height: 1.6; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">
            <!-- Header -->
            <div class="header">
                <div class="logo-badge">Yayasan Al-Kautsar</div>
                <span class="checkmark">✅</span>
                <h1>Donasi Telah Dikonfirmasi!</h1>
            </div>

            <!-- Body -->
            <div class="body">
                <p class="greeting">Assalamu'alaikum, {{ $donation->donator_name }}!</p>
                <p class="text">
                    Alhamdulillah, kami dengan bangga menyampaikan bahwa donasi Anda telah berhasil diverifikasi
                    dan dikonfirmasi oleh tim admin Yayasan Al-Kautsar. Berikut adalah tanda terima resmi Anda.
                </p>

                <!-- Confirmed Amount -->
                <div class="confirmed-box">
                    <div class="confirmed-label">✔ Donasi Dikonfirmasi</div>
                    <div class="confirmed-amount">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
                    <div class="confirmed-campaign">{{ $donation->campaign ? $donation->campaign->title : 'Donasi Umum' }}</div>
                </div>

                <!-- Detail Donasi -->
                <div class="detail-box">
                    <div class="detail-title">📋 Tanda Terima Resmi</div>
                    <div class="detail-row">
                        <span class="detail-label">No. Tanda Terima</span>
                        <span class="detail-value">{{ $donation->order_id }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nama Donatur</span>
                        <span class="detail-value">{{ $donation->donator_name }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Program / Kampanye</span>
                        <span class="detail-value">{{ $donation->campaign ? $donation->campaign->title : 'Donasi Umum' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Metode Pembayaran</span>
                        <span class="detail-value">Transfer Manual Terverifikasi</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Waktu Konfirmasi</span>
                        <span class="detail-value">{{ now()->format('d F Y, H:i') }} WIB</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Nominal Donasi</span>
                        <span class="detail-value" style="font-size:18px; color:#047857;">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Doa -->
                <div class="doa-box">
                    <p class="doa-text">
                        "Semoga Allah subhanahu wa ta'ala menerima amal jariyah Anda,<br>
                        memberkahi harta dan keluarga Anda, serta menjadikannya<br>
                        tabungan tak terputus di akhirat kelak."
                    </p>
                    <p style="margin-top: 12px; font-size: 14px; color: #059669; font-weight: 700;">Āmīn Yā Rabbal 'Ālamīn 🤲</p>
                </div>

                <hr class="divider">

                <p class="closing">
                    Jazākallāhu Khayran atas kepercayaan dan kebaikan hati Anda.<br>
                    Simpan email ini sebagai bukti resmi penerimaan donasi Anda.<br><br>
                    Wassalamu'alaikum Warahmatullahi Wabarakatuh,<br>
                    <strong>Tim Yayasan Al-Kautsar</strong>
                </p>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>
                    Surat ini adalah tanda terima resmi yang diterbitkan oleh sistem <strong>Yayasan Al-Kautsar</strong>.<br>
                    Tidak perlu membalas email ini — admin@yysalkautsar.or.id<br>
                    © {{ date('Y') }} Yayasan Al-Kautsar
                </p>
            </div>
        </div>
    </div>
</body>
</html>
