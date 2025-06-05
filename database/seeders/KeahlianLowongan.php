<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeahlianLowongan extends Seeder
{
    public function run(): void
    {
        DB::table('keahlian_lowongan')->insert([
            ['id_lowongan' => 1, 'id_keahlian' => 4],
            ['id_lowongan' => 1, 'id_keahlian' => 2],
            ['id_lowongan' => 1, 'id_keahlian' => 5],
            ['id_lowongan' => 2, 'id_keahlian' => 1],
            ['id_lowongan' => 2, 'id_keahlian' => 4],
            ['id_lowongan' => 3, 'id_keahlian' => 3],
            ['id_lowongan' => 3, 'id_keahlian' => 2],
            ['id_lowongan' => 3, 'id_keahlian' => 4],
        ]);
    }
}