<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Article::create([
            'title' => 'Pembangunan Musholla Tahap 1 Selesai',
            'slug' => 'pembangunan-musholla-tahap-1-selesai',
            'content' => 'Alhamdulillah, progres pembangunan musholla tahap pondasi dan tiang penyangga telah selesai dilakukan. Terima kasih kepada seluruh donatur yang telah memberikan sumbangan terbaiknya.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        \App\Models\Article::create([
            'title' => 'Santunan Anak Yatim Ramadhan 1447H',
            'slug' => 'santunan-anak-yatim-ramadhan-1447h',
            'content' => 'Musholla kita akan mengadakan santunan anak yatim di akhir bulan Ramadhan nanti. Mari kita berpartisipasi untuk menyukseskan acara ini.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        \App\Models\Article::create([
            'title' => 'Kajian Rutin Setiap Malam Jumat',
            'slug' => 'kajian-rutin-malam-jumat',
            'content' => 'Informasi bagi seluruh jamaah, musholla kita mengadakan kajian rutin setiap malam Jumat ba\'da Maghrib. Terbuka untuk umum.',
            'is_published' => true,
            'published_at' => now(),
        ]);
    }
}
