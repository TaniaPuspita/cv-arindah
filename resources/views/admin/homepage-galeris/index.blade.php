@extends('admin.layouts.app')

@section('title', 'CMS Galeri')
@section('page-title', 'CMS Beranda')

@section('content')
<div class="container-fluid pc-page">

    <div class="pc-header d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="pc-heading">Galeri Beranda</h1>
            <p class="pc-subtitle">
                Kelola foto yang ditampilkan pada slider Galeri Beranda CV Arindah.
            </p>
        </div>

        <a href="{{ route('admin.homepage-galeris.create') }}"
           class="pc-primary-btn text-decoration-none">
            <i class="bi bi-plus-lg me-1"></i> Tambah Foto
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pc-table-card">
        <div class="pc-table-header">
            <div>
                <h2 class="pc-table-title">Daftar Foto Galeri</h2>
                <p class="pc-table-description">
                    Atur foto, urutan, dan status tampil.
                </p>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Urutan</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($galeris as $galeri)
                        <tr>
                            <td class="ps-4">
                                {{ $galeri->sort_order }}
                            </td>

                            <td>
                                <img
                                    src="{{ str_starts_with($galeri->image, 'images/')
                                        ? asset($galeri->image)
                                        : asset('storage/' . $galeri->image) }}"
                                    alt="{{ $galeri->alt_text ?: $galeri->title }}"
                                    style="width:100px;height:65px;object-fit:cover"
                                    class="rounded-3 border"
                                >
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $galeri->title }}
                                </div>
                                <small class="text-secondary">
                                    ID foto #{{ $galeri->id }}
                                </small>
                            </td>

                            <td>
                                @if ($galeri->is_active)
                                    <span class="badge bg-success-subtle text-success">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <a
                                    href="{{ route('admin.homepage-galeris.edit', $galeri) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    aria-label="Edit foto"
                                >
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form
                                    action="{{ route('admin.homepage-galeris.destroy', $galeri) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Yakin ingin menghapus foto ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                        aria-label="Hapus foto"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center py-5 text-secondary">
                                Belum ada foto galeri.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-3">
            {{ $galeris->links() }}
        </div>
    </div>
</div>
@endsection
