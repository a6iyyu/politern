<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kompetensi_mahasiswa', function (Blueprint $table) {
            $table->id('id_kompetensi');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->enum('kategori', ['BIDANG KEAHLIAN', 'SERTIFIKASI', 'PENGALAMAN']);
            $table->string('nama');
            $table->enum('level', ['PEMULA', 'MENENGAH', 'MAHIR']);
            $table->text('dokumen_sertifikasi');
            $table->timestamps();
            
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kompetensi_mahasiswa');
    }
};