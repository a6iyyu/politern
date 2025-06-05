<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LowonganMagang extends Seeder
{
    public function run(): void
    {
        DB::table('lowongan_magang')->insert([
            [
                'id_lowongan'                 => 1,
                'id_perusahaan_mitra'         => 1,
                'id_bidang'                   => 1,
                'id_jenis_lokasi'             => 1,
                'id_periode'                  => 1,
                'id_jenis_magang'             => 1,
                'id_durasi_magang'            => 3,
                'deskripsi'                   => 'Membangun antarmuka pengguna web dengan HTML, CSS, dan JavaScript.',
                'kuota'                       => 3,
                'gaji'                        => 'PAID',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
            [
                'id_lowongan'                 => 2,
                'id_perusahaan_mitra'         => 2,
                'id_bidang'                   => 3,
                'id_jenis_lokasi'             => 3,
                'id_periode'                  => 1,
                'id_jenis_magang'             => 2,
                'id_durasi_magang'            => 1,
                'deskripsi'                   => 'Merancang antarmuka yang menarik dan intuitif.',
                'kuota'                       => 1,
                'gaji'                        => 'PAID',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
            [
                'id_lowongan'                 => 3,
                'id_perusahaan_mitra'         => 3,
                'id_bidang'                   => 1,
                'id_jenis_lokasi'             => 1,
                'id_periode'                  => 1,
                'id_jenis_magang'             => 2,
                'id_durasi_magang'            => 1,
                'deskripsi'                   => 'Membangun API dan logika backend dengan PHP, Python, atau Java.',
                'kuota'                       => 2,
                'gaji'                        => 'UNPAID',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
        ]);
    }
}