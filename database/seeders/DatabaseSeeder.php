<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('preferensi_lokasi_magang')->delete();
        DB::table('evaluasi_magang')->delete();
        DB::table('log_aktivitas')->delete();
        DB::table('magang')->delete();
        DB::table('pengajuan_magang')->delete();
        DB::table('lowongan_magang')->delete();
        DB::table('periode_magang')->delete();
        DB::table('perusahaan_mitra')->delete();
        DB::table('mahasiswa')->delete();
        DB::table('keahlian')->delete();
        DB::table('keahlian_mahasiswa')->delete();
        DB::table('lokasi')->delete();
        DB::table('jenis_lokasi')->delete();
        DB::table('admin')->delete();
        DB::table('bidang_mahasiswa')->delete();
        DB::table('bidang')->delete();
        DB::table('dosen_pembimbing')->delete();
        DB::table('dosen')->delete();
        DB::table('program_studi')->delete();
        DB::table('pengguna')->delete();

        $this->call([
            Pengguna::class,
            Prodi::class,
            Bidang::class,
            Lokasi::class,
            JenisLokasi::class,
            Dosen::class,
            DosenPembimbing::class,
            Admin::class,
            Keahlian::class,
            Mahasiswa::class,
            BidangMahasiswa::class,
            KeahlianMahasiswa::class,
            PreferensiLokasiMagang::class,
            Perusahaan::class,
            PeriodeMagang::class,
            LowonganMagang::class,
            PengajuanMagang::class,
            Magang::class,
            LogAktivitas::class,
            EvaluasiMagang::class,
        ]);
    }
}