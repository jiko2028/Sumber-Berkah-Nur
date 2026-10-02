@extends('admin.layouts.app')

@section('title', 'Pesan Masuk')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Pesan Masuk</h4>
        <p class="text-muted mb-0">Pesan dari calon konsumen</p>
    </div>
</div>

{{-- Filter & Search --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.pesan.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0"
                               placeholder="Cari nama, email, subjek, isi pesan..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="belum_dibaca" {{ request('status') === 'belum_dibaca' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="sudah_dibaca" {{ request('status') === 'sudah_dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.pesan.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-lg"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" width="50">No</th>
                        <th>Pengirim</th>
                        <th>Subjek / Pesan</th>
                        <th>Properti Terkait</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="pe-3" width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesan as $index => $p)
                        <tr class="{{ $p->status_baca === 'belum_dibaca' ? 'table-warning' : '' }}">
                            <td class="ps-3">{{ $pesan->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $p->nama }}</div>
                                <small class="text-muted">{{ $p->email }}</small>
                            </td>
                            <td>
                                <a href="{{ route('admin.pesan.show', $p) }}" class="text-decoration-none">
                                    <div class="fw-semibold text-dark">{{ $p->subjek ?: '(Tanpa subjek)' }}</div>
                                    <small class="text-muted">{{ Str::limit($p->pesan, 60) }}</small>
                                </a>
                            </td>
                            <td>
                                @if($p->properti)
                                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $p->properti->kode_properti }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($p->status_baca === 'belum_dibaca')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-envelope-fill me-1"></i>Belum Dibaca</span>
                                @else
                                    <span class="badge bg-light text-muted"><i class="bi bi-envelope-open me-1"></i>Sudah Dibaca</span>
                                @endif
                            </td>
                            <td>
                                <small>{{ $p->created_at->format('d M Y') }}</small><br>
                                <small class="text-muted">{{ $p->created_at->format('H:i') }}</small>
                            </td>
                            <td class="pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.pesan.show', $p) }}" class="btn btn-outline-primary" title="Lihat">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.pesan.toggle-baca', $p) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-outline-secondary"
                                                title="{{ $p->status_baca === 'belum_dibaca' ? 'Tandai Dibaca' : 'Tandai Belum Dibaca' }}">
                                            <i class="bi {{ $p->status_baca === 'belum_dibaca' ? 'bi-envelope-open' : 'bi-envelope' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.pesan.destroy', $p) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-envelope-open fs-1 d-block mb-2"></i>
                                Tidak ada pesan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pesan->hasPages())
        <div class="card-footer bg-white">
            {{ $pesan->links() }}
        </div>
    @endif
</div>
@endsection
