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
            ['id_mahasiswa' => 1, 'id_keahlian' => 3],
        ]);
    }
}