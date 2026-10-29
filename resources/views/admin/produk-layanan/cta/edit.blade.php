
{{-- =========================================================
    CMS CTA PRODUK & LAYANAN - CV ARINDAH
    File: resources/views/admin/produk-layanan/cta/edit.blade.php
========================================================= --}}

@extends('admin.layouts.app')

@section('title', 'CMS CTA Produk & Layanan | CV Arindah')
@section('page-title', 'CMS CTA Produk & Layanan')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">CTA Produk &amp; Layanan</h1>

        <p class="page-description">
            Kelola judul, deskripsi, tombol, tujuan tombol, dan gambar
            pada bagian Hubungi Kami di halaman Produk &amp; Layanan.
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

    {{-- FORM CTA --}}
    <section class="cms-card">

        {{-- HEADER CARD --}}
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-chat-square-text"></i>
            </div>

            <div>
                <h3>Pengaturan Konten CTA</h3>
                <p>
                    Perubahan berikut hanya ditujukan untuk CTA
                    pada halaman Produk &amp; Layanan.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.produk-layanan.cta.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- JUDUL CTA --}}
            <div class="cms-form-group">
                <label for="title">Judul CTA</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title', $cta?->title ?? 'Butuh Produk atau Layanan untuk Kebutuhan Anda?') }}"
                    maxlength="255"
                    placeholder="Contoh: Butuh Produk atau Layanan untuk Kebutuhan Anda?"
                    required
                >

                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- DESKRIPSI CTA --}}
            <div class="cms-form-group">
                <label for="description">Deskripsi CTA</label>

                <textarea
                    id="description"
                    name="description"
                    class="cms-input cms-textarea"
                    rows="5"
                    maxlength="5000"
                    placeholder="Masukkan deskripsi CTA..."
                    required
                >{{ old('description', $cta?->description ?? 'Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut mengenai produk dan layanan yang tersedia.') }}</textarea>

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
                    value="{{ old('button_text', $cta?->button_text ?? 'Hubungi Kami') }}"
                    maxlength="100"
                    placeholder="Contoh: Hubungi Kami"
                    required
                >

                @error('button_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TUJUAN TOMBOL --}}
            <div class="cms-form-group">
                <label for="email">Tujuan Tombol</label>

                <input
                    type="text"
                    id="email"
                    name="email"
                    class="cms-input"
                    value="{{ old('email', $cta?->email ?? '/kontak') }}"
                    maxlength="2048"
                    placeholder="/kontak atau nama@email.com"
                    required
                >

                <small class="field-hint">
                    Isi /kontak untuk menuju halaman Kontak, alamat email
                    untuk membuka aplikasi email, atau URL HTTPS untuk
                    menuju website lain.
                </small>

                @error('email')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- GAMBAR CTA --}}
            <div class="cms-form-group">
                <label for="image">Gambar CTA</label>

                @if ($cta?->image)
                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>

                        <img
                            src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($cta->image) }}"
                            alt="Gambar CTA Produk dan Layanan CV Arindah"
                        >
                    </div>
                @else
                    <div class="current-image">
                        <p>Belum ada gambar CTA yang tersimpan.</p>
                    </div>
                @endif

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

                {{-- PREVIEW GAMBAR BARU --}}
                <div id="image-preview-wrapper" class="current-image" hidden>
                    <p>Preview gambar baru:</p>
                    <img id="image-preview" src="" alt="Preview gambar CTA baru">
                </div>
            </div>

            {{-- STATUS CTA --}}
            <div class="cms-form-group">
                <label for="is_active">Status CTA</label>

                <select
                    id="is_active"
                    name="is_active"
                    class="cms-input"
                    required
                >
                    <option
                        value="1"
                        @selected((string) old('is_active', $cta?->is_active ?? 1) === '1')
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        @selected((string) old('is_active', $cta?->is_active ?? 1) === '0')
                    >
                        Nonaktif
                    </option>
                </select>

                <small class="field-hint">
                    CTA nonaktif nantinya tidak ditampilkan pada halaman publik.
                </small>

                @error('is_active')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="cms-form-actions">

                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.produk-layanan.layanan-items.index') }}"
                    class="secondary-button"
                >
                    Batal
                </a>

            </div>

        </form>
    </section>

    {{-- PREVIEW GAMBAR SEBELUM DIUNGGAH --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const wrapper = document.getElementById('image-preview-wrapper');
            const preview = document.getElementById('image-preview');

            if (!input || !wrapper || !preview) return;

            input.addEventListener('change', function () {
                const file = this.files && this.files[0];

                if (!file) {
                    preview.removeAttribute('src');
                    wrapper.hidden = true;
                    return;
                }

                if (!file.type.startsWith('image/')) {
                    this.value = '';
                    preview.removeAttribute('src');
                    wrapper.hidden = true;
                    return;
                }

                preview.src = URL.createObjectURL(file);
                wrapper.hidden = false;
            });
        });
    </script>

@endsection
