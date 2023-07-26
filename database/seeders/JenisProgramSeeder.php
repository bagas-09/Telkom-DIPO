<?php

namespace Database\Seeders;

use App\Models\JenisProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            [
                'id' => 1,
                'nama_jenis_program' => 'QE RECOVERY-DISTRIBUSI',
            ],
            [
                'id' => 2,
                'nama_jenis_program' => 'QE RECOVERY-FEEDER',
            ],
            [
                'id' => 3,
                'nama_jenis_program' => 'QE RECOVERY-ODC',
            ],
            [
                'id' => 4,
                'nama_jenis_program' => 'QE RECOVERY-ODP',
            ],
            [
                'id' => 5,
                'nama_jenis_program' => 'QE RELOKASI UTILITAS',
            ],
            [
                'id' => 6,
                'nama_jenis_program' => 'QE HEM',
            ],
            [
                'id' => 7,
                'nama_jenis_program' => 'QE ACCESS',
            ],
        ];

        foreach ($jenis as $jenisprogram) {
            JenisProgram::create($jenisprogram);
        }
    }
}
