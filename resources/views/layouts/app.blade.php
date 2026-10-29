
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CV Arindah')</title>

    {{-- FAVICON LOGO CV ARINDAH --}}
    <link rel="icon" type="image/png" href="{{ asset('images/cv arindah.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/cv arindah.png') }}">

    {{-- FONT INTER --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- TAILWIND DAN VITE --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            overflow-x: clip;
        }

        img {
            display: block;
            max-width: 100%;
        }

        [x-cloak] {
            display: none !important;
        }

        /* NAVBAR DESKTOP */
        .site-header {
            position: relative;
            z-index: 50;
            width: 100%;
            background: #ffffff;
        }

        .nav-link {
            position: relative;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            padding: 10px 0;
            color: #526078;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #0969D8;
        }

        .nav-link.active::after {
            position: absolute;
            right: 0;
            bottom: 2px;
            left: 0;
            height: 3px;
            border-radius: 9999px;
            background: #0969D8;
            content: "";
        }

        /* NAVBAR MOBILE */
        .mobile-link {
            display: block;
            border-radius: 10px;
            padding: 12px 14px;
            color: #526078;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .mobile-link:hover,
        .mobile-link.active {
            background: #EAF4FF;
            color: #0969D8;
        }

        .mobile-menu-panel {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            z-index: 60;
            width: min(88vw, 320px);
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            background: #ffffff;
            padding: 12px;
            box-shadow: 0 16px 40px rgba(15, 40, 70, 0.14);
        }

        .mobile-menu-toggle {
            list-style: none;
        }

        .mobile-menu-toggle::-webkit-details-marker {
            display: none;
        }

        /* RESPONSIVE */
        section {
            scroll-margin-top: 16px;
        }

        a,
        button {
            -webkit-tap-highlight-color: transparent;
        }

        @media (max-width: 639px) {
            section {
                scroll-margin-top: 8px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body class="flex min-h-screen flex-col bg-white text-slate-800 antialiased">

{{-- =====================================================
    NAVBAR
===================================================== --}}
<header class="sticky top-0 z-[100] w-full border-b border-slate-100 bg-white shadow-sm">
    <nav class="mx-auto flex min-h-[78px] max-w-[1440px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

        {{-- LOGO CV ARINDAH --}}
        <a href="{{ route('home') }}"
           class="flex shrink-0 items-center"
           aria-label="CV Arindah - Beranda">
            <img
                src="{{ asset('images/cv arindah.png') }}"
                alt="Logo CV Arindah"
                class="h-12 w-auto object-contain sm:h-14">
        </a>

        {{-- MENU DESKTOP --}}
        <div class="hidden items-center gap-5 lg:flex xl:gap-8">

            <a href="{{ route('home') }}"
               class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
            </a>

            <a href="{{ route('tentang') }}"
               class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                Tentang Kami
            </a>

            <a href="{{ route('produk') }}"
               class="nav-link {{ request()->routeIs('produk', 'produk.*') ? 'active' : '' }}">
                Produk &amp; Layanan
            </a>

            <a href="{{ route('galeri') }}"
               class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}">
                Galeri
            </a>

            <a href="{{ route('kontak') }}"
               class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">
                Kontak
            </a>

            <a href="{{ route('kontak') }}"
               class="inline-flex items-center justify-center rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-300 hover:-translate-y-0.5 hover:bg-[#075BBF]">
                Hubungi Kami
            </a>
        </div>

        {{-- MENU MOBILE --}}
        <details class="group relative lg:hidden">
            <summary
                class="flex h-11 w-11 cursor-pointer list-none items-center justify-center rounded-xl border border-slate-200 bg-white text-[#123B68] transition hover:bg-[#EAF4FF] [&::-webkit-details-marker]:hidden"
                aria-label="Buka menu navigasi">

                {{-- IKON HAMBURGER --}}
                <svg class="h-6 w-6 group-open:hidden"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                {{-- IKON TUTUP --}}
                <svg class="hidden h-6 w-6 group-open:block"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </summary>

            {{-- PANEL MENU MOBILE --}}
            <div class="absolute right-0 top-[calc(100%+12px)] w-[min(88vw,320px)] rounded-2xl border border-slate-100 bg-white p-3 shadow-xl">
                <p class="px-3 pb-2 pt-1 text-xs font-bold uppercase tracking-wider text-slate-400">
                    Menu Navigasi
                </p>

                <a href="{{ route('home') }}"
                   class="mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

                <a href="{{ route('tentang') }}"
                   class="mobile-link {{ request()->routeIs('tentang') ? 'active' : '' }}">Tentang Kami</a>

                <a href="{{ route('produk') }}"
                   class="mobile-link {{ request()->routeIs('produk', 'produk.*') ? 'active' : '' }}">Produk &amp; Layanan</a>

                <a href="{{ route('galeri') }}"
                   class="mobile-link {{ request()->routeIs('galeri') ? 'active' : '' }}">Galeri</a>

                <a href="{{ route('kontak') }}"
                   class="mobile-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a>

                <div class="mt-3 border-t border-slate-100 pt-3">
                    <a href="{{ route('kontak') }}"
                       class="flex w-full items-center justify-center rounded-xl bg-[#0969D8] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#075BBF]">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </details>
    </nav>
</header>

{{-- =====================================================
    KONTEN HALAMAN
===================================================== --}}
<main class="w-full flex-1">
    @yield('content')
</main>

{{-- =====================================================
    FOOTER (DATA DARI CMS FOOTER)
===================================================== --}}
@php
    // Ikon navigasi
    $navIcons = [
        'home' => '<path stroke-linecap="round" stroke-linejoin="round" d="m3 10 9-7 9 7v10a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1z"/>',
        'tentang' => '<circle cx="12" cy="8" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M4 21a8 8 0 0 1 16 0"/>',
        'produk' => '<path stroke-linecap="round" stroke-linejoin="round" d="m12 3 9 5-9 5-9-5 9-5Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m3 12 9 5 9-5M3 16l9 5 9-5"/>',
        'galeri' => '<rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path stroke-linecap="round" stroke-linejoin="round" d="m21 15-5-5L5 21"/>',
        'kontak' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 10c0 5-9 12-9 12S3 15 3 10a9 9 0 1 1 18 0Z"/><circle cx="12" cy="10" r="2.5"/>',
    ];

    $defaultNav = [
        ['route' => 'home', 'label' => 'Beranda'],
        ['route' => 'tentang', 'label' => 'Tentang Kami'],
        ['route' => 'produk', 'label' => 'Produk & Layanan'],
        ['route' => 'galeri', 'label' => 'Galeri'],
        ['route' => 'kontak', 'label' => 'Kontak'],
    ];

    // Data CMS dengan nilai cadangan
    $footerCompany = $footer?->company_name ?: 'CV Arindah';

    $footerDescription = $footer?->description
        ?? 'Menyediakan berbagai kebutuhan produk dan perlengkapan untuk mendukung kebutuhan pelanggan.';

    $footerTags = $footer?->tags ?: ['Teknologi', 'Produk', 'Solusi'];

    $footerNavItems = $footer?->navigation ?: $defaultNav;

    $footerPhone = $footer?->phone ?? '+62 851-0082-1243';
    $footerEmail = $footer?->email ?? 'cv.arindah2016@gmail.com';

    $footerAddress = $footer?->address
        ?? 'Jalan Dewarawati Nomor 23, Mengwitani, Mengwi, Badung, Bali';

    $footerCopyright = $footer?->copyright_text ?? 'CV Arindah. All rights reserved.';
    $footerLocation = $footer?->location_text ?? 'Badung, Bali, Indonesia';

    /*
     * Normalisasi nomor WhatsApp:
     * +62 851... menjadi 62851...
     * 0851... menjadi 62851...
     */
    $whatsappNumber = preg_replace('/\D/', '', $footerPhone);

    if (str_starts_with($whatsappNumber, '0')) {
        $whatsappNumber = '62' . substr($whatsappNumber, 1);
    }

    // Kontak footer
    $footerContact = [];

    // NOMOR TELEPON -> WHATSAPP
    if ($footerPhone) {
        $footerContact[] = [
            'href' => 'https://wa.me/' . $whatsappNumber,
            'label' => $footerPhone,
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.4 19.4 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 2 .7 2.9a2 2 0 0 1-.5 2.1L8 9.9a16 16 0 0 0 6 6l1.2-1.3a2 2 0 0 1 2.1-.5c.9.3 1.9.6 2.9.7a2 2 0 0 1 1.8 2.1Z"/>',
        ];
    }

    // EMAIL -> GMAIL
    if ($footerEmail) {
        $footerContact[] = [
            'href' => 'https://mail.google.com/mail/?view=cm&fs=1&to=' . urlencode($footerEmail),
            'label' => $footerEmail,
            'icon' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="m3 7 9 6 9-6"/>',
        ];
    }

    // ALAMAT -> GOOGLE MAPS
    if ($footerAddress) {
        $footerContact[] = [
            'href' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($footerAddress),
            'label' => $footerAddress,
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 10c0 5-9 12-9 12S3 15 3 10a9 9 0 1 1 18 0Z"/><circle cx="12" cy="10" r="2.5"/>',
        ];
    }
@endphp

<footer class="relative overflow-hidden bg-gradient-to-br from-[#124B89] to-[#0E3D72] text-white">

    {{-- Dekorasi latar --}}
    <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-white/[0.05] blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-24 -left-24 h-64 w-64 rounded-full bg-[#38A3FF]/10 blur-3xl" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-[1440px] px-4 pb-6 pt-12 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 gap-x-12 gap-y-8 sm:grid-cols-2 lg:grid-cols-12">

            {{-- BRAND --}}
            <div class="sm:col-span-2 lg:col-span-5">

                <a href="{{ route('home') }}" class="inline-flex items-center gap-3.5">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-white p-1.5 shadow-md shadow-black/10">
                        @if ($footer?->logo)
                            <img src="{{ asset('storage/' . $footer->logo) }}"
                                 alt="Logo {{ $footerCompany }}"
                                 class="max-h-full max-w-full object-contain">
                        @else
                            <img src="{{ asset('images/cv arindah.png') }}"
                                 alt="Logo {{ $footerCompany }}"
                                 class="max-h-full max-w-full object-contain">
                        @endif
                    </span>

                    <span>
                        <span class="block text-lg font-bold leading-tight tracking-wide">{{ $footerCompany }}</span>
                        <span class="mt-0.5 block text-xs text-white/70">Teknologi dan Solusi Bisnis</span>
                    </span>
                </a>

                @if ($footerDescription)
                    <p class="mt-4 max-w-md text-sm leading-7 text-white/80">
                        {{ $footerDescription }}
                    </p>
                @endif

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($footerTags as $tag)
                        <span class="rounded-full border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold tracking-wide text-white/90">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>
            </div>

            {{-- NAVIGASI --}}
            <div class="lg:col-span-3">

                <h2 class="flex h-12 items-center text-base font-bold text-white">
                    Jelajahi Website
                </h2>

                <ul class="mt-2 space-y-2.5">
                    @foreach ($footerNavItems as $nav)
                        <li>
                            <a href="{{ route($nav['route']) }}"
                               class="group flex items-center gap-3 text-sm text-white/80 transition hover:text-white">

                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white/10 transition group-hover:bg-white/20">
                                    <svg class="h-4 w-4"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         aria-hidden="true">{!! $navIcons[$nav['route']] ?? $navIcons['home'] !!}</svg>
                                </span>

                                <span class="transition group-hover:translate-x-0.5">
                                    {{ $nav['label'] }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- KONTAK --}}
            <div class="lg:col-span-4">

                <h2 class="flex h-12 items-center text-base font-bold text-white">
                    Hubungi Kami
                </h2>

                <ul class="mt-2 space-y-3.5">
                    @foreach ($footerContact as $c)
                        <li>
                            <a href="{{ $c['href'] }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="group flex items-start gap-3 text-sm leading-6 text-white/80 transition hover:text-white">

                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/10 text-white transition group-hover:bg-white/20">
                                    <svg class="h-4 w-4"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="1.8"
                                         aria-hidden="true">{!! $c['icon'] !!}</svg>
                                </span>

                                <span class="min-w-0 break-words pt-1.5">
                                    {{ $c['label'] }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

        {{-- COPYRIGHT --}}
        <div class="mt-9 border-t border-white/15 pt-5">
            <div class="flex flex-col gap-1.5 text-xs leading-5 text-white/65 sm:flex-row sm:items-center sm:justify-between sm:text-sm">
                <p>&copy; {{ date('Y') }} {{ $footerCopyright }}</p>
                <p>{{ $footerLocation }}</p>
            </div>
        </div>

    </div>
</footer>

</body>
</html>
