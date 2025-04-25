<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pengguna extends Seeder
{
    public function run(): void
    {
        DB::table('pengguna')->delete();
        DB::table('pengguna')->insert([
            [
                'id_pengguna' => 1,
                'nama_pengguna' => 'admin',
                'tipe_pengguna' => 'ADMIN',
                'kata_sandi' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 2,
                'nama_pengguna' => 'ayleen',
                'tipe_pengguna' => 'MAHASISWA',
                'kata_sandi' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 3,
                'nama_pengguna' => 'fais',
                'tipe_pengguna' => 'MAHASISWA',
                'kata_sandi' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 4,
                'nama_pengguna' => 'ivan',
                'tipe_pengguna' => 'MAHASISWA',
                'kata_sandi' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 5,
                'nama_pengguna' => 'rengga',
                'tipe_pengguna' => 'MAHASISWA',
                'kata_sandi' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 6,
                'nama_pengguna' => 'rafi',
                'tipe_pengguna' => 'MAHASISWA',
                'kata_sandi' => Hash::make('123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_pengguna' => 7,
                'nama_pengguna' => 'molca',
                'tipe_pengguna' => 'PERUSAHAAN',
                'kata_sandi' => Hash::make('company123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}