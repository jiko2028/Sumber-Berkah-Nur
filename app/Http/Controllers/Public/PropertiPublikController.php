<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\InformasiPerusahaan;
use App\Models\Kategori;
use App\Models\Properti;
use Illuminate\Http\Request;

class PropertiPublikController extends Controller
{
    /**
     * Tampilkan katalog properti publik (dengan search, filter, sort & pagination).
     */
    public function index(Request $request)
    {
        $query = Properti::with('kategori')->published();

        // Search kata kunci (judul, alamat, kota, kode)
        if ($request->filled('search')) {
            $query->cari($request->search);
        }

        // Filter Kategori
        if ($request->filled('kategori')) {
            $kategoriObj = Kategori::where('slug', $request->kategori)->first();
            if ($kategoriObj) {
                $query->where('kategori_id', $kategoriObj->id);
            }
        }

        // Filter Tipe Transaksi (jual / sewa)
        if ($request->filled('transaksi')) {
            $query->where('tipe_transaksi', $request->transaksi);
        }

        // Filter Status (tersedia / terjual / disewa / negosiasi)
        if ($request->filled('status')) {
            $query->where('status_properti', $request->status);
        }

        // Filter Rentang Harga
        if ($request->filled('min_harga')) {
            $query->where('harga', '>=', (float) $request->min_harga);
        }
        if ($request->filled('max_harga')) {
            $query->where('harga', '<=', (float) $request->max_harga);
        }

        // Urutan
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'harga_asc':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga_desc':
                $query->orderBy('harga', 'desc');
                break;
            case 'populer':
                $query->orderBy('dilihat', 'desc');
                break;
            case 'terbaru':
            default:
                $query->latest();
                break;
        }

        $properti = $query->paginate(9)->withQueryString();
        $kategoriList = Kategori::orderBy('nama_kategori')->get();
        $totalHasil = $properti->total();

        return view('public.properti.index', compact('properti', 'kategoriList', 'totalHasil'));
    }

    /**
     * Tampilkan detail informasi properti.
     */
    public function show(string $slug)
    {
        $properti = Properti::with(['kategori', 'galeri'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment jumlah views (dilihat)
        $properti->increment('dilihat');

        // Properti serupa (kategori sama, excluding properti saat ini)
        $propertiSerupa = Properti::with('kategori')
            ->published()
            ->where('kategori_id', $properti->kategori_id)
            ->where('id', '!=', $properti->id)
            ->latest()
            ->take(3)
            ->get();

        $perusahaan = InformasiPerusahaan::getData();

        return view('public.properti.detail', compact('properti', 'propertiSerupa', 'perusahaan'));
    }
}
