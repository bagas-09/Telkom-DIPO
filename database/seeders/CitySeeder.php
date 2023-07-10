<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [
                'id' => 1,
                'nama_city' => 'Semarang',
            ],
            [
                'id' => 2,
                'nama_city' => 'Pekalongan',
            ],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}