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
                'id_lokasi'           => 85,
                'nama'                => 'Perusahaan A',
                'nib'                 => '1101230026145',
                'nomor_telepon'       => '08113232466',
                'email'               => 'hello@perusahaanA.id',
                'website'             => 'https://www.perusahaanA.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 2,
                'id_lokasi'           => 85,
                'nama'                => 'Perusahaan B',
                'nib'                 => '1101230026235',
                'nomor_telepon'       => '0811324032466',
                'email'               => 'hello@perusahaanB.id',
                'website'             => 'https://www.perusahaanB.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 3,
                'id_lokasi'           => 5,
                'nama'                => 'Perusahaan C',
                'nib'                 => '1101242426145',
                'nomor_telepon'       => '0811324021466',
                'email'               => 'hello@perusahaanC.id',
                'website'             => 'https://www.perusahaanC.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ]
        ]);
    }
}