<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'umur' => '17',
            'gaji' => 8000000,
            'jabatan' => 'anak biasa',
            'gender' => 'L',
            'no_wa' => '12345678',
            'tanggal_bergabung' => '2024-01-01',
        ]);


        User::create([
            'name' => 'Atasan',
            'email' => 'atasan@gmail.com',
            'password' => bcrypt('atasan'),
            'role' => 'atasan',
            'umur' => '47',
            'gaji' => 8000000,
            'jabatan' => 'Kepala Sekolah',
            'gender' => 'L',
            'no_wa' => '09876543',
            'tanggal_bergabung' => '2020-01-01',
        ]);

        User::create([
            'name' => 'Pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('pegawai'),
            'role' => 'pegawai',
            'umur' => '29',
            'gaji' => 2000000,
            'jabatan' => 'Staff',
            'gender' => 'P',
            'no_wa' => '78901234',
            'tanggal_bergabung' => '2020-09-09',
        ]);
    }
}
