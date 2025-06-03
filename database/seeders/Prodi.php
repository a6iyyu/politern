<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Prodi extends Seeder
{
    public function run(): void
    {
        DB::table('program_studi')->insert([
            [
                'id_prodi'      => 1,
                'kode'          => 'D2-PPLS',
                'nama'          => 'Pengembangan Perangkat (Piranti) Lunak Situs',
                'jenjang'       => 'D2',
                'jurusan'       => 'Teknologi Informasi',
                'status'        => 'AKTIF'
            ],
            [
                'id_prodi'      => 2,
                'kode'          => 'D4-TI',
                'nama'          => 'Teknik Informatika',
                'jenjang'       => 'D4',
                'jurusan'       => 'Teknologi Informasi',
                'status'        => 'AKTIF'
            ],
            [
                'id_prodi'      => 3,
                'kode'          => 'D4-SIB',
                'nama'          => 'Sistem Informasi Bisnis',
                'jenjang'       => 'D4',
                'jurusan'       => 'Teknologi Informasi',
                'status'        => 'AKTIF'
            ],
        ]);
    }
}