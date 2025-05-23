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
                'id_keahlian'                 => 1,
                'id_bidang'                   => 1,
                'id_jenis_lokasi'             => 1,
                'id_periode'                  => 1,
                'judul'                       => 'Frontend Developer',
                'deskripsi'                   => 'Membangun antarmuka pengguna web dengan HTML, CSS, dan JavaScript.',
                'kuota'                       => 3,
                'gaji'                        => '3000000.00',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'tanggal_posting'             => Carbon::now()->toDateString(),
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
            [
                'id_lowongan'                 => 2,
                'id_perusahaan_mitra'         => 1,
                'id_keahlian'                 => 2,
                'id_bidang'                   => 1,
                'id_jenis_lokasi'             => 2,
                'id_periode'                  => 1,
                'judul'                       => 'UI/UX Designer',
                'deskripsi'                   => 'Merancang antarmuka yang menarik dan intuitif.',
                'kuota'                       => 1,
                'gaji'                        => '3000000.00',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'tanggal_posting'             => Carbon::now()->toDateString(),
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
            [
                'id_lowongan'                 => 3,
                'id_perusahaan_mitra'         => 1,
                'id_keahlian'                 => 2,
                'id_bidang'                   => 1,
                'id_jenis_lokasi'             => 1,
                'id_periode'                  => 1,
                'judul'                       => 'Backend Developer',
                'deskripsi'                   => 'Membangun API dan logika backend dengan PHP, Python, atau Java.',
                'kuota'                       => 2,
                'gaji'                        => '3000000.00',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'tanggal_posting'             => Carbon::now()->toDateString(),
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
            [
                'id_lowongan'                 => 4,
                'id_perusahaan_mitra'         => 1,
                'id_keahlian'                 => 2,
                'id_bidang'                   => 1,
                'id_jenis_lokasi'             => 1,
                'id_periode'                  => 1,
                'judul'                       => 'Fullstack Developer',
                'deskripsi'                   => 'Mengembangkan frontend dan backend dalam satu kesatuan aplikasi.',
                'kuota'                       => 1,
                'gaji'                        => '3500000.00',
                'tanggal_mulai_pendaftaran'   => '2025-05-01',
                'tanggal_selesai_pendaftaran' => '2025-06-15',
                'tanggal_posting'             => Carbon::now()->toDateString(),
                'status'                      => 'DIBUKA',
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now(),
            ],
        ]);
    }
}
