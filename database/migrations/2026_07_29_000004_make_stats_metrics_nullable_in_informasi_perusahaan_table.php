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
            $table->integer('stat_1_number')->nullable()->change();
            $table->string('stat_1_suffix', 20)->nullable()->change();
            $table->string('stat_1_label', 100)->nullable()->change();

            $table->integer('stat_2_number')->nullable()->change();
            $table->string('stat_2_suffix', 20)->nullable()->change();
            $table->string('stat_2_label', 100)->nullable()->change();

            $table->integer('stat_3_number')->nullable()->change();
            $table->string('stat_3_suffix', 20)->nullable()->change();
            $table->string('stat_3_label', 100)->nullable()->change();

            $table->integer('stat_4_number')->nullable()->change();
            $table->string('stat_4_suffix', 20)->nullable()->change();
            $table->string('stat_4_label', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
