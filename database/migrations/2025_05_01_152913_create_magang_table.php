<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('magang', function (Blueprint $table) {
            $table->id('id_magang');
            $table->unsignedBigInteger('id_pengajuan_magang'); // pengajuan yang disetujui
            $table->unsignedBigInteger('id_dosen_pembimbing'); // baru dipilih di sini
            $table->enum('status', ['AKTIF', 'SELESAI'])->default('AKTIF');
            $table->timestamps();

            $table->foreign('id_pengajuan_magang')->references('id_pengajuan_magang')->on('pengajuan_magang');
            $table->foreign('id_dosen_pembimbing')->references('id_dosen_pembimbing')->on('dosen_pembimbing');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('magang');
    }
};
