
@extends('admin.layouts.app')

@section('title', 'CMS Galeri | CV Arindah')
@section('page-title', 'CMS Galeri')

@section('content')
<div class="container-fluid galeri-cms-page">

    {{-- HEADER HALAMAN --}}
    <section class="dashboard-intro galeri-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
        <h1 class="page-title">Daftar Foto Galeri</h1>
        <p class="page-description">
            Kelola informasi bagian Koleksi dan foto yang ditampilkan
            pada halaman Galeri CV Arindah.
        </p>
    </section>

    @if ($errors->any())
        <div class="cms-alert cms-alert-error" role="alert">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PENGATURAN BAGIAN KOLEKSI --}}
    <section class="cms-card galeri-content-card">

        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h3>Pengaturan Konten Koleksi</h3>
                <p>
                    Atur label, judul, dan deskripsi yang tampil
                    di atas kumpulan foto Galeri.
                </p>
            </div>
        </div>

        <form
            
            action="{{ route('admin.public-galeri-koleksi.update') }}"

            method="POST"
        >
            @csrf
            @method('PUT')

            <input type="hidden" name="redirect_to" value="daftar-foto">

            <div class="cms-form-group">
                <label for="eyebrow">Label Bagian</label>
                <input
                    type="text"
                    id="eyebrow"
                    name="eyebrow"
                    class="cms-input"
                    value="{{ old('eyebrow', $hero->eyebrow) }}"
                    maxlength="100"
                    placeholder="Contoh: KOLEKSI"
                    required
                >
                @error('eyebrow')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="title">Judul Utama</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title', $hero->title) }}"
                    maxlength="200"
                    placeholder="Contoh: Produk, Aktivitas & Layanan Kami"
                    required
                >
                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="description">Deskripsi</label>
                <textarea
                    id="description"
                    name="description"
                    class="cms-input cms-textarea"
                    rows="4"
                    maxlength="2000"
                    placeholder="Masukkan deskripsi singkat untuk bagian Koleksi..."
                >{{ old('description', $hero->description) }}</textarea>

                <small class="field-hint">
                    Deskripsi ini ditampilkan pada bagian Koleksi,
                    bukan pada hero utama halaman Galeri.
                </small>

                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-actions galeri-form-actions">
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

    {{-- DAFTAR FOTO --}}
    <section class="cms-card galeri-list-card">

        <div class="galeri-list-heading">
            <div class="cms-card-heading galeri-list-title">
                <div class="cms-heading-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div>
                    <h3>Daftar Foto Galeri</h3>
                    <p>
                        Tambah, edit, atau hapus foto yang ditampilkan
                        pada halaman Galeri.
                    </p>
                </div>
            </div>

            <a
                href="{{ route('admin.public-galeri-items.create') }}"
                class="primary-button galeri-add-button"
            >
                <i class="bi bi-plus-lg"></i>
                Tambah Foto
            </a>
        </div>

        <div class="galeri-table-wrapper">
            <table class="table galeri-table align-middle">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Foto</th>
                        <th>Informasi Foto</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($items as $item)
                        @php
                            /*
                             * Foto lama berada di public/images/...
                             * Foto upload CMS berada di storage/app/public/...
                             */
                            $imagePath = $item->image ?? '';

                            if (
                                \Illuminate\Support\Str::startsWith(
                                    $imagePath,
                                    ['http://', 'https://']
                                )
                            ) {
                                $imageUrl = $imagePath;
                            } elseif (
                                \Illuminate\Support\Str::startsWith(
                                    $imagePath,
                                    'images/'
                                )
                            ) {
                                $imageUrl = asset($imagePath);
                            } else {
                                $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')
                                    ->url($imagePath);
                            }
                        @endphp

                        <tr>
                            <td data-label="Urutan">
                                <span class="galeri-order">
                                    {{ $item->sort_order }}
                                </span>
                            </td>

                            <td data-label="Foto">
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $item->alt_text ?: $item->title }}"
                                    class="galeri-thumbnail"
                                    style="object-position: {{ $item->image_position ?: 'center' }}"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.alt='Foto tidak dapat dimuat';"
                                >
                            </td>

                            <td data-label="Informasi Foto">
                                <div class="galeri-item-title">
                                    {{ $item->title }}
                                </div>
                                <small class="galeri-item-alt">
                                    {{ $item->alt_text ?: 'Belum ada teks alternatif' }}
                                </small>
                            </td>

                            <td data-label="Kategori">
                                <span class="galeri-category">
                                    {{ $item->category === 'produk' ? 'Produk' : 'Jasa & Layanan' }}
                                </span>
                            </td>

                            <td data-label="Status">
                                @if ($item->is_active)
                                    <span class="galeri-status is-active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="galeri-status is-inactive">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td data-label="Aksi">
                                <div class="galeri-action-buttons">
                                    <a
                                        href="{{ route('admin.public-galeri-items.edit', $item) }}"
                                        class="galeri-action-btn edit"
                                        aria-label="Edit {{ $item->title }}"
                                        title="Edit foto"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.public-galeri-items.destroy', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="galeri-action-btn delete"
                                            aria-label="Hapus {{ $item->title }}"
                                            title="Hapus foto"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="galeri-empty">
                                <i class="bi bi-images"></i>
                                <strong>Belum ada foto galeri</strong>
                                <span>Tambahkan foto untuk mulai mengisi koleksi.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="galeri-table-footer">
            Total foto: <strong>{{ $items->count() }}</strong>
        </div>
    </section>

</div>

<style>
    .galeri-cms-page {
        padding: 8px 0 28px;
        min-width: 0;
    }

    .galeri-intro {
        margin-bottom: 24px;
    }

    .galeri-content-card,
    .galeri-list-card {
        background: #fff;
        border: 1px solid #e8ebf0;
        border-radius: 18px;
        padding: 26px;
        margin-bottom: 24px;
        min-width: 0;
        box-shadow: 0 5px 20px rgba(25, 42, 70, .04);
    }

    .galeri-content-card .cms-card-heading,
    .galeri-list-title {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 26px;
    }

    .galeri-content-card .cms-card-heading h3,
    .galeri-list-title h3 {
        margin: 0 0 6px;
        font-size: 18px;
        font-weight: 700;
        color: #202b3c;
    }

    .galeri-content-card .cms-card-heading p,
    .galeri-list-title p {
        margin: 0;
        color: #788395;
        font-size: 13px;
        line-height: 1.7;
    }

    .galeri-cms-page .cms-form-group {
        margin-bottom: 22px;
    }

    .galeri-cms-page .cms-form-group label {
        display: block;
        margin-bottom: 9px;
        color: #303b4d;
        font-size: 13px;
        font-weight: 600;
    }

    .galeri-cms-page .cms-input {
        display: block;
        width: 100%;
        min-width: 0;
        border: 1px solid #dfe4ec;
        border-radius: 10px;
        padding: 12px 14px;
        color: #273448;
        background: #fff;
        font: inherit;
        font-size: 14px;
        transition: border-color .2s, box-shadow .2s;
    }

    .galeri-cms-page .cms-input:focus {
        outline: none;
        border-color: #315fc5;
        box-shadow: 0 0 0 3px rgba(49, 95, 197, .12);
    }

    .galeri-cms-page .cms-textarea {
        resize: vertical;
        min-height: 110px;
    }

    .galeri-cms-page .field-hint {
        display: block;
        margin-top: 8px;
        color: #7a8595;
        font-size: 12px;
        line-height: 1.6;
    }

    .galeri-cms-page .field-error {
        display: block;
        margin-top: 7px;
        color: #dc3545;
        font-size: 12px;
    }

    .galeri-form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        margin-top: 28px;
    }

    .galeri-cms-page .primary-button,
    .galeri-cms-page .secondary-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 44px;
        padding: 11px 18px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .2s ease;
        cursor: pointer;
    }

    .galeri-cms-page .primary-button {
        border: 1px solid #244fae;
        background: #244fae;
        color: #fff;
    }

    .galeri-cms-page .primary-button:hover {
        background: #1c408f;
        color: #fff;
    }

    .galeri-cms-page .secondary-button {
        border: 1px solid #dfe4ec;
        background: #fff;
        color: #455267;
    }

    .galeri-cms-page .secondary-button:hover {
        background: #f5f7fa;
    }

    .galeri-list-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        margin-bottom: 22px;
    }

    .galeri-list-title {
        margin: 0;
    }

    .galeri-add-button {
        flex-shrink: 0;
    }

    .galeri-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid #e9edf2;
        border-radius: 12px;
    }

    .galeri-table {
        width: 100%;
        min-width: 720px;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .galeri-table thead th {
        padding: 15px 14px;
        background: #f7f9fc;
        color: #697587;
        border-bottom: 1px solid #e9edf2;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        white-space: nowrap;
    }

    .galeri-table tbody td {
        padding: 14px;
        border-bottom: 1px solid #edf0f4;
        color: #344054;
        font-size: 13px;
    }

    .galeri-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .galeri-thumbnail {
        display: block;
        width: 76px;
        height: 62px;
        object-fit: cover;
        border-radius: 9px;
        background: #f1f3f6;
    }

    .galeri-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        height: 30px;
        padding: 0 8px;
        background: #f0f4ff;
        color: #244fae;
        border-radius: 8px;
        font-weight: 700;
    }

    .galeri-item-title {
        font-weight: 600;
        color: #273448;
        margin-bottom: 5px;
    }

    .galeri-item-alt {
        color: #8791a0;
        font-size: 11px;
    }

    .galeri-category,
    .galeri-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .galeri-category {
        background: #eef3ff;
        color: #3157a4;
    }

    .galeri-status.is-active {
        background: #e8f8ef;
        color: #198754;
    }

    .galeri-status.is-inactive {
        background: #f1f2f4;
        color: #707784;
    }

    .galeri-action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .galeri-action-buttons form {
        margin: 0;
    }

    .galeri-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 35px;
        height: 35px;
        border: 1px solid transparent;
        border-radius: 9px;
        cursor: pointer;
        text-decoration: none;
        transition: .2s ease;
    }

    .galeri-action-btn.edit {
        background: #eef3ff;
        color: #315fc5;
    }

    .galeri-action-btn.edit:hover {
        background: #dce7ff;
    }

    .galeri-action-btn.delete {
        background: #fff0f0;
        color: #d64045;
    }

    .galeri-action-btn.delete:hover {
        background: #ffe0e0;
    }

    .galeri-empty {
        padding: 42px 16px !important;
        text-align: center;
    }

    .galeri-empty i,
    .galeri-empty strong,
    .galeri-empty span {
        display: block;
    }

    .galeri-empty i {
        margin-bottom: 10px;
        font-size: 28px;
        color: #9aa5b5;
    }

    .galeri-empty strong {
        margin-bottom: 5px;
        color: #344054;
    }

    .galeri-empty span {
        color: #8791a0;
        font-size: 12px;
    }

    .galeri-table-footer {
        padding-top: 15px;
        color: #778294;
        font-size: 12px;
    }

    .galeri-table-footer strong {
        color: #344054;
    }

    /* TABLET */
    @media (max-width: 991.98px) {
        .galeri-content-card,
        .galeri-list-card {
            padding: 22px;
        }

        .galeri-list-heading {
            align-items: flex-start;
        }
    }

    /* MOBILE */
    @media (max-width: 767.98px) {
        .galeri-cms-page {
            padding: 4px 0 20px;
        }

        .galeri-intro {
            margin-bottom: 18px;
        }

        .galeri-content-card,
        .galeri-list-card {
            padding: 17px;
            margin-bottom: 18px;
            border-radius: 14px;
        }

        .galeri-content-card .cms-card-heading,
        .galeri-list-title {
            gap: 11px;
            margin-bottom: 22px;
        }

        .galeri-content-card .cms-card-heading h3,
        .galeri-list-title h3 {
            font-size: 16px;
            line-height: 1.5;
        }

        .galeri-content-card .cms-card-heading p,
        .galeri-list-title p {
            font-size: 12px;
        }

        .galeri-cms-page .cms-form-group {
            margin-bottom: 19px;
        }

        .galeri-cms-page .cms-input {
            padding: 12px;
            font-size: 14px;
        }

        .galeri-form-actions {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 24px;
        }

        .galeri-cms-page .primary-button,
        .galeri-cms-page .secondary-button {
            width: 100%;
            min-height: 45px;
        }

        .galeri-list-heading {
            flex-direction: column;
            align-items: stretch;
            gap: 18px;
        }

        .galeri-add-button {
            width: 100%;
        }

        .galeri-table-wrapper {
            overflow: visible;
            border: 0;
        }

        .galeri-table {
            display: block;
            min-width: 0;
            width: 100%;
        }

        .galeri-table thead {
            display: none;
        }

        .galeri-table tbody {
            display: grid;
            gap: 13px;
        }

        .galeri-table tbody tr {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0 12px;
            padding: 12px;
            border: 1px solid #e9edf2;
            border-radius: 12px;
            background: #fff;
        }

        .galeri-table tbody td {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            min-width: 0;
            padding: 10px 2px;
            border-bottom: 1px solid #f0f2f5;
            overflow-wrap: anywhere;
        }

        .galeri-table tbody td::before {
            content: attr(data-label);
            display: block;
            margin-bottom: 8px;
            color: #8490a0;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .galeri-table tbody td[data-label="Informasi Foto"] {
            grid-column: 1 / -1;
            grid-row: 1;
        }

        .galeri-table tbody td[data-label="Foto"] {
            grid-column: 1;
        }

        .galeri-table tbody td[data-label="Urutan"] {
            grid-column: 2;
            grid-row: 2;
        }

        .galeri-table tbody td[data-label="Kategori"] {
            grid-column: 1;
        }

        .galeri-table tbody td[data-label="Status"] {
            grid-column: 2;
        }

        .galeri-table tbody td[data-label="Aksi"] {
            grid-column: 1 / -1;
            align-items: stretch;
            border-bottom: 0;
        }

        .galeri-table tbody td[data-label="Aksi"]::before {
            margin-bottom: 10px;
        }

        .galeri-thumbnail {
            width: 100%;
            max-width: 150px;
            height: 100px;
        }

        .galeri-action-buttons {
            justify-content: flex-start;
        }

        .galeri-empty {
            grid-column: 1 / -1;
            align-items: center !important;
            text-align: center;
            border-bottom: 0 !important;
        }

        .galeri-empty::before {
            display: none !important;
        }
    }

    @media (max-width: 380px) {
        .galeri-content-card,
        .galeri-list-card {
            padding: 13px;
        }

        .galeri-table tbody tr {
            padding: 9px;
            gap: 0 8px;
        }
    }
</style>
@endsection
