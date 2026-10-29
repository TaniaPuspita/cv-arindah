@extends('admin.layouts.app')

@section('title', 'CMS Informasi Utama | CV Arindah')
@section('page-title', 'CMS Tentang Kami')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Informasi Utama</h1>

        <p class="page-description">
            Kelola tiga informasi utama yang ditampilkan
            pada halaman Tentang Kami CV Arindah.
        </p>
    </section>

    {{-- FORM EDIT INFORMASI UTAMA --}}
    <section class="cms-card">

        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div>
                <h3>Pengaturan Informasi Utama</h3>
                <p>Perbarui konten setiap kartu, lalu simpan perubahan.</p>
            </div>
        </div>

        <form
            action="{{ route('admin.about-page.section.update', ['section' => 'informasi']) }}"
            method="POST">

            @csrf
            @method('PUT')

            {{-- LABEL SECTION --}}
            <div class="cms-form-group">
                <label for="info_label">Label Section</label>

                <input
                    type="text"
                    id="info_label"
                    name="info_label"
                    class="cms-input"
                    value="{{ old('info_label', $aboutPage->info_label) }}"
                    maxlength="255">

                @error('info_label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL SECTION --}}
            <div class="cms-form-group">
                <label for="info_title">Judul Section</label>

                <input
                    type="text"
                    id="info_title"
                    name="info_title"
                    class="cms-input"
                    value="{{ old('info_title', $aboutPage->info_title) }}"
                    maxlength="255">

                @error('info_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- INFORMASI KARTU 1 --}}
            <div class="cms-form-group">
                <label for="info_one_title">Judul Informasi 1</label>

                <input
                    type="text"
                    id="info_one_title"
                    name="info_one_title"
                    class="cms-input"
                    value="{{ old('info_one_title', $aboutPage->info_one_title) }}"
                    maxlength="255">

                @error('info_one_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="info_one_description">Deskripsi Informasi 1</label>

                <textarea
                    id="info_one_description"
                    name="info_one_description"
                    class="cms-input cms-textarea"
                    rows="4">{{ old('info_one_description', $aboutPage->info_one_description) }}</textarea>

                @error('info_one_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- INFORMASI KARTU 2 --}}
            <div class="cms-form-group">
                <label for="info_two_title">Judul Informasi 2</label>

                <input
                    type="text"
                    id="info_two_title"
                    name="info_two_title"
                    class="cms-input"
                    value="{{ old('info_two_title', $aboutPage->info_two_title) }}"
                    maxlength="255">

                @error('info_two_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="info_two_description">Deskripsi Informasi 2</label>

                <textarea
                    id="info_two_description"
                    name="info_two_description"
                    class="cms-input cms-textarea"
                    rows="4">{{ old('info_two_description', $aboutPage->info_two_description) }}</textarea>

                @error('info_two_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- INFORMASI KARTU 3 --}}
            <div class="cms-form-group">
                <label for="info_three_title">Judul Informasi 3</label>

                <input
                    type="text"
                    id="info_three_title"
                    name="info_three_title"
                    class="cms-input"
                    value="{{ old('info_three_title', $aboutPage->info_three_title) }}"
                    maxlength="255">

                @error('info_three_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="info_three_description">Deskripsi Informasi 3</label>

                <textarea
                    id="info_three_description"
                    name="info_three_description"
                    class="cms-input cms-textarea"
                    rows="4">{{ old('info_three_description', $aboutPage->info_three_description) }}</textarea>

                @error('info_three_description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="cms-form-actions">
                <button type="submit" class="primary-button">
                    <i class="bi bi-floppy"></i>
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.about-page.section.edit', ['section' => 'informasi']) }}"
                   class="secondary-button">
                    Batal
                </a>
            </div>

        </form>
    </section>

@endsection
