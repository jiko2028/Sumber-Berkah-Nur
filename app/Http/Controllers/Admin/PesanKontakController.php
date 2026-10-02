<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\Request;

class PesanKontakController extends Controller
{
    /**
     * Tampilkan daftar pesan masuk.
     */
    public function index(Request $request)
    {
        $query = PesanKontak::with('properti');

        // Filter status baca
        if ($request->filled('status')) {
            $query->where('status_baca', $request->status);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subjek', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $pesan = $query->latest()->paginate(15)->withQueryString();

        return view('admin.pesan.index', compact('pesan'));
    }

    /**
     * Tampilkan detail pesan & tandai sebagai sudah dibaca.
     */
    public function show(PesanKontak $pesan)
    {
        // Otomatis tandai sudah dibaca
        if ($pesan->status_baca === 'belum_dibaca') {
            $pesan->tandaiDibaca();
        }

        $pesan->load('properti');

        return view('admin.pesan.show', compact('pesan'));
    }

    /**
     * Toggle status baca.
     */
    public function toggleBaca(PesanKontak $pesan)
    {
        if ($pesan->status_baca === 'belum_dibaca') {
            $pesan->tandaiDibaca();
            $message = 'Pesan ditandai sudah dibaca.';
        } else {
            $pesan->tandaiBelumDibaca();
            $message = 'Pesan ditandai belum dibaca.';
        }

        return back()->with('success', $message);
    }

    /**
     * Hapus pesan (soft delete).
     */
    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
