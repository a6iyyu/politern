<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMagang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_magang')->insert([
            ['id_jenis_magang' => 1, 'nama_jenis' => 'MBKM'],
            ['id_jenis_magang' => 2, 'nama_jenis' => 'Magang Kerja'],
        ]);
    }
}
