<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('dosen_pembimbing');
        Schema::create('dosen_pembimbing', function (Blueprint $table) {
            $table->id('id_dosen_pembimbing');
            $table->unsignedBigInteger('id_dosen');
            $table->integer('jumlah_bimbingan');
            $table->timestamps();

            $table->foreign('id_dosen')->references('id_dosen')->on('dosen');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen_pembimbing');
    }
};