<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Perusahaan extends Seeder
{
    public function run(): void
    {
        DB::table('perusahaan_mitra')->insert([
            [
                'id_perusahaan_mitra'   => 1,
                'nama'                  => 'Molca Teknologi Nusantara',
                'nib'                   => '1101230026145',
                'alamat'                => 'JAPFA Tower II Lt. 12',
                'kota'                  => 'Surabaya',
                'provinsi'              => 'Jawa Timur',
                'nomor_telepon'         => '0811324066',
                'email'                 => 'hello@molca.id',
                'website'               => 'https://www.molca.id/',
                'bidang'                => 'TEKNOLOGI',
                'status'                => 'AKTIF',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]
        ]);
    }
}