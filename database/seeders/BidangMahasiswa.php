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
        ]);
    }
}