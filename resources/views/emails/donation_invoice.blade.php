<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Donasi</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; margin: 0; padding: 0; }
        .container { max-w: 600px; margin: 0 auto; background-color: #ffffff; padding: 40px; border-radius: 16px; margin-top: 40px; margin-bottom: 40px; border: 1px solid #e5e7eb; }
        h1 { color: #022c22; font-size: 24px; margin-bottom: 10px; }
        p { color: #4b5563; line-height: 1.6; font-size: 16px; margin-top: 0; }
        .invoice-box { background-color: #ecfdf5; border: 1px solid #d1fae5; padding: 24px; border-radius: 12px; margin-top: 30px; margin-bottom: 30px; }
        .amount { font-size: 32px; font-weight: bold; color: #047857; margin: 10px 0; }
        .details-table { w-full; border-collapse: collapse; margin-top: 20px; }
        .details-table td { padding: 12px 0; border-bottom: 1px solid #d1fae5; color: #065f46; font-size: 15px; }
        .details-table td:first-child { font-weight: bold; width: 40%; }
        .details-table tr:last-child td { border-bottom: none; }
        .footer { text-align: center; color: #9ca3af; font-size: 14px; margin-top: 40px; padding-top: 20px; border-top: 1px solid #f3f4f6; }
        .status-badge { display: inline-block; background-color: #10b981; color: white; font-size: 12px; font-weight: bold; padding: 4px 12px; border-radius: 100px; text-transform: uppercase; letter-spacing: 1px; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <div style="text-align: center; margin-bottom: 30px;">
            <div style="background-color: #f59e0b; color: #022c22; font-weight: bold; padding: 8px 16px; display: inline-block; border-radius: 20px; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Musholla Al-Kautsar</div>
        </div>
        
        <h1>Jazakallah Khair, {{ $donation->donator_name }}!</h1>
        <p>Dana infaq/shodaqoh yang Anda sampaikan telah berhasil kami terima dan akan sepenuhnya disalurkan untuk kepentingan rumah Allah.</p>

        <div class="invoice-box">
            <div class="status-badge">✔ PEMBAYARAN BERHASIL</div>
            <div class="amount">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
            
            <table class="details-table" style="width: 100%;">
                <tr>
                    <td>No. Tanda Terima</td>
                    <td>{{ $donation->order_id }}</td>
                </tr>
                <tr>
                    <td>Tujuan Donasi</td>
                    <td>{{ $donation->campaign ? $donation->campaign->title : 'Donasi Umum' }}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>Transfer Manual Terverifikasi</td>
                </tr>
                <tr>
                    <td>Waktu Verifikasi</td>
                    <td>{{ now()->format('d F Y, H:i') }} WIB</td>
                </tr>
            </table>
        </div>

        <p>Semoga Allah subhanahu wa ta'ala menerima amal jariyah Anda, memberkahi harta dan keluarga Anda, serta menjadikannya tabungan tak terputus di akhirat kelak.</p>
        <p>Amin Ya Rabbal Alamin.</p>

        <div class="footer">
            Surat ini adalah bukti penerimaan donasi resmi yang diterbitkan oleh sistem Musholla Al-Kautsar.<br>
            Tidak perlu membalas email ini.
        </div>
    </div>
</body>
</html>
