<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Pengalaman extends Seeder
{
    public function run(): void
    {
        $pengalaman = [];
        for ($i = 1; $i <= 20; $i++) {
            $pengalaman[] = [
                'id_pengalaman'     => $i,
                'posisi'            => Factory::create()->jobTitle(),
                'nama_lembaga'      => 'PT. ' . Factory::create()->company(),
                'jenis_pengalaman'  => $i % 4 == 0 ? 'magang' : ($i % 3 == 0 ? 'kerja' : 'relawan'),
                'deskripsi'         => Factory::create()->text(),
                'tanggal_mulai'     => Carbon::parse("202$i-01-01"),
                'tanggal_selesai'   => Carbon::parse("202$i-06-30"),
                'bukti_pendukung'   => "https://example.com/bukti$i",
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
        }

        DB::table('pengalaman')->insert($pengalaman);
    }
}