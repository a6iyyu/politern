<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bobot_kriteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_mahasiswa');
            $table->tinyInteger('prioritas_keahlian')->nullable()->comment('Prioritas 1-6 untuk kriteria keahlian');
            $table->tinyInteger('prioritas_lokasi')->nullable()->comment('Prioritas 1-6 untuk kriteria lokasi');
            $table->tinyInteger('prioritas_jenis_lokasi')->nullable()->comment('Prioritas 1-6 untuk kriteria jenis lokasi');
            $table->tinyInteger('prioritas_bidang')->nullable()->comment('Prioritas 1-6 untuk kriteria bidang');
            $table->tinyInteger('prioritas_durasi')->nullable()->comment('Prioritas 1-6 untuk kriteria durasi');
            $table->tinyInteger('prioritas_gaji')->nullable()->comment('Prioritas 1-6 untuk kriteria gaji');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa')->onDelete('cascade');

            // Unique constraint - setiap mahasiswa hanya punya satu set bobot
            $table->unique('id_mahasiswa');
        });

        // Tambahkan CHECK constraint manual via raw SQL
        DB::statement("ALTER TABLE bobot_kriteria ADD CONSTRAINT chk_keahlian CHECK (prioritas_keahlian BETWEEN 1 AND 6 OR prioritas_keahlian IS NULL)");
        DB::statement("ALTER TABLE bobot_kriteria ADD CONSTRAINT chk_lokasi CHECK (prioritas_lokasi BETWEEN 1 AND 6 OR prioritas_lokasi IS NULL)");
        DB::statement("ALTER TABLE bobot_kriteria ADD CONSTRAINT chk_jenis_lokasi CHECK (prioritas_jenis_lokasi BETWEEN 1 AND 6 OR prioritas_jenis_lokasi IS NULL)");
        DB::statement("ALTER TABLE bobot_kriteria ADD CONSTRAINT chk_bidang CHECK (prioritas_bidang BETWEEN 1 AND 6 OR prioritas_bidang IS NULL)");
        DB::statement("ALTER TABLE bobot_kriteria ADD CONSTRAINT chk_durasi CHECK (prioritas_durasi BETWEEN 1 AND 6 OR prioritas_durasi IS NULL)");
        DB::statement("ALTER TABLE bobot_kriteria ADD CONSTRAINT chk_gaji CHECK (prioritas_gaji BETWEEN 1 AND 6 OR prioritas_gaji IS NULL)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_kriteria');
    }
};
