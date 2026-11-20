@extends('admin.layouts.app')

@section('title', 'Detail Pesan | CV Arindah')
@section('page-title', 'Detail Pesan')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/contact-messages/show.css') }}">
@endpush

<div class="container-fluid px-0 message-detail-page">

    {{-- HEADER HALAMAN --}}
    <section class="dashboard-intro mb-4">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h1 class="page-title">Detail Pesan</h1>

                <p class="page-description detail-description">
                    Baca informasi lengkap pesan yang dikirim melalui
                    formulir kontak website CV Arindah.
                </p>
            </div>

            <a
                href="{{ route('admin.contact-messages.index') }}"
                class="detail-back-button"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali ke Pesan Masuk
            </a>
        </div>
    </section>

    {{-- KARTU DETAIL PESAN --}}
    <section class="detail-card">

        {{-- HEADER KARTU --}}
        <div class="detail-card-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                <div class="d-flex align-items-center gap-3">
                    <div class="detail-icon">
                        <i class="bi bi-envelope-paper"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">Informasi Pesan</h5>

                        <p class="detail-description mb-0">
                            Detail pengirim dan isi pesan pengunjung.
                        </p>
                    </div>
                </div>

                {{-- STATUS PESAN --}}
                @if($contactMessage->is_read)
                    <span class="status-badge status-read">
                        <i class="bi bi-check-circle-fill"></i>
                        Sudah dibaca
                    </span>
                @else
                    <span class="status-badge status-unread">
                        <i class="bi bi-envelope-fill"></i>
                        Belum dibaca
                    </span>
                @endif

            </div>
        </div>

        <div class="detail-body">

            {{-- INFORMASI PENGIRIM --}}
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
                <div>
                    <h4 class="fw-bold mb-2">
                        {{ $contactMessage->nama }}
                    </h4>

                    <p class="detail-description mb-0">
                        <i class="bi bi-clock me-1"></i>
                        Dikirim pada
                        {{ $contactMessage->created_at?->format('d F Y, H:i') ?? '-' }}
                    </p>
                </div>
            </div>

            <hr class="my-4">

            {{-- INFORMASI KONTAK --}}
            <div class="row g-3 mb-4">

                {{-- EMAIL --}}
                <div class="col-12 col-md-6">
                    <div class="detail-info-box">
                        <div class="d-flex align-items-start gap-3">

                            <div class="detail-info-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            <div class="min-w-0 flex-grow-1">
                                <span class="detail-label">Alamat Email</span>

                                <div class="detail-value">
                                    <a
                                        href="mailto:{{ $contactMessage->email }}"
                                        class="text-decoration-none blade-static-style-1"

                                    >
                                        {{ $contactMessage->email }}
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- TELEPON --}}
                <div class="col-12 col-md-6">
                    <div class="detail-info-box">
                        <div class="d-flex align-items-start gap-3">

                            <div class="detail-info-icon">
                                <i class="bi bi-telephone"></i>
                            </div>

                            <div class="min-w-0 flex-grow-1">
                                <span class="detail-label">Nomor Telepon</span>

                                <div class="detail-value">
                                    @if($contactMessage->telepon)
                                        <a
                                            href="tel:{{ $contactMessage->telepon }}"
                                            class="text-decoration-none blade-static-style-2"

                                        >
                                            {{ $contactMessage->telepon }}
                                        </a>
                                    @else
                                        <span class="blade-static-style-2">
                                            Tidak dicantumkan
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- SUBJEK --}}
                <div class="col-12">
                    <div class="detail-info-box">
                        <div class="d-flex align-items-start gap-3">

                            <div class="detail-info-icon">
                                <i class="bi bi-chat-left-text"></i>
                            </div>

                            <div class="min-w-0 flex-grow-1">
                                <span class="detail-label">Subjek Pesan</span>

                                <div class="detail-value">
                                    {{ ucfirst($contactMessage->subjek) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- ISI PESAN --}}
            <div class="mb-4">
                <label class="detail-label">Isi Pesan Pengunjung</label>

                <div class="message-content">{{ $contactMessage->pesan }}</div>
            </div>

            {{-- AKSI PESAN --}}
            <div class="pt-3 border-top">

                <h6 class="fw-bold mb-3">Aksi Pesan</h6>

                <div class="d-flex flex-wrap gap-2">

                    {{-- BALAS EMAIL DENGAN TEMPLATE --}}
                    <a
                        href="{{ $gmailUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="detail-action-button detail-reply"
                    >
                        <i class="bi bi-arrow-return-right" aria-hidden="true"></i>
                        Balas melalui Email
                    </a>

                    {{-- TANDAI BELUM DIBACA --}}
                    @if($contactMessage->is_read)
                        <form
                            action="{{ route('admin.contact-messages.unread', $contactMessage->id) }}"
                            method="POST"
                            class="m-0"
                            onsubmit="return confirm('Tandai pesan ini sebagai belum dibaca?')"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="detail-action-button detail-unread"
                                title="Tandai pesan sebagai belum dibaca"
                            >
                                <i class="bi bi-eye-slash"></i>
                                Tandai Belum Dibaca
                            </button>
                        </form>
                    @endif

                    {{-- HAPUS PESAN --}}
                    <form
                        action="{{ route('admin.contact-messages.destroy', $contactMessage->id) }}"
                        method="POST"
                        class="m-0"
                        onsubmit="return confirm('Yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="detail-action-button detail-delete"
                        >
                            <i class="bi bi-trash3"></i>
                            Hapus Pesan
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </section>

</div>

@endsection
