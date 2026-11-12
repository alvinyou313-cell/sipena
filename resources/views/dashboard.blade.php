@extends('layouts.app')

@section('title', 'Dashboard SIPENA')
@section('page-title', 'Dashboard')

@push('styles')
<style>
    .dashboard-welcome {
        position: relative;
        overflow: hidden;
        padding: 30px;
        border-radius: 18px;
        color: white;
        background: linear-gradient(115deg, #172f65, #2563eb);
    }

    .dashboard-welcome::after {
        content: "";
        position: absolute;
        width: 230px;
        height: 230px;
        border: 35px solid rgba(255,255,255,.08);
        border-radius: 50%;
        right: -55px;
        top: -100px;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 25px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .welcome-description {
        color: #dbeafe;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .welcome-date {
        display: inline-block;
        padding: 8px 12px;
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 8px;
        background: rgba(255,255,255,.10);
        color: #eff6ff;
        font-size: 12px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        height: 100%;
        padding: 20px;
        border: 1px solid #edf0f5;
        border-radius: 15px;
        background: white;
        box-shadow: 0 5px 20px rgba(22, 34, 66, .035);
        transition: transform .2s, box-shadow .2s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(22, 34, 66, .08);
    }

    .stat-icon {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        font-size: 20px;
    }

    .stat-label {
        margin-top: 17px;
        color: #8792a5;
        font-size: 12px;
        font-weight: 600;
    }

    .stat-number {
        margin-top: 3px;
        color: #17213b;
        font-size: 29px;
        font-weight: 800;
    }

    .section-card {
        height: 100%;
        border: 1px solid #edf0f5;
        border-radius: 15px;
        background: white;
        box-shadow: 0 5px 20px rgba(22, 34, 66, .035);
    }

    .section-card-header {
        padding: 20px 22px;
        border-bottom: 1px solid #f0f2f6;
    }

    .section-card-body {
        padding: 22px;
    }

    .section-heading {
        color: #17213b;
        font-size: 15px;
        font-weight: 800;
    }

    .section-subheading {
        margin-top: 4px;
        color: #929daf;
        font-size: 12px;
    }

    .chart-container {
        position: relative;
        height: 270px;
    }

    .table thead th {
        padding: 14px 16px;
        border-bottom: 1px solid #edf0f5;
        background: #f8faff;
        color: #8a95a8;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 15px 16px;
        border-bottom: 1px solid #f0f2f6;
        color: #526078;
        font-size: 12px;
        vertical-align: middle;
    }

    .complaint-title {
        color: #1e2b45;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .complaint-title:hover {
        color: #2563eb;
    }

    .complaint-subtitle {
        margin-top: 4px;
        color: #9aa5b5;
        font-size: 11px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 800;
    }

    .status-pending {
        color: #a16207;
        background: #fef3c7;
    }

    .status-approved {
        color: #15803d;
        background: #dcfce7;
    }

    .status-rejected {
        color: #b91c1c;
        background: #fee2e2;
    }

    .quick-action {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 14px;
        border: 1px solid #edf0f5;
        border-radius: 12px;
        color: #263653;
        text-decoration: none;
        transition: .2s;
    }

    .quick-action:hover {
        border-color: #bfdbfe;
        background: #f8fbff;
        transform: translateX(3px);
        color: #2563eb;
    }

    .quick-action-icon {
        width: 40px;
        height: 40px;
        display: grid;
        flex-shrink: 0;
        place-items: center;
        border-radius: 11px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 18px;
    }

    .quick-action-title {
        font-size: 12px;
        font-weight: 800;
    }

    .quick-action-description {
        margin-top: 3px;
        color: #9aa5b5;
        font-size: 10px;
    }

    @media(max-width: 576px) {
        .dashboard-welcome {
            padding: 23px;
        }

        .welcome-title {
            font-size: 21px;
        }

        .section-card-body {
            padding: 15px;
        }
    }
</style>
@endpush

@section('content')

<!-- WELCOME -->
<div class="dashboard-welcome mb-4">
    <div class="welcome-content">
        <div class="welcome-title">
            Selamat {{ now()->format('H') < 11 ? 'Pagi' : (now()->format('H') < 15 ? 'Siang' : (now()->format('H') < 18 ? 'Sore' : 'Malam')) }},
            {{ auth()->user()->name }}!
        </div>

        <p class="welcome-description">
            @if($isAdmin)
                Selamat bekerja. Pantau dan kelola seluruh laporan fasilitas sekolah melalui dashboard SIPENA.
            @else
                Selamat datang di SIPENA. Mari bersama menjaga fasilitas dan kenyamanan lingkungan sekolah.
            @endif
        </p>

        <span class="welcome-date">
            <i class="bi bi-calendar3 me-2"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </span>
    </div>
</div>

<!-- STATISTIK -->
<div class="row g-3 mb-4">

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e8f0ff;color:#2563eb;">
                <i class="bi bi-clipboard-data"></i>
            </div>
            <div class="stat-label">TOTAL PENGADUAN</div>
            <div class="stat-number">{{ $total }}</div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff5dc;color:#d97706;">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="stat-label">MENUNGGU</div>
            <div class="stat-number">{{ $pending }}</div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#e5f8ed;color:#16a34a;">
                <i class="bi bi-check-circle"></i>
            </div>
            <div class="stat-label">DISETUJUI</div>
            <div class="stat-number">{{ $approved }}</div>
        </div>
    </div>

    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#feecec;color:#dc2626;">
                <i class="bi bi-x-circle"></i>
            </div>
            <div class="stat-label">DITOLAK</div>
            <div class="stat-number">{{ $rejected }}</div>
        </div>
    </div>

</div>

<div class="row g-3 mb-4">

    <!-- GRAFIK -->
    <div class="col-xl-8">
        <div class="section-card">
            <div class="section-card-header">
                <div class="section-heading">Statistik Pengaduan</div>
                <div class="section-subheading">
                    Jumlah laporan selama enam bulan terakhir
                </div>
            </div>

            <div class="section-card-body">
                <div class="chart-container">
                    <canvas id="complaintChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- AKSI CEPAT -->
    <div class="col-xl-4">
        <div class="section-card">
            <div class="section-card-header">
                <div class="section-heading">Akses Cepat</div>
                <div class="section-subheading">Menu yang sering digunakan</div>
            </div>

            <div class="section-card-body d-grid gap-3">

                @if($isAdmin)
                    <a href="{{ route('complaints.index') }}" class="quick-action">
                        <div class="quick-action-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Kelola Pengaduan</div>
                            <div class="quick-action-description">Lihat dan verifikasi laporan siswa</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>

                    <a href="{{ route('complaints.index') }}?status=Pending" class="quick-action">
                        <div class="quick-action-icon" style="background:#fff5dc;color:#d97706;">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Laporan Menunggu</div>
                            <div class="quick-action-description">{{ $pending }} laporan perlu diperiksa</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>
                @else
                    <a href="{{ route('complaints.create') }}" class="quick-action">
                        <div class="quick-action-icon">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Buat Pengaduan</div>
                            <div class="quick-action-description">Laporkan fasilitas yang rusak</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>

                    <a href="{{ route('complaints.index') }}" class="quick-action">
                        <div class="quick-action-icon" style="background:#e5f8ed;color:#16a34a;">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div>
                            <div class="quick-action-title">Riwayat Pengaduan</div>
                            <div class="quick-action-description">Pantau perkembangan laporanmu</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto"></i>
                    </a>
                @endif

                <div class="p-3 rounded-3" style="background:#f5f8ff;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-info-circle text-primary"></i>
                        <strong style="font-size:12px;">Informasi SIPENA</strong>
                    </div>
                    <p class="mb-0 text-muted" style="font-size:11px;line-height:1.7;">
                        Gunakan sistem ini untuk melaporkan kerusakan sarana dan prasarana sekolah secara tertib.
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>

<!-- TABEL PENGADUAN -->
<div class="section-card">
    <div class="section-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
        <div>
            <div class="section-heading">Pengaduan Terbaru</div>
            <div class="section-subheading">Laporan yang terakhir masuk ke sistem</div>
        </div>

        <a href="{{ route('complaints.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>INFORMASI PENGADUAN</th>
                    @if($isAdmin)
                        <th>PELAPOR</th>
                    @endif
                    <th>KATEGORI</th>
                    <th>STATUS</th>
                    <th>TANGGAL</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @forelse($complaints as $complaint)
                    <tr>
                        <td>
                            <a href="{{ route('complaints.show', $complaint) }}" class="complaint-title">
                                {{ $complaint->title }}
                            </a>
                            <div class="complaint-subtitle">
                                {{ $complaint->location }}
                            </div>
                        </td>

                        @if($isAdmin)
                            <td>{{ $complaint->user->name }}</td>
                        @endif

                        <td>{{ $complaint->category }}</td>

                        <td>
                            @if($complaint->status === 'Pending')
                                <span class="status-badge status-pending">PENDING</span>
                            @elseif($complaint->status === 'Approved')
                                <span class="status-badge status-approved">DISETUJUI</span>
                            @else
                                <span class="status-badge status-rejected">DITOLAK</span>
                            @endif
                        </td>

                        <td>{{ $complaint->created_at->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('complaints.show', $complaint) }}"
                               class="btn btn-sm btn-light text-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $isAdmin ? 6 : 5 }}" class="text-center py-5">
                            <i class="bi bi-inbox fs-2 d-block text-muted mb-2"></i>
                            <div class="fw-semibold text-muted">Belum ada pengaduan</div>
                            <small class="text-muted">Data pengaduan akan muncul di sini.</small>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartCanvas = document.getElementById('complaintChart');

    if (chartCanvas) {
        new Chart(chartCanvas, {
            type: 'line',

            data: {
                labels: @json($chartLabels),

                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: @json($chartData),
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.10)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#2563eb',
                    pointBorderWidth: 2
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        },
                        grid: {
                            color: '#f0f2f6'
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
