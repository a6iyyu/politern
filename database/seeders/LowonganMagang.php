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
                'id_lowongan'                  => 1,
                'id_perusahaan_mitra'          => 1,
                'id_periode'                   => 1,
                'judul'                        => 'Frontend Developer',
                'deskripsi'                    => 'Bertanggung jawab untuk membangun antarmuka pengguna web menggunakan HTML, CSS, dan JavaScript.',
                'kategori'                     => 'DI LOKASI',
                'lokasi'                       => 'Malang, Jawa Timur',
                'gaji_minimal'                 => 'Rp2 juta',
                'gaji_maksimal'                => 'Rp3 juta',
                'bidang_keahlian'              => 'Web Development',
                'kuota'                        => 3,
                'tanggal_mulai_magang'         => '2025-07-01',
                'tanggal_selesai_magang'       => '2025-12-31',
                'tanggal_mulai_pendaftaran'    => '2025-05-01',
                'tanggal_selesai_pendaftaran'  => '2025-06-15',
                'tanggal_posting'              => Carbon::now()->toDateString(),
                'status'                       => 'DIBUKA',
                'created_at'                   => Carbon::now(),
                'updated_at'                   => Carbon::now(),
            ],
            [
                'id_lowongan'                  => 2,
                'id_perusahaan_mitra'          => 1,
                'id_periode'                   => 1,
                'judul'                        => 'UI/UX Designer',
                'deskripsi'                    => 'Merancang antarmuka pengguna yang menarik dan mudah digunakan untuk aplikasi web dan mobile.',
                'kategori'                     => 'JARAK JAUH',
                'lokasi'                       => 'Surabaya, Jawa Timur',
                'gaji_minimal'                 => 'Rp2 juta',
                'gaji_maksimal'                => 'Rp3 juta',
                'bidang_keahlian'              => 'Desain UI/UX',
                'kuota'                        => 1,
                'tanggal_mulai_magang'         => '2025-07-01',
                'tanggal_selesai_magang'       => '2025-12-31',
                'tanggal_mulai_pendaftaran'    => '2025-05-01',
                'tanggal_selesai_pendaftaran'  => '2025-06-15',
                'tanggal_posting'              => Carbon::now()->toDateString(),
                'status'                       => 'DIBUKA',
                'created_at'                   => Carbon::now(),
                'updated_at'                   => Carbon::now(),
            ],
            [
                'id_lowongan'                  => 3,
                'id_perusahaan_mitra'          => 1,
                'id_periode'                   => 1,
                'judul'                        => 'Backend Developer',
                'deskripsi'                    => 'Bertanggung jawab untuk membangun aplikasi backend menggunakan bahasa pemrograman seperti PHP, Python, atau Java.',
                'kategori'                     => 'DI LOKASI',
                'lokasi'                       => 'Malang, Jawa Timur',
                'gaji_minimal'                 => 'Rp2 juta',
                'gaji_maksimal'                => 'Rp3 juta',
                'bidang_keahlian'              => 'Backend Development',
                'kuota'                        => 2,
                'tanggal_mulai_magang'         => '2025-07-01',
                'tanggal_selesai_magang'       => '2025-12-31',
                'tanggal_mulai_pendaftaran'    => '2025-05-01',
                'tanggal_selesai_pendaftaran'  => '2025-06-15',
                'tanggal_posting'              => Carbon::now()->toDateString(),
                'status'                       => 'DIBUKA',
                'created_at'                   => Carbon::now(),
                'updated_at'                   => Carbon::now(),
            ],
            [
                'id_lowongan'                  => 4,
                'id_perusahaan_mitra'          => 1,
                'id_periode'                   => 1,
                'judul'                        => 'Fullstack Developer',
                'deskripsi'                    => 'Bertanggung jawab untuk membangun aplikasi fullstack menggunakan bahasa pemrograman seperti PHP, Python, atau Java.',
                'kategori'                     => 'DI LOKASI',
                'lokasi'                       => 'Malang, Jawa Timur',
                'gaji_minimal'                 => 'Rp2 juta',
                'gaji_maksimal'                => 'Rp3 juta',
                'bidang_keahlian'              => 'Fullstack Development',
                'kuota'                        => 1,
                'tanggal_mulai_magang'         => '2025-07-01',
                'tanggal_selesai_magang'       => '2025-12-31',
                'tanggal_mulai_pendaftaran'    => '2025-05-01',
                'tanggal_selesai_pendaftaran'  => '2025-06-15',
                'tanggal_posting'              => Carbon::now()->toDateString(),
                'status'                       => 'DIBUKA',
                'created_at'                   => Carbon::now(),
                'updated_at'                   => Carbon::now(),
            ],
        ]);
    }
}