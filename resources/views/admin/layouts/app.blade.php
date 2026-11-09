<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin CV Arindah')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/cv arindah.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')
</head>

<body>

    {{-- Ambil semua kategori untuk submenu detail --}}
    @php
        $cmsDetailKategoriProduk = \App\Models\ProdukLayananCategory::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
    @endphp

    {{-- OVERLAY SIDEBAR MOBILE --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- SIDEBAR ADMIN --}}
    <aside class="sidebar" id="adminSidebar">

        {{-- BRAND --}}
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

        <p class="nav-label">MENU UTAMA</p>

        <nav class="admin-navigation" aria-label="Navigasi admin">

            {{-- DASHBOARD --}}
            <a
                href="{{ route('dashboard') }}"
                class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                @if(request()->routeIs('dashboard')) aria-current="page" @endif
            >
                <span class="nav-icon"><i class="bi bi-grid-1x2"></i></span>
                <span>Dashboard</span>
            </a>

            {{-- CMS BERANDA --}}
            @php
                $cmsBerandaAktif = request()->routeIs(
                    'admin.homepage-hero.*',
                    'admin.homepage-about.*',
                    'admin.product-categories.*',
                    'admin.homepage-services.*',
                    'admin.homepage-galeris.*',
                    'admin.homepage-kontak.*'
                );
            @endphp

            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsBerandaAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsBerandaMenu"
                aria-controls="cmsBerandaMenu"
                aria-expanded="{{ $cmsBerandaAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon"><i class="bi bi-layers"></i></span>
                <span class="cms-menu-label">CMS Beranda</span>
                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            <div id="cmsBerandaMenu" class="collapse {{ $cmsBerandaAktif ? 'show' : '' }}">
                <div class="cms-submenu">

                    <a
                        href="{{ route('admin.homepage-hero.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-hero.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Beranda</span>
                    </a>

                    <a
                        href="{{ route('admin.homepage-about.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-about.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-info-circle"></i>
                        <span>Tentang Kami</span>
                    </a>

                    <a
                        href="{{ route('admin.product-categories.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.product-categories.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-box-seam"></i>
                        <span>Produk</span>
                    </a>

                    <a
                        href="{{ route('admin.homepage-services.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-services.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-gear"></i>
                        <span>Layanan</span>
                    </a>

                    <a
                        href="{{ route('admin.homepage-galeris.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-galeris.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-images"></i>
                        <span>Galeri</span>
                    </a>

                    <a
                        href="{{ route('admin.homepage-kontak.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.homepage-kontak.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-chat-square-text"></i>
                        <span>Kontak / CTA</span>
                    </a>

                </div>
            </div>

            {{-- CMS TENTANG KAMI --}}
            @php
                $cmsTentangAktif = request()->routeIs('admin.about-page.*');
                $aboutSection = request()->route('section');
            @endphp

            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsTentangAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsTentangMenu"
                aria-controls="cmsTentangMenu"
                aria-expanded="{{ $cmsTentangAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon"><i class="bi bi-building"></i></span>
                <span class="cms-menu-label">Halaman Tentang Kami</span>
                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            <div id="cmsTentangMenu" class="collapse {{ $cmsTentangAktif ? 'show' : '' }}">
                <div class="cms-submenu">

                    <a
                        href="{{ route('admin.about-page.section.edit', 'hero') }}"
                        class="cms-submenu-link {{ $aboutSection === 'hero' && $cmsTentangAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Tentang Kami</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'profil') }}"
                        class="cms-submenu-link {{ $aboutSection === 'profil' && $cmsTentangAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-building"></i>
                        <span>Profil Perusahaan</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'informasi') }}"
                        class="cms-submenu-link {{ $aboutSection === 'informasi' && $cmsTentangAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-grid"></i>
                        <span>Informasi Utama</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'visi-misi') }}"
                        class="cms-submenu-link {{ $aboutSection === 'visi-misi' && $cmsTentangAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-bullseye"></i>
                        <span>Visi &amp; Misi</span>
                    </a>

                    <a
                        href="{{ route('admin.about-page.section.edit', 'cta') }}"
                        class="cms-submenu-link {{ $aboutSection === 'cta' && $cmsTentangAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-telephone"></i>
                        <span>Kontak / CTA</span>
                    </a>

                </div>
            </div>

            {{-- CMS PRODUK & LAYANAN --}}
            @php
                $cmsProdukLayananAktif = request()->routeIs('admin.produk-layanan.*');

                $cmsDetailKategoriAktif = request()->routeIs(
                    'admin.produk-layanan.category-details.*'
                );

                $routeCategory = request()->route('category');

                $activeCategoryId = $routeCategory instanceof \App\Models\ProdukLayananCategory
                    ? (int) $routeCategory->id
                    : (is_numeric($routeCategory) ? (int) $routeCategory : null);
            @endphp

            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsProdukLayananAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsProdukLayananMenu"
                aria-controls="cmsProdukLayananMenu"
                aria-expanded="{{ $cmsProdukLayananAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon"><i class="bi bi-box-seam"></i></span>
                <span class="cms-menu-label">Halaman Produk &amp; Layanan</span>
                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            <div id="cmsProdukLayananMenu" class="collapse {{ $cmsProdukLayananAktif ? 'show' : '' }}">
                <div class="cms-submenu">

                    {{-- HERO PRODUK --}}
                    <a
                        href="{{ route('admin.produk-layanan.hero.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan.hero.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Produk &amp; Layanan</span>
                    </a>

                    {{-- KATEGORI PRODUK --}}
                    <a
                        href="{{ route('admin.produk-layanan.categories.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan.categories.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-grid"></i>
                        <span>Kategori Produk</span>
                    </a>

                    {{-- DROPDOWN DETAIL KATEGORI --}}
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

                            @forelse ($cmsDetailKategoriProduk as $category)
                                @php
                                    $categoryName = strtolower($category->name);

                                    $categoryIcon = match (true) {
                                        str_contains($categoryName, 'komputer'),
                                        str_contains($categoryName, 'teknologi') => 'bi-pc-display',

                                        str_contains($categoryName, 'elektronik'),
                                        str_contains($categoryName, 'furniture') => 'bi-display',

                                        str_contains($categoryName, 'kantor') => 'bi-briefcase',

                                        str_contains($categoryName, 'audio'),
                                        str_contains($categoryName, 'video') => 'bi-camera-video',

                                        str_contains($categoryName, 'laboratorium'),
                                        str_contains($categoryName, 'kesehatan') => 'bi-heart-pulse',

                                        str_contains($categoryName, 'sehari') => 'bi-basket',

                                        str_contains($categoryName, 'berat') => 'bi-truck',

                                        default => 'bi-folder2',
                                    };

                                    $isActiveCategory = $cmsDetailKategoriAktif
                                        && $activeCategoryId === (int) $category->id;
                                @endphp

                                <a
                                    href="{{ route('admin.produk-layanan.category-details.edit', $category) }}"
                                    class="cms-submenu-link {{ $isActiveCategory ? 'active' : '' }}"
                                    @if($isActiveCategory) aria-current="page" @endif
                                >
                                    <i class="bi {{ $categoryIcon }}"></i>
                                    <span>{{ $category->name }}</span>
                                </a>
                            @empty
                                <div class="cms-submenu-link text-muted">
                                    <i class="bi bi-info-circle"></i>
                                    <span>Belum ada kategori produk</span>
                                </div>
                            @endforelse

                        </div>
                    </div>

                    {{-- LAYANAN KAMI --}}
                    <a
                        href="{{ route('admin.produk-layanan.layanan-items.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan.layanan-items.*', 'admin.produk-layanan.layanan.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-gear"></i>
                        <span>Layanan Kami</span>
                    </a>

                    {{-- CTA --}}
                    <a
                        href="{{ route('admin.produk-layanan.cta.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.produk-layanan.cta.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-telephone"></i>
                        <span>CTA / Hubungi Kami</span>
                    </a>

                </div>
            </div>

            {{-- CMS GALERI --}}
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
                <span class="nav-icon"><i class="bi bi-images"></i></span>
                <span class="cms-menu-label">CMS Galeri</span>
                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            <div id="cmsGaleriMenu" class="collapse {{ $cmsGaleriAktif ? 'show' : '' }}">
                <div class="cms-submenu">

                    <a
                        href="{{ route('admin.public-galeri-heroes.edit') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.public-galeri-heroes.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-window"></i>
                        <span>Hero Galeri</span>
                    </a>

                    <a
                        href="{{ route('admin.public-galeri-items.index') }}"
                        class="cms-submenu-link {{ request()->routeIs('admin.public-galeri-items.*') ? 'active' : '' }}"
                    >
                        <i class="bi bi-card-image"></i>
                        <span>Daftar Foto</span>
                    </a>

                </div>
            </div>

            {{-- CMS KONTAK --}}
            @php
                $cmsKontakAktif = request()->routeIs('admin.contact-page.*', 'admin.email-templates.*');
                $pesanMasukAktif = request()->routeIs('admin.contact-messages.*');
                $emailTemplateAktif = request()->routeIs('admin.email-templates.*');
                $contactSection = request()->route('section');
            @endphp

            <button
                type="button"
                class="nav-link cms-menu-toggle {{ $cmsKontakAktif ? 'active' : '' }}"
                data-bs-toggle="collapse"
                data-bs-target="#cmsKontakMenu"
                aria-controls="cmsKontakMenu"
                aria-expanded="{{ $cmsKontakAktif ? 'true' : 'false' }}"
            >
                <span class="nav-icon"><i class="bi bi-envelope-paper"></i></span>
                <span class="cms-menu-label">CMS Kontak</span>
                <i class="bi bi-chevron-down cms-chevron"></i>
            </button>

            <div id="cmsKontakMenu" class="collapse {{ $cmsKontakAktif ? 'show' : '' }}">
                <div class="cms-submenu">

                    <a
                        href="{{ route('admin.contact-page.section.edit', 'hero') }}"
                        class="cms-submenu-link {{ $contactSection === 'hero' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-image"></i>
                        <span>Hero Kontak</span>
                    </a>

                    <a
                        href="{{ route('admin.contact-page.section.edit', 'informasi') }}"
                        class="cms-submenu-link {{ $contactSection === 'informasi' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-telephone"></i>
                        <span>Informasi Kontak</span>
                    </a>

                    <a
                        href="{{ route('admin.contact-page.section.edit', 'formulir') }}"
                        class="cms-submenu-link {{ $contactSection === 'formulir' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-chat-square-text"></i>
                        <span>Formulir Kirim Pesan</span>
                    </a>

                    <a
                        href="{{ route('admin.contact-page.section.edit', 'lokasi') }}"
                        class="cms-submenu-link {{ $contactSection === 'lokasi' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-geo-alt"></i>
                        <span>Lokasi Kami</span>
                    </a>

                    <a
                        href="{{ route('admin.contact-page.section.edit', 'cta') }}"
                        class="cms-submenu-link {{ $contactSection === 'cta' && $cmsKontakAktif ? 'active' : '' }}"
                    >
                        <i class="bi bi-megaphone"></i>
                        <span>CTA Kontak</span>
                    </a>

                    <a
                        href="{{ route('admin.email-templates.index') }}"
                        class="cms-submenu-link {{ $emailTemplateAktif ? 'active' : '' }}"
                        @if($emailTemplateAktif) aria-current="page" @endif
                    >
                        <i class="bi bi-envelope-at"></i>
                        <span>Template Email</span>
                    </a>

                </div>
            </div>

            {{-- PESAN MASUK --}}
            <a
                href="{{ route('admin.contact-messages.index') }}"
                class="nav-link {{ $pesanMasukAktif ? 'active' : '' }}"
                @if($pesanMasukAktif) aria-current="page" @endif
            >
                <span class="nav-icon"><i class="bi bi-inbox"></i></span>
                <span>Pesan Masuk</span>
            </a>

            {{-- CMS FOOTER --}}
            <a
                href="{{ route('admin.homepage-footer.edit') }}"
                class="nav-link {{ request()->routeIs('admin.homepage-footer.*') ? 'active' : '' }}"
                @if(request()->routeIs('admin.homepage-footer.*')) aria-current="page" @endif
            >
                <span class="nav-icon"><i class="bi bi-layout-text-window"></i></span>
                <span>CMS Footer</span>
            </a>

        </nav>

        {{-- LOGOUT --}}
        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Keluar</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- AREA UTAMA --}}
    <div class="main">

        {{-- TOPBAR --}}
        <header class="topbar">
            <div class="topbar-left">

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

                <div>
                    <h2>@yield('page-title', 'Dashboard Admin')</h2>
                    <p>Pengelolaan konten CV Arindah</p>
                </div>
            </div>

            <div class="admin-badge">
                <i class="bi bi-person-circle"></i>
                Administrator
            </div>
        </header>

        {{-- KONTEN --}}
        <main class="content">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Periksa kembali data yang kamu masukkan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </main>

        {{-- FOOTER --}}
        <footer class="footer">
            &copy; {{ date('Y') }} CV Arindah. Admin Panel.
        </footer>

    </div>

    {{-- JAVASCRIPT BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JAVASCRIPT ADMIN --}}
    <script src="{{ asset('js/admin.js') }}?v=4"></script>

    @stack('scripts')

    {{-- NOTIFIKASI --}}
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
