<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('preferensi_jenis_lokasi_magang', function (Blueprint $table) {
            $table->id('id_preferensi_jenis_lokasi_magang');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_jenis_lokasi');

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->foreign('id_jenis_lokasi')->references('id_jenis_lokasi')->on('jenis_lokasi')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preferensi_jenis_lokasi_magang');
    }
};