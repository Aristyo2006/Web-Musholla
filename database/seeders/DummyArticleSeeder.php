<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyArticleSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) return;

        $articles = [
            [
                'title' => 'Penyelesaian Pengecoran Atap Tahap Pertama',
                'content' => '<p>Alhamdulillah, proses pengecoran atap tahap pertama telah selesai dilaksanakan dengan lancar. Terima kasih kepada seluruh donatur.</p>',
            ],
            [
                'title' => 'Kegiatan Santunan Anak Yatim Rutin',
                'content' => '<p>Musholla Al-Kautsar kembali mengadakan kegiatan santunan anak yatim untuk wilayah sekitar. Semoga menjadi berkah.</p>',
            ],
            [
                'title' => 'Rencana Perluasan Area Parkir',
                'content' => '<p>Kami merencanakan perluasan area parkir untuk kenyamanan jamaah saat shalat Jumat dan pengajian rutin.</p>',
            ],
            [
                'title' => 'Jadwal Pengajian Rutin Malam Jumat',
                'content' => '<p>Mari bergabung dalam pengajian rutin setiap malam Jumat di Musholla Al-Kautsar. Kajian kitab kuning dan dzikir bersama.</p>',
            ],
            [
                'title' => 'Laporan Keuangan Donasi Musholla April 2026',
                'content' => '<p>Berikut adalah transparansi laporan keuangan donasi musholla untuk bulan April 2026. Semua dana telah dialokasikan sesuai kebutuhan.</p>',
            ],
        ];

        foreach ($articles as $data) {
            Article::create([
                'user_id' => $user->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'content' => $data['content'],
                'is_published' => true,
                'published_at' => now(),
            ]);
        }
    }
}
