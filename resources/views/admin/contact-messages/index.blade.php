
@extends('admin.layouts.app')

@section('title', 'Pesan Masuk | CV Arindah')
@section('page-title', 'Pesan Masuk')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/contact-messages/index.css') }}">
@endpush

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
            <i class="bi bi-envelope-exclamation blade-static-style-1"></i>
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
