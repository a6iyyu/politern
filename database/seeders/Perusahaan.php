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
                'nama'                => 'Gojek',
                'nib'                 => '1101230026145',
                'nomor_telepon'       => '08113232466',
                'email'               => 'hello@gojek.id',
                'website'             => 'https://www.gojek.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 2,
                'id_lokasi'           => 85,
                'nama'                => 'Telkom Indonesia',
                'nib'                 => '1101230026235',
                'nomor_telepon'       => '0811324032466',
                'email'               => 'hello@telkomindonesia.id',
                'website'             => 'https://www.telkomindonesia.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 3,
                'id_lokasi'           => 5,
                'nama'                => 'Kominfo',
                'nib'                 => '1101242426145',
                'nomor_telepon'       => '0811324021466',
                'email'               => 'hello@kominfo.id',
                'website'             => 'https://www.kominfo.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 4,
                'id_lokasi'           => 86,
                'nama'                => 'Bank Indonesia',
                'nib'                 => '1101242426335',
                'nomor_telepon'       => '0811324021416',
                'email'               => 'hello@bankind.id',
                'website'             => 'https://www.bankind.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 5,
                'id_lokasi'           => 96,
                'nama'                => 'Pertamina',
                'nib'                 => '1101242426745',
                'nomor_telepon'       => '0811324029676',
                'email'               => 'hello@pertamina.id',
                'website'             => 'https://www.pertamina.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 6,
                'id_lokasi'           => 27,
                'nama'                => 'Xynexis',
                'nib'                 => '1101242498145',
                'nomor_telepon'       => '0811332521466',
                'email'               => 'hello@xynexis.id',
                'website'             => 'https://www.xynexis.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 7,
                'id_lokasi'           => 27,
                'nama'                => 'AWS Indonesia',
                'nib'                 => '1101256726145',
                'nomor_telepon'       => '0811093021466',
                'email'               => 'hello@awsidn.id',
                'website'             => 'https://www.awsidn.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ],
            [
                'id_perusahaan_mitra' => 8,
                'id_lokasi'           => 39,
                'nama'                => 'Dicoding',
                'nib'                 => '1101242412145',
                'nomor_telepon'       => '0811311021466',
                'email'               => 'hello@dicoding.id',
                'website'             => 'https://www.dicoding.id/',
                'logo'                => 'storage/images/molca.avif',
                'status'              => 'AKTIF',
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
            ]
        ]);
    }
}