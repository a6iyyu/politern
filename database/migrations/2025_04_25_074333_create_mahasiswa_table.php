<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_prodi');
            $table->string('nim')->unique('nim');
            $table->string('foto_profil')->nullable();
            $table->string('nama_lengkap');
            $table->year('angkatan');
            $table->integer('semester');
            $table->text('deskripsi')->nullable();
            $table->float('ipk')->default(0.0);
            $table->string('alamat')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->text('cv')->nullable();
            $table->enum('gaji', ['PAID', 'UNPAID'])->default('UNPAID');
            $table->enum('status', ['BELUM MAGANG', 'DALAM PROSES', 'SEDANG MAGANG', 'SELESAI'])->default('BELUM MAGANG');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
            $table->foreign('id_prodi')->references('id_prodi')->on('program_studi');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};