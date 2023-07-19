<?php

namespace Database\Seeders;

use App\Models\Mitra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mitras = [
            [
                'id' => 1,
                'nama_mitra' => 'Upaya Teknik',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 2,
                'nama_mitra' => 'Putra Jaya Raharja',
                'role' => 'Konstruksi'
            ],
            [
                'id' => 3,
                'nama_mitra' => 'Cipta Utama Karya',
                'role' => 'Konstruksi'
            ],
        ];

        foreach ($mitras as $mitra) {
           Mitra::create($mitra);
        }
    }
}