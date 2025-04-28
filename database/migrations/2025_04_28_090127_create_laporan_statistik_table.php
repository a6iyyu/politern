<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('laporan_statistik', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_periode');
            $table->string('judul');
            $table->enum('jenis_laporan', ['PESERTA', 'PENEMPATAN']);
            $table->json('data_statistik');
            $table->timestamps();

            $table->foreign('id_periode')->references('id_periode')->on('periode_magang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_statistik');
    }
};