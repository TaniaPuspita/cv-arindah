
{{-- =========================================================
    CMS KONTAK / CTA - CV ARINDAH
    File: resources/views/admin/homepage-kontak/edit.blade.php
========================================================= --}}

@extends('admin.layouts.app')

@section('title', 'Kontak / CTA Beranda | CV Arindah')
@section('page-title', 'Kontak / CTA Beranda')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Kontak / CTA Beranda</h1>

        <p class="page-description">
            Kelola judul, deskripsi, tombol, dan gambar latar pada bagian
            Kontak / CTA website CV Arindah.
        </p>
    </section>

    {{-- NOTIFIKASI VALIDASI --}}
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

    {{-- FORM KONTAK / CTA --}}
    <section class="cms-card">

        {{-- HEADER CARD --}}
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-chat-square-text"></i>
            </div>

            <div>
                <h3>Pengaturan Konten Kontak / CTA</h3>
                <p>
                    Lengkapi kolom berikut, lalu simpan perubahan.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.homepage-kontak.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- LABEL --}}
            <div class="cms-form-group">
                <label for="label">Label Bagian</label>

                <input
                    type="text"
                    id="label"
                    name="label"
                    class="cms-input"
                    value="{{ old('label', $kontak->label) }}"
                    maxlength="255"
                    placeholder="Contoh: KONTAK"
                    required
                >

                @error('label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL --}}
            <div class="cms-form-group">
                <label for="title">Judul CTA</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title', $kontak->title) }}"
                    maxlength="255"
                    placeholder="Contoh: Mari Terhubung dengan CV Arindah"
                    required
                >

                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="cms-form-group">
                <label for="description">Deskripsi CTA</label>

                <textarea
                    id="description"
                    name="description"
                    class="cms-input cms-textarea"
                    rows="5"
                    maxlength="5000"
                    placeholder="Masukkan deskripsi bagian Kontak / CTA..."
                >{{ old('description', $kontak->description) }}</textarea>

                <small class="field-hint">
                    Masukkan informasi singkat yang mengajak pengunjung
                    menghubungi CV Arindah.
                </small>

                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TEKS TOMBOL --}}
            <div class="cms-form-group">
                <label for="button_text">Teks Tombol</label>

                <input
                    type="text"
                    id="button_text"
                    name="button_text"
                    class="cms-input"
                    value="{{ old('button_text', $kontak->button_text) }}"
                    maxlength="100"
                    placeholder="Contoh: Hubungi Kami"
                    required
                >

                @error('button_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- LINK TOMBOL --}}
            <div class="cms-form-group">
                <label for="button_link">Tautan Tombol</label>

                <input
                    type="text"
                    id="button_link"
                    name="button_link"
                    class="cms-input"
                    value="{{ old('button_link', $kontak->button_link) }}"
                    maxlength="255"
                    placeholder="mailto:cv.arindah2016@gmail.com"
                    required
                >

                <small class="field-hint">
                    Gunakan alamat email dengan awalan mailto:,
                    URL HTTPS, atau path internal seperti /kontak.
                </small>

                @error('button_link')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- GAMBAR LATAR --}}
            <div class="cms-form-group">
                <label for="background_image">Gambar Latar CTA</label>

                @if ($kontak->background_image)
                    @php
                        $imagePath = $kontak->background_image;

                        $imageUrl = str_starts_with($imagePath, 'homepage/')
                            ? asset('storage/' . $imagePath)
                            : asset($imagePath);
                    @endphp

                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>

                        <img
                            src="{{ $imageUrl }}"
                            alt="Gambar latar Kontak / CTA CV Arindah"
                        >
                    </div>
                @else
                    <div class="current-image">
                        <p>Belum ada gambar latar yang tersimpan.</p>
                    </div>
                @endif

                <input
                    type="file"
                    id="background_image"
                    name="background_image"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

                @error('background_image')
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
