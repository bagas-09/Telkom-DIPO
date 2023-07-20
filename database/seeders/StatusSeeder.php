<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'id' => 1,
                'nama_status' => 'Surat Pesanan',
            ],
            [
                'id' => 2,
                'nama_status' => 'BAUT',
            ],
            [
                'nama_status' => 'MENUGGU PELIMPAHAN',
            ],
            [
                'nama_status' => 'BAST',
            ],
            [
                'nama_status' => 'INPUT MODEL SD',
            ],
        ];
        foreach ($status as $s) {
            Status::create($s);
        }
    }
}
