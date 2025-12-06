<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@taspen.com',
                'password' => Hash::make('superadmin123'),
                'role' => 'super_admin',
                'nip' => '198901012019011001',
                'no_hp' => '081234567899',
                'alamat' => 'Jl. Proklamasi No. 1, Jakarta',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Admin Taspen',
                'email' => 'admin@taspen.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'nip' => '199001012020011001',
                'alamat' => 'Jl. Jend. Sudirman No. 1, Jakarta Pusat',
                'no_hp' => '081234567890',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Petugas 1 - Divisi Pelayanan',
                'email' => 'petugas1@taspen.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'nip' => '199101012020012001',
                'alamat' => 'Jl. Gatot Subroto No. 45, Jakarta Selatan',
                'no_hp' => '081234567891',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Petugas 2 - Divisi Pelayanan',
                'email' => 'petugas2@taspen.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'nip' => '199202012020012002',
                'alamat' => 'Jl. HR Rasuna Said No. 78, Jakarta Selatan',
                'no_hp' => '081234567892',
                'is_approved' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Petugas 3 - Divisi Pelayanan',
                'email' => 'petugas3@taspen.com',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'nip' => '199303012020012003',
                'alamat' => 'Jl. Thamrin No. 23, Jakarta Pusat',
                'no_hp' => '081234567893',
                'is_approved' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
