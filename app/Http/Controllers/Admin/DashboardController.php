<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\PesanKontak;
use App\Models\Properti;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard dengan ringkasan statistik.
     */
    public function index()
    {
        $stats = [
            'total_properti' => Properti::count(),
            'properti_tersedia' => Properti::where('status_properti', 'tersedia')->count(),
            'properti_terjual' => Properti::where('status_properti', 'terjual')->count(),
            'properti_disewa' => Properti::where('status_properti', 'disewa')->count(),
            'properti_negosiasi' => Properti::where('status_properti', 'negosiasi')->count(),
            'total_kategori' => Kategori::count(),
            'pesan_belum_dibaca' => PesanKontak::belumDibaca()->count(),
            'total_pesan' => PesanKontak::count(),
            'total_views' => Properti::sum('dilihat'),
        ];

        // 5 properti terbaru
        $propertiTerbaru = Properti::with('kategori')
            ->latest()
            ->take(5)
            ->get();

        // 5 pesan terbaru belum dibaca
        $pesanTerbaru = PesanKontak::belumDibaca()
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'propertiTerbaru', 'pesanTerbaru'));
    }
}
