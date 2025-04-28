<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perusahaan_mitra', function (Blueprint $table) {
            $table->id('id_perusahaan_mitra');
            $table->string('nama');
            $table->string('nib')->unique('nib');
            $table->string('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('nomor_telepon')->unique('nomor_telepon');
            $table->string('email')->unique('email');
            $table->string('website');
            $table->enum('bidang', ['INDUSTRI', 'KESEHATAN', 'KEUANGAN', 'KONSULTASI', 'KREATIF', 'PENDIDIKAN', 'PSDM', 'TEKNOLOGI', 'SIPIL']);
            $table->enum('status', ['AKTIF', 'TIDAK AKTIF'])->default('AKTIF');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};