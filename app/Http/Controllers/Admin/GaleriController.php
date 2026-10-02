<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriProperti;
use App\Models\Properti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Tampilkan galeri foto untuk satu properti.
     */
    public function index(Properti $properti)
    {
        $galeri = $properti->galeri()->orderBy('urutan')->get();

        return view('admin.galeri.index', compact('properti', 'galeri'));
    }

    /**
     * Upload foto (multi-upload).
     */
    public function store(Request $request, Properti $properti)
    {
        $request->validate([
            'gambar' => 'required|array|min:1',
            'gambar.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'gambar.required' => 'Pilih minimal satu foto untuk diupload.',
            'gambar.*.image' => 'File harus berupa gambar.',
            'gambar.*.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WebP.',
            'gambar.*.max' => 'Ukuran setiap foto maksimal 2MB.',
        ]);

        $lastUrutan = $properti->galeri()->max('urutan') ?? 0;

        foreach ($request->file('gambar') as $file) {
            $lastUrutan++;
            $path = $file->store('properti/galeri/' . $properti->id, 'public');

            $properti->galeri()->create([
                'gambar' => $path,
                'keterangan' => null,
                'urutan' => $lastUrutan,
            ]);
        }

        $count = count($request->file('gambar'));

        return back()->with('success', "{$count} foto berhasil diupload.");
    }

    /**
     * Set foto sebagai cover/foto utama properti.
     */
    public function setCover(Properti $properti, GaleriProperti $galeri)
    {
        // Hapus foto utama lama jika ada
        if ($properti->foto_utama) {
            Storage::disk('public')->delete($properti->foto_utama);
        }

        // Set foto galeri ini sebagai foto utama
        $properti->update(['foto_utama' => $galeri->gambar]);

        return back()->with('success', 'Foto berhasil dijadikan cover properti.');
    }

    /**
     * Hapus foto dari galeri.
     */
    public function destroy(Properti $properti, GaleriProperti $galeri)
    {
        // Hapus file fisik
        Storage::disk('public')->delete($galeri->gambar);

        // Jika foto ini adalah foto utama, kosongkan
        if ($properti->foto_utama === $galeri->gambar) {
            $properti->update(['foto_utama' => null]);
        }

        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    /**
     * Update keterangan foto.
     */
    public function updateKeterangan(Request $request, Properti $properti, GaleriProperti $galeri)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:150',
        ]);

        $galeri->update(['keterangan' => $request->keterangan]);

        return back()->with('success', 'Keterangan foto berhasil diperbarui.');
    }
}
