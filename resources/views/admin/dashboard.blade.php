
@extends('admin.layouts.app')

@section('title', 'Dashboard Admin | CV Arindah')
@section('page-title', 'Dashboard Admin')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA DASHBOARD
    |--------------------------------------------------------------------------
    | Data statistik dan aktivitas dikirim oleh DashboardController.
    | Nilai fallback digunakan agar halaman tidak error jika data belum tersedia.
    */

    $totalPages = $totalPages ?? 5;
    $totalCategories = $totalCategories ?? 5;
    $todayActivities = $todayActivities ?? 0;
    $recentActivities = $recentActivities ?? collect();

    $unreadMessages = $unreadMessages ?? 0;
    $totalMessages = $totalMessages ?? 0;

    $quickLinks = [
        [
            'title' => 'Beranda',
            'description' => 'Kelola konten utama halaman beranda.',
            'icon' => 'bi-house',
            'route' => 'admin.homepage-hero.edit',
            'available' => true,
        ],
        [
            'title' => 'Tentang Kami',
            'description' => 'Kelola profil dan informasi perusahaan.',
            'icon' => 'bi-building',
            'route' => 'admin.about-page.edit',
            'available' => true,
        ],
        [
            'title' => 'Produk & Layanan',
            'description' => 'Kelola kategori produk dan informasi layanan.',
            'icon' => 'bi-box-seam',
            'route' => 'admin.produk-layanan.hero.edit',
            'available' => true,
        ],
        [
            'title' => 'Galeri',
            'description' => 'Kelola foto dan dokumentasi perusahaan.',
            'icon' => 'bi-images',
            'route' => 'admin.public-galeri-heroes.edit',
            'available' => true,
        ],
        [
            'title' => 'Kontak',
            'description' => 'Kelola informasi kontak dan formulir pesan.',
            'icon' => 'bi-envelope',
            'route' => 'admin.contact-page.section.edit',
            'section' => 'hero',
            'available' => true,
        ],
    ];

    $tips = [
        'Gunakan gambar berkualitas baik dan sesuai identitas perusahaan.',
        'Pastikan judul dan deskripsi mudah dipahami pengunjung.',
        'Periksa kembali konten sebelum menyimpan perubahan.',
        'Periksa website publik setelah memperbarui konten.',
    ];
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/admin/dashboard.css') }}">
@endpush

<div class="container-fluid px-0 admin-dashboard">

    {{-- BANNER SAMBUTAN --}}
    <section class="dashboard-hero">
        <div class="dashboard-hero-content">
            <span class="dashboard-hero-label">SELAMAT DATANG</span>

            <h1>Administrator</h1>

            <p>
                Kelola konten website CV Arindah dengan mudah melalui
                panel admin. Pastikan informasi selalu terbaru agar
                tampilan website tetap optimal dan profesional.
            </p>

            <div class="dashboard-hero-actions">
                <a href="{{ route('admin.homepage-hero.edit') }}"
                   class="dashboard-btn dashboard-btn-primary">
                    <i class="bi bi-gear"></i>
                    Mulai Kelola Konten
                </a>

                <a href="{{ url('/') }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="dashboard-btn dashboard-btn-outline">
                    <i class="bi bi-box-arrow-up-right"></i>
                    Lihat Website
                </a>
            </div>
        </div>

        <div class="dashboard-hero-decoration" aria-hidden="true">
            <i class="bi bi-buildings"></i>
        </div>
    </section>

    {{-- RINGKASAN DINAMIS --}}
    <section class="dashboard-summary-grid">

        <article class="summary-card">
            <div class="summary-icon summary-icon-blue">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="summary-content">
                <p class="summary-title">Ringkasan Halaman</p>
                <h2 class="summary-number">{{ $totalPages }}</h2>
                <span class="summary-note">
                    Beranda, Tentang, Produk, Galeri, dan Kontak
                </span>
            </div>
        </article>

        <article class="summary-card">
            <div class="summary-icon summary-icon-teal">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="summary-content">
                <p class="summary-title">Aktivitas Admin Hari Ini</p>
                <h2 class="summary-number">
                    {{ $todayActivities > 0 ? $todayActivities : '—' }}
                </h2>
                <span class="summary-note">
                    {{ $todayActivities > 0
                        ? 'Aktivitas tercatat hari ini'
                        : 'Belum ada aktivitas yang tercatat' }}
                </span>
            </div>
        </article>

        <article class="summary-card">
            <div class="summary-icon summary-icon-slate">
                <i class="bi bi-layers"></i>
            </div>
            <div class="summary-content">
                <p class="summary-title">Kategori CMS</p>
                <h2 class="summary-number">{{ $totalCategories }}</h2>
                <span class="summary-note">
                    Bagian utama website yang dikelola
                </span>
            </div>
        </article>

        <a href="{{ route('admin.contact-messages.index') }}"
           class="summary-card">
            <div class="summary-icon summary-icon-blue">
                <i class="bi bi-envelope"></i>
            </div>
            <div class="summary-content">
                <p class="summary-title">Pesan Belum Dibaca</p>
                <h2 class="summary-number">{{ $unreadMessages }}</h2>
                <span class="summary-note">
                    Dari {{ $totalMessages }} pesan pengunjung
                </span>
            </div>
            <i class="bi bi-arrow-up-right summary-arrow"></i>
        </a>

    </section>

    {{-- AKSI CEPAT --}}
    <section class="dashboard-section">
        <div class="dashboard-section-header">
            <div>
                <h2>Aksi Cepat</h2>
                <p>Pilih bagian website yang ingin kamu kelola.</p>
            </div>
        </div>

        <div class="dashboard-quick-grid">
            @foreach($quickLinks as $item)
                @php
                    $targetUrl = isset($item['section'])
                        ? route($item['route'], $item['section'])
                        : route($item['route']);
                @endphp

                <a href="{{ $targetUrl }}" class="dashboard-quick-card">
                    <div class="quick-icon">
                        <i class="bi {{ $item['icon'] }}"></i>
                    </div>

                    <div class="dashboard-quick-info">
                        <h3>{{ $item['title'] }}</h3>
                        <p>{{ $item['description'] }}</p>
                    </div>

                    <span class="dashboard-quick-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- AKTIVITAS TERBARU DAN TIPS --}}
    <section class="dashboard-bottom-grid">

        <article class="dashboard-panel">
            <div class="dashboard-panel-heading"
    >

    <div class="blade-static-style-2">
        <span class="panel-icon">
            <i class="bi bi-clock-history"></i>
        </span>
        <h2 class="blade-static-style-3">Aktivitas Terbaru</h2>
    </div>

    <a href="{{ route('admin.activity-logs.index') }}"
       class="blade-static-style-1">
        Lihat Semua
        <i class="bi bi-arrow-right"></i>
    </a>

</div>

            @if($recentActivities->isNotEmpty())
                <div class="activity-list">
                    @foreach($recentActivities as $activity)
                        <div class="activity-item">
                            <span class="activity-dot">
                                <i class="bi bi-pencil-square"></i>
                            </span>

                            <div class="flex-grow-1">
                                <strong>
                                    {{ $activity->description ?? 'Aktivitas admin' }}
                                </strong>

                                <p>
    {{ class_basename($activity->model_type) }}
    @if($activity->model_id)
        · ID {{ $activity->model_id }}
    @endif
</p>

                                <small>
                                    {{ $activity->created_at
                                        ? $activity->created_at->format('d/m/Y H:i')
                                        : '-' }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="dashboard-empty-state">
                    <i class="bi bi-journal-text"></i>
                    <h3>Riwayat aktivitas belum tersedia</h3>
                    <p>
                        Aktivitas perubahan konten akan muncul di sini
                        setelah fitur pencatatan aktivitas admin diaktifkan.
                    </p>
                </div>
            @endif
        </article>

        <article class="dashboard-panel">
            <div class="dashboard-panel-heading">
                <span class="panel-icon">
                    <i class="bi bi-lightbulb"></i>
                </span>
                <h2>Tips Pengelolaan</h2>
            </div>

            <ul class="dashboard-tips-list">
                @foreach($tips as $tip)
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ $tip }}</span>
                    </li>
                @endforeach
            </ul>
        </article>

    </section>

</div>

@endsection
