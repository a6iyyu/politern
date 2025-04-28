<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id_pengguna');
            $table->string('nama_pengguna')->unique('nama_pengguna');
            $table->string('email');
            $table->string('kata_sandi');
            $table->enum('tipe', ['ADMIN', 'DOSEN PEMBIMBING', 'MAHASISWA']);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};