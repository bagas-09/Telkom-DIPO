<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CitySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(JenisProgramSeeder::class);
        $this->call(MitraSeeder::class);
        $this->call(StatusPekerjaanSeeder::class);
        $this->call(TipeKemitraanSeeder::class);
        $this->call(TipeProvisioningSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(StatusTagihanSeeder::class);
    }
}
