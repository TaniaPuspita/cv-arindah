
@extends('admin.layouts.app')

@section('title', 'CMS Hero Beranda | CV Arindah')
@section('page-title', 'CMS Beranda')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Hero Beranda</h1>

        <p class="page-description">
            Kelola konten hero yang direncanakan untuk ditampilkan
            pada halaman Beranda CV Arindah.
        </p>
    </section>

    {{-- FORM EDIT HERO --}}
    <section class="cms-card">

        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div>
                <h3>Pengaturan Konten Hero</h3>
                <p>Lengkapi kolom berikut, lalu simpan perubahan.</p>
            </div>
        </div>

        <form action="{{ route('admin.homepage-hero.update') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- LABEL HERO --}}
            <div class="cms-form-group">
                <label for="label">Label Hero</label>
                <input type="text"
                       id="label"
                       name="label"
                       class="cms-input"
                       value="{{ old('label', $hero->label) }}"
                       maxlength="255"
                       required>
                @error('label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL HERO --}}
            <div class="cms-form-group">
                <label for="title">Judul Hero</label>
                <input type="text"
                       id="title"
                       name="title"
                       class="cms-input"
                       value="{{ old('title', $hero->title) }}"
                       maxlength="255"
                       required>
                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- DESKRIPSI HERO --}}
            <div class="cms-form-group">
                <label for="description">Deskripsi Hero</label>
                <textarea id="description"
                          name="description"
                          class="cms-input cms-textarea"
                          rows="5">{{ old('description', $hero->description) }}</textarea>
                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- GAMBAR HERO --}}
            <div class="cms-form-group">
                <label for="image">Gambar Hero</label>

                @if($hero->image)
                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>
                        <img src="{{ asset('storage/' . $hero->image) }}"
                             alt="Gambar hero saat ini">
                    </div>
                @endif

                <input type="file"
                       id="image"
                       name="image"
                       class="cms-input cms-file"
                       accept=".jpg,.jpeg,.png,.webp">

                <small class="field-hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

                @error('image')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TEKS TOMBOL --}}
            <div class="cms-form-group">
                <label for="button_text">Teks Tombol</label>
                <input type="text"
                       id="button_text"
                       name="button_text"
                       class="cms-input"
                       value="{{ old('button_text', $hero->button_text) }}"
                       maxlength="100"
                       required>
                @error('button_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- LINK TOMBOL --}}
            <div class="cms-form-group">
                <label for="button_link">Link Tombol</label>
                <input type="text"
                       id="button_link"
                       name="button_link"
                       class="cms-input"
                       value="{{ old('button_link', $hero->button_link) }}"
                       maxlength="255"
                       placeholder="/produk-layanan"
                       required>
                <small class="field-hint">
                    Contoh: /produk-layanan atau URL tujuan yang sesuai.
                </small>
                @error('button_link')
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
