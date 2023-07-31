<?php

namespace Database\Seeders;

use App\Models\TipeProvisioning;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeProvisioningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provisioning = [
            [
                'id' => 1,
                'nama_tipe_provisioning' => 'PT2',
                "role" => "Konstruksi"
            ],
            [
                'id' => 2,
                'nama_tipe_provisioning' => 'PT2 NS',
                "role" => "Konstruksi"
            ],
            [
                'id' => 3,
                'nama_tipe_provisioning' => 'PT3',
                "role" => "Konstruksi"
            ],
            [
                'id' => 4,
                'nama_tipe_provisioning' => 'PT4',
                "role" => "Konstruksi"
            ],
            [
                'id' => 5,
                'nama_tipe_provisioning' => 'FEEDER-BRANCHING',
                "role" => "Konstruksi"
            ],
            [
                'id' => 6,
                'nama_tipe_provisioning' => 'FEEDER-UTAMA',
                "role" => "Konstruksi"
            ],
            [
                'id' => 7,
                'nama_tipe_provisioning' => 'PT1+',
                "role" => "Konstruksi"
            ],
            [
                'id' => 8,
                'nama_tipe_provisioning' => 'PT2',
                "role" => "Maintenance"
            ],
            [
                'id' => 9,
                'nama_tipe_provisioning' => 'PT2 NS',
                "role" => "Maintenance"
            ],
            [
                'id' => 10,
                'nama_tipe_provisioning' => 'PT3',
                "role" => "Maintenance"
            ],
            [
                'id' => 11,
                'nama_tipe_provisioning' => 'PT4',
                "role" => "Maintenance"
            ],
            [
                'id' => 12,
                'nama_tipe_provisioning' => 'FEEDER-BRANCHING',
                "role" => "Maintenance"
            ],
            [
                'id' => 13,
                'nama_tipe_provisioning' => 'FEEDER-UTAMA',
                "role" => "Maintenance"
            ],
            [
                'id' => 14,
                'nama_tipe_provisioning' => 'PT1+',
                "role" => "Maintenance"
            ],
        ];

        foreach ($provisioning as $prov) {
            TipeProvisioning::create($prov);
        }
    }
}
