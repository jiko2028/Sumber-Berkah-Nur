@extends('public.layouts.app')

@section('title', 'Hubungi Kami — Berkah Cahaya Alfatih')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center py-4 py-md-5">
    <div class="container">
        <h1 class="font-hero display-5 text-white mb-2">Hubungi Kami</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 600px;">
            Kami siap membantu menjawab pertanyaan Anda seputar properti, jadwal survei lokasi, hingga bantuan skema pembiayaan.
        </p>
    </div>
</section>

<!-- Torn Edge Divider -->
<div class="torn-divider">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L0,40 L40,15 L90,45 L150,10 L210,50 L270,20 L330,40 L400,10 L470,45 L540,15 L600,40 L660,10 L730,50 L800,20 L870,45 L940,15 L1010,40 L1080,10 L1150,45 L1200,20 L1200,120 L0,120 Z"></path>
    </svg>
</div>

<!-- Contact Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Form Kontak --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm p-4 p-md-5 bg-white">
                    <h3 class="font-heading fs-3 mb-2" style="color: var(--hijau-tua);">Kirim Pesan</h3>
                    <p class="text-muted small mb-4">Isi formulir di bawah ini dan tim kami akan segera membalas pertanyaan Anda.</p>

                    @if(session('success_pesan'))
                        <div class="alert alert-success alert-dismissible fade show p-3 mb-4" role="alert">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill fs-4 text-success"></i>
                                <div>
                                    <strong class="font-heading">Terima kasih!</strong><br>
                                    <span>{{ session('success_pesan') }}</span>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('kontak.kirim') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold text-dark">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                   id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama Anda" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold text-dark">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="no_telepon" class="form-label fw-semibold text-dark">No. WhatsApp / Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_telepon') is-invalid @enderror"
                                       id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}" placeholder="081234567890" required>
                                @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subjek" class="form-label fw-semibold text-dark">Subjek / Topik</label>
                            <input type="text" class="form-control @error('subjek') is-invalid @enderror"
                                   id="subjek" name="subjek" value="{{ old('subjek') }}" placeholder="Misal: Tanya Tipe 50 / Jadwal Survei">
                            @error('subjek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pesan" class="form-label fw-semibold text-dark">Isi Pesan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('pesan') is-invalid @enderror"
                                      id="pesan" name="pesan" rows="5" placeholder="Tuliskan pertanyaan atau kebutuhan properti Anda di sini..." required>{{ old('pesan') }}</textarea>
                            @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-brand btn-lg w-100">
                            <i class="bi bi-send-fill me-2"></i> Kirim Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Info Kontak & Peta --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm p-4 mb-4" style="background-color: var(--hijau-tua); color: var(--putih);">
                    <h4 class="font-heading text-white mb-3 fs-5"><i class="bi bi-info-circle me-2 text-warning"></i>Informasi Kontak Kantor</h4>

                    <div class="d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-geo-alt-fill fs-4 text-warning"></i>
                        <div>
                            <strong class="d-block text-white font-heading">Alamat Kantor Pemasaran</strong>
                            <span class="small text-white-50">{{ $perusahaan->alamat ?? 'Jl. Pramuka GG Kasturi, RT.12, Banjarmasin Timur' }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-whatsapp fs-4 text-success"></i>
                        <div>
                            <strong class="d-block text-white font-heading">Kontak Marketing WhatsApp</strong>
                            <span class="small text-white-50">Fatur: 0813-5154-0304</span><br>
                            <span class="small text-white-50">Yafi: 0851-7319-0869</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3 mb-3">
                        <i class="bi bi-envelope-fill fs-4 text-warning"></i>
                        <div>
                            <strong class="d-block text-white font-heading">Email Resmi</strong>
                            <span class="small text-white-50">{{ $perusahaan->email ?? 'info@berkahcahayaalfatih.com' }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3">
                        <i class="bi bi-clock-fill fs-4 text-warning"></i>
                        <div>
                            <strong class="d-block text-white font-heading">Jam Operasional</strong>
                            <span class="small text-white-50">{{ $perusahaan->jam_operasional ?? 'Senin - Sabtu, 08:00 - 17:00 WITA' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3">
                        <h6 class="font-heading mb-0 text-dark"><i class="bi bi-map me-2 text-success"></i>Lokasi Google Maps</h6>
                    </div>
                    <div class="card-body p-0" style="height: 250px;">
                        @if($perusahaan->peta_lokasi)
                            {!! $perusahaan->peta_lokasi !!}
                        @else
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15932.179782531393!2d114.6146!3d-3.3275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de4238e8211b5e3%3A0x62955f137e3d387b!2sBanjarmasin%20Timur%2C%20Banjarmasin%20City%2C%20South%20Kalimantan!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                                    width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
