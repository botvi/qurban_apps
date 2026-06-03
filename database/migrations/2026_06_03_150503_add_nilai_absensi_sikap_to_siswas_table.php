<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->unsignedTinyInteger('nilai_absensi')->nullable()->after('kelas')->comment('Nilai absensi 0-100');
            $table->unsignedTinyInteger('nilai_sikap')->nullable()->after('nilai_absensi')->comment('Nilai sikap 0-100');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn(['nilai_absensi', 'nilai_sikap']);
        });
    }
};
