<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreferensiDurasiMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('preferensi_durasi_mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_durasi_magang' => 1],
            ['id_mahasiswa' => 1, 'id_durasi_magang' => 2],
            ['id_mahasiswa' => 2, 'id_durasi_magang' => 6],
            ['id_mahasiswa' => 3, 'id_durasi_magang' => 2],
            ['id_mahasiswa' => 4, 'id_durasi_magang' => 3],
            ['id_mahasiswa' => 5, 'id_durasi_magang' => 6],
        ]);
    }
}