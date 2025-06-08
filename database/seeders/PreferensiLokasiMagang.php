<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferensiLokasiMagang extends Seeder
{
    public function run(): void
    {
        DB::table('preferensi_lokasi_magang')->insert([
            ['id_mahasiswa' => 1, 'id_lokasi' => 85],
            ['id_mahasiswa' => 1, 'id_lokasi' => 27],
            ['id_mahasiswa' => 1, 'id_lokasi' => 39],
        ]);
    }
}