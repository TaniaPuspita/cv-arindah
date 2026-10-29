@extends('admin.layouts.app')

@section('title', $sectionData['title'] . ' | CV Arindah')
@section('page-title', $sectionData['title'])

@section('content')

@php
    $fieldLabels = [
        'hero_label' => 'Label Hero',
        'hero_title' => 'Judul Hero',
        'hero_description' => 'Deskripsi Hero',
        'hero_image' => 'Gambar Hero',

        'contact_section_title' => 'Judul Informasi Kontak',
        'contact_email' => 'Alamat Email',
        'contact_phone' => 'Nomor Telepon',
        'contact_address' => 'Alamat Lengkap',

        'form_label' => 'Label Formulir',
        'form_title' => 'Judul Formulir',
        'form_description' => 'Deskripsi Formulir',
        'form_button_text' => 'Teks Tombol Kirim',

        'location_title' => 'Judul Lokasi',
        'location_address' => 'Alamat Lokasi',
        'location_note' => 'Keterangan Lokasi',
        'maps_url' => 'Link Google Maps',
        'location_image' => 'Gambar Lokasi',

        'cta_title' => 'Judul CTA',
        'cta_description' => 'Deskripsi CTA',
        'cta_phone' => 'Nomor Telepon CTA',
        'cta_image' => 'Gambar CTA',
    ];

    $longTextFields = [
        'hero_description',
        'contact_address',
        'form_description',
        'location_address',
        'location_note',
        'cta_description',
    ];

    $imageFields = [
        'hero_image',
        'location_image',
        'cta_image',
    ];

    $activeSection = $section;
@endphp

{{-- JUDUL HALAMAN --}}
<section class="dashboard-intro">
    <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

    <h1 class="page-title">{{ $sectionData['title'] }}</h1>

    <p class="page-description">
        Kelola konten {{ strtolower($sectionData['title']) }}
        yang ditampilkan pada halaman Kontak CV Arindah.
    </p>
</section>

{{-- NOTIFIKASI ERROR --}}
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>Periksa kembali isian berikut:</strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- FORM EDIT KONTEN --}}
<section class="cms-card">

    <div class="cms-card-heading">
        <div class="cms-heading-icon">
            <i class="bi bi-pencil-square"></i>
        </div>

        <div>
            <h3>
                @if($section === 'hero')
                    Pengaturan Konten Hero
                @elseif($section === 'informasi')
                    Pengaturan Informasi Kontak
                @elseif($section === 'formulir')
                    Pengaturan Formulir Kirim Pesan
                @elseif($section === 'lokasi')
                    Pengaturan Lokasi Kami
                @else
                    Pengaturan CTA Kontak
                @endif
            </h3>

            <p>
                @if($section === 'formulir')
                    Atur teks yang ditampilkan pada formulir di halaman Kontak.
                @else
                    Lengkapi kolom berikut, lalu simpan perubahan.
                @endif
            </p>
        </div>
    </div>

    {{-- BAGIAN FORMULIR KIRIM PESAN --}}
    @if($section === 'formulir')

        <div class="p-4">

            <div class="alert alert-info mb-4">
                <i class="bi bi-info-circle me-2"></i>
                Pengaturan ini digunakan untuk mengubah teks formulir
                yang tampil pada halaman Kontak. Kolom pesan pengunjung
                dan proses pengiriman pesan tetap menggunakan fungsi
                yang sudah tersedia.
            </div>

            {{-- FORM PENGATURAN FORMULIR --}}
            <form
                action="{{ route('admin.contact-page.section.update', $section) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                @foreach($sectionData['fields'] as $field)

                    @php
                        $label = $fieldLabels[$field]
                            ?? ucwords(str_replace('_', ' ', $field));

                        $value = old(
                            $field,
                            $contactPage->{$field} ?? ''
                        );

                        $isLongText = in_array(
                            $field,
                            $longTextFields,
                            true
                        );
                    @endphp

                    <div class="cms-form-group">

                        <label for="{{ $field }}">
                            {{ $label }}
                        </label>

                        @if($isLongText)

                            <textarea
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="cms-input cms-textarea"
                                rows="5"
                                placeholder="Masukkan {{ strtolower($label) }}"
                            >{{ $value }}</textarea>

                        @else

                            <input
                                type="text"
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="cms-input"
                                value="{{ $value }}"
                                maxlength="255"
                                placeholder="Masukkan {{ strtolower($label) }}"
                            >

                        @endif

                        @error($field)
                            <small class="field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                @endforeach

                {{-- TOMBOL SIMPAN --}}
                <div class="cms-form-actions">

                    <button type="submit" class="primary-button">
                        <i class="bi bi-floppy me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('dashboard') }}"
                        class="secondary-button text-decoration-none"
                    >
                        Batal
                    </a>

                </div>

            </form>

            {{-- PEMISAH --}}
            <hr class="my-4">

            {{-- PENGELOLAAN PESAN PENGUNJUNG --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                <div>
                    <h5 class="mb-1">
                        <i class="bi bi-inbox me-2"></i>
                        Pengelolaan Pesan Pengunjung
                    </h5>

                    <p class="text-muted mb-0">
                        Lihat dan kelola pesan yang dikirim pengunjung
                        melalui formulir pada halaman Kontak.
                    </p>
                </div>

                <a
                    href="{{ route('admin.contact-messages.index') }}"
                    class="primary-button text-decoration-none"
                >
                    <i class="bi bi-envelope-open me-1"></i>
                    Buka Pesan Masuk
                </a>

            </div>

        </div>

    @else

        {{-- FORM UNTUK BAGIAN LAIN --}}
        <form
            action="{{ route('admin.contact-page.section.update', $section) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="p-4">

                @foreach($sectionData['fields'] as $field)

                    @php
                        $label = $fieldLabels[$field]
                            ?? ucwords(str_replace('_', ' ', $field));

                        $value = old(
                            $field,
                            $contactPage->{$field} ?? ''
                        );

                        $isImage = in_array(
                            $field,
                            $imageFields,
                            true
                        );

                        $isLongText = in_array(
                            $field,
                            $longTextFields,
                            true
                        );

                        $isEmail = $field === 'contact_email';
                        $isUrl = $field === 'maps_url';

                        $isPhone = in_array(
                            $field,
                            ['contact_phone', 'cta_phone'],
                            true
                        );
                    @endphp

                    <div class="cms-form-group">

                        <label for="{{ $field }}">
                            {{ $label }}
                        </label>

                        @if($isImage)

                            {{-- GAMBAR YANG TERSIMPAN --}}
                            @if($contactPage->{$field})
                                <div class="current-image mb-3">

                                    <p>Gambar yang tersimpan saat ini:</p>

                                    <img
                                        src="{{ asset('storage/' . $contactPage->{$field}) }}"
                                        alt="{{ $label }}"
                                        style="max-width: 100%; width: 320px; max-height: 220px; object-fit: cover; border-radius: 10px;"
                                    >

                                </div>
                            @endif

                            <input
                                type="file"
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="cms-input cms-file"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small class="field-hint">
                                Format JPG, JPEG, PNG, atau WEBP.
                                Maksimal 5 MB. Kosongkan jika tidak ingin
                                mengganti gambar.
                            </small>

                        @elseif($isLongText)

                            <textarea
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="cms-input cms-textarea"
                                rows="5"
                            >{{ $value }}</textarea>

                        @else

                            <input
                                type="{{ $isEmail ? 'email' : ($isPhone ? 'tel' : 'text') }}"
                                id="{{ $field }}"
                                name="{{ $field }}"
                                class="cms-input"
                                value="{{ $value }}"
                                @if($isUrl)
                                    maxlength="2000"
                                    placeholder="https://www.google.com/maps/..."
                                @else
                                    maxlength="255"
                                @endif
                            >

                        @endif

                        @error($field)
                            <small class="field-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                @endforeach

                {{-- TOMBOL AKSI --}}
                <div class="cms-form-actions">

                    <button type="submit" class="primary-button">
                        <i class="bi bi-floppy me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('dashboard') }}"
                        class="secondary-button text-decoration-none"
                    >
                        Batal
                    </a>

                </div>

            </div>
        </form>

    @endif

</section>

@endsection