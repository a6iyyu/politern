<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeMagang extends Seeder
{
    public function run(): void
    {
        DB::table('periode_magang')->insert([
            [
                'id_periode'       => 1,
                'nama_periode'     => 'Semester Ganjil 2023/2024',
                'tanggal_mulai'    => '2023-07-01',
                'tanggal_selesai'  => '2023-12-31',
                'status'           => 'SELESAI',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'id_periode'       => 2,
                'nama_periode'     => 'Semester Genap 2023/2024',
                'tanggal_mulai'    => '2024-01-01',
                'tanggal_selesai'  => '2024-06-30',
                'status'           => 'SELESAI',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'id_periode'       => 3,
                'nama_periode'     => 'Semester Ganjil 2024/2025',
                'tanggal_mulai'    => '2024-07-01',
                'tanggal_selesai'  => '2024-12-31',
                'status'           => 'AKTIF',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],
            [
                'id_periode'       => 4,
                'nama_periode'     => 'Semester Genap 2024/2025',
                'tanggal_mulai'    => '2025-01-01',
                'tanggal_selesai'  => '2025-06-30',
                'status'           => 'AKTIF',
                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),
            ],

        ]);
    }
}