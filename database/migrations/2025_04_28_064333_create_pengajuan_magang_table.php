<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengajuan_magang', function (Blueprint $table) {
            $table->id('id_pengajuan_magang');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_lowongan');
            $table->enum('status', ['MENUNGGU', 'DISETUJUI', 'DITOLAK'])->default('MENUNGGU');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongan_magang');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_magang');
    }
};