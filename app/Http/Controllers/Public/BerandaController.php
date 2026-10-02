<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\InformasiPerusahaan;
use App\Models\Kategori;
use App\Models\Properti;

class BerandaController extends Controller
{
    /**
     * Tampilkan halaman utama (beranda).
     */
    public function index()
    {
        // Properti unggulan (hanya yang dipublish & marked unggulan)
        $propertiUnggulan = Properti::with('kategori')
            ->published()
            ->unggulan()
            ->latest()
            ->take(3)
            ->get();

        // If not enough unggulan, fallback to latest published
        if ($propertiUnggulan->count() < 3) {
            $propertiUnggulan = Properti::with('kategori')
                ->published()
                ->latest()
                ->take(3)
                ->get();
        }

        // Properti Terbaru (6 properti terbaru dipublish)
        $propertiTerbaru = Properti::with('kategori')
            ->published()
            ->latest()
            ->take(6)
            ->get();

        // Kategori dengan jumlah properti yang dipublish
        $kategoriList = Kategori::withCount(['properti' => function ($q) {
            $q->published();
        }])->get();

        // Data informasi perusahaan
        $perusahaan = InformasiPerusahaan::getData();

        // Total statistik ringkas untuk counter
        $totalTersedia = Properti::published()->byStatus('tersedia')->count();

        return view('public.beranda', compact('propertiUnggulan', 'propertiTerbaru', 'kategoriList', 'perusahaan', 'totalTersedia'));
    }
}
