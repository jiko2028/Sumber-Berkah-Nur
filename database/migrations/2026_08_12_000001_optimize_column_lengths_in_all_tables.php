<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Table users
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 50)->change();
            $table->string('username', 30)->change();
            $table->string('email', 30)->change();
        });

        // 2. Table kategori
        Schema::table('kategori', function (Blueprint $table) {
            $table->string('nama_kategori', 50)->change();
            $table->string('slug', 100)->change();
        });

        // 3. Table properti
        Schema::table('properti', function (Blueprint $table) {
            $table->string('kode_properti', 50)->change();
            $table->string('judul', 50)->change();
            $table->string('slug', 100)->change();
            $table->string('kota', 50)->change();
            $table->string('provinsi', 50)->change();
            $table->string('tipe_bangunan', 30)->nullable()->change();
            $table->string('sumber_air', 30)->nullable()->change();
            $table->string('dp_info', 50)->nullable()->change();
        });

        // 4. Table galeri_properti
        Schema::table('galeri_properti', function (Blueprint $table) {
            $table->string('keterangan', 50)->nullable()->change();
        });

        // 5. Table pesan_kontak
        Schema::table('pesan_kontak', function (Blueprint $table) {
            $table->string('nama', 30)->change();
            $table->string('email', 30)->change();
            $table->string('no_telepon', 13)->change();
            $table->string('subjek', 100)->nullable()->change();
        });

        // 6. Table informasi_perusahaan
        Schema::table('informasi_perusahaan', function (Blueprint $table) {
            $table->string('nama_perusahaan', 50)->change();
            $table->string('telepon', 15)->nullable()->change();
            $table->string('whatsapp', 13)->nullable()->change();
            $table->string('email', 30)->nullable()->change();
            $table->string('jam_operasional', 50)->nullable()->change();
            $table->string('link_instagram', 100)->nullable()->change();
            $table->string('link_facebook', 100)->nullable()->change();
            $table->string('link_youtube', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 100)->change();
            $table->string('username', 50)->change();
            $table->string('email', 100)->change();
        });

        Schema::table('kategori', function (Blueprint $table) {
            $table->string('nama_kategori', 100)->change();
            $table->string('slug', 150)->change();
        });

        Schema::table('properti', function (Blueprint $table) {
            $table->string('kode_properti', 20)->change();
            $table->string('judul', 150)->change();
            $table->string('slug', 200)->change();
            $table->string('kota', 100)->change();
            $table->string('provinsi', 100)->change();
            $table->string('tipe_bangunan', 50)->nullable()->change();
            $table->string('sumber_air', 50)->nullable()->change();
            $table->string('dp_info', 100)->nullable()->change();
        });

        Schema::table('galeri_properti', function (Blueprint $table) {
            $table->string('keterangan', 150)->nullable()->change();
        });

        Schema::table('pesan_kontak', function (Blueprint $table) {
            $table->string('nama', 100)->change();
            $table->string('email', 100)->change();
            $table->string('no_telepon', 20)->change();
            $table->string('subjek', 150)->nullable()->change();
        });

        Schema::table('informasi_perusahaan', function (Blueprint $table) {
            $table->string('nama_perusahaan', 150)->change();
            $table->string('telepon', 20)->nullable()->change();
            $table->string('whatsapp', 20)->nullable()->change();
            $table->string('email', 100)->nullable()->change();
            $table->string('jam_operasional', 100)->nullable()->change();
            $table->string('link_instagram', 150)->nullable()->change();
            $table->string('link_facebook', 150)->nullable()->change();
            $table->string('link_youtube', 150)->nullable()->change();
        });
    }
};
