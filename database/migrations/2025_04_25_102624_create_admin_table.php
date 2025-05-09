
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id('id_admin');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nip')->unique('nip');
            $table->string('nama');
            $table->string('nomor_telepon')->unique('nomor_telepon');
            $table->string('jabatan');
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
