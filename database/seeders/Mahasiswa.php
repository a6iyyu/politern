<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Seeder
{
    public function run(): void
    {
        DB::table('mahasiswa')->delete();
        DB::table('mahasiswa')->insert([
            [
                'id_mahasiswa' => 1,
                'id_pengguna' => 2,
                'nim' => '2341720012',
                'nama_lengkap' => 'Ayleen Ruhul Qisthy',
                'jenis_kelamin' => 'PEREMPUAN',
                'nomor_telepon' => '088231322175',
                'angkatan' => 2023,
                'jurusan' => 'Teknologi Informasi',
                'prodi' => 'D-IV Teknik Informatika',
                'alamat' => 'Tulungagung',
                'status' => 'AKTIF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_mahasiswa' => 2,
                'id_pengguna' => 3,
                'nim' => '2341720076',
                'nama_lengkap' => 'Fais Restu Pratama',
                'jenis_kelamin' => 'LAKI-LAKI',
                'nomor_telepon' => '081238623279',
                'angkatan' => 2023,
                'jurusan' => 'Teknologi Informasi',
                'prodi' => 'D-IV Teknik Informatika',
                'alamat' => 'Solo',
                'status' => 'AKTIF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_mahasiswa' => 3,
                'id_pengguna' => 4,
                'nim' => '2341720126',
                'nama_lengkap' => 'Ivansyah Eka Oktaviadi Santoso',
                'jenis_kelamin' => 'LAKI-LAKI',
                'nomor_telepon' => '085707092328',
                'angkatan' => 2023,
                'jurusan' => 'Teknologi Informasi',
                'prodi' => 'D-IV Teknik Informatika',
                'alamat' => 'Gresik',
                'status' => 'AKTIF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_mahasiswa' => 4,
                'id_pengguna' => 5,
                'nim' => '2341720160',
                'nama_lengkap' => 'Maulana Rengga Ramadan',
                'jenis_kelamin' => 'LAKI-LAKI',
                'nomor_telepon' => '085708074515',
                'angkatan' => 2023,
                'jurusan' => 'Teknologi Informasi',
                'prodi' => 'D-IV Teknik Informatika',
                'alamat' => 'SUMENEP',
                'status' => 'AKTIF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id_mahasiswa' => 5,
                'id_pengguna' => 6,
                'nim' => '2341720115',
                'nama_lengkap' => 'Rafi Abiyyu Airlangga',
                'jenis_kelamin' => 'LAKI-LAKI',
                'nomor_telepon' => '082143494259',
                'angkatan' => 2023,
                'jurusan' => 'Teknologi Informasi',
                'prodi' => 'D-IV Teknik Informatika',
                'alamat' => 'MALANG',
                'status' => 'AKTIF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}