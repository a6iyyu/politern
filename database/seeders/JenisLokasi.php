<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLokasi extends Seeder
{
    public function run(): void
    {
        DB::table('jenis_lokasi')->insert([
            ['id_jenis_lokasi' => 1, 'nama_jenis_lokasi' => 'Jarak jauh'],
            ['id_jenis_lokasi' => 2, 'nama_jenis_lokasi' => 'Di kantor'],
            ['id_jenis_lokasi' => 3, 'nama_jenis_lokasi' => 'Gabungan'],
        ]);
    }
}