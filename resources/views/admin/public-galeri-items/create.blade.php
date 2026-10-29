
@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri | CV Arindah')
@section('page-title', 'Tambah Foto Galeri')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Tambah Foto Galeri</h1>

        <p class="page-description">
            Tambahkan foto produk atau jasa &amp; layanan yang akan
            ditampilkan pada halaman Galeri publik CV Arindah.
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

    {{-- FORM TAMBAH FOTO GALERI --}}
    <section class="cms-card">

        {{-- HEADER CARD --}}
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-images"></i>
            </div>

            <div>
                <h3>Informasi Foto Galeri</h3>
                <p>
                    Lengkapi informasi foto, tentukan kategori dan posisi,
                    lalu simpan agar foto dapat dikelola melalui CMS.
                </p>
            </div>
        </div>

        {{-- FORM UTAMA --}}
        <form
            action="{{ route('admin.public-galeri-items.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            {{-- JUDUL FOTO --}}
            <div class="cms-form-group">
                <label for="title">Judul Foto</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title') }}"
                    maxlength="150"
                    placeholder="Contoh: Produk CV Arindah"
                    required
                >

                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- KATEGORI --}}
            <div class="cms-form-group">
                <label for="category">Kategori</label>

                <select
                    id="category"
                    name="category"
                    class="cms-input"
                    required
                >
                    <option value="">Pilih kategori</option>

                    <option
                        value="produk"
                        @selected(old('category') === 'produk')
                    >
                        Produk
                    </option>

                    <option
                        value="jasa"
                        @selected(old('category') === 'jasa')
                    >
                        Jasa &amp; Layanan
                    </option>
                </select>

                @error('category')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- FILE FOTO --}}
            <div class="cms-form-group">
                <label for="image">File Foto</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp,.avif"
                    required
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, WEBP, atau AVIF.
                    Maksimal 5 MB.
                </small>

                @error('image')
                    <small class="field-error">{{ $message }}</small>
                @enderror

                {{-- PRATINJAU FOTO --}}
                <div id="galeri-preview-container" class="galeri-preview-container" hidden>
                    <p>Pratinjau foto yang akan ditambahkan:</p>

                    <img
                        id="galeri-preview-image"
                        src=""
                        alt="Pratinjau foto baru"
                        class="galeri-preview-image"
                    >

                    <span id="galeri-preview-name" class="field-hint"></span>
                </div>
            </div>

            {{-- ALT TEXT --}}
            <div class="cms-form-group">
                <label for="alt_text">Deskripsi Foto (Alt Text)</label>

                <input
                    type="text"
                    id="alt_text"
                    name="alt_text"
                    class="cms-input"
                    value="{{ old('alt_text') }}"
                    maxlength="255"
                    placeholder="Contoh: Produk elektronik CV Arindah"
                >

                <small class="field-hint">
                    Masukkan deskripsi singkat yang menjelaskan isi foto.
                </small>

                @error('alt_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- POSISI FOTO --}}
            <div class="cms-form-group">
                <label for="image_position">Posisi Foto</label>

                <select
                    id="image_position"
                    name="image_position"
                    class="cms-input"
                    required
                >
                    @foreach ([
                        'center' => 'Tengah',
                        'center top' => 'Tengah Atas',
                        'center bottom' => 'Tengah Bawah',
                        'left center' => 'Kiri Tengah',
                        'right center' => 'Kanan Tengah',
                    ] as $value => $label)
                        <option
                            value="{{ $value }}"
                            @selected(old('image_position', 'center') === $value)
                        >
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <small class="field-hint">
                    Mengatur bagian foto yang terlihat saat gambar dipotong.
                </small>

                @error('image_position')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- URUTAN TAMPILAN --}}
            <div class="cms-form-group">
                <label for="sort_order">Urutan Tampilan</label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    class="cms-input"
                    value="{{ old('sort_order', 1) }}"
                    min="1"
                    required
                >

                <small class="field-hint">
                    Angka lebih kecil akan ditampilkan lebih dahulu.
                </small>

                @error('sort_order')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- STATUS PUBLIKASI --}}
            <div class="cms-form-group">
                <label for="is_active">Status Publikasi</label>

                <select
                    id="is_active"
                    name="is_active"
                    class="cms-input"
                    required
                >
                    <option
                        value="1"
                        @selected((string) old('is_active', '1') === '1')
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        @selected((string) old('is_active', '1') === '0')
                    >
                        Nonaktif
                    </option>
                </select>

                <small class="field-hint">
                    Foto berstatus aktif akan ditampilkan pada halaman Galeri publik.
                </small>

                @error('is_active')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="cms-form-actions">
                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Foto
                </button>

                <a
                    href="{{ route('admin.public-galeri-items.index') }}"
                    class="secondary-button"
                >
                    Batal
                </a>
            </div>

        </form>
    </section>

    {{-- CSS TAMBAHAN KHUSUS PRATINJAU FOTO --}}
    <style>
        .galeri-preview-container {
            margin-top: 16px;
        }

        .galeri-preview-container p {
            margin-bottom: 10px;
            color: #788395;
            font-size: 13px;
        }

        .galeri-preview-image {
            display: block;
            width: 320px;
            max-width: 100%;
            height: 220px;
            object-fit: cover;
            object-position: center;
            border: 1px solid #e8ebf0;
            border-radius: 10px;
            background: #f1f3f6;
        }

        .galeri-preview-container .field-hint {
            display: block;
            margin-top: 8px;
            overflow-wrap: anywhere;
        }

        @media (max-width: 575.98px) {
            .galeri-preview-image {
                width: 100%;
                height: 200px;
            }
        }
    </style>

    {{-- JAVASCRIPT PRATINJAU FOTO --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const container = document.getElementById('galeri-preview-container');
            const preview = document.getElementById('galeri-preview-image');
            const fileName = document.getElementById('galeri-preview-name');

            if (!input || !container || !preview || !fileName) {
                return;
            }

            let objectUrl = null;

            input.addEventListener('change', function () {
                if (objectUrl) {
                    URL.revokeObjectURL(objectUrl);
                    objectUrl = null;
                }

                const file = this.files && this.files[0];

                if (!file) {
                    container.hidden = true;
                    preview.removeAttribute('src');
                    fileName.textContent = '';
                    return;
                }

                objectUrl = URL.createObjectURL(file);
                preview.src = objectUrl;
                fileName.textContent = file.name;
                container.hidden = false;
            });
        });
    </script>

@endsection
