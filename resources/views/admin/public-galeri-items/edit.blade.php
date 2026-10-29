
@extends('admin.layouts.app')

@section('title', 'Edit Foto Galeri | CV Arindah')
@section('page-title', 'Edit Foto Galeri')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Edit Foto Galeri</h1>

        <p class="page-description">
            Perbarui informasi foto produk atau jasa &amp; layanan
            yang ditampilkan pada halaman Galeri CV Arindah.
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

    {{-- FORM EDIT FOTO GALERI --}}
    <section class="cms-card">

        {{-- HEADER CARD --}}
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div>
                <h3>Pengaturan Foto Galeri</h3>
                <p>
                    Perbarui informasi foto, kategori, dan status publikasi,
                    lalu simpan perubahan.
                </p>
            </div>
        </div>

        {{-- FORM UTAMA --}}
        <form
            action="{{ route('admin.public-galeri-items.update', $galeri) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- JUDUL FOTO --}}
            <div class="cms-form-group">
                <label for="title">Judul Foto</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title', $galeri->title) }}"
                    maxlength="150"
                    placeholder="Masukkan judul foto"
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
                    <option
                        value="produk"
                        @selected(old('category', $galeri->category) === 'produk')
                    >
                        Produk
                    </option>

                    <option
                        value="jasa"
                        @selected(old('category', $galeri->category) === 'jasa')
                    >
                        Jasa &amp; Layanan
                    </option>
                </select>

                @error('category')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- MENENTUKAN URL FOTO --}}
            @php
                $imagePath = $galeri->image ?? '';

                if (\Illuminate\Support\Str::startsWith(
                    $imagePath,
                    ['http://', 'https://']
                )) {
                    $imageUrl = $imagePath;
                } elseif (\Illuminate\Support\Str::startsWith(
                    $imagePath,
                    'images/'
                )) {
                    $imageUrl = asset($imagePath);
                } elseif (!empty($imagePath)) {
                    $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')
                        ->url($imagePath);
                } else {
                    $imageUrl = null;
                }
            @endphp

            {{-- FOTO SAAT INI --}}
            <div class="cms-form-group">
                <label>Foto Saat Ini</label>

                <div class="current-image">
                    @if ($imageUrl)
                        <p>Foto yang tersimpan saat ini:</p>

                        <img
                            src="{{ $imageUrl }}"
                            alt="{{ $galeri->alt_text ?: $galeri->title }}"
                            class="galeri-current-image"
                            style="object-position: {{ $galeri->image_position ?: 'center' }}"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >

                        <div class="galeri-image-fallback" style="display: none;">
                            <i class="bi bi-image"></i>
                            <span>Foto tidak dapat dimuat.</span>
                        </div>
                    @else
                        <p>Belum ada foto yang tersimpan.</p>
                    @endif
                </div>
            </div>

            {{-- GANTI FOTO --}}
            <div class="cms-form-group">
                <label for="image">Ganti Foto</label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp,.avif"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, WEBP, atau AVIF.
                    Maksimal 5 MB. Kosongkan jika tidak ingin mengganti foto.
                </small>

                @error('image')
                    <small class="field-error">{{ $message }}</small>
                @enderror

                {{-- PRATINJAU FOTO BARU --}}
                <div id="galeri-new-preview" class="galeri-new-preview" hidden>
                    <p>Pratinjau foto baru:</p>

                    <img
                        id="galeri-new-image"
                        src=""
                        alt="Pratinjau foto baru"
                        class="galeri-current-image"
                    >
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
                    value="{{ old('alt_text', $galeri->alt_text) }}"
                    maxlength="255"
                    placeholder="Deskripsi singkat foto"
                >

                <small class="field-hint">
                    Deskripsi alternatif membantu menjelaskan isi gambar.
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
                            @selected(old('image_position', $galeri->image_position ?: 'center') === $value)
                        >
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

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
                    value="{{ old('sort_order', $galeri->sort_order) }}"
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
                        @selected((string) old('is_active', (int) $galeri->is_active) === '1')
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        @selected((string) old('is_active', (int) $galeri->is_active) === '0')
                    >
                        Nonaktif
                    </option>
                </select>

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
                    href="{{ route('admin.public-galeri-items.index') }}"
                    class="secondary-button"
                >
                    Batal
                </a>
            </div>

        </form>
    </section>

    {{-- CSS TAMBAHAN KHUSUS FOTO GALERI --}}
    <style>
        .galeri-current-image {
            display: block;
            width: 320px;
            max-width: 100%;
            height: 220px;
            object-fit: cover;
            border: 1px solid #e8ebf0;
            border-radius: 10px;
            background: #f1f3f6;
        }

        .current-image p,
        .galeri-new-preview p {
            margin-bottom: 10px;
            color: #788395;
            font-size: 13px;
        }

        .galeri-image-fallback {
            width: 320px;
            max-width: 100%;
            min-height: 140px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 20px;
            color: #8791a0;
            background: #f7f9fc;
            border: 1px solid #e8ebf0;
            border-radius: 10px;
        }

        .galeri-image-fallback i {
            font-size: 28px;
        }

        .galeri-new-preview {
            margin-top: 14px;
        }

        @media (max-width: 575.98px) {
            .galeri-current-image {
                width: 100%;
                height: 200px;
            }
        }
    </style>

    {{-- PRATINJAU FOTO SEBELUM DISIMPAN --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('image');
            const container = document.getElementById('galeri-new-preview');
            const preview = document.getElementById('galeri-new-image');

            if (!input || !container || !preview) return;

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
                    return;
                }

                objectUrl = URL.createObjectURL(file);
                preview.src = objectUrl;
                container.hidden = false;
            });
        });
    </script>

@endsection
