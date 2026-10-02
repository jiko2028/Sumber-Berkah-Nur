@extends('public.layouts.app')

@section('title', 'Beranda — Berkah Cahaya Alfatih')

@push('styles')
<style>
    /* Full Image Hero Section (HouseJakarta Style adapted to Berkah Cahaya Alfatih identity) */
    .hero-full-image {
        position: relative;
        background: linear-gradient(180deg, rgba(18, 58, 40, 0.78) 0%, rgba(18, 58, 40, 0.88) 100%), url('{{ asset("images/hero-bg.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 85vh;
        display: flex;
        align-items: center;
        padding: 5rem 0 3rem 0;
        color: #FFFFFF;
    }

    /* Floating Tabbed Search Widget */
    .search-widget-card {
        background: #FFFFFF;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        color: var(--arang);
        max-width: 900px;
        margin: 0 auto;
    }

    .search-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.25rem;
    }

    .search-tab-btn {
        background: #F1F5F9;
        color: #64748B;
        border: none;
        border-radius: 30px;
        padding: 0.5rem 1.4rem;
        font-family: 'Archivo', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .search-tab-btn.active {
        background-color: var(--hijau-tua);
        color: #FFFFFF;
    }

    .search-tab-btn input[type="radio"] {
        accent-color: var(--kuning-emas);
    }

    .search-input-group {
        border-right: 1px solid var(--abu-baris);
    }

    @media (max-width: 991px) {
        .search-input-group {
            border-right: none;
            border-bottom: 1px solid var(--abu-baris);
            padding-bottom: 0.75rem;
            margin-bottom: 0.75rem;
        }
    }

    /* Hero Stats Strip */
    .hero-stat-item {
        border-left: 2px solid rgba(228, 165, 33, 0.6);
        padding-left: 1rem;
        text-align: left;
    }

    .hero-stat-number {
        font-family: 'IBM Plex Mono', monospace;
        font-weight: 700;
        font-size: 2.2rem;
        color: var(--kuning-emas);
        line-height: 1.1;
    }

    .hero-stat-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.8);
        font-family: 'Inter', sans-serif;
    }

    /* Properti Terbaru Architectural Background Section (Reference UI) */
    .section-properti-terbaru-bg {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        padding: 5rem 0 6rem 0;
        color: #FFFFFF;
    }

    .section-properti-terbaru-bg .container {
        position: relative;
        z-index: 2;
    }

    .card-properti-architectural {
        background-color: #FFFFFF;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.22);
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.3);
        cursor: pointer;
    }

    .card-properti-architectural:hover {
        transform: translateY(-10px);
        box-shadow: 0 24px 50px rgba(0, 0, 0, 0.35);
    }
</style>
@endpush

@section('content')
@php
    $bgHero = !empty($perusahaan->bg_hero) 
        ? asset('storage/' . $perusahaan->bg_hero) 
        : asset('images/hero-bg.png');
    $heroOpacityVal = isset($perusahaan->overlay_hero_opacity) 
        ? ($perusahaan->overlay_hero_opacity / 100) 
        : 0.80;
    $heroOpacityVal2 = min(1.0, $heroOpacityVal + 0.10);

    $bgTerbaru = !empty($perusahaan->bg_properti_terbaru)
        ? asset('storage/' . $perusahaan->bg_properti_terbaru)
        : asset('images/hero-bg.png');
    $terbaruOpacityVal = isset($perusahaan->overlay_terbaru_opacity) 
        ? ($perusahaan->overlay_terbaru_opacity / 100) 
        : 0.85;
    $terbaruOpacityVal2 = min(1.0, $terbaruOpacityVal + 0.10);
@endphp

<!-- Full Image Hero Section (HouseJakarta Style adapted with Admin Customizable Background & Opacity) -->
<section class="hero-full-image" style="background: linear-gradient(180deg, rgba(18, 58, 40, {{ $heroOpacityVal }}) 0%, rgba(18, 58, 40, {{ $heroOpacityVal2 }}) 100%), url('{{ $bgHero }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container">
        <div class="row justify-content-center text-center mb-4">
            <div class="col-lg-10">
                <span class="badge bg-warning text-dark font-heading fw-bold px-3 py-2 mb-3 text-uppercase" style="letter-spacing: 0.08em; background-color: var(--kuning-emas) !important;">
                    <i class="bi bi-shield-check me-1"></i> Agensi Properti Terdepan di Banjarmasin
                </span>

                <h1 class="font-hero display-3 text-white mb-3 text-uppercase" style="text-shadow: 0 4px 16px rgba(0,0,0,0.4);">
                    Pemasaran Properti Premium<br>
                    <span style="color: var(--kuning-emas);">Berkah Cahaya Alfatih</span>
                </h1>

                <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 800px; font-size: 1.15rem;">
                    Berkah Cahaya Alfatih hadir untuk mempermudah perjalanan Anda dalam menemukan hunian impian dan investasi properti bernilai tinggi di Banjarmasin.
                </p>
            </div>
        </div>

        <!-- Floating Tabbed Search Widget -->
        <div class="search-widget-card text-start mb-5">
            <form method="GET" action="{{ route('properti.index') }}" id="searchForm">
                {{-- Tabs: Dijual / Disewakan --}}
                <div class="search-tabs">
                    <label class="search-tab-btn active" id="tabJual">
                        <input type="radio" name="transaksi" value="jual" checked onchange="updateTabStyle(this)">
                        <i class="bi bi-house-door-fill me-1"></i> Dijual
                    </label>
                    <label class="search-tab-btn" id="tabSewa">
                        <input type="radio" name="transaksi" value="sewa" onchange="updateTabStyle(this)">
                        <i class="bi bi-key-fill me-1"></i> Disewakan
                    </label>
                </div>

                {{-- Search Bar Row --}}
                <div class="row g-2 align-items-center">
                    <div class="col-lg-4 search-input-group">
                        <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-search me-1"></i> Kata Kunci</label>
                        <input type="text" name="search" class="form-control border-0 p-0 shadow-none text-dark fw-semibold"
                               placeholder="Cari nama properti, lokasi, kode...">
                    </div>

                    <div class="col-lg-4 search-input-group">
                        <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-building me-1"></i> Jenis Properti</label>
                        <select name="kategori" class="form-select border-0 p-0 shadow-none text-dark fw-semibold">
                            <option value="">Pilih Jenis Properti</option>
                            @foreach($kategoriList as $k)
                                <option value="{{ $k->slug }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 search-input-group border-0">
                        <label class="form-label small fw-bold text-muted mb-1"><i class="bi bi-geo-alt me-1"></i> Status / Urutan</label>
                        <select name="status" class="form-select border-0 p-0 shadow-none text-dark fw-semibold">
                            <option value="">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="negosiasi">Dalam Negosiasi</option>
                        </select>
                    </div>

                    <div class="col-lg-1">
                        <button type="submit" class="btn btn-gold btn-lg w-100 py-3 d-flex align-items-center justify-content-center" title="Cari Properti">
                            <i class="bi bi-search fs-5"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Hero Stats Counter Strip (Dynamic Count-Up Loader Animation, Only Filled Items Rendered) -->
        @php
            $activeMetrics = [];
            for ($i = 1; $i <= 4; $i++) {
                $nK = "stat_{$i}_number";
                $sK = "stat_{$i}_suffix";
                $lK = "stat_{$i}_label";
                if (filled($perusahaan->$nK) && (int)$perusahaan->$nK > 0 && filled($perusahaan->$lK)) {
                    $activeMetrics[] = [
                        'number' => (int)$perusahaan->$nK,
                        'suffix' => $perusahaan->$sK ?? '',
                        'label' => $perusahaan->$lK,
                    ];
                }
            }
            $mCount = count($activeMetrics);
            $mColClass = match($mCount) {
                3 => 'col-12 col-sm-4',
                2 => 'col-6 col-sm-6',
                1 => 'col-12 col-sm-6',
                default => 'col-6 col-md-3'
            };
        @endphp

        @if($mCount > 0)
            <div class="row g-4 justify-content-center text-start" id="heroStatsSection">
                @foreach($activeMetrics as $m)
                    <div class="{{ $mColClass }}">
                        <div class="hero-stat-item">
                            <div class="hero-stat-number" data-target="{{ $m['number'] }}" data-suffix="{{ $m['suffix'] }}">0{{ $m['suffix'] }}</div>
                            <div class="hero-stat-label">{{ $m['label'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<!-- Torn Edge Divider (Signature element transition into Cream Content) -->
<div class="torn-divider">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L0,40 L40,15 L90,45 L150,10 L210,50 L270,20 L330,40 L400,10 L470,45 L540,15 L600,40 L660,10 L730,50 L800,20 L870,45 L940,15 L1010,40 L1080,10 L1150,45 L1200,20 L1200,120 L0,120 Z"></path>
    </svg>
</div>

<!-- Kategori Quick Filter Section -->
<section class="py-4 bg-sage">
    <div class="container text-center">
        <div class="d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('properti.index') }}" class="btn btn-sm btn-outline-dark fw-bold px-3 py-2 rounded-pill">
                Semua Properti ({{ $totalTersedia }})
            </a>
            @foreach($kategoriList as $k)
                <a href="{{ route('properti.index', ['kategori' => $k->slug]) }}"
                   class="btn btn-sm btn-light border fw-bold text-dark px-3 py-2 rounded-pill">
                    <i class="bi bi-tag-fill me-1 text-success"></i>{{ $k->nama_kategori }} ({{ $k->properti_count }})
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Properti Unggulan (Aesthetic Real Estate Grid, PRD Compliant) -->
<section class="py-5 bg-white">
    <div class="container">
        {{-- Section Header --}}
        <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-between mb-4 pb-3 border-bottom" style="border-color: var(--abu-baris) !important;">
            <div>
                <span class="badge font-heading fw-bold px-2 py-1 mb-2 text-dark" style="background-color: var(--kuning-emas); border-radius: 2px;">
                    <i class="bi bi-fire me-1"></i> PENAWARAN EKSKLUSIF
                </span>
                <h2 class="font-hero display-6 mb-1" style="color: var(--hijau-tua);">Properti Unggulan</h2>
                <p class="text-muted mb-0 small">Koleksi hunian & tanah favorit pilihan konsumen dengan lokasi dan legalitas terjamin.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('properti.index', ['unggulan' => '1']) }}" class="btn btn-outline-brand btn-sm">
                    Lihat Semua Unggulan <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        {{-- Cards Grid --}}
        <div class="row g-4">
            @foreach($propertiUnggulan as $p)
                <div class="col-md-6 col-lg-4">
                    <div class="card-properti h-100 d-flex flex-column" onclick="window.location.href='{{ route('properti.detail', $p->slug) }}'">
                        <div class="card-img-wrapper">
                            <div class="gallery-loader-overlay" id="loader-ung-{{ $p->id }}">
                                <div class="loader"></div>
                            </div>
                            @if($p->foto_utama)
                                <img src="{{ asset('storage/' . $p->foto_utama) }}" alt="{{ $p->judul }}" onload="const el = document.getElementById('loader-ung-{{ $p->id }}'); if(el) el.style.display='none';">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-building fs-1"></i>
                                </div>
                            @endif

                            {{-- Badges --}}
                            <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-1">
                                <span class="badge-gold"><i class="bi bi-star-fill me-1"></i>Unit Terbatas</span>
                                @if($p->is_promo && $p->promo)
                                    <span class="badge bg-danger text-white font-heading fw-bold px-2 py-1 small">Promo</span>
                                @endif
                            </div>

                            <div class="position-absolute bottom-0 end-0 m-3">
                                @switch($p->status_properti)
                                    @case('tersedia')
                                        <span class="badge badge-status-tersedia px-2 py-1"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                                        @break
                                    @case('terjual')
                                        <span class="badge badge-status-terjual px-2 py-1"><i class="bi bi-x-circle me-1"></i>Terjual</span>
                                        @break
                                    @case('disewa')
                                        <span class="badge badge-status-disewa px-2 py-1"><i class="bi bi-house me-1"></i>Disewa</span>
                                        @break
                                    @case('negosiasi')
                                        <span class="badge badge-status-negosiasi px-2 py-1"><i class="bi bi-clock me-1"></i>Negosiasi</span>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-light text-dark font-mono border">{{ $p->kode_properti }}</span>
                                <span class="badge bg-sage text-success font-heading fw-semibold">{{ $p->kategori->nama_kategori ?? 'Properti' }}</span>
                            </div>

                            <h5 class="font-heading fs-5 mb-2 text-dark text-truncate" title="{{ $p->judul }}">
                                <a href="{{ route('properti.detail', $p->slug) }}" class="text-decoration-none text-dark">
                                    {{ $p->judul }}
                                </a>
                            </h5>

                            <p class="small text-muted mb-3">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $p->alamat }}, {{ $p->kota }}
                            </p>

                            <div class="font-mono fs-4 fw-bold mb-3" style="color: var(--hijau-utama);">
                                {{ $p->harga_format }}
                            </div>

                            <div class="pt-3 border-top mt-auto d-flex justify-content-between text-muted small">
                                @if($p->jumlah_kamar_tidur)
                                    <span title="Kamar Tidur"><i class="bi bi-door-closed me-1"></i>{{ $p->jumlah_kamar_tidur }} KT</span>
                                @endif
                                @if($p->jumlah_kamar_mandi)
                                    <span title="Kamar Mandi"><i class="bi bi-badge-wc me-1"></i>{{ $p->jumlah_kamar_mandi }} KM</span>
                                @endif
                                @if($p->carport)
                                    <span title="Carport"><i class="bi bi-car-front me-1"></i>{{ $p->carport }}</span>
                                @endif
                                <span title="Luas Tanah"><i class="bi bi-aspect-ratio me-1"></i>{{ $p->luas_tanah }} m²</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Section Properti Terbaru (UI Reference Architectural Background + Horizontal Floating Cards) -->
<section class="section-properti-terbaru-bg" style="background-image: url('{{ $bgTerbaru }}');">
    <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(180deg, rgba(18, 58, 40, {{ $terbaruOpacityVal }}) 0%, rgba(18, 58, 40, {{ $terbaruOpacityVal2 }}) 100%); z-index: 1;"></div>
    <div class="container">
        {{-- Section Header --}}
        <div class="row align-items-end mb-5">
            <div class="col-lg-8">
                <span class="badge bg-warning text-dark font-heading fw-bold px-3 py-2 mb-3 text-uppercase" style="letter-spacing: 0.06em; background-color: var(--kuning-emas) !important;">
                    <i class="bi bi-stars me-1"></i> KOLEKSI EKSKLUSIF TERUPDATE
                </span>
                <h2 class="font-hero display-5 text-white mb-2">
                    Properti Terbaru
                </h2>
                <p class="lead text-white-50 mb-0" style="max-width: 600px;">
                    Temukan hunian impian dan investasi tanah strategis dengan arsitektur terbaik dan legalitas 100% aman di Banjarmasin.
                </p>
            </div>
            <div class="col-lg-4 text-lg-end d-none d-lg-block">
                <a href="{{ route('properti.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 font-heading fw-bold">
                    Lihat Katalog ({{ $totalTersedia }}) <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        {{-- Architectural Grid Cards Floating --}}
        <div class="row g-4 mb-5">
            @foreach($propertiTerbaru as $p)
                <div class="col-md-6 col-lg-4">
                    <div class="card-properti-architectural h-100 d-flex flex-column" onclick="window.location.href='{{ route('properti.detail', $p->slug) }}'">
                        <div class="card-img-wrapper" style="position: relative; height: 220px; overflow: hidden;">
                            <div class="gallery-loader-overlay" id="loader-ter-{{ $p->id }}">
                                <div class="loader"></div>
                            </div>
                            @if($p->foto_utama)
                                <img src="{{ asset('storage/' . $p->foto_utama) }}" alt="{{ $p->judul }}" style="width: 100%; height: 100%; object-fit: cover;" onload="const el = document.getElementById('loader-ter-{{ $p->id }}'); if(el) el.style.display='none';">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    <i class="bi bi-building fs-1"></i>
                                </div>
                            @endif

                            {{-- Badges --}}
                            <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-1" style="z-index: 2;">
                                @if($p->is_unggulan)
                                    <span class="badge-gold"><i class="bi bi-star-fill me-1"></i>Unit Terbatas</span>
                                @endif
                                @if($p->is_promo && $p->promo)
                                    <span class="badge bg-danger text-white font-heading fw-bold px-2 py-1 small">Promo</span>
                                @endif
                            </div>

                            <div class="position-absolute bottom-0 end-0 m-3" style="z-index: 2;">
                                @switch($p->status_properti)
                                    @case('tersedia')
                                        <span class="badge badge-status-tersedia px-2 py-1"><i class="bi bi-check-circle me-1"></i>Tersedia</span>
                                        @break
                                    @case('terjual')
                                        <span class="badge badge-status-terjual px-2 py-1"><i class="bi bi-x-circle me-1"></i>Terjual</span>
                                        @break
                                    @case('disewa')
                                        <span class="badge badge-status-disewa px-2 py-1"><i class="bi bi-house me-1"></i>Disewa</span>
                                        @break
                                    @case('negosiasi')
                                        <span class="badge badge-status-negosiasi px-2 py-1"><i class="bi bi-clock me-1"></i>Negosiasi</span>
                                        @break
                                @endswitch
                            </div>
                        </div>

                        <div class="p-4 d-flex flex-column flex-grow-1 bg-white">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="badge bg-light text-dark font-mono border">{{ $p->kode_properti }}</span>
                                <span class="badge bg-sage text-success font-heading fw-semibold">{{ $p->kategori->nama_kategori ?? 'Properti' }}</span>
                            </div>

                            <h5 class="font-heading fs-5 mb-2 text-dark text-truncate" title="{{ $p->judul }}">
                                <a href="{{ route('properti.detail', $p->slug) }}" class="text-decoration-none text-dark">
                                    {{ $p->judul }}
                                </a>
                            </h5>

                            <p class="small text-muted mb-3">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $p->alamat }}, {{ $p->kota }}
                            </p>

                            <div class="font-mono fs-4 fw-bold mb-3" style="color: var(--hijau-utama);">
                                {{ $p->harga_format }}
                            </div>

                            <div class="pt-3 border-top mt-auto d-flex justify-content-between text-muted small">
                                @if($p->jumlah_kamar_tidur)
                                    <span title="Kamar Tidur"><i class="bi bi-door-closed me-1"></i>{{ $p->jumlah_kamar_tidur }} KT</span>
                                @endif
                                @if($p->jumlah_kamar_mandi)
                                    <span title="Kamar Mandi"><i class="bi bi-badge-wc me-1"></i>{{ $p->jumlah_kamar_mandi }} KM</span>
                                @endif
                                @if($p->carport)
                                    <span title="Carport"><i class="bi bi-car-front me-1"></i>{{ $p->carport }}</span>
                                @endif
                                <span title="Luas Tanah"><i class="bi bi-aspect-ratio me-1"></i>{{ $p->luas_tanah }} m²</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Grand CTA Button Center --}}
        <div class="text-center pt-2">
            <a href="{{ route('properti.index') }}" class="btn-cta-gold shadow-lg">
                Lihat Semua Katalog Properti <i class="bi bi-arrow-right fs-5"></i>
            </a>
        </div>
    </div>
</section>

<!-- Promo Callout Banner -->
<section class="py-5 bg-white border-top border-bottom">
    <div class="container">
        <div class="bg-sage rounded-3 p-4 p-md-5 border border-success">
            <div class="row align-items-center g-4">
                <div class="col-xl-7">
                    <span class="badge bg-danger font-heading fw-bold px-3 py-2 mb-2">Penawaran Spesial</span>
                    <h3 class="font-heading fs-2 mb-2" style="color: var(--hijau-tua);">The Villa Grand Alfatih — Banjarmasin Timur</h3>
                    <p class="mb-0 text-dark">
                        Miliki hunian bernuansa villa impian dengan promo <strong>Cashback hingga 50 Juta</strong> dan <strong>DP fleksibel 5–20%</strong>. Unit terbatas, jangan sampai kehabisan!
                    </p>
                </div>
                <div class="col-xl-5">
                    <div class="d-flex flex-column flex-sm-row justify-content-xl-end gap-3">
                        <a href="{{ route('properti.detail', 'the-villa-grand-alfatih-tipe-50') }}" class="btn btn-gold btn-lg shadow-sm text-center">
                            Lihat Unit Tipe 50
                        </a>
                        <a href="{{ route('properti.detail', 'the-villa-grand-alfatih-tipe-70') }}" class="btn btn-brand btn-lg shadow-sm text-center">
                            Lihat Unit Tipe 70
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Profile Ringkas & Visi Misi -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="text-uppercase font-heading fw-bold small text-muted">Tentang Perusahaan</span>
                <h2 class="font-heading fs-2 mb-3" style="color: var(--hijau-tua);">PT Berkah Cahaya Alfatih</h2>
                <p class="text-secondary lead fs-6 mb-4">
                    {{ $perusahaan->deskripsi ?? 'Berkah Cahaya Alfatih adalah perusahaan yang bergerak di bidang pemasaran properti di Banjarmasin. Kami hadir untuk memberikan kemudahan bagi Anda dalam memiliki rumah impian dengan pelayanan jujur, transparan, dan profesional.' }}
                </p>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 bg-white border rounded">
                            <i class="bi bi-shield-check fs-2 text-success mb-2 d-block"></i>
                            <h6 class="font-heading fw-bold mb-1">Legalitas Terjamin</h6>
                            <p class="small text-muted mb-0">Seluruh unit properti dikelola dengan keabsahan dokumen resmi.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 bg-white border rounded">
                            <i class="bi bi-geo-alt fs-2 text-warning mb-2 d-block"></i>
                            <h6 class="font-heading fw-bold mb-1">Lokasi Strategis</h6>
                            <p class="small text-muted mb-0">Terjangkau dari pusat kota, sekolah, pasar, dan fasilitas publik.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('tentang-kami') }}" class="btn btn-outline-brand">
                    Baca Selengkapnya Tentang Kami <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow p-4" style="background-color: var(--hijau-tua); color: var(--putih); border-radius: 8px;">
                    <h4 class="font-heading mb-3 text-warning"><i class="bi bi-compass me-2"></i>Visi & Misi Perusahaan</h4>

                    <div class="mb-4">
                        <h6 class="font-heading text-white fw-bold mb-2">Visi Kami</h6>
                        <p class="small text-white-50 mb-0">
                            {{ $perusahaan->visi ?? 'Menjadi perusahaan pemasaran properti terpercaya dan terdepan yang memberikan solusi terbaik bagi masyarakat dalam memiliki hunian impian.' }}
                        </p>
                    </div>

                    <hr class="border-secondary">

                    <div>
                        <h6 class="font-heading text-white fw-bold mb-2">Misi Kami</h6>
                        <p class="small text-white-50 mb-0" style="white-space: pre-line;">
                            {{ $perusahaan->misi ?? "1. Menyediakan informasi properti lengkap & akurat.\n2. Memberikan pelayanan profesional dan amanah.\n3. Memanfaatkan teknologi untuk efisiensi transaksi." }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Strip -->
<section class="py-5 text-white text-center" style="background-color: var(--hijau-tua);">
    <div class="container">
        <h2 class="font-hero display-6 mb-3">Punya Pertanyaan Seputar Properti Kami?</h2>
        <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 650px;">
            Tim marketing kami (Fatur & Yafi) siap membantu menjawab pertanyaan Anda, menjadwalkan survei lokasi, hingga konsultasi skema DP dan KPR.
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-3">
            <a href="https://wa.me/6281351540304?text=Halo%20Fatur,%20saya%20ingin%20tanya%20properti%20Berkah%20Cahaya%20Alfatih"
               target="_blank" class="btn btn-gold btn-lg">
                <i class="bi bi-whatsapp me-2"></i> Hubungi Fatur (0813-5154-0304)
            </a>
            <a href="https://wa.me/6285173190869?text=Halo%20Yafi,%20saya%20ingin%20tanya%20properti%20Berkah%20Cahaya%20Alfatih"
               target="_blank" class="btn btn-outline-light btn-lg">
                <i class="bi bi-whatsapp me-2"></i> Hubungi Yafi (0851-7319-0869)
            </a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function updateTabStyle(radio) {
        document.querySelectorAll('.search-tab-btn').forEach(btn => btn.classList.remove('active'));
        if (radio.checked) {
            radio.closest('.search-tab-btn').classList.add('active');
        }
    }

    // Dynamic Count-Up Animation for Hero Stats
    function animateCounters() {
        const counters = document.querySelectorAll('.hero-stat-number[data-target]');
        const duration = 1800; // 1.8 seconds

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'), 10);
            const suffix = counter.getAttribute('data-suffix') || '';
            const startTime = performance.now();

            function updateCount(currentTime) {
                const elapsedTime = currentTime - startTime;
                const progress = Math.min(elapsedTime / duration, 1);

                // Ease-out cubic formula
                const easeProgress = 1 - Math.pow(1 - progress, 3);
                const currentCount = Math.floor(easeProgress * target);

                counter.innerText = currentCount + suffix;

                if (progress < 1) {
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target + suffix;
                }
            }

            requestAnimationFrame(updateCount);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const statsSection = document.getElementById('heroStatsSection');
        let animated = false;

        if (statsSection && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !animated) {
                        animated = true;
                        animateCounters();
                    }
                });
            }, { threshold: 0.2 });

            observer.observe(statsSection);
        } else {
            animateCounters();
        }
    });
</script>
@endpush
@endsection
