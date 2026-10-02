<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Properti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertiController extends Controller
{
    /**
     * Daftar fasilitas yang tersedia (untuk checklist).
     */
    public static function daftarFasilitas(): array
    {
        return [
            'kolam_renang' => 'Kolam Renang',
            'taman' => 'Taman',
            'keamanan_24jam' => 'Keamanan 24 Jam',
            'cctv' => 'CCTV',
            'mushola' => 'Mushola',
            'playground' => 'Playground / Taman Bermain',
            'gym' => 'Gym / Fitness Center',
            'garasi' => 'Garasi',
            'balkon' => 'Balkon',
            'rooftop' => 'Rooftop',
            'smart_home' => 'Smart Home System',
            'water_heater' => 'Water Heater',
            'ac' => 'AC (Air Conditioner)',
            'listrik_besar' => 'Listrik Daya Besar',
            'air_pam' => 'Air PAM/PDAM',
            'sumur_bor' => 'Sumur Bor',
            'dapur_bersih' => 'Dapur Bersih',
            'ruang_tamu' => 'Ruang Tamu Luas',
            'akses_tol' => 'Dekat Akses Tol',
            'dekat_sekolah' => 'Dekat Sekolah',
            'dekat_rumah_sakit' => 'Dekat Rumah Sakit',
            'dekat_pasar' => 'Dekat Pasar/Mall',
        ];
    }

    /**
     * Tampilkan daftar properti.
     */
    public function index(Request $request)
    {
        $query = Properti::with('kategori', 'user');

        // Pencarian
        if ($request->filled('search')) {
            $query->cari($request->search);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->byKategori($request->kategori_id);
        }

        // Filter publish
        if ($request->filled('publish')) {
            $query->where('is_publish', $request->publish === '1');
        }

        $properti = $query->latest()->paginate(15)->withQueryString();
        $kategoriList = Kategori::orderBy('nama_kategori')->get();

        return view('admin.properti.index', compact('properti', 'kategoriList'));
    }

    /**
     * Tampilkan form tambah properti.
     */
    public function create()
    {
        $kategoriList = Kategori::orderBy('nama_kategori')->get();
        $fasilitasList = self::daftarFasilitas();

        return view('admin.properti.create', compact('kategoriList', 'fasilitasList'));
    }

    /**
     * Simpan properti baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status_properti' => 'required|in:tersedia,terjual,disewa,negosiasi',
            'tipe_transaksi' => 'required|in:jual,sewa',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:50',
            'provinsi' => 'required|string|max:50',
            'luas_tanah' => 'required|integer|min:1',
            'luas_bangunan' => 'nullable|integer|min:0',
            'tipe_bangunan' => 'nullable|string|max:30',
            'jumlah_lantai' => 'nullable|integer|min:1',
            'jumlah_kamar_tidur' => 'nullable|integer|min:0',
            'jumlah_kamar_mandi' => 'nullable|integer|min:0',
            'carport' => 'nullable|integer|min:0',
            'sumber_air' => 'nullable|string|max:30',
            'daya_listrik' => 'nullable|string|max:50',
            'dp_info' => 'nullable|string|max:50',
            'promo' => 'nullable|string',
            'is_promo' => 'nullable|boolean',
            'spesifikasi_bangunan' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'string',
            'foto_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_unggulan' => 'nullable|boolean',
            'is_publish' => 'nullable|boolean',
        ], [
            'judul.required' => 'Judul properti wajib diisi.',
            'judul.max' => 'Judul properti maksimal 50 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'alamat.required' => 'Alamat wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'luas_tanah.required' => 'Luas tanah wajib diisi.',
            'foto_utama.image' => 'File harus berupa gambar.',
            'foto_utama.max' => 'Ukuran foto maksimal 2MB.',
            'foto_utama.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WebP.',
        ]);

        // Handle upload foto utama
        if ($request->hasFile('foto_utama')) {
            $validated['foto_utama'] = $request->file('foto_utama')
                ->store('properti/foto-utama', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['is_unggulan'] = $request->boolean('is_unggulan');
        $validated['is_publish'] = $request->boolean('is_publish');
        $validated['is_promo'] = $request->boolean('is_promo');

        $properti = Properti::create($validated);

        return redirect()->route('admin.properti.index')
            ->with('success', 'Properti ' . $properti->kode_properti . ' berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit properti.
     */
    public function edit(Properti $properti)
    {
        $kategoriList = Kategori::orderBy('nama_kategori')->get();
        $fasilitasList = self::daftarFasilitas();

        return view('admin.properti.edit', compact('properti', 'kategoriList', 'fasilitasList'));
    }

    /**
     * Update properti.
     */
    public function update(Request $request, Properti $properti)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'status_properti' => 'required|in:tersedia,terjual,disewa,negosiasi',
            'tipe_transaksi' => 'required|in:jual,sewa',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:50',
            'provinsi' => 'required|string|max:50',
            'luas_tanah' => 'required|integer|min:1',
            'luas_bangunan' => 'nullable|integer|min:0',
            'tipe_bangunan' => 'nullable|string|max:30',
            'jumlah_lantai' => 'nullable|integer|min:1',
            'jumlah_kamar_tidur' => 'nullable|integer|min:0',
            'jumlah_kamar_mandi' => 'nullable|integer|min:0',
            'carport' => 'nullable|integer|min:0',
            'sumber_air' => 'nullable|string|max:30',
            'daya_listrik' => 'nullable|string|max:50',
            'dp_info' => 'nullable|string|max:50',
            'promo' => 'nullable|string',
            'is_promo' => 'nullable|boolean',
            'spesifikasi_bangunan' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'string',
            'foto_utama' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_unggulan' => 'nullable|boolean',
            'is_publish' => 'nullable|boolean',
        ], [
            'judul.required' => 'Judul properti wajib diisi.',
            'judul.max' => 'Judul properti maksimal 50 karakter.',
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'harga.required' => 'Harga wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'kota.required' => 'Kota wajib diisi.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'luas_tanah.required' => 'Luas tanah wajib diisi.',
            'foto_utama.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Handle upload foto utama baru
        if ($request->hasFile('foto_utama')) {
            // Hapus foto lama
            if ($properti->foto_utama) {
                Storage::disk('public')->delete($properti->foto_utama);
            }
            $validated['foto_utama'] = $request->file('foto_utama')
                ->store('properti/foto-utama', 'public');
        }

        $validated['is_unggulan'] = $request->boolean('is_unggulan');
        $validated['is_publish'] = $request->boolean('is_publish');
        $validated['is_promo'] = $request->boolean('is_promo');

        $properti->update($validated);

        return redirect()->route('admin.properti.index')
            ->with('success', 'Properti berhasil diperbarui.');
    }

    /**
     * Hapus properti (soft delete).
     */
    public function destroy(Properti $properti)
    {
        $properti->delete();

        return redirect()->route('admin.properti.index')
            ->with('success', 'Properti berhasil dihapus.');
    }

    /**
     * Toggle status publish.
     */
    public function togglePublish(Properti $properti)
    {
        $properti->update(['is_publish' => !$properti->is_publish]);

        $status = $properti->is_publish ? 'dipublikasikan' : 'disembunyikan';

        return back()->with('success', "Properti berhasil {$status}.");
    }

    /**
     * Toggle status unggulan.
     */
    public function toggleUnggulan(Properti $properti)
    {
        $properti->update(['is_unggulan' => !$properti->is_unggulan]);

        $status = $properti->is_unggulan ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';

        return back()->with('success', "Properti berhasil {$status}.");
    }
}
