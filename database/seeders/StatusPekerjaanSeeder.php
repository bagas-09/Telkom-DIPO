<?php

namespace Database\Seeders;

use App\Models\StatusPekerjaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPekerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuspekerjaan = [
            [
                'id' => 1,
                'nama_status_pekerjaan' => 'dispatch mitra',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 2,
                'nama_status_pekerjaan' => 'perijinan',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 3,
                'nama_status_pekerjaan' => 'aanweedjing',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 4,
                'nama_status_pekerjaan' => 'bon material',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 5,
                'nama_status_pekerjaan' => 'penanaman tiang',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 6,
                'nama_status_pekerjaan' => 'penarikan',
                'role' => 'Konstruksi'
            ],
        ];

        foreach ($statuspekerjaan as $pekerjaan) {
            StatusPekerjaan::create($pekerjaan);
        }
    }
}
