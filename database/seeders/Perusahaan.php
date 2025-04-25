<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Perusahaan extends Seeder
{
    public function run(): void
    {
        DB::table('perusahaan')->delete();
        DB::table('perusahaan')->insert([
            [
                'id_perusahaan' => 1,
                'id_pengguna' => 7,
                'nib' => '1101230026145',
                'nama_perusahaan' => 'Molca Teknologi Nusantara',
                'bidang' => 'TEKNOLOGI',
                'alamat' => 'JAPFA Tower II Lt. 12, Surabaya, East Java, Indonesia, 60271',
                'email' => 'hello@molca.id',
                'nomor_telepon' => '0811324066',
                'status' => 'AKTIF',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}