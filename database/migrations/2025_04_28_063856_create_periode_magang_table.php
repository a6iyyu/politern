<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periode_magang', function (Blueprint $table) {
            $table->id('id_periode');
            $table->string('nama_periode');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['AKTIF', 'SELESAI']);
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periode_magang');
    }
};