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
        Schema::table('properti', function (Blueprint $table) {
            $table->boolean('is_promo')->default(false)->after('promo');
        });

        // Set is_promo = true for existing properties with promo text
        \DB::table('properti')->whereNotNull('promo')->where('promo', '!=', '')->update(['is_promo' => true]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properti', function (Blueprint $table) {
            $table->dropColumn('is_promo');
        });
    }
};
