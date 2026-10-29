
@extends('admin.layouts.app')

@section('title', 'Edit Kartu Layanan')
@section('page-title', 'Edit Kartu Layanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        .service-icon-label {
            display: block;
            height: 100%;
            cursor: pointer;
        }

        .service-icon-radio {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .service-icon-option {
            display: flex;
            min-height: 120px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 16px 12px;
            border: 1px solid #DEE2E6;
            border-radius: 12px;
            background: #FFFFFF;
            transition: .2s ease;
        }

        .service-icon-option > i {
            margin-bottom: 10px;
            color: #0969D8;
            font-size: 1.8rem;
        }

        .service-icon-radio:checked + .service-icon-option {
            border: 2px solid #0969D8;
            background: #F0F7FF;
        }

        .service-icon-radio:focus-visible + .service-icon-option {
            outline: 2px solid rgba(9, 105, 216, .3);
            outline-offset: 3px;
        }

        .service-icon-option:hover {
            border-color: #0969D8;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Edit Kartu Layanan</h1>
            <p class="pc-subtitle">
                Perbarui nama, ikon, urutan, dan status kartu layanan pada halaman Produk &amp; Layanan.
            </p>
        </div>

        <a href="{{ route('admin.produk-layanan.layanan-items.index') }}"
           class="btn btn-outline-secondary rounded-3 px-3 py-2">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- NOTIFIKASI VALIDASI --}}
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

    {{-- FORM EDIT --}}
    <div class="pc-table-card">

        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Informasi Kartu Layanan</h2>
                <p class="pc-table-description">
                    Data yang disimpan akan digunakan pada kartu Layanan Kami di halaman publik.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.produk-layanan.layanan-items.update', $item) }}"
            method="POST"
            class="p-4"
        >
            @csrf
            @method('PUT')

            {{-- NAMA LAYANAN --}}
            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">
                    Nama Layanan <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control rounded-3 @error('title') is-invalid @enderror"
                    value="{{ old('title', $item->title) }}"
                    maxlength="150"
                    placeholder="Masukkan nama layanan"
                    required
                >

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PILIH IKON --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Pilih Ikon Layanan <span class="text-danger">*</span>
                </label>

                <p class="form-text mt-0 mb-3">
                    Pilih ikon yang akan digunakan untuk kartu layanan.
                </p>

                @php
                    $iconOptions = [
                        'monitor' => [
                            'label' => 'Monitor',
                            'class' => 'bi-display',
                        ],
                        'laptop' => [
                            'label' => 'Roda Gigi',
                            'class' => 'bi-gear',
                        ],
                        'network' => [
                            'label' => 'Centang',
                            'class' => 'bi-check-circle',
                        ],
                        'settings' => [
                            'label' => 'Pengaturan',
                            'class' => 'bi-gear',
                        ],
                        'building' => [
                            'label' => 'Perusahaan',
                            'class' => 'bi-building',
                        ],
                        'briefcase' => [
                            'label' => 'Bisnis',
                            'class' => 'bi-briefcase',
                        ],
                        'printer' => [
                            'label' => 'Printer',
                            'class' => 'bi-printer',
                        ],
                        'wrench' => [
                            'label' => 'Teknisi',
                            'class' => 'bi-wrench',
                        ],
                    ];

                    $selectedIcon = old('icon', $item->icon);
                @endphp

                <div class="row g-3">
                    @foreach ($iconOptions as $iconValue => $iconData)
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
                                        class="bi {{ $iconData['class'] }}"
                                        aria-hidden="true"
                                    ></i>

                                    <span class="small fw-semibold text-center">
                                        {{ $iconData['label'] }}
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
                    value="{{ old('sort_order', $item->sort_order) }}"
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
                    Status Kartu <span class="text-danger">*</span>
                </label>

                <select
                    id="is_active"
                    name="is_active"
                    class="form-select rounded-3 @error('is_active') is-invalid @enderror"
                    required
                >
                    <option
                        value="1"
                        @selected((string) old('is_active', (int) $item->is_active) === '1')
                    >
                        Aktif — tampil di halaman publik
                    </option>

                    <option
                        value="0"
                        @selected((string) old('is_active', (int) $item->is_active) === '0')
                    >
                        Nonaktif — sembunyikan dari halaman publik
                    </option>
                </select>

                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- TOMBOL --}}
            <div class="cms-form-actions">

                    {{-- Simpan di sebelah kiri --}}
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
    </div>

</div>
@endsection
