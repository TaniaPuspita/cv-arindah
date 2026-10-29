
@extends('admin.layouts.app')

@section('title', 'Edit Foto Galeri')
@section('page-title', 'Edit Foto Galeri')

@section('content')
<div class="container-fluid pc-page">

    <div class="pc-header d-flex justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Edit Foto Galeri</h1>
            <p class="pc-subtitle">Perbarui foto slider Beranda CV Arindah.</p>
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
                <p class="pc-table-description">Edit informasi foto galeri.</p>
            </div>
        </div>

        <form action="{{ route('admin.homepage-galeris.update', $homepageGaleri) }}"
              method="POST" enctype="multipart/form-data" class="p-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">
                    Judul Foto <span class="text-danger">*</span>
                </label>
                <input type="text" id="title" name="title"
                       class="form-control rounded-3"
                       value="{{ old('title', $homepageGaleri->title) }}"
                       maxlength="150" required>
                @error('title')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Foto Saat Ini</label>
                <div>
                    <img src="{{ asset('storage/' . $homepageGaleri->image) }}"
                         alt="{{ $homepageGaleri->alt_text ?: $homepageGaleri->title }}"
                         class="img-fluid rounded-3 border"
                         style="max-width:320px;max-height:220px;object-fit:cover">
                </div>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label fw-semibold">Ganti Foto</label>
                <input type="file" id="image" name="image"
                       class="form-control rounded-3"
                       accept=".jpg,.jpeg,.png,.webp,.avif">
                <div class="form-text">
                    Kosongkan jika tidak ingin mengganti foto. Maksimal 5 MB.
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
                       value="{{ old('alt_text', $homepageGaleri->alt_text) }}"
                       maxlength="255">
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
                       value="{{ old('sort_order', $homepageGaleri->sort_order) }}"
                       required>
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
                    <option value="1"
                        @selected((string) old('is_active', (int) $homepageGaleri->is_active) === '1')>
                        Aktif
                    </option>
                    <option value="0"
                        @selected((string) old('is_active', (int) $homepageGaleri->is_active) === '0')>
                        Nonaktif
                    </option>
                </select>
                @error('is_active')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="cms-form-actions">

                    {{-- Simpan di sebelah kiri --}}
                    <button type="submit" class="primary-button">
                        <i class="bi bi-floppy"></i>
                        Simpan Perubahan
                    </button>

                    {{-- Batal di sebelah kanan tombol Simpan --}}
                    <a href="{{ route('dashboard') }}" class="secondary-button">
                        Batal
                    </a>

                </div>
        </form>
    </div>
</div>
@endsection
