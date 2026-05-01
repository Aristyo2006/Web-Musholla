<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Ahmad Fauzi',
                'role' => 'Donatur Tetap',
                'content' => 'Semoga musholla ini selalu ramai jamaah dan berkah bagi lingkungan sekitar.',
                'is_active' => true,
            ],
            [
                'name' => 'Siti Aminah',
                'role' => 'Jamaah',
                'content' => 'Alhamdulillah, fasilitasnya makin bagus dan nyaman buat ibadah.',
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso',
                'role' => 'Warga Sekitar',
                'content' => 'Sangat terbantu dengan adanya program donasi yang transparan seperti ini.',
                'is_active' => true,
            ],
            [
                'name' => 'Lutfi Hakim',
                'role' => 'Relawan',
                'content' => 'Senang bisa berkontribusi langsung. Musholla Al-Kautsar benar-benar amanah.',
                'is_active' => true,
            ],
            [
                'name' => 'Maria Ulfa',
                'role' => 'Donatur',
                'content' => 'Situsnya memudahkan saya untuk ikut berdonasi kapanpun.',
                'is_active' => true,
            ],
        ];

        foreach ($data as $item) {
            Testimonial::create($item);
        }
    }
}
