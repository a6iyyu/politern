<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->delete();
        DB::table('log_aktivitas')->delete();
        DB::table('pengajuan_magang')->delete();
        DB::table('dosen_pembimbing')->delete();
        DB::table('kegiatan_magang')->delete();
        DB::table('lowongan_magang')->delete();
        DB::table('mahasiswa')->delete();
        DB::table('pengguna')->delete();
        DB::table('periode_magang')->delete();
        DB::table('perusahaan_mitra')->delete();
        DB::table('program_studi')->delete();

        $this->call([
            Pengguna::class,
            Prodi::class,
            KegiatanMagang::class,
            DosenPembimbing::class,
            Admin::class,
            Mahasiswa::class,
            Perusahaan::class,
            PeriodeMagang::class,
            LowonganMagang::class,
            PengajuanMagang::class,
            LogAktivitas::class,
        ]);
    }
}