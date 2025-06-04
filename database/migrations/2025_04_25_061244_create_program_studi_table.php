<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->string('kode');
            $table->string('nama');
            $table->enum('jenjang', ['D1', 'D2', 'D3', 'D4', 'S2', 'S3']);
            $table->string('jurusan');
            $table->enum('status', ['AKTIF', 'NONAKTIF']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_studi');
    }
};