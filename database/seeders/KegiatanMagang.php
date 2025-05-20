<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanMagang extends Seeder
{
    public function run(): void
    {
        DB::table('kegiatan_magang')->insert([
            [
                'id_kegiatan_magang'    => 1,
                'id_pengajuan'          => 1,
                'id_periode'            => 1,
                'id_dosen_pembimbing'   => 1,
                'tanggal_mulai'         => '2025-07-01',
                'tanggal_selesai'       => '2025-12-31',
                'status'                => 'BERLANGSUNG',
                'nilai_akhir'           => 3,
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
        ]);
    }
}