@extends('admin.layouts.app')

@section('title', 'Informasi Perusahaan')

@section('content')
<div class="mb-4">
    <h4 class="mb-1 fw-bold">Informasi Perusahaan</h4>
    <p class="text-muted mb-0">Kelola profil dan informasi kontak perusahaan</p>
</div>

<form method="POST" action="{{ route('admin.informasi.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            {{-- Profil --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-building me-2"></i>Profil Perusahaan</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label fw-semibold">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror"
                               id="nama_perusahaan" name="nama_perusahaan"
                               value="{{ old('nama_perusahaan', $informasi->nama_perusahaan) }}" required>
                        @error('nama_perusahaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi / Profil Singkat</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                  id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $informasi->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="visi" class="form-label fw-semibold">Visi</label>
                        <textarea class="form-control @error('visi') is-invalid @enderror"
                                  id="visi" name="visi" rows="3">{{ old('visi', $informasi->visi) }}</textarea>
                        @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="misi" class="form-label fw-semibold">Misi</label>
                        <textarea class="form-control @error('misi') is-invalid @enderror"
                                  id="misi" name="misi" rows="4"
                                  placeholder="Satu misi per baris...">{{ old('misi', $informasi->misi) }}</textarea>
                        @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-telephone me-2"></i>Kontak & Alamat</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat Kantor</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                               id="alamat" name="alamat" value="{{ old('alamat', $informasi->alamat) }}">
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="telepon" class="form-label fw-semibold">Telepon</label>
                            <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                                   id="telepon" name="telepon" value="{{ old('telepon', $informasi->telepon) }}"
                                   placeholder="021-12345678">
                            @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="whatsapp" class="form-label fw-semibold">WhatsApp</label>
                            <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                   id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $informasi->whatsapp) }}"
                                   placeholder="081234567890">
                            @error('whatsapp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $informasi->email) }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="jam_operasional" class="form-label fw-semibold">Jam Operasional</label>
                            <input type="text" class="form-control @error('jam_operasional') is-invalid @enderror"
                                   id="jam_operasional" name="jam_operasional"
                                   value="{{ old('jam_operasional', $informasi->jam_operasional) }}"
                                   placeholder="Senin - Sabtu, 08:00 - 17:00 WIB">
                            @error('jam_operasional') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media Sosial --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-share me-2"></i>Media Sosial</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="link_instagram" class="form-label fw-semibold">
                            <i class="bi bi-instagram me-1"></i>Instagram
                        </label>
                        <input type="url" class="form-control @error('link_instagram') is-invalid @enderror"
                               id="link_instagram" name="link_instagram"
                               value="{{ old('link_instagram', $informasi->link_instagram) }}"
                               placeholder="https://instagram.com/username">
                        @error('link_instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="link_facebook" class="form-label fw-semibold">
                            <i class="bi bi-facebook me-1"></i>Facebook
                        </label>
                        <input type="url" class="form-control @error('link_facebook') is-invalid @enderror"
                               id="link_facebook" name="link_facebook"
                               value="{{ old('link_facebook', $informasi->link_facebook) }}"
                               placeholder="https://facebook.com/pagename">
                        @error('link_facebook') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="link_youtube" class="form-label fw-semibold">
                            <i class="bi bi-youtube me-1"></i>YouTube
                        </label>
                        <input type="url" class="form-control @error('link_youtube') is-invalid @enderror"
                               id="link_youtube" name="link_youtube"
                               value="{{ old('link_youtube', $informasi->link_youtube) }}"
                               placeholder="https://youtube.com/channel/xxx">
                        @error('link_youtube') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Peta --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-geo-alt me-2"></i>Peta Lokasi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label for="peta_lokasi" class="form-label fw-semibold">Embed Google Maps</label>
                        <textarea class="form-control @error('peta_lokasi') is-invalid @enderror font-monospace"
                                  id="peta_lokasi" name="peta_lokasi" rows="4"
                                  placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ old('peta_lokasi', $informasi->peta_lokasi) }}</textarea>
                        @error('peta_lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Paste kode embed iframe dari Google Maps.</div>
                    </div>
                </div>
            </div>

            {{-- Stat Metrics Banner --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-bar-chart-line me-2 text-warning"></i>Statistik Metrics Beranda (4 Counter Strip)</h6>
                </div>
                <div class="card-body p-4">
                    <p class="small text-muted mb-3">Atur angka counter dan label deskripsi 4 indikator yang tampil di bagian Hero Beranda.</p>
                    
                    <div class="row g-3">
                        {{-- Stat 1 --}}
                        <div class="col-md-6 border-bottom pb-3">
                            <h6 class="fw-bold small text-primary mb-2">Metric 1</h6>
                            <div class="row g-2">
                                <div class="col-7">
                                    <label class="form-label small fw-semibold">Angka</label>
                                    <input type="number" class="form-control form-control-sm" name="stat_1_number" value="{{ old('stat_1_number', $informasi->stat_1_number ?? 100) }}">
                                </div>
                                <div class="col-5">
                                    <label class="form-label small fw-semibold">Akhiran</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_1_suffix" value="{{ old('stat_1_suffix', $informasi->stat_1_suffix ?? '+') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Label Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_1_label" value="{{ old('stat_1_label', $informasi->stat_1_label ?? 'Pilihan Properti Premium') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Stat 2 --}}
                        <div class="col-md-6 border-bottom pb-3">
                            <h6 class="fw-bold small text-primary mb-2">Metric 2</h6>
                            <div class="row g-2">
                                <div class="col-7">
                                    <label class="form-label small fw-semibold">Angka</label>
                                    <input type="number" class="form-control form-control-sm" name="stat_2_number" value="{{ old('stat_2_number', $informasi->stat_2_number ?? 100) }}">
                                </div>
                                <div class="col-5">
                                    <label class="form-label small fw-semibold">Akhiran</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_2_suffix" value="{{ old('stat_2_suffix', $informasi->stat_2_suffix ?? '%') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Label Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_2_label" value="{{ old('stat_2_label', $informasi->stat_2_label ?? 'Legalitas & Sertifikat Aman') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Stat 3 --}}
                        <div class="col-md-6 pt-2">
                            <h6 class="fw-bold small text-primary mb-2">Metric 3</h6>
                            <div class="row g-2">
                                <div class="col-7">
                                    <label class="form-label small fw-semibold">Angka</label>
                                    <input type="number" class="form-control form-control-sm" name="stat_3_number" value="{{ old('stat_3_number', $informasi->stat_3_number ?? 500) }}">
                                </div>
                                <div class="col-5">
                                    <label class="form-label small fw-semibold">Akhiran</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_3_suffix" value="{{ old('stat_3_suffix', $informasi->stat_3_suffix ?? '+') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Label Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_3_label" value="{{ old('stat_3_label', $informasi->stat_3_label ?? 'Konsumen & Keluarga Puas') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Stat 4 --}}
                        <div class="col-md-6 pt-2">
                            <h6 class="fw-bold small text-primary mb-2">Metric 4</h6>
                            <div class="row g-2">
                                <div class="col-7">
                                    <label class="form-label small fw-semibold">Angka</label>
                                    <input type="number" class="form-control form-control-sm" name="stat_4_number" value="{{ old('stat_4_number', $informasi->stat_4_number ?? 10) }}">
                                </div>
                                <div class="col-5">
                                    <label class="form-label small fw-semibold">Akhiran</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_4_suffix" value="{{ old('stat_4_suffix', $informasi->stat_4_suffix ?? ' Thn+') }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-semibold">Label Deskripsi</label>
                                    <input type="text" class="form-control form-control-sm" name="stat_4_label" value="{{ old('stat_4_label', $informasi->stat_4_label ?? 'Pengalaman Real Estate') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-lg-4">
            {{-- Logo --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-image me-2"></i>Logo Perusahaan</h6>
                </div>
                <div class="card-body p-4 text-center">
                    @if($informasi->logo)
                        <img src="{{ asset('storage/' . $informasi->logo) }}" alt="Logo"
                             class="img-fluid mb-3" style="max-height: 120px;">
                    @else
                        <div class="bg-light rounded p-4 mb-3">
                            <i class="bi bi-image text-muted fs-1"></i>
                            <p class="text-muted small mt-2 mb-0">Belum ada logo</p>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                           id="logo" name="logo" accept="image/jpeg,image/png,image/webp,image/svg+xml">
                    @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Maks: 1MB. Format: JPG, PNG, WebP, SVG.</div>
                </div>
            </div>

            {{-- Background Hero Header Beranda --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-image-fill me-2 text-primary"></i>Background Hero Header (Beranda)</h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        @if($informasi->bg_hero)
                            <img src="{{ asset('storage/' . $informasi->bg_hero) }}" alt="Background Hero"
                                 class="img-fluid rounded mb-2 shadow-sm" style="max-height: 140px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light rounded p-3 mb-2">
                                <i class="bi bi-image text-muted fs-1"></i>
                                <p class="text-muted small mt-1 mb-0">Belum ada gambar (menggunakan default)</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('bg_hero') is-invalid @enderror"
                               id="bg_hero" name="bg_hero" accept="image/jpeg,image/png,image/webp">
                        @error('bg_hero') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text text-start mt-1">Maks: 3MB. Tampil di bagian paling atas (Hero Banner) Beranda.</div>
                    </div>

                    {{-- Opacity Slider --}}
                    <div class="pt-2 border-top">
                        <label for="overlay_hero_opacity" class="form-label fw-semibold d-flex justify-content-between">
                            <span><i class="bi bi-sliders me-1"></i>Opacity Lapisan Hijau Hero</span>
                            <span id="heroOpacityVal" class="badge bg-primary fs-6">{{ old('overlay_hero_opacity', $informasi->overlay_hero_opacity ?? 80) }}%</span>
                        </label>
                        <input type="range" class="form-range" id="overlay_hero_opacity" name="overlay_hero_opacity"
                               min="0" max="100" step="5" value="{{ old('overlay_hero_opacity', $informasi->overlay_hero_opacity ?? 80) }}"
                               oninput="document.getElementById('heroOpacityVal').innerText = this.value + '%'">
                        <div class="form-text">Makin tinggi % makin gelap/pekat warna hijau di atas foto.</div>
                    </div>
                </div>
            </div>

            {{-- Background Section Properti Terbaru --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-semibold"><i class="bi bi-card-image me-2 text-success"></i>Background Properti Terbaru (Beranda)</h6>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        @if($informasi->bg_properti_terbaru)
                            <img src="{{ asset('storage/' . $informasi->bg_properti_terbaru) }}" alt="Background Properti Terbaru"
                                 class="img-fluid rounded mb-2 shadow-sm" style="max-height: 140px; width: 100%; object-fit: cover;">
                        @else
                            <div class="bg-light rounded p-3 mb-2">
                                <i class="bi bi-card-image text-muted fs-1"></i>
                                <p class="text-muted small mt-1 mb-0">Belum ada gambar (menggunakan default)</p>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('bg_properti_terbaru') is-invalid @enderror"
                               id="bg_properti_terbaru" name="bg_properti_terbaru" accept="image/jpeg,image/png,image/webp">
                        @error('bg_properti_terbaru') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text text-start mt-1">Maks: 3MB. Tampil sebagai background section Properti Terbaru.</div>
                    </div>

                    {{-- Opacity Slider --}}
                    <div class="pt-2 border-top">
                        <label for="overlay_terbaru_opacity" class="form-label fw-semibold d-flex justify-content-between">
                            <span><i class="bi bi-sliders me-1"></i>Opacity Lapisan Hijau Properti Terbaru</span>
                            <span id="terbaruOpacityVal" class="badge bg-success fs-6">{{ old('overlay_terbaru_opacity', $informasi->overlay_terbaru_opacity ?? 85) }}%</span>
                        </label>
                        <input type="range" class="form-range" id="overlay_terbaru_opacity" name="overlay_terbaru_opacity"
                               min="0" max="100" step="5" value="{{ old('overlay_terbaru_opacity', $informasi->overlay_terbaru_opacity ?? 85) }}"
                               oninput="document.getElementById('terbaruOpacityVal').innerText = this.value + '%'">
                        <div class="form-text">Makin tinggi % makin gelap/pekat warna hijau di atas foto.</div>
                    </div>
                </div>
            </div>

            {{-- Simpan --}}
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                </button>
            </div>
        </div>
    </div>
</form>
@endsection
