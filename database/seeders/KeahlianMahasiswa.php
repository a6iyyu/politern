<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeahlianMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('keahlian_mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_keahlian' => 1],
            ['id_mahasiswa' => 1, 'id_keahlian' => 2],
            ['id_mahasiswa' => 1, 'id_keahlian' => 42],
            ['id_mahasiswa' => 2, 'id_keahlian' => 7],
            ['id_mahasiswa' => 2, 'id_keahlian' => 16],
            ['id_mahasiswa' => 2, 'id_keahlian' => 18],
            ['id_mahasiswa' => 2, 'id_keahlian' => 60],
            ['id_mahasiswa' => 3, 'id_keahlian' => 3],
            ['id_mahasiswa' => 3, 'id_keahlian' => 13],
            ['id_mahasiswa' => 4, 'id_keahlian' => 6],
            ['id_mahasiswa' => 4, 'id_keahlian' => 8],
            ['id_mahasiswa' => 4, 'id_keahlian' => 10],
            ['id_mahasiswa' => 5, 'id_keahlian' => 1],
            ['id_mahasiswa' => 5, 'id_keahlian' => 5],
            ['id_mahasiswa' => 5, 'id_keahlian' => 18],
        ]);
    }
}