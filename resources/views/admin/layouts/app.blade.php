<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('images/logo.jpg') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-bg: #1e293b;
            --sidebar-text: #cbd5e1;
            --sidebar-active: #3b82f6;
            --header-height: 60px;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: #f1f5f9;
        }

        /* Sidebar */
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--sidebar-text);
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .admin-sidebar .sidebar-brand {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-sidebar .sidebar-brand h5 {
            margin: 0;
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            line-height: 1.3;
        }

        .admin-sidebar .sidebar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: var(--sidebar-active);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sidebar-menu {
            padding: 0.75rem 0;
        }

        .sidebar-menu .menu-label {
            padding: 0.5rem 1.25rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #64748b;
            font-weight: 600;
        }

        .sidebar-menu .menu-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.6rem 1.25rem;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu .menu-item:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }

        .sidebar-menu .menu-item.active {
            background: rgba(59,130,246,0.15);
            color: #fff;
            border-left-color: var(--sidebar-active);
        }

        .sidebar-menu .menu-item i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-menu .menu-item .badge {
            margin-left: auto;
            font-size: 0.7rem;
        }

        /* Main content */
        .admin-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .admin-header {
            height: var(--header-height);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .admin-content {
            padding: 1.5rem;
        }

        /* Mobile sidebar toggle */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.25rem;
            color: #475569;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-main {
                margin-left: 0;
            }
            .sidebar-toggle {
                display: block;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="rounded-circle border border-2 border-primary me-2" style="width: 38px; height: 38px; object-fit: cover;">
            <h5>Berkah Cahaya<br>Alfatih</h5>
        </div>

        <nav class="sidebar-menu">
            <div class="menu-label">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.dashboard*') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-label mt-2">Kelola Data</div>

            <a href="{{ route('admin.properti.index') }}"
               class="menu-item {{ request()->routeIs('admin.properti*') ? 'active' : '' }}">
                <i class="bi bi-houses"></i>
                <span>Properti</span>
            </a>

            <a href="{{ route('admin.kategori.index') }}"
               class="menu-item {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.pesan.index') }}"
               class="menu-item {{ request()->routeIs('admin.pesan*') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i>
                <span>Pesan Masuk</span>
                @php $pesanBelumDibaca = \App\Models\PesanKontak::belumDibaca()->count(); @endphp
                @if($pesanBelumDibaca > 0)
                    <span class="badge bg-danger rounded-pill">{{ $pesanBelumDibaca }}</span>
                @endif
            </a>

            <div class="menu-label mt-2">Pengaturan</div>

            <a href="{{ route('admin.informasi.edit') }}"
               class="menu-item {{ request()->routeIs('admin.informasi*') ? 'active' : '' }}">
                <i class="bi bi-info-circle"></i>
                <span>Info Perusahaan</span>
            </a>

            <a href="{{ route('admin.password') }}"
               class="menu-item {{ request()->routeIs('admin.password') ? 'active' : '' }}">
                <i class="bi bi-key"></i>
                <span>Ubah Password</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-3">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <h6 class="mb-0 text-muted">@yield('title', 'Dashboard')</h6>
            </div>

            <div class="dropdown">
                <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-1"></i>
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.password') }}">
                            <i class="bi bi-key me-2"></i>Ubah Password
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Content -->
        <main class="admin-content">
            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById('adminSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });
        }

        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
