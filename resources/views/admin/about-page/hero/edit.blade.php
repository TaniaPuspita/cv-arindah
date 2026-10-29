@extends('admin.layouts.app')

@section('title', 'CMS Hero Tentang Kami | CV Arindah')
@section('page-title', 'CMS Tentang Kami')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Hero Tentang Kami</h1>

        <p class="page-description">
            Kelola label, judul, deskripsi, dan gambar hero
            pada halaman Tentang Kami CV Arindah.
        </p>
    </section>

    {{-- FORM EDIT HERO --}}
    <section class="cms-card">

        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-image"></i>
            </div>

            <div>
                <h3>Pengaturan Konten Hero</h3>
                <p>
                    Sesuaikan konten berikut dengan informasi
                    yang ingin ditampilkan pada halaman publik.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.about-page.section.update', ['section' => 'hero']) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- LABEL HERO --}}
            <div class="cms-form-group">
                <label for="hero_label">Label Hero</label>

                <input
                    type="text"
                    id="hero_label"
                    name="hero_label"
                    class="cms-input"
                    value="{{ old('hero_label', $aboutPage->hero_label) }}"
                    maxlength="255"
                >

                @error('hero_label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL BARIS 1 --}}
            <div class="cms-form-group">
                <label for="hero_title_line1">Judul Baris Pertama</label>

                <input
                    type="text"
                    id="hero_title_line1"
                    name="hero_title_line1"
                    class="cms-input"
                    value="{{ old('hero_title_line1', $aboutPage->hero_title_line1) }}"
                    maxlength="255"
                >

                @error('hero_title_line1')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL BARIS 2 --}}
            <div class="cms-form-group">
                <label for="hero_title_line2">Judul Baris Kedua</label>

                <input
                    type="text"
                    id="hero_title_line2"
                    name="hero_title_line2"
                    class="cms-input"
                    value="{{ old('hero_title_line2', $aboutPage->hero_title_line2) }}"
                    maxlength="255"
                >

                @error('hero_title_line2')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL BARIS 3 --}}
            <div class="cms-form-group">
                <label for="hero_title_line3">Judul Baris Ketiga</label>

                <input
                    type="text"
                    id="hero_title_line3"
                    name="hero_title_line3"
                    class="cms-input"
                    value="{{ old('hero_title_line3', $aboutPage->hero_title_line3) }}"
                    maxlength="255"
                >

                @error('hero_title_line3')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- DESKRIPSI HERO --}}
            <div class="cms-form-group">
                <label for="hero_description">Deskripsi Hero</label>

                <textarea
                    id="hero_description"
                    name="hero_description"
                    class="cms-input cms-textarea"
                    rows="5"
                >{{ old('hero_description', $aboutPage->hero_description) }}</textarea>

                @error('hero_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- GAMBAR HERO --}}
            <div class="cms-form-group">
                <label for="hero_image">Gambar Hero</label>

                @if ($aboutPage->hero_image)
                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>

                        <img
                            src="{{ asset('storage/' . $aboutPage->hero_image) }}"
                            alt="Gambar hero Tentang Kami saat ini"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="hero_image"
                    name="hero_image"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

                @error('hero_image')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="cms-form-actions">
                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>


                <a href="{{ route('dashboard') }}" class="secondary-button">
                    Batal
                </a>
                
            </div>

        </form>
    </section>

@endsection
