<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('bidang_mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_bidang' => 1],
            ['id_mahasiswa' => 1, 'id_bidang' => 2],
            ['id_mahasiswa' => 1, 'id_bidang' => 42],
            ['id_mahasiswa' => 2, 'id_bidang' => 7],
            ['id_mahasiswa' => 2, 'id_bidang' => 16],
            ['id_mahasiswa' => 2, 'id_bidang' => 18],
            ['id_mahasiswa' => 2, 'id_bidang' => 60],
            ['id_mahasiswa' => 3, 'id_bidang' => 3],
            ['id_mahasiswa' => 3, 'id_bidang' => 13],
            ['id_mahasiswa' => 4, 'id_bidang' => 6],
            ['id_mahasiswa' => 4, 'id_bidang' => 8],
            ['id_mahasiswa' => 4, 'id_bidang' => 10],
            ['id_mahasiswa' => 5, 'id_bidang' => 1],
            ['id_mahasiswa' => 5, 'id_bidang' => 5],
            ['id_mahasiswa' => 5, 'id_bidang' => 18],
        ]);
    }
}