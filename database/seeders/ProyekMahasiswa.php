<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyekMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('proyek_mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_proyek' => 1],
            ['id_mahasiswa' => 1, 'id_proyek' => 2],
            ['id_mahasiswa' => 2, 'id_proyek' => 3],
            ['id_mahasiswa' => 2, 'id_proyek' => 4],
            ['id_mahasiswa' => 3, 'id_proyek' => 5],
            ['id_mahasiswa' => 3, 'id_proyek' => 6],
            ['id_mahasiswa' => 4, 'id_proyek' => 7],
            ['id_mahasiswa' => 4, 'id_proyek' => 8],
            ['id_mahasiswa' => 5, 'id_proyek' => 9],
            ['id_mahasiswa' => 5, 'id_proyek' => 10],
        ]);
    }
}