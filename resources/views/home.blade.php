@extends('layouts.app')

@section('title', 'CV Arindah')

@section('content')





{{-- =========================================================
    1. HERO BERANDA CV ARINDAH
    - Konten terhubung dengan CMS
    - Desain asli tetap dipertahankan
    - Deskripsi panjang dibatasi agar tidak melebar
========================================================= --}}

@php
    // LABEL / NAMA PERUSAHAAN
    $heroLabel = $hero->label ?? 'CV ARINDAH';

    // JUDUL HERO
    $heroTitle = $hero->title
        ?? 'Solusi Produk & Kebutuhan Teknologi Bisnis Anda';

    // DESKRIPSI HERO
    $heroDescription = $hero->description
        ?? 'Menyediakan berbagai kebutuhan produk dan perlengkapan untuk mendukung kebutuhan pelanggan.';

    // GAMBAR HERO: gunakan gambar CMS atau gambar bawaan
    $heroImage = !empty($hero->image)
        ? asset('storage/' . $hero->image)
        : asset('images/hero.png.png');

    // TOMBOL HERO
    $heroButtonText = $hero->button_text ?? 'Lihat Produk';
    $heroButtonLink = $hero->button_link ?? '#produk';

    // Pisahkan judul untuk mempertahankan warna biru pada frasa ini
    $heroTitleParts = explode('Kebutuhan Teknologi', $heroTitle, 2);
@endphp

<section id="beranda"
    class="relative isolate scroll-mt-24 overflow-hidden bg-[#EAF4FF]">


{{-- =========================================================
    GAMBAR HERO DESKTOP
    Tinggi gambar dibuat tetap agar tidak mengikuti
    panjang konten teks Hero.
========================================================= --}}
    <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-[58%] lg:block"
        aria-hidden="true">

        {{-- GAMBAR DESKTOP DENGAN TINGGI LEBIH BESAR --}}
        <div class="absolute right-0 top-0 h-[540px] w-full overflow-hidden">
            <img
                src="{{ $heroImage }}"
                alt=""
                class="h-full w-full object-cover object-[center_center]">

            {{-- GRADASI KIRI --}}
            <div class="absolute inset-0 bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/55 to-transparent"></div>

            {{-- GRADASI BAWAH --}}
            <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-[#EAF4FF]/35 to-transparent"></div>
            </div>

</div>


    {{-- =====================================================
        KONTEN HERO
    ====================================================== --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-6 sm:px-10 lg:px-8">

        <div class="flex items-center py-8 sm:py-10 lg:min-h-[470px] lg:py-12">

            {{-- BATAS AREA TEKS HERO --}}
            <div class="w-full min-w-0 max-w-[460px] lg:max-w-[470px]">

                {{-- LABEL / NAMA PERUSAHAAN DARI CMS --}}
                <p class="text-sm font-bold uppercase leading-6 tracking-wide text-[#0969D8]">
                    {{ $heroLabel }}
                </p>

                {{-- =================================================
                    JUDUL HERO DARI CMS
                    Warna dan pemisahan baris tetap dipertahankan
                ================================================== --}}
                <h1 class="mt-3 max-w-[460px] text-[34px] font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-[42px] lg:text-[46px] xl:text-[50px]">

                    @if (count($heroTitleParts) === 2)
                        {{ trim($heroTitleParts[0]) }}

                        <span class="block text-[#0969D8]">
                            Kebutuhan Teknologi
                        </span>

                        {{ trim($heroTitleParts[1]) }}
                    @else
                        {{ $heroTitle }}
                    @endif

                </h1>

                {{-- =================================================
                    DESKRIPSI HERO DARI CMS
                    Batasi lebar dan pecah kata yang terlalu panjang
                ================================================== --}}
                @if (!empty($heroDescription))
                    <p class="mt-5 w-full max-w-[390px] break-words text-sm leading-6 text-[#4F6683] sm:text-base sm:leading-7 [overflow-wrap:anywhere]">
                        {{ $heroDescription }}
                    </p>
                @endif

                {{-- =================================================
                    TOMBOL HERO DARI CMS
                    Desain dan efek hover asli tetap dipertahankan
                ================================================== --}}
                <div class="mt-6 flex flex-wrap items-center gap-3">

                    <a
                        href="{{ $heroButtonLink }}"
                        class="inline-flex items-center justify-center rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200">
                        {{ $heroButtonText }}
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>




{{-- =========================================================
    2. TENTANG KAMI (TERHUBUNG DENGAN CMS TENTANG KAMI)
    - Desain asli tetap dipertahankan
    - Jika data CMS kosong, teks dan gambar bawaan dipakai
========================================================= --}}
@php
    // LABEL DAN JUDUL
    $aboutLabel = $about?->label ?: 'TENTANG KAMI';
    $aboutTitle = $about?->title ?: 'MENGENAL CV ARINDAH';

    // PARAGRAF DESKRIPSI
    if ($about) {
        $aboutParagraphs = array_values(array_filter([
            $about->paragraph_one,
            $about->paragraph_two,
        ], fn ($text) => filled($text)));
    } else {
        $aboutParagraphs = [
            'CV Arindah bergerak dalam berbagai bidang perdagangan eceran, termasuk komputer dan perlengkapan, peralatan listrik, alat tulis, furniture, audio dan video, serta kebutuhan laboratorium dan kesehatan.',
            'Selain itu, CV Arindah juga memiliki aktivitas di bidang teknologi informasi dan jasa komputer lainnya.',
        ];
    }

    // GAMBAR: dari CMS atau gambar bawaan
    $aboutImage = !empty($about?->image)
        ? asset('storage/' . $about->image)
        : asset('images/tentang_kami.jpeg');

    // TIGA KATEGORI BIDANG USAHA
    $aboutCategories = [
        $about?->category_one   ?: 'Komputer & Perlengkapan',
        $about?->category_two   ?: 'Elektronik & Furniture',
        $about?->category_three ?: 'Teknologi Informasi',
    ];
@endphp

<section id="tentang" class="bg-white py-16 lg:py-20">
    <div class="mx-auto grid max-w-[1296px] items-center gap-12 px-6 lg:grid-cols-[1fr_1.15fr] lg:px-8">
        <div class="relative">
            <div class="absolute -bottom-5 left-5 h-[110px] w-[110px] rounded-[18px] bg-[#EEF7FF]"></div>

            <img src="{{ $aboutImage }}"
                 alt="Tentang CV Arindah"
                 class="relative z-10 h-[300px] w-full rounded-[14px] object-cover shadow-sm sm:h-[360px]">
        </div>

        <div>
            <p class="text-sm font-bold tracking-wide text-[#0969D8]">{{ $aboutLabel }}</p>

            <h2 class="mt-3 text-3xl font-bold leading-tight text-[#123B68]">
                {{ $aboutTitle }}
            </h2>

            @if (count($aboutParagraphs))
                <div class="mt-4 max-w-[650px] space-y-3 text-sm leading-6 text-[#64748B]">
                    @foreach ($aboutParagraphs as $paragraph)
                        <p>
                            {{ $paragraph }}
                        </p>
                    @endforeach
                </div>
            @endif

            <div class="mt-7 grid grid-cols-3 gap-4 sm:gap-6">
                @foreach ($aboutCategories as $aboutCategory)
                    <div>
                        {{-- Baris baru otomatis setelah tanda "&" agar tampilan tetap seperti semula --}}
                        <p class="text-sm font-bold leading-5 text-[#123B68]">
                            {!! str_replace('&amp; ', '&amp;<br>', e($aboutCategory)) !!}
                        </p>
                        <div class="mt-4 h-[2px] w-16 bg-[#C9DCFF]"></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


{{-- =========================================================
    3. PRODUK (TERHUBUNG DENGAN CMS PRODUK)
    - Kartu dibuat otomatis dari tabel product_categories
    - Jika tabel kosong, enam kartu bawaan tetap ditampilkan
========================================================= --}}
@php
    // Fungsi bantu: gambar bawaan (folder images/) atau upload CMS (storage)
    $resolveImage = function ($path, $fallback) {
        if (empty($path)) {
            return asset($fallback);
        }

        return str_starts_with($path, 'images/')
            ? asset($path)
            : asset('storage/' . $path);
    };

    // Data bawaan (dipakai jika CMS belum berisi kategori)
    $produkDefaults = [
        [
            'name'        => 'Komputer & Teknologi',
            'description' => 'Komputer, laptop, printer, aksesori, dan berbagai perlengkapan teknologi lainnya.',
            'image'       => 'images/komputer_teknologi.jpg',
        ],
        [
            'name'        => 'Elektronik & Furniture',
            'description' => 'Peralatan listrik, penerangan, elektronik, serta furniture untuk berbagai kebutuhan.',
            'image'       => 'images/furnitur.jpg',
        ],
        [
            'name'        => 'Perlengkapan Kantor',
            'description' => 'Alat tulis, perlengkapan administrasi, dan kebutuhan penunjang aktivitas kantor.',
            'image'       => 'images/perlengkapan_kantor.jpg',
        ],
        [
            'name'        => 'Audio & Video',
            'description' => 'Berbagai peralatan audio, video, dan perlengkapan untuk kebutuhan pribadi maupun profesional.',
            'image'       => 'images/kamera_audio.jpg',
        ],
        [
            'name'        => 'Laboratorium & Kesehatan',
            'description' => 'Peralatan laboratorium, farmasi, dan perlengkapan kesehatan sesuai kebutuhan.',
            'image'       => 'images/laboratorium_kesehatan.jpg',
        ],
        [
            'name'        => 'Kebutuhan Sehari-hari',
            'description' => 'Berbagai kebutuhan sehari-hari, seperti makanan, minuman, pakaian, kosmetik, dan produk lainnya.',
            'image'       => 'images/kebutuhan sehari-hari.jpg',
        ],
    ];

    // Susun daftar kartu: dari CMS jika ada, jika tidak pakai bawaan
    if ($categories->isNotEmpty()) {
        $produkItems = $categories->values()->map(function ($category, $index) use ($produkDefaults, $resolveImage) {
            $default = $produkDefaults[$index % count($produkDefaults)];

            return [
                'name'        => $category->name,
                'description' => $category->description,
                'image'       => $resolveImage($category->image, $default['image']),
            ];
        })->all();
    } else {
        $produkItems = array_map(fn ($item) => [
            'name'        => $item['name'],
            'description' => $item['description'],
            'image'       => asset($item['image']),
        ], $produkDefaults);
    }
@endphp

<section id="produk" class="bg-[#EEF7FF] py-16 lg:py-20">
    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">

        {{-- HEADER SECTION --}}
        <div class="mb-9 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">

            <div>
                <p class="text-sm font-bold tracking-wide text-[#0969D8]">
                    PRODUK KAMI
                </p>

                <h2 class="mt-3 text-3xl font-bold leading-tight text-[#123B68] lg:text-4xl">
                    Kategori Produk
                </h2>

                <p class="mt-3 max-w-[650px] text-sm leading-6 text-[#64748B]">
                    Temukan berbagai kategori produk yang kami sediakan
                    untuk mendukung kebutuhan Anda.
                </p>
            </div>

            {{-- SATU TOMBOL UNTUK SEMUA PRODUK --}}
            <div class="shrink-0">
                <a
                    href="{{ route('produk') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-[#0969D8] bg-white px-5 py-3 text-sm font-semibold text-[#0969D8] shadow-sm transition duration-300 hover:-translate-y-1 hover:bg-[#0969D8] hover:text-white hover:shadow-md focus:outline-none focus:ring-4 focus:ring-blue-200">

                    Lihat Semua Produk

                    <svg
                        class="h-4 w-4 transition-transform duration-300 group-hover:translate-x-1"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        aria-hidden="true">

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12h14m-6-6 6 6-6 6">
                        </path>
                    </svg>
                </a>
            </div>

        </div>

        {{-- GRID KATEGORI PRODUK (DARI CMS) --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @foreach ($produkItems as $produk)
                <article class="group overflow-hidden rounded-2xl border border-[#E0EBF8] bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">

                    <div class="overflow-hidden">
                        <img
                            src="{{ $produk['image'] }}"
                            alt="{{ $produk['name'] }}"
                            loading="lazy"
                            class="h-[210px] w-full object-cover transition duration-500 group-hover:scale-105">
                    </div>

                    <div class="p-5 sm:p-6">
                        <span class="inline-flex rounded-full bg-[#EAF4FF] px-3 py-1 text-xs font-semibold text-[#0969D8]">
                            Kategori {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>

                        <h3 class="mt-3 text-lg font-bold text-[#123B68]">
                            {{ $produk['name'] }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-[#64748B]">
                            {{ $produk['description'] }}
                        </p>
                    </div>
                </article>
            @endforeach

        </div>

    </div>
</section>


{{-- =========================================================
    4. LAYANAN KAMI (TERHUBUNG DENGAN CMS LAYANAN)
    - Kartu layanan dibuat otomatis dari tabel homepage_services
    - Jika tabel kosong, tiga layanan bawaan tetap ditampilkan
    - Ikon tetap memakai ikon bawaan desain
========================================================= --}}
@php
    // Ikon bawaan desain (dipakai bergantian sesuai urutan kartu)
    $serviceIcons = [
        '<rect x="3" y="4" width="18" height="13" rx="1.5"/><path d="M8 21h8M12 17v4"/>',
        '<path d="M9.7 3.6h4.6l.5 2.1c.4.2.8.4 1.2.7l2-.9 2.3 2.3-.9 2c.3.4.5.8.7 1.2l2.1.5v4.6l-2.1.5c-.2.4-.4.8-.7 1.2l.9 2-2.3 2.3-2-.9c-.4.3-.8.5-1.2.7l-.5 2.1H9.7l-.5-2.1c-.4-.2-.8-.4-1.2-.7l-2 .9-2.3-2.3.9-2c-.3-.4-.5-.8-.7-1.2l-2.1-.5v-4.6l2.1-.5c.2-.4.4-.8.7-1.2l-.9-2L6 5.5l2 .9c.4-.3.8-.5 1.2-.7l.5-2.1Z"/><circle cx="12" cy="13.8" r="3"/>',
        '<circle cx="12" cy="12" r="9"/><path d="m8 12 2.5 2.5L16.5 9"/>',
    ];

    // Data bawaan (dipakai jika CMS belum berisi layanan)
    $serviceNames = $services->isNotEmpty()
        ? $services->pluck('name')->values()->all()
        : [
            "Pengadaan Perangkat\nKomputer & Jaringan",
            'Kebutuhan Teknologi',
            "Solusi Kebutuhan\nUsaha & Operasional",
        ];
@endphp

<section id="layanan" class="bg-white py-16 lg:py-20">
    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1fr_0.95fr] lg:items-center">
            <div>
                <p class="text-sm font-bold tracking-wide text-[#0969D8]">LAYANAN KAMI</p>

                <h2 class="mt-3 max-w-[600px] text-3xl font-bold leading-tight text-[#123B68]">
                    Teknologi Informasi & Jasa Komputer
                </h2>

                <p class="mt-3 max-w-[570px] text-sm leading-6 text-[#64748B]">
                    CV Arindah menyediakan layanan di bidang teknologi informasi
                    dan jasa komputer untuk mendukung kebutuhan teknologi dan
                    operasional pelanggan.
                </p>

                <div class="relative mt-8 max-w-[570px]">
                    <div class="absolute -bottom-5 right-[-25px] h-[150px] w-[270px] rounded-2xl bg-[#EEF7FF]"></div>

                    <img src="{{ asset('images/layanan_kami.avif') }}"
                         alt="Layanan teknologi informasi CV Arindah"
                         class="relative z-10 h-[285px] w-full rounded-xl object-cover shadow-sm transition duration-700 hover:scale-[1.02]">
                </div>
            </div>

            <div class="space-y-4">
                @foreach ($serviceNames as $serviceName)
                    <div class="flex min-h-[105px] items-center gap-5 rounded-xl bg-white px-5 py-5 shadow-[0_4px_16px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:px-7">
                        <div class="flex h-[62px] w-[62px] shrink-0 items-center justify-center rounded-lg border border-[#C9DCFF] bg-[#F6FAFF]">
                            <svg class="h-7 w-7 text-[#0969D8]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                {!! $serviceIcons[$loop->index % count($serviceIcons)] !!}
                            </svg>
                        </div>
                        <h3 class="text-base font-medium leading-6 text-[#123B68] sm:text-lg">
                            {!! nl2br(e($serviceName)) !!}
                        </h3>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
    5. GALERI
========================================================= --}}
<style>
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 90px;
    }

    #galeri-track {
        transition: transform 900ms cubic-bezier(.22,.8,.24,1);
        will-change: transform;
    }

    #galeri .galeri-slide {
        transition:
            transform 800ms cubic-bezier(.22,.8,.24,1),
            opacity 800ms ease,
            filter 800ms ease,
            box-shadow 400ms ease;
        transform: scale(.93);
        opacity: .72;
        filter: saturate(.85);
    }

    #galeri .galeri-slide.is-active {
        transform: scale(1);
        opacity: 1;
        filter: saturate(1.05);
    }

    #galeri .galeri-slide:hover {
        transform: translateY(-6px) scale(1);
    }

    #galeri .galeri-slide img {
        transform: scale(1.12);
        transition: transform 1600ms cubic-bezier(.22,.8,.24,1);
    }

    #galeri .galeri-slide.is-active img {
        transform: scale(1);
    }

    #galeri .galeri-nav {
        transition:
            transform 250ms ease,
            background-color 250ms ease,
            color 250ms ease;
    }

    #galeri .galeri-nav:active {
        transform: translateY(-50%) scale(.9);
    }

    #galeri-viewport {
        cursor: grab;
        touch-action: pan-y;
    }

    #galeri-viewport.is-dragging {
        cursor: grabbing;
    }

    #galeri-viewport.is-dragging #galeri-track {
        transition: none;
    }

    /* Animasi UX untuk bagian halaman */
    @media (prefers-reduced-motion: no-preference) {
        .ux-reveal {
            opacity: 0;
            transform: translateY(22px);
            transition:
                opacity 700ms cubic-bezier(.22,.8,.24,1),
                transform 700ms cubic-bezier(.22,.8,.24,1);
            transition-delay: var(--ux-delay, 0ms);
        }

        .ux-reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        #beranda h1,
        #beranda p,
        #beranda a,
        #beranda img {
            animation: ux-hero-enter 850ms cubic-bezier(.22,.8,.24,1) both;
        }

        #beranda p { animation-delay: 80ms; }
        #beranda h1 { animation-delay: 160ms; }
        #beranda a { animation-delay: 260ms; }
        #beranda img { animation-delay: 180ms; }

        #beranda img {
            transform-origin: center;
            transition: transform 700ms cubic-bezier(.22,.8,.24,1);
        }

        #beranda img:hover {
            transform: scale(1.025);
        }

        #produk img {
            transition: transform 650ms cubic-bezier(.22,.8,.24,1);
        }

        #produk .group:hover img {
            transform: scale(1.04);
        }

        #tentang img,
        #layanan img {
            transition: transform 700ms cubic-bezier(.22,.8,.24,1);
        }

        #tentang img:hover,
        #layanan img:hover {
            transform: scale(1.025);
        }

        #kontak a {
            transition:
                transform 300ms ease,
                box-shadow 300ms ease,
                background-color 300ms ease;
        }

        #kontak a:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(9,105,216,.2);
        }
    }

    @keyframes ux-hero-enter {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        html {
            scroll-behavior: auto;
        }

        *,
        *::before,
        *::after {
            animation-duration: .01ms !important;
            animation-iteration-count: 1 !important;
            scroll-behavior: auto !important;
            transition-duration: .01ms !important;
        }
    }
</style>

<section id="galeri" class="overflow-hidden bg-[#F3F8FE] py-14 lg:py-16">
    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="text-center">
            <p class="text-sm font-bold tracking-[2px] text-[#0969D8]">
                GALERI
            </p>

            <h2 class="mt-2 text-3xl font-bold text-[#123B68] lg:text-4xl">
                Dokumentasi CV Arindah
            </h2>

            <p class="mx-auto mt-3 max-w-[560px] text-sm leading-6 text-[#64748B]">
                Lihat dokumentasi produk, perlengkapan, dan aktivitas layanan CV Arindah.
            </p>
        </div>

        {{-- GALERI SLIDER --}}
        <div class="relative mt-6">

            {{-- PANAH KIRI --}}
            <button
                type="button"
                id="galeri-prev"
                aria-label="Foto sebelumnya"
                class="galeri-nav absolute left-0 top-1/2 z-50 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-xl text-[#123B68] shadow-lg hover:bg-[#0969D8] hover:text-white sm:left-2 sm:h-12 sm:w-12"
            >
                &#8592;
            </button>

            {{-- VIEWPORT FOTO --}}
            <div id="galeri-viewport" class="overflow-hidden px-1 py-5 sm:px-4">
                <div id="galeri-track" class="relative flex items-center gap-4 sm:gap-5">

                    @forelse ($galeris as $galeri)
                        @php
                            $ukuranKartu = match ($loop->index % 5) {
                                0 => 'h-[210px] w-[75%] sm:h-[260px] sm:w-[38%] lg:h-[265px] lg:w-[25%]',
                                1 => 'h-[250px] w-[78%] sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]',
                                2 => 'h-[290px] w-[85%] sm:h-[340px] sm:w-[48%] lg:h-[360px] lg:w-[34%]',
                                3 => 'h-[250px] w-[78%] sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]',
                                default => 'h-[210px] w-[75%] sm:h-[260px] sm:w-[38%] lg:h-[265px] lg:w-[25%]',
                            };

                            $urlFoto = str_starts_with($galeri->image, 'images/')
                                ? asset($galeri->image)
                                : asset('storage/' . $galeri->image);
                        @endphp

                        <div
                            class="galeri-slide relative {{ $ukuranKartu }} shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-xl"
                            data-galeri-slide
                        >
                            <img
                                src="{{ $urlFoto }}"
                                alt="{{ $galeri->alt_text ?: $galeri->title }}"
                                class="h-full w-full object-cover"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                draggable="false"
                            >
                        </div>
                    @empty
                        <div class="w-full py-10 text-center text-slate-500">
                            Belum ada foto galeri yang aktif.
                        </div>
                    @endforelse

                </div>
            </div>

            {{-- PANAH KANAN --}}
            <button
                type="button"
                id="galeri-next"
                aria-label="Foto berikutnya"
                class="galeri-nav absolute right-0 top-1/2 z-50 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-xl text-[#123B68] shadow-lg hover:bg-[#0969D8] hover:text-white sm:right-2 sm:h-12 sm:w-12"
            >
                &#8594;
            </button>
        </div>

        {{-- COUNTER FOTO --}}
        <div class="mt-2 flex items-center justify-center gap-3">
            <span
                id="galeri-counter"
                class="text-xs font-medium text-slate-500"
            >
                {{ $galeris->isNotEmpty() ? '1 / ' . $galeris->count() : '0 / 0' }}
            </span>

            <div class="h-1.5 w-24 overflow-hidden rounded-full bg-[#DCE8F7]">
                <div
                    id="galeri-progress"
                    class="h-full rounded-full bg-[#0969D8]"
                    style="width: {{ $galeris->isNotEmpty() ? 100 / $galeris->count() : 0 }}%; transition: width 700ms cubic-bezier(.22,.8,.24,1);"
                ></div>
            </div>
        </div>

        {{-- TOMBOL JELAJAHI GALERI --}}
        <div class="mt-6 flex justify-center">
            <a
                href="{{ route('galeri') }}"
                class="inline-flex items-center rounded-xl bg-[#0969D8] px-7 py-3.5 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075bb8] hover:shadow-lg"
            >
                Jelajahi Galeri
            </a>
        </div>

    </div>
</section>


{{-- =========================================================
    6. CTA / KONTAK
========================================================= --}}
<section id="kontak" class="relative overflow-hidden py-16 lg:py-20">

    @php
        $ctaImage = $kontak?->background_image;

        $ctaImageUrl = $ctaImage
            ? (
                str_starts_with($ctaImage, 'homepage/')
                    ? asset('storage/' . $ctaImage)
                    : asset($ctaImage)
            )
            : asset('images/cta_beranda.jpg');
    @endphp

    {{-- GAMBAR LATAR CTA --}}
    <img src="{{ $ctaImageUrl }}"
         alt=""
         class="absolute inset-0 h-full w-full object-cover">

    <div class="absolute inset-0 bg-slate-950/65"></div>

    <div class="relative mx-auto flex min-h-[390px] max-w-[1296px] items-center justify-center px-6 lg:px-8">

        <div class="w-full max-w-[820px] rounded-2xl bg-white px-8 py-12 text-center shadow-[0_10px_35px_rgba(0,0,0,0.18)] lg:px-16">

            {{-- LABEL CTA --}}
            <p class="text-xs font-semibold tracking-wide text-[#0969D8]">
                {{ $kontak?->label ?? 'KONTAK' }}
            </p>

            {{-- JUDUL CTA --}}
            <h2 class="mt-4 text-2xl font-bold leading-tight text-[#123B68] sm:text-3xl">
                {{ $kontak?->title ?? 'Mari Terhubung dengan CV Arindah' }}
            </h2>

            {{-- DESKRIPSI CTA --}}
            <p class="mx-auto mt-3 max-w-[560px] text-sm leading-6 text-[#64748B]">
                {{ $kontak?->description ?? 'Punya kebutuhan produk atau layanan? Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai kebutuhan Anda.' }}
            </p>

            {{-- TOMBOL CTA --}}
            <a href="{{ $kontak?->button_link ?? 'mailto:cv.arindah2016@gmail.com' }}"
               class="mt-7 inline-flex items-center justify-center rounded-lg bg-[#0969D8] px-8 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-1 hover:bg-[#075bb8]">
                {{ $kontak?->button_text ?? 'Hubungi Kami' }}
            </a>

        </div>
    </div>
</section>


{{-- =========================================================
    7. SCRIPT NAVIGASI GALERI
========================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const viewport = document.getElementById('galeri-viewport');
    const track = document.getElementById('galeri-track');
    const prevBtn = document.getElementById('galeri-prev');
    const nextBtn = document.getElementById('galeri-next');
    const counter = document.getElementById('galeri-counter');
    const progress = document.getElementById('galeri-progress');

    if (!viewport || !track || !prevBtn || !nextBtn) return;

    const slides = Array.from(track.querySelectorAll('.galeri-slide'));
    if (!slides.length) return;

    let current = 0;
    let startX = 0;
    let dragging = false;
    let moved = 0;
    let baseX = 0;
    let resizeTimer;

    function maxScroll() {
        return Math.max(0, track.scrollWidth - viewport.clientWidth);
    }

    function getMaxIndex() {
        const max = maxScroll();
        const index = slides.findIndex(slide => slide.offsetLeft >= max - 1);

        return index === -1 ? slides.length - 1 : index;
    }

    function update() {
        const maxIndex = getMaxIndex();
        current = Math.max(0, Math.min(current, maxIndex));

        const x = Math.min(slides[current].offsetLeft, maxScroll());
        track.style.transform = `translate3d(${-x}px, 0, 0)`;

        // Tentukan foto yang paling dekat dengan bagian tengah viewport.
        const center = x + viewport.clientWidth / 2;
        let active = 0;
        let best = Infinity;

        slides.forEach((slide, index) => {
            const distance = Math.abs(
                slide.offsetLeft + slide.offsetWidth / 2 - center
            );

            if (distance < best) {
                best = distance;
                active = index;
            }
        });

        slides.forEach((slide, index) => {
            slide.classList.toggle('is-active', index === active);
        });

        if (counter) {
            counter.textContent = `${active + 1} / ${slides.length}`;
        }

        if (progress) {
            progress.style.width = `${((active + 1) / slides.length) * 100}%`;
        }

        prevBtn.disabled = current === 0;
        nextBtn.disabled = current >= maxIndex;

        prevBtn.classList.toggle('opacity-40', prevBtn.disabled);
        nextBtn.classList.toggle('opacity-40', nextBtn.disabled);
        prevBtn.classList.toggle('cursor-not-allowed', prevBtn.disabled);
        nextBtn.classList.toggle('cursor-not-allowed', nextBtn.disabled);
    }

    function go(direction) {
        current += direction;
        update();
    }

    prevBtn.addEventListener('click', () => go(-1));
    nextBtn.addEventListener('click', () => go(1));

    // Geser foto dengan mouse atau sentuhan.
    viewport.addEventListener('pointerdown', function (event) {
        if (event.pointerType === 'mouse' && event.button !== 0) return;

        dragging = true;
        startX = event.clientX;
        moved = 0;
        baseX = Math.min(slides[current].offsetLeft, maxScroll());

        viewport.classList.add('is-dragging');

        if (viewport.setPointerCapture) {
            viewport.setPointerCapture(event.pointerId);
        }
    });

    viewport.addEventListener('pointermove', function (event) {
        if (!dragging) return;

        moved = event.clientX - startX;

        const nextPosition = Math.max(
            0,
            Math.min(baseX - moved, maxScroll())
        );

        track.style.transform = `translate3d(${-nextPosition}px, 0, 0)`;
    });

    function endDrag() {
        if (!dragging) return;

        dragging = false;
        viewport.classList.remove('is-dragging');

        if (moved < -50) {
            current += 1;
        } else if (moved > 50) {
            current -= 1;
        }

        update();
    }

    viewport.addEventListener('pointerup', endDrag);
    viewport.addEventListener('pointercancel', endDrag);

    // Navigasi keyboard.
    document.addEventListener('keydown', function (event) {
        const target = event.target;

        if (
            target &&
            ['INPUT', 'TEXTAREA', 'SELECT'].includes(target.tagName)
        ) {
            return;
        }

        if (event.key === 'ArrowLeft') go(-1);
        if (event.key === 'ArrowRight') go(1);
    });

    // Hitung ulang posisi slider saat ukuran layar berubah.
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(update, 120);
    });

    window.addEventListener('load', update);

    // Perbarui posisi setelah gambar selesai dimuat.
    slides.forEach(slide => {
        const img = slide.querySelector('img');

        if (img && !img.complete) {
            img.addEventListener('load', update, { once: true });
            img.addEventListener('error', update, { once: true });
        }
    });

    update();
});

// Animasi UX saat konten mulai terlihat di layar.
document.addEventListener('DOMContentLoaded', function () {
    const revealTargets = document.querySelectorAll(
        '#tentang > div, #produk > div > div, #produk .grid > div, ' +
        '#layanan > div > div, #kontak > div > div'
    );

    revealTargets.forEach(function (element, index) {
        element.classList.add('ux-reveal');
        element.style.setProperty('--ux-delay', `${(index % 4) * 80}ms`);
    });

    if (!('IntersectionObserver' in window)) {
        revealTargets.forEach(element => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(function (entries, currentObserver) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                currentObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -35px 0px'
    });

    revealTargets.forEach(element => observer.observe(element));
});
</script>

@endsection