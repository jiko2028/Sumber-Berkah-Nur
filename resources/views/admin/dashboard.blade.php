@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
{{-- Statistik Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Properti</p>
                        <h3 class="mb-0 fw-bold">{{ $stats['total_properti'] }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10">
                        <i class="bi bi-houses text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Tersedia</p>
                        <h3 class="mb-0 fw-bold text-success">{{ $stats['properti_tersedia'] }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-success bg-opacity-10">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Pesan Belum Dibaca</p>
                        <h3 class="mb-0 fw-bold text-danger">{{ $stats['pesan_belum_dibaca'] }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-danger bg-opacity-10">
                        <i class="bi bi-envelope text-danger fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Views</p>
                        <h3 class="mb-0 fw-bold text-info">{{ number_format($stats['total_views']) }}</h3>
                    </div>
                    <div class="rounded-3 p-3 bg-info bg-opacity-10">
                        <i class="bi bi-eye text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Detail statistik --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-tags text-muted fs-5"></i>
                    <div>
                        <p class="text-muted small mb-0">Kategori</p>
                        <h5 class="mb-0 fw-bold">{{ $stats['total_kategori'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-cart-check text-warning fs-5"></i>
                    <div>
                        <p class="text-muted small mb-0">Terjual</p>
                        <h5 class="mb-0 fw-bold">{{ $stats['properti_terjual'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-house-door text-info fs-5"></i>
                    <div>
                        <p class="text-muted small mb-0">Disewa</p>
                        <h5 class="mb-0 fw-bold">{{ $stats['properti_disewa'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body py-3">
                <div class="d-flex align-items-center gap-3">
                    <i class="bi bi-chat-dots text-secondary fs-5"></i>
                    <div>
                        <p class="text-muted small mb-0">Negosiasi</p>
                        <h5 class="mb-0 fw-bold">{{ $stats['properti_negosiasi'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Properti Terbaru --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-houses me-2"></i>Properti Terbaru</h6>
                <a href="{{ route('admin.properti.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @if($propertiTerbaru->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        Belum ada data properti.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Kode</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th class="pe-3">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($propertiTerbaru as $p)
                                    <tr>
                                        <td class="ps-3">
                                            <span class="badge bg-light text-dark font-monospace">{{ $p->kode_properti }}</span>
                                        </td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">{{ $p->judul }}</div>
                                        </td>
                                        <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $p->kategori->nama_kategori ?? '-' }}</span></td>
                                        <td>
                                            @switch($p->status_properti)
                                                @case('tersedia')
                                                    <span class="badge bg-success">Tersedia</span>
                                                    @break
                                                @case('terjual')
                                                    <span class="badge bg-danger">Terjual</span>
                                                    @break
                                                @case('disewa')
                                                    <span class="badge bg-info">Disewa</span>
                                                    @break
                                                @case('negosiasi')
                                                    <span class="badge bg-warning text-dark">Negosiasi</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td class="pe-3 fw-semibold">{{ $p->harga_format }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Pesan Terbaru --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-envelope me-2"></i>Pesan Terbaru</h6>
                <a href="{{ route('admin.pesan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @if($pesanTerbaru->isEmpty())
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-envelope-open fs-1 d-block mb-2"></i>
                        Tidak ada pesan baru.
                    </div>
                @else
                    <div class="list-group list-group-flush">
                        @foreach($pesanTerbaru as $pesan)
                            <a href="{{ route('admin.pesan.show', $pesan->id) }}" class="list-group-item list-group-item-action px-3 py-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1 fw-semibold">{{ $pesan->nama }}</h6>
                                        <p class="mb-1 text-muted small text-truncate" style="max-width: 250px;">
                                            {{ $pesan->subjek ?? $pesan->pesan }}
                                        </p>
                                    </div>
                                    <small class="text-muted">{{ $pesan->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
