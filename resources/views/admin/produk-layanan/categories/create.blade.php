@extends('admin.layouts.app')

@section('title', 'Tambah Kategori Produk')
@section('page-title', 'Kategori Produk')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Tambah Kategori Produk</h1>
            <p class="pc-subtitle">
                Tambahkan kategori untuk halaman Produk & Layanan.
            </p>
        </div>

        <a href="{{ route('admin.produk-layanan.categories.index') }}"
           class="btn btn-outline-secondary rounded-3 px-3 py-2">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-4">
            <div class="fw-semibold mb-2">
                Periksa kembali data berikut:
            </div>
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
                <h2 class="pc-table-title">Informasi Kategori</h2>
                <p class="pc-table-description">
                    Isi informasi kategori yang akan ditampilkan pada halaman publik.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.produk-layanan.categories.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="p-3 p-md-4"
        >
            @csrf

            {{-- NAMA --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">
                    Nama Kategori <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Komputer & Teknologi"
                    maxlength="255"
                    required
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- SLUG --}}
            <div class="mb-4">
                <label for="slug" class="form-label fw-semibold">
                    Slug <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    name="slug"
                    id="slug"
                    class="form-control rounded-3 @error('slug') is-invalid @enderror"
                    value="{{ old('slug') }}"
                    placeholder="Contoh: komputer-teknologi"
                    maxlength="255"
                    pattern="[A-Za-z0-9_-]+"
                    required
                >
                <div class="form-text">
                    Gunakan huruf, angka, tanda hubung, atau garis bawah. Contoh:
                    <code>komputer-teknologi</code>.
                </div>
                @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">
                    Deskripsi <span class="text-danger">*</span>
                </label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="form-control rounded-3 @error('description') is-invalid @enderror"
                    placeholder="Masukkan deskripsi kategori..."
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- GAMBAR --}}
            <div class="mb-4">
                <label for="image" class="form-label fw-semibold">
                    Gambar Kategori
                </label>
                <input
                    type="file"
                    name="image"
                    id="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="form-control rounded-3 @error('image') is-invalid @enderror"
                >
                <div class="form-text">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- URUTAN --}}
            <div class="mb-4">
                <label for="sort_order" class="form-label fw-semibold">
                    Urutan Tampilan <span class="text-danger">*</span>
                </label>
                <input
                    type="number"
                    name="sort_order"
                    id="sort_order"
                    min="1"
                    class="form-control rounded-3 @error('sort_order') is-invalid @enderror"
                    value="{{ old('sort_order', 1) }}"
                    required
                >
                <div class="form-text">
                    Angka lebih kecil akan ditampilkan lebih dahulu.
                </div>
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                <input type="hidden" name="is_active" value="0">
                <div class="form-check form-switch">
                    <input
                        type="checkbox"
                        name="is_active"
                        id="is_active"
                        value="1"
                        class="form-check-input"
                        role="switch"
                        @checked(old('is_active', '1') == '1')
                    >
                    <label for="is_active" class="form-check-label fw-semibold">
                        Aktifkan kategori
                    </label>
                </div>
                <div class="form-text">
                    Kategori aktif dapat ditampilkan pada halaman publik setelah integrasi selesai.
                </div>
            </div>

            {{-- TOMBOL --}}
            <div class="d-flex flex-wrap justify-content-end gap-2 pt-3 border-top">
                <a
                    href="{{ route('admin.produk-layanan.categories.index') }}"
                    class="btn btn-light border rounded-3 px-4 py-2"
                >
                    Batal
                </a>

                <button type="submit" class="pc-primary-btn border-0">
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
