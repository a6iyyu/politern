<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dosen_pembimbing', function (Blueprint $table) {
            $table->id('id_dosen_pembimbing');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nip', 18);
            $table->string('nama');
            $table->string('bidang_keahlian');
            $table->integer('jumlah_bimbingan');
            $table->string('nomor_telepon');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_pembimbing');
    }
};