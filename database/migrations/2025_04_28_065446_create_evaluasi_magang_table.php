<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluasi_magang', function (Blueprint $table) {
            $table->id('id_evaluasi');
            $table->unsignedBigInteger('id_pengajuan_magang');
            $table->unsignedBigInteger('id_dosen_pembimbing');
            $table->date('tanggal_evaluasi');
            $table->string('kriteria_penilaian');
            $table->json('nilai');                  // This will be an array of integer.
            $table->text('komentar');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluasi_magang');
    }
};