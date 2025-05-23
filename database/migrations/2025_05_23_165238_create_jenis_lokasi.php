<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jenis_lokasi', function (Blueprint $table) {
            $table->id('id_jenis_lokasi');
            $table->string('nama_jenis_lokasi')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jenis_lokasi');
    }
};
