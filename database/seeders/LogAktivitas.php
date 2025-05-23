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
                'tanggal'               => Carbon::now(),
                'judul'                 => 'Pelatihan Teknologi UI/UX',
                'minggu'                => 1,
                'deskripsi'             => 'Mengikuti pelatihan teknologi UI/UX yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'durasi'                => 2,
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'DISETUJUI',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_log'                => 2,
                'id_magang'             => 1,
                'tanggal'               => Carbon::now(),
                'judul'                 => 'Pelatihan Teknologi Frontend',
                'minggu'                => 2,
                'deskripsi'             => 'Mengikuti pelatihan teknologi frontend yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'durasi'                => 2,
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'DITOLAK',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_log'                => 3,
                'id_magang'             => 1,
                'tanggal'               => Carbon::now(),
                'judul'                 => 'Pelatihan Teknologi Backend',
                'minggu'                => 3,
                'deskripsi'             => 'Mengikuti pelatihan teknologi backend yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'durasi'                => 2,
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'MENUNGGU',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_log'                => 4,
                'id_magang'             => 1,
                'tanggal'               => Carbon::now(),
                'judul'                 => 'Pelatihan Teknologi Deployment',
                'minggu'                => 4,
                'deskripsi'             => 'Mengikuti pelatihan teknologi deployment yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan.',
                'durasi'                => 2,
                'foto'                  => asset('shared/aktivitas.png'),
                'status'                => 'DISETUJUI',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
        ]);
    }
}