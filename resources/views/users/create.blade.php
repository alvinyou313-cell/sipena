@extends('layouts.app')

@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-8">

        <div class="mb-4">
            <h4 class="fw-bold mb-1">Tambah Pengguna</h4>
            <p class="text-muted small">Daftarkan akun Admin atau Siswa baru.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name') }}"
                               placeholder="Masukkan nama lengkap"
                               required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email') }}"
                               placeholder="nama@email.com"
                               required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Peran Pengguna</label>
                        <select name="role" class="form-select" required>
                            <option value="">Pilih peran</option>
                            <option value="siswa" {{ old('role') === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <hr class="my-4">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Minimal 8 karakter"
                               required>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password"
                               required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-person-plus me-2"></i>Simpan Pengguna
                        </button>

                        <a href="{{ route('users.index') }}" class="btn btn-light px-4">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection
