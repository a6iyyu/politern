<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bidang_mahasiswa')->delete();
        DB::table('keahlian_mahasiswa')->delete();
        DB::table('pengalaman_mahasiswa')->delete();
        DB::table('proyek_mahasiswa')->delete();
        DB::table('sertifikasi_pelatihan_mahasiswa')->delete();
        DB::table('preferensi_lokasi_magang')->delete();
        DB::table('pengalaman')->delete();
        DB::table('proyek')->delete();
        DB::table('sertifikasi_pelatihan')->delete();
        DB::table('mahasiswa')->delete();
        DB::table('bidang')->delete();
        DB::table('keahlian')->delete();
        DB::table('lokasi')->delete();
        DB::table('jenis_lokasi')->delete();
        DB::table('admin')->delete();
        DB::table('dosen_pembimbing')->delete();
        DB::table('dosen')->delete();
        DB::table('program_studi')->delete();
        DB::table('pengguna')->delete();

        $this->call([
            Pengguna::class,
            Prodi::class,
            Dosen::class,
            DosenPembimbing::class,
            Admin::class,
            Bidang::class,
            Keahlian::class,
            Lokasi::class,
            JenisLokasi::class,
            Mahasiswa::class,
            Pengalaman::class,
            Proyek::class,
            SertifikasiPelatihan::class,
            PengalamanMahasiswa::class,
            ProyekMahasiswa::class,
            SertifikasiPelatihanMahasiswa::class,
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