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
        Schema::table('informasi_perusahaan', function (Blueprint $table) {
            $table->integer('stat_1_number')->default(100)->after('overlay_terbaru_opacity');
            $table->string('stat_1_suffix', 20)->default('+')->after('stat_1_number');
            $table->string('stat_1_label', 100)->default('Pilihan Properti Premium')->after('stat_1_suffix');

            $table->integer('stat_2_number')->default(100)->after('stat_1_label');
            $table->string('stat_2_suffix', 20)->default('%')->after('stat_2_number');
            $table->string('stat_2_label', 100)->default('Legalitas & Sertifikat Aman')->after('stat_2_suffix');

            $table->integer('stat_3_number')->default(500)->after('stat_2_label');
            $table->string('stat_3_suffix', 20)->default('+')->after('stat_3_number');
            $table->string('stat_3_label', 100)->default('Konsumen & Keluarga Puas')->after('stat_3_suffix');

            $table->integer('stat_4_number')->default(10)->after('stat_3_label');
            $table->string('stat_4_suffix', 20)->default(' Thn+')->after('stat_4_number');
            $table->string('stat_4_label', 100)->default('Pengalaman Real Estate')->after('stat_4_suffix');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi_perusahaan', function (Blueprint $table) {
            $table->dropColumn([
                'stat_1_number', 'stat_1_suffix', 'stat_1_label',
                'stat_2_number', 'stat_2_suffix', 'stat_2_label',
                'stat_3_number', 'stat_3_suffix', 'stat_3_label',
                'stat_4_number', 'stat_4_suffix', 'stat_4_label',
            ]);
        });
    }
};
