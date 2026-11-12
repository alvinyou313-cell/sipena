<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIPENA') - Sistem Pengaduan Sarana Sekolah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #2563eb;
            --sidebar-bg: #172554;
            --body-bg: #f4f7fb;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            min-height: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        body {
            background: var(--body-bg);
            font-family: Arial, sans-serif;
            color: #263653;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1050;
            width: var(--sidebar-width);
            height: 100dvh;
            padding: 24px 18px;
            overflow-y: auto;
            overflow-x: hidden;
            background: var(--sidebar-bg);
            color: white;
            transition: transform .3s ease;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            width: 100%;
            color: #cbd5e1;
            padding: 12px 15px;
            border-radius: 9px;
            margin-bottom: 7px;
            font-size: 13px;
            text-decoration: none;
            transition: .2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary);
            color: white;
        }

        .sidebar .nav-link i {
            font-size: 17px;
            min-width: 23px;
        }

        .sidebar-close {
            display: none;
            border: 0;
            background: transparent;
            color: white;
            font-size: 24px;
        }

        /* SIDEBAR OVERLAY */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1040;
            background: rgba(15, 23, 42, .55);
            backdrop-filter: blur(2px);
        }

        /* MAIN */
        .main-wrapper {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-width: 0;
            transition: margin .3s ease, width .3s ease;
        }

        /* TOPBAR */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            min-height: 76px;
            background: white;
            padding: 14px 30px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .topbar h5 {
            font-size: 17px;
            color: #172554;
        }

        .topbar small {
            font-size: 12px;
        }

        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border: 0;
            border-radius: 10px;
            background: #eff4ff;
            color: #2563eb;
            font-size: 21px;
        }

        /* CONTENT */
        .main-content {
            width: 100%;
            min-width: 0;
            padding: 28px;
        }

        .main-content > * {
            max-width: 100%;
        }

        .card,
        .content-card,
        .stat-card {
            max-width: 100%;
            border-radius: 14px;
        }

        .stat-card,
        .content-card {
            border: 0;
            box-shadow: 0 3px 15px rgba(0,0,0,.04);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 22px;
            flex-shrink: 0;
        }

        /* TABLE RESPONSIVE */
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            min-width: 650px;
        }

        /* FORM */
        .form-control,
        .form-select,
        .btn {
            max-width: 100%;
        }

        img {
            max-width: 100%;
        }

        /* TABLET */
        @media (max-width: 991.98px) {
            :root {
                --sidebar-width: 240px;
            }

            .main-content {
                padding: 22px;
            }

            .topbar {
                padding: 14px 22px;
            }
        }

        /* MOBILE */
        @media (max-width: 767.98px) {
            .sidebar {
                width: min(285px, 85vw);
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(0,0,0,.15);
            }

            body.sidebar-open .sidebar {
                transform: translateX(0);
            }

            body.sidebar-open .sidebar-overlay {
                display: block;
            }

            .sidebar-close {
                display: block;
            }

            .main-wrapper {
                width: 100%;
                margin-left: 0;
            }

            .topbar {
                min-height: 66px;
                padding: 12px 15px;
                gap: 10px;
            }

            .mobile-menu-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .topbar h5 {
                font-size: 15px;
            }

            .topbar small {
                font-size: 10px;
            }

            .topbar .badge {
                font-size: 10px;
            }

            .main-content {
                padding: 16px 12px;
            }

            .main-content h4 {
                font-size: 19px;
            }

            .card-body {
                padding: 16px !important;
            }

            .stat-icon {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .table {
                min-width: 700px;
            }

            .btn {
                font-size: 12px;
            }

            .pagination {
                flex-wrap: wrap;
                gap: 3px;
            }

            .pagination .page-link {
                padding: 6px 10px;
                font-size: 12px;
            }

            .row {
                --bs-gutter-x: 12px;
            }
        }

        /* SMALL MOBILE */
        @media (max-width: 380px) {
            .main-content {
                padding: 12px 9px;
            }

            .topbar {
                padding: 10px;
            }

            .topbar h5 {
                font-size: 13px;
            }

            .topbar small {
                font-size: 9px;
            }

            .brand {
                font-size: 22px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- SIDEBAR -->
<aside class="sidebar" id="sidebar">

    <div class="d-flex justify-content-between align-items-start">
        <div>
            <div class="brand mb-1">
                <i class="bi bi-building"></i> SIPENA
            </div>

            <small class="text-white-50">Pengaduan Sarana Sekolah</small>
        </div>

        <button class="sidebar-close" id="sidebarClose" aria-label="Tutup menu">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <hr class="border-secondary">

    <div class="text-uppercase small text-white-50 mb-2">
        Menu Utama
    </div>

    <nav class="nav flex-column">

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="{{ route('complaints.index') }}"
           class="nav-link {{ request()->routeIs('complaints.index', 'complaints.show') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check me-2"></i> Data Pengaduan
        </a>

        @if(auth()->user()->role === 'siswa')
            <a href="{{ route('complaints.create') }}"
               class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle me-2"></i> Buat Pengaduan
            </a>
        @endif

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('users.index') }}"
               class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Manajemen Pengguna
            </a>
        @endif

    </nav>

    <hr class="border-secondary">

    <div class="text-uppercase small text-white-50 mb-3">
        Akun
    </div>

    <div class="d-flex align-items-center gap-2 text-white mb-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center"
             style="width:40px;height:40px;background:#2563eb;font-weight:bold;">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="overflow-hidden">
            <div class="fw-bold text-truncate">
                {{ auth()->user()->name }}
            </div>

            <small class="text-white-50 text-capitalize">
                {{ auth()->user()->role }}
            </small>
        </div>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit"
                class="nav-link border-0 bg-transparent text-start">
            <i class="bi bi-box-arrow-right me-2"></i> Keluar
        </button>
    </form>

</aside>

<!-- MAIN CONTENT -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <header class="topbar">

        <div class="d-flex align-items-center gap-3">

            <button class="mobile-menu-btn"
                    id="mobileMenuBtn"
                    aria-label="Buka menu"
                    aria-expanded="false">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <h5 class="mb-0 fw-bold">
                    @yield('page-title', 'Dashboard')
                </h5>

                <small class="text-muted">
                    Sistem Pengaduan Sarana Sekolah
                </small>
            </div>

        </div>

        <div class="text-end">
            <span class="badge bg-primary text-capitalize px-3 py-2">
                {{ auth()->user()->role }}
            </span>
        </div>

    </header>

    <!-- PAGE CONTENT -->
    <main class="main-content">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali data yang dimasukkan:</strong>

                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const menuButton = document.getElementById('mobileMenuBtn');
    const closeButton = document.getElementById('sidebarClose');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        document.body.classList.add('sidebar-open');
        menuButton.setAttribute('aria-expanded', 'true');
    }

    function closeSidebar() {
        document.body.classList.remove('sidebar-open');
        menuButton.setAttribute('aria-expanded', 'false');
    }

    menuButton.addEventListener('click', function () {
        if (document.body.classList.contains('sidebar-open')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    closeButton.addEventListener('click', closeSidebar);
    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeSidebar();
        }
    });

    // Tutup menu otomatis setelah link dipilih di HP.
    document.querySelectorAll('.sidebar .nav-link').forEach(function (link) {
        link.addEventListener('click', function () {
            if (window.innerWidth < 768) {
                closeSidebar();
            }
        });
    });

    // Kembalikan sidebar ke posisi normal saat layar diperbesar.
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 768) {
            closeSidebar();
        }
    });
</script>

@stack('scripts')

</body>
</html>
