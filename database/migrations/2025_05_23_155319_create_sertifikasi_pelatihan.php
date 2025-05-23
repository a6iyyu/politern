<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sertifikasi_pelatihan', function (Blueprint $table) {
            $table->id('id_sertifikasi_pelatihan');
            $table->string('nama_sertifikasi_pelatihan');
            $table->string('nama_lembaga');
            $table->string('deskripsi')->nullable();
            $table->date('tanggal_diterbitkan')->nullable();
            $table->date('tanggal_kedaluwarsa')->nullable();
            $table->string('bukti_pendukung')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sertifikasi_pelatihan');
    }
};
