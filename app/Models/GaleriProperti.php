<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GaleriProperti extends Model
{
    protected $table = 'galeri_properti';

    protected $fillable = [
        'properti_id',
        'gambar',
        'keterangan',
        'urutan',
    ];

    /**
     * Relasi: Galeri milik satu Properti.
     */
    public function properti(): BelongsTo
    {
        return $this->belongsTo(Properti::class, 'properti_id');
    }
}
