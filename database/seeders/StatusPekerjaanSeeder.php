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
                'nama_status_pekerjaan' => 'Dispatch Mitra',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 2,
                'nama_status_pekerjaan' => 'Perijinan',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 3,
                'nama_status_pekerjaan' => 'Aanweedjing',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 4,
                'nama_status_pekerjaan' => 'Bon Material',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 5,
                'nama_status_pekerjaan' => 'Penanaman Tiang',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 6,
                'nama_status_pekerjaan' => 'Penarikan',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 7,
                'nama_status_pekerjaan' => 'Dispatch Mitra',
                'role' => 'Maintenance'
            ],
            [
                'id' => 8,
                'nama_status_pekerjaan' => 'Perijinan',
                'role' => 'Maintenance'
            ],
            [
                'id' => 9,
                'nama_status_pekerjaan' => 'Aanweedjing',
                'role' => 'Maintenance'
            ],
            [
                'id' => 10,
                'nama_status_pekerjaan' => 'Bon Material',
                'role' => 'Maintenance'
            ],
            [
                'id' => 11,
                'nama_status_pekerjaan' => 'Penanaman Tiang',
                'role' => 'Maintenance'
            ],
            [
                'id' => 12,
                'nama_status_pekerjaan' => 'Penarikan',
                'role' => 'Maintenance'
            ],
        ];

        foreach ($statuspekerjaan as $pekerjaan) {
            StatusPekerjaan::create($pekerjaan);
        }
    }
}
