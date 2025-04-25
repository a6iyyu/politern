<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id('id_perusahaan');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nib')->unique('nib');
            $table->string('nama_perusahaan');
            $table->enum('bidang', ['INDUSTRI', 'KESEHATAN', 'KEUANGAN', 'KONSULTASI', 'KREATIF', 'PENDIDIKAN', 'PSDM', 'TEKNOLOGI', 'SIPIL']);
            $table->string('alamat');
            $table->string('email')->unique('email');
            $table->string('nomor_telepon')->unique('nomor_telepon');
            $table->enum('status', ['AKTIF', 'TIDAK AKTIF'])->default('AKTIF');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perusahaan');
    }
};