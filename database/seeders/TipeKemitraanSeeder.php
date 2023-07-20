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
                'nama_tipe_kemitraan' => 'turnkey',
                "role" => "Konstruksi"
            ],
            [
                'id' => 2,
                'nama_tipe_kemitraan' => 'jasa only',
                "role" => "Konstruksi"
            ],
            [
                'id' => 3,
                'nama_tipe_kemitraan' => 'selected material',
                "role" => "Konstruksi"
            ],
        ];

        foreach ($tipe_kemitraan as $tipe) {
            TipeKemitraan::create($tipe);
        }
    }
}
