<?php

namespace Database\Seeders;

use App\Models\LaporanKonstruksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanKonstruksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laporan = [
            [
                'PID_konstruksi' => "R04-123456",
                'ID_SAP_konstruksi' => "R04-323456",
                'NO_PR_konstruksi' => "R04-1123156",
                'tanggal_PR' => "2023-07-07",
                'status_pekerjaan_id' => 1,
                'mitra_id' => 1,
                'tipe_kemitraan_id' => 1,
                'jenis_order_id' => 1,
                'tipe_provisioning_id' => 1,
                'lokasi' => "Semarang",
                'material_DRM' => 100,
                'jasa_DRM' => 200,
                'total_DRM' => 300,
                'material_aktual' => 200,
                'jasa_aktual' => 300,
                'total_aktual' => 500,
                'keterangan' => "testing",
                'kota_id' => 1
            ],

        ];

        foreach ($laporan as $laporankonstruksi) {
            LaporanKonstruksi::create($laporankonstruksi);
        }
    }
}
