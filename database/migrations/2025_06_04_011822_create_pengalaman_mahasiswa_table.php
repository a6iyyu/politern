<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengalaman_mahasiswa', function (Blueprint $table) {
            $table->id('id_pengalaman_mahasiswa');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_pengalaman');

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->cascadeOnDelete();
            $table->foreign('id_pengalaman')->references('id_pengalaman')->on('pengalaman')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengalaman_mahasiswa');
    }
};