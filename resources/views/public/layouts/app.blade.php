@php
    $perusahaan = $perusahaan ?? \App\Models\InformasiPerusahaan::getData();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Berkah Cahaya Alfatih') — Pemasaran Properti Terpercaya</title>
    <meta name="description" content="@yield('meta_description', 'Berkah Cahaya Alfatih - Penyedia dan Pemasar Properti Terbaik di Banjarmasin. Temukan rumah impian Anda dengan harga dan lokasi terbaik.')">

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Archivo:wght@500;600;700;800&family=IBM+Plex+Mono:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --hijau-tua: #123A28;
            --hijau-utama: #1F6B3D;
            --hijau-muda: #E7EFE7;
            --kuning-emas: #E4A521;
            --krem: #F8F6F0;
            --arang: #20241F;
            --abu-baris: #D8D2C4;
            --putih: #FFFFFF;
            --merah-peringatan: #B3261E;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--krem);
            color: var(--arang);
            line-height: 1.6;
        }

        /* Typography Classes */
        .font-hero {
            font-family: 'Archivo Black', 'Arial Black', sans-serif;
            letter-spacing: -0.02em;
            text-transform: uppercase;
        }

        .font-heading {
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
        }

        .font-mono {
            font-family: 'IBM Plex Mono', monospace;
        }

        /* Navbar */
        .navbar-custom {
            background-color: var(--hijau-tua);
            padding: 0.85rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }

        .navbar-custom .navbar-brand {
            font-family: 'Archivo Black', sans-serif;
            color: var(--putih);
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .navbar-custom .navbar-brand .brand-logo {
            width: 36px;
            height: 36px;
            background-color: var(--hijau-utama);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--putih);
        }

        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-family: 'Archivo', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            transition: color 0.2s;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--kuning-emas);
        }

        /* Buttons */
        .btn-gold {
            background-color: var(--kuning-emas);
            color: var(--arang);
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            border: none;
            border-radius: 6px;
            padding: 0.6rem 1.3rem;
            transition: all 0.2s ease;
        }

        .btn-gold:hover {
            background-color: #d49519;
            color: var(--arang);
            box-shadow: 0 4px 12px rgba(228, 165, 33, 0.3);
        }

        .btn-brand {
            background-color: var(--hijau-utama);
            color: var(--putih);
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            border: none;
            border-radius: 6px;
            padding: 0.65rem 1.4rem;
            transition: all 0.2s ease;
        }

        .btn-brand:hover {
            background-color: #17542f;
            color: var(--putih);
            box-shadow: 0 4px 12px rgba(31, 107, 61, 0.3);
        }

        .btn-outline-brand {
            border: 2px solid var(--hijau-utama);
            color: var(--hijau-utama);
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            border-radius: 6px;
            padding: 0.6rem 1.3rem;
            background: transparent;
            transition: all 0.2s ease;
        }

        .btn-outline-brand:hover {
            background-color: var(--hijau-utama);
            color: var(--putih);
        }

        .btn-cta-gold {
            background-color: var(--kuning-emas);
            color: var(--arang);
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            border: 2px solid var(--kuning-emas);
            border-radius: 6px;
            padding: 0.85rem 2.2rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 14px rgba(228, 165, 33, 0.25);
            transition: all 0.25s ease;
        }

        .btn-cta-gold:hover {
            background-color: #d8991b;
            border-color: #d8991b;
            color: var(--arang);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(228, 165, 33, 0.35);
        }

        .section-title-accent {
            width: 48px;
            height: 4px;
            background-color: var(--hijau-utama);
            border-radius: 2px;
            margin-top: 0.5rem;
        }

        /* Property Cards */
        .card-properti {
            background: var(--putih);
            border: 1px solid var(--abu-baris);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card-properti:hover {
            transform: translateY(-5px);
            border-color: var(--hijau-utama);
            box-shadow: 0 12px 30px rgba(18, 58, 40, 0.1);
        }

        .card-properti .card-img-wrapper {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
            background-color: #e2e8f0;
        }

        .card-properti .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .card-properti:hover .card-img-wrapper img {
            transform: scale(1.06);
        }

        /* CSS Image Rendering Loader */
        .gallery-loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F8FAFC;
            z-index: 5;
            transition: opacity 0.3s ease;
        }

        .loader {
            width: 100px;
            height: 16px;
            border-radius: 20px;
            background:
                repeating-linear-gradient(135deg, var(--hijau-utama) 0 10px, var(--kuning-emas) 0 20px) 0/0% no-repeat,
                repeating-linear-gradient(135deg, #ddd 0 10px, #eee 0 20px) 0/100%;
            animation: l3 2s infinite;
        }

        @keyframes l3 {
            100% { background-size: 100%; }
        }

        .badge-gold {
            background-color: var(--kuning-emas);
            color: var(--arang);
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            font-size: 0.75rem;
            border-radius: 3px;
            padding: 0.35em 0.75em;
        }

        .badge-status-tersedia {
            background-color: var(--hijau-utama);
            color: var(--putih);
        }

        .badge-status-terjual {
            background-color: var(--merah-peringatan);
            color: var(--putih);
        }

        .badge-status-disewa {
            background-color: var(--hijau-tua);
            color: var(--krem);
        }

        .badge-status-negosiasi {
            background-color: var(--kuning-emas);
            color: var(--arang);
        }

        /* Stat Callout Boxes */
        .stat-callout {
            background-color: var(--putih);
            border: 1px solid var(--abu-baris);
            border-radius: 6px;
            padding: 1rem 1.25rem;
            text-align: center;
        }

        .stat-callout .label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            font-family: 'Archivo', sans-serif;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .stat-callout .val {
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--hijau-utama);
        }

        /* Hero Section */
        .hero-section {
            background-color: var(--hijau-tua);
            color: var(--putih);
            padding: 4.5rem 0 3.5rem 0;
            position: relative;
        }

        /* Torn Edge SVG Container */
        .torn-divider {
            width: 100%;
            overflow: hidden;
            line-height: 0;
            background-color: var(--hijau-tua);
        }

        .torn-divider svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 32px;
            fill: var(--krem);
        }

        /* Floating WhatsApp Button */
        .btn-floating-wa {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background-color: #25D366;
            color: #FFFFFF;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
            z-index: 999;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none;
        }

        .btn-floating-wa:hover {
            transform: scale(1.1);
            color: #FFFFFF;
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        }

        /* Footer */
        .footer-custom {
            background-color: var(--hijau-tua);
            color: rgba(255, 255, 255, 0.8);
            padding: 4rem 0 2rem 0;
            margin-top: 4rem;
            border-top: 4px solid var(--hijau-utama);
        }

        .footer-custom h6 {
            color: var(--putih);
            font-family: 'Archivo', sans-serif;
            font-weight: 700;
            margin-bottom: 1.25rem;
        }

        .footer-custom a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-custom a:hover {
            color: var(--kuning-emas);
        }

        /* Utilities */
        .bg-sage {
            background-color: var(--hijau-muda);
        }

        /* Custom Aesthetic Pagination */
        .pagination .page-item .page-link {
            color: var(--hijau-tua);
            border-color: #E2E8F0;
            padding: 0.5rem 0.9rem;
            font-family: 'Archivo', sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 6px;
            margin: 0 2px;
            transition: all 0.2s ease;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--hijau-utama) !important;
            border-color: var(--hijau-utama) !important;
            color: #FFFFFF !important;
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(31, 107, 61, 0.3);
        }

        .pagination .page-item .page-link:hover {
            background-color: var(--kuning-emas);
            border-color: var(--kuning-emas);
            color: var(--arang);
        }

        .pagination .page-item.disabled .page-link {
            color: #94A3B8;
            background-color: #F8FAFC;
        }

        @media (min-width: 992px) {
            .nav-capsule-center {
                position: absolute !important;
                left: 50% !important;
                transform: translateX(-50%) !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navbar Publik -->
    @if(request()->routeIs('home'))
        <!-- Floating Pill Header (HouseJakarta Style for Home Page) -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3 transition-all" id="homeNavbar" style="z-index: 1050; background: transparent; transition: all 0.3s ease;">
            <div class="container position-relative">
                <a class="navbar-brand d-flex align-items-center me-0" href="{{ route('home') }}" title="Berkah Cahaya Alfatih">
                    <img src="{{ asset($perusahaan->logo ? 'storage/' . $perusahaan->logo : 'images/logo.jpg') }}" alt="Logo" class="rounded-circle border border-2 border-warning shadow-sm" style="width: 48px; height: 48px; object-fit: cover;">
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarPublic">
                    {{-- Center Floating Capsule (Perfectly Centered on Desktop) --}}
                    <div class="my-2 my-lg-0 p-1 rounded-pill d-inline-flex align-items-center gap-1 shadow-lg nav-capsule-center" 
                         style="background: rgba(18, 58, 40, 0.92); backdrop-filter: blur(10px); border: none; outline: none;">
                        <a class="nav-link px-4 py-2 rounded-pill font-heading fw-bold {{ request()->routeIs('home') ? 'text-dark' : 'text-white hover-gold' }}" 
                           style="{{ request()->routeIs('home') ? 'background-color: var(--kuning-emas);' : '' }}" href="{{ route('home') }}">Beranda</a>
                        
                        <a class="nav-link px-4 py-2 rounded-pill font-heading fw-bold {{ request()->routeIs('properti*') ? 'text-dark' : 'text-white hover-gold' }}" 
                           style="{{ request()->routeIs('properti*') ? 'background-color: var(--kuning-emas);' : '' }}" href="{{ route('properti.index') }}">Properti</a>
                        
                        <a class="nav-link px-4 py-2 rounded-pill font-heading fw-bold {{ request()->routeIs('tentang-kami') ? 'text-dark' : 'text-white hover-gold' }}" 
                           style="{{ request()->routeIs('tentang-kami') ? 'background-color: var(--kuning-emas);' : '' }}" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                    </div>

                    {{-- Right Gold Button --}}
                    <a href="{{ route('kontak') }}" class="btn font-heading fw-bold px-4 py-2 rounded-pill shadow-sm ms-auto" style="background-color: var(--kuning-emas); color: var(--arang);">
                        Hubungi Kami <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </nav>
    @else
        <!-- Standard Sticky Navbar for Inner Pages (With Exact Same Floating Capsule Menu) -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top py-2">
            <div class="container position-relative">
                <a class="navbar-brand d-flex align-items-center me-0" href="{{ route('home') }}" title="Berkah Cahaya Alfatih">
                    <img src="{{ asset($perusahaan->logo ? 'storage/' . $perusahaan->logo : 'images/logo.jpg') }}" alt="Logo" class="rounded-circle border border-2 border-warning shadow-sm" style="width: 44px; height: 44px; object-fit: cover;">
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublic">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarPublic">
                    {{-- Center Floating Capsule (Identical HouseJakarta Style) --}}
                    <div class="my-2 my-lg-0 p-1 rounded-pill d-inline-flex align-items-center gap-1 shadow-lg nav-capsule-center" 
                         style="background: rgba(14, 46, 32, 0.95); backdrop-filter: blur(10px); border: none; outline: none;">
                        <a class="nav-link px-4 py-2 rounded-pill font-heading fw-bold {{ request()->routeIs('home') ? 'text-dark' : 'text-white hover-gold' }}" 
                           style="{{ request()->routeIs('home') ? 'background-color: var(--kuning-emas);' : '' }}" href="{{ route('home') }}">Beranda</a>
                        
                        <a class="nav-link px-4 py-2 rounded-pill font-heading fw-bold {{ request()->routeIs('properti*') ? 'text-dark' : 'text-white hover-gold' }}" 
                           style="{{ request()->routeIs('properti*') ? 'background-color: var(--kuning-emas);' : '' }}" href="{{ route('properti.index') }}">Properti</a>
                        
                        <a class="nav-link px-4 py-2 rounded-pill font-heading fw-bold {{ request()->routeIs('tentang-kami') ? 'text-dark' : 'text-white hover-gold' }}" 
                           style="{{ request()->routeIs('tentang-kami') ? 'background-color: var(--kuning-emas);' : '' }}" href="{{ route('tentang-kami') }}">Tentang Kami</a>
                    </div>

                    <a href="{{ route('kontak') }}" class="btn font-heading fw-bold px-4 py-2 rounded-pill shadow-sm ms-auto" style="background-color: var(--kuning-emas); color: var(--arang);">
                        Hubungi Kami <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </nav>
    @endif

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset($perusahaan->logo ? 'storage/' . $perusahaan->logo : 'images/logo.jpg') }}" alt="Logo" class="rounded-circle border border-2 border-warning" style="width: 44px; height: 44px; object-fit: cover;">
                        <h5 class="font-hero text-white mb-0 fs-5">Berkah Cahaya Alfatih</h5>
                    </div>
                    <p class="small text-white-50">
                        {{ $perusahaan->deskripsi ?? 'Penyedia dan pemasar properti terpercaya di Banjarmasin. Menyediakan pilihan hunian terbaik dengan kepastian legalitas dan kemudahan proses.' }}
                    </p>
                    @if(!empty($perusahaan?->link_instagram))
                        <a href="{{ $perusahaan->link_instagram }}" target="_blank" class="btn btn-sm btn-outline-light me-2 mt-2">
                            <i class="bi bi-instagram me-1"></i>@sumberberkahnur
                        </a>
                    @endif
                </div>

                <div class="col-6 col-lg-2">
                    <h6>Navigasi</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('home') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('properti.index') }}">Daftar Properti</a></li>
                        <li class="mb-2"><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
                        <li class="mb-2"><a href="{{ route('kontak') }}">Hubungi Kami</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6>Kontak Pemasaran</h6>
                    <ul class="list-unstyled small text-white-50">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2 text-warning"></i>{{ $perusahaan->alamat ?? 'Jl. Pramuka GG Kasturi, RT.12, Banjarmasin Timur' }}</li>
                        <li class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i>Fatur: 0813-5154-0304</li>
                        <li class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i>Yafi: 0851-7319-0869</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2 text-warning"></i>{{ $perusahaan->email ?? 'info@berkahcahayaalfatih.com' }}</li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h6>Jam Operasional</h6>
                    <p class="small text-white-50 mb-3">{{ $perusahaan->jam_operasional ?? 'Senin - Sabtu, 08:00 - 17:00 WITA' }}</p>
                    <a href="https://wa.me/6281351540304?text=Halo%20Berkah%20Cahaya%20Alfatih,%20saya%20ingin%20bertanya%20mengenai%20properti"
                       target="_blank" class="btn btn-gold btn-sm w-100">
                        <i class="bi bi-whatsapp me-1"></i> Chat via WhatsApp
                    </a>
                </div>
            </div>

            <hr class="border-secondary my-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small text-white-50">
                <p class="mb-0">&copy; {{ date('Y') }} Berkah Cahaya Alfatih. All rights reserved.</p>
                <p class="mb-0">Pemasaran Properti Banjarmasin</p>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281351540304?text=Halo%20Berkah%20Cahaya%20Alfatih,%20saya%20tertarik%20dengan%20properti%20Anda"
       target="_blank" class="btn-floating-wa" title="Konsultasi WhatsApp">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('homeNavbar');
            if (nav) {
                if (window.scrollY > 40) {
                    nav.style.background = 'rgba(18, 58, 40, 0.96)';
                    nav.style.boxShadow = '0 6px 25px rgba(0,0,0,0.25)';
                    nav.classList.remove('py-3');
                    nav.classList.add('py-2');
                } else {
                    nav.style.background = 'transparent';
                    nav.style.boxShadow = 'none';
                    nav.classList.remove('py-2');
                    nav.classList.add('py-3');
                }
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
