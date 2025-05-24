<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bidang_mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_bidang');
            $table->timestamps();
            $table->primary(['id_mahasiswa', 'id_bidang']);

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_bidang')->references('id_bidang')->on('bidang');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bidang_mahasiswa');
    }
};