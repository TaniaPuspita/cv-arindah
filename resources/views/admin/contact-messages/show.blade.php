@extends('admin.layouts.app')

@section('title', 'Detail Pesan | CV Arindah')
@section('page-title', 'Detail Pesan')

@section('content')

<style>
    .message-detail-page {
        color: #193F6B;
    }

    .message-detail-page .detail-description {
        color: #7B8DA5;
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .message-detail-page .detail-card {
        overflow: hidden;
        border: 1px solid #E5EDF6;
        border-radius: 16px;
        background: #FFFFFF;
        box-shadow: 0 6px 24px rgba(27, 69, 109, 0.06);
    }

    .message-detail-page .detail-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #E8EEF6;
    }

    .message-detail-page .detail-icon {
        display: inline-flex;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EAF3FF;
        color: #0969D8;
        font-size: 20px;
    }

    .message-detail-page .detail-body {
        padding: 28px;
    }

    .message-detail-page .detail-label {
        display: block;
        margin-bottom: 9px;
        color: #8191A7;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .message-detail-page .detail-value {
        color: #193F6B;
        font-size: 0.92rem;
        font-weight: 500;
        overflow-wrap: anywhere;
    }

    .message-detail-page .detail-info-box {
        height: 100%;
        padding: 18px;
        border: 1px solid #E5EDF6;
        border-radius: 12px;
        background: #FFFFFF;
    }

    .message-detail-page .detail-info-icon {
        display: inline-flex;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #EAF3FF;
        color: #0969D8;
        font-size: 16px;
    }

    .message-detail-page .message-content {
        min-height: 150px;
        padding: 20px;
        border: 1px solid #E1EAF4;
        border-radius: 12px;
        background: #F7FAFE;
        color: #405875;
        font-size: 0.9rem;
        line-height: 1.8;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }

    .message-detail-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 0.76rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .message-detail-page .status-read {
        color: #18794E;
        background: #E6F6ED;
    }

    .message-detail-page .status-unread {
        color: #946200;
        background: #FFF3D6;
    }

    .message-detail-page .detail-back-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #DCE5EF;
        border-radius: 10px;
        background: #FFFFFF;
        color: #526782;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .message-detail-page .detail-back-button:hover {
        border-color: #0969D8;
        background: #F1F7FF;
        color: #0969D8;
    }

    .message-detail-page .detail-action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .message-detail-page .detail-reply {
        border-color: #0969D8;
        background: #0969D8;
        color: #FFFFFF;
    }

    .message-detail-page .detail-reply:hover {
        border-color: #0757B5;
        background: #0757B5;
        color: #FFFFFF;
    }

    .message-detail-page .detail-unread {
        border-color: #F2D28B;
        background: #FFFFFF;
        color: #A66B00;
    }

    .message-detail-page .detail-unread:hover {
        border-color: #B77908;
        background: #B77908;
        color: #FFFFFF;
    }

    .message-detail-page .detail-delete {
        border-color: #F0BCC2;
        background: #FFFFFF;
        color: #DC3545;
    }

    .message-detail-page .detail-delete:hover {
        border-color: #DC3545;
        background: #DC3545;
        color: #FFFFFF;
    }

    @media (max-width: 767.98px) {
        .message-detail-page .detail-card-header {
            padding: 16px;
        }

        .message-detail-page .detail-body {
            padding: 18px;
        }

        .message-detail-page .detail-action-button {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-0 message-detail-page">

    {{-- HEADER HALAMAN --}}
    <section class="dashboard-intro mb-4">

        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <div class="d-flex flex-wrap justify-content-between
                    align-items-start gap-3">

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

            <div class="d-flex flex-wrap justify-content-between
                        align-items-center gap-3">

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
            <div class="d-flex flex-wrap justify-content-between
                        align-items-start gap-3 mb-4">

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

            <hr class="my-4" style="border-color: #E5EDF6;">

            {{-- KARTU INFORMASI KONTAK --}}
            <div class="row g-3 mb-4">

                {{-- EMAIL --}}
                <div class="col-12 col-md-6">

                    <div class="detail-info-box">

                        <div class="d-flex align-items-start gap-3">

                            <div class="detail-info-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            <div class="min-w-0 flex-grow-1">

                                <span class="detail-label">
                                    Alamat Email
                                </span>

                                <div class="detail-value">
                                    <a
                                        href="mailto:{{ $contactMessage->email }}"
                                        class="text-decoration-none"
                                        style="color: #0969D8;"
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

                                <span class="detail-label">
                                    Nomor Telepon
                                </span>

                                <div class="detail-value">

                                    @if($contactMessage->telepon)

                                        <a
                                            href="tel:{{ $contactMessage->telepon }}"
                                            class="text-decoration-none"
                                            style="color: #0969D8;"
                                        >
                                            {{ $contactMessage->telepon }}
                                        </a>

                                    @else

                                        <span style="color: #8998AC;">
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

                                <span class="detail-label">
                                    Subjek Pesan
                                </span>

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

                <label class="detail-label">
                    Isi Pesan Pengunjung
                </label>

                <div class="message-content">{{ $contactMessage->pesan }}</div>

            </div>

            {{-- AKSI PESAN --}}
            <div class="pt-3 border-top"
                 style="border-color: #E5EDF6 !important;">

                <h6 class="fw-bold mb-3">Aksi Pesan</h6>

                <div class="d-flex flex-wrap gap-2">

                    {{-- BALAS EMAIL --}}
                    <a
                        href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($contactMessage->email) }}&su={{ urlencode('Re: ' . $contactMessage->subjek) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="detail-action-button detail-reply"
                    >
                        <i class="bi bi-reply"></i>
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