<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pengguna extends Seeder
{
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'id_pengguna'   => 1,
                'nama_pengguna' => 'admin',
                'email'         => 'admin@gmail.com',
                'kata_sandi'    => Crypt::encrypt('admin123'),
                'tipe'          => 'ADMIN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 2,
                'nama_pengguna' => 'ayleen',
                'email'         => 'qisthyayleen@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 3,
                'nama_pengguna' => 'fais',
                'email'         => 'restu.prtma05@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 4,
                'nama_pengguna' => 'ivan',
                'email'         => 'ivansyahsantoso@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 5,
                'nama_pengguna' => 'rengga',
                'email'         => 'mlnrengga@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 6,
                'nama_pengguna' => 'rafi',
                'email'         => 'mizukinako7@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'MAHASISWA',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 7,
                'nama_pengguna' => 'dosen',
                'email'         => 'dosen@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 8,
                'nama_pengguna' => 'dosen1',
                'email'         => 'dosen1@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 9,
                'nama_pengguna' => 'dosen2',
                'email'         => 'dosen2@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 10,
                'nama_pengguna' => 'dosen3',
                'email'         => 'dosen3@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 11,
                'nama_pengguna' => 'dosen4',
                'email'         => 'dosen4@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 12,
                'nama_pengguna' => 'dosen5',
                'email'         => 'dosen5@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 13,
                'nama_pengguna' => 'dosen6',
                'email'         => 'dosen6@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 14,
                'nama_pengguna' => 'dosen7',
                'email'         => 'dosen7@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 15,
                'nama_pengguna' => 'dosen8',
                'email'         => 'dosen8@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 16,
                'nama_pengguna' => 'dosen9',
                'email'         => 'dosen9@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_pengguna'   => 17,
                'nama_pengguna' => 'dosen10',
                'email'         => 'dosen10@gmail.com',
                'kata_sandi'    => Crypt::encrypt('123'),
                'tipe'          => 'DOSEN',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ]);
    }
}