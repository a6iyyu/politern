<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeriodeMagang extends Seeder
{
    public function run(): void
    {
        DB::table('periode_magang')->insert([
            [
                'id_periode'       => 1,
                'nama_periode'     => 'Semester Genap 2025/2026',
                'tanggal_mulai'    => '2025-07-01',
                'tanggal_selesai'  => '2025-12-31',
                'status'           => 'AKTIF',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
        ]);
    }
}