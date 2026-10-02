<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Properti extends Model
{
    use SoftDeletes;

    protected $table = 'properti';

    protected $fillable = [
        'kode_properti',
        'kategori_id',
        'user_id',
        'judul',
        'slug',
        'deskripsi',
        'harga',
        'status_properti',
        'tipe_transaksi',
        'alamat',
        'kota',
        'provinsi',
        'luas_tanah',
        'luas_bangunan',
        'tipe_bangunan',
        'jumlah_lantai',
        'jumlah_kamar_tidur',
        'jumlah_kamar_mandi',
        'carport',
        'sumber_air',
        'daya_listrik',
        'dp_info',
        'promo',
        'is_promo',
        'spesifikasi_bangunan',
        'fasilitas',
        'foto_utama',
        'is_unggulan',
        'is_publish',
        'dilihat',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'fasilitas' => 'array',
            'is_unggulan' => 'boolean',
            'is_publish' => 'boolean',
            'is_promo' => 'boolean',
            'harga' => 'decimal:2',
        ];
    }

    /**
     * Boot method — auto-generate slug dan kode_properti.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($properti) {
            // Auto-generate slug dari judul
            if (empty($properti->slug)) {
                $slug = Str::slug($properti->judul);
                $count = static::withTrashed()->where('slug', 'like', $slug . '%')->count();
                $properti->slug = $count > 0 ? "{$slug}-{$count}" : $slug;
            }

            // Auto-generate kode_properti (BCAF-0001, BCAF-0002, ...)
            if (empty($properti->kode_properti)) {
                $lastKode = static::withTrashed()
                    ->where('kode_properti', 'like', 'BCAF-%')
                    ->orderByDesc('kode_properti')
                    ->value('kode_properti');

                if ($lastKode) {
                    $lastNumber = (int) substr($lastKode, 5);
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 1;
                }

                $properti->kode_properti = 'BCAF-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            }
        });

        static::updating(function ($properti) {
            if ($properti->isDirty('judul')) {
                $slug = Str::slug($properti->judul);
                $count = static::withTrashed()
                    ->where('slug', 'like', $slug . '%')
                    ->where('id', '!=', $properti->id)
                    ->count();
                $properti->slug = $count > 0 ? "{$slug}-{$count}" : $slug;
            }
        });
    }

    /**
     * Format harga ke format Rupiah.
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Relasi: Properti milik satu Kategori.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi: Properti milik satu User (admin yang menginput).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi: Properti memiliki banyak foto galeri.
     */
    public function galeri(): HasMany
    {
        return $this->hasMany(GaleriProperti::class, 'properti_id')->orderBy('urutan');
    }

    /**
     * Relasi: Properti memiliki banyak pesan kontak.
     */
    public function pesanKontak(): HasMany
    {
        return $this->hasMany(PesanKontak::class, 'properti_id');
    }

    /**
     * Scope: Hanya properti yang dipublish.
     */
    public function scopePublished($query)
    {
        return $query->where('is_publish', true);
    }

    /**
     * Scope: Hanya properti unggulan.
     */
    public function scopeUnggulan($query)
    {
        return $query->where('is_unggulan', true);
    }

    /**
     * Scope: Filter berdasarkan status properti.
     */
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status_properti', $status);
    }

    /**
     * Scope: Filter berdasarkan kategori.
     */
    public function scopeByKategori($query, int $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    /**
     * Scope: Filter berdasarkan rentang harga.
     */
    public function scopeByHarga($query, ?float $min = null, ?float $max = null)
    {
        if ($min !== null) {
            $query->where('harga', '>=', $min);
        }
        if ($max !== null) {
            $query->where('harga', '<=', $max);
        }
        return $query;
    }

    /**
     * Scope: Filter berdasarkan kota.
     */
    public function scopeByKota($query, string $kota)
    {
        return $query->where('kota', $kota);
    }

    /**
     * Scope: Pencarian berdasarkan judul atau alamat.
     */
    public function scopeCari($query, string $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('judul', 'like', "%{$keyword}%")
              ->orWhere('alamat', 'like', "%{$keyword}%")
              ->orWhere('kota', 'like', "%{$keyword}%")
              ->orWhere('kode_properti', 'like', "%{$keyword}%");
        });
    }
}
