<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lowongan_magang', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->unsignedBigInteger('id_perusahaan_mitra');
            $table->unsignedBigInteger('id_periode');
            $table->text('deskripsi');
            $table->integer('kuota');
            $table->enum('gaji', ['PAID', 'UNPAID']);
            $table->date('tanggal_mulai_pendaftaran');
            $table->date('tanggal_selesai_pendaftaran');
            $table->enum('status', ['DIBUKA', 'DITUTUP']);
            $table->timestamps();

            $table->foreign('id_periode')->references('id_periode')->on('periode_magang');
            $table->foreign('id_perusahaan_mitra')->references('id_perusahaan_mitra')->on('perusahaan_mitra');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_magang');
    }
};