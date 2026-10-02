@extends('admin.layouts.app')

@section('title', 'Kelola Properti')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Kelola Properti</h4>
        <p class="text-muted mb-0">Kelola data properti yang dipasarkan</p>
    </div>
    <a href="{{ route('admin.properti.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Properti
    </a>
</div>

{{-- Filter & Search --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.properti.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0"
                               placeholder="Cari judul, kode, alamat..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <select name="kategori_id" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoriList as $k)
                            <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="terjual" {{ request('status') === 'terjual' ? 'selected' : '' }}>Terjual</option>
                        <option value="disewa" {{ request('status') === 'disewa' ? 'selected' : '' }}>Disewa</option>
                        <option value="negosiasi" {{ request('status') === 'negosiasi' ? 'selected' : '' }}>Negosiasi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="publish" class="form-select">
                        <option value="">Publish</option>
                        <option value="1" {{ request('publish') === '1' ? 'selected' : '' }}>Published</option>
                        <option value="0" {{ request('publish') === '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-1">
                        <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
                        @if(request()->hasAny(['search', 'kategori_id', 'status', 'publish']))
                            <a href="{{ route('admin.properti.index') }}" class="btn btn-outline-secondary">
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
                        <th width="80">Foto</th>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Publish</th>
                        <th>Unggulan</th>
                        <th class="pe-3" width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properti as $index => $p)
                        <tr>
                            <td class="ps-3">{{ $properti->firstItem() + $index }}</td>
                            <td>
                                @if($p->foto_utama)
                                    <img src="{{ asset('storage/' . $p->foto_utama) }}" alt=""
                                         class="rounded" width="50" height="40" style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:50px;height:40px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td><span class="badge bg-light text-dark font-monospace">{{ $p->kode_properti }}</span></td>
                            <td>
                                <div class="text-truncate fw-semibold" style="max-width: 180px;" title="{{ $p->judul }}">
                                    {{ $p->judul }}
                                </div>
                                <small class="text-muted">{{ $p->kota }}</small>
                            </td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $p->kategori->nama_kategori ?? '-' }}</span></td>
                            <td class="fw-semibold text-nowrap">{{ $p->harga_format }}</td>
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
                            <td>
                                <form action="{{ route('admin.properti.toggle-publish', $p) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $p->is_publish ? 'btn-success' : 'btn-outline-secondary' }}" title="{{ $p->is_publish ? 'Published' : 'Draft' }}">
                                        <i class="bi {{ $p->is_publish ? 'bi-eye' : 'bi-eye-slash' }}"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.properti.toggle-unggulan', $p) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $p->is_unggulan ? 'btn-warning' : 'btn-outline-secondary' }}" title="{{ $p->is_unggulan ? 'Unggulan' : 'Biasa' }}">
                                        <i class="bi {{ $p->is_unggulan ? 'bi-star-fill' : 'bi-star' }}"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.galeri.index', $p) }}" class="btn btn-outline-info" title="Galeri">
                                        <i class="bi bi-images"></i>
                                    </a>
                                    <a href="{{ route('admin.properti.edit', $p) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.properti.destroy', $p) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus properti ini?')">
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
                            <td colspan="10" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data properti.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($properti->hasPages())
        <div class="card-footer bg-white">
            {{ $properti->links() }}
        </div>
    @endif
</div>
@endsection
