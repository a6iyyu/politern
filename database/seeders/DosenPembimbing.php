<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenPembimbing extends Seeder
{
    public function run(): void
    {
        DB::table('dosen_pembimbing')->insert([
            'id_dosen_pembimbing' => 1,
            'id_dosen'            => 1,
            'jumlah_bimbingan'    => 5,
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);
    }
}