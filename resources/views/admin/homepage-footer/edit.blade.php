
{{-- =========================================================
    CMS FOOTER - CV ARINDAH
    File: resources/views/admin/homepage-footer/edit.blade.php
========================================================= --}}

@extends('admin.layouts.app')

@section('title', 'CMS Footer | CV Arindah')
@section('page-title', 'CMS Footer')

@section('content')

    @php
        $defaultTags = ['Teknologi', 'Produk', 'Solusi'];

        $defaultNavigation = [
            ['route' => 'home', 'label' => 'Beranda'],
            ['route' => 'tentang', 'label' => 'Tentang Kami'],
            ['route' => 'produk', 'label' => 'Produk & Layanan'],
            ['route' => 'galeri', 'label' => 'Galeri'],
            ['route' => 'kontak', 'label' => 'Kontak'],
        ];

        $tags = old('tags', $footer->tags ?? $defaultTags);
        $navigation = old('navigation', $footer->navigation ?? $defaultNavigation);

        $tags = is_array($tags) ? array_values($tags) : $defaultTags;
        $navigation = is_array($navigation) ? array_values($navigation) : $defaultNavigation;

        $tags = array_pad($tags, 3, '');
        $navigation = array_pad($navigation, 5, ['route' => 'home', 'label' => '']);
    @endphp

    {{-- JUDUL HALAMAN --}}
    <section class="dashboard-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">CMS Footer</h1>

        <p class="page-description">
            Kelola informasi perusahaan, navigasi, dan kontak yang
            ditampilkan pada footer seluruh halaman website CV Arindah.
        </p>
    </section>

    @if (session('error'))
        <div class="cms-alert cms-alert-error" role="alert">
            {{ session('error') }}
        </div>
    @endif

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

    <form
        action="{{ route('admin.homepage-footer.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf
        @method('PUT')

        {{-- =====================================================
             CARD 1: INFORMASI PERUSAHAAN
        ====================================================== --}}
        <section class="cms-card">

            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-building"></i>
                </div>

                <div>
                    <h3>Informasi Perusahaan</h3>
                    <p>
                        Atur identitas dan deskripsi perusahaan pada footer.
                    </p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="company_name">Nama Perusahaan</label>

                <input
                    type="text"
                    id="company_name"
                    name="company_name"
                    class="cms-input"
                    value="{{ old('company_name', $footer->company_name) }}"
                    maxlength="255"
                    required
                >

                @error('company_name')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="description">Deskripsi Footer</label>

                <textarea
                    id="description"
                    name="description"
                    class="cms-input cms-textarea"
                    rows="4"
                    maxlength="5000"
                >{{ old('description', $footer->description) }}</textarea>

                <small class="field-hint">
                    Deskripsi singkat yang menjelaskan perusahaan.
                </small>

                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="logo">Logo Perusahaan</label>

                @if ($footer->logo)
                    <div class="current-image">
                        <p>Logo yang tersimpan saat ini:</p>

                        <img
                            src="{{ asset('storage/' . $footer->logo) }}"
                            alt="Logo {{ $footer->company_name }}"
                            style="max-width: 180px; max-height: 120px; object-fit: contain;"
                        >
                    </div>
                @else
                    <div class="current-image">
                        <p>
                            Belum ada logo yang diunggah.
                            Logo bawaan website akan digunakan.
                        </p>
                    </div>
                @endif

                <input
                    type="file"
                    id="logo"
                    name="logo"
                    class="cms-input cms-file"
                    accept=".jpg,.jpeg,.png,.webp"
                >

                <small class="field-hint">
                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    Kosongkan jika tidak ingin mengganti logo.
                </small>

                @error('logo')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

        </section>

        {{-- =====================================================
             CARD 2: TAG FOOTER
        ====================================================== --}}
        <section class="cms-card">

            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <div>
                    <h3>Tag Footer</h3>
                    <p>
                        Atur tag singkat yang ditampilkan di bawah deskripsi.
                    </p>
                </div>
            </div>

            @for ($i = 0; $i < 3; $i++)
                <div class="cms-form-group">
                    <label for="tag_{{ $i }}">
                        Tag {{ $i + 1 }}
                    </label>

                    <input
                        type="text"
                        id="tag_{{ $i }}"
                        name="tags[]"
                        class="cms-input"
                        value="{{ $tags[$i] ?? '' }}"
                        maxlength="100"
                        placeholder="Contoh: Teknologi"
                    >

                    @error('tags.' . $i)
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            @endfor

        </section>

        {{-- =====================================================
             CARD 3: INFORMASI KONTAK
        ====================================================== --}}
        <section class="cms-card">

            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-telephone"></i>
                </div>

                <div>
                    <h3>Informasi Kontak</h3>
                    <p>
                        Informasi telepon, email, dan alamat perusahaan.
                    </p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="phone">Nomor Telepon</label>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    class="cms-input"
                    value="{{ old('phone', $footer->phone) }}"
                    maxlength="50"
                    placeholder="+62 851-0082-1243"
                >

                @error('phone')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="email">Email Perusahaan</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="cms-input"
                    value="{{ old('email', $footer->email) }}"
                    maxlength="255"
                    placeholder="nama@email.com"
                >

                @error('email')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="address">Alamat Perusahaan</label>

                <textarea
                    id="address"
                    name="address"
                    class="cms-input cms-textarea"
                    rows="3"
                >{{ old('address', $footer->address) }}</textarea>

                @error('address')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

        </section>

        {{-- =====================================================
             CARD 4: NAVIGASI FOOTER
        ====================================================== --}}
        <section class="cms-card">

            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-list"></i>
                </div>

                <div>
                    <h3>Navigasi Footer</h3>
                    <p>
                        Atur label menu dan tujuan halaman pada footer.
                    </p>
                </div>
            </div>

            @php
                $availableRoutes = [
                    'home' => 'Beranda',
                    'tentang' => 'Tentang Kami',
                    'produk' => 'Produk & Layanan',
                    'galeri' => 'Galeri',
                    'kontak' => 'Kontak',
                ];
            @endphp

            @for ($i = 0; $i < 5; $i++)
                <div class="cms-form-group">
                    <label for="navigation_label_{{ $i }}">
                        Label Menu {{ $i + 1 }}
                    </label>

                    <input
                        type="text"
                        id="navigation_label_{{ $i }}"
                        name="navigation[{{ $i }}][label]"
                        class="cms-input"
                        value="{{ old("navigation.$i.label", $navigation[$i]['label'] ?? '') }}"
                        maxlength="100"
                        required
                    >

                    @error("navigation.$i.label")
                        <small class="field-error">{{ $message }}</small>
                    @enderror

                    <label for="navigation_route_{{ $i }}" style="margin-top: 12px;">
                        Tujuan Menu {{ $i + 1 }}
                    </label>

                    <select
                        id="navigation_route_{{ $i }}"
                        name="navigation[{{ $i }}][route]"
                        class="cms-input"
                        required
                    >
                        @foreach ($availableRoutes as $routeName => $routeLabel)
                            <option
                                value="{{ $routeName }}"
                                @selected(old("navigation.$i.route", $navigation[$i]['route'] ?? 'home') === $routeName)
                            >
                                {{ $routeLabel }}
                            </option>
                        @endforeach
                    </select>

                    @error("navigation.$i.route")
                        <small class="field-error">{{ $message }}</small>
                    @enderror
                </div>
            @endfor

        </section>

        {{-- =====================================================
             CARD 5: COPYRIGHT DAN LOKASI
        ====================================================== --}}
        <section class="cms-card">

            <div class="cms-card-heading">
                <div class="cms-heading-icon">
                    <i class="bi bi-c-circle"></i>
                </div>

                <div>
                    <h3>Copyright dan Lokasi</h3>
                    <p>
                        Atur teks copyright dan informasi lokasi pada footer.
                    </p>
                </div>
            </div>

            <div class="cms-form-group">
                <label for="copyright_text">Teks Copyright</label>

                <input
                    type="text"
                    id="copyright_text"
                    name="copyright_text"
                    class="cms-input"
                    value="{{ old('copyright_text', $footer->copyright_text) }}"
                    maxlength="255"
                    placeholder="CV Arindah. All rights reserved."
                >

                <small class="field-hint">
                    Tahun akan ditampilkan otomatis oleh website.
                </small>

                @error('copyright_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="location_text">Teks Lokasi</label>

                <input
                    type="text"
                    id="location_text"
                    name="location_text"
                    class="cms-input"
                    value="{{ old('location_text', $footer->location_text) }}"
                    maxlength="255"
                    placeholder="Badung, Bali, Indonesia"
                >

                @error('location_text')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

        </section>

        {{-- TOMBOL AKSI --}}
        <div class="cms-form-actions">
            <button type="submit" class="primary-button">
                <i class="bi bi-floppy"></i>
                Simpan Perubahan
            </button>

            <a href="{{ route('dashboard') }}" class="secondary-button">
                Batal
            </a>
        </div>

    </form>

@endsection
