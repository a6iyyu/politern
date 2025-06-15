<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Dosen extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'id_dosen'      => 1,
                'id_pengguna'   => 7,
                'nip'           => '197801012001031001',
                'nama'          => 'Dr. Andi Setiawan',
                'nomor_telepon' => '081234567801',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 2,
                'id_pengguna'   => 8,
                'nip'           => '197902022002041002',
                'nama'          => 'Prof. Siti Rahayu',
                'nomor_telepon' => '081234567802',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 3,
                'id_pengguna'   => 9,
                'nip'           => '198003032003051003',
                'nama'          => 'Dr. Bambang Santoso',
                'nomor_telepon' => '081234567803',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 4,
                'id_pengguna'   => 10,
                'nip'           => '198104042004061004',
                'nama'          => 'Ir. Lina Kusuma',
                'nomor_telepon' => '081234567804',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 5,
                'id_pengguna'   => 11,
                'nip'           => '198205052005071005',
                'nama'          => 'Dr. Iwan Gunawan',
                'nomor_telepon' => '081234567805',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 6,
                'id_pengguna'   => 12,
                'nip'           => '198306062006081006',
                'nama'          => 'Prof. Rina Marlina',
                'nomor_telepon' => '081234567806',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 7,
                'id_pengguna'   => 13,
                'nip'           => '198407072007091007',
                'nama'          => 'Dr. Yudi Prasetyo',
                'nomor_telepon' => '081234567807',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 8,
                'id_pengguna'   => 14,
                'nip'           => '198508082008101008',
                'nama'          => 'Dr. Lestari Handayani',
                'nomor_telepon' => '081234567808',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 9,
                'id_pengguna'   => 15,
                'nip'           => '198609092009111009',
                'nama'          => 'Ir. Denny Kurniawan',
                'nomor_telepon' => '081234567809',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 10,
                'id_pengguna'   => 16,
                'nip'           => '198710102010121010',
                'nama'          => 'Dr. Sri Wulandari',
                'nomor_telepon' => '081234567810',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'id_dosen'      => 11,
                'id_pengguna'   => 17,
                'nip'           => '198811112011011011',
                'nama'          => 'Dr. Arif Hidayat',
                'nomor_telepon' => '081234567811',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];

        DB::table('dosen')->insert($data);
    }
}