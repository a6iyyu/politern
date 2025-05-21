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
        Schema::create('mahasiswa_minat_bidang', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_bidang');

            $table->primary(['id_mahasiswa', 'id_bidang']);

            $table->foreign('id_mahasiswa')
                ->references('id_mahasiswa')->on('mahasiswa')
                ->onDelete('cascade');

            $table->foreign('id_bidang')
                ->references('id_bidang')->on('bidang')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_minat_bidang');
    }
};
