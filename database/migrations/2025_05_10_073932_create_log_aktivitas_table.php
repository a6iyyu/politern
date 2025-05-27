<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('id_log');
            $table->unsignedBigInteger('id_magang');
            $table->text('deskripsi');
            $table->enum('status', ['DISETUJUI', 'DITOLAK', 'MENUNGGU']);
            $table->timestamps();

            $table->foreign('id_magang')->references('id_magang')->on('magang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};