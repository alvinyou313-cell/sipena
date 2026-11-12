
@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="auth-shell">

    <section class="auth-visual">

        <div class="brand">
            <div class="brand-icon">
                <i class="bi bi-buildings"></i>
            </div>

            <div>
                <div class="brand-name">SIPENA</div>
                <div class="brand-caption">Sistem Pengaduan Sarana Sekolah</div>
            </div>
        </div>

        <div class="visual-content">

            <div class="visual-tag">
                <i class="bi bi-shield-check"></i>
                PLATFORM LAYANAN SEKOLAH DIGITAL
            </div>

            <h1>
                Sekolah Lebih Baik,
                <span>Dimulai dari Kepedulian.</span>
            </h1>

            <p>
                Laporkan kerusakan fasilitas sekolah dengan mudah.
                Pantau perkembangan laporan dan bantu menciptakan
                lingkungan belajar yang nyaman, aman, dan berkualitas.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <i class="bi bi-send"></i>
                    <span>Pengaduan fasilitas sekolah secara online</span>
                </div>

                <div class="feature-item">
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Pemantauan status laporan secara transparan</span>
                </div>

                <div class="feature-item">
                    <i class="bi bi-people"></i>
                    <span>Kolaborasi siswa dan pihak sekolah</span>
                </div>
            </div>

        </div>

        <div class="visual-footer">
            &copy; {{ date('Y') }} SIPENA. Sistem Informasi Pengaduan Sarana Sekolah.
        </div>

    </section>

    <main class="auth-panel">

        <div class="auth-card">

            <div class="mobile-brand">
                <div class="brand-icon">
                    <i class="bi bi-buildings"></i>
                </div>

                <div>
                    <div class="brand-name">SIPENA</div>
                    <div class="brand-caption">Pengaduan Sarana Sekolah</div>
                </div>
            </div>

            <div class="welcome-label">
                SELAMAT DATANG KEMBALI
            </div>

            <h1 class="auth-title">Masuk ke Akun</h1>

            <p class="auth-description">
                Silakan masuk menggunakan email dan password
                yang telah terdaftar untuk melanjutkan.
            </p>

            @if(session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">
                        Alamat Email
                    </label>

                    <div class="input-wrap">
                        <i class="bi bi-envelope"></i>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            required
                            autofocus
                            autocomplete="username"
                        >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                    </label>

                    <div class="input-wrap">
                        <i class="bi bi-lock"></i>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control password-input"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            onclick="togglePassword()"
                            aria-label="Tampilkan password"
                        >
                            <i class="bi bi-eye" id="passwordIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        >

                        <label class="form-check-label" for="remember">
                            Ingat saya
                        </label>
                    </div>

                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Lupa password?
                        </a>
                    @endif

                </div>

                <button type="submit" class="btn-login">
                    MASUK SEKARANG
                    <i class="bi bi-arrow-right ms-2"></i>
                </button>

            </form>

            <div class="auth-bottom">
                <i class="bi bi-shield-lock me-1"></i>
                Akses aman dan terlindungi oleh sistem SIPENA.
            </div>

        </div>

    </main>

</div>
@endsection
