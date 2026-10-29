
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

<style>
    .admin-dashboard {
        color: #193F6B;
    }

    .admin-dashboard .dashboard-description {
        color: #7B8DA5;
        font-size: .9rem;
        line-height: 1.7;
    }

    /* HERO */
    .admin-dashboard .dashboard-hero {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        min-height: 230px;
        padding: 32px;
        margin-bottom: 22px;
        overflow: hidden;
        border: 1px solid #DCE9FC;
        border-radius: 18px;
        background: linear-gradient(115deg, #EAF3FF 0%, #D0E2FF 100%);
    }

    .admin-dashboard .dashboard-hero-content {
        position: relative;
        z-index: 1;
        max-width: 690px;
    }

    .admin-dashboard .dashboard-hero-label {
        display: inline-block;
        margin-bottom: 12px;
        color: #2866B5;
        font-size: .74rem;
        font-weight: 800;
        letter-spacing: 1.6px;
    }

    .admin-dashboard .dashboard-hero h1 {
        margin: 0 0 12px;
        color: #193F6B;
        font-size: clamp(1.8rem, 3vw, 2.5rem);
        font-weight: 800;
    }

    .admin-dashboard .dashboard-hero p {
        max-width: 620px;
        margin-bottom: 20px;
        color: #526F96;
        font-size: .92rem;
        line-height: 1.8;
    }

    .admin-dashboard .dashboard-hero-decoration {
        position: absolute;
        right: 36px;
        bottom: -38px;
        color: rgba(9, 105, 216, .12);
        font-size: 180px;
        line-height: 1;
        pointer-events: none;
    }

    .admin-dashboard .dashboard-hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .admin-dashboard .dashboard-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 15px;
        border: 1px solid transparent;
        border-radius: 9px;
        font-size: .84rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s ease;
    }

    .admin-dashboard .dashboard-btn-primary {
        background: #286CC1;
        color: #fff;
    }

    .admin-dashboard .dashboard-btn-primary:hover {
        background: #1959A8;
        color: #fff;
        transform: translateY(-1px);
    }

    .admin-dashboard .dashboard-btn-outline {
        border-color: #B9D3F7;
        background: #fff;
        color: #2866B5;
    }

    .admin-dashboard .dashboard-btn-outline:hover {
        background: #F2F7FF;
        color: #194F92;
    }

    /* RINGKASAN */
    .admin-dashboard .dashboard-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 28px;
    }

    .admin-dashboard .summary-card {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 13px;
        min-width: 0;
        min-height: 132px;
        padding: 18px;
        border: 1px solid #E3ECF7;
        border-radius: 15px;
        background: #fff;
        box-shadow: 0 4px 16px rgba(25, 63, 107, .035);
        color: inherit;
        text-decoration: none;
        transition: border-color .2s ease, transform .2s ease;
    }

    .admin-dashboard a.summary-card:hover {
        border-color: #BBD5F8;
        transform: translateY(-2px);
    }

    .admin-dashboard .summary-icon,
    .admin-dashboard .quick-icon,
    .admin-dashboard .panel-icon {
        display: inline-flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 43px;
        height: 43px;
        border-radius: 12px;
        font-size: 19px;
    }

    .admin-dashboard .summary-icon-blue {
        background: #EAF3FF;
        color: #0969D8;
    }

    .admin-dashboard .summary-icon-teal {
        background: #E8F7F4;
        color: #179B8B;
    }

    .admin-dashboard .summary-icon-slate {
        background: #EEF2F7;
        color: #6A7D94;
    }

    .admin-dashboard .summary-content {
        min-width: 0;
    }

    .admin-dashboard .summary-title {
        margin: 1px 0 5px;
        color: #7186A3;
        font-size: .78rem;
        font-weight: 600;
    }

    .admin-dashboard .summary-number {
        margin: 0 0 5px;
        color: #193F6B;
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.15;
    }

    .admin-dashboard .summary-note {
        display: block;
        color: #8194AE;
        font-size: .75rem;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .summary-arrow {
        position: absolute;
        right: 14px;
        bottom: 13px;
        color: #7C9BC3;
    }

    /* SECTION */
    .admin-dashboard .dashboard-section {
        margin-bottom: 28px;
    }

    .admin-dashboard .dashboard-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 15px;
    }

    .admin-dashboard .dashboard-section-header h2 {
        margin: 0 0 5px;
        color: #193F6B;
        font-size: 1.08rem;
        font-weight: 800;
    }

    .admin-dashboard .dashboard-section-header p {
        margin: 0;
        color: #8191A7;
        font-size: .84rem;
    }

    /* AKSI CEPAT */
    .admin-dashboard .dashboard-quick-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 13px;
    }

    .admin-dashboard .dashboard-quick-card {
        display: flex;
        align-items: center;
        gap: 15px;
        min-width: 0;
        padding: 19px;
        border: 1px solid #E3ECF7;
        border-radius: 14px;
        background: #fff;
        color: inherit;
        text-decoration: none;
        transition: all .2s ease;
    }

    .admin-dashboard a.dashboard-quick-card:hover {
        border-color: #BBD5F8;
        box-shadow: 0 7px 20px rgba(25, 63, 107, .06);
        transform: translateY(-2px);
    }

    .admin-dashboard .quick-icon {
        background: #EAF3FF;
        color: #0969D8;
    }

    .admin-dashboard .dashboard-quick-info {
        flex: 1;
        min-width: 0;
    }

    .admin-dashboard .dashboard-quick-info h3 {
        margin: 0 0 5px;
        color: #193F6B;
        font-size: .92rem;
        font-weight: 750;
    }

    .admin-dashboard .dashboard-quick-info p {
        margin: 0;
        color: #8191A7;
        font-size: .79rem;
        line-height: 1.6;
    }

    .admin-dashboard .dashboard-quick-arrow {
        flex-shrink: 0;
        color: #7D9CC5;
    }

    /* PANEL BAWAH */
    .admin-dashboard .dashboard-bottom-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(0, .9fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .admin-dashboard .dashboard-panel {
        min-width: 0;
        padding: 22px;
        border: 1px solid #E3ECF7;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(25, 63, 107, .035);
    }

    .admin-dashboard .dashboard-panel-heading {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .admin-dashboard .panel-icon {
        background: #EAF3FF;
        color: #0969D8;
    }

    .admin-dashboard .dashboard-panel-heading h2 {
        margin: 0;
        color: #193F6B;
        font-size: 1rem;
        font-weight: 800;
    }

    .admin-dashboard .dashboard-empty-state {
        padding: 25px 18px;
        border-radius: 12px;
        background: #F6F9FD;
        text-align: center;
    }

    .admin-dashboard .dashboard-empty-state > i {
        color: #9AB0CA;
        font-size: 2rem;
    }

    .admin-dashboard .dashboard-empty-state h3 {
        margin: 10px 0 7px;
        color: #5C7391;
        font-size: .9rem;
        font-weight: 750;
    }

    .admin-dashboard .dashboard-empty-state p {
        margin: 0;
        color: #8194AE;
        font-size: .8rem;
        line-height: 1.7;
    }

    .admin-dashboard .activity-list {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .admin-dashboard .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #EDF2F8;
    }

    .admin-dashboard .activity-item:first-child {
        padding-top: 0;
    }

    .admin-dashboard .activity-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .admin-dashboard .activity-dot {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: #EAF3FF;
        color: #0969D8;
    }

    .admin-dashboard .activity-item strong {
        display: block;
        margin-bottom: 3px;
        color: #385777;
        font-size: .84rem;
    }

    .admin-dashboard .activity-item p {
        margin: 0;
        color: #8194AE;
        font-size: .77rem;
        line-height: 1.6;
        overflow-wrap: anywhere;
    }

    .admin-dashboard .activity-item small {
        display: block;
        margin-top: 5px;
        color: #96A6BA;
        font-size: .72rem;
    }

    .admin-dashboard .dashboard-tips-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .admin-dashboard .dashboard-tips-list li {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        color: #7186A3;
        font-size: .83rem;
        line-height: 1.7;
    }

    .admin-dashboard .dashboard-tips-list i {
        flex-shrink: 0;
        margin-top: 3px;
        color: #22A079;
    }

    @media (max-width: 1199.98px) {
        .admin-dashboard .dashboard-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .admin-dashboard .dashboard-hero {
            padding: 24px 20px;
        }

        .admin-dashboard .dashboard-hero-decoration {
            right: -12px;
            bottom: -20px;
            font-size: 120px;
        }

        .admin-dashboard .dashboard-summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .admin-dashboard .summary-card {
            flex-direction: column;
            padding: 14px;
        }

        .admin-dashboard .dashboard-quick-grid,
        .admin-dashboard .dashboard-bottom-grid {
            grid-template-columns: 1fr;
        }

        .admin-dashboard .dashboard-panel {
            padding: 18px;
        }
    }

    @media (max-width: 420px) {
        .admin-dashboard .dashboard-summary-grid {
            grid-template-columns: 1fr;
        }

        .admin-dashboard .dashboard-hero-actions .dashboard-btn {
            width: 100%;
        }
    }
</style>

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
     style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">

    <div style="display:flex; align-items:center; gap:12px;">
        <span class="panel-icon">
            <i class="bi bi-clock-history"></i>
        </span>
        <h2 style="margin:0;">Aktivitas Terbaru</h2>
    </div>

    <a href="{{ route('admin.activity-logs.index') }}"
       style="font-size:.8rem; font-weight:700; color:#286CC1; text-decoration:none;">
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
