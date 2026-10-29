@extends('admin.layouts.app')

@section('title', 'Riwayat Aktivitas Admin | CV Arindah')
@section('page-title', 'Riwayat Aktivitas Admin')

@section('content')

<style>
    .activity-page {
        color: #193F6B;
    }

    .activity-page .activity-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 22px;
    }

    .activity-page .activity-header h2 {
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .activity-page .activity-header p {
        margin: 0;
        color: #8191A7;
        font-size: .88rem;
    }

    .activity-page .activity-card {
        background: #fff;
        border: 1px solid #E3ECF7;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(25, 63, 107, .035);
    }

    .activity-page .activity-toolbar {
        padding: 20px;
        border-bottom: 1px solid #EAF0F7;
    }

    .activity-page .search-form {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .activity-page .search-form input {
        flex: 1;
        min-width: 200px;
        min-height: 43px;
        border: 1px solid #D9E4F2;
        border-radius: 9px;
        padding: 10px 13px;
        outline: none;
        color: #193F6B;
    }

    .activity-page .search-form input:focus {
        border-color: #4388E2;
        box-shadow: 0 0 0 3px rgba(67, 136, 226, .1);
    }

    .activity-page .btn-activity {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 15px;
        border-radius: 9px;
        text-decoration: none;
        font-size: .84rem;
        font-weight: 700;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .activity-page .btn-primary-custom {
        background: #286CC1;
        color: #fff;
    }

    .activity-page .btn-primary-custom:hover {
        background: #1959A8;
        color: #fff;
    }

    .activity-page .btn-light-custom {
        background: #fff;
        color: #42658D;
        border-color: #D9E4F2;
    }

    .activity-page .btn-light-custom:hover {
        background: #F4F8FD;
        color: #193F6B;
    }

    .activity-page .activity-count {
        padding: 14px 20px;
        color: #7186A3;
        font-size: .82rem;
        border-bottom: 1px solid #EAF0F7;
    }

    .activity-page .activity-list {
        padding: 0 20px;
    }

    .activity-page .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 20px 0;
        border-bottom: 1px solid #EDF2F8;
    }

    .activity-page .activity-item:last-child {
        border-bottom: 0;
    }

    .activity-page .activity-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        border-radius: 12px;
        background: #EAF3FF;
        color: #0969D8;
        font-size: 18px;
    }

    .activity-page .activity-detail {
        flex: 1;
        min-width: 0;
    }

    .activity-page .activity-title {
        margin: 0 0 6px;
        color: #294E75;
        font-size: .92rem;
        font-weight: 750;
        overflow-wrap: anywhere;
    }

    .activity-page .activity-description {
        margin: 0 0 7px;
        color: #7186A3;
        font-size: .82rem;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .activity-page .activity-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 8px 14px;
        color: #96A6BA;
        font-size: .75rem;
    }

    .activity-page .activity-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .activity-page .activity-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 9px;
        border-radius: 20px;
        background: #EAF3FF;
        color: #2866B5;
        font-size: .72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    .activity-page .empty-state {
        padding: 55px 20px;
        text-align: center;
        color: #8194AE;
    }

    .activity-page .empty-state i {
        font-size: 2.5rem;
        color: #9AB0CA;
    }

    .activity-page .empty-state h3 {
        margin: 13px 0 7px;
        color: #526F96;
        font-size: 1rem;
        font-weight: 800;
    }

    .activity-page .empty-state p {
        margin: 0;
        font-size: .85rem;
    }

    .activity-page .pagination-wrapper {
        padding: 18px 20px;
        border-top: 1px solid #EAF0F7;
    }

    .activity-page .pagination-wrapper nav > div:first-child {
        color: #7186A3;
        font-size: .8rem;
        margin-bottom: 12px;
    }

    .activity-page .pagination {
        margin: 0;
        flex-wrap: wrap;
        gap: 4px;
    }

    .activity-page .page-link {
        color: #2866B5;
        border-color: #DCE7F5;
        border-radius: 7px;
        font-size: .82rem;
    }

    .activity-page .page-item.active .page-link {
        background: #286CC1;
        border-color: #286CC1;
        color: #fff;
    }

    @media (max-width: 575px) {
        .activity-page .activity-toolbar {
            padding: 15px;
        }

        .activity-page .activity-list {
            padding: 0 15px;
        }

        .activity-page .activity-item {
            gap: 10px;
        }

        .activity-page .activity-icon {
            width: 36px;
            height: 36px;
        }

        .activity-page .activity-badge {
            white-space: normal;
        }
    }
</style>

<div class="container-fluid px-0 activity-page">

    <div class="activity-header">
        <div>
            <h2>Riwayat Aktivitas</h2>
            <p>
                Lihat perubahan yang tercatat selama pengelolaan CMS CV Arindah.
            </p>
        </div>

        <a href="{{ route('dashboard') }}"
           class="btn-activity btn-light-custom">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Dashboard
        </a>
    </div>

    <section class="activity-card">

        <div class="activity-toolbar">
            <form action="{{ route('admin.activity-logs.index') }}"
                  method="GET"
                  class="search-form">

                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari aktivitas, nama admin, atau bagian CMS..."
                    aria-label="Cari riwayat aktivitas"
                >

                <button type="submit"
                        class="btn-activity btn-primary-custom">
                    <i class="bi bi-search"></i>
                    Cari
                </button>

                @if(!empty($search))
                    <a href="{{ route('admin.activity-logs.index') }}"
                       class="btn-activity btn-light-custom">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="activity-count">
            <i class="bi bi-clock-history me-1"></i>
            @if($activities->total() > 0)
                Menampilkan {{ $activities->firstItem() }}
               –{{ $activities->lastItem() }}
                dari {{ $activities->total() }} aktivitas.
            @else
                Belum ada aktivitas yang sesuai dengan pencarian.
            @endif
        </div>

        @if($activities->isNotEmpty())

            <div class="activity-list">
                @foreach($activities as $activity)
                    <article class="activity-item">

                        <div class="activity-icon">
                            <i class="bi bi-pencil-square"></i>
                        </div>

                        <div class="activity-detail">
                            <h3 class="activity-title">
                                {{ $activity->description ?: 'Aktivitas admin' }}
                            </h3>

                            <p class="activity-description">
                                {{ class_basename($activity->model_type) }}
                                @if($activity->model_id)
                                    · ID {{ $activity->model_id }}
                                @endif
                            </p>

                            <div class="activity-meta">
                                <span>
                                    <i class="bi bi-person"></i>
                                    {{ $activity->user_name
                                        ?: optional($activity->user)->name
                                        ?: 'Administrator' }}
                                </span>

                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ optional($activity->created_at)->format('d/m/Y H:i') ?? '-' }}
                                </span>
                            </div>
                        </div>

                        <span class="activity-badge">
                            {{ ucfirst($activity->action ?: 'update') }}
                        </span>

                    </article>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $activities->links() }}
            </div>

        @else

            <div class="empty-state">
                <i class="bi bi-journal-text"></i>
                <h3>Riwayat belum tersedia</h3>
                <p>
                    Aktivitas yang berhasil dicatat akan muncul di halaman ini.
                </p>
            </div>

        @endif

    </section>

</div>

@endsection
