<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\InformasiPerusahaan;
use App\Models\PesanKontak;
use App\Models\Properti;
use Illuminate\Http\Request;

class InformasiPublikController extends Controller
{
    /**
     * Tampilkan halaman Tentang Kami.
     */
    public function tentangKami()
    {
        $perusahaan = InformasiPerusahaan::getData();
        $totalProperti = Properti::published()->count();

        return view('public.tentang-kami', compact('perusahaan', 'totalProperti'));
    }

    /**
     * Tampilkan halaman Kontak.
     */
    public function kontak()
    {
        $perusahaan = InformasiPerusahaan::getData();

        return view('public.kontak', compact('perusahaan'));
    }

    /**
     * Simpan pesan kontak dari formulir publik.
     */
    public function kirimPesan(Request $request)
    {
        $validated = $request->validate([
            'properti_id' => 'nullable|exists:properti,id',
            'nama' => 'required|string|max:30',
            'email' => 'required|email|max:30',
            'no_telepon' => 'required|string|max:13',
            'subjek' => 'nullable|string|max:100',
            'pesan' => 'required|string|max:2000',
        ], [
            'nama.required' => 'Nama Anda wajib diisi.',
            'nama.max' => 'Nama maksimal 30 karakter.',
            'email.required' => 'Email Anda wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 30 karakter.',
            'no_telepon.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'no_telepon.max' => 'Nomor telepon maksimal 13 digit.',
            'subjek.max' => 'Subjek maksimal 100 karakter.',
            'pesan.required' => 'Pesan Anda tidak boleh kosong.',
        ]);

        PesanKontak::create($validated);

        return back()->with('success_pesan', 'Pesan Anda telah berhasil terkirim. Tim Berkah Cahaya Alfatih akan segera menghubungi Anda!');
    }
}
