<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sertifikasi_pelatihan_mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa_sertifikasi_pelatihan');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_sertifikasi_pelatihan');
            
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->foreign('id_sertifikasi_pelatihan')->references('id_sertifikasi_pelatihan')->on('sertifikasi_pelatihan')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikasi_pelatihan_mahasiswa');
    }
};