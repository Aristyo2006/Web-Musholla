<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestMail extends Command
{
    protected $signature = 'mail:test {email : Alamat email tujuan}';
    protected $description = 'Kirim test email untuk verifikasi koneksi SMTP';

    public function handle()
    {
        $to = $this->argument('email');

        $this->info("Mengirim test email ke: {$to}");
        $this->info("Host: " . config('mail.mailers.smtp.host'));
        $this->info("Port: " . config('mail.mailers.smtp.port'));
        $this->info("From: " . config('mail.from.address'));

        try {
            Mail::raw('Halo! Ini adalah test email dari sistem donasi Yayasan Al-Kautsar. Jika Anda menerima email ini, berarti konfigurasi SMTP sudah benar.', function ($message) use ($to) {
                $message->to($to)->subject('✅ Test Koneksi SMTP — Yayasan Al-Kautsar');
            });

            $this->info('');
            $this->info('✅ Email berhasil dikirim! Cek inbox ' . $to);
        } catch (\Exception $e) {
            $this->error('');
            $this->error('❌ Gagal kirim email!');
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
