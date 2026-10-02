@extends('public.layouts.app')

@section('title', 'Katalog Properti — Berkah Cahaya Alfatih')

@section('content')
<!-- Header Page -->
<section class="py-4 bg-white border-bottom">
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
            <div>
                <h1 class="font-heading fs-2 mb-1" style="color: var(--hijau-tua);">Katalog Properti</h1>
                <p class="text-muted mb-0 small">Temukan hunian dan lokasi investasi terbaik di Banjarmasin</p>
            </div>
            <div class="mt-2 mt-md-0">
                <span class="badge bg-sage text-success font-heading fs-6 px-3 py-2 border">
                    <i class="bi bi-houses me-1"></i> {{ $totalHasil }} Properti Ditemukan
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Search Bar Section -->
<section class="py-4 bg-light border-bottom">
    <div class="container">
        <form method="GET" action="{{ route('properti.index') }}" class="card border-0 shadow-sm p-3">
            <div class="row g-2 align-items-center">
                {{-- Search Keyword --}}
                <div class="col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0"
                               placeholder="Cari kata kunci, lokasi, kode..." value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Dropdown Kategori --}}
                <div class="col-sm-6 col-lg-2">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $k)
                            <option value="{{ $k->slug }}" {{ request('kategori') === $k->slug ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown Transaksi --}}
                <div class="col-sm-6 col-lg-2">
                    <select name="transaksi" class="form-select">
                        <option value="">Tipe Transaksi</option>
                        <option value="jual" {{ request('transaksi') === 'jual' ? 'selected' : '' }}>Dijual</option>
                        <option value="sewa" {{ request('transaksi') === 'sewa' ? 'selected' : '' }}>Disewakan</option>
                    </select>
                </div>

                {{-- Dropdown Status --}}
                <div class="col-sm-6 col-lg-2">
                    <select name="status" class="form-select">
                        <option value="">Status Properti</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="terjual" {{ request('status') === 'terjual' ? 'selected' : '' }}>Terjual</option>
                        <option value="disewa" {{ request('status') === 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="negosiasi" {{ request('status') === 'negosiasi' ? 'selected' : '' }}>Negosiasi</option>
                    </select>
                </div>

                {{-- Dropdown Urutan --}}
                <div class="col-sm-6 col-lg-2">
                    <select name="sort" class="form-select">
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="harga_asc" {{ request('sort') === 'harga_asc' ? 'selected' : '' }}>Harga: Termurah</option>
                        <option value="harga_desc" {{ request('sort') === 'harga_desc' ? 'selected' : '' }}>Harga: Termahal</option>
                        <option value="populer" {{ request('sort') === 'populer' ? 'selected' : '' }}>Paling Banyak Dilihat</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                <small class="text-muted">
                    @if(request()->hasAny(['search', 'kategori', 'transaksi', 'status', 'sort']))
                        <i class="bi bi-funnel-fill text-warning me-1"></i> Filter aktif diterapkan
                    @endif
                </small>

                <div class="d-flex gap-2">
                    @if(request()->hasAny(['search', 'kategori', 'transaksi', 'status', 'sort']))
                        <a href="{{ route('properti.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>Reset Filter
                        </a>
                    @endif
                    <button type="submit" class="btn btn-sm btn-brand">
                        <i class="bi bi-filter me-1"></i>Terapkan Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- List Grid Properti Section -->
<section class="py-5">
    <div class="container">
        @if($properti->isEmpty())
            <div class="bg-white rounded p-5 text-center border">
                <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                <h4 class="font-heading text-dark mb-2">Belum Ada Properti yang Cocok</h4>
                <p class="text-muted mx-auto mb-4" style="max-width: 500px;">
                    Coba luaskan rentang kata kunci pencarian Anda, atau ganti filter kategori dan status properti.
                </p>
                <a href="{{ route('properti.index') }}" class="btn btn-brand">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Tampilkan Semua Properti
                </a>
            </div>
        @else
            <div class="row g-4">
                @foreach($properti as $p)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-properti h-100 d-flex flex-column" onclick="window.location.href='{{ route('properti.detail', $p->slug) }}'">
                            <div class="card-img-wrapper">
                                <div class="gallery-loader-overlay" id="loader-kat-{{ $p->id }}">
                                    <div class="loader"></div>
                                </div>
                                @if($p->foto_utama)
                                    <img src="{{ asset('storage/' . $p->foto_utama) }}" alt="{{ $p->judul }}" onload="const el = document.getElementById('loader-kat-{{ $p->id }}'); if(el) el.style.display='none';">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                        <i class="bi bi-building fs-1"></i>
                                    </div>
                                @endif

                                {{-- Badges --}}
                                <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-1">
                                    @if($p->is_unggulan)
                                        <span class="badge-gold"><i class="bi bi-star-fill me-1"></i>Unit Terbatas</span>
                                    @endif
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

                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-light text-dark font-mono border">{{ $p->kode_properti }}</span>
                                    <span class="badge bg-sage text-success font-heading fw-semibold">{{ $p->kategori->nama_kategori ?? 'Properti' }}</span>
                                </div>

                                <h5 class="font-heading fs-5 mb-2 text-dark text-truncate" title="{{ $p->judul }}">
                                    <a href="{{ route('properti.detail', $p->slug) }}" class="text-decoration-none text-dark">
                                        {{ $p->judul }}
                                    </a>
                                </h5>

                                <p class="small text-muted mb-2">
                                    <i class="bi bi-geo-alt-fill text-danger me-1"></i>{{ $p->alamat }}, {{ $p->kota }}
                                </p>

                                <div class="font-mono fs-4 fw-bold mb-3" style="color: var(--hijau-utama);">
                                    {{ $p->harga_format }}
                                </div>

                                {{-- Specs bar --}}
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

            {{-- Pagination --}}
            @if($properti->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $properti->links() }}
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
