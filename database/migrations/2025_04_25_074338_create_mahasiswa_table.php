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
            $table->string('nama_lengkap');
            $table->year('angkatan');
            $table->integer('semester');
            $table->text('deskripsi')->nullable();
            $table->float('ipk');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->text('cv');
            $table->decimal('nilai_tes')->nullable();
            $table->decimal('gaji', 12, 2)->nullable();
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