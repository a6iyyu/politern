<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogAktivitas extends Seeder
{
    public function run(): void
    {
        DB::table('log_aktivitas')->insert([
            [
                'id_log'                => 1,
                'id_magang'             => 1,
                'judul'                 => 'Pelatihan Teknologi UI/UX',
                'minggu'                => 1,
                'deskripsi'             => 'Mengikuti pelatihan teknologi UI/UX yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'MENUNGGU',
                'komentar'              => null,
                'tanggal_evaluasi'      => null,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_log'                => 2,
                'id_magang'             => 1,
                'judul'                 => 'Pelatihan Teknologi Frontend',
                'minggu'                => 2,
                'deskripsi'             => 'Mengikuti pelatihan teknologi frontend yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'DISETUJUI',
                'komentar'              => 'Bagus Sekali',
                'tanggal_evaluasi'      => Carbon::now(),
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_log'                => 3,
                'id_magang'             => 1,
                'judul'                 => 'Pelatihan Teknologi Backend',
                'minggu'                => 3,
                'deskripsi'             => 'Mengikuti pelatihan teknologi backend yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'MENUNGGU',
                'komentar'              => null,
                'tanggal_evaluasi'      => null,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_log'                => 4,
                'id_magang'             => 1,
                'judul'                 => 'Pelatihan Teknologi Deployment',
                'minggu'                => 4,
                'deskripsi'             => 'Mengikuti pelatihan teknologi deployment yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'foto'                  => null,
                'status'                => 'DITOLAK',
                'komentar'              => 'Tidak sesuai.',
                'tanggal_evaluasi'      => Carbon::now(),
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
        ]);
    }
}