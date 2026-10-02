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
        Schema::create('properti', function (Blueprint $table) {
            $table->id();
            $table->string('kode_properti', 20)->unique();
            $table->foreignId('kategori_id')->constrained('kategori')->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('judul', 150);
            $table->string('slug', 200)->unique();
            $table->text('deskripsi');
            $table->decimal('harga', 15, 2);
            $table->enum('status_properti', ['tersedia', 'terjual', 'disewa', 'negosiasi'])->default('tersedia');
            $table->enum('tipe_transaksi', ['jual', 'sewa'])->default('jual');
            $table->string('alamat', 255);
            $table->string('kota', 100);
            $table->string('provinsi', 100);
            $table->integer('luas_tanah')->unsigned();
            $table->integer('luas_bangunan')->unsigned()->nullable();
            $table->string('tipe_bangunan', 50)->nullable();
            $table->integer('jumlah_lantai')->unsigned()->nullable()->default(1);
            $table->integer('jumlah_kamar_tidur')->unsigned()->nullable();
            $table->integer('jumlah_kamar_mandi')->unsigned()->nullable();
            $table->integer('carport')->unsigned()->nullable();
            $table->string('sumber_air', 50)->nullable();
            $table->string('daya_listrik', 50)->nullable();
            $table->string('dp_info', 100)->nullable();
            $table->text('promo')->nullable();
            $table->text('spesifikasi_bangunan')->nullable();
            $table->json('fasilitas')->nullable();
            $table->string('foto_utama', 255)->nullable();
            $table->boolean('is_unggulan')->default(false);
            $table->boolean('is_publish')->default(false);
            $table->integer('dilihat')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Indexes for common queries
            $table->index('status_properti');
            $table->index('tipe_transaksi');
            $table->index('kota');
            $table->index('provinsi');
            $table->index('is_unggulan');
            $table->index('is_publish');
            $table->index('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properti');
    }
};
