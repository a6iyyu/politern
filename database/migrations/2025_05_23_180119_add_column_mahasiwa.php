<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bidang')->nullable()->after('id_prodi');
            $table->unsignedBigInteger('id_keahlian')->nullable()->after('id_bidang');
            $table->unsignedBigInteger('id_lokasi')->nullable()->after('id_keahlian');
            $table->unsignedBigInteger('id_jenis_lokasi')->nullable()->after('id_lokasi');
            $table->unsignedBigInteger('id_pengalaman')->nullable()->after('id_jenis_lokasi');
            $table->unsignedBigInteger('id_sertifikasi_pelatihan')->nullable()->after('id_pengalaman');
            $table->unsignedBigInteger('id_proyek')->nullable()->after('id_sertifikasi_pelatihan');

            $table->foreign('id_bidang')->references('id_bidang')->on('bidang');
            $table->foreign('id_keahlian')->references('id_keahlian')->on('keahlian');
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasi');
            $table->foreign('id_jenis_lokasi')->references('id_jenis_lokasi')->on('jenis_lokasi');
            $table->foreign('id_pengalaman')->references('id_pengalaman')->on('pengalaman');
            $table->foreign('id_sertifikasi_pelatihan')->references('id_sertifikasi_pelatihan')->on('sertifikasi_pelatihan');
            $table->foreign('id_proyek')->references('id_proyek')->on('proyek');
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('id_bidang');
            $table->dropColumn('id_keahlian');
            $table->dropColumn('id_lokasi');
            $table->dropColumn('id_jenis_lokasi');
            $table->dropColumn('id_pengalaman');
            $table->dropColumn('id_sertifikasi_pelatihan');
            $table->dropColumn('id_proyek');
        });
    }
};
