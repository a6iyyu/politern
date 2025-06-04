<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('proyek_mahasiswa', function (Blueprint $table) {
            $table->id('id_proyek_mahasiswa');
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_proyek');

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyek_mahasiswa');
    }
};