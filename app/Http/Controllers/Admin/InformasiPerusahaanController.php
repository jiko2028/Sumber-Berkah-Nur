<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiPerusahaanController extends Controller
{
    /**
     * Tampilkan form edit informasi perusahaan.
     */
    public function edit()
    {
        $informasi = InformasiPerusahaan::getData();

        return view('admin.informasi.edit', compact('informasi'));
    }

    /**
     * Update informasi perusahaan.
     */public function update(Request $request)
{
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:15',
            'whatsapp' => 'nullable|string|max:13',
            'email' => 'nullable|email|max:30',
            'jam_operasional' => 'nullable|string|max:50',
            'link_instagram' => 'nullable|url|max:100',
            'link_facebook' => 'nullable|url|max:100',
            'link_youtube' => 'nullable|url|max:100',
            'peta_lokasi' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
            'bg_hero' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'bg_properti_terbaru' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'overlay_hero_opacity' => 'nullable|integer|min:0|max:100',
            'overlay_terbaru_opacity' => 'nullable|integer|min:0|max:100',
            'stat_1_number' => 'nullable|integer|min:0',
            'stat_1_suffix' => 'nullable|string|max:20',
            'stat_1_label' => 'nullable|string|max:100',
            'stat_2_number' => 'nullable|integer|min:0',
            'stat_2_suffix' => 'nullable|string|max:20',
            'stat_2_label' => 'nullable|string|max:100',
            'stat_3_number' => 'nullable|integer|min:0',
            'stat_3_suffix' => 'nullable|string|max:20',
            'stat_3_label' => 'nullable|string|max:100',
            'stat_4_number' => 'nullable|integer|min:0',
            'stat_4_suffix' => 'nullable|string|max:20',
            'stat_4_label' => 'nullable|string|max:100',
        ], [
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.max' => 'Ukuran logo maksimal 1MB.',
            'bg_hero.image' => 'File background hero harus berupa gambar.',
            'bg_hero.max' => 'Ukuran background hero maksimal 3MB.',
            'bg_properti_terbaru.image' => 'File background properti terbaru harus berupa gambar.',
            'bg_properti_terbaru.max' => 'Ukuran background properti terbaru maksimal 3MB.',
            'link_instagram.url' => 'Format URL Instagram tidak valid.',
            'link_facebook.url' => 'Format URL Facebook tidak valid.',
            'link_youtube.url' => 'Format URL YouTube tidak valid.',
        ]);

        $informasi = InformasiPerusahaan::getData();

        // Handle upload logo
        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($informasi->logo) {
                Storage::disk('public')->delete($informasi->logo);
            }
            $validated['logo'] = $request->file('logo')
                ->store('perusahaan', 'public');
        }

        // Handle upload bg_hero
        if ($request->hasFile('bg_hero')) {
            if ($informasi->bg_hero) {
                Storage::disk('public')->delete($informasi->bg_hero);
            }
            $validated['bg_hero'] = $request->file('bg_hero')
                ->store('perusahaan', 'public');
        }

        // Handle upload bg_properti_terbaru
        if ($request->hasFile('bg_properti_terbaru')) {
            if ($informasi->bg_properti_terbaru) {
                Storage::disk('public')->delete($informasi->bg_properti_terbaru);
            }
            $validated['bg_properti_terbaru'] = $request->file('bg_properti_terbaru')
                ->store('perusahaan', 'public');
        }

        // Handle empty stat metrics (store null if empty so item can be hidden on frontend)
        $validated['stat_1_number'] = filled($request->stat_1_number) ? (int)$request->stat_1_number : null;
        $validated['stat_1_suffix'] = $request->stat_1_suffix ?? '';
        $validated['stat_1_label'] = filled($request->stat_1_label) ? $request->stat_1_label : null;

        $validated['stat_2_number'] = filled($request->stat_2_number) ? (int)$request->stat_2_number : null;
        $validated['stat_2_suffix'] = $request->stat_2_suffix ?? '';
        $validated['stat_2_label'] = filled($request->stat_2_label) ? $request->stat_2_label : null;

        $validated['stat_3_number'] = filled($request->stat_3_number) ? (int)$request->stat_3_number : null;
        $validated['stat_3_suffix'] = $request->stat_3_suffix ?? '';
        $validated['stat_3_label'] = filled($request->stat_3_label) ? $request->stat_3_label : null;

        $validated['stat_4_number'] = filled($request->stat_4_number) ? (int)$request->stat_4_number : null;
        $validated['stat_4_suffix'] = $request->stat_4_suffix ?? '';
        $validated['stat_4_label'] = filled($request->stat_4_label) ? $request->stat_4_label : null;

        $informasi->update($validated);

        return back()->with('success', 'Informasi perusahaan berhasil diperbarui.');
    }
}
