@extends('admin.layouts.app')

@section('title', 'CMS Layanan')
@section('page-title', 'CMS Beranda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER HALAMAN --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Layanan Beranda</h1>
            <p class="pc-subtitle">
                Kelola layanan yang ditampilkan pada halaman beranda CV Arindah.
            </p>
        </div>

        <a href="{{ route('admin.homepage-services.create') }}"
           class="pc-primary-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Layanan</span>
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

    {{-- KARTU STATISTIK --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL LAYANAN --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon blue">
                        <i class="bi bi-grid-1x2"></i>
                    </div>
                    <div>
                        <div class="pc-stat-label">Total Layanan</div>
                        <div class="pc-stat-number">
                            {{ $services->total() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- LAYANAN AKTIF --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon green">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div>
                        <div class="pc-stat-label">Layanan Aktif</div>
                        <div class="pc-stat-number">
                            {{ \App\Models\HomepageService::where('is_active', true)->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- LAYANAN NONAKTIF --}}
        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon gray">
                        <i class="bi bi-eye-slash"></i>
                    </div>
                    <div>
                        <div class="pc-stat-label">Layanan Nonaktif</div>
                        <div class="pc-stat-number">
                            {{ \App\Models\HomepageService::where('is_active', false)->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL DAFTAR LAYANAN --}}
    <div class="pc-table-card">

        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Daftar Layanan</h2>
                <p class="pc-table-description">
                    Atur informasi, media, status, dan urutan layanan.
                </p>
            </div>

            <span class="pc-count-label">
                <i class="bi bi-collection me-1"></i>
                {{ $services->total() }} layanan
            </span>
        </div>

        <div class="table-responsive">
            <table class="table pc-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 75px;">Urutan</th>
                        <th class="text-center" style="width: 100px;">Media</th>
                        <th style="min-width: 175px;">Nama Layanan</th>
                        <th style="min-width: 220px;">Deskripsi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 115px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($services as $service)
                        <tr>

                            {{-- URUTAN --}}
                            <td class="text-center">
                                <span class="pc-order">
                                    {{ $service->sort_order }}
                                </span>
                            </td>

                            {{-- GAMBAR ATAU IKON --}}
                            <td class="text-center">
                                @if ($service->image)
                                    <img
                                        src="{{ asset('storage/' . $service->image) }}"
                                        alt="{{ $service->name }}"
                                        class="pc-thumbnail"
                                        loading="lazy"
                                    >
                                @elseif ($service->icon)
                                    <div class="pc-image-placeholder">
                                        <i class="bi {{ $service->icon }}"></i>
                                    </div>
                                @else
                                    <div class="pc-image-placeholder">
                                        <i class="bi bi-grid"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- NAMA LAYANAN --}}
                            <td>
                                <div class="pc-category-name">
                                    {{ $service->name }}
                                </div>
                                <div class="pc-category-id">
                                    ID layanan #{{ $service->id }}
                                </div>
                            </td>

                            {{-- DESKRIPSI --}}
                            <td>
                                <div class="pc-description">
                                    {{ \Illuminate\Support\Str::limit($service->description, 100) }}
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if ($service->is_active)
                                    <span class="pc-status active">Aktif</span>
                                @else
                                    <span class="pc-status inactive">Nonaktif</span>
                                @endif
                            </td>

                            {{-- TOMBOL AKSI --}}
                            <td>
                                <div class="pc-actions">
                                    <a
                                        href="{{ route('admin.homepage-services.edit', $service) }}"
                                        class="pc-action-btn pc-edit-btn"
                                        title="Edit layanan"
                                        aria-label="Edit layanan"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.homepage-services.destroy', $service) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus layanan ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="pc-action-btn pc-delete-btn"
                                            title="Hapus layanan"
                                            aria-label="Hapus layanan"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        {{-- TAMPILAN JIKA DATA KOSONG --}}
                        <tr>
                            <td colspan="6" class="pc-empty">
                                <div class="pc-empty-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>

                                <h3 class="h6 fw-bold mb-2">
                                    Belum ada layanan
                                </h3>

                                <p class="text-secondary small mb-3">
                                    Tambahkan layanan agar dapat dikelola melalui CMS.
                                </p>

                                <a
                                    href="{{ route('admin.homepage-services.create') }}"
                                    class="pc-primary-btn"
                                >
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah Layanan
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($services->hasPages())
            <div class="pc-pagination">
                {{ $services->links() }}
            </div>
        @endif

    </div>

    {{-- CATATAN STATUS --}}
    <div class="pc-info-note mt-3">
        <i class="bi bi-info-circle"></i>
        <span>
            Layanan nonaktif tetap tersimpan di database, tetapi tidak akan
            ditampilkan pada halaman publik setelah integrasi selesai.
        </span>
    </div>

</div>
@endsection
