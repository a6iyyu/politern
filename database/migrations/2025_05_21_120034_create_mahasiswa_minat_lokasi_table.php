<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa_minat_lokasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_lokasi');

            $table->primary(['id_mahasiswa', 'id_lokasi']);

            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')->on('mahasiswa')
                ->onDelete('cascade');

            $table->foreign('id_lokasi')
                ->references('id_lokasi')->on('lokasi')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_minat_lokasi');
    }
};
