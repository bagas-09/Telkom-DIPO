<?php

namespace Database\Seeders;

use App\Models\StatusTagihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusTagihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status_tagihan = [
            [
                'nama_status_tagihan' => 'OGP',
            ],
            [
                'nama_status_tagihan' => 'PROSES E-RECON',
            ],
            [
                'nama_status_tagihan' => 'PROSES REKON PEKERJAAN',
            ],
            [
                'nama_status_tagihan' => 'VERIFIKASI DOKUMEN',
            ],
            [
                'nama_status_tagihan' => 'PAYMENT ENTRY',
            ],
            [
                'nama_status_tagihan' => 'CASH & BANK',
            ],
        ];
        foreach ($status_tagihan as $sT) {
            StatusTagihan::create($sT);
        }
    }
}
