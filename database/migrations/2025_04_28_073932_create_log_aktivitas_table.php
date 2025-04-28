<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_kegiatan_magang');
            $table->date('tanggal');
            $table->text('deskripsi');
            $table->integer('durasi');
            $table->enum('status', ['DRAF', 'DIKIRIM', 'DISETUJUI']);
            $table->timestamps();

            $table->foreign('id_kegiatan_magang')->references('id_kegiatan_magang')->on('kegiatan_magang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};