<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lowongan_magang')->delete();
        DB::table('periode_magang')->delete();
        DB::table('perusahaan_mitra')->delete();
        DB::table('mahasiswa')->delete();
        DB::table('admin')->delete();
        DB::table('program_studi')->delete();
        DB::table('pengguna')->delete();

        $this->call([
            Pengguna::class,
            Prodi::class,
            Admin::class,
            Mahasiswa::class,
            Perusahaan::class,
            PeriodeMagang::class,
            LowonganMagang::class,
        ]);
    }
}