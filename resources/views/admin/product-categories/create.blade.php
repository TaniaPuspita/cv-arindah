
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

<style>
.pc-page {
    padding: 30px;
    color: #183b65;
}

.pc-page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 26px;
}

.pc-breadcrumb {
    display: flex;
    flex-wrap: wrap;
    gap: 9px;
    margin-bottom: 13px;
    color: #8192aa;
    font-size: 13px;
}

.pc-breadcrumb a {
    color: #1769ff;
    text-decoration: none;
}

.pc-breadcrumb a:hover {
    text-decoration: underline;
}

.pc-page-title {
    margin: 0;
    color: #183b65;
    font-size: 28px;
    font-weight: 750;
    letter-spacing: -0.7px;
}

.pc-page-description {
    margin: 8px 0 0;
    color: #8292a9;
    font-size: 14px;
    line-height: 1.7;
}

.pc-form-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.7fr) minmax(270px, 0.9fr);
    align-items: start;
    gap: 22px;
}

.pc-form-main,
.pc-form-sidebar > .cms-card {
    min-width: 0;
    padding: 25px;
    border: 1px solid #e6edf6;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 5px 20px rgba(27, 64, 108, 0.035);
}

.pc-form-sidebar {
    display: grid;
    gap: 20px;
}

.pc-page .cms-card-heading {
    margin-bottom: 25px;
}

.pc-page .cms-card-heading h2 {
    margin: 0;
    color: #183b65;
    font-size: 17px;
    font-weight: 700;
}

.pc-page .cms-card-heading p {
    margin: 7px 0 0;
    color: #8796ab;
    font-size: 13px;
    line-height: 1.6;
}

.pc-page .cms-form-group {
    margin-bottom: 23px;
}

.pc-page .cms-form-group:last-child {
    margin-bottom: 0;
}

.pc-page .cms-form-group > label {
    display: block;
    margin-bottom: 9px;
    color: #334b6b;
    font-size: 13px;
    font-weight: 650;
}

.pc-page .cms-form-group > label span {
    color: #ef4444;
}

.pc-page .cms-input {
    display: block;
    width: 100%;
    min-height: 45px;
    padding: 11px 13px;
    border: 1px solid #dce5f0;
    border-radius: 10px;
    outline: none;
    background: #fff;
    color: #244263;
    font: inherit;
    font-size: 13px;
    transition: border-color .2s, box-shadow .2s;
}

.pc-page .cms-input:focus {
    border-color: #397cff;
    box-shadow: 0 0 0 3px rgba(57, 124, 255, .11);
}

.pc-page .cms-input::placeholder {
    color: #a2afc0;
}

.pc-page .pc-textarea {
    min-height: 125px;
    resize: vertical;
    line-height: 1.7;
}

.pc-page .field-hint {
    display: block;
    margin-top: 8px;
    color: #8a99ad;
    font-size: 12px;
    line-height: 1.6;
}

.pc-page .field-error {
    display: block;
    margin-top: 7px;
    color: #dc3545;
    font-size: 12px;
}

.pc-upload-box {
    position: relative;
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    border: 1px dashed #b9cce5;
    border-radius: 12px;
    background: #f8fbff;
}

.pc-upload-icon {
    display: grid;
    flex-shrink: 0;
    width: 45px;
    height: 45px;
    place-items: center;
    border-radius: 12px;
    background: #e9f1ff;
    color: #1769ff;
    font-size: 26px;
    font-weight: 600;
}

.pc-upload-label {
    display: inline-block;
    margin-bottom: 6px;
    color: #1769ff;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
}

.pc-upload-box p {
    margin: 0;
    color: #8192a9;
    font-size: 12px;
    line-height: 1.6;
}

.pc-upload-box input[type="file"] {
    width: 100%;
    margin-top: 10px;
    color: #62748d;
    font-size: 12px;
}

.pc-image-preview {
    margin-top: 18px;
    padding: 15px;
    border: 1px solid #e3ebf5;
    border-radius: 12px;
    background: #fbfdff;
}

.pc-image-preview img {
    display: block;
    width: 100%;
    max-width: 300px;
    max-height: 220px;
    margin-top: 10px;
    border-radius: 10px;
    object-fit: contain;
    background: #edf3fa;
}

.pc-remove-image {
    margin-top: 12px;
    padding: 7px 12px;
    border: 1px solid #fecaca;
    border-radius: 8px;
    background: #fff;
    color: #dc3545;
    font-size: 12px;
    cursor: pointer;
}

.pc-info-note {
    padding: 14px;
    border: 1px solid #dbeafe;
    border-radius: 11px;
    background: #f3f7ff;
}

.pc-info-note strong {
    color: #245ca8;
    font-size: 13px;
}

.pc-info-note p {
    margin: 7px 0 0;
    color: #6f829c;
    font-size: 12px;
    line-height: 1.7;
}

.pc-action-card {
    display: grid;
    gap: 11px;
}

.pc-submit-button,
.pc-cancel-button {
    display: flex;
    width: 100%;
    min-height: 45px;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;
    font-size: 13px;
    font-weight: 650;
    cursor: pointer;
}

.pc-page .pc-submit-button {
    border: 1px solid #1769ff;
    background: #1769ff;
    color: #fff;
}

.pc-page .pc-submit-button:hover {
    background: #0756e8;
}

.pc-page .pc-cancel-button {
    border: 1px solid #dce5f0;
    background: #fff;
    color: #63758e;
}

.pc-page .pc-cancel-button:hover {
    background: #f7faff;
}

@media (max-width: 1000px) {
    .pc-form-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .pc-form-sidebar {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        align-items: start;
    }
}

@media (max-width: 600px) {
    .pc-page {
        padding: 20px 14px;
    }

    .pc-page-title {
        font-size: 23px;
    }

    .pc-form-main,
    .pc-form-sidebar > .cms-card {
        padding: 18px;
        border-radius: 14px;
    }

    .pc-form-sidebar {
        grid-template-columns: minmax(0, 1fr);
    }

    .pc-upload-box {
        align-items: flex-start;
        padding: 15px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('image');
    const container = document.getElementById('imagePreviewContainer');
    const preview = document.getElementById('imagePreview');
    const removeButton = document.getElementById('removeImage');

    if (!input || !container || !preview || !removeButton) return;

    let previewUrl = null;

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        if (!file) {
            preview.removeAttribute('src');
            container.hidden = true;
            return;
        }

        if (!file.type.startsWith('image/')) {
            this.value = '';
            preview.removeAttribute('src');
            container.hidden = true;
            alert('Silakan pilih file gambar yang valid.');
            return;
        }

        previewUrl = URL.createObjectURL(file);
        preview.src = previewUrl;
        container.hidden = false;
    });

    removeButton.addEventListener('click', function () {
        input.value = '';
        preview.removeAttribute('src');
        container.hidden = true;

        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }
    });
});
</script>
@endsection
