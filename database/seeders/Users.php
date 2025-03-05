<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            0 => [
                'id_user' => 1,
                'nip' => '1234567890',
                'nim' => null,
                'nama_lengkap' => 'Admin',
                'email' => 'admin@polinema.ac.id',
                'kata_sandi' => Hash::make('admin'),
                'no_telepon' => '081234567890',
                'tipe' => 'admin',
                'created_at' => Carbon::now()->toDateTimeString(),
            ],
            1 => [
                'id_user' => 2,
                'nip' => null,
                'nim' => '2341720115',
                'nama_lengkap' => 'Rafi Abiyyu Airlangga',
                'email' => 'mizukinako7@gmail.com',
                'kata_sandi' => Hash::make('rafi'),
                'no_telepon' => '082143494259',
                'tipe' => 'mahasiswa',
                'created_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}