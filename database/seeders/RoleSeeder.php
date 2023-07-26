<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'nama_role' => 'Commerce',
            ],
            [
                'nama_role' => 'Maintenance',
            ],
            [
                'nama_role' => 'Konstruksi',
            ],
            [
                'nama_role' => 'GM',
            ],
            [
                'nama_role' => 'Admin',
            ],
            [
                'nama_role' => 'Procurement',
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
