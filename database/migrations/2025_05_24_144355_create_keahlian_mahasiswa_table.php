<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keahlian_mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mahasiswa');
            $table->unsignedBigInteger('id_keahlian');
            $table->timestamps();
            $table->primary(['id_mahasiswa', 'id_keahlian']);

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_keahlian')->references('id_keahlian')->on('keahlian');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keahlian_mahasiswa');
    }
};