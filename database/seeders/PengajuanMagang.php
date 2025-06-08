<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengajuanMagang extends Seeder
{
    public function run(): void
    {
        DB::table('pengajuan_magang')->insert([
            [
                'id_pengajuan_magang'   => 1,
                'id_mahasiswa'          => 4,
                'id_lowongan'           => 1,
                'status'                => 'MENUNGGU',
                'keterangan'            => 'Pengajuan magang',
                'created_at'            => Carbon::now(), 
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_pengajuan_magang'   => 2,
                'id_mahasiswa'          => 1,
                'id_lowongan'           => 2,
                'status'                => 'DISETUJUI',
                'keterangan'            => 'Pengajuan magang',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],[
                'id_pengajuan_magang'   => 3,
                'id_mahasiswa'          => 2,
                'id_lowongan'           => 2,
                'status'                => 'DISETUJUI',
                'keterangan'            => 'Pengajuan magang',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_pengajuan_magang'   => 4,
                'id_mahasiswa'          => 3,
                'id_lowongan'           => 2,
                'status'                => 'DISETUJUI',
                'keterangan'            => 'Pengajuan magang',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ],
            [
                'id_pengajuan_magang'   => 5,
                'id_mahasiswa'          => 5,
                'id_lowongan'           => 2,
                'status'                => 'DISETUJUI',
                'keterangan'            => 'Pengajuan magang',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]
        ]);
    }
}