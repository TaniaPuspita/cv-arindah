@extends('admin.layouts.app')

@section('title', 'Pesan Masuk | CV Arindah')
@section('page-title', 'Pesan Masuk')

@section('content')

<style>
    .messages-page {
        color: #193F6B;
    }

    .messages-page .messages-description {
        color: #7B8DA5;
        font-size: 0.9rem;
        line-height: 1.7;
    }

    .messages-page .messages-card {
        overflow: hidden;
        border: 1px solid #E5EDF6;
        border-radius: 16px;
        background: #FFFFFF;
        box-shadow: 0 6px 24px rgba(27, 69, 109, 0.06);
    }

    .messages-page .messages-card-header {
        padding: 20px 24px;
        border-bottom: 1px solid #E8EEF6;
        background: #FFFFFF;
    }

    .messages-page .messages-icon {
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

    .messages-page .messages-table {
        margin-bottom: 0;
        color: #193F6B;
        font-size: 0.875rem;
    }

    .messages-page .messages-table thead th {
        padding: 16px 18px;
        background: #F5F8FC;
        color: #526782;
        font-size: 0.76rem;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #DFE8F2;
    }

    .messages-page .messages-table tbody td {
        padding: 15px 18px;
        border-bottom: 1px solid #EDF1F6;
        vertical-align: middle;
    }

    .messages-page .messages-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .messages-page .messages-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .messages-page .messages-table tbody tr:hover {
        background: #F8FBFF;
    }

    .messages-page .sender-name {
        color: #193F6B;
        font-weight: 600;
    }

    .messages-page .sender-email {
        display: block;
        margin-top: 4px;
        color: #8292A8;
        font-size: 0.78rem;
        font-weight: 400;
        overflow-wrap: anywhere;
    }

    .messages-page .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: 0.72rem;
        font-weight: 600;
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

    .messages-page .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .messages-page .action-button {
        display: inline-flex;
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 1px solid;
        border-radius: 9px;
        background: #FFFFFF;
        font-size: 15px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.2s ease,
                    color 0.2s ease,
                    border-color 0.2s ease;
    }

    .messages-page .action-view {
        color: #0969D8;
        border-color: #B9D5FF;
    }

    .messages-page .action-view:hover {
        color: #FFFFFF;
        background: #0969D8;
        border-color: #0969D8;
    }

    .messages-page .action-unread {
        color: #B77908;
        border-color: #F2D28B;
    }

    .messages-page .action-unread:hover {
        color: #FFFFFF;
        background: #B77908;
        border-color: #B77908;
    }

    .messages-page .action-delete {
        color: #DC3545;
        border-color: #F0BCC2;
    }

    .messages-page .action-delete:hover {
        color: #FFFFFF;
        background: #DC3545;
        border-color: #DC3545;
    }

    .messages-page .messages-summary {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .messages-page .summary-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 14px;
        border: 1px solid #E1EAF4;
        border-radius: 11px;
        background: #FFFFFF;
        color: #526782;
        font-size: 0.82rem;
        font-weight: 500;
    }

    .messages-page .summary-badge strong {
        color: #193F6B;
        font-weight: 700;
    }

    .messages-page .empty-state {
        padding: 60px 24px;
        text-align: center;
    }

    .messages-page .empty-state-icon {
        display: inline-flex;
        width: 76px;
        height: 76px;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
        border-radius: 22px;
        background: #EAF3FF;
        color: #0969D8;
        font-size: 32px;
    }

    .messages-page .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .messages-page .page-link {
        border-radius: 8px;
        border-color: #E1EAF4;
        color: #0969D8;
    }

    .messages-page .page-item.active .page-link {
        color: #FFFFFF;
        background: #0969D8;
        border-color: #0969D8;
    }

    .messages-page .page-item.disabled .page-link {
        color: #A0AEC0;
    }

    @media (max-width: 767.98px) {
        .messages-page .messages-card-header {
            padding: 16px;
        }

        .messages-page .messages-table thead th,
        .messages-page .messages-table tbody td {
            padding: 12px;
        }

        .messages-page .action-buttons {
            gap: 5px;
        }

        .messages-page .action-button {
            width: 33px;
            height: 33px;
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
            Total pesan:
            <strong>{{ $messages->total() }}</strong>
        </div>

        <div class="summary-badge">
            <i class="bi bi-envelope-exclamation" style="color: #B77908;"></i>
            Belum dibaca:
            <strong>{{ $unreadCount }}</strong>
        </div>

    </div>

    {{-- KARTU DAFTAR PESAN --}}
    <section class="messages-card">

        <div class="messages-card-header">
            <div class="d-flex align-items-center gap-3">

                <div class="messages-icon">
                    <i class="bi bi-envelope-paper"></i>
                </div>

                <div>
                    <h5 class="fw-bold mb-1">Daftar Pesan Pengunjung</h5>

                    <p class="messages-description mb-0">
                        Lihat pesan, periksa status, dan kelola pesan yang masuk.
                    </p>
                </div>

            </div>
        </div>

        @if($messages->count() > 0)

            <div class="table-responsive">
                <table class="table messages-table align-middle">

                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 65px;">No.</th>
                            <th>Pengirim</th>
                            <th>Subjek</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($messages as $message)

                            <tr>
                                {{-- NOMOR --}}
                                <td class="ps-4">
                                    {{ $messages->firstItem() + $loop->index }}
                                </td>

                                {{-- PENGIRIM --}}
                                <td>
                                    <span class="sender-name">
                                        {{ $message->nama }}
                                    </span>

                                    <span class="sender-email">
                                        {{ $message->email }}
                                    </span>
                                </td>

                                {{-- SUBJEK --}}
                                <td>
                                    {{ ucfirst($message->subjek) }}
                                </td>

                                {{-- TANGGAL --}}
                                <td>
                                    <span class="text-nowrap">
                                        {{ $message->created_at?->format('d/m/Y') ?? '-' }}
                                    </span>

                                    <small class="d-block sender-email">
                                        {{ $message->created_at?->format('H:i') ?? '' }}
                                    </small>
                                </td>

                                {{-- STATUS --}}
                                <td>
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
                                <td class="text-center pe-4">
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
                                                class="m-0"
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
                                            class="m-0"
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
                <div class="d-flex justify-content-between align-items-center
                            flex-wrap gap-3 p-4 border-top">

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