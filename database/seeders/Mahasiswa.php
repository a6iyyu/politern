<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'id_mahasiswa'  => 1,
                'id_pengguna'   => 2,
                'nim'           => '2341720012',
                'nama_lengkap'  => 'Ayleen Ruhul Qisthy',
                'id_prodi'      => 2,
                'angkatan'      => 2023,
                'semester'      => 'GENAP',
                'alamat'        => 'Tulungagung',
                'nomor_telepon' => '088231322175',
                'cv'            => '',
                'ipk'           => 3.7,
                'status'        => 'SEDANG MAGANG',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_mahasiswa'  => 2,
                'id_pengguna'   => 3,
                'nim'           => '2341720076',
                'nama_lengkap'  => 'Fais Restu Pratama',
                'id_prodi'      => 2,
                'angkatan'      => 2023,
                'semester'      => 'GENAP',
                'alamat'        => 'Solo',
                'nomor_telepon' => '081238623279',
                'cv'            => '',
                'ipk'           => 3.5,
                'status'        => 'BELUM MAGANG',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_mahasiswa'  => 3,
                'id_pengguna'   => 4,
                'nim'           => '2341720126',
                'nama_lengkap'  => 'Ivansyah Eka Oktaviadi Santoso',
                'id_prodi'      => 1,
                'angkatan'      => 2023,
                'semester'      => 'GENAP',
                'alamat'        => 'Gresik',
                'nomor_telepon' => '085707092328',
                'cv'            => '',
                'ipk'           => 3.9,
                'status'        => 'DALAM PROSES',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_mahasiswa'  => 4,
                'id_pengguna'   => 5,
                'nim'           => '2341720160',
                'nama_lengkap'  => 'Maulana Rengga Ramadan',
                'id_prodi'      => 1,
                'angkatan'      => 2023,
                'semester'      => 'GENAP',
                'alamat'        => 'SUMENEP',
                'nomor_telepon' => '085708074515',
                'cv'            => '',
                'ipk'           => 3.7,
                'status'        => 'SEDANG MAGANG',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_mahasiswa'  => 5,
                'id_pengguna'   => 6,
                'nim'           => '2341720115',
                'nama_lengkap'  => 'Rafi Abiyyu Airlangga',
                'id_prodi'      => 2,
                'angkatan'      => 2023,
                'semester'      => 'GENAP',
                'alamat'        => 'MALANG',
                'nomor_telepon' => '082143494259',
                'cv'            => '',
                'ipk'           => 4,
                'status'        => 'SELESAI',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}