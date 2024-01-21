<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis = [
            [
                'id' => 1,
                'nama_program' => 'Konsumer (Cons)',
            ],
            [
                'id' => 2,
                'nama_program' => 'HEM',
            ],
            [
                'id' => 3,
                'nama_program' => 'Node B',
            ],
            [
                'id' => 4,
                'nama_program' => 'Node B OLO (MTEL)',
            ],
            [
                'id' => 5,
                'nama_program' => 'OSP Granular',
            ],
            [
                'id' => 6,
                'nama_program' => 'OSP',
            ],
        ];

        foreach ($jenis as $program) {
            Program::create($program);
        }
    }
}
