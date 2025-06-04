<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengalamanMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('pengalaman_mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_pengalaman' => 1],
            ['id_mahasiswa' => 1, 'id_pengalaman' => 5],
            ['id_mahasiswa' => 1, 'id_pengalaman' => 10],
            ['id_mahasiswa' => 1, 'id_pengalaman' => 15],
            ['id_mahasiswa' => 2, 'id_pengalaman' => 2],
            ['id_mahasiswa' => 2, 'id_pengalaman' => 6],
            ['id_mahasiswa' => 2, 'id_pengalaman' => 11],
            ['id_mahasiswa' => 2, 'id_pengalaman' => 16],
            ['id_mahasiswa' => 3, 'id_pengalaman' => 3],
            ['id_mahasiswa' => 3, 'id_pengalaman' => 7],
            ['id_mahasiswa' => 3, 'id_pengalaman' => 12],
            ['id_mahasiswa' => 3, 'id_pengalaman' => 17],
            ['id_mahasiswa' => 4, 'id_pengalaman' => 4],
            ['id_mahasiswa' => 4, 'id_pengalaman' => 8],
            ['id_mahasiswa' => 4, 'id_pengalaman' => 13],
            ['id_mahasiswa' => 4, 'id_pengalaman' => 18],
            ['id_mahasiswa' => 5, 'id_pengalaman' => 9],
            ['id_mahasiswa' => 5, 'id_pengalaman' => 14],
            ['id_mahasiswa' => 5, 'id_pengalaman' => 19],
            ['id_mahasiswa' => 5, 'id_pengalaman' => 20],
        ]);
    }
}