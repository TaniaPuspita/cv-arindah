@extends('admin.layouts.app')

@section('title', 'CMS Detail Kategori Produk | CV Arindah')
@section('page-title', 'CMS Produk & Layanan')

@push('styles')
<style>
    .category-detail-page {
        width: 100%;
        max-width: 100%;
        min-width: 0;
    }

    .category-info-card,
    .detail-section-card {
        min-width: 0;
        overflow: hidden;
    }

    .current-image {
        margin: 12px 0 16px;
        padding: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #f9fafb;
    }

    .current-image p {
        margin: 0 0 10px;
    }

    .current-image img {
        display: block;
        width: 100%;
        max-width: 420px;
        max-height: 280px;
        object-fit: contain;
        object-position: left center;
        border-radius: 8px;
        background: #fff;
    }

    .current-image .field-hint {
        display: block;
        margin-top: 10px;
        overflow-wrap: anywhere;
    }

    .image-load-error {
        display: none;
        margin-top: 10px !important;
        color: #b42318;
    }

    .detail-tab-panel[hidden] {
        display: none !important;
    }

    /* TAB KONTEN */
    .detail-content-tabs {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        width: 100%;
        margin: 20px 0;
    }

    .detail-content-tab {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 0;
        min-height: 46px;
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #fff;
        color: #475569;
        font: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background .2s, color .2s, border-color .2s;
    }

    .detail-content-tab:hover {
        border-color: #93c5fd;
        color: #0969d8;
    }

    .detail-content-tab.active {
        border-color: #0969d8;
        background: #eff6ff;
        color: #0969d8;
    }

    .detail-content-tab i {
        flex-shrink: 0;
    }

    .detail-section-card {
        width: 100%;
        margin-bottom: 20px;
    }

    .detail-subheading {
        margin: 24px 0 16px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-subheading h4 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
    }

    .detail-form-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 24px;
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: #b42318;
        overflow-wrap: anywhere;
    }

    .field-hint {
        display: block;
        margin-top: 6px;
        color: #64748b;
        font-size: 12px;
        line-height: 1.6;
    }

    /* PEMILIH IKON */
    .icon-picker {
        margin-top: 10px;
    }

    .icon-picker-label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .icon-picker-options {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 8px;
    }

    .icon-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 0;
        min-height: 72px;
        padding: 8px 4px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #fff;
        color: #475569;
        font-size: 11px;
        text-align: center;
        overflow-wrap: anywhere;
        cursor: pointer;
        transition: .2s ease;
    }

    .icon-option i {
        font-size: 20px;
    }

    .icon-option:hover {
        border-color: #93c5fd;
        background: #f8fbff;
        color: #0969d8;
    }

    .icon-option.selected {
        border-color: #0969d8;
        background: #eff6ff;
        color: #0969d8;
        box-shadow: 0 0 0 1px #0969d8;
    }

    .selected-icon-preview {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #f8fafc;
        overflow-wrap: anywhere;
    }

    .selected-icon-preview i {
        font-size: 23px;
        color: #0969d8;
    }

    .selected-icon-preview span {
        min-width: 0;
        font-size: 12px;
        overflow-wrap: anywhere;
    }

    /* RESPONSIVE TABLET */
    @media (max-width: 768px) {
        .detail-content-tabs {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .detail-content-tab {
            justify-content: flex-start;
            padding: 10px;
            font-size: 13px;
        }

        .icon-picker-options {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .current-image img {
            max-width: 100%;
        }
    }

    /* RESPONSIVE HP */
    @media (max-width: 480px) {
        .category-detail-page .page-title {
            font-size: 23px;
            line-height: 1.35;
            overflow-wrap: anywhere;
        }

        .category-detail-page .page-description {
            font-size: 13px;
            line-height: 1.6;
        }

        .detail-content-tabs {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 7px;
            margin: 16px 0;
        }

        .detail-content-tab {
            min-height: 44px;
            padding: 9px;
            gap: 6px;
            font-size: 12px;
        }

        .detail-section-card {
            padding: 16px;
        }

        .detail-section-card .cms-card-heading {
            align-items: flex-start;
            gap: 10px;
        }

        .detail-section-card .cms-card-heading h3 {
            font-size: 17px;
            line-height: 1.4;
            overflow-wrap: anywhere;
        }

        .detail-section-card .cms-card-heading p {
            font-size: 12px;
            line-height: 1.6;
        }

        .detail-form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .detail-form-actions .primary-button,
        .detail-form-actions .secondary-button {
            width: 100%;
            justify-content: center;
            text-align: center;
        }

        .icon-picker-options {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .current-image {
            padding: 10px;
        }

        .cms-form-group input,
        .cms-form-group textarea {
            max-width: 100%;
        }
    }
</style>
@endpush

@section('content')

<div class="category-detail-page">

    {{-- INTRO --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">{{ $category->name }}</h1>

        <p class="page-description">
            Kelola konten halaman detail kategori {{ $category->name }}.
        </p>
    </section>

    {{-- VALIDASI --}}
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

    {{-- INFORMASI KATEGORI --}}
    <section class="cms-card category-info-card">
        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-folder2-open"></i>
            </div>

            <div>
                <h3>{{ $category->name }}</h3>
                <p>
                    Pilih bagian konten yang ingin kamu edit melalui menu di bawah.
                </p>
            </div>
        </div>
    </section>

    {{-- MENU TAB --}}
    <div
        class="detail-content-tabs"
        role="tablist"
        aria-label="Bagian konten kategori"
    >
        <button
            type="button"
            class="detail-content-tab active"
            id="tab-hero"
            data-target="section-hero"
            role="tab"
            aria-controls="section-hero"
            aria-selected="true"
        >
            <i class="bi bi-image"></i>
            <span>Hero</span>
        </button>

        <button
            type="button"
            class="detail-content-tab"
            id="tab-about"
            data-target="section-about"
            role="tab"
            aria-controls="section-about"
            aria-selected="false"
        >
            <i class="bi bi-info-circle"></i>
            <span>Tentang Kategori</span>
        </button>

        <button
            type="button"
            class="detail-content-tab"
            id="tab-advantages"
            data-target="section-advantages"
            role="tab"
            aria-controls="section-advantages"
            aria-selected="false"
        >
            <i class="bi bi-stars"></i>
            <span>Keunggulan</span>
        </button>

        <button
            type="button"
            class="detail-content-tab"
            id="tab-cta"
            data-target="section-cta"
            role="tab"
            aria-controls="section-cta"
            aria-selected="false"
        >
            <i class="bi bi-megaphone"></i>
            <span>CTA</span>
        </button>
    </div>

    {{-- FORM CMS --}}
    <form
        id="category-detail-form"
        action="{{ route('admin.produk-layanan.category-details.update', $category) }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        {{-- TAB 1: HERO --}}
        <section
            id="section-hero"
            class="cms-card detail-section-card detail-tab-panel active"
            role="tabpanel"
            aria-labelledby="tab-hero"
        >
            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-image"></i>
                </div>

                <div>
                    <h3>Hero</h3>
                    <p>Atur judul, deskripsi, dan gambar utama halaman kategori.</p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="hero_label">Label Hero</label>

                <input
                    type="text"
                    id="hero_label"
                    name="hero_label"
                    class="cms-input"
                    value="{{ old('hero_label', $detail?->hero_label) }}"
                    maxlength="255"
                    placeholder="Contoh: PRODUK & TEKNOLOGI"
                >

                @error('hero_label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="hero_title">Judul Hero</label>

                <input
                    type="text"
                    id="hero_title"
                    name="hero_title"
                    class="cms-input"
                    value="{{ old('hero_title', $detail?->hero_title) }}"
                    maxlength="255"
                    placeholder="Masukkan judul kategori"
                >

                @error('hero_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="hero_description">Deskripsi Hero</label>

                <textarea
                    id="hero_description"
                    name="hero_description"
                    class="cms-input cms-textarea"
                    rows="5"
                    placeholder="Masukkan deskripsi kategori..."
                >{{ old('hero_description', $detail?->hero_description) }}</textarea>

                @error('hero_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            @include('admin.produk-layanan.category-details.partials.image-field', [
                'field' => 'hero_image',
                'label' => 'Gambar Hero',
                'currentImage' => $detail?->hero_image ?: $category->image,
            ])

            <div class="cms-form-actions detail-form-actions">
                <a
                    href="{{ route('admin.produk-layanan.categories.index') }}"
                    class="secondary-button"
                >
                    Batal
                </a>

                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>
            </div>
        </section>

        {{-- TAB 2: TENTANG KATEGORI --}}
        <section
            id="section-about"
            class="cms-card detail-section-card detail-tab-panel"
            role="tabpanel"
            aria-labelledby="tab-about"
            hidden
        >
            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div>
                    <h3>Tentang Kategori</h3>
                    <p>Atur informasi dan poin penjelas kategori produk.</p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="about_title">Judul Bagian</label>

                <input
                    type="text"
                    id="about_title"
                    name="about_title"
                    class="cms-input"
                    value="{{ old('about_title', $detail?->about_title) }}"
                    maxlength="255"
                    placeholder="Masukkan judul bagian"
                >

                @error('about_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="about_description">Deskripsi</label>

                <textarea
                    id="about_description"
                    name="about_description"
                    class="cms-input cms-textarea"
                    rows="5"
                    placeholder="Jelaskan kategori produk..."
                >{{ old('about_description', $detail?->about_description) }}</textarea>

                @error('about_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            @include('admin.produk-layanan.category-details.partials.image-field', [
                'field' => 'about_image',
                'label' => 'Gambar Tentang Kategori',
                'currentImage' => $detail?->about_image,
            ])

            <div class="detail-subheading">
                <h4>Poin Informasi 1</h4>
            </div>

            <div class="cms-form-group">
                <label for="about_highlight_1_title">Judul Poin 1</label>

                <input
                    type="text"
                    id="about_highlight_1_title"
                    name="about_highlight_1_title"
                    class="cms-input"
                    value="{{ old('about_highlight_1_title', $detail?->about_highlight_1_title) }}"
                    maxlength="255"
                >

                @error('about_highlight_1_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="about_highlight_1_description">Deskripsi Poin 1</label>

                <textarea
                    id="about_highlight_1_description"
                    name="about_highlight_1_description"
                    class="cms-input cms-textarea"
                    rows="3"
                >{{ old('about_highlight_1_description', $detail?->about_highlight_1_description) }}</textarea>

                @error('about_highlight_1_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="detail-subheading">
                <h4>Poin Informasi 2</h4>
            </div>

            <div class="cms-form-group">
                <label for="about_highlight_2_title">Judul Poin 2</label>

                <input
                    type="text"
                    id="about_highlight_2_title"
                    name="about_highlight_2_title"
                    class="cms-input"
                    value="{{ old('about_highlight_2_title', $detail?->about_highlight_2_title) }}"
                    maxlength="255"
                >

                @error('about_highlight_2_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="about_highlight_2_description">Deskripsi Poin 2</label>

                <textarea
                    id="about_highlight_2_description"
                    name="about_highlight_2_description"
                    class="cms-input cms-textarea"
                    rows="3"
                >{{ old('about_highlight_2_description', $detail?->about_highlight_2_description) }}</textarea>

                @error('about_highlight_2_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-actions detail-form-actions">
                <a href="{{ route('admin.produk-layanan.categories.index') }}" class="secondary-button">
                    Batal
                </a>

                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>
            </div>
        </section>

        {{-- TAB 3: KEUNGGULAN --}}
        <section
            id="section-advantages"
            class="cms-card detail-section-card detail-tab-panel"
            role="tabpanel"
            aria-labelledby="tab-advantages"
            hidden
        >
            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-stars"></i>
                </div>

                <div>
                    <h3>Keunggulan</h3>
                    <p>Atur judul bagian dan tiga keunggulan kategori produk.</p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="advantages_title">Judul Bagian</label>

                <input
                    type="text"
                    id="advantages_title"
                    name="advantages_title"
                    class="cms-input"
                    value="{{ old('advantages_title', $detail?->advantages_title) }}"
                    maxlength="255"
                >

                @error('advantages_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="advantages_description">Deskripsi Bagian</label>

                <textarea
                    id="advantages_description"
                    name="advantages_description"
                    class="cms-input cms-textarea"
                    rows="3"
                >{{ old('advantages_description', $detail?->advantages_description) }}</textarea>

                @error('advantages_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            @php
                $availableIcons = [
                    'bi bi-shield-check' => 'Perlindungan',
                    'bi bi-check-circle' => 'Centang',
                    'bi bi-star' => 'Bintang',
                    'bi bi-award' => 'Penghargaan',
                    'bi bi-gear' => 'Pengaturan',
                    'bi bi-lightning-charge' => 'Kecepatan',
                    'bi bi-tools' => 'Peralatan',
                    'bi bi-headset' => 'Dukungan',
                    'bi bi-truck' => 'Pengiriman',
                    'bi bi-box-seam' => 'Produk',
                    'bi bi-heart' => 'Kualitas',
                    'bi bi-hand-thumbs-up' => 'Kepuasan',
                    'bi bi-clock' => 'Waktu',
                    'bi bi-currency-dollar' => 'Harga',
                    'bi bi-patch-check' => 'Terpercaya',
                    'bi bi-wrench-adjustable' => 'Teknis',
                    'bi bi-buildings' => 'Perusahaan',
                    'bi bi-people' => 'Tim',
                ];
            @endphp

            @for ($i = 1; $i <= 3; $i++)
                @php
                    $titleField = 'advantage_' . $i . '_title';
                    $descriptionField = 'advantage_' . $i . '_description';
                    $iconField = 'advantage_' . $i . '_icon';

                    $selectedIcon = old(
                        $iconField,
                        $detail?->{$iconField} ?: 'bi bi-check-circle'
                    );
                @endphp

                <div class="detail-subheading">
                    <h4>Keunggulan {{ $i }}</h4>
                </div>

                <div class="cms-form-group">
                    <label for="{{ $titleField }}">Judul Keunggulan {{ $i }}</label>

                    <input
                        type="text"
                        id="{{ $titleField }}"
                        name="{{ $titleField }}"
                        class="cms-input"
                        value="{{ old($titleField, $detail?->{$titleField}) }}"
                        maxlength="255"
                    >

                    @error($titleField)
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="cms-form-group">
                    <label for="{{ $descriptionField }}">Deskripsi Keunggulan {{ $i }}</label>

                    <textarea
                        id="{{ $descriptionField }}"
                        name="{{ $descriptionField }}"
                        class="cms-input cms-textarea"
                        rows="3"
                    >{{ old($descriptionField, $detail?->{$descriptionField}) }}</textarea>

                    @error($descriptionField)
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>

                <div class="cms-form-group">
                    <label for="{{ $iconField }}">Ikon Keunggulan {{ $i }}</label>

                    <input
                        type="hidden"
                        id="{{ $iconField }}"
                        name="{{ $iconField }}"
                        value="{{ $selectedIcon }}"
                    >

                    <div class="icon-picker" data-icon-picker="{{ $iconField }}">
                        <span class="icon-picker-label">
                            Pilih ikon yang sesuai
                        </span>

                        <div class="icon-picker-options">
                            @foreach ($availableIcons as $iconClass => $iconLabel)
                                <button
                                    type="button"
                                    class="icon-option {{ $selectedIcon === $iconClass ? 'selected' : '' }}"
                                    data-icon-value="{{ $iconClass }}"
                                    aria-pressed="{{ $selectedIcon === $iconClass ? 'true' : 'false' }}"
                                    title="{{ $iconLabel }}"
                                >
                                    <i class="{{ $iconClass }}"></i>
                                    <span>{{ $iconLabel }}</span>
                                </button>
                            @endforeach
                        </div>

                        <div class="selected-icon-preview">
                            <i class="{{ $selectedIcon }}" data-icon-preview></i>
                            <span>
                                Ikon dipilih:
                                <strong data-icon-name>{{ $selectedIcon }}</strong>
                            </span>
                        </div>
                    </div>

                    @error($iconField)
                        <small class="field-error">{{ $message }}</small>
                    @enderror

                    <small class="field-hint">
                        Pilihan ikon akan disimpan menggunakan field yang sama seperti sebelumnya.
                    </small>
                </div>
            @endfor

            <div class="cms-form-actions detail-form-actions">
                <a href="{{ route('admin.produk-layanan.categories.index') }}" class="secondary-button">
                    Batal
                </a>

                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>
            </div>
        </section>

        {{-- TAB 4: CTA --}}
        <section
            id="section-cta"
            class="cms-card detail-section-card detail-tab-panel"
            role="tabpanel"
            aria-labelledby="tab-cta"
            hidden
        >
            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-megaphone"></i>
                </div>

                <div>
                    <h3>Call to Action (CTA)</h3>
                    <p>Atur ajakan dan tombol di bagian akhir halaman.</p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="cta_title">Judul CTA</label>

                <input
                    type="text"
                    id="cta_title"
                    name="cta_title"
                    class="cms-input"
                    value="{{ old('cta_title', $detail?->cta_title) }}"
                    maxlength="255"
                >

                @error('cta_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="cta_description">Deskripsi CTA</label>

                <textarea
                    id="cta_description"
                    name="cta_description"
                    class="cms-input cms-textarea"
                    rows="4"
                >{{ old('cta_description', $detail?->cta_description) }}</textarea>

                @error('cta_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="cta_button_text">Teks Tombol</label>

                <input
                    type="text"
                    id="cta_button_text"
                    name="cta_button_text"
                    class="cms-input"
                    value="{{ old('cta_button_text', $detail?->cta_button_text) }}"
                    maxlength="100"
                    placeholder="Contoh: Hubungi Kami"
                >

                @error('cta_button_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="cta_button_link">Link Tombol</label>

                <input
                    type="text"
                    id="cta_button_link"
                    name="cta_button_link"
                    class="cms-input"
                    value="{{ old('cta_button_link', $detail?->cta_button_link) }}"
                    maxlength="255"
                    placeholder="Contoh: /kontak atau #kontak"
                >

                @error('cta_button_link')
                    <small class="field-error">{{ $message }}</small>
                @enderror

                <small class="field-hint">
                    Masukkan URL lokal, URL HTTPS, atau anchor seperti #kontak.
                </small>
            </div>

            @include('admin.produk-layanan.category-details.partials.image-field', [
                'field' => 'cta_image',
                'label' => 'Gambar CTA',
                'currentImage' => $detail?->cta_image,
            ])

            <div class="cms-form-actions detail-form-actions">
                <a href="{{ route('admin.produk-layanan.categories.index') }}" class="secondary-button">
                    Batal
                </a>

                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>
            </div>
        </section>

    </form>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.detail-content-tab');
    const panels = document.querySelectorAll('.detail-tab-panel');

    function activateTab(tab) {
        if (!tab) return;

        const targetId = tab.dataset.target;

        tabs.forEach(function (item) {
            const active = item === tab;

            item.classList.toggle('active', active);
            item.setAttribute('aria-selected', active ? 'true' : 'false');
            item.setAttribute('tabindex', active ? '0' : '-1');
        });

        panels.forEach(function (panel) {
            const active = panel.id === targetId;

            panel.classList.toggle('active', active);
            panel.hidden = !active;
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activateTab(tab);
        });

        tab.addEventListener('keydown', function (event) {
            if (!['ArrowLeft', 'ArrowRight'].includes(event.key)) return;

            event.preventDefault();

            const tabList = Array.from(tabs);
            const currentIndex = tabList.indexOf(tab);
            const direction = event.key === 'ArrowRight' ? 1 : -1;
            const nextIndex = (currentIndex + direction + tabList.length) % tabList.length;

            tabList[nextIndex].focus();
            activateTab(tabList[nextIndex]);
        });
    });

    // Buka tab yang berisi error validasi.
    const firstError = document.querySelector(
        '.field-error, .cms-alert-error'
    );

    if (firstError) {
        const panel = firstError.closest('.detail-tab-panel');

        if (panel) {
            const matchingTab = document.querySelector(
                '.detail-content-tab[data-target="' + panel.id + '"]'
            );

            if (matchingTab) {
                activateTab(matchingTab);
            }
        }
    }

    // Pemilih Bootstrap Icons.
    document.querySelectorAll('[data-icon-picker]').forEach(function (picker) {
        const fieldName = picker.dataset.iconPicker;
        const input = document.getElementById(fieldName);
        const options = picker.querySelectorAll('[data-icon-value]');
        const preview = picker.querySelector('[data-icon-preview]');
        const nameLabel = picker.querySelector('[data-icon-name]');

        if (!input || !preview || !nameLabel) return;

        function selectIcon(button) {
            const iconClass = button.dataset.iconValue;

            input.value = iconClass;
            preview.className = iconClass;
            nameLabel.textContent = iconClass;

            options.forEach(function (option) {
                const selected = option === button;

                option.classList.toggle('selected', selected);
                option.setAttribute('aria-pressed', selected ? 'true' : 'false');
            });
        }

        options.forEach(function (button) {
            button.addEventListener('click', function () {
                selectIcon(button);
            });
        });

        // Tetap tampilkan nilai yang sudah tersimpan.
        const currentOption = Array.from(options).find(function (button) {
            return button.dataset.iconValue === input.value;
        });

        if (currentOption) {
            selectIcon(currentOption);
        }
    });
});
</script>
@endpush
