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
        Schema::create('pesan_kontak', function (Blueprint $table) {
            $table->id();
            $table->foreignId('properti_id')->nullable()->constrained('properti')->nullOnDelete();
            $table->string('nama', 100);
            $table->string('email', 100);
            $table->string('no_telepon', 20);
            $table->string('subjek', 150)->nullable();
            $table->text('pesan');
            $table->enum('status_baca', ['belum_dibaca', 'sudah_dibaca'])->default('belum_dibaca');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status_baca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_kontak');
    }
};
