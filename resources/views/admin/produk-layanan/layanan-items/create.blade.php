
@extends('admin.layouts.app')

@section('title', 'Tambah Kartu Layanan')
@section('page-title', 'Tambah Kartu Layanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">


    <link rel="stylesheet" href="{{ asset('css/pages/admin/produk-layanan/layanan-items/create.css') }}">

@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Tambah Kartu Layanan</h1>
            <p class="pc-subtitle">
                Tambahkan kartu layanan yang akan ditampilkan pada halaman Produk &amp; Layanan CV Arindah.
            </p>
        </div>

        <a href="{{ route('admin.produk-layanan.layanan-items.index') }}"
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
                <h2 class="pc-table-title">Informasi Kartu Layanan</h2>
                <p class="pc-table-description">
                    Lengkapi nama, ikon, urutan, dan status kartu layanan.
                </p>
            </div>
        </div>

        <form
            action="{{ route('admin.produk-layanan.layanan-items.store') }}"
            method="POST"
            class="p-4"
        >
            @csrf

            {{-- NAMA --}}
            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">
                    Nama Layanan <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control rounded-3 @error('title') is-invalid @enderror"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Pengadaan Perangkat Komputer & Jaringan"
                    maxlength="150"
                    required
                >

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- PILIH IKON --}}
            <div class="mb-4" id="service-icon-picker">
                <label class="form-label fw-semibold">
                    Pilih Ikon Layanan <span class="text-danger">*</span>
                </label>

                <p class="form-text mt-0 mb-3">
                    Pilih ikon yang sesuai dengan kartu layanan.
                </p>

                @php
                    $icons = [
                        'monitor' => [
                            'label' => 'Komputer',
                            'symbol' => 'bi-pc-display',
                        ],
                        'laptop' => [
                            'label' => 'Teknologi',
                            'symbol' => 'bi-laptop',
                        ],
                        'network' => [
                            'label' => 'Jaringan / Solusi',
                            'symbol' => 'bi-diagram-3',
                        ],
                        'settings' => [
                            'label' => 'Pengaturan',
                            'symbol' => 'bi-gear',
                        ],
                        'building' => [
                            'label' => 'Perusahaan',
                            'symbol' => 'bi-building',
                        ],
                        'briefcase' => [
                            'label' => 'Bisnis',
                            'symbol' => 'bi-briefcase',
                        ],
                        'printer' => [
                            'label' => 'Printer',
                            'symbol' => 'bi-printer',
                        ],
                        'wrench' => [
                            'label' => 'Perbaikan',
                            'symbol' => 'bi-wrench',
                        ],
                    ];

                    $selectedIcon = old('icon', 'monitor');
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

                                    <span class="small fw-semibold text-center">
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
                    Status Kartu <span class="text-danger">*</span>
                </label>

                <select
                    id="is_active"
                    name="is_active"
                    class="form-select rounded-3 @error('is_active') is-invalid @enderror"
                    required
                >
                    <option value="1"
                        @selected((string) old('is_active', '1') === '1')>
                        Aktif
                    </option>

                    <option value="0"
                        @selected((string) old('is_active', '1') === '0')>
                        Nonaktif
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
