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
        Schema::create('perusahaan_bidang', function (Blueprint $table) {
            $table->unsignedBigInteger('id_perusahaan_mitra');
            $table->unsignedBigInteger('id_bidang');

            $table->primary(['id_perusahaan_mitra', 'id_bidang']);

            $table->foreign('id_perusahaan_mitra')
                ->references('id_perusahaan_mitra')->on('perusahaan_mitra')
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
        Schema::dropIfExists('perusahaan_bidang');
    }
};
