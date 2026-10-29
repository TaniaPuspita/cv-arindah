
@extends('admin.layouts.app')

@section('title', 'CMS Produk')
@section('page-title', 'CMS BERANDA')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
<div class="container-fluid pc-page">

    {{-- HEADER HALAMAN --}}
    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Kategori Produk</h1>
            <p class="pc-subtitle">
                Kelola kategori produk yang ditampilkan pada halaman beranda.
            </p>
        </div>

        <a href="{{ route('admin.product-categories.create') }}"
           class="pc-primary-btn">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kategori</span>
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

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon blue">
                        <i class="bi bi-grid-1x2"></i>
                    </div>
                    <div>
                        <div class="pc-stat-label">Total Kategori</div>
                        <div class="pc-stat-number">
                            {{ $categories->total() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon green">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div>
                        <div class="pc-stat-label">Kategori Aktif</div>
                        <div class="pc-stat-number">
                            {{ \App\Models\ProductCategory::where('is_active', true)->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-4">
            <div class="pc-stat-card">
                <div class="pc-stat-top">
                    <div class="pc-stat-icon gray">
                        <i class="bi bi-eye-slash"></i>
                    </div>
                    <div>
                        <div class="pc-stat-label">Kategori Nonaktif</div>
                        <div class="pc-stat-number">
                            {{ \App\Models\ProductCategory::where('is_active', false)->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- TABEL DAFTAR KATEGORI --}}
    <div class="pc-table-card">

        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Daftar Kategori</h2>
                <p class="pc-table-description">
                    Atur informasi dan urutan kategori yang ditampilkan.
                </p>
            </div>

            <span class="pc-count-label">
                <i class="bi bi-collection me-1"></i>
                {{ $categories->total() }} kategori
            </span>
        </div>

        <div class="table-responsive">
            <table class="table pc-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 75px;">Urutan</th>
                        <th style="width: 105px;">Gambar</th>
                        <th style="min-width: 175px;">Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 115px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            {{-- URUTAN --}}
                            <td class="text-center">
                                <span class="pc-order">
                                    {{ $category->sort_order }}
                                </span>
                            </td>

                            {{-- GAMBAR --}}
                            <td>
                                @php
                                    $imagePath = $category->image
                                        ? (
                                            \Illuminate\Support\Str::startsWith(
                                                $category->image,
                                                'images/'
                                            )
                                                ? asset($category->image)
                                                : asset('storage/' . $category->image)
                                        )
                                        : null;
                                @endphp

                                @if ($imagePath)
                                    <img
                                        src="{{ $imagePath }}"
                                        alt="{{ $category->name }}"
                                        class="pc-thumbnail"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="pc-image-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- NAMA KATEGORI --}}
                            <td>
                                <div class="pc-category-name">
                                    {{ $category->name }}
                                </div>
                                <div class="pc-category-id">
                                    ID kategori #{{ $category->id }}
                                </div>
                            </td>

                            {{-- DESKRIPSI --}}
                            <td>
                                <div class="pc-description">
                                    {{ \Illuminate\Support\Str::limit($category->description, 100) }}
                                </div>
                            </td>

                            {{-- STATUS --}}
                            <td class="text-center">
                                @if ($category->is_active)
                                    <span class="pc-status active">Aktif</span>
                                @else
                                    <span class="pc-status inactive">Nonaktif</span>
                                @endif
                            </td>

                            {{-- TOMBOL AKSI --}}
                            <td>
                                <div class="pc-actions">
                                    <a
                                        href="{{ route('admin.product-categories.edit', $category) }}"
                                        class="pc-action-btn pc-edit-btn"
                                        title="Edit kategori"
                                        aria-label="Edit kategori"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.product-categories.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori {{ addslashes($category->name) }}?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="pc-action-btn pc-delete-btn"
                                            title="Hapus kategori"
                                            aria-label="Hapus kategori"
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
                                    Belum ada kategori produk
                                </h3>

                                <p class="text-secondary small mb-3">
                                    Tambahkan kategori agar bisa dikelola melalui CMS.
                                </p>

                                <a
                                    href="{{ route('admin.product-categories.create') }}"
                                    class="pc-primary-btn"
                                >
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah Kategori
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($categories->hasPages())
            <div class="pc-pagination">
                {{ $categories->links() }}
            </div>
        @endif

    </div>

    {{-- CATATAN STATUS --}}
    <div class="pc-info-note mt-3">
        <i class="bi bi-info-circle"></i>
        <span>
            Kategori nonaktif tetap tersimpan di database, tetapi nantinya
            tidak ditampilkan pada halaman beranda.
        </span>
    </div>

</div>
@endsection
