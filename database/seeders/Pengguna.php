<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pengguna extends Seeder
{
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'id_pengguna'   => 1,
                'nama_pengguna' => 'admin',
                'email'         => 'admin@gmail.com',
                'kata_sandi'    => Hash::make('admin123'),
                'tipe'          => 'ADMIN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 2,
                'nama_pengguna' => 'ayleen',
                'email'         => 'ayleen@gmail.com',
                'kata_sandi'    => Hash::make('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 3,
                'nama_pengguna' => 'fais',
                'email'         => 'faisrestu@gmail.com',
                'kata_sandi'    => Hash::make('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 4,
                'nama_pengguna' => 'ivan',
                'email'         => 'ivansyah@gmail.com',
                'kata_sandi'    => Hash::make('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 5,
                'nama_pengguna' => 'rengga',
                'email'         => 'rengga@gmail.com',
                'kata_sandi'    => Hash::make('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 6,
                'nama_pengguna' => 'rafi',
                'email'         => 'rafi@gmail.com',
                'kata_sandi'    => Hash::make('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 7,
                'nama_pengguna' => 'dosen',
                'email'         => 'dosen@gmail.com',
                'kata_sandi'    => Hash::make('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}