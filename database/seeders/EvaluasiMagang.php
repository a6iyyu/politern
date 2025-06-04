<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EvaluasiMagang extends Seeder
{
    public function run(): void
    {
        DB::table('evaluasi_magang')->insert([
            [
                'id_evaluasi'       => 1,
                'id_magang'         => 1,
                'tanggal_evaluasi'  => Carbon::parse('2025-06-02'),
                'status'            => 'MENUNGGU',
                'komentar'          => 'Harap bersabar, proses evaluasi Anda sedang diproses.',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id_evaluasi'       => 2,
                'id_magang'         => 2,
                'tanggal_evaluasi'  => Carbon::parse('2025-06-03'),
                'status'            => 'DISETUJUI',
                'komentar'          => 'Selamat, Anda telah diterima dalam program magang.',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
            [
                'id_evaluasi'       => 3,
                'id_magang'         => 3,
                'tanggal_evaluasi'  => Carbon::parse('2025-06-04'),
                'status'            => 'DITOLAK',
                'komentar'          => 'Mohon maaf, Anda belum memenuhi syarat untuk mengikuti program magang.',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ],
        ]);
    }
}