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
                'kode'          => 58501,
                'nama'          => 'Pengembangan Perangkat (Piranti) Lunak Situs',
                'jenjang'       => 'D2',
                'jurusan'       => 'Teknologi Informasi',
                'status'        => 'AKTIF'
            ],
            [
                'id_prodi'      => 2,
                'kode'          => 55301,
                'nama'          => 'Teknik Informatika',
                'jenjang'       => 'D4',
                'jurusan'       => 'Teknologi Informasi',
                'status'        => 'AKTIF'
            ],
        ]);
    }
}