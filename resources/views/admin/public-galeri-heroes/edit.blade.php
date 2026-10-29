
@extends('admin.layouts.app')

@section('title', 'Hero Galeri | CV Arindah')
@section('page-title', 'CMS Galeri')

@section('content')
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
        <h1 class="page-title">Hero Galeri</h1>
        <p class="page-description">
            Kelola teks dan gambar pada bagian Hero di bawah navbar halaman Galeri publik CV Arindah.
        </p>
    </section>

    {{-- Notifikasi validasi --}}
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


    <section class="cms-card">
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-images"></i>
            </div>

            <div>
                <h3>Pengaturan Hero Galeri</h3>
                <p>
                    Perubahan di sini hanya memengaruhi Hero Galeri,
                    bukan judul Koleksi atau daftar foto.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.public-galeri-heroes.update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- Label Hero --}}
            <div class="cms-form-group">
                <label for="hero_eyebrow">Label Hero</label>

                <input
                    type="text"
                    id="hero_eyebrow"
                    name="hero_eyebrow"
                    class="cms-input"
                    value="{{ old('hero_eyebrow', $hero->hero_eyebrow ?? 'Galeri') }}"
                    maxlength="100"
                    placeholder="Contoh: Galeri"
                    required
                >

                <small class="field-hint">
                    Label kecil di atas judul Hero.
                </small>

                @error('hero_eyebrow')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Judul utama --}}
            <div class="cms-form-group">
                <label for="hero_title">Judul Utama</label>

                <input
                    type="text"
                    id="hero_title"
                    name="hero_title"
                    class="cms-input"
                    value="{{ old('hero_title', $hero->hero_title ?? 'Cerita dalam') }}"
                    maxlength="200"
                    placeholder="Contoh: Cerita dalam"
                    required
                >

                <small class="field-hint">
                    Bagian pertama judul yang tampil dengan warna biru tua.
                </small>

                @error('hero_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Judul highlight --}}
            <div class="cms-form-group">
                <label for="title_highlight">Judul Berwarna Biru</label>

                <input
                    type="text"
                    id="title_highlight"
                    name="title_highlight"
                    class="cms-input"
                    value="{{ old('title_highlight', $hero->title_highlight ?? 'Setiap Visual') }}"
                    maxlength="200"
                    placeholder="Contoh: Setiap Visual"
                    required
                >

                <small class="field-hint">
                    Bagian kedua judul yang tampil dengan warna biru.
                </small>

                @error('title_highlight')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Deskripsi Hero --}}
            <div class="cms-form-group">
                <label for="hero_description">Deskripsi Hero</label>

                <textarea
                    id="hero_description"
                    name="hero_description"
                    class="cms-input cms-textarea"
                    rows="4"
                    maxlength="2000"
                    placeholder="Masukkan deskripsi Hero Galeri..."
                >{{ old('hero_description', $hero->hero_description ?? 'Lihat lebih dekat berbagai produk, aktivitas, dan layanan yang menjadi bagian dari CV Arindah.') }}</textarea>

                <small class="field-hint">
                    Deskripsi yang ditampilkan di bawah judul Hero.
                </small>

                @error('hero_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Gambar Hero --}}
            <div class="cms-form-group">
                <label for="hero_image">Gambar Latar Hero</label>

                <input
                    type="file"
                    id="hero_image"
                    name="hero_image"
                    class="cms-input"
                    accept=".jpg,.jpeg,.png,.webp,.avif,image/jpeg,image/png,image/webp,image/avif"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, WEBP, atau AVIF.
                    Maksimal 5 MB. Kosongkan jika tidak ingin mengganti gambar.
                </small>

                {{-- Preview gambar yang tersimpan --}}
                @if ($hero->hero_image ?? false)
                    <div class="mt-4">
                        <p class="field-hint">Gambar Hero saat ini:</p>

                        <div class="hero-image-preview">
                            <img
                                src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($hero->hero_image) }}"
                                alt="Gambar Hero Galeri saat ini"
                            >
                        </div>
                    </div>
                @else
                    {{-- Preview gambar bawaan --}}
                    <div class="mt-4">
                        <p class="field-hint">Gambar bawaan saat ini:</p>

                        <div class="hero-image-preview">
                            <img
                                src="{{ asset('images/herogaleri.jpg') }}"
                                alt="Gambar bawaan Hero Galeri"
                            >
                        </div>
                    </div>
                @endif

                @error('hero_image')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- Tombol aksi --}}
            <div class="cms-form-actions">
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

@push('styles')
    <style>
        /* Preview gambar Hero */
        .hero-image-preview {
            width: 100%;
            max-width: 480px;
            margin-top: 10px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #f8fafc;
        }

        .hero-image-preview img {
            display: block;
            width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
        }

        /* Tombol Batal warna bata */
        .cancel-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 18px;
            border: 1px solid #a84332;
            border-radius: 8px;
            background-color: #a84332;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease;
        }

        .cancel-button:hover {
            background-color: #893628;
            border-color: #893628;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .cancel-button:focus-visible {
            outline: 3px solid rgba(168, 67, 50, 0.25);
            outline-offset: 3px;
        }

        /* Tampilan responsif pada HP */
        @media (max-width: 576px) {
            .cms-form-actions {
                flex-wrap: wrap;
                gap: 10px;
            }

            .cms-form-actions .primary-button,
            .cms-form-actions .cancel-button {
                width: 100%;
                justify-content: center;
            }

            .hero-image-preview {
                max-width: 100%;
            }

            .hero-image-preview img {
                height: 190px;
            }
        }
    </style>
@endpush
