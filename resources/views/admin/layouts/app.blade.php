<!DOCTYPE html>
<html lang="id">
<head>
    {{-- FAVICON CMS ADMIN CV ARINDAH --}}
    <link
        rel="icon"
        type="image/png"
        href="{{ asset('images/cv arindah.png') }}"
    >

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin CV Arindah')</title>

    {{-- FONT INTER --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- BOOTSTRAP --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- BOOTSTRAP ICONS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    {{-- CSS ADMIN --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    {{-- CSS TAMBAHAN DARI HALAMAN --}}
    @stack('styles')
</head>

<body>

    {{-- OVERLAY SIDEBAR UNTUK MOBILE --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- SIDEBAR ADMIN --}}
    <aside class="sidebar" id="adminSidebar">

        {{-- BRAND / LOGO CV ARINDAH --}}
        <a href="{{ route('dashboard') }}" class="brand">

            <img
                src="{{ asset('images/cv arindah.png') }}"
                alt="Logo CV Arindah"
                onerror="this.style.display='none'"
            >

            <div>
                <p class="brand-name">CV Arindah</p>
                <p class="brand-caption">ADMIN PANEL</p>
            </div>

        </a>

        {{-- LABEL MENU --}}
        <p class="nav-label">MENU UTAMA</p>

        {{-- NAVIGASI ADMIN --}}
        <nav class="admin-navigation" aria-label="Navigasi admin">

            {{-- DASHBOARD --}}
            <a
                href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                @if(request()->routeIs('dashboard'))
                    aria-current="page"
                @endif
            >
                <span class="nav-icon">
                    <i class="bi bi-grid-1x2"></i>
                </span>
                <span>Dashboard</span>
            </a>

            {{-- STATUS DROPDOWN CMS BERANDA --}}
            @php
                $cmsBerandaAktif =
                    request()->routeIs('admin.homepage-hero.*') ||
                    request()->routeIs('admin.homepage-about.*') ||
                    request()->routeIs('admin.product-categories.*') ||
                    request()->routeIs('admin.homepage-services.*') ||
                    request()->routeIs('admin.homepage-galeris.*') ||
                    request()->routeIs('admin.homepage-kontak.*');
            @endphp

            {{-- DROPDOWN CMS BERANDA --}}
            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsBerandaAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsBerandaMenu"
                aria-controls="cmsBerandaMenu"
                aria-expanded="{{ $cmsBerandaAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon">
                    <i class="bi bi-layers"></i>
                </span>

                <span class="cms-menu-label">CMS Beranda</span>

                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            {{-- SUBMENU CMS BERANDA --}}
            <div
                id="cmsBerandaMenu"
                class="collapse {{ $cmsBerandaAktif ? 'show' : '' }}"
            >
                <div class="cms-submenu">

                    {{-- HERO BERANDA --}}
                    <a
                        href="{{ route('admin.homepage-hero.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-hero.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.homepage-hero.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Beranda</span>
                    </a>

                    {{-- TENTANG KAMI UNTUK SECTION BERANDA --}}
                    <a
                        href="{{ route('admin.homepage-about.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-about.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.homepage-about.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-info-circle"></i>
                        <span>Tentang Kami</span>
                    </a>

                    {{-- PRODUK --}}
                    <a
                        href="{{ route('admin.product-categories.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.product-categories.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-box-seam"></i>
                        <span>Produk</span>
                    </a>

                    {{-- LAYANAN --}}
                    <a
                        href="{{ route('admin.homepage-services.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-services.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.homepage-services.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-gear"></i>
                        <span>Layanan</span>
                    </a>

                    {{-- GALERI --}}
                    <a
                        href="{{ route('admin.homepage-galeris.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-galeris.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.homepage-galeris.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-images"></i>
                        <span>Galeri</span>
                    </a>

                    {{-- KONTAK / CTA --}}
                    <a
                        href="{{ route('admin.homepage-kontak.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-kontak.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.homepage-kontak.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-chat-square-text"></i>
                        <span>Kontak / CTA</span>
                    </a>

                </div>
            </div>

            {{-- STATUS DROPDOWN CMS TENTANG KAMI --}}
            @php
                $cmsTentangAktif =
                    request()->routeIs('admin.about-page.*');
            @endphp

            {{-- DROPDOWN CMS HALAMAN TENTANG KAMI --}}
            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsTentangAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsTentangMenu"
                aria-controls="cmsTentangMenu"
                aria-expanded="{{ $cmsTentangAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon">
                    <i class="bi bi-building"></i>
                </span>

                <span class="cms-menu-label">Halaman Tentang Kami</span>

                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            {{-- SUBMENU TENTANG KAMI --}}
            <div
                id="cmsTentangMenu"
                class="collapse {{ $cmsTentangAktif ? 'show' : '' }}"
            >
                <div class="cms-submenu">

                    <a
                        href="{{ route('admin.about-page.section.edit', 'hero') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'hero' ? 'active' : '' }}"
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Tentang Kami</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'profil') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'profil' ? 'active' : '' }}"
                    >
                        <i class="bi bi-building"></i>
                        <span>Profil Perusahaan</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'informasi') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'informasi' ? 'active' : '' }}"
                    >
                        <i class="bi bi-grid"></i>
                        <span>Informasi Utama</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'visi-misi') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'visi-misi' ? 'active' : '' }}"
                    >
                        <i class="bi bi-bullseye"></i>
                        <span>Visi &amp; Misi</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'cta') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'cta' ? 'active' : '' }}"
                    >
                        <i class="bi bi-telephone"></i>
                        <span>Kontak / CTA</span>
                    </a>

                </div>
            </div>

            

{{-- ==========================================
     CMS HALAMAN PRODUK & LAYANAN
========================================== --}}

@php
    $cmsProdukLayananAktif =
        request()->routeIs('admin.produk-layanan.*');

    $cmsDetailKategoriAktif =
        request()->routeIs('admin.produk-layanan.detail-kategori.*');
@endphp

<button
    type="button"
    class="nav-link cms-menu-toggle {{ $cmsProdukLayananAktif ? 'active' : '' }}"
    data-bs-toggle="collapse"
    data-bs-target="#cmsProdukLayananMenu"
    aria-controls="cmsProdukLayananMenu"
    aria-expanded="{{ $cmsProdukLayananAktif ? 'true' : 'false' }}"
>
    <span class="nav-icon">
        <i class="bi bi-box-seam"></i>
    </span>

    <span class="cms-menu-label">
        Halaman Produk &amp; Layanan
    </span>

    <i class="bi bi-chevron-down cms-chevron"></i>
</button>

<div
    id="cmsProdukLayananMenu"
    class="collapse {{ $cmsProdukLayananAktif ? 'show' : '' }}"
>
    <div class="cms-submenu">

        {{-- 1. HERO PRODUK & LAYANAN --}}
        <a
            href="{{ route('admin.produk-layanan.hero.edit') }}"
            class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan.hero.*') ? 'active' : '' }}"
        >
            <i class="bi bi-image"></i>
            <span>Hero Produk &amp; Layanan</span>
        </a>

        {{-- 2. KATEGORI PRODUK --}}
        <a
            href="{{ route('admin.produk-layanan.categories.index') }}"
            class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan.categories.*') ? 'active' : '' }}"
        >
            <i class="bi bi-grid"></i>
            <span>Kategori Produk</span>
        </a>


        
        
{{-- DETAIL KATEGORI PRODUK --}}
<a
    href="#cmsDetailKategoriMenu"
    class="cms-submenu-link {{ $cmsDetailKategoriAktif ? 'active' : '' }}"
    data-bs-toggle="collapse"
    role="button"
    aria-expanded="{{ $cmsDetailKategoriAktif ? 'true' : 'false' }}"
    aria-controls="cmsDetailKategoriMenu"
>
    <i class="bi bi-folder2-open"></i>
    <span>Detail Kategori Produk</span>
    <i class="bi bi-chevron-down cms-chevron"></i>
</a>

<div
    id="cmsDetailKategoriMenu"
    class="collapse {{ $cmsDetailKategoriAktif ? 'show' : '' }}"
>
    <div class="cms-submenu">

        {{-- 1. KOMPUTER & TEKNOLOGI --}}
<a
    href="{{ route('admin.produk-layanan.category-details.edit', 1) }}"
    class="cms-submenu-link {{ isset($category) && (int) $category->id === 1 ? 'active' : '' }}"
>
    <i class="bi bi-pc-display"></i>
    <span>Komputer &amp; Teknologi</span>
</a>

{{-- 2. ELEKTRONIK & FURNITURE --}}
<a
    href="{{ route('admin.produk-layanan.category-details.edit', 2) }}"
    class="cms-submenu-link {{ isset($category) && (int) $category->id === 2 ? 'active' : '' }}"
>
    <i class="bi bi-display"></i>
    <span>Elektronik &amp; Furniture</span>
</a>

{{-- 3. PERLENGKAPAN KANTOR --}}
<a
    href="{{ route('admin.produk-layanan.category-details.edit', 3) }}"
    class="cms-submenu-link {{ isset($category) && (int) $category->id === 3 ? 'active' : '' }}"
>
    <i class="bi bi-briefcase"></i>
    <span>Perlengkapan Kantor</span>
</a>

{{-- 4. AUDIO & VIDEO --}}
<a
    href="{{ route('admin.produk-layanan.category-details.edit', 4) }}"
    class="cms-submenu-link {{ isset($category) && (int) $category->id === 4 ? 'active' : '' }}"
>
    <i class="bi bi-camera-video"></i>
    <span>Audio &amp; Video</span>
</a>

{{-- 5. LABORATORIUM & KESEHATAN --}}
<a
    href="{{ route('admin.produk-layanan.category-details.edit', 5) }}"
    class="cms-submenu-link {{ isset($category) && (int) $category->id === 5 ? 'active' : '' }}"
>
    <i class="bi bi-heart-pulse"></i>
    <span>Laboratorium &amp; Kesehatan</span>
</a>

{{-- 6. KEBUTUHAN SEHARI-HARI --}}
<a
    href="{{ route('admin.produk-layanan.category-details.edit', 6) }}"
    class="cms-submenu-link {{ isset($category) && (int) $category->id === 6 ? 'active' : '' }}"
>
    <i class="bi bi-basket"></i>
    <span>Kebutuhan Sehari-hari</span>
</a>

    </div>
</div>



        {{-- 4. LAYANAN KAMI --}}
        <a
            href="{{ route('admin.produk-layanan.layanan-items.index') }}"
            class="cms-submenu-link {{ request()->routeIs('admin.homepage-services.*') ? 'active' : '' }}"
        >
            <i class="bi bi-gear"></i>
            <span>Layanan Kami</span>
        </a>

        {{-- 5. CTA / HUBUNGI KAMI --}}
        <a
            href="{{ route('admin.produk-layanan.cta.edit') }}"
            class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan*') ? 'active' : '' }}"
        >
            <i class="bi bi-telephone"></i>
            <span>CTA / Hubungi Kami</span>
        </a>

    </div>
</div>

            
            
            
            {{-- DROPDOWN CMS GALERI PUBLIK --}}
            @php
                $cmsGaleriAktif = request()->routeIs(
                    'admin.public-galeri-heroes.*',
                    'admin.public-galeri-items.*'
                );
            @endphp

            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsGaleriAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsGaleriMenu"
                aria-controls="cmsGaleriMenu"
                aria-expanded="{{ $cmsGaleriAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon">
                    <i class="bi bi-images"></i>
                </span>

                <span class="cms-menu-label">CMS Galeri</span>

                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            {{-- SUBMENU CMS GALERI --}}
            <div
                id="cmsGaleriMenu"
                class="collapse {{ $cmsGaleriAktif ? 'show' : '' }}"
            >
                <div class="cms-submenu">

                    {{-- HERO GALERI --}}
                    <a
                        href="{{ route('admin.public-galeri-heroes.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.public-galeri-heroes.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.public-galeri-heroes.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-window"></i>
                        <span>Hero Galeri</span>
                    </a>

                    {{-- DAFTAR FOTO --}}
                    <a
                        href="{{ route('admin.public-galeri-items.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.public-galeri-items.*') ? 'active' : '' }}"
                        @if(request()->routeIs('admin.public-galeri-items.*'))
                            aria-current="page"
                        @endif
                    >
                        <i class="bi bi-card-image"></i>
                        <span>Daftar Foto</span>
                    </a>

                </div>
            </div>

            
            {{-- ==========================================
                CMS HALAMAN KONTAK
            ========================================== --}}

            @php
                $cmsKontakAktif = request()->routeIs(
                    'admin.contact-page.*'
                );

                $pesanMasukAktif = request()->routeIs(
                    'admin.contact-messages.*'
                );
            @endphp

            {{-- DROPDOWN CMS KONTAK --}}
            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsKontakAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsKontakMenu"
                aria-controls="cmsKontakMenu"
                aria-expanded="{{ $cmsKontakAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon">
                    <i class="bi bi-envelope-paper"></i>
                </span>

                <span class="cms-menu-label">CMS Kontak</span>

                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            {{-- SUBMENU CMS KONTAK --}}
            <div
                id="cmsKontakMenu"
                class="collapse {{ $cmsKontakAktif ? 'show' : '' }}"
            >
                <div class="cms-submenu">

                    {{-- 1. HERO KONTAK --}}
                    <a
                        href="{{ route('admin.contact-page.section.edit', 'hero') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'hero' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Kontak</span>
                    </a>

                    {{-- 2. INFORMASI KONTAK --}}
                    <a
                        href="{{ route('admin.contact-page.section.edit', 'informasi') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'informasi' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-telephone"></i>
                        <span>Informasi Kontak</span>
                    </a>

                    {{-- 3. FORMULIR KIRIM PESAN --}}
                    <a
                        href="{{ route('admin.contact-page.section.edit', 'formulir') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'formulir' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-chat-square-text"></i>
                        <span>Formulir Kirim Pesan</span>
                    </a>

                    {{-- 4. LOKASI KAMI --}}
                    <a
                        href="{{ route('admin.contact-page.section.edit', 'lokasi') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'lokasi' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-geo-alt"></i>
                        <span>Lokasi Kami</span>
                    </a>

                    {{-- 5. CTA KONTAK --}}
                    <a
                        href="{{ route('admin.contact-page.section.edit', 'cta') }}"
                        class="cms-submenu-link {{ request()->route('section') === 'cta' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-megaphone"></i>
                        <span>CTA Kontak</span>
                    </a>

                </div>
            </div>

            {{-- ==========================================
                MENU PESAN MASUK
            ========================================== --}}

            <a
                href="{{ route('admin.contact-messages.index') }}"
                class="nav-link {{ $pesanMasukAktif ? 'active' : '' }}"
                @if($pesanMasukAktif)
                    aria-current="page"
                @endif
            >
                <span class="nav-icon">
                    <i class="bi bi-inbox"></i>
                </span>

                <span>Pesan Masuk</span>
            </a>




            {{-- CMS FOOTER: MENU UTAMA TERSENDIRI --}}
            <a
                href="{{ route('admin.homepage-footer.edit') }}"
                class="nav-link {{ request()->routeIs('admin.homepage-footer.*') ? 'active' : '' }}"
                @if(request()->routeIs('admin.homepage-footer.*'))
                    aria-current="page"
                @endif
            >
                <span class="nav-icon">
                    <i class="bi bi-layout-text-window"></i>
                </span>
                <span>CMS Footer</span>
            </a>

        </nav>

        {{-- BAGIAN BAWAH SIDEBAR --}}
        <div class="sidebar-bottom">

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </button>
            </form>

        </div>

    </aside>

    {{-- AREA UTAMA DI SISI KANAN --}}
    <div class="main">

        {{-- TOPBAR --}}
        <header class="topbar">

            <div class="topbar-left">

                {{-- TOMBOL MENU MOBILE --}}
                <button
                    type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Buka navigasi"
                    aria-controls="adminSidebar"
                    aria-expanded="false"
                >
                    <i class="bi bi-list"></i>
                </button>

                {{-- JUDUL HALAMAN --}}
                <div>
                    <h2>@yield('page-title', 'Dashboard Admin')</h2>
                    <p>Pengelolaan konten CV Arindah</p>
                </div>

            </div>

            {{-- IDENTITAS ADMIN --}}
            <div class="admin-badge">
                <i class="bi bi-person-circle"></i>
                Administrator
            </div>

        </header>

        {{-- KONTEN HALAMAN --}}
        <main class="content">

            {{-- NOTIFIKASI BERHASIL --}}
            @if(session('success'))
                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                >
                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Tutup"
                    ></button>
                </div>
            @endif

            {{-- NOTIFIKASI ERROR --}}
            @if(session('error'))
                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                >
                    {{ session('error') }}

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Tutup"
                    ></button>
                </div>
            @endif

            {{-- VALIDASI FORM --}}
            @if($errors->any())
                <div class="alert alert-danger" role="alert">

                    <strong>
                        Periksa kembali data yang kamu masukkan:
                    </strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            {{-- KONTEN DASHBOARD ATAU HALAMAN CMS --}}
            @yield('content')

        </main>

        {{-- FOOTER ADMIN --}}
        <footer class="footer">
            &copy; {{ date('Y') }} CV Arindah. Admin Panel.
        </footer>

    </div>

 
{{-- JAVASCRIPT BOOTSTRAP --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- JAVASCRIPT ADMIN: SIDEBAR MOBILE DAN FITUR LAIN --}}
<script src="{{ asset('js/admin.js') }}?v=2"></script>


    {{-- SCRIPT TAMBAHAN DARI HALAMAN --}}
    @stack('scripts')

    {{-- PENGATURAN NOTIFIKASI HILANG SETELAH 5 DETIK --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.alert-success').forEach(function (alert) {
                setTimeout(function () {
                    if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                        bootstrap.Alert.getOrCreateInstance(alert).close();
                    }
                }, 5000);
            });
        });
    </script>

</body>
</html>
