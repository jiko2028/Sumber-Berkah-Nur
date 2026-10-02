@extends('admin.layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold">Kelola Kategori</h4>
        <p class="text-muted mb-0">Kelola kategori properti yang tersedia</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
    </a>
</div>

{{-- Search --}}
<div class="card border-0 shadow-sm mb-3">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.kategori.index') }}">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" name="search" class="form-control border-start-0"
                       placeholder="Cari nama kategori..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
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
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Deskripsi</th>
                        <th width="100">Properti</th>
                        <th width="140" class="pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $index => $k)
                        <tr>
                            <td class="ps-3">{{ $kategori->firstItem() + $index }}</td>
                            <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                            <td><code>{{ $k->slug }}</code></td>
                            <td>
                                <span class="text-muted">{{ Str::limit($k->deskripsi, 50) ?: '-' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">{{ $k->properti_count }} properti</span>
                            </td>
                            <td class="pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.kategori.edit', $k) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori.destroy', $k) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data kategori.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($kategori->hasPages())
        <div class="card-footer bg-white">
            {{ $kategori->links() }}
        </div>
    @endif
</div>
@endsection
