<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesanKontak extends Model
{
    use SoftDeletes;

    protected $table = 'pesan_kontak';

    protected $fillable = [
        'properti_id',
        'nama',
        'email',
        'no_telepon',
        'subjek',
        'pesan',
        'status_baca',
    ];

    /**
     * Relasi: Pesan terkait satu Properti (opsional).
     */
    public function properti(): BelongsTo
    {
        return $this->belongsTo(Properti::class, 'properti_id');
    }

    /**
     * Scope: Pesan yang belum dibaca.
     */
    public function scopeBelumDibaca($query)
    {
        return $query->where('status_baca', 'belum_dibaca');
    }

    /**
     * Scope: Pesan yang sudah dibaca.
     */
    public function scopeSudahDibaca($query)
    {
        return $query->where('status_baca', 'sudah_dibaca');
    }

    /**
     * Tandai pesan sebagai sudah dibaca.
     */
    public function tandaiDibaca(): void
    {
        $this->update(['status_baca' => 'sudah_dibaca']);
    }

    /**
     * Tandai pesan sebagai belum dibaca.
     */
    public function tandaiBelumDibaca(): void
    {
        $this->update(['status_baca' => 'belum_dibaca']);
    }
}
