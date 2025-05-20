<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenPembimbing extends Seeder
{
    public function run(): void
    {
        DB::table('dosen_pembimbing')->insert([
            [
                'id_dosen_pembimbing'   => 1,
                'id_pengguna'           => 3,
                'nip'                   => '19870531201101',
                'nama'                  => 'Dosen Pembimbing',
                'bidang_keahlian'       => 'Matematika',
                'jumlah_bimbingan'      => 2,
                'nomor_telepon'         => '081234567890',
                'created_at'            => Carbon::now(),
                'updated_at'            => Carbon::now(),
            ]
        ]);
    }
}