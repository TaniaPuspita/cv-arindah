@extends('admin.layouts.app')

@section('title', 'Riwayat Aktivitas Admin | CV Arindah')
@section('page-title', 'Riwayat Aktivitas Admin')

@section('content')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/activity-logs/index.css') }}">
@endpush

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
