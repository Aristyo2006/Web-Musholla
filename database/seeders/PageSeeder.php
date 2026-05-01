<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::updateOrCreate(
            ['slug' => 'tentang-kami'],
            [
                'title' => 'Tentang Kami',
                'content' => '
                    <h2>Membangun Kebaikan, Mempererat Ukhuwah</h2>
                    <p>Musholla Al-Kautsar bukan sekadar tempat ibadah, melainkan rumah bagi jamaah untuk bertumbuh bersama dalam iman dan kepedulian sosial.</p>
                    
                    <h3>Visi Kami</h3>
                    <p>Menjadi pusat kegiatan keagamaan yang mandiri, inklusif, dan memberikan manfaat luas bagi masyarakat di sekitar Taman Jimbaran.</p>
                    
                    <h3>Misi Kami</h3>
                    <ul>
                        <li>Menyelenggarakan ibadah shalat berjamaah yang nyaman.</li>
                        <li>Mengembangkan pendidikan Al-Qur\'an untuk anak-anak (TPA).</li>
                        <li>Mengelola dana donasi secara transparan dan amanah.</li>
                    </ul>

                    <h3>Sejarah Singkat</h3>
                    <p>Didirikan dengan semangat gotong royong oleh jamaah perumahan Taman Jimbaran, Musholla Al-Kautsar telah tumbuh menjadi titik kumpul bagi lebih dari 200 kepala keluarga. Melalui platform digital ini, kami berupaya mengajak lebih banyak dermawan untuk berkontribusi dalam renovasi dan pengembangan fasilitas Musholla.</p>
                    
                    <blockquote>"Harta tidak akan berkurang dengan sedekah. Dan Allah tidak menambah kepada seseorang hamba yang pemaaf melainkan kemuliaan." (HR. Muslim)</blockquote>
                ',
            ]
        );
    }
}
