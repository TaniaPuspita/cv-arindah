
{{-- =========================================================
    CMS PRODUK & LAYANAN - EDIT KATEGORI
    File: resources/views/admin/produk-layanan/categories/edit.blade.php
========================================================= --}}

@extends('admin.layouts.app')

@section('title', 'Edit Kategori Produk | CV Arindah')
@section('page-title', 'CMS Produk & Layanan')

@section('content')

<section class="dashboard-intro">
    <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
    <h1 class="page-title">Edit Kategori Produk</h1>
    <p class="page-description">
        Perbarui informasi kategori produk, gambar, slug, dan pengaturan
        tampilan pada halaman Produk &amp; Layanan CV Arindah.
    </p>
</section>

@if (session('success'))
    <div class="cms-alert cms-alert-success" role="status">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

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
            <i class="bi bi-pencil-square"></i>
        </div>
        <div>
            <h3>Pengaturan Kategori Produk</h3>
            <p>Perbarui data kategori, lalu simpan perubahan.</p>
        </div>
    </div>

    <form
        action="{{ route('admin.produk-layanan.categories.update', $category) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        <div class="cms-form-group">
            <label for="name">Nama Kategori</label>
            <input
                type="text"
                id="name"
                name="name"
                class="cms-input"
                value="{{ old('name', $category->name) }}"
                maxlength="255"
                placeholder="Contoh: Komputer & Teknologi"
                required
            >
            @error('name')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-group">
            <label for="description">Deskripsi Kategori</label>
            <textarea
                id="description"
                name="description"
                class="cms-input cms-textarea"
                rows="5"
                required
                placeholder="Masukkan deskripsi kategori produk..."
            >{{ old('description', $category->description) }}</textarea>

            <small class="field-hint">
                Tuliskan penjelasan singkat mengenai kategori produk.
            </small>
            @error('description')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-group">
            <label for="slug">Slug Kategori</label>
            <input
                type="text"
                id="slug"
                name="slug"
                class="cms-input"
                value="{{ old('slug', $category->slug) }}"
                maxlength="255"
                required
            >
            <small class="field-hint">
                Gunakan huruf kecil, angka, dan tanda hubung (-).
            </small>
            @error('slug')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-group">
            <label for="image">Gambar Kategori</label>

            @if ($category->image)
                @php
                    $currentImage = \Illuminate\Support\Str::startsWith(
                        $category->image,
                        'images/'
                    )
                        ? asset($category->image)
                        : asset('storage/' . $category->image);
                @endphp

                <div class="current-image">
                    <p>Gambar yang tersimpan saat ini:</p>
                    <img
                        src="{{ $currentImage }}"
                        alt="Gambar kategori {{ $category->name }}"
                        loading="lazy"
                    >
                </div>
            @else
                <div class="current-image">
                    <p>Belum ada gambar yang tersimpan.</p>
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
        </div>

        <div class="cms-form-group">
            <label for="sort_order">Urutan Tampilan</label>
            <input
                type="number"
                id="sort_order"
                name="sort_order"
                class="cms-input"
                value="{{ old('sort_order', $category->sort_order) }}"
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
                    {{ (string) old('is_active', (int) $category->is_active) === '1' ? 'selected' : '' }}
                >
                    Aktif
                </option>
                <option
                    value="0"
                    {{ (string) old('is_active', (int) $category->is_active) === '0' ? 'selected' : '' }}
                >
                    Tidak Aktif
                </option>
            </select>

            <small class="field-hint">
                Kategori berstatus aktif ditampilkan pada halaman publik
                selama halaman tersebut mengambil data aktif.
            </small>
            @error('is_active')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-actions">
            <button type="submit" class="primary-button">
                <i class="bi bi-floppy"></i>
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.produk-layanan.categories.index') }}"
                class="secondary-button"
            >
                Batal
            </a>
        </div>

    </form>
</section>

@endsection
