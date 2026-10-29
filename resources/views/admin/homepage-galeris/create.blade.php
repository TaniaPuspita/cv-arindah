
@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri')
@section('page-title', 'Tambah Foto Galeri')

@section('content')
<div class="container-fluid pc-page">

    <div class="pc-header d-flex justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Tambah Foto Galeri</h1>
            <p class="pc-subtitle">Tambahkan foto untuk slider Beranda.</p>
        </div>
        <a href="{{ route('admin.homepage-galeris.index') }}"
           class="btn btn-outline-secondary rounded-3">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pc-table-card">
        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Informasi Foto</h2>
                <p class="pc-table-description">
                    Isi informasi foto yang akan ditampilkan.
                </p>
            </div>
        </div>

        <form action="{{ route('admin.homepage-galeris.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="p-4">
            @csrf

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">
                    Judul Foto <span class="text-danger">*</span>
                </label>
                <input type="text" id="title" name="title"
                       class="form-control rounded-3"
                       value="{{ old('title') }}"
                       maxlength="150" required>
                @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-semibold">
                    File Foto <span class="text-danger">*</span>
                </label>
                <input type="file" id="image" name="image"
                       class="form-control rounded-3"
                       accept=".jpg,.jpeg,.png,.webp,.avif" required>
                <div class="form-text">
                    Format JPG, JPEG, PNG, WEBP, atau AVIF. Maksimal 5 MB.
                </div>
                @error('image')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alt_text" class="form-label fw-semibold">
                    Deskripsi Foto (Alt Text)
                </label>
                <input type="text" id="alt_text" name="alt_text"
                       class="form-control rounded-3"
                       value="{{ old('alt_text') }}"
                       maxlength="255"
                       placeholder="Contoh: Dokumentasi produk CV Arindah">
                @error('alt_text')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="sort_order" class="form-label fw-semibold">
                    Urutan Tampilan <span class="text-danger">*</span>
                </label>
                <input type="number" id="sort_order" name="sort_order"
                       min="1" class="form-control rounded-3"
                       value="{{ old('sort_order', 1) }}" required>
                <div class="form-text">Angka lebih kecil tampil lebih dahulu.</div>
                @error('sort_order')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="is_active" class="form-label fw-semibold">
                    Status <span class="text-danger">*</span>
                </label>
                <select id="is_active" name="is_active"
                        class="form-select rounded-3" required>
                    <option value="1" @selected(old('is_active', '1') == '1')>
                        Aktif
                    </option>
                    <option value="0" @selected(old('is_active', '1') == '0')>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                <a href="{{ route('admin.homepage-galeris.index') }}"
                   class="btn btn-outline-secondary rounded-3 px-4">
                    Batal
                </a>
                <button type="submit" class="pc-primary-btn">
                    <i class="bi bi-check-circle me-1"></i> Simpan Foto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
