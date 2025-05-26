<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferensiLokasiMagang extends Seeder
{
    public function run(): void
    {
        DB::table('preferensi_lokasi_magang')->insert([
            ['id_mahasiswa' => 1, 'id_lokasi' => 1],
            ['id_mahasiswa' => 1, 'id_lokasi' => 5],
            ['id_mahasiswa' => 1, 'id_lokasi' => 7],
            ['id_mahasiswa' => 1, 'id_lokasi' => 8],
            ['id_mahasiswa' => 2, 'id_lokasi' => 2],
            ['id_mahasiswa' => 2, 'id_lokasi' => 9],
            ['id_mahasiswa' => 2, 'id_lokasi' => 10],
            ['id_mahasiswa' => 2, 'id_lokasi' => 11],
            ['id_mahasiswa' => 3, 'id_lokasi' => 3],
            ['id_mahasiswa' => 3, 'id_lokasi' => 12],
            ['id_mahasiswa' => 3, 'id_lokasi' => 15],
            ['id_mahasiswa' => 3, 'id_lokasi' => 16],
            ['id_mahasiswa' => 4, 'id_lokasi' => 4],
            ['id_mahasiswa' => 4, 'id_lokasi' => 17],
            ['id_mahasiswa' => 4, 'id_lokasi' => 18],
            ['id_mahasiswa' => 4, 'id_lokasi' => 19],
            ['id_mahasiswa' => 5, 'id_lokasi' => 5],
            ['id_mahasiswa' => 5, 'id_lokasi' => 20],
            ['id_mahasiswa' => 5, 'id_lokasi' => 21],
            ['id_mahasiswa' => 5, 'id_lokasi' => 22],
        ]);
    }
}