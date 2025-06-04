<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Proyek extends Seeder
{
    public function run(): void
    {
        $proyek = [];
        for ($i = 1; $i <= 10; $i++) {
            $proyek[] = [
                'id_proyek'         => $i,
                'nama_proyek'       => Factory::create()->company(),
                'peran'             => Factory::create()->jobTitle(),
                'deskripsi'         => Factory::create()->text(),
                'tautan'            => "https://example.com/proyek$i",
                'alat'              => json_encode(Factory::create()->randomElements(['Laravel', 'Figma', 'MySQL', 'React', 'Vue.js', 'Docker', 'Postman'], rand(1, 3))),
                'tanggal_mulai'     => Carbon::parse("202$i-01-01"),
                'tanggal_selesai'   => Carbon::parse("202$i-06-30"),
                'bukti_pendukung'   => "https://example.com/bukti$i",
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ];
        }

        DB::table('proyek')->insert($proyek);
    }
}