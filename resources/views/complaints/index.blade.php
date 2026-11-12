@extends('layouts.app')

@section('title', 'Data Pengaduan')
@section('page-title', 'Data Pengaduan')

@push('styles')
<style>
    .list-card {
        border: 1px solid #edf0f5;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(22,34,66,.04);
    }

    .filter-control {
        min-height: 43px;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        font-size: 13px;
    }

    .table thead th {
        padding: 15px;
        background: #f7f9fd;
        color: #8995a8;
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 15px;
        color: #526078;
        font-size: 12px;
        vertical-align: middle;
    }

    .report-title {
        color: #1d2b45;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
    }

    .report-title:hover {
        color: #2563eb;
    }

    .report-subtitle {
        color: #99a3b3;
        font-size: 11px;
        margin-top: 4px;
    }

    .status-pill {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 800;
    }
</style>
@endpush

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Data Pengaduan</h4>
        <p class="text-muted small mb-0">
            @if(auth()->user()->role === 'admin')
                Kelola dan periksa seluruh laporan siswa.
            @else
                Pantau seluruh laporan yang telah kamu kirim.
            @endif
        </p>
    </div>

    @if(auth()->user()->role === 'siswa')
        <a href="{{ route('complaints.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Buat Pengaduan
        </a>
    @endif
</div>

<div class="card list-card mb-4">
    <div class="card-body p-3">
        <form action="{{ route('complaints.index') }}" method="GET">
            <div class="row g-2">
                <div class="col-md-7">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input type="text"
                               name="search"
                               class="form-control filter-control border-start-0"
                               placeholder="Cari judul, kategori, atau lokasi..."
                               value="{{ request('search') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select filter-control">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Approved" {{ request('status') === 'Approved' ? 'selected' : '' }}>Approved</option>
                        <option value="Rejected" {{ request('status') === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-funnel me-1"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card list-card">
    <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
        <div class="fw-bold">Daftar Laporan</div>
        <span class="badge bg-primary-subtle text-primary">
            {{ $complaints->total() }} Data
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>JUDUL PENGADUAN</th>
                    @if(auth()->user()->role === 'admin')
                        <th>PELAPOR</th>
                    @endif
                    <th>KATEGORI</th>
                    <th>LOKASI</th>
                    <th>STATUS</th>
                    <th>TANGGAL</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @forelse($complaints as $index => $complaint)
                    <tr>
                        <td>{{ $complaints->firstItem() + $index }}</td>

                        <td>
                            <a href="{{ route('complaints.show', $complaint) }}" class="report-title">
                                {{ $complaint->title }}
                            </a>
                            <div class="report-subtitle">
                                #{{ $complaint->id }}
                                @if($complaint->photo)
                                    <i class="bi bi-image ms-1"></i> Ada foto
                                @endif
                            </div>
                        </td>

                        @if(auth()->user()->role === 'admin')
                            <td>{{ $complaint->user->name }}</td>
                        @endif

                        <td>{{ $complaint->category }}</td>
                        <td>{{ $complaint->location }}</td>

                        <td>
                            @if($complaint->status === 'Pending')
                                <span class="status-pill" style="background:#fff4d8;color:#a16207;">PENDING</span>
                            @elseif($complaint->status === 'Approved')
                                <span class="status-pill" style="background:#dcfce7;color:#15803d;">DISETUJUI</span>
                            @else
                                <span class="status-pill" style="background:#fee2e2;color:#b91c1c;">DITOLAK</span>
                            @endif
                        </td>

                        <td>{{ $complaint->created_at->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('complaints.show', $complaint) }}"
                               class="btn btn-sm btn-light text-primary"
                               title="Lihat detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            @if(auth()->user()->role === 'admin' || $complaint->status === 'Pending')
                                <form action="{{ route('complaints.destroy', $complaint) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-light text-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'admin' ? 8 : 7 }}"
                            class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <div class="fw-bold mt-2">Data tidak ditemukan</div>
                            <div class="text-muted small">Coba ubah kata kunci atau filter pencarian.</div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-body border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
        <small class="text-muted">
            Menampilkan {{ $complaints->firstItem() ?? 0 }}–{{ $complaints->lastItem() ?? 0 }}
            dari {{ $complaints->total() }} laporan
        </small>

        {{ $complaints->links() }}
    </div>
</div>

@endsection
