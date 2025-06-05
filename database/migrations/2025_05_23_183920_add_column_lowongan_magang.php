<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bidang')->after('id_periode');
            $table->unsignedBigInteger('id_jenis_lokasi')->after('id_bidang');

            $table->foreign('id_bidang')->references('id_bidang')->on('bidang');
            $table->foreign('id_jenis_lokasi')->references('id_jenis_lokasi')->on('jenis_lokasi');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->dropColumn('id_bidang');
            $table->dropColumn('id_jenis_lokasi');
        });
    }
};