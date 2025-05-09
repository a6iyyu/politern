<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->string('gaji_minimal')->nullable()->after('lokasi');
            $table->string('gaji_maksimal')->nullable()->after('gaji_minimal');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan_magang', function (Blueprint $table) {
            $table->dropColumn(['gaji_minimal', 'gaji_maksimal']);
        });
    }
};