@extends('admin.layouts.app')

@section('title', 'Detail Pesan')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('admin.pesan.index') }}" class="btn btn-sm btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h4 class="mb-0 fw-bold">Detail Pesan</h4>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $pesan->subjek ?: '(Tanpa subjek)' }}</h5>
                        <p class="text-muted mb-0">
                            <i class="bi bi-clock me-1"></i>{{ $pesan->created_at->format('d M Y, H:i') }}
                            · {{ $pesan->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="d-flex gap-1">
                        <form action="{{ route('admin.pesan.toggle-baca', $pesan) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-outline-secondary"
                                    title="{{ $pesan->status_baca === 'sudah_dibaca' ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}">
                                <i class="bi {{ $pesan->status_baca === 'sudah_dibaca' ? 'bi-envelope' : 'bi-envelope-open' }}"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.pesan.destroy', $pesan) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <hr>

                {{-- Info Pengirim --}}
                <div class="row mb-4">
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Nama Pengirim</p>
                        <p class="fw-semibold mb-0">{{ $pesan->nama }}</p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Email</p>
                        <p class="mb-0"><a href="mailto:{{ $pesan->email }}">{{ $pesan->email }}</a></p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">No. Telepon</p>
                        <p class="mb-0"><a href="tel:{{ $pesan->no_telepon }}">{{ $pesan->no_telepon }}</a></p>
                    </div>
                </div>

                {{-- Properti Terkait --}}
                @if($pesan->properti)
                    <div class="alert alert-info py-2 mb-4">
                        <i class="bi bi-link-45deg me-1"></i>
                        Terkait properti:
                        <strong>{{ $pesan->properti->kode_properti }} — {{ $pesan->properti->judul }}</strong>
                    </div>
                @endif

                {{-- Isi Pesan --}}
                <div class="bg-light rounded p-4">
                    <h6 class="fw-semibold mb-3"><i class="bi bi-chat-text me-2"></i>Isi Pesan</h6>
                    <div style="white-space: pre-wrap;">{{ $pesan->pesan }}</div>
                </div>

                {{-- Quick Reply Links --}}
                <div class="mt-4 d-flex gap-2">
                    <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-envelope me-1"></i>Balas via Email
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->no_telepon) }}" target="_blank" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-whatsapp me-1"></i>Hubungi via WhatsApp
                    </a>
                    <a href="tel:{{ $pesan->no_telepon }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-telephone me-1"></i>Telepon
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
