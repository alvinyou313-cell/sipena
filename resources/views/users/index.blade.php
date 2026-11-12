@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@push('styles')
<style>
    .user-card {
        border: 1px solid #edf0f5;
        border-radius: 16px;
        box-shadow: 0 5px 20px rgba(22,34,66,.04);
    }

    .user-avatar {
        width: 39px;
        height: 39px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border-radius: 12px;
        background: #eaf1ff;
        color: #2563eb;
        font-weight: 800;
    }

    .user-table th {
        padding: 15px;
        background: #f7f9fd;
        color: #8995a8;
        font-size: 11px;
        white-space: nowrap;
    }

    .user-table td {
        padding: 14px 15px;
        color: #526078;
        font-size: 12px;
        vertical-align: middle;
    }

    .filter-control {
        min-height: 43px;
        border-radius: 9px;
        font-size: 13px;
    }
</style>
@endpush

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Manajemen Pengguna</h4>
        <p class="text-muted small mb-0">Kelola akun Admin dan Siswa SIPENA.</p>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-2"></i>Tambah Pengguna
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card user-card mb-4">
    <div class="card-body p-3">
        <form method="GET" action="{{ route('users.index') }}">
            <div class="row g-2">
                <div class="col-md-7">
                    <input type="text"
                           name="search"
                           class="form-control filter-control"
                           value="{{ request('search') }}"
                           placeholder="Cari nama atau email pengguna...">
                </div>

                <div class="col-md-3">
                    <select name="role" class="form-select filter-control">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="siswa" {{ request('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card user-card">
    <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
        <strong>Daftar Akun</strong>
        <span class="badge bg-primary-subtle text-primary">
            {{ $users->total() }} Pengguna
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-hover user-table mb-0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>PENGGUNA</th>
                    <th>EMAIL</th>
                    <th>PERAN</th>
                    <th>TERDAFTAR</th>
                    <th>AKSI</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $users->firstItem() + $index }}</td>

                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <strong class="text-dark">{{ $user->name }}</strong>
                            </div>
                        </td>

                        <td>{{ $user->email }}</td>

                        <td>
                            @if($user->role === 'admin')
                                <span class="badge bg-primary-subtle text-primary">ADMIN</span>
                            @else
                                <span class="badge bg-success-subtle text-success">SISWA</span>
                            @endif
                        </td>

                        <td>{{ $user->created_at->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-sm btn-light text-primary"
                               title="Edit pengguna">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            @if($user->id !== auth()->id())
                                <form action="{{ route('users.destroy', $user) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }}?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-light text-danger"
                                            title="Hapus pengguna">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-people fs-1 text-muted"></i>
                            <p class="fw-bold mt-2 mb-1">Pengguna tidak ditemukan</p>
                            <small class="text-muted">Coba kata kunci pencarian yang berbeda.</small>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-body border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
        <small class="text-muted">
            Menampilkan {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
            dari {{ $users->total() }} pengguna
        </small>

        {{ $users->links() }}
    </div>
</div>

@endsection
