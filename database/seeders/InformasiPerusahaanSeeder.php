<?php

namespace Database\Seeders;

use App\Models\InformasiPerusahaan;
use Illuminate\Database\Seeder;

class InformasiPerusahaanSeeder extends Seeder
{
    /**
     * Buat data awal informasi perusahaan.
     */
    public function run(): void
    {
        InformasiPerusahaan::firstOrCreate(
            ['id' => 1],
            [
                'nama_perusahaan' => 'Berkah Cahaya Alfatih',
                'deskripsi' => 'Berkah Cahaya Alfatih adalah perusahaan yang bergerak di bidang pemasaran properti. Kami menyediakan berbagai pilihan properti terbaik untuk kebutuhan hunian maupun investasi Anda.',
                'visi' => 'Menjadi perusahaan pemasaran properti terpercaya dan terdepan yang memberikan solusi terbaik bagi masyarakat dalam memiliki hunian impian.',
                'misi' => "1. Menyediakan informasi properti yang lengkap, akurat, dan mudah diakses.\n2. Memberikan pelayanan yang profesional dan amanah kepada setiap konsumen.\n3. Menjalin kerjasama yang baik dengan pengembang dan pemilik properti.\n4. Memanfaatkan teknologi untuk memperluas jangkauan pemasaran properti.",
                'alamat' => 'Jl. Pramuka GG Kasturi, RT.12, Banjarmasin Timur',
                'telepon' => '081351540304',
                'whatsapp' => '081351540304',
                'email' => 'info@berkahcahayaalfatih.com',
                'jam_operasional' => 'Senin - Sabtu, 08:00 - 17:00 WITA',
                'link_instagram' => 'https://instagram.com/sumberberkahnur',
                'logo' => 'perusahaan/logo.jpg',
            ]
        );
    }
}
