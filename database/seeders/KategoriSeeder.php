<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Buat kategori properti default.
     */
    public function run(): void
    {
        $kategoriList = [
            [
                'nama_kategori' => 'Rumah',
                'deskripsi' => 'Properti hunian untuk tempat tinggal keluarga.',
            ],
            [
                'nama_kategori' => 'Ruko',
                'deskripsi' => 'Rumah toko untuk keperluan usaha dan hunian.',
            ],
            [
                'nama_kategori' => 'Tanah Kavling',
                'deskripsi' => 'Tanah siap bangun yang sudah dikavling.',
            ],
            [
                'nama_kategori' => 'Apartemen',
                'deskripsi' => 'Unit hunian dalam gedung bertingkat.',
            ],
            [
                'nama_kategori' => 'Gudang',
                'deskripsi' => 'Bangunan untuk penyimpanan barang atau keperluan industri.',
            ],
        ];

        foreach ($kategoriList as $kategori) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $kategori['nama_kategori']],
                $kategori
            );
        }
    }
}
