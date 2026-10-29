
@extends('admin.layouts.app')

@section('title', 'CMS Profil Perusahaan | CV Arindah')
@section('page-title', 'CMS Tentang Kami')

@section('content')

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Profil Perusahaan</h1>

        <p class="page-description">
            Kelola konten profil perusahaan yang ditampilkan
            pada halaman Tentang Kami CV Arindah.
        </p>
    </section>

    {{-- FORM EDIT PROFIL --}}
    <section class="cms-card">

        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-building"></i>
            </div>

            <div>
                <h3>Pengaturan Profil Perusahaan</h3>
                <p>Lengkapi kolom berikut, lalu simpan perubahan.</p>
            </div>
        </div>

        <form
            action="{{ route('admin.about-page.section.update', ['section' => 'profil']) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            {{-- LABEL PROFIL --}}
            <div class="cms-form-group">
                <label for="profile_label">Label Profil</label>

                <input
                    type="text"
                    id="profile_label"
                    name="profile_label"
                    class="cms-input"
                    value="{{ old('profile_label', $aboutPage->profile_label) }}"
                    maxlength="255"
                >

                @error('profile_label')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- JUDUL PROFIL --}}
            <div class="cms-form-group">
                <label for="profile_title">Judul Profil</label>

                <input
                    type="text"
                    id="profile_title"
                    name="profile_title"
                    class="cms-input"
                    value="{{ old('profile_title', $aboutPage->profile_title) }}"
                    maxlength="255"
                >

                @error('profile_title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- PARAGRAF PERTAMA --}}
            <div class="cms-form-group">
                <label for="profile_paragraph_one">Paragraf Pertama</label>

                <textarea
                    id="profile_paragraph_one"
                    name="profile_paragraph_one"
                    class="cms-input cms-textarea"
                    rows="5"
                >{{ old('profile_paragraph_one', $aboutPage->profile_paragraph_one) }}</textarea>

                @error('profile_paragraph_one')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- PARAGRAF KEDUA --}}
            <div class="cms-form-group">
                <label for="profile_paragraph_two">Paragraf Kedua</label>

                <textarea
                    id="profile_paragraph_two"
                    name="profile_paragraph_two"
                    class="cms-input cms-textarea"
                    rows="5"
                >{{ old('profile_paragraph_two', $aboutPage->profile_paragraph_two) }}</textarea>

                @error('profile_paragraph_two')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- GAMBAR PROFIL --}}
            <div class="cms-form-group">
                <label for="profile_image">Gambar Profil</label>

                @if ($aboutPage->profile_image)
                    <div class="current-image">
                        <p>Gambar yang tersimpan saat ini:</p>

                        <img
                            src="{{ asset('storage/' . $aboutPage->profile_image) }}"
                            alt="Gambar profil perusahaan saat ini"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    id="profile_image"
                    name="profile_image"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    Kosongkan jika tidak ingin mengganti gambar.
                </small>

                @error('profile_image')
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
                    href="{{ route('admin.about-page.section.edit', ['section' => 'profil']) }}"
                    class="secondary-button"
                >
                    Batal
                </a>
            </div>

        </form>
    </section>

@endsection
