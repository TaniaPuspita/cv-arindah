@extends('admin.layouts.app')

@section('title', 'Edit Visi & Misi')
@section('page-title', 'CMS Tentang Kami')

@section('content')
<div class="dashboard-intro">
    <span class="eyebrow">CMS TENTANG KAMI</span>
    <h1 class="page-title">Visi & Misi</h1>
    <p class="page-description">
        Kelola informasi visi dan misi CV Arindah yang ditampilkan
        pada halaman Tentang Kami.
    </p>
</div>

<div class="cms-card">
    <div class="cms-card-heading">
        <div class="cms-heading-icon">
            <i class="bi bi-pencil-square"></i>
        </div>

        <div>
            <h2>Form Edit Visi & Misi</h2>
            <p>Perbarui konten sesuai kebutuhan perusahaan.</p>
        </div>
    </div>

    <form
        action="{{ route('admin.about-page.section.update', ['section' => 'visi-misi']) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        {{-- LABEL SECTION --}}
        <div class="cms-form-group">
            <label for="vision_mission_label">Label Section</label>
            <input
                type="text"
                id="vision_mission_label"
                name="vision_mission_label"
                class="cms-input"
                value="{{ old('vision_mission_label', $aboutPage->vision_mission_label) }}"
                placeholder="Contoh: Visi & Misi"
            >
            @error('vision_mission_label')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- JUDUL SECTION --}}
        <div class="cms-form-group">
            <label for="vision_mission_title">Judul Section</label>
            <input
                type="text"
                id="vision_mission_title"
                name="vision_mission_title"
                class="cms-input"
                value="{{ old('vision_mission_title', $aboutPage->vision_mission_title) }}"
                placeholder="Contoh: Visi dan Misi CV Arindah"
            >
            @error('vision_mission_title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- DESKRIPSI SECTION --}}
        <div class="cms-form-group">
            <label for="vision_mission_description">
                Deskripsi Section
            </label>
            <textarea
                id="vision_mission_description"
                name="vision_mission_description"
                class="cms-textarea"
                rows="3"
                placeholder="Masukkan deskripsi singkat visi dan misi perusahaan"
            >{{ old('vision_mission_description', $aboutPage->vision_mission_description) }}</textarea>
            @error('vision_mission_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-divider"></div>

        {{-- VISI --}}
        <div class="cms-section-heading">
            <i class="bi bi-bullseye"></i>
            <h3>Konten Visi</h3>
        </div>

        <div class="cms-form-group">
            <label for="vision">Isi Visi Perusahaan</label>
            <textarea
                id="vision"
                name="vision"
                class="cms-textarea"
                rows="4"
                placeholder="Masukkan visi perusahaan"
            >{{ old('vision', $aboutPage->vision) }}</textarea>
            @error('vision')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-divider"></div>

        {{-- DESKRIPSI MISI --}}
        <div class="cms-section-heading">
            <i class="bi bi-list-check"></i>
            <h3>Konten Misi</h3>
        </div>

        <div class="cms-form-group">
            <label for="mission_description">Deskripsi Misi</label>
            <textarea
                id="mission_description"
                name="mission_description"
                class="cms-textarea"
                rows="3"
                placeholder="Masukkan deskripsi umum misi perusahaan"
            >{{ old('mission_description', $aboutPage->mission_description) }}</textarea>
            @error('mission_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- MISI 01 --}}
        <div class="cms-form-divider"></div>

        <div class="cms-section-heading">
            <span class="cms-number">01</span>
            <h3>Misi Pertama</h3>
        </div>

        <div class="cms-form-group">
            <label for="mission_one_title">Judul Misi 01</label>
            <input
                type="text"
                id="mission_one_title"
                name="mission_one_title"
                class="cms-input"
                value="{{ old('mission_one_title', $aboutPage->mission_one_title) }}"
                placeholder="Contoh: Menyediakan Beragam Produk"
            >
            @error('mission_one_title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-group">
            <label for="mission_one_description">Deskripsi Misi 01</label>
            <textarea
                id="mission_one_description"
                name="mission_one_description"
                class="cms-textarea"
                rows="3"
                placeholder="Jelaskan misi pertama perusahaan"
            >{{ old('mission_one_description', $aboutPage->mission_one_description) }}</textarea>
            @error('mission_one_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- MISI 02 --}}
        <div class="cms-form-divider"></div>

        <div class="cms-section-heading">
            <span class="cms-number">02</span>
            <h3>Misi Kedua</h3>
        </div>

        <div class="cms-form-group">
            <label for="mission_two_title">Judul Misi 02</label>
            <input
                type="text"
                id="mission_two_title"
                name="mission_two_title"
                class="cms-input"
                value="{{ old('mission_two_title', $aboutPage->mission_two_title) }}"
                placeholder="Contoh: Mendukung Kebutuhan Teknologi"
            >
            @error('mission_two_title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-group">
            <label for="mission_two_description">Deskripsi Misi 02</label>
            <textarea
                id="mission_two_description"
                name="mission_two_description"
                class="cms-textarea"
                rows="3"
                placeholder="Jelaskan misi kedua perusahaan"
            >{{ old('mission_two_description', $aboutPage->mission_two_description) }}</textarea>
            @error('mission_two_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- MISI 03 --}}
        <div class="cms-form-divider"></div>

        <div class="cms-section-heading">
            <span class="cms-number">03</span>
            <h3>Misi Ketiga</h3>
        </div>

        <div class="cms-form-group">
            <label for="mission_three_title">Judul Misi 03</label>
            <input
                type="text"
                id="mission_three_title"
                name="mission_three_title"
                class="cms-input"
                value="{{ old('mission_three_title', $aboutPage->mission_three_title) }}"
                placeholder="Contoh: Memberikan Informasi yang Jelas"
            >
            @error('mission_three_title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="cms-form-group">
            <label for="mission_three_description">
                Deskripsi Misi 03
            </label>
            <textarea
                id="mission_three_description"
                name="mission_three_description"
                class="cms-textarea"
                rows="3"
                placeholder="Jelaskan misi ketiga perusahaan"
            >{{ old('mission_three_description', $aboutPage->mission_three_description) }}</textarea>
            @error('mission_three_description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        
        {{-- TOMBOL AKSI --}}
        <div class="cms-form-actions">
            <button type="submit" class="primary-button">
                <i class="bi bi-floppy"></i>
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.about-page.section.edit', ['section' => 'visi-misi']) }}"
                class="secondary-button"
            >
                Batal
            </a>
        </div>

        </div>
    </form>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/about-page/visi-misi/edit.css') }}">
@endpush
@endsection
