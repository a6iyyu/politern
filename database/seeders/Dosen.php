<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Dosen extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 11; $i++) {
            $data[] = [
                'id_dosen'          => $i,
                'id_pengguna'       => $i + 6,
                'nip'               => "19781231201903" . str_pad((string) $i, 2, '0', STR_PAD_LEFT),
                'nama'              => Factory::create()->name(),
                'nomor_telepon'     => "0812345678$i",
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
        }

        DB::table('dosen')->insert($data);
    }
}