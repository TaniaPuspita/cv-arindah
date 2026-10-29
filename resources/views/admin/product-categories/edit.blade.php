
{{-- =========================================================
    CMS PRODUK - CV ARINDAH
    File: resources/views/admin/product-categories/edit.blade.php
    Fungsi: Mengedit kategori produk
========================================================= --}}

@extends('admin.layouts.app')

{{-- JUDUL TAB DAN JUDUL HALAMAN ADMIN --}}
@section('title', 'Edit Kategori Produk | CV Arindah')
@section('page-title', 'CMS Produk')

@section('content')

    {{-- =====================================================
        1. JUDUL HALAMAN
    ====================================================== --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Edit Kategori Produk</h1>

        <p class="page-description">
            Perbarui informasi kategori produk, gambar, dan pengaturan
            tampilan yang digunakan pada halaman Produk & Layanan CV Arindah.
        </p>
    </section>

    {{-- =====================================================
        2. NOTIFIKASI BERHASIL
    ====================================================== --}}
    @if (session('success'))
        <div class="cms-alert cms-alert-success" role="status">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- =====================================================
        3. NOTIFIKASI VALIDASI
    ====================================================== --}}
    @if ($errors->any())
        <div class="cms-alert cms-alert-error" role="alert">
            <strong>Periksa kembali data yang kamu masukkan.</strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- =====================================================
        4. FORM EDIT KATEGORI PRODUK
    ====================================================== --}}
    <section class="cms-card">

        {{-- HEADER CARD --}}
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div>
                <h3>Pengaturan Kategori Produk</h3>
                <p>
                    Perbarui data kategori produk, lalu simpan perubahan.
                </p>
            </div>
        </div>

        {{-- FORM UTAMA --}}
        <form
            action="{{ route('admin.product-categories.update', $productCategory) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- =================================================
                4A. NAMA KATEGORI
            ================================================== --}}
            <div class="cms-form-group">
                <label for="name">Nama Kategori</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="cms-input"
                    value="{{ old('name', $productCategory->name) }}"
                    maxlength="255"
                    placeholder="Contoh: Komputer & Teknologi"
                    required
                >

                @error('name')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4B. DESKRIPSI KATEGORI
            ================================================== --}}
            <div class="cms-form-group">
                <label for="description">Deskripsi Kategori</label>

                <textarea
                    id="description"
                    name="description"
                    class="cms-input cms-textarea"
                    rows="5"
                    placeholder="Masukkan deskripsi kategori produk..."
                >{{ old('description', $productCategory->description) }}</textarea>

                <small class="field-hint">
                    Tuliskan penjelasan singkat mengenai kategori produk ini.
                </small>

                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4C. GAMBAR KATEGORI
            ================================================== --}}
            <div class="cms-form-group">
                <label for="image">Gambar Kategori</label>

                {{-- GAMBAR YANG SUDAH TERSIMPAN --}}
                @if ($productCategory->image)
                    @php
                        $currentImage = \Illuminate\Support\Str::startsWith(
                            $productCategory->image,
                            'images/'
                        )
                            ? asset($productCategory->image)
                            : asset('storage/' . $productCategory->image);
                    @endphp

                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>

                        <img
                            src="{{ $currentImage }}"
                            alt="Gambar kategori {{ $productCategory->name }}"
                            loading="lazy"
                        >
                    </div>
                @else
                    <div class="current-image">
                        <p>Belum ada gambar yang tersimpan.</p>
                    </div>
                @endif

                {{-- INPUT UPLOAD GAMBAR --}}
                <input
                    type="file"
                    id="image"
                    name="image"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

                @error('image')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4D. URUTAN TAMPILAN
            ================================================== --}}
            <div class="cms-form-group">
                <label for="sort_order">Urutan Tampilan</label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    class="cms-input"
                    value="{{ old('sort_order', $productCategory->sort_order) }}"
                    min="0"
                    required
                >

                <small class="field-hint">
                    Gunakan angka untuk mengatur urutan kategori.
                    Angka lebih kecil akan memiliki urutan lebih awal
                    jika daftar diurutkan berdasarkan kolom ini.
                </small>

                @error('sort_order')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4E. STATUS KATEGORI
            ================================================== --}}
            <div class="cms-form-group">
                <label for="is_active">Status Kategori</label>

                <select
                    id="is_active"
                    name="is_active"
                    class="cms-input"
                    required
                >
                    <option
                        value="1"
                        {{ (string) old('is_active', (int) $productCategory->is_active) === '1' ? 'selected' : '' }}
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        {{ (string) old('is_active', (int) $productCategory->is_active) === '0' ? 'selected' : '' }}
                    >
                        Tidak Aktif
                    </option>
                </select>

                <small class="field-hint">
                    Status ini menentukan apakah kategori ditandai aktif
                    atau tidak aktif di pengelolaan CMS.
                </small>

                @error('is_active')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =====================================================
                5. TOMBOL AKSI CMS PRODUK
            ===================================================== --}}
            <div class="cms-form-actions">

                {{-- SIMPAN PERUBAHAN --}}
                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>

                {{-- KEMBALI KE DAFTAR KATEGORI --}}
                <a
                    href="{{ route('admin.product-categories.index') }}"
                    class="secondary-button"
                >
                    Batal
                </a>

            </div>

        </form>
    </section>

@endsection
