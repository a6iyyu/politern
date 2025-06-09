<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DurasiMagang extends Seeder
{
    public function run(): void
    {
        DB::table('durasi_magang')->insert([
            ['id_durasi_magang' => 1, 'nama_durasi' => '1 Bulan'],
            ['id_durasi_magang' => 2, 'nama_durasi' => '2 Bulan'],
            ['id_durasi_magang' => 3, 'nama_durasi' => '3 Bulan'],
            ['id_durasi_magang' => 4, 'nama_durasi' => '4 Bulan'],
            ['id_durasi_magang' => 5, 'nama_durasi' => '5 Bulan'],
            ['id_durasi_magang' => 6, 'nama_durasi' => '6 Bulan'],
        ]);
    }
}