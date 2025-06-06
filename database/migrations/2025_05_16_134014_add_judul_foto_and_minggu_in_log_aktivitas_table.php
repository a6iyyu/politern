<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            $table->string('judul')->after('id_magang');
            $table->integer('minggu')->after('judul');
            $table->string('foto')->after('minggu')->nullable();
            $table->enum('status', ['MENUNGGU', 'DISETUJUI', 'DITOLAK'])->default('MENUNGGU')->nullable();
            $table->text('komentar')->after('status')->nullable();
            $table->timestamp('tanggal_evaluasi')->after('komentar')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('log_aktivitas', function (Blueprint $table) {
            $table->dropColumn(['judul', 'minggu', 'foto', 'status', 'komentar', 'tanggal_evaluasi']);
        });
    }
};