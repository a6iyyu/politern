<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('preferensi_lokasi_magang', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_lokasi');
            $table->timestamps();
            $table->primary(['id_mahasiswa', 'id_lokasi']);

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preferensi_lokasi_magang');
    }
};