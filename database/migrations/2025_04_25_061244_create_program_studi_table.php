<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_studi', function (Blueprint $table) {
            $table->id('id_prodi');
            $table->integer('kode');
            $table->string('nama');
            $table->enum('jenjang', ['D2', 'D3', 'D4']);
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