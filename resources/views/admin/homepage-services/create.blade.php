
@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')
@section('page-title', 'Tambah Layanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        .service-icon-label {
            display: block;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .service-icon-radio {
            position: absolute;
            opacity: 0;
            width: 1px;
            height: 1px;
            pointer-events: none;
        }

        .service-icon-option {
            display: flex;
            min-height: 132px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #DEE2E6 !important;
            border-radius: 10px;
            padding: 16px 12px;
            background: #FFFFFF;
            transition:
                border-color .2s ease,
                background-color .2s ease,
                box-shadow .2s ease;
        }

        .service-icon-option > i {
            font-size: 1.8rem;
            color: #0969D8;
        }

        /* Hanya ikon yang dipilih yang memiliki latar biru */
        .service-icon-radio:checked + .service-icon-option {
            border: 2px solid #0969D8 !important;
            background: #F0F7FF;
        }

        .service-icon-radio:focus-visible + .service-icon-option {
            outline: 2px solid rgba(9, 105, 216, .25);
            outline-offset: 3px;
        }

        .service-icon-option:hover {
            border-color: #0969D8 !important;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER HALAMAN --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Tambah Layanan</h1>
            <p class="pc-subtitle">
                Tambahkan informasi layanan yang akan ditampilkan pada halaman beranda CV Arindah.
            </p>
        </div>

        <a href="{{ route('admin.homepage-services.index') }}"
           class="btn btn-outline-secondary rounded-3 px-3 py-2">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-4">
            <div class="fw-semibold mb-2">
                Ada data yang perlu diperiksa:
            </div>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="pc-table-card">

        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Informasi Layanan</h2>
                <p class="pc-table-description">
                    Lengkapi nama, deskripsi, ikon, dan pengaturan tampilan layanan.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.homepage-services.store') }}"
            method="POST"
            class="p-4"
        >
            @csrf

            {{-- NAMA LAYANAN --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">
                    Nama Layanan <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Pengadaan Perangkat Komputer & Jaringan"
                    maxlength="150"
                    required
                >

                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-4">
                <label for="description" class="form-label fw-semibold">
                    Deskripsi Layanan <span class="text-danger">*</span>
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="form-control rounded-3 @error('description') is-invalid @enderror"
                    placeholder="Jelaskan layanan yang disediakan oleh CV Arindah..."
                    required
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PILIH IKON --}}
            <div class="mb-4" id="service-icon-picker">
                <label class="form-label fw-semibold">
                    Pilih Ikon Layanan <span class="text-danger">*</span>
                </label>

                <p class="form-text mt-0 mb-3">
                    Klik salah satu ikon yang sesuai dengan layanan.
                </p>

                @php
                    $icons = [
                        'bi bi-laptop' => [
                            'label' => 'Komputer',
                            'symbol' => 'bi-laptop',
                        ],
                        'bi bi-gear' => [
                            'label' => 'Teknologi',
                            'symbol' => 'bi-gear',
                        ],
                        'bi bi-check-circle' => [
                            'label' => 'Solusi',
                            'symbol' => 'bi-check-circle',
                        ],
                        'bi bi-tools' => [
                            'label' => 'Perawatan',
                            'symbol' => 'bi-tools',
                        ],
                        'bi bi-diagram-3' => [
                            'label' => 'Jaringan',
                            'symbol' => 'bi-diagram-3',
                        ],
                        'bi bi-briefcase' => [
                            'label' => 'Bisnis',
                            'symbol' => 'bi-briefcase',
                        ],
                        'bi bi-pc-display' => [
                            'label' => 'PC Desktop',
                            'symbol' => 'bi-pc-display',
                        ],
                        'bi bi-printer' => [
                            'label' => 'Printer',
                            'symbol' => 'bi-printer',
                        ],
                        'bi bi-router' => [
                            'label' => 'Router',
                            'symbol' => 'bi-router',
                        ],
                        'bi bi-hdd-network' => [
                            'label' => 'Server',
                            'symbol' => 'bi-hdd-network',
                        ],
                        'bi bi-shield-check' => [
                            'label' => 'Keamanan',
                            'symbol' => 'bi-shield-check',
                        ],
                        'bi bi-cloud' => [
                            'label' => 'Cloud',
                            'symbol' => 'bi-cloud',
                        ],
                        'bi bi-code-slash' => [
                            'label' => 'Pemrograman',
                            'symbol' => 'bi-code-slash',
                        ],
                        'bi bi-database' => [
                            'label' => 'Database',
                            'symbol' => 'bi-database',
                        ],
                        'bi bi-headset' => [
                            'label' => 'Dukungan',
                            'symbol' => 'bi-headset',
                        ],
                        'bi bi-wrench-adjustable' => [
                            'label' => 'Teknisi',
                            'symbol' => 'bi-wrench-adjustable',
                        ],
                        'bi bi-box-seam' => [
                            'label' => 'Perangkat',
                            'symbol' => 'bi-box-seam',
                        ],
                        'bi bi-lightning-charge' => [
                            'label' => 'Kelistrikan',
                            'symbol' => 'bi-lightning-charge',
                        ],
                        'bi bi-camera-video' => [
                            'label' => 'Audio Visual',
                            'symbol' => 'bi-camera-video',
                        ],
                        'bi bi-building' => [
                            'label' => 'Perusahaan',
                            'symbol' => 'bi-building',
                        ],
                        'bi bi-cart-check' => [
                            'label' => 'Pengadaan',
                            'symbol' => 'bi-cart-check',
                        ],
                        'bi bi-boxes' => [
                            'label' => 'Inventaris',
                            'symbol' => 'bi-boxes',
                        ],
                        'bi bi-wifi' => [
                            'label' => 'Wi-Fi',
                            'symbol' => 'bi-wifi',
                        ],
                        'bi bi-clipboard-check' => [
                            'label' => 'Pemeriksaan',
                            'symbol' => 'bi-clipboard-check',
                        ],
                    ];

                    $selectedIcon = old('icon', 'bi bi-laptop');
                @endphp

                <div class="row g-3">
                    @foreach ($icons as $iconValue => $iconData)
                        <div class="col-6 col-md-4 col-xl-3">
                            <label
                                for="service_icon_{{ $loop->index }}"
                                class="service-icon-label"
                            >
                                <input
                                    type="radio"
                                    id="service_icon_{{ $loop->index }}"
                                    name="icon"
                                    value="{{ $iconValue }}"
                                    class="service-icon-radio"
                                    @checked($selectedIcon === $iconValue)
                                    required
                                >

                                <div class="service-icon-option">
                                    <i
                                        class="bi {{ $iconData['symbol'] }} d-block mb-2"
                                        aria-hidden="true"
                                    ></i>

                                    <span class="small fw-semibold d-block">
                                        {{ $iconData['label'] }}
                                    </span>

                                    <span class="small text-primary d-block mt-2">
                                        <i class="bi bi-hand-index-thumb me-1"></i>
                                        Pilih ikon
                                    </span>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>

                @error('icon')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- URUTAN --}}
            <div class="mb-4">
                <label for="sort_order" class="form-label fw-semibold">
                    Urutan Tampilan <span class="text-danger">*</span>
                </label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    min="1"
                    class="form-control rounded-3 @error('sort_order') is-invalid @enderror"
                    value="{{ old('sort_order', 1) }}"
                    required
                >

                <div class="form-text">
                    Angka lebih kecil akan ditampilkan lebih dahulu.
                </div>

                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- STATUS --}}
            <div class="mb-4">
                <label for="is_active" class="form-label fw-semibold">
                    Status Layanan <span class="text-danger">*</span>
                </label>

                <select
                    id="is_active"
                    name="is_active"
                    class="form-select rounded-3 @error('is_active') is-invalid @enderror"
                    required
                >
                    <option
                        value="1"
                        @selected(old('is_active', '1') == '1')
                    >
                        Aktif
                    </option>

                    <option
                        value="0"
                        @selected(old('is_active', '1') == '0')
                    >
                        Nonaktif
                    </option>
                </select>

                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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
    </div>
</div>
@endsection
