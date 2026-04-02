<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Donation::create([
            'donator_name' => 'Hamba Allah',
            'amount' => 1000000,
            'notes' => 'Sedekah jariyah keluarga',
            'status' => 'confirmed',
        ]);

        \App\Models\Donation::create([
            'donator_name' => 'Bpk. Ahmad Sujiwo',
            'amount' => 5000000,
            'notes' => 'Untuk semen dan pasir',
            'status' => 'confirmed',
        ]);

        \App\Models\Donation::create([
            'donator_name' => 'Ibu Siti Aminah',
            'amount' => 750000,
            'notes' => 'Semoga berkah',
            'status' => 'confirmed',
        ]);
    }
}
