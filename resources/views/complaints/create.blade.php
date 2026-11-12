@extends('layouts.app')

@section('title', 'Buat Pengaduan')
@section('page-title', 'Buat Pengaduan')

@push('styles')
<style>
    .form-card {
        border: 1px solid #edf0f5;
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(22,34,66,.045);
    }

    .form-heading {
        color: #17213b;
        font-size: 20px;
        font-weight: 800;
    }

    .form-description {
        color: #8995a8;
        font-size: 13px;
    }

    .form-label {
        color: #34415a;
        font-size: 13px;
        font-weight: 700;
    }

    .form-control, .form-select {
        min-height: 46px;
        border-color: #e1e7f0;
        border-radius: 10px;
        font-size: 13px;
    }

    textarea.form-control {
        min-height: 125px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #3978ed;
        box-shadow: 0 0 0 3px rgba(37,99,235,.09);
    }

    .upload-box {
        padding: 25px;
        border: 2px dashed #cbd5e1;
        border-radius: 13px;
        background: #f8faff;
        text-align: center;
        cursor: pointer;
    }

    .upload-box:hover {
        border-color: #2563eb;
        background: #f0f6ff;
    }

    .upload-icon {
        color: #2563eb;
        font-size: 30px;
    }

    #photoPreview {
        display: none;
        max-width: 100%;
        max-height: 250px;
        margin: 15px auto 0;
        border-radius: 10px;
        object-fit: contain;
    }
</style>
@endpush

@section('content')

<div class="row justify-content-center">
    <div class="col-xl-9">

        <div class="mb-4">
            <h4 class="fw-bold mb-1">Buat Pengaduan Baru</h4>
            <p class="text-muted small mb-0">
                Laporkan kerusakan fasilitas sekolah agar segera ditindaklanjuti.
            </p>
        </div>

        <div class="card form-card">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="rounded-3 d-grid place-items-center p-3"
                         style="background:#eaf1ff;color:#2563eb;font-size:22px;">
                        <i class="bi bi-file-earmark-plus"></i>
                    </div>

                    <div>
                        <div class="form-heading">Formulir Pengaduan</div>
                        <div class="form-description">
                            Lengkapi informasi di bawah ini.
                        </div>
                    </div>
                </div>

                <form action="{{ route('complaints.store') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf

                    <div class="mb-4">
                        <label class="form-label">Judul Pengaduan <span class="text-danger">*</span></label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title') }}"
                               placeholder="Contoh: AC ruang kelas tidak berfungsi"
                               required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Kategori Fasilitas <span class="text-danger">*</span></label>

                            <select name="category" class="form-select" required>
                                <option value="">Pilih kategori</option>

                                @foreach(['Ruang Kelas', 'Toilet', 'Laboratorium', 'Perpustakaan', 'Komputer', 'Proyektor', 'Meja dan Kursi', 'AC dan Kipas', 'Listrik', 'Lainnya'] as $category)
                                    <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Lokasi Kerusakan <span class="text-danger">*</span></label>

                            <input type="text"
                                   name="location"
                                   class="form-control"
                                   value="{{ old('location') }}"
                                   placeholder="Contoh: Ruang XI RPL 1"
                                   required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Deskripsi Kerusakan <span class="text-danger">*</span></label>

                        <textarea name="description"
                                  class="form-control"
                                  placeholder="Jelaskan kondisi fasilitas, kapan kerusakan terjadi, dan informasi lainnya..."
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto Bukti Kerusakan</label>

                        <label for="photo" class="upload-box d-block">
                            <i class="bi bi-cloud-arrow-up upload-icon"></i>
                            <div class="fw-bold mt-2" style="font-size:13px;">
                                Klik untuk memilih foto
                            </div>
                            <div class="text-muted small mt-1">
                                Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </div>

                            <img id="photoPreview" alt="Preview foto pengaduan">
                        </label>

                        <input type="file"
                               name="photo"
                               id="photo"
                               class="d-none"
                               accept=".jpg,.jpeg,.png,.webp,image/*">

                        <div id="photoName" class="small text-muted mt-2"></div>
                    </div>

                    <div class="alert alert-info small">
                        <i class="bi bi-info-circle me-2"></i>
                        Pengaduan yang dikirim akan memiliki status awal <strong>Pending</strong>
                        sampai diperiksa oleh Admin.
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <i class="bi bi-send me-2"></i>Kirim Pengaduan
                        </button>

                        <a href="{{ route('complaints.index') }}"
                           class="btn btn-light px-4 py-2">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    const photoInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photoPreview');
    const photoName = document.getElementById('photoName');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            photoPreview.style.display = 'none';
            photoName.textContent = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran foto maksimal 2 MB.');
            this.value = '';
            photoPreview.style.display = 'none';
            photoName.textContent = '';
            return;
        }

        photoName.textContent = file.name;
        photoPreview.src = URL.createObjectURL(file);
        photoPreview.style.display = 'block';
    });
</script>
@endpush
