<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jenis_magang')->after('id_jenis_lokasi');
            $table->unsignedBigInteger('id_durasi_magang')->after('id_jenis_magang');

            $table->foreign('id_jenis_magang')->references('id_jenis_magang')->on('jenis_magang');
            $table->foreign('id_durasi_magang')->references('id_durasi_magang')->on('durasi_magang');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->dropColumn('id_jenis_magang');
            $table->dropColumn('id_durasi_magang');
        });
    }
};