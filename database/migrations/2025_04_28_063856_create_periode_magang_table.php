<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periode_magang', function (Blueprint $table) {
            $table->id('id_periode');
            $table->enum('durasi', ['1 Bulan', '2 Bulan', '3 Bulan', '4 Bulan', '5 Bulan', '6 Bulan']);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('semester', ['GANJIL', 'GENAP']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periode_magang');
    }
};