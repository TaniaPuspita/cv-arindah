
{{-- =========================================================
    CMS TENTANG KAMI - CV ARINDAH
    File: resources/views/admin/homepage-about/edit.blade.php
    Fungsi: Mengelola konten bagian Tentang Kami pada Beranda
========================================================= --}}

@extends('admin.layouts.app')

{{-- JUDUL TAB DAN JUDUL HALAMAN ADMIN --}}
@section('title', 'CMS Tentang Kami | CV Arindah')
@section('page-title', 'CMS Beranda')

@section('content')

    {{-- =====================================================
        1. JUDUL HALAMAN
    ====================================================== --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Tentang Kami</h1>

        <p class="page-description">
            Kelola informasi perusahaan, gambar, dan kategori bidang usaha
            yang direncanakan untuk ditampilkan pada halaman Beranda CV Arindah.
        </p>
    </section>

   

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
        4. FORM EDIT TENTANG KAMI
    ====================================================== --}}
    <section class="cms-card">

        {{-- HEADER CARD --}}
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div>
                <h3>Pengaturan Konten Tentang Kami</h3>
                <p>
                    Lengkapi kolom berikut, lalu simpan perubahan.
                </p>
            </div>
        </div>

        {{-- FORM UTAMA --}}
        <form
            action="{{ route('admin.homepage-about.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- =================================================
                4A. LABEL TENTANG KAMI
            ================================================== --}}
            <div class="cms-form-group">
                <label for="label">Label Bagian</label>

                <input
                    type="text"
                    id="label"
                    name="label"
                    class="cms-input"
                    value="{{ old('label', $about->label) }}"
                    maxlength="255"
                    placeholder="Contoh: TENTANG KAMI"
                    required
                >

                @error('label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4B. JUDUL UTAMA
            ================================================== --}}
            <div class="cms-form-group">
                <label for="title">Judul Utama</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title', $about->title) }}"
                    maxlength="255"
                    placeholder="Contoh: MENGENAL CV ARINDAH"
                    required
                >

                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4C. DESKRIPSI PERTAMA
            ================================================== --}}
            <div class="cms-form-group">
                <label for="paragraph_one">Deskripsi Pertama</label>

                <textarea
                    id="paragraph_one"
                    name="paragraph_one"
                    class="cms-input cms-textarea"
                    rows="5"
                    maxlength="5000"
                    placeholder="Masukkan deskripsi pertama tentang CV Arindah..."
                >{{ old('paragraph_one', $about->paragraph_one) }}</textarea>

                <small class="field-hint">
                    Masukkan informasi utama tentang perusahaan dan bidang usahanya.
                </small>

                @error('paragraph_one')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4D. DESKRIPSI KEDUA
            ================================================== --}}
            <div class="cms-form-group">
                <label for="paragraph_two">Deskripsi Kedua</label>

                <textarea
                    id="paragraph_two"
                    name="paragraph_two"
                    class="cms-input cms-textarea"
                    rows="4"
                    maxlength="5000"
                    placeholder="Masukkan deskripsi tambahan..."
                >{{ old('paragraph_two', $about->paragraph_two) }}</textarea>

                <small class="field-hint">
                    Gunakan bagian ini untuk informasi pendukung perusahaan.
                </small>

                @error('paragraph_two')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4E. GAMBAR TENTANG KAMI
            ================================================== --}}
            <div class="cms-form-group">
                <label for="image">Gambar Tentang Kami</label>

                {{-- GAMBAR YANG SUDAH TERSIMPAN --}}
                @if ($about->image)
                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>

                        <img
                            src="{{ asset('storage/' . $about->image) }}"
                            alt="Gambar Tentang CV Arindah"
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
                4F. KATEGORI PERTAMA
            ================================================== --}}
            <div class="cms-form-group">
                <label for="category_one">Kategori 1</label>

                <input
                    type="text"
                    id="category_one"
                    name="category_one"
                    class="cms-input"
                    value="{{ old('category_one', $about->category_one) }}"
                    maxlength="255"
                    placeholder="Contoh: Komputer & Perlengkapan"
                    required
                >

                @error('category_one')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4G. KATEGORI KEDUA
            ================================================== --}}
            <div class="cms-form-group">
                <label for="category_two">Kategori 2</label>

                <input
                    type="text"
                    id="category_two"
                    name="category_two"
                    class="cms-input"
                    value="{{ old('category_two', $about->category_two) }}"
                    maxlength="255"
                    placeholder="Contoh: Elektronik & Furniture"
                    required
                >

                @error('category_two')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =================================================
                4H. KATEGORI KETIGA
            ================================================== --}}
            <div class="cms-form-group">
                <label for="category_three">Kategori 3</label>

                <input
                    type="text"
                    id="category_three"
                    name="category_three"
                    class="cms-input"
                    value="{{ old('category_three', $about->category_three) }}"
                    maxlength="255"
                    placeholder="Contoh: Teknologi Informasi"
                    required
                >

                @error('category_three')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- =====================================================
                    TOMBOL AKSI CMS TENTANG KAMI
                ===================================================== --}}
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
    </section>

@endsection
