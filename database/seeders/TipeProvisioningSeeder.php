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
            ],
            [
                'id' => 2,
                'nama_tipe_provisioning' => 'PT2 NS',
            ],
            [
                'id' => 3,
                'nama_tipe_provisioning' => 'PT3',
            ],
            [
                'id' => 4,
                'nama_tipe_provisioning' => 'PT4',
            ],
            [
                'id' => 5,
                'nama_tipe_provisioning' => 'FEEDER-BRANCHING',
            ],
            [
                'id' => 6,
                'nama_tipe_provisioning' => 'FEEDER-UTAMA',
            ],
            [
                'id' => 7,
                'nama_tipe_provisioning' => 'PT1+',
            ],
        ];

        foreach ($provisioning as $prov) {
            TipeProvisioning::create($prov);
        }
    }
}
