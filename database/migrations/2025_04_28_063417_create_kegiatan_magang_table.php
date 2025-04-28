<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kegiatan_magang', function (Blueprint $table) {
            $table->id('id_kegiatan_magang');
            $table->unsignedBigInteger('id_pengajuan');
            $table->unsignedBigInteger('id_periode');
            $table->unsignedBigInteger('id_dosen_pembimbing');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['BERLANGSUNG', 'SELESAI', 'BATAL'])->default('BERLANGSUNG');
            $table->float('nilai_akhir');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_magang');
    }
};