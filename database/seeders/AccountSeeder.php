<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Bagas',
                'nik' => '123456789',
                'password' => bcrypt('12345678'), 
                'role' => "Maintenance",
                'keterangan' => "",
                "id_nama_kota"=> 1
            ],
            [
                'nama' => 'Raha',
                'nik' => '234567891',
                'password' => bcrypt('12345678'), 
                'role' => "Commerce",
                'keterangan' => "",
                "id_nama_kota"=> 1
            ],
            [
                'nama' => 'Dhito',
                'nik' => '345678912',
                'password' => bcrypt('12345678'), 
                'role' => "Konstruksi",
                'keterangan' => "",
                "id_nama_kota"=> 1
            ],
            [
                'nama' => 'Admin',
                'nik' => 'Admin',
                'password' => bcrypt('12345678'), 
                'role' => "Admin",
                'keterangan' => "",
                "id_nama_kota"=> 1
            ]
        ];

        foreach ($users as $user) {
            Account::create($user);
        }
    }
}
