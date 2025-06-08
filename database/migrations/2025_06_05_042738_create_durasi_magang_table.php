<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('durasi_magang', function (Blueprint $table) {
            $table->id('id_durasi_magang');
            $table->string('nama_durasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('durasi_magang');
    }
};