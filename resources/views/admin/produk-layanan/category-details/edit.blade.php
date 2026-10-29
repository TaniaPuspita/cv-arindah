
@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
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
    </style>
@endpush

@section('title', 'CMS Detail Kategori Produk | CV Arindah')
@section('page-title', 'CMS Produk & Layanan')

@section('content')

<section class="dashboard-intro">
    <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
    <h1 class="page-title">{{ $category->name }}</h1>
    <p class="page-description">
        Kelola konten halaman detail kategori {{ $category->name }}.
    </p>
</section>

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
<div class="detail-content-tabs"
     role="tablist"
     aria-label="Bagian konten kategori">

    <button
        type="button"
        class="detail-content-tab active"
        id="tab-hero"
        data-target="section-hero"
        role="tab"
        aria-controls="section-hero"
        aria-selected="true">
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
        aria-selected="false">
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
        aria-selected="false">
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
        aria-selected="false">
        <i class="bi bi-megaphone"></i>
        <span>CTA</span>
    </button>
</div>

{{-- FORM CMS --}}
<form
    id="category-detail-form"
    action="{{ route('admin.produk-layanan.category-details.update', $category) }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- TAB 1: HERO --}}
    <section
        id="section-hero"
        class="cms-card detail-section-card detail-tab-panel active"
        role="tabpanel"
        aria-labelledby="tab-hero">

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
                placeholder="Contoh: PRODUK & TEKNOLOGI">
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
                placeholder="Contoh: Solusi Komputer & Teknologi">
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
                placeholder="Masukkan deskripsi kategori...">{{ old('hero_description', $detail?->hero_description) }}</textarea>
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
            <a href="{{ route('admin.produk-layanan.categories.index') }}"
               class="secondary-button">
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
        hidden>

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
                placeholder="Masukkan judul bagian">
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
                placeholder="Jelaskan kategori produk...">{{ old('about_description', $detail?->about_description) }}</textarea>
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
                maxlength="255">
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
                rows="3">{{ old('about_highlight_1_description', $detail?->about_highlight_1_description) }}</textarea>
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
                maxlength="255">
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
                rows="3">{{ old('about_highlight_2_description', $detail?->about_highlight_2_description) }}</textarea>
            @error('about_highlight_2_description')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-actions detail-form-actions">
            <a href="{{ route('admin.produk-layanan.categories.index') }}"
               class="secondary-button">
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
        hidden>

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
                maxlength="255">
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
                rows="3">{{ old('advantages_description', $detail?->advantages_description) }}</textarea>
            @error('advantages_description')
                <small class="field-error">{{ $message }}</small>
            @enderror
        </div>

        @for ($i = 1; $i <= 3; $i++)
            @php
                $titleField = 'advantage_' . $i . '_title';
                $descriptionField = 'advantage_' . $i . '_description';
                $iconField = 'advantage_' . $i . '_icon';
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
                    maxlength="255">
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
                    rows="3">{{ old($descriptionField, $detail?->{$descriptionField}) }}</textarea>
                @error($descriptionField)
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="{{ $iconField }}">Ikon Keunggulan {{ $i }}</label>
                <input
                    type="text"
                    id="{{ $iconField }}"
                    name="{{ $iconField }}"
                    class="cms-input"
                    value="{{ old($iconField, $detail?->{$iconField}) }}"
                    maxlength="100"
                    placeholder="Contoh: bi bi-shield-check">
                @error($iconField)
                    <small class="field-error">{{ $message }}</small>
                @enderror
                <small class="field-hint">
                    Gunakan nama ikon Bootstrap Icons, misalnya bi bi-shield-check.
                </small>
            </div>
        @endfor

        <div class="cms-form-actions detail-form-actions">
            <a href="{{ route('admin.produk-layanan.categories.index') }}"
               class="secondary-button">
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
        hidden>

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
                maxlength="255">
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
                rows="4">{{ old('cta_description', $detail?->cta_description) }}</textarea>
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
                placeholder="Contoh: Hubungi Kami">
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
                placeholder="Contoh: /kontak atau #kontak">
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
            <a href="{{ route('admin.produk-layanan.categories.index') }}"
               class="secondary-button">
                Batal
            </a>

            <button type="submit" class="primary-button">
                <i class="bi bi-floppy"></i>
                Simpan Perubahan
            </button>
        </div>
    </section>

</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.detail-content-tab');
    const panels = document.querySelectorAll('.detail-tab-panel');

    function activateTab(tab) {
        const targetId = tab.dataset.target;

        tabs.forEach(function (item) {
            const isActive = item === tab;

            item.classList.toggle('active', isActive);
            item.setAttribute(
                'aria-selected',
                isActive ? 'true' : 'false'
            );
        });

        panels.forEach(function (panel) {
            const isActive = panel.id === targetId;

            panel.classList.toggle('active', isActive);
            panel.hidden = !isActive;
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            activateTab(tab);
        });
    });

    // Buka tab yang memiliki error validasi.
    const firstError = document.querySelector('.field-error');

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
});
</script>
@endpush
