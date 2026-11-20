
@extends('admin.layouts.app')

@section('title', 'CMS Galeri | CV Arindah')
@section('page-title', 'CMS Galeri')

@section('content')
<div class="container-fluid galeri-cms-page">

    {{-- HEADER HALAMAN --}}
    <section class="dashboard-intro galeri-intro">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>
        <h1 class="page-title">Daftar Foto Galeri</h1>
        <p class="page-description">
            Kelola informasi bagian Koleksi dan foto yang ditampilkan
            pada halaman Galeri CV Arindah.
        </p>
    </section>

    @if ($errors->any())
        <div class="cms-alert cms-alert-error" role="alert">
            <strong>Periksa kembali data yang kamu masukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PENGATURAN BAGIAN KOLEKSI --}}
    <section class="cms-card galeri-content-card">

        <div class="cms-card-heading">
            <div class="cms-heading-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h3>Pengaturan Konten Koleksi</h3>
                <p>
                    Atur label, judul, dan deskripsi yang tampil
                    di atas kumpulan foto Galeri.
                </p>
            </div>
        </div>

        <form
            
            action="{{ route('admin.public-galeri-koleksi.update') }}"

            method="POST"
        >
            @csrf
            @method('PUT')

            <input type="hidden" name="redirect_to" value="daftar-foto">

            <div class="cms-form-group">
                <label for="eyebrow">Label Bagian</label>
                <input
                    type="text"
                    id="eyebrow"
                    name="eyebrow"
                    class="cms-input"
                    value="{{ old('eyebrow', $hero->eyebrow) }}"
                    maxlength="100"
                    placeholder="Contoh: KOLEKSI"
                    required
                >
                @error('eyebrow')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="title">Judul Utama</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="cms-input"
                    value="{{ old('title', $hero->title) }}"
                    maxlength="200"
                    placeholder="Contoh: Produk, Aktivitas & Layanan Kami"
                    required
                >
                @error('title')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-group">
                <label for="description">Deskripsi</label>
                <textarea
                    id="description"
                    name="description"
                    class="cms-input cms-textarea"
                    rows="4"
                    maxlength="2000"
                    placeholder="Masukkan deskripsi singkat untuk bagian Koleksi..."
                >{{ old('description', $hero->description) }}</textarea>

                <small class="field-hint">
                    Deskripsi ini ditampilkan pada bagian Koleksi,
                    bukan pada hero utama halaman Galeri.
                </small>

                @error('description')
                    <small class="field-error">{{ $message }}</small>
                @enderror
            </div>

            <div class="cms-form-actions galeri-form-actions">
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
    </section>

    {{-- DAFTAR FOTO --}}
    <section class="cms-card galeri-list-card">

        <div class="galeri-list-heading">
            <div class="cms-card-heading galeri-list-title">
                <div class="cms-heading-icon">
                    <i class="bi bi-images"></i>
                </div>
                <div>
                    <h3>Daftar Foto Galeri</h3>
                    <p>
                        Tambah, edit, atau hapus foto yang ditampilkan
                        pada halaman Galeri.
                    </p>
                </div>
            </div>

            <a
                href="{{ route('admin.public-galeri-items.create') }}"
                class="primary-button galeri-add-button"
            >
                <i class="bi bi-plus-lg"></i>
                Tambah Foto
            </a>
        </div>

        <div class="galeri-table-wrapper">
            <table class="table galeri-table align-middle">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Foto</th>
                        <th>Informasi Foto</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($items as $item)
                        @php
                            /*
                             * Foto lama berada di public/images/...
                             * Foto upload CMS berada di storage/app/public/...
                             */
                            $imagePath = $item->image ?? '';

                            if (
                                \Illuminate\Support\Str::startsWith(
                                    $imagePath,
                                    ['http://', 'https://']
                                )
                            ) {
                                $imageUrl = $imagePath;
                            } elseif (
                                \Illuminate\Support\Str::startsWith(
                                    $imagePath,
                                    'images/'
                                )
                            ) {
                                $imageUrl = asset($imagePath);
                            } else {
                                $imageUrl = \Illuminate\Support\Facades\Storage::disk('public')
                                    ->url($imagePath);
                            }
                        @endphp

                        <tr>
                            <td data-label="Urutan">
                                <span class="galeri-order">
                                    {{ $item->sort_order }}
                                </span>
                            </td>

                            <td data-label="Foto">
                                <img
                                    src="{{ $imageUrl }}"
                                    alt="{{ $item->alt_text ?: $item->title }}"
                                    class="galeri-thumbnail"
                                    style="object-position: {{ $item->image_position ?: 'center' }}"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.alt='Foto tidak dapat dimuat';"
                                >
                            </td>

                            <td data-label="Informasi Foto">
                                <div class="galeri-item-title">
                                    {{ $item->title }}
                                </div>
                                <small class="galeri-item-alt">
                                    {{ $item->alt_text ?: 'Belum ada teks alternatif' }}
                                </small>
                            </td>

                            <td data-label="Kategori">
                                <span class="galeri-category">
                                    {{ $item->category === 'produk' ? 'Produk' : 'Jasa & Layanan' }}
                                </span>
                            </td>

                            <td data-label="Status">
                                @if ($item->is_active)
                                    <span class="galeri-status is-active">
                                        Aktif
                                    </span>
                                @else
                                    <span class="galeri-status is-inactive">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td data-label="Aksi">
                                <div class="galeri-action-buttons">
                                    <a
                                        href="{{ route('admin.public-galeri-items.edit', $item) }}"
                                        class="galeri-action-btn edit"
                                        aria-label="Edit {{ $item->title }}"
                                        title="Edit foto"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.public-galeri-items.destroy', $item) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="galeri-action-btn delete"
                                            aria-label="Hapus {{ $item->title }}"
                                            title="Hapus foto"
                                        >
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="galeri-empty">
                                <i class="bi bi-images"></i>
                                <strong>Belum ada foto galeri</strong>
                                <span>Tambahkan foto untuk mulai mengisi koleksi.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="galeri-table-footer">
            Total foto: <strong>{{ $items->count() }}</strong>
        </div>
    </section>

</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/public-galeri-items/index.css') }}">
@endpush
@endsection
