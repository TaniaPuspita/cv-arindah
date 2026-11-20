
@extends('admin.layouts.app')

@section('content')
<div class="pc-page">
    <div class="pc-page-header">
        <div>
            <div class="pc-breadcrumb">
                <a href="{{ route('admin.product-categories.index') }}">
                    Kategori Produk
                </a>
                <span>/</span>
                <span>Tambah Kategori</span>
            </div>

            <h1 class="pc-page-title">Tambah Kategori Produk</h1>
            <p class="pc-page-description">
                Tambahkan kategori produk baru untuk ditampilkan pada halaman beranda CV Arindah.
            </p>
        </div>
    </div>

    @if (session('success'))
        <div class="cms-alert cms-alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="cms-alert cms-alert-error">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.product-categories.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="pc-form-layout">
            <div class="cms-card pc-form-main">
                <div class="cms-card-heading">
                    <div>
                        <h2>Informasi Kategori</h2>
                        <p>Lengkapi informasi kategori produk di bawah ini.</p>
                    </div>
                </div>

                <div class="cms-form-group">
                    <label for="name">Nama Kategori <span>*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="cms-input"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Komputer & Teknologi"
                        maxlength="255"
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
                        class="cms-input pc-textarea"
                        rows="5"
                        placeholder="Jelaskan produk yang termasuk dalam kategori ini..."
                    >{{ old('description') }}</textarea>
                    <small class="field-hint">
                        Berikan deskripsi singkat dan jelas mengenai kategori produk.
                    </small>
                    @error('description')
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="cms-form-group">
                    <label for="image">Gambar Kategori</label>

                    <div class="pc-upload-box">
                        <div class="pc-upload-icon">↑</div>
                        <div>
                            <label for="image" class="pc-upload-label">
                                Pilih gambar dari komputer
                            </label>
                            <p>Format gambar JPG, JPEG, PNG, atau WEBP.</p>
                            <p class="field-hint">Pastikan gambar sesuai dengan kategori produk.</p>
                        </div>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        >
                    </div>

                    @error('image')
                        <small class="field-error">{{ $message }}</small>
                    @enderror

                    <div class="pc-image-preview" id="imagePreviewContainer" hidden>
                        <p class="field-hint">Preview gambar:</p>
                        <img id="imagePreview" src="" alt="Preview gambar kategori">
                        <button type="button" id="removeImage" class="pc-remove-image">
                            Hapus gambar
                        </button>
                    </div>
                </div>
            </div>

            <div class="pc-form-sidebar">
                <div class="cms-card">
                    <div class="cms-card-heading">
                        <div>
                            <h2>Pengaturan</h2>
                            <p>Atur urutan dan status kategori.</p>
                        </div>
                    </div>

                    <div class="cms-form-group">
                        <label for="sort_order">Urutan Tampilan <span>*</span></label>
                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            class="cms-input"
                            value="{{ old('sort_order', 1) }}"
                            min="0"
                            required
                        >
                        <small class="field-hint">
                            Angka lebih kecil ditampilkan lebih dahulu.
                        </small>
                        @error('sort_order')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="cms-form-group">
                        <label for="is_active">Status Kategori <span>*</span></label>
                        <select
                            id="is_active"
                            name="is_active"
                            class="cms-input"
                            required
                        >
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                                Aktif
                            </option>
                            <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>
                                Nonaktif
                            </option>
                        </select>
                        <small class="field-hint">
                            Kategori nonaktif tidak ditampilkan pada halaman publik jika beranda menggunakan filter kategori aktif.
                        </small>
                        @error('is_active')
                            <small class="field-error">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="pc-info-note">
                        <strong>Catatan</strong>
                        <p>
                            Nama kategori wajib diisi. Gambar bersifat opsional jika aturan validasi di controller mengizinkannya.
                        </p>
                    </div>
                </div>

                <div class="cms-card pc-action-card">
                    <button type="submit" class="primary-button pc-submit-button">
                        Simpan Kategori
                    </button>

                    <a
                        href="{{ route('admin.product-categories.index') }}"
                        class="secondary-button pc-cancel-button"
                    >
                        Batal
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/product-categories/create.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/pages/admin/product-categories/create.js') }}"></script>
@endpush
@endsection
