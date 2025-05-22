<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Magang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('magang')->insert([
            'id_magang' => 1,
            'id_pengajuan_magang' => 1,
            'id_dosen_pembimbing' => 1,
            'status' => 'AKTIF',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
