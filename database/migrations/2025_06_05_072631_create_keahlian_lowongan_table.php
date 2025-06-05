<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keahlian_lowongan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_lowongan');
            $table->unsignedBigInteger('id_keahlian');
            $table->timestamps();
            $table->primary(['id_lowongan', 'id_keahlian']);

            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongan_magang');
            $table->foreign('id_keahlian')->references('id_keahlian')->on('keahlian');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keahlian_lowongan');
    }
};