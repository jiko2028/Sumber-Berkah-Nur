@extends('admin.layouts.app')

@section('title', 'Edit Properti')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.properti.index') }}" class="btn btn-sm btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="mb-0 fw-bold">Edit Properti</h4>
        <small class="text-muted">{{ $properti->kode_properti }} — {{ $properti->judul }}</small>
    </div>
</div>

<form method="POST" action="{{ route('admin.properti.update', $properti) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row g-4">
        {{-- Kolom Kiri: Data Utama --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-info-circle me-2"></i>Informasi Dasar</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Properti <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror"
                               id="judul" name="judul" value="{{ old('judul', $properti->judul) }}" required>
                        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori_id') is-invalid @enderror"
                                    id="kategori_id" name="kategori_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoriList as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id', $properti->kategori_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                   id="harga" name="harga" value="{{ old('harga', $properti->harga) }}" min="0" step="1" required>
                            @error('harga') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="status_properti" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status_properti') is-invalid @enderror"
                                    id="status_properti" name="status_properti" required>
                                <option value="tersedia" {{ old('status_properti', $properti->status_properti) === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="terjual" {{ old('status_properti', $properti->status_properti) === 'terjual' ? 'selected' : '' }}>Terjual</option>
                                <option value="disewa" {{ old('status_properti', $properti->status_properti) === 'disewa' ? 'selected' : '' }}>Disewa</option>
                                <option value="negosiasi" {{ old('status_properti', $properti->status_properti) === 'negosiasi' ? 'selected' : '' }}>Dalam Negosiasi</option>
                            </select>
                            @error('status_properti') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="tipe_transaksi" class="form-label fw-semibold">Tipe Transaksi <span class="text-danger">*</span></label>
                            <select class="form-select @error('tipe_transaksi') is-invalid @enderror"
                                    id="tipe_transaksi" name="tipe_transaksi" required>
                                <option value="jual" {{ old('tipe_transaksi', $properti->tipe_transaksi) === 'jual' ? 'selected' : '' }}>Dijual</option>
                                <option value="sewa" {{ old('tipe_transaksi', $properti->tipe_transaksi) === 'sewa' ? 'selected' : '' }}>Disewakan</option>
                            </select>
                            @error('tipe_transaksi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $properti->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Lokasi --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-geo-alt me-2"></i>Lokasi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                               id="alamat" name="alamat" value="{{ old('alamat', $properti->alamat) }}" required>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="kota" class="form-label fw-semibold">Kota/Kabupaten <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kota') is-invalid @enderror"
                                   id="kota" name="kota" value="{{ old('kota', $properti->kota) }}" required>
                            @error('kota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="provinsi" class="form-label fw-semibold">Provinsi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                   id="provinsi" name="provinsi" value="{{ old('provinsi', $properti->provinsi) }}" required>
                            @error('provinsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Spesifikasi --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-rulers me-2"></i>Spesifikasi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="luas_tanah" class="form-label fw-semibold">Luas Tanah (m²) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('luas_tanah') is-invalid @enderror"
                                   id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah', $properti->luas_tanah) }}" min="1" required>
                            @error('luas_tanah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="luas_bangunan" class="form-label fw-semibold">Luas Bangunan (m²)</label>
                            <input type="number" class="form-control @error('luas_bangunan') is-invalid @enderror"
                                   id="luas_bangunan" name="luas_bangunan" value="{{ old('luas_bangunan', $properti->luas_bangunan) }}" min="0">
                            @error('luas_bangunan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="tipe_bangunan" class="form-label fw-semibold">Tipe Bangunan</label>
                            <input type="text" class="form-control @error('tipe_bangunan') is-invalid @enderror"
                                   id="tipe_bangunan" name="tipe_bangunan" value="{{ old('tipe_bangunan', $properti->tipe_bangunan) }}" placeholder="Contoh: Tipe 50, Tipe 70">
                            @error('tipe_bangunan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_lantai" class="form-label fw-semibold">Jumlah Lantai</label>
                            <input type="number" class="form-control @error('jumlah_lantai') is-invalid @enderror"
                                   id="jumlah_lantai" name="jumlah_lantai" value="{{ old('jumlah_lantai', $properti->jumlah_lantai) }}" min="1">
                            @error('jumlah_lantai') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_kamar_tidur" class="form-label fw-semibold">Kamar Tidur</label>
                            <input type="number" class="form-control @error('jumlah_kamar_tidur') is-invalid @enderror"
                                   id="jumlah_kamar_tidur" name="jumlah_kamar_tidur" value="{{ old('jumlah_kamar_tidur', $properti->jumlah_kamar_tidur) }}" min="0">
                            @error('jumlah_kamar_tidur') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="jumlah_kamar_mandi" class="form-label fw-semibold">Kamar Mandi</label>
                            <input type="number" class="form-control @error('jumlah_kamar_mandi') is-invalid @enderror"
                                   id="jumlah_kamar_mandi" name="jumlah_kamar_mandi" value="{{ old('jumlah_kamar_mandi', $properti->jumlah_kamar_mandi) }}" min="0">
                            @error('jumlah_kamar_mandi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="carport" class="form-label fw-semibold">Carport/Garasi</label>
                            <input type="number" class="form-control @error('carport') is-invalid @enderror"
                                   id="carport" name="carport" value="{{ old('carport', $properti->carport) }}" min="0">
                            @error('carport') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="sumber_air" class="form-label fw-semibold">Sumber Air</label>
                            <input type="text" class="form-control @error('sumber_air') is-invalid @enderror"
                                   id="sumber_air" name="sumber_air" value="{{ old('sumber_air', $properti->sumber_air) }}" placeholder="Contoh: PDAM, Sumur Bor">
                            @error('sumber_air') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="daya_listrik" class="form-label fw-semibold">Daya Listrik</label>
                            <input type="text" class="form-control @error('daya_listrik') is-invalid @enderror"
                                   id="daya_listrik" name="daya_listrik" value="{{ old('daya_listrik', $properti->daya_listrik) }}" placeholder="Contoh: PLN 1300W">
                            @error('daya_listrik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Promo & DP --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-gift me-2 text-danger"></i>Promo & Skema Pembayaran</h6>
                    <div class="form-check form-switch m-0">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_promo" name="is_promo" value="1"
                               {{ old('is_promo', $properti->is_promo) ? 'checked' : '' }} onchange="togglePromoField(this.checked)">
                        <label class="form-check-label fw-bold text-danger ms-1" for="is_promo">
                            Status Promo (ON / OFF)
                        </label>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="dp_info" class="form-label fw-semibold">Info DP (Down Payment)</label>
                            <input type="text" class="form-control @error('dp_info') is-invalid @enderror"
                                   id="dp_info" name="dp_info" value="{{ old('dp_info', $properti->dp_info) }}" placeholder="Contoh: DP Fleksibel 5-20%">
                            @error('dp_info') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6" id="promoInputContainer" style="{{ old('is_promo', $properti->is_promo) ? '' : 'display: none;' }}">
                            <label for="promo" class="form-label fw-semibold text-danger"><i class="bi bi-tag-fill me-1"></i>Detail Promo / Cashback (Aktif)</label>
                            <input type="text" class="form-control @error('promo') is-invalid @enderror border-danger-subtle"
                                   id="promo" name="promo" value="{{ old('promo', $properti->promo) }}" placeholder="Contoh: Cashback 50jt untuk 10 unit pertama!">
                            @error('promo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label for="spesifikasi_bangunan" class="form-label fw-semibold">Detail Spesifikasi Bangunan</label>
                            <textarea class="form-control @error('spesifikasi_bangunan') is-invalid @enderror"
                                      id="spesifikasi_bangunan" name="spesifikasi_bangunan" rows="4"
                                      placeholder="Detail pondasi, tiang, rangka atap, dinding, finishing, dll.">{{ old('spesifikasi_bangunan', $properti->spesifikasi_bangunan) }}</textarea>
                            @error('spesifikasi_bangunan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function togglePromoField(isON) {
                    const container = document.getElementById('promoInputContainer');
                    if (container) {
                        container.style.display = isON ? 'block' : 'none';
                    }
                }
            </script>

            {{-- Fasilitas --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-check2-square me-2"></i>Fasilitas</h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-2">
                        @php $currentFasilitas = old('fasilitas', $properti->fasilitas ?? []); @endphp
                        @foreach($fasilitasList as $key => $label)
                            <div class="col-md-4 col-sm-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                           name="fasilitas[]" value="{{ $key }}"
                                           id="fasilitas_{{ $key }}"
                                           {{ in_array($key, $currentFasilitas) ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="fasilitas_{{ $key }}">{{ $label }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-lg-4">
            {{-- Foto Utama --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-image me-2"></i>Foto Utama</h6>
                </div>
                <div class="card-body p-4">
                    @if($properti->foto_utama)
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/' . $properti->foto_utama) }}" alt="Foto saat ini"
                                 class="img-fluid rounded" style="max-height: 200px;">
                            <p class="text-muted small mt-2 mb-0">Foto saat ini</p>
                        </div>
                    @endif
                    <div class="mb-3">
                        <input type="file" class="form-control @error('foto_utama') is-invalid @enderror"
                               id="foto_utama" name="foto_utama" accept="image/jpeg,image/png,image/webp">
                        @error('foto_utama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Kosongkan jika tidak ingin mengubah. Maks: 2MB.</div>
                    </div>
                    <div id="previewFoto" class="text-center d-none">
                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                </div>
            </div>

            {{-- Info --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-info-lg me-2"></i>Info</h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Kode:</span>
                        <span class="fw-semibold font-monospace">{{ $properti->kode_properti }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Dilihat:</span>
                        <span class="fw-semibold">{{ number_format($properti->dilihat) }}×</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Dibuat:</span>
                        <span class="small">{{ $properti->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted small">Terakhir diubah:</span>
                        <span class="small">{{ $properti->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>

            {{-- Pengaturan --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-gear me-2"></i>Pengaturan</h6>
                </div>
                <div class="card-body p-4">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" name="is_publish" value="1"
                               id="is_publish" {{ old('is_publish', $properti->is_publish) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_publish">Publish</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_unggulan" value="1"
                               id="is_unggulan" {{ old('is_unggulan', $properti->is_unggulan) ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_unggulan">Properti Unggulan</label>
                    </div>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-lg me-2"></i>Perbarui Properti
                </button>
                <a href="{{ route('admin.galeri.index', $properti) }}" class="btn btn-outline-info">
                    <i class="bi bi-images me-2"></i>Kelola Galeri Foto
                </a>
                <a href="{{ route('admin.properti.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    document.getElementById('foto_utama').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewFoto');
        const previewImg = document.getElementById('previewImg');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endpush
@endsection
