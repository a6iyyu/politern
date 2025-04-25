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
            $table->enum('tipe_pengguna', ['ADMIN', 'MAHASISWA', 'PERUSAHAAN']);
            $table->string('kata_sandi');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};