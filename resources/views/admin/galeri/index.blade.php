@extends('admin.layouts.app')

@section('title', 'Galeri - ' . $properti->judul)

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.properti.edit', $properti) }}" class="btn btn-sm btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <div>
        <h4 class="mb-0 fw-bold">Galeri Foto</h4>
        <small class="text-muted">{{ $properti->kode_properti }} — {{ $properti->judul }}</small>
    </div>
</div>

{{-- Upload Foto --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-cloud-upload me-2"></i>Upload Foto</h6>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.galeri.store', $properti) }}" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-end g-3">
                <div class="col-md-8">
                    <label for="gambar" class="form-label fw-semibold">Pilih Foto (bisa lebih dari satu)</label>
                    <input type="file" class="form-control @error('gambar.*') is-invalid @enderror @error('gambar') is-invalid @enderror"
                           id="gambar" name="gambar[]" accept="image/jpeg,image/png,image/webp" multiple required>
                    @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @error('gambar.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <div class="form-text">Format: JPG, PNG, WebP. Maks: 2MB per foto.</div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-upload me-1"></i>Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Daftar Foto --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold"><i class="bi bi-images me-2"></i>Daftar Foto ({{ $galeri->count() }})</h6>
    </div>
    <div class="card-body p-4">
        @if($galeri->isEmpty())
            <div class="text-center text-muted py-5">
                <i class="bi bi-images fs-1 d-block mb-2"></i>
                <p>Belum ada foto di galeri.</p>
            </div>
        @else
            <div class="row g-3">
                @foreach($galeri as $foto)
                    <div class="col-md-4 col-sm-6">
                        <div class="card h-100 border {{ $properti->foto_utama === $foto->gambar ? 'border-primary border-2' : '' }}">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->keterangan }}"
                                     class="card-img-top" style="height: 200px; object-fit: cover;">
                                @if($properti->foto_utama === $foto->gambar)
                                    <span class="position-absolute top-0 start-0 m-2 badge bg-primary">
                                        <i class="bi bi-star-fill me-1"></i>Cover
                                    </span>
                                @endif
                            </div>
                            <div class="card-body p-3">
                                {{-- Keterangan --}}
                                <form action="{{ route('admin.galeri.update-keterangan', [$properti, $foto]) }}" method="POST" class="mb-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="keterangan" class="form-control"
                                               value="{{ $foto->keterangan }}" placeholder="Tambah keterangan...">
                                        <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-check"></i></button>
                                    </div>
                                </form>

                                <div class="d-flex gap-1">
                                    {{-- Set Cover --}}
                                    @if($properti->foto_utama !== $foto->gambar)
                                        <form action="{{ route('admin.galeri.set-cover', [$properti, $foto]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-primary" title="Jadikan cover">
                                                <i class="bi bi-star"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Hapus --}}
                                    <form action="{{ route('admin.galeri.destroy', [$properti, $foto]) }}" method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
