<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Admin extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->delete();
        DB::table('admin')->insert([
            [
                'id_admin' => 1,
                'id_pengguna' => 1,
                'nama_admin' => 'Administrator',
                'nip' => '19870531201101',
                'nomor_telepon' => '081234567890',
                'email' => 'admin@polinema.ac.id',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}