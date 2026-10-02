<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiPerusahaan extends Model
{
    protected $table = 'informasi_perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'logo',
        'bg_properti_terbaru',
        'bg_hero',
        'overlay_hero_opacity',
        'overlay_terbaru_opacity',
        'stat_1_number',
        'stat_1_suffix',
        'stat_1_label',
        'stat_2_number',
        'stat_2_suffix',
        'stat_2_label',
        'stat_3_number',
        'stat_3_suffix',
        'stat_3_label',
        'stat_4_number',
        'stat_4_suffix',
        'stat_4_label',
        'deskripsi',
        'visi',
        'misi',
        'alamat',
        'telepon',
        'whatsapp',
        'email',
        'jam_operasional',
        'link_instagram',
        'link_facebook',
        'link_youtube',
        'peta_lokasi',
    ];

    /**
     * Ambil data perusahaan (singleton — selalu row pertama).
     * Jika belum ada, buat row baru dengan data default.
     */
    public static function getData(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            ['nama_perusahaan' => 'Berkah Cahaya Alfatih']
        );
    }
}
