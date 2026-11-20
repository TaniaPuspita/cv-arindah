@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/public/galeri.css') }}">
@endpush

@section('content')

{{-- =========================================================
    DATA GALERI
========================================================= --}}

@php
    $fallbackItems = [
        ['cat' => 'produk', 'img' => 'images/menugaleri/galeri1.jpg', 'title' => 'Produk CV Arindah', 'pos' => 'center'],
        ['cat' => 'produk', 'img' => 'images/menugaleri/gambar2.avif', 'title' => 'Produk dan Perlengkapan', 'pos' => 'center'],
        ['cat' => 'produk', 'img' => 'images/menugaleri/gambar3.jpg', 'title' => 'Perlengkapan Pendukung', 'pos' => 'center'],
        ['cat' => 'produk', 'img' => 'images/menugaleri/gambar4.jpg', 'title' => 'Laboratorium dan Peralatan', 'pos' => 'center'],
        ['cat' => 'jasa', 'img' => 'images/menugaleri/gambar5.jpg', 'title' => 'Aktivitas Teknologi Informasi', 'pos' => 'center'],
        ['cat' => 'jasa', 'img' => 'images/menugaleri/gambar6.jpg', 'title' => 'Presentasi dan Teknologi', 'pos' => 'center'],
        ['cat' => 'jasa', 'img' => 'images/menugaleri/gambar7.jpg', 'title' => 'Konsultasi dan Kerja Sama', 'pos' => 'center'],
        ['cat' => 'jasa', 'img' => 'images/menugaleri/gambar8.jpg', 'title' => 'Layanan Teknologi', 'pos' => 'center'],
    ];

    $catLabel = [
        'produk' => 'Produk',
        'jasa' => 'Jasa & Layanan',
    ];

    $publicDisk = \Illuminate\Support\Facades\Storage::disk('public');

    if (isset($galeris) && $galeris->isNotEmpty()) {
        $items = $galeris->map(function ($foto) use ($publicDisk) {
            return [
                'cat' => $foto->category,
                'img' => str_starts_with($foto->image, 'images/')
                    ? asset($foto->image)
                    : $publicDisk->url($foto->image),
                'title' => $foto->title,
                'pos' => $foto->image_position ?: 'center',
            ];
        })->all();
    } else {
        $items = $fallbackItems;
    }

    $counts = collect($items)->countBy('cat');

    $hero = $hero ?? null;

    /*
     * PENGATURAN HERO GALERI
     * Field Hero terpisah dari field Koleksi.
     */
    $heroEyebrow = $hero?->hero_eyebrow ?: 'Galeri';
    $heroTitle = $hero?->hero_title ?: 'Cerita dalam';
    $heroTitleHighlight = $hero?->title_highlight ?: 'Setiap Visual';

    $heroDescription = $hero?->hero_description
        ?: 'Lihat lebih dekat berbagai produk, aktivitas, dan layanan yang menjadi bagian dari CV Arindah.';

    $heroImage = $hero?->hero_image
        ? $publicDisk->url($hero->hero_image)
        : asset('images/herogaleri.jpg');

    /*
     * PENGATURAN KOLEKSI
     * Tetap menggunakan field CMS yang lama.
     */
    $koleksiEyebrow = $hero?->eyebrow ?: 'Koleksi';

    $koleksiTitle = $hero?->title
        ?: 'Produk, Aktivitas & Layanan Kami';

    $koleksiDescription = $hero?->description
        ?: 'Beragam produk untuk mendukung kebutuhan teknologi, perkantoran, elektronik, dan kebutuhan lainnya.';

    $titleParts = preg_split('/\s*&\s*/', $koleksiTitle, 2);

    $titleFirst = trim($titleParts[0] ?? $koleksiTitle);

    $titleSecond = isset($titleParts[1])
        ? '& ' . trim($titleParts[1])
        : '';
@endphp


{{-- =========================================================
    HERO GALERI
========================================================= --}}

<section class="relative isolate overflow-hidden bg-[#EAF4FF]">

    {{-- Gambar Hero desktop --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-[58%] lg:block"
        aria-hidden="true"
    >
        <img
            src="{{ $heroImage }}"
            alt=""
            class="h-full w-full object-cover object-[60%_center]"
        >

        <div class="absolute inset-y-0 left-0 w-[58%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/85 to-transparent"></div>

        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-[#EAF4FF]/55 to-transparent"></div>
    </div>

    {{-- Gambar Hero mobile --}}
    <div class="relative h-[220px] w-full overflow-hidden sm:h-[280px] lg:hidden">
        <img
            src="{{ $heroImage }}"
            alt="Galeri CV Arindah"
            class="h-full w-full object-cover object-center"
        >

        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#EAF4FF] to-transparent"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8">
        <div class="flex items-center py-8 sm:py-10 lg:min-h-[470px] lg:items-start lg:pt-[50px] lg:pb-12">

            <div class="w-full max-w-[500px]">

                {{-- Label Hero --}}
                <p class="text-xs font-bold uppercase tracking-[0.16em] text-[#0969D8] sm:text-sm">
                    {{ $heroEyebrow }}
                </p>

                {{-- Judul Hero --}}
                <h1 class="mt-3 max-w-[460px] text-[34px] font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-5xl lg:text-[46px] xl:text-[52px]">
                    {{ $heroTitle }}

                    <span class="block text-[#0969D8]">
                        {{ $heroTitleHighlight }}
                    </span>
                </h1>

                {{-- Deskripsi Hero --}}
                <p class="mt-4 max-w-[430px] text-sm leading-6 text-[#4F6683] sm:mt-5 sm:text-base sm:leading-7">
                    {{ $heroDescription }}
                </p>

                {{-- Tombol Hero --}}
                <div class="mt-6 flex flex-wrap items-center gap-3 sm:mt-8">

                    <a
                        href="{{ route('kontak') }}#kontak"
                        class="inline-flex min-h-11 items-center justify-center rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-900/10 transition duration-300 hover:-translate-y-0.5 hover:bg-[#075BBF] hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-200"
                    >
                        Hubungi Kami
                    </a>

                    <a
                        href="#produk-galeri"
                        class="inline-flex min-h-11 items-center justify-center rounded-lg border border-[#9CC3EE] bg-white/80 px-5 py-3 text-sm font-semibold text-[#0969D8] transition duration-300 hover:-translate-y-0.5 hover:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                    >
                        Lihat Galeri
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>


{{-- =========================================================
    GALERI DAN KOLEKSI
========================================================= --}}

<section
    id="produk-galeri"
    class="relative isolate scroll-mt-20 overflow-hidden bg-white px-5 py-16 md:px-6 lg:py-24"
>

    <div
        class="pointer-events-none absolute -left-24 top-10 -z-10 h-72 w-72 rounded-full bg-[#CFE4FB]/60 blur-3xl"
        aria-hidden="true"
    ></div>

    <div
        class="pointer-events-none absolute -right-20 bottom-10 -z-10 h-80 w-80 rounded-full bg-[#DCEBFF]/70 blur-3xl"
        aria-hidden="true"
    ></div>

    <div class="mx-auto max-w-7xl">

        {{-- HEADING KOLEKSI DARI CMS --}}
        <div class="mb-12 flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">

            <div class="max-w-2xl">

                <p class="text-xs font-bold uppercase tracking-[0.12em] text-[#0969D8] sm:text-sm">
                    {{ $koleksiEyebrow }}
                </p>

                <h2 class="mt-3 text-[28px] font-bold leading-[1.2] tracking-tight text-[#123B68] sm:text-4xl">
                    {{ $titleFirst }}

                    @if ($titleSecond !== '')
                        <span class="text-[#0969D8]">
                            {{ $titleSecond }}
                        </span>
                    @endif
                </h2>

                <p class="mt-4 max-w-xl text-sm leading-7 text-[#6B7F96] sm:text-[15px]">
                    {{ $koleksiDescription }}
                </p>

            </div>

            {{-- FILTER KATEGORI --}}
            <div
                id="galleryFilters"
                role="tablist"
                aria-label="Filter galeri"
                class="flex flex-wrap gap-2"
            >

                <button
                    type="button"
                    data-filter="all"
                    role="tab"
                    class="filter-btn whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-semibold transition duration-300"
                >
                    Semua
                    <span class="ml-1 text-xs opacity-70">
                        {{ count($items) }}
                    </span>
                </button>

                @foreach ($catLabel as $key => $label)
                    <button
                        type="button"
                        data-filter="{{ $key }}"
                        role="tab"
                        class="filter-btn whitespace-nowrap rounded-full px-5 py-2.5 text-sm font-semibold transition duration-300"
                    >
                        {{ $label }}

                        <span class="ml-1 text-xs opacity-70">
                            {{ $counts[$key] ?? 0 }}
                        </span>
                    </button>
                @endforeach

            </div>

        </div>


        {{-- GRID FOTO GALERI --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @foreach ($items as $item)

                @php
                    $imageUrl = preg_match('/^https?:\/\//i', $item['img'])
                        ? $item['img']
                        : asset($item['img']);
                @endphp

                <button
                    type="button"
                    class="gallery-item group relative aspect-[4/3] w-full overflow-hidden rounded-[28px] bg-[#DCE8F4] text-left shadow-[0_12px_35px_rgba(27,69,109,0.10)] transition duration-500 hover:-translate-y-2 hover:shadow-[0_28px_60px_rgba(9,105,216,0.22)] focus:outline-none focus-visible:ring-4 focus-visible:ring-blue-300 blade-static-style-1"
                    data-cat="{{ $item['cat'] }}"
                    data-image="{{ $imageUrl }}"
                    data-title="{{ $item['title'] }}"
                    data-pos="{{ $item['pos'] ?? 'center' }}"

                >

                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $item['title'] }}"
                        loading="lazy"
                        class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-110"
                        style="object-position: {{ $item['pos'] ?? 'center' }};"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#06223F]/90 via-[#06223F]/15 to-transparent transition duration-500"></div>

                    <div class="absolute inset-0 bg-[#0969D8]/0 transition duration-500 group-hover:bg-[#0969D8]/15"></div>

                    <span class="absolute left-4 top-4 rounded-full border border-white/30 bg-white/15 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.14em] text-white backdrop-blur-md">
                        {{ $catLabel[$item['cat']] ?? '' }}
                    </span>

                    <div class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-4 p-5 md:p-6">

                        <h3 class="text-base font-semibold leading-snug text-white transition duration-500 group-hover:-translate-y-1 md:text-lg">
                            {{ $item['title'] }}
                        </h3>

                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white text-[#0969D8] shadow-lg transition duration-500 group-hover:rotate-12 group-hover:scale-110">
                            <svg
                                viewBox="0 0 24 24"
                                class="h-[18px] w-[18px]"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2.2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <path d="M7 17 17 7M8 7h9v9"/>
                            </svg>
                        </span>

                    </div>

                </button>

            @endforeach

        </div>

    </div>
</section>


{{-- =========================================================
    LIGHTBOX
========================================================= --}}

<div
    id="galleryModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-[#05152A]/90 px-4 py-6 opacity-0 backdrop-blur-xl transition-opacity duration-300"
    role="dialog"
    aria-modal="true"
    aria-label="Preview gambar galeri"
>

    <button
        type="button"
        id="galleryClose"
        aria-label="Tutup"
        class="absolute right-4 top-4 z-30 flex h-11 w-11 items-center justify-center rounded-full border border-white/15 bg-white/10 text-2xl text-white backdrop-blur-md transition hover:scale-105 hover:bg-white/20 md:right-8 md:top-6"
    >
        ×
    </button>

    <button
        type="button"
        id="galleryPrev"
        aria-label="Foto sebelumnya"
        class="absolute left-3 top-1/2 z-30 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-white/10 text-2xl text-white backdrop-blur-md transition hover:scale-105 hover:bg-white/20 md:left-8"
    >
        ‹
    </button>

    <div
        id="galleryModalContent"
        class="flex w-full max-w-5xl scale-95 flex-col items-center transition duration-300"
    >

        <div
            id="galleryStage"
            class="relative aspect-[4/3] max-h-[62vh] w-[min(88vw,880px)] overflow-hidden rounded-3xl border border-white/10 bg-black/40 shadow-[0_30px_90px_rgba(0,0,0,0.5)] md:aspect-[16/10]"

        >

            <img
                id="galleryModalBackdrop"
                src=""
                alt=""
                aria-hidden="true"
                draggable="false"
                class="pointer-events-none absolute inset-0 hidden h-full w-full scale-125 object-cover opacity-60 blur-2xl"
            >

            <img
                id="galleryModalImage"
                src=""
                alt=""
                draggable="false"
                class="absolute inset-0 h-full w-full select-none object-cover"

            >

        </div>

        <div class="mt-4 flex items-center gap-3 text-white">
            <p id="galleryModalTitle" class="text-center text-sm font-semibold md:text-base"></p>
            <span class="h-1 w-1 rounded-full bg-white/40"></span>
            <p id="galleryModalCounter" class="text-xs font-medium text-white/60"></p>
        </div>

        {{-- KONTROL ZOOM --}}
        <div class="mt-3 flex items-center gap-1 rounded-full border border-white/15 bg-white/10 p-1 backdrop-blur-md">

            <button
                type="button"
                id="zoomOut"
                aria-label="Perkecil"
                class="flex h-9 w-9 items-center justify-center rounded-full text-xl text-white transition hover:bg-white/20"
            >
                −
            </button>

            <button
                type="button"
                id="zoomReset"
                aria-label="Reset zoom"
                class="min-w-[60px] rounded-full px-2 text-xs font-semibold text-white transition hover:bg-white/20"
            >
                100%
            </button>

            <button
                type="button"
                id="zoomIn"
                aria-label="Perbesar"
                class="flex h-9 w-9 items-center justify-center rounded-full text-xl text-white transition hover:bg-white/20"
            >
                +
            </button>

            <span class="mx-1 h-5 w-px bg-white/20"></span>

            <button
                type="button"
                id="fitToggle"
                aria-label="Ganti mode tampilan"
                class="rounded-full px-3 py-2 text-xs font-semibold text-white transition hover:bg-white/20"
            >
                Foto Utuh
            </button>

        </div>

        {{-- THUMBNAIL --}}
        <div
            id="galleryThumbs"
            class="mt-4 flex max-w-[min(88vw,880px)] gap-2 overflow-x-auto px-1 py-1"
        ></div>

    </div>

    <button
        type="button"
        id="galleryNext"
        aria-label="Foto berikutnya"
        class="absolute right-3 top-1/2 z-30 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-white/10 text-2xl text-white backdrop-blur-md transition hover:scale-105 hover:bg-white/20 md:right-8"
    >
        ›
    </button>

</div>


{{-- =========================================================
    JAVASCRIPT FILTER, LIGHTBOX, ZOOM, PAN, THUMBNAIL
========================================================= --}}

@push('scripts')
    <script src="{{ asset('js/pages/public/galeri.js') }}"></script>
@endpush

@endsection
