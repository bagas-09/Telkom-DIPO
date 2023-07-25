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
                'nama_status' => 'MENUGGU PELIMPAHAN',
            ],
            [
                'nama_status' => 'Surat Pesanan',
            ],
            [
                'nama_status' => 'BAUT',
            ],
            [
                'nama_status' => 'BAR',
            ],
            [
                'nama_status' => 'BAST',
            ],
            [
                'nama_status' => 'INPUT MODEL SD',
            ],
            [
                'nama_status' => 'ABD VALID 4',
            ],
            [
                'nama_status' => 'INVOICE',
            ],
            [
                'nama_status' => 'PAYMENT EXCEEDED',
            ],
            [
                'nama_status' => 'CASH IN',
            ],
        ];
        foreach ($status as $s) {
            Status::create($s);
        }
    }
}
