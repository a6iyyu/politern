<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SertifikasiPelatihan extends Seeder
{
    public function run(): void
    {
        $sertifikasi_pelatihan = [];
        for ($i = 1; $i <= 20; $i++) {
            $sertifikasi_pelatihan[] = [
                'id_sertifikasi_pelatihan'      => $i,
                'nama_sertifikasi_pelatihan'    => Factory::create()->jobTitle(),
                'nama_lembaga'                  => Factory::create()->company(),
                'deskripsi'                     => Factory::create()->text(),
                'tanggal_diterbitkan'           => Carbon::parse("2022-0$i-01"),
                'tanggal_kedaluwarsa'           => Carbon::parse("2027-0$i-01"),
                'bukti_pendukung'               => "https://example.com/bukti_pendukung$i",
                'created_at'                    => Carbon::now(),
                'updated_at'                    => Carbon::now(),
            ];
        }

        DB::table('sertifikasi_pelatihan')->insert($sertifikasi_pelatihan);
    }
}