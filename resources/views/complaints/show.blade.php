@extends('layouts.app')

@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@push('styles')
<style>
    .detail-card {
        border: 1px solid #edf0f5;
        border-radius: 17px;
        box-shadow: 0 5px 20px rgba(22,34,66,.04);
    }

    .detail-label {
        color: #8995a8;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .detail-value {
        color: #263653;
        font-size: 14px;
        font-weight: 600;
    }

    .detail-section {
        padding: 18px 0;
        border-bottom: 1px solid #edf0f5;
    }

    .evidence-image {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        border: 1px solid #edf0f5;
        border-radius: 12px;
        background: #f8fafc;
    }
</style>
@endpush

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Detail Pengaduan</h4>
        <p class="text-muted small mb-0">Informasi lengkap laporan fasilitas sekolah.</p>
    </div>

    <a href="{{ route('complaints.index') }}" class="btn btn-light">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row g-4">

    <div class="col-lg-8">
        <div class="card detail-card">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                    <div>
                        <div class="text-primary small fw-bold mb-2">
                            SIPENA / PENGADUAN #{{ $complaint->id }}
                        </div>

                        <h4 class="fw-bold mb-2">{{ $complaint->title }}</h4>

                        <div class="text-muted small">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $complaint->created_at->format('d F Y, H:i') }}
                        </div>
                    </div>

                    @if($complaint->status === 'Pending')
                        <span class="badge bg-warning text-dark px-3 py-2">PENDING</span>
                    @elseif($complaint->status === 'Approved')
                        <span class="badge bg-success px-3 py-2">DISETUJUI</span>
                    @else
                        <span class="badge bg-danger px-3 py-2">DITOLAK</span>
                    @endif
                </div>

                <div class="detail-section">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="detail-label">Nama Pelapor</div>
                            <div class="detail-value">
                                <i class="bi bi-person-circle text-primary me-2"></i>
                                {{ $complaint->user->name }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="detail-label">Kategori Fasilitas</div>
                            <div class="detail-value">
                                <i class="bi bi-grid text-primary me-2"></i>
                                {{ $complaint->category }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="detail-label">Lokasi Kerusakan</div>
                            <div class="detail-value">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                {{ $complaint->location }}
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="detail-label">Tanggal Laporan</div>
                            <div class="detail-value">
                                <i class="bi bi-clock text-primary me-2"></i>
                                {{ $complaint->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-label mb-2">Deskripsi Kerusakan</div>
                    <div class="detail-value fw-normal" style="line-height:1.8;">
                        {{ $complaint->description }}
                    </div>
                </div>

                <div class="detail-section">
                    <div class="detail-label mb-3">Foto Bukti Kerusakan</div>

                    @if($complaint->photo)
                        <a href="{{ asset('storage/' . $complaint->photo) }}" target="_blank">
                            <img
                                src="{{ asset('storage/' . $complaint->photo) }}"
                                alt="Foto bukti kerusakan"
                                class="evidence-image">
                        </a>
                        <div class="text-muted small mt-2">
                            Klik foto untuk melihat ukuran penuh.
                        </div>
                    @else
                        <div class="text-center rounded-3 p-4" style="background:#f8faff;">
                            <i class="bi bi-image text-muted fs-2"></i>
                            <p class="text-muted small mb-0 mt-2">Tidak ada foto bukti yang diunggah.</p>
                        </div>
                    @endif
                </div>

                <div class="pt-4">
                    <div class="detail-label mb-2">Catatan dan Hasil Verifikasi Admin</div>

                    @if($complaint->admin_note)
                        <div class="p-3 rounded-3" style="background:#f0f6ff;color:#334155;">
                            {{ $complaint->admin_note }}
                        </div>
                    @else
                        <div class="text-muted small">Belum ada catatan dari Admin.</div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">

        @if(auth()->user()->role === 'admin')
            <div class="card detail-card">
                <div class="card-body p-4">
                    <div class="fw-bold mb-1">
                        <i class="bi bi-shield-check text-primary me-2"></i>
                        Verifikasi Pengaduan
                    </div>

                    <p class="text-muted small mb-4">
                        Periksa laporan dan tentukan hasil verifikasinya.
                    </p>

                    <form action="{{ route('complaints.update', $complaint) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Status Pengaduan</label>

                            <select name="status" class="form-select" required>
                                <option value="Pending" {{ $complaint->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $complaint->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ $complaint->status === 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold">Catatan Admin</label>

                            <textarea
                                name="admin_note"
                                rows="5"
                                class="form-control"
                                placeholder="Tuliskan hasil pemeriksaan atau tindak lanjut...">{{ old('admin_note', $complaint->admin_note) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check2-circle me-2"></i>Simpan Verifikasi
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="card detail-card">
                <div class="card-body p-4">
                    <div class="fw-bold mb-3">Informasi Status</div>

                    @if($complaint->status === 'Pending')
                        <div class="p-3 rounded-3" style="background:#fff8e7;">
                            <i class="bi bi-hourglass-split text-warning fs-3"></i>
                            <div class="fw-bold mt-2">Menunggu Pemeriksaan</div>
                            <div class="small text-muted mt-1">
                                Laporanmu sedang menunggu pemeriksaan Admin sekolah.
                            </div>
                        </div>
                    @elseif($complaint->status === 'Approved')
                        <div class="p-3 rounded-3" style="background:#eaf8ef;">
                            <i class="bi bi-check-circle text-success fs-3"></i>
                            <div class="fw-bold mt-2">Pengaduan Disetujui</div>
                            <div class="small text-muted mt-1">
                                Laporanmu telah disetujui oleh Admin.
                            </div>
                        </div>
                    @else
                        <div class="p-3 rounded-3" style="background:#fff0f0;">
                            <i class="bi bi-x-circle text-danger fs-3"></i>
                            <div class="fw-bold mt-2">Pengaduan Ditolak</div>
                            <div class="small text-muted mt-1">
                                Silakan periksa catatan Admin untuk mengetahui alasannya.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>
</div>

@endsection
