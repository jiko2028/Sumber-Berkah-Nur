@extends('public.layouts.app')

@section('title', $properti->judul . ' — Berkah Cahaya Alfatih')
@section('meta_description', Str::limit(strip_tags($properti->deskripsi), 160))

@section('content')
<!-- Breadcrumb Nav -->
<section class="py-3 bg-white border-bottom">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('properti.index') }}" class="text-decoration-none">Properti</a></li>
                <li class="breadcrumb-item"><a href="{{ route('properti.index', ['kategori' => $properti->kategori->slug]) }}" class="text-decoration-none">{{ $properti->kategori->nama_kategori }}</a></li>
                <li class="breadcrumb-item active text-truncate" style="max-width: 250px;" aria-current="page">{{ $properti->judul }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Content Section -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="row g-4">
            {{-- Kolom Kiri: Galeri & Detail Informasi --}}
            <div class="col-lg-8">
                @php
                    $galleryImages = [];
                    if ($properti->foto_utama) {
                        $galleryImages[] = [
                            'url' => asset('storage/' . $properti->foto_utama),
                            'title' => $properti->judul . ' - Foto Utama'
                        ];
                    }
                    foreach ($properti->galeri as $g) {
                        if ($g->gambar !== $properti->foto_utama) {
                            $galleryImages[] = [
                                'url' => asset('storage/' . $g->gambar),
                                'title' => $g->keterangan ?? ($properti->judul . ' - Galeri')
                            ];
                        }
                    }
                    $totalCount = count($galleryImages);
                @endphp

                <!-- Grid Galeri (HouseJakarta Style) -->
                <div class="mb-4">
                    @if($totalCount > 0)
                        <div class="row g-2">
                            {{-- Main Big Photo (Left Column) --}}
                            <div class="{{ $totalCount > 1 ? 'col-md-7' : 'col-12' }}">
                                <div class="position-relative h-100 rounded-3 overflow-hidden shadow-sm gallery-item cursor-pointer"
                                     onclick="openImagePreview(0)" style="min-height: 360px; max-height: 420px; background: #e2e8f0;">
                                    <div class="gallery-loader-overlay">
                                        <div class="loader"></div>
                                    </div>
                                    <img src="{{ $galleryImages[0]['url'] }}" alt="{{ $galleryImages[0]['title'] }}"
                                         class="w-100 h-100 style-gallery-img" style="object-fit: cover;"
                                         onload="if(this.previousElementSibling) this.previousElementSibling.remove();">
                                </div>
                            </div>

                            {{-- 4 Small Photos Grid (Right Column) --}}
                            @if($totalCount > 1)
                                <div class="col-md-5">
                                    <div class="row g-2">
                                        @for($i = 1; $i < min(5, $totalCount); $i++)
                                            <div class="col-6">
                                                <div class="position-relative rounded-3 overflow-hidden shadow-sm gallery-item cursor-pointer"
                                                     onclick="openImagePreview({{ $i }})" style="height: 175px; background: #e2e8f0;">
                                                    <div class="gallery-loader-overlay">
                                                        <div class="loader"></div>
                                                    </div>
                                                    <img src="{{ $galleryImages[$i]['url'] }}" alt="{{ $galleryImages[$i]['title'] }}"
                                                         class="w-100 h-100 style-gallery-img" style="object-fit: cover;"
                                                         onload="if(this.previousElementSibling) this.previousElementSibling.remove();">
                                                    
                                                    @if($i === 4 || ($i === $totalCount - 1 && $totalCount <= 5))
                                                        <div class="position-absolute bottom-0 end-0 m-2" style="z-index: 3;">
                                                            <button class="btn btn-sm btn-light shadow-sm font-heading fw-bold px-2 py-1 fs-7 d-flex align-items-center gap-1" style="background: rgba(255,255,255,0.92); border-radius: 6px;">
                                                                <i class="bi bi-arrows-angle-expand me-1"></i> Lihat semua gambar ({{ $totalCount }})
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="p-5 text-center bg-white rounded border text-muted">
                            <i class="bi bi-image fs-1 d-block mb-2"></i>
                            <p class="mb-0">Belum ada foto galeri untuk properti ini.</p>
                        </div>
                    @endif
                </div>

                <!-- Judul & Lokasi -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <span class="badge bg-light text-dark font-mono border">{{ $properti->kode_properti }}</span>
                        <span class="badge bg-sage text-success font-heading">{{ $properti->kategori->nama_kategori }}</span>
                        @switch($properti->status_properti)
                            @case('tersedia')
                                <span class="badge badge-status-tersedia"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                                @break
                            @case('terjual')
                                <span class="badge badge-status-terjual"><i class="bi bi-x-circle me-1"></i>Terjual</span>
                                @break
                            @case('disewa')
                                <span class="badge badge-status-disewa"><i class="bi bi-house me-1"></i>Disewa</span>
                                @break
                            @case('negosiasi')
                                <span class="badge badge-status-negosiasi"><i class="bi bi-clock me-1"></i>Negosiasi</span>
                                @break
                        @endswitch
                    </div>

                    <h1 class="font-heading fs-2 mb-2" style="color: var(--hijau-tua);">{{ $properti->judul }}</h1>
                    <p class="text-muted">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $properti->alamat }}, {{ $properti->kota }}, {{ $properti->provinsi }}
                    </p>
                </div>

                <!-- Stat Callout Cards (Persis gaya flyer Instagram) -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6 col-md-3">
                        <div class="stat-callout h-100">
                            <div class="label">Harga</div>
                            <div class="val text-truncate" style="font-size: 1.15rem;">{{ $properti->harga_format }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="stat-callout h-100">
                            <div class="label">Tipe Unit</div>
                            <div class="val text-dark">{{ $properti->tipe_bangunan ?? 'Standar' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="stat-callout h-100">
                            <div class="label">DP / Uang Muka</div>
                            <div class="val text-warning">{{ $properti->dp_info ?? 'Konsultasi' }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="stat-callout h-100">
                            <div class="label">Status</div>
                            <div class="val text-capitalize" style="font-size: 1.1rem;">{{ $properti->status_properti }}</div>
                        </div>
                    </div>
                </div>

                <!-- Banner Promo (jika status promo ON dan ada teks promo) -->
                @if($properti->is_promo && $properti->promo)
                    <div class="alert alert-warning border-warning d-flex align-items-center gap-3 p-3 mb-4">
                        <i class="bi bi-gift-fill fs-2 text-warning"></i>
                        <div>
                            <strong class="font-heading d-block text-dark">Penawaran Promo Khusus!</strong>
                            <span>{{ $properti->promo }}</span>
                        </div>
                    </div>
                @endif

                <!-- Ringkasan Spesifikasi Utama -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="font-heading mb-0 fs-6"><i class="bi bi-sliders me-2 text-success"></i>Spesifikasi Utama</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3 text-center text-sm-start">
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Luas Tanah</small>
                                    <strong class="font-mono fs-5">{{ $properti->luas_tanah }} m²</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Luas Bangunan</small>
                                    <strong class="font-mono fs-5">{{ $properti->luas_bangunan ?? '-' }} m²</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Kamar Tidur</small>
                                    <strong class="font-mono fs-5">{{ $properti->jumlah_kamar_tidur ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Kamar Mandi</small>
                                    <strong class="font-mono fs-5">{{ $properti->jumlah_kamar_mandi ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Carport / Garasi</small>
                                    <strong class="font-mono fs-5">{{ $properti->carport ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Jumlah Lantai</small>
                                    <strong class="font-mono fs-5">{{ $properti->jumlah_lantai ?? 1 }}</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Sumber Air</small>
                                    <strong class="fs-6 text-dark">{{ $properti->sumber_air ?? 'PDAM' }}</strong>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-2 border rounded bg-light">
                                    <small class="text-muted d-block">Daya Listrik</small>
                                    <strong class="fs-6 text-dark">{{ $properti->daya_listrik ?? 'PLN' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Properti -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="font-heading mb-0 fs-6"><i class="bi bi-text-paragraph me-2 text-success"></i>Deskripsi Properti</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="lh-lg" style="white-space: pre-line;">{{ $properti->deskripsi }}</div>
                    </div>
                </div>

                <!-- Detail Spesifikasi Bangunan (Rincian Material Aesthetic Grid) -->
                @if($properti->spesifikasi_bangunan)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="font-heading mb-0 fs-6" style="color: var(--hijau-tua);">
                                <i class="bi bi-tools me-2 text-success"></i>Spesifikasi Teknis & Material Bangunan
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            @php
                                $rawLines = explode("\n", str_replace("\r", "", $properti->spesifikasi_bangunan));
                                $specList = [];
                                foreach ($rawLines as $line) {
                                    $line = trim($line);
                                    if (empty($line)) continue;
                                    $lineClean = preg_replace('/^\d+[\.\)]\s*/', '', $line);
                                    if (str_contains($lineClean, ':')) {
                                        [$title, $val] = explode(':', $lineClean, 2);
                                        $specList[] = ['label' => trim($title), 'val' => trim($val)];
                                    } else {
                                        $specList[] = ['label' => '', 'val' => $lineClean];
                                    }
                                }

                                if (!function_exists('getMaterialIcon')) {
                                    function getMaterialIcon($label) {
                                        $l = strtolower($label);
                                        if (str_contains($l, 'pondasi')) return 'bi-bricks';
                                        if (str_contains($l, 'tiang') || str_contains($l, 'slop')) return 'bi-building-up';
                                        if (str_contains($l, 'rangka') || str_contains($l, 'atap')) return 'bi-house-gear';
                                        if (str_contains($l, 'plafon')) return 'bi-border-style';
                                        if (str_contains($l, 'lantai')) return 'bi-grid-3x3-gap';
                                        if (str_contains($l, 'dinding') || str_contains($l, 'sekat')) return 'bi-square-half';
                                        if (str_contains($l, 'pintu') || str_contains($l, 'jendela') || str_contains($l, 'kusen')) return 'bi-door-open';
                                        if (str_contains($l, 'finishing') || str_contains($l, 'cat')) return 'bi-paint-bucket';
                                        if (str_contains($l, 'listrik')) return 'bi-lightning-charge-fill';
                                        if (str_contains($l, 'air')) return 'bi-droplet-fill';
                                        return 'bi-check-circle-fill';
                                    }
                                }
                            @endphp

                            <div class="row g-3">
                                @foreach($specList as $item)
                                    <div class="col-md-6">
                                        <div class="p-3 rounded border bg-white h-100 d-flex align-items-center gap-3 shadow-xs">
                                            <div class="bg-sage rounded p-2 text-success d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; flex-shrink: 0;">
                                                <i class="bi {{ getMaterialIcon($item['label']) }} fs-5"></i>
                                            </div>
                                            <div>
                                                @if($item['label'])
                                                    <span class="text-muted small d-block font-heading fw-semibold text-uppercase" style="letter-spacing: 0.04em; font-size: 0.72rem;">
                                                        {{ $item['label'] }}
                                                    </span>
                                                @endif
                                                <strong class="text-dark font-heading fw-bold fs-6">{{ $item['val'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Fasilitas Checklist -->
                @if(!empty($properti->fasilitas))
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="font-heading mb-0 fs-6"><i class="bi bi-check2-circle me-2 text-success"></i>Fasilitas Pendukung</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-2">
                                @php
                                    $allFasilitas = \App\Http\Controllers\Admin\PropertiController::daftarFasilitas();
                                @endphp
                                @foreach($properti->fasilitas as $itemKey)
                                    <div class="col-sm-6 col-md-4">
                                        <div class="d-flex align-items-center gap-2 p-2 bg-sage rounded">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span class="small font-heading fw-semibold text-dark">{{ $allFasilitas[$itemKey] ?? ucfirst(str_replace('_', ' ', $itemKey)) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Kolom Kanan: Contact Card & Form (Sticky Sidebar) --}}
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 90px; z-index: 10;">
                    <!-- Direct WhatsApp Contact Card -->
                    <div class="card border-0 shadow-sm mb-4" style="background-color: var(--hijau-tua); color: var(--putih);">
                        <div class="card-body p-4 text-center">
                            <div class="bg-white rounded-circle p-3 d-inline-flex mb-3 text-success shadow-sm" style="width: 64px; height: 64px; align-items: center; justify-content: center;">
                                <i class="bi bi-whatsapp fs-1"></i>
                            </div>
                            <h4 class="font-heading text-white mb-1">Tertarik Properti Ini?</h4>
                            <p class="small text-white-50 mb-4">
                                Hubungi tim marketing kami langsung untuk survei lokasi & konsultasi gratis.
                            </p>

                            @php
                                $msgWaFatur = urlencode("Halo Fatur, saya tertarik dengan properti " . $properti->judul . " (Kode: " . $properti->kode_properti . "). Bisa minta info lebih lanjut?");
                                $msgWaYafi  = urlencode("Halo Yafi, saya tertarik dengan properti " . $properti->judul . " (Kode: " . $properti->kode_properti . "). Bisa minta info lebih lanjut?");
                            @endphp

                            <div class="d-grid gap-2">
                                <a href="https://wa.me/6281351540304?text={{ $msgWaFatur }}"
                                   target="_blank" class="btn btn-gold btn-lg text-start d-flex align-items-center justify-content-between">
                                    <span><i class="bi bi-whatsapp me-2"></i> Hubungi Fatur</span>
                                    <small class="font-mono">0813-5154-0304</small>
                                </a>
                                <a href="https://wa.me/6285173190869?text={{ $msgWaYafi }}"
                                   target="_blank" class="btn btn-outline-light btn-lg text-start d-flex align-items-center justify-content-between">
                                    <span><i class="bi bi-whatsapp me-2"></i> Hubungi Yafi</span>
                                    <small class="font-mono">0851-7319-0869</small>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Form Pertanyaan / Kontak -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="font-heading mb-0 fs-6"><i class="bi bi-envelope me-2 text-success"></i>Kirim Pesan / Pertanyaan</h5>
                        </div>
                        <div class="card-body p-4">
                            @if(session('success_pesan'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>{{ session('success_pesan') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('kontak.kirim') }}">
                                @csrf
                                <input type="hidden" name="properti_id" value="{{ $properti->id }}">
                                <input type="hidden" name="subjek" value="Pertanyaan Properti: {{ $properti->kode_properti }} - {{ $properti->judul }}">

                                <div class="mb-3">
                                    <label for="nama" class="form-label small fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                           id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama Anda" required>
                                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label small fw-semibold">No. WhatsApp / Telepon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                           id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="081234567890" required>
                                    @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label small fw-semibold">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="pesan" class="form-label small fw-semibold">Pesan Anda <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('pesan') is-invalid @enderror"
                                              id="pesan" name="pesan" rows="4" placeholder="Saya ingin bertanya mengenai properti ini..." required>{{ old('pesan') }}</textarea>
                                    @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <button type="submit" class="btn btn-brand w-100">
                                    <i class="bi bi-send me-1"></i> Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Properti Serupa Section -->
@if($propertiSerupa->count() > 0)
    <section class="py-5 bg-white border-top">
        <div class="container">
            <h3 class="font-heading fs-3 mb-4" style="color: var(--hijau-tua);">Properti Serupa</h3>
            <div class="row g-4">
                @foreach($propertiSerupa as $ps)
                    <div class="col-md-4">
                        <div class="card-properti h-100 d-flex flex-column" onclick="window.location.href='{{ route('properti.detail', $ps->slug) }}'">
                            <div class="card-img-wrapper">
                                @if($ps->foto_utama)
                                    <img src="{{ asset('storage/' . $ps->foto_utama) }}" alt="{{ $ps->judul }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="bi bi-building fs-1"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <span class="badge bg-light text-dark font-mono border mb-2 w-auto me-auto">{{ $ps->kode_properti }}</span>
                                <h6 class="font-heading text-truncate mb-2">
                                    <a href="{{ route('properti.detail', $ps->slug) }}" class="text-decoration-none text-dark">
                                        {{ $ps->judul }}
                                    </a>
                                </h6>
                                <div class="font-mono text-success fw-bold mt-auto">{{ $ps->harga_format }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- Modal Lightbox Preview Foto (HouseJakarta Style Full Screen Preview) -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-dark border-0">
            <div class="modal-header border-0 pb-0">
                <span class="text-white-50 small font-mono" id="modalCounter">1 / 1</span>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center p-3 position-relative">
                <img id="modalPreviewImg" src="" class="img-fluid rounded shadow-lg" style="max-height: 78vh; object-fit: contain;">
            </div>
            <div class="modal-footer border-0 pt-0 justify-content-between">
                <button type="button" class="btn btn-outline-light btn-sm font-heading" onclick="prevPreviewImg()">
                    <i class="bi bi-chevron-left me-1"></i> Sebelumnya
                </button>
                <span class="text-white font-heading small text-truncate" style="max-width: 400px;" id="modalTitle"></span>
                <button type="button" class="btn btn-outline-light btn-sm font-heading" onclick="nextPreviewImg()">
                    Selanjutnya <i class="bi bi-chevron-right ms-1"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* User Custom Loader CSS Animation */
    .loader {
      width: 120px;
      height: 20px;
      border-radius: 20px;
      background:
       repeating-linear-gradient(135deg, var(--hijau-utama) 0 10px, var(--kuning-emas) 0 20px) 0/0% no-repeat,
       repeating-linear-gradient(135deg,#ddd 0 10px,#eee 0 20px) 0/100%;
      animation: l3 2s infinite;
    }
    @keyframes l3 {
        100% {background-size:100%}
    }

    .gallery-loader-overlay {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        transition: opacity 0.3s ease;
    }

    .cursor-pointer {
        cursor: pointer;
    }
    .gallery-item {
        transition: transform 0.25s ease;
    }
    .gallery-item:hover .style-gallery-img {
        transform: scale(1.05);
        filter: brightness(0.92);
    }
    .style-gallery-img {
        transition: transform 0.35s ease, filter 0.35s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    const allGalleryImages = @json($galleryImages);
    let currentImgIndex = 0;
    let lightboxModalObj = null;

    function openImagePreview(index) {
        if (!allGalleryImages || allGalleryImages.length === 0) return;
        currentImgIndex = index;
        updateModalContent();
        if (!lightboxModalObj) {
            lightboxModalObj = new bootstrap.Modal(document.getElementById('lightboxModal'));
        }
        lightboxModalObj.show();
    }

    function updateModalContent() {
        const item = allGalleryImages[currentImgIndex];
        document.getElementById('modalPreviewImg').src = item.url;
        document.getElementById('modalTitle').innerText = item.title || '';
        document.getElementById('modalCounter').innerText = `${currentImgIndex + 1} / ${allGalleryImages.length}`;
    }

    function prevPreviewImg() {
        currentImgIndex = (currentImgIndex - 1 + allGalleryImages.length) % allGalleryImages.length;
        updateModalContent();
    }

    function nextPreviewImg() {
        currentImgIndex = (currentImgIndex + 1) % allGalleryImages.length;
        updateModalContent();
    }

    // Keyboard navigation inside Lightbox (Arrow Left / Arrow Right / Escape)
    document.addEventListener('keydown', function(e) {
        const modalEl = document.getElementById('lightboxModal');
        if (modalEl && modalEl.classList.contains('show')) {
            if (e.key === 'ArrowLeft') {
                prevPreviewImg();
            } else if (e.key === 'ArrowRight') {
                nextPreviewImg();
            }
        }
    });
</script>
@endpush
@endsection
