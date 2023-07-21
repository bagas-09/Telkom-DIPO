<?php

namespace Database\Seeders;

use App\Models\TipeKemitraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeKemitraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipe_kemitraan = [
            [
                'id' => 1,
                'nama_tipe_kemitraan' => 'Turnkey',
                "role" => "Konstruksi"
            ],
            [
                'id' => 2,
                'nama_tipe_kemitraan' => 'Jasa Only',
                "role" => "Konstruksi"
            ],
            [
                'id' => 3,
                'nama_tipe_kemitraan' => 'Selected Material',
                "role" => "Konstruksi"
            ],
            [
                'id' => 4,
                'nama_tipe_kemitraan' => 'Turnkey',
                "role" => "Maintenance"
            ],
            [
                'id' => 5,
                'nama_tipe_kemitraan' => 'Jasa Only',
                "role" => "Maintenance"
            ],
            [
                'id' => 6,
                'nama_tipe_kemitraan' => 'Selected Material',
                "role" => "Maintenance"
            ],
        ];

        foreach ($tipe_kemitraan as $tipe) {
            TipeKemitraan::create($tipe);
        }
    }
}
