<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Dosen extends Seeder
{
    public function run(): void
    {
        DB::table('dosen')->insert([
            'id_dosen' => 1,
            'id_pengguna' => 7,
            'nip' => '197812312019031001',
            'nama' => 'Dosen',
            'nomor_telepon' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
