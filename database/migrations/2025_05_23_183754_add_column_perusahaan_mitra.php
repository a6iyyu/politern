<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perusahaan_mitra', function (Blueprint $table) {
            $table->unsignedBigInteger('id_lokasi')->after('id_perusahaan_mitra');

            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi');
        });
    }

    public function down(): void
    {
        Schema::table('perusahaan_mitra', function (Blueprint $table) {
            $table->dropColumn('id_lokasi');
        });
    }
};
