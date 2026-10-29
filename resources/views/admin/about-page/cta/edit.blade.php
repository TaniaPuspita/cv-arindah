@extends('admin.layouts.app')

@section('title', 'Edit Kontak / CTA')
@section('page-title', 'CMS Tentang Kami')

@section('content')
<div class="dashboard-intro">
    <span class="eyebrow">CMS TENTANG KAMI</span>
    <h1 class="page-title">Kontak / CTA</h1>
    <p class="page-description">
        Kelola ajakan menghubungi CV Arindah pada halaman Tentang Kami.
    </p>
</div>

<div class="cms-card">
    <div class="cms-card-heading">
        <div class="cms-heading-icon">
            <i class="bi bi-telephone"></i>
        </div>

        <div>
            <h2>Form Edit Kontak / CTA</h2>
            <p>Perbarui teks, tombol, dan gambar CTA.</p>
        </div>
    </div>

    <form
        action="{{ route('admin.about-page.section.update', ['section' => 'cta']) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        {{-- LABEL CTA --}}
        <div class="cms-form-group">
            <label for="cta_label">Label CTA</label>
            <input
                type="text"
                id="cta_label"
                name="cta_label"
                class="cms-input"
                value="{{ old('cta_label', $aboutPage->cta_label) }}"
                placeholder="Contoh: BUTUH INFORMASI LEBIH LANJUT?"
            >
            @error('cta_label')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- JUDUL CTA --}}
        <div class="cms-form-group">
            <label for="cta_title">Judul CTA</label>
            <input
                type="text"
                id="cta_title"
                name="cta_title"
                class="cms-input"
                value="{{ old('cta_title', $aboutPage->cta_title) }}"
                placeholder="Contoh: Mari Terhubung dengan CV Arindah"
            >
            <small class="cms-help">
                Gunakan teks lengkap. Kata "CV Arindah" akan diberi warna biru
                jika terdapat pada judul.
            </small>
            @error('cta_title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- DESKRIPSI CTA --}}
        <div class="cms-form-group">
            <label for="cta_description">Deskripsi CTA</label>
            <textarea
                id="cta_description"
                name="cta_description"
                class="cms-textarea"
                rows="4"
                placeholder="Masukkan deskripsi CTA"
            >{{ old('cta_description', $aboutPage->cta_description) }}</textarea>
            @error('cta_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-divider"></div>

        {{-- TOMBOL CTA --}}
        <div class="cms-section-heading">
            <i class="bi bi-hand-index-thumb"></i>
            <h3>Tombol CTA</h3>
        </div>

        <div class="cms-form-group">
            <label for="cta_button_text">Teks Tombol</label>
            <input
                type="text"
                id="cta_button_text"
                name="cta_button_text"
                class="cms-input"
                value="{{ old('cta_button_text', $aboutPage->cta_button_text) }}"
                placeholder="Contoh: Hubungi Kami"
            >
            @error('cta_button_text')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-divider"></div>

        {{-- GAMBAR CTA --}}
        <div class="cms-section-heading">
            <i class="bi bi-image"></i>
            <h3>Gambar CTA</h3>
        </div>

        @if($aboutPage->cta_image)
            <div class="cms-current-image">
                <p class="cms-image-label">Gambar saat ini</p>
                <img
                    src="{{ asset('storage/' . $aboutPage->cta_image) }}"
                    alt="Gambar CTA saat ini"
                    class="cms-preview-image"
                >
            </div>
        @else
            <div class="cms-current-image">
                <p class="cms-image-label">Gambar saat ini</p>
                <img
                    src="{{ asset('images/tentangkami/cta_tentangkami.jpg') }}"
                    alt="Gambar CTA default"
                    class="cms-preview-image"
                >
                <small class="cms-help">
                    Saat ini menggunakan gambar default website.
                </small>
            </div>
        @endif

        <div class="cms-form-group">
            <label for="cta_image">Upload Gambar Baru</label>
            <input
                type="file"
                id="cta_image"
                name="cta_image"
                class="cms-input"
                accept="image/jpeg,image/png,image/webp"
            >
            <small class="cms-help">
                Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                Kosongkan jika tidak ingin mengganti gambar.
            </small>
            @error('cta_image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- TOMBOL AKSI --}}
        <div class="cms-form-actions">
            <button type="submit" class="primary-button">
                <i class="bi bi-floppy"></i>
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.about-page.section.edit', ['section' => 'cta']) }}"
                class="secondary-button"
            >
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
