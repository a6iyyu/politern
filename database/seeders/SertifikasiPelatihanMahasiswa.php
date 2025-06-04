<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikasiPelatihanMahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('sertifikasi_pelatihan_mahasiswa')->insert([
            ['id_mahasiswa' => 1, 'id_sertifikasi_pelatihan' => 1],
            ['id_mahasiswa' => 1, 'id_sertifikasi_pelatihan' => 5],
            ['id_mahasiswa' => 1, 'id_sertifikasi_pelatihan' => 10],
            ['id_mahasiswa' => 1, 'id_sertifikasi_pelatihan' => 15],
            ['id_mahasiswa' => 2, 'id_sertifikasi_pelatihan' => 2],
            ['id_mahasiswa' => 2, 'id_sertifikasi_pelatihan' => 6],
            ['id_mahasiswa' => 2, 'id_sertifikasi_pelatihan' => 11],
            ['id_mahasiswa' => 2, 'id_sertifikasi_pelatihan' => 16],
            ['id_mahasiswa' => 3, 'id_sertifikasi_pelatihan' => 3],
            ['id_mahasiswa' => 3, 'id_sertifikasi_pelatihan' => 7],
            ['id_mahasiswa' => 3, 'id_sertifikasi_pelatihan' => 12],
            ['id_mahasiswa' => 3, 'id_sertifikasi_pelatihan' => 17],
            ['id_mahasiswa' => 4, 'id_sertifikasi_pelatihan' => 4],
            ['id_mahasiswa' => 4, 'id_sertifikasi_pelatihan' => 8],
            ['id_mahasiswa' => 4, 'id_sertifikasi_pelatihan' => 13],
            ['id_mahasiswa' => 4, 'id_sertifikasi_pelatihan' => 18],
            ['id_mahasiswa' => 5, 'id_sertifikasi_pelatihan' => 9],
            ['id_mahasiswa' => 5, 'id_sertifikasi_pelatihan' => 14],
            ['id_mahasiswa' => 5, 'id_sertifikasi_pelatihan' => 19],
            ['id_mahasiswa' => 5, 'id_sertifikasi_pelatihan' => 20],
        ]);
    }
}