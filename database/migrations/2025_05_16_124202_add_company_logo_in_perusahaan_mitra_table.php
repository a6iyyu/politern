<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('perusahaan_mitra', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('website');
            $table->string('email')->nullable()->change();
            $table->string('website')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('perusahaan_mitra', function (Blueprint $table) {
            $table->dropColumn('logo');
            $table->string('email')->nullable(false)->change();
            $table->string('website')->nullable(false)->change();
        });
    }
};