
@extends('admin.layouts.app')

@section('title', 'Pesan Masuk | CV Arindah')
@section('page-title', 'Pesan Masuk')

@section('content')

<style>
    .messages-page {
        --messages-primary: #0969D8;
        --messages-navy: #193F6B;
        --messages-muted: #7B8DA5;
        --messages-border: #DCE5F0;

        color: var(--messages-navy);
        min-width: 0;
    }

    .messages-page *,
    .messages-page *::before,
    .messages-page *::after {
        box-sizing: border-box;
    }

    .messages-page .messages-description {
        color: var(--messages-muted);
        font-size: .875rem;
        line-height: 1.7;
    }

    /* RINGKASAN PESAN */
    .messages-page .messages-summary {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .messages-page .summary-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        min-height: 42px;
        border: 1px solid var(--messages-border);
        border-radius: 11px;
        background: #fff;
        color: #526782;
        font-size: .84rem;
    }

    .messages-page .summary-badge strong {
        color: var(--messages-navy);
        font-weight: 700;
    }

    /* KARTU TABEL */
    .messages-page .messages-card {
        min-width: 0;
        overflow: hidden;
        border: 1px solid var(--messages-border);
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 6px 24px rgba(27, 69, 109, .06);
    }

    .messages-page .messages-card-header {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 24px;
        border-bottom: 1px solid var(--messages-border);
        background: #fff;
    }

    .messages-page .messages-icon {
        display: inline-flex;
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #EAF3FF;
        color: var(--messages-primary);
        font-size: 21px;
    }

    .messages-page .messages-card-title {
        margin: 0 0 4px;
        color: var(--messages-navy);
        font-size: 1.15rem;
        font-weight: 700;
    }

    /* PEMBUNGKUS TABEL RESPONSIF */
    .messages-page .messages-table-wrapper {
        width: 100%;
        overflow-x: auto;
        overscroll-behavior-x: contain;
        -webkit-overflow-scrolling: touch;
    }

    /* TABEL UTAMA */
    .messages-page .messages-table {
        width: 100%;
        min-width: 880px;
        margin: 0;
        border: 1px solid var(--messages-border);
        border-collapse: collapse;
        border-spacing: 0;
        color: var(--messages-navy);
        font-size: .875rem;
    }

    /* GARIS HEADER DAN KOLOM */
    .messages-page .messages-table thead th {
        padding: 15px 16px;
        border: 1px solid #D6E1EE;
        background: #F3F7FC;
        color: #526782;
        font-size: .76rem;
        font-weight: 700;
        text-align: left;
        vertical-align: middle;
        white-space: nowrap;
    }

    /* GARIS SETIAP SEL DATA */
    .messages-page .messages-table tbody td {
        padding: 16px;
        border: 1px solid #E0E7F0;
        background: #fff;
        vertical-align: middle;
        transition: background-color .2s ease;
    }

    /* WARNA BARIS SAAT DISOROT */
    .messages-page .messages-table tbody tr:hover td {
        background: #F5F9FF;
    }

    /* NOMOR */
    .messages-page .number-cell {
        width: 65px;
        color: #657B95;
        font-size: .82rem;
        text-align: center;
    }

    /* PENGIRIM */
    .messages-page .sender-cell {
        min-width: 200px;
        max-width: 280px;
    }

    .messages-page .sender-name {
        display: block;
        color: var(--messages-navy);
        font-weight: 650;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .messages-page .sender-email {
        display: block;
        margin-top: 5px;
        color: #8292A8;
        font-size: .78rem;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    /* SUBJEK */
    .messages-page .subject-cell {
        min-width: 140px;
        max-width: 230px;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    /* TANGGAL */
    .messages-page .date-cell {
        min-width: 125px;
        white-space: nowrap;
        line-height: 1.5;
    }

    .messages-page .date-time {
        display: block;
        margin-top: 4px;
        color: #8292A8;
        font-size: .78rem;
    }

    /* STATUS PESAN */
    .messages-page .status-cell {
        min-width: 155px;
    }

    .messages-page .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 7px 10px;
        border-radius: 999px;
        font-size: .72rem;
        font-weight: 650;
        white-space: nowrap;
    }

    .messages-page .status-read {
        color: #18794E;
        background: #E6F6ED;
    }

    .messages-page .status-unread {
        color: #946200;
        background: #FFF3D6;
    }

    /* TOMBOL AKSI */
    .messages-page .action-cell {
        width: 150px;
        min-width: 150px;
        text-align: center !important;
    }

    .messages-page .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .messages-page .action-buttons form {
        display: flex;
        margin: 0;
    }

    .messages-page .action-button {
        display: inline-flex;
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 1px solid;
        border-radius: 9px;
        background: #fff;
        font-size: 15px;
        line-height: 1;
        text-decoration: none;
        cursor: pointer;
        transition: color .2s ease,
                    background-color .2s ease,
                    border-color .2s ease,
                    transform .2s ease;
    }

    .messages-page .action-button:hover {
        transform: translateY(-1px);
    }

    .messages-page .action-view {
        color: #0969D8;
        border-color: #B9D5FF;
    }

    .messages-page .action-view:hover {
        color: #fff;
        background: #0969D8;
        border-color: #0969D8;
    }

    .messages-page .action-unread {
        color: #B77908;
        border-color: #F2D28B;
    }

    .messages-page .action-unread:hover {
        color: #fff;
        background: #B77908;
        border-color: #B77908;
    }

    .messages-page .action-delete {
        color: #DC3545;
        border-color: #F0BCC2;
    }

    .messages-page .action-delete:hover {
        color: #fff;
        background: #DC3545;
        border-color: #DC3545;
    }

    .messages-page .action-button:focus-visible {
        outline: 3px solid rgba(9, 105, 216, .2);
        outline-offset: 2px;
    }

    /* PAGINATION */
    .messages-page .messages-pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        padding: 18px 24px;
        border-top: 1px solid var(--messages-border);
    }

    .messages-page .pagination {
        flex-wrap: wrap;
        gap: 4px;
        margin: 0;
    }

    .messages-page .page-link {
        border-color: var(--messages-border);
        border-radius: 8px;
        color: var(--messages-primary);
    }

    .messages-page .page-item.active .page-link {
        color: #fff;
        background: var(--messages-primary);
        border-color: var(--messages-primary);
    }

    .messages-page .page-item.disabled .page-link {
        color: #A0AEC0;
    }

    /* KONDISI KOSONG */
    .messages-page .empty-state {
        padding: 56px 24px;
        text-align: center;
    }

    .messages-page .empty-state-icon {
        display: inline-flex;
        width: 72px;
        height: 72px;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        border-radius: 20px;
        background: #EAF3FF;
        color: var(--messages-primary);
        font-size: 30px;
    }

    /* TABLET */
    @media (max-width: 991.98px) {
        .messages-page .messages-card-header {
            padding: 20px;
        }

        .messages-page .messages-pagination {
            padding: 16px 20px;
        }
    }

    /* HP */
    @media (max-width: 767.98px) {
        .messages-page .messages-summary {
            gap: 8px;
        }

        .messages-page .summary-badge {
            padding: 9px 11px;
            font-size: .78rem;
        }

        .messages-page .messages-card {
            border-radius: 14px;
        }

        .messages-page .messages-card-header {
            align-items: flex-start;
            padding: 16px;
        }

        .messages-page .messages-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
            font-size: 19px;
        }

        .messages-page .messages-card-title {
            font-size: 1rem;
        }

        .messages-page .messages-description {
            font-size: .81rem;
        }

        .messages-page .messages-table {
            min-width: 820px;
            font-size: .82rem;
        }

        .messages-page .messages-table thead th {
            padding: 13px 14px;
        }

        .messages-page .messages-table tbody td {
            padding: 14px;
        }

        .messages-page .action-button {
            width: 34px;
            height: 34px;
            flex-basis: 34px;
        }

        .messages-page .messages-pagination {
            align-items: flex-start;
            padding: 16px;
        }

        .messages-page .empty-state {
            padding: 42px 20px;
        }
    }

    @media (max-width: 420px) {
        .messages-page .summary-badge {
            gap: 6px;
            font-size: .74rem;
        }

        .messages-page .messages-card-header {
            padding: 14px;
        }

        .messages-page .messages-pagination {
            padding: 14px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .messages-page *,
        .messages-page *::before,
        .messages-page *::after {
            transition: none !important;
        }
    }
</style>

<div class="container-fluid px-0 messages-page">

    {{-- HEADER HALAMAN --}}
    <section class="dashboard-intro mb-4">
        <p class="eyebrow">CONTENT MANAGEMENT SYSTEM</p>

        <h1 class="page-title">Pesan Masuk</h1>

        <p class="page-description messages-description">
            Kelola pesan yang dikirim melalui formulir kontak website CV Arindah.
        </p>
    </section>

    {{-- RINGKASAN PESAN --}}
    <div class="messages-summary mb-4">
        <div class="summary-badge">
            <i class="bi bi-inbox text-primary"></i>
            <span>Total pesan:</span>
            <strong>{{ $messages->total() }}</strong>
        </div>

        <div class="summary-badge">
            <i class="bi bi-envelope-exclamation" style="color: #B77908;"></i>
            <span>Belum dibaca:</span>
            <strong>{{ $unreadCount }}</strong>
        </div>
    </div>

    {{-- KARTU DAFTAR PESAN --}}
    <section class="messages-card">

        <div class="messages-card-header">
            <div class="messages-icon">
                <i class="bi bi-envelope-paper"></i>
            </div>

            <div class="min-w-0">
                <h5 class="messages-card-title">Daftar Pesan Pengunjung</h5>

                <p class="messages-description mb-0">
                    Lihat pesan, periksa status, dan kelola pesan yang masuk.
                </p>
            </div>
        </div>

        @if($messages->count() > 0)

            <div class="messages-table-wrapper">
                <table class="table messages-table align-middle">
                    <thead>
                        <tr>
                            <th class="number-cell">No.</th>
                            <th>Pengirim</th>
                            <th>Subjek</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="action-cell">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                {{-- NOMOR --}}
                                <td class="number-cell">
                                    {{ $messages->firstItem() + $loop->index }}
                                </td>

                                {{-- PENGIRIM --}}
                                <td class="sender-cell">
                                    <span class="sender-name">
                                        {{ $message->nama }}
                                    </span>

                                    <span class="sender-email">
                                        {{ $message->email }}
                                    </span>
                                </td>

                                {{-- SUBJEK --}}
                                <td class="subject-cell">
                                    {{ ucfirst($message->subjek) }}
                                </td>

                                {{-- TANGGAL --}}
                                <td class="date-cell">
                                    {{ $message->created_at?->format('d/m/Y') ?? '-' }}

                                    <span class="date-time">
                                        {{ $message->created_at?->format('H:i') ?? '' }}
                                    </span>
                                </td>

                                {{-- STATUS --}}
                                <td class="status-cell">
                                    @if($message->is_read)
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
                                </td>

                                {{-- AKSI --}}
                                <td class="action-cell">
                                    <div class="action-buttons">

                                        {{-- LIHAT PESAN --}}
                                        <a
                                            href="{{ route('admin.contact-messages.show', $message->id) }}"
                                            class="action-button action-view"
                                            title="Lihat detail pesan"
                                            aria-label="Lihat detail pesan"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- TANDAI BELUM DIBACA --}}
                                        @if($message->is_read)
                                            <form
                                                action="{{ route('admin.contact-messages.unread', $message->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Tandai pesan ini sebagai belum dibaca?')"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="action-button action-unread"
                                                    title="Tandai belum dibaca"
                                                    aria-label="Tandai belum dibaca"
                                                >
                                                    <i class="bi bi-eye-slash"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- HAPUS PESAN --}}
                                        <form
                                            action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pesan ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-button action-delete"
                                                title="Hapus pesan"
                                                aria-label="Hapus pesan"
                                            >
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($messages->hasPages())
                <div class="messages-pagination">
                    <small class="messages-description">
                        Menampilkan {{ $messages->firstItem() }}–{{ $messages->lastItem() }}
                        dari {{ $messages->total() }} pesan
                    </small>

                    {{ $messages->links() }}
                </div>
            @endif

        @else

            {{-- KONDISI BELUM ADA PESAN --}}
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-inbox"></i>
                </div>

                <h5 class="fw-bold mb-2">Belum Ada Pesan</h5>

                <p class="messages-description mb-0">
                    Pesan yang dikirim melalui formulir kontak website
                    akan ditampilkan di halaman ini.
                </p>
            </div>

        @endif

    </section>

</div>

@endsection
