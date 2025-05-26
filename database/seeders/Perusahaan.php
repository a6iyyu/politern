<?php

declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Perusahaan extends Seeder
{
    public function run(): void
    {
        $destination = storage_path('app/public/images');
        $source = public_path('img/molca.avif');

        if (!File::exists($destination)) File::makeDirectory($destination, 0755, true);
        if (File::exists($source)) File::copy($source, "$destination/molca.avif");

        DB::table('perusahaan_mitra')->insert([
            [
                'id_perusahaan_mitra' => 1,
                'id_lokasi'           => 1,
                'nama'                => 'Molca Teknologi Nusantara',
                'nib'                 => '1101230026145',
                'nomor_telepon'       => '0811324066',
                'email'               => 'hello@molca.id',
                'website'             => 'https://www.molca.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ]
        ]);
    }
}