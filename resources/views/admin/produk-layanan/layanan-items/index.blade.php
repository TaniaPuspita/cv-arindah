@extends('admin.layouts.app')

@section('title', 'CMS Kartu Layanan')
@section('page-title', 'CMS Produk & Layanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER HALAMAN --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Kartu Layanan</h1>
            <p class="pc-subtitle">
                Kelola kartu layanan yang ditampilkan pada halaman Produk &amp; Layanan CV Arindah.
            </p>
        </div>

        <a href="{{ route('admin.produk-layanan.layanan-items.create') }}"
           class="pc-primary-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kartu</span>
        </a>
    </div>

    {{-- KARTU STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL KARTU --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon blue">
                        <i class="bi bi-grid-1x2"></i>
                    </div>

                    <div>
                        <div class="pc-stat-label">Total Kartu</div>
                        <div class="pc-stat-number">
                            {{ $items->total() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KARTU AKTIF --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon green">
                        <i class="bi bi-eye"></i>
                    </div>

                    <div>
                        <div class="pc-stat-label">Kartu Aktif</div>
                        <div class="pc-stat-number">
                            {{ \App\Models\ProdukLayananServiceItem::where('is_active', true)->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KARTU NONAKTIF --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon gray">
                        <i class="bi bi-eye-slash"></i>
                    </div>

                    <div>
                        <div class="pc-stat-label">Kartu Nonaktif</div>
                        <div class="pc-stat-number">
                            {{ \App\Models\ProdukLayananServiceItem::where('is_active', false)->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL KARTU LAYANAN --}}
    <div class="pc-table-card">

        {{-- HEADER TABEL --}}
        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Daftar Kartu Layanan</h2>
                <p class="pc-table-description">
                    Atur nama, ikon, status, dan urutan kartu layanan.
                </p>
            </div>

            <span class="pc-count-label">
                <i class="bi bi-collection me-1"></i>
                {{ $items->total() }} kartu
            </span>
        </div>

        {{-- ISI TABEL --}}
        <div class="table-responsive">
            <table class="table pc-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 90px;">
                            Urutan
                        </th>

                        <th class="text-center" style="width: 100px;">
                            Ikon
                        </th>

                        <th style="min-width: 220px;">
                            Nama Layanan
                        </th>

                        <th class="text-center">
                            Status
                        </th>

                        <th class="text-center" style="width: 115px;">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($items as $item)
                        <tr>

                            {{-- URUTAN --}}
                            <td class="text-center">
                                <span class="pc-order">
                                    {{ $item->sort_order }}
                                </span>
                            </td>

                            {{-- IKON --}}
                            <td class="text-center">
                                @php
                                    $icons = [
                                        'monitor'   => 'bi-pc-display',
                                        'laptop'    => 'bi-laptop',
                                        'network'   => 'bi-diagram-3',
                                        'settings'  => 'bi-gear',
                                        'building'  => 'bi-building',
                                        'briefcase' => 'bi-briefcase',
                                        'printer'   => 'bi-printer',
                                        'wrench'    => 'bi-wrench',
                                    ];

                                    $iconClass = $icons[$item->icon] ?? 'bi-grid';
                                @endphp

                                <div class="pc-image-placeholder">
                                    <i class="bi {{ $iconClass }}"
                                       aria-hidden="true"></i>
                                </div>
                            </td>

                            {{-- NAMA LAYANAN --}}
                            <td>
                                <div class="pc-category-name">
                                    {{ $item->title }}
                                </div>

                                <div class="pc-category-id">
                                    ID kartu #{{ $item->id }}
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if ($item->is_active)
                                    <span class="pc-status active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="pc-status inactive">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td>
                                <div class="pc-actions">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.produk-layanan.layanan-items.edit', $item) }}"
                                       class="pc-action-btn pc-edit-btn"
                                       title="Edit kartu"
                                       aria-label="Edit kartu">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('admin.produk-layanan.layanan-items.destroy', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kartu layanan ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="pc-action-btn pc-delete-btn"
                                                title="Hapus kartu"
                                                aria-label="Hapus kartu">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        {{-- DATA KOSONG --}}
                        <tr>
                            <td colspan="5" class="pc-empty">

                                <div class="pc-empty-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>

                                <h3 class="h6 fw-bold mb-2">
                                    Belum ada kartu layanan
                                </h3>

                                <p class="text-secondary small mb-3">
                                    Tambahkan kartu agar dapat dikelola melalui CMS.
                                </p>

                                <a href="{{ route('admin.produk-layanan.layanan-items.create') }}"
                                   class="pc-primary-btn">
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah Kartu
                                </a>

                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($items->hasPages())
            <div class="pc-pagination">
                {{ $items->links() }}
            </div>
        @endif

    </div>

    {{-- CATATAN --}}
    <div class="pc-info-note mt-3">
        <i class="bi bi-info-circle"></i>

        <span>
            Kartu nonaktif tetap tersimpan di database, tetapi tidak akan
            ditampilkan pada halaman publik.
        </span>
    </div>

</div>
@endsection
