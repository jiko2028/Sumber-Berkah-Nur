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
            $table->string('bg_hero', 255)->nullable()->after('bg_properti_terbaru');
            $table->unsignedTinyInteger('overlay_hero_opacity')->default(80)->after('bg_hero');
            $table->unsignedTinyInteger('overlay_terbaru_opacity')->default(85)->after('overlay_hero_opacity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasi_perusahaan', function (Blueprint $table) {
            $table->dropColumn(['bg_hero', 'overlay_hero_opacity', 'overlay_terbaru_opacity']);
        });
    }
};
