<?php

namespace Database\Seeders;

use App\Models\JenisOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            [
                'id' => 1,
                'nama_jenis_order' => 'Konsumer (Cons)',
            ],
            [
                'id' => 2,
                'nama_jenis_order' => 'HEM',
            ],
            [
                'id' => 3,
                'nama_jenis_order' => 'Node B',
            ],
            [
                'id' => 4,
                'nama_jenis_order' => 'Node B OLO (MTEL)',
            ],
            [
                'id' => 5,
                'nama_jenis_order' => 'OSP Granular',
            ],
            [
                'id' => 6,
                'nama_jenis_order' => 'OSP',
            ],
        ];

        foreach ($jenis as $jenisorder) {
            JenisOrder::create($jenisorder);
        }
    }
}
