<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferensiJenisLokasiMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('preferensi_jenis_lokasi_magang')->insert([
            ['id_mahasiswa' => 1, 'id_jenis_lokasi' => 1],
            ['id_mahasiswa' => 1, 'id_jenis_lokasi' => 2],
            ['id_mahasiswa' => 2, 'id_jenis_lokasi' => 2],
            ['id_mahasiswa' => 3, 'id_jenis_lokasi' => 1],
            ['id_mahasiswa' => 4, 'id_jenis_lokasi' => 1],
            ['id_mahasiswa' => 4, 'id_jenis_lokasi' => 2],
            ['id_mahasiswa' => 5, 'id_jenis_lokasi' => 3],
            ['id_mahasiswa' => 5, 'id_jenis_lokasi' => 2],
        ]);
    }
}