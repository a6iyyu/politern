<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('preferensi_durasi_mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_durasi_magang');
            $table->timestamps();
            $table->primary(['id_mahasiswa', 'id_durasi_magang']);

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_durasi_magang')->references('id_durasi_magang')->on('durasi_magang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('preferensi_durasi_mahasiswa');
    }
};