<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedBigInteger('nim')->unique()->nullable();
            $table->unsignedBigInteger('nip')->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->string('kata_sandi');
            $table->string('no_telepon', 14);
            $table->enum('tipe', ['admin', 'mahasiswa']);
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};