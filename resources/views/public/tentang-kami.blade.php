@extends('public.layouts.app')

@section('title', 'Tentang Kami — Berkah Cahaya Alfatih')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center py-5">
    <div class="container">
        <h1 class="font-hero display-5 text-white mb-2">Tentang Berkah Cahaya Alfatih</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 650px;">
            Mitra Pemasaran Properti Terpercaya & Amanah di Banjarmasin
        </p>
    </div>
</section>

<!-- Torn Edge Divider -->
<div class="torn-divider">
    <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 L0,40 L40,15 L90,45 L150,10 L210,50 L270,20 L330,40 L400,10 L470,45 L540,15 L600,40 L660,10 L730,50 L800,20 L870,45 L940,15 L1010,40 L1080,10 L1150,45 L1200,20 L1200,120 L0,120 Z"></path>
    </svg>
</div>

<!-- Profile Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <span class="text-uppercase font-heading fw-bold small text-muted">Profil Singkat</span>
                <h2 class="font-heading fs-2 mb-3" style="color: var(--hijau-tua);">Berkah Cahaya Alfatih</h2>
                <p class="lh-lg text-secondary mb-4">
                    {{ $perusahaan->deskripsi ?? 'Berkah Cahaya Alfatih adalah perusahaan yang bergerak di bidang pemasaran properti di Banjarmasin. Selama bertahun-tahun, kami berdedikasi membantu masyarakat dalam menemukan hunian terbaik yang aman, nyaman, dan strategis.' }}
                </p>

                <div class="p-3 bg-sage rounded border border-success mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-patch-check-fill fs-1 text-success"></i>
                        <div>
                            <h6 class="font-heading mb-1 font-bold text-dark">Layanan Profesional & Amanah</h6>
                            <p class="small text-muted mb-0">Kami mendampingi proses dari pemilihan lokasi, kunjungan survei, skema DP, hingga serah terima unit.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm border text-center">
                    <img src="{{ asset($perusahaan->logo ? 'storage/' . $perusahaan->logo : 'images/logo.jpg') }}" alt="Logo" class="rounded-circle border border-3 border-warning shadow-sm mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                    <h3 class="font-heading fs-4 mb-1" style="color: var(--hijau-tua);">{{ $perusahaan->nama_perusahaan }}</h3>
                    <p class="text-muted small mb-4">Pemasaran Properti & Pengembang Hunian</p>

                    @php
                        $aboutMetrics = [];
                        $colors = ['text-success', 'text-warning', 'text-primary', 'text-dark'];
                        for ($i = 1; $i <= 4; $i++) {
                            $nK = "stat_{$i}_number";
                            $sK = "stat_{$i}_suffix";
                            $lK = "stat_{$i}_label";
                            if (filled($perusahaan->$nK) && (int)$perusahaan->$nK > 0 && filled($perusahaan->$lK)) {
                                $aboutMetrics[] = [
                                    'number' => (int)$perusahaan->$nK,
                                    'suffix' => $perusahaan->$sK ?? '',
                                    'label' => $perusahaan->$lK,
                                    'color' => $colors[($i - 1) % 4],
                                ];
                            }
                        }
                        $aCount = count($aboutMetrics);
                        $aColClass = match($aCount) {
                            3 => 'col-12 col-sm-4',
                            2 => 'col-6 col-sm-6',
                            1 => 'col-12 col-sm-6',
                            default => 'col-6 col-sm-3'
                        };
                    @endphp

                    @if($aCount > 0)
                        <div class="row g-3 text-start" id="aboutStatsSection">
                            @foreach($aboutMetrics as $am)
                                <div class="{{ $aColClass }}">
                                    <div class="p-3 bg-light rounded border text-center h-100">
                                        <span class="font-mono fs-2 fw-bold {{ $am['color'] }} d-block about-stat-number" data-target="{{ $am['number'] }}" data-suffix="{{ $am['suffix'] }}">0{{ $am['suffix'] }}</span>
                                        <small class="text-muted" style="font-size: 0.75rem;">{{ $am['label'] }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Vision & Mission Cards -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4" style="background-color: var(--hijau-tua); color: var(--putih);">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-warning text-dark rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-eye-fill fs-5"></i>
                        </div>
                        <h4 class="font-heading text-white mb-0 fs-5">Visi Perusahaan</h4>
                    </div>
                    <p class="lh-lg text-white-50 mb-0">
                        {{ $perusahaan->visi ?? 'Menjadi perusahaan pemasaran properti terpercaya dan terdepan yang memberikan solusi terbaik bagi masyarakat dalam memiliki hunian impian.' }}
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100 p-4 bg-white">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: var(--hijau-utama) !important;">
                            <i class="bi bi-list-check fs-5"></i>
                        </div>
                        <h4 class="font-heading mb-0 fs-5" style="color: var(--hijau-tua);">Misi Perusahaan</h4>
                    </div>
                    <div class="lh-lg text-secondary mb-0" style="white-space: pre-line;">
                        {{ $perusahaan->misi ?? "1. Menyediakan informasi properti lengkap & akurat.\n2. Memberikan pelayanan profesional dan amanah.\n3. Memanfaatkan teknologi untuk efisiensi transaksi." }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function animateAboutCounters() {
        const counters = document.querySelectorAll('.about-stat-number[data-target]');
        const duration = 1800; // 1.8s

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'), 10);
            const suffix = counter.getAttribute('data-suffix') || '';
            const startTime = performance.now();

            function updateCount(currentTime) {
                const elapsedTime = currentTime - startTime;
                const progress = Math.min(elapsedTime / duration, 1);
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
        const statsSection = document.getElementById('aboutStatsSection');
        let animated = false;

        if (statsSection && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !animated) {
                        animated = true;
                        animateAboutCounters();
                    }
                });
            }, { threshold: 0.2 });

            observer.observe(statsSection);
        } else {
            animateAboutCounters();
        }
    });
</script>
@endpush
@endsection
