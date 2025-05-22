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
            'id_evaluasi' => 1,
            'id_magang' => 1,
            'tanggal_evaluasi' => '2025-05-21',
            'status' => 'MENUNGGU',
            'komentar' => 'Silahkan lakukan evaluasi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
