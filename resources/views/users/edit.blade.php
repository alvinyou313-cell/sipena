@extends('layouts.app')

@section('title', 'Edit Pengguna')
@section('page-title', 'Edit Pengguna')

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-8">

        <div class="mb-4">
            <h4 class="fw-bold mb-1">Edit Pengguna</h4>
            <p class="text-muted small">Perbarui informasi akun pengguna SIPENA.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-3 d-grid place-items-center"
                         style="width:48px;height:48px;background:#eaf1ff;color:#2563eb;font-size:21px;">
                        <i class="bi bi-person-gear"></i>
                    </div>

                    <div>
                        <div class="fw-bold">{{ $user->name }}</div>
                        <small class="text-muted">ID Pengguna: #{{ $user->id }}</small>
                    </div>
                </div>

                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               value="{{ old('name', $user->name) }}"
                               required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               value="{{ old('email', $user->email) }}"
                               required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Peran Pengguna</label>
                        <select name="role" class="form-select" required>
                            <option value="siswa" {{ old('role', $user->role) === 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <hr class="my-4">

                    <div class="alert alert-info small">
                        Kosongkan password jika tidak ingin mengubah password pengguna.
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Baru</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password baru (opsional)">
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                        <input type="password"
                               name="password_confirmation"
                               class="form-control"
                               placeholder="Ulangi password baru">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
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
