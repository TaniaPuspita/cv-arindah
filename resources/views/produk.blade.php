@extends('layouts.app')

@section('title', 'Produk & Layanan - CV Arindah')

@section('content')

{{-- =========================================================
    HERO PRODUK & LAYANAN
    MOBILE: FOTO DI ATAS TEKS
    DESKTOP: FOTO DI SISI KANAN
========================================================= --}}

<section class="relative isolate overflow-hidden bg-[#EAF4FF]">

    {{-- FOTO HERO DESKTOP --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-[55%] lg:block"
        aria-hidden="true"
    >
        <img
            src="{{ $hero?->image ? asset('storage/' . $hero->image) : asset('images/heroproduklayanan.jpg') }}"
            alt=""
            class="h-full w-full object-cover object-center"
        >

        <div class="absolute inset-y-0 left-0 w-[48%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/75 to-transparent"></div>

        <div class="absolute inset-x-0 bottom-0 h-12 bg-gradient-to-t from-[#EAF4FF]/30 to-transparent"></div>
    </div>

    {{-- FOTO HERO MOBILE --}}
    <div class="relative w-full lg:hidden">
        <img
            src="{{ $hero?->image ? asset('storage/' . $hero->image) : asset('images/heroproduklayanan.jpg') }}"
            alt="Produk dan layanan CV Arindah"
            fetchpriority="high"
            class="h-[220px] w-full object-cover object-center sm:h-[300px]"
        >

        <div class="absolute inset-x-0 bottom-0 h-12 bg-gradient-to-t from-[#EAF4FF]/60 to-transparent"></div>
    </div>

    {{-- TEKS HERO --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-10 lg:px-8">
        <div class="flex items-center py-7 sm:py-10 lg:min-h-[400px] lg:py-8">

            <div class="w-full max-w-[440px]">

                {{-- LABEL --}}
                <p class="text-xs font-bold uppercase leading-6 tracking-wider text-[#0969D8] sm:text-sm">
                    {{ $hero?->label ?? 'PRODUK & LAYANAN' }}
                </p>

                {{-- LOGIKA WARNA JUDUL --}}
                @php
                    $heroTitle = $hero?->title
                        ?? 'Solusi untuk Mendukung Berbagai Kebutuhan Anda';

                    $highlightWord = 'Berbagai';

                    $heroTitleMain = $heroTitle;
                    $heroTitleHighlight = '';

                    $position = stripos($heroTitle, $highlightWord);

                    if ($position !== false) {
                        $heroTitleMain = trim(
                            substr($heroTitle, 0, $position)
                        );

                        $heroTitleHighlight = trim(
                            substr($heroTitle, $position)
                        );
                    }
                @endphp

                {{-- JUDUL --}}
                <h1 class="mt-2 max-w-[440px] text-[29px] font-bold leading-[1.15] tracking-tight text-[#123B68] sm:mt-3 sm:text-[38px] lg:text-[42px] xl:text-[44px]">
                    {{ $heroTitleMain }}

                    @if ($heroTitleHighlight !== '')
                        <span class="text-[#0969D8]">
                            {{ $heroTitleHighlight }}
                        </span>
                    @endif
                </h1>

                {{-- DESKRIPSI --}}
                <p class="mt-4 max-w-[420px] text-sm leading-6 text-[#64748B] sm:mt-5 sm:text-base sm:leading-7">
                    {{ $hero?->description ?? 'CV Arindah menyediakan layanan yang mendukung kebutuhan pelanggan dalam memperoleh berbagai produk dan perlengkapan secara praktis, cepat, dan terpercaya.' }}
                </p>

                {{-- TOMBOL --}}
                <div class="mt-5 sm:mt-6">
                    <a
                        href="{{ $hero?->button_link ?? '#produk' }}"
                        class="inline-flex min-h-11 items-center justify-center rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200"
                    >
                        {{ $hero?->button_text ?? 'Lihat Produk' }}
                    </a>
                </div>

            </div>
        </div>
    </div>

</section>



    {{-- =========================================================
        KATEGORI PRODUK
    ========================================================= --}}
    <section id="produk" class="bg-white py-12 sm:py-16 lg:py-20">

        <div class="mx-auto max-w-[1296px] px-5 sm:px-8 lg:px-8">

            {{-- JUDUL PRODUK --}}
            <div class="mb-8 sm:mb-9">

                <p class="text-[13px] font-bold tracking-wide text-[#0969D8] sm:text-[14px]">
                    PRODUK
                </p>

                <h2 class="mt-3 text-[25px] font-bold leading-tight text-[#123B68] sm:text-[30px] lg:text-[32px]">
                    Mendukung Kebutuhan Anda dengan Solusi yang Tepat
                </h2>

                <p class="mt-3 max-w-[700px] text-sm leading-6 text-[#64748B] sm:text-[14px]">
                    Setiap kebutuhan memiliki karakteristik yang berbeda.
                    CV Arindah menyediakan berbagai pilihan produk
                    yang dapat membantu pelanggan dalam mendapatkan
                    produk dan perlengkapan yang sesuai dengan kebutuhan.
                </p>

            </div>


           



{{-- =========================================================
    GRID KATEGORI PRODUK
========================================================= --}}
<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

    @forelse ($categories as $category)
        @php
            $categoryRoutes = [
                'komputer-teknologi' => 'produk.komputer',
                'elektronik-furniture' => 'produk.elektronik',
                'perlengkapan-kantor' => 'produk.perlengkapan_kantor',
                'audio-video' => 'produk.audio_video',
                'laboratorium-kesehatan' => 'produk.laboratorium_kesehatan',
                'kebutuhan-sehari-hari' => 'produk.kebutuhan_sehari_hari',
            ];

            $imageUrl = null;

            if ($category->image) {
                $imageUrl = \Illuminate\Support\Str::startsWith(
                    $category->image,
                    ['images/', 'storage/']
                )
                    ? asset($category->image)
                    : asset('storage/' . $category->image);
            }

            $detailRoute = $categoryRoutes[$category->slug ?? ''] ?? null;
        @endphp

        <div class="arindah-animate arindah-product-card flex h-full flex-col overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

            {{-- GAMBAR --}}
            @if ($imageUrl)
                <img
                    src="{{ $imageUrl }}"
                    alt="{{ $category->name }}"
                    loading="lazy"
                    class="h-[200px] w-full shrink-0 object-cover sm:h-[190px] lg:h-[180px]"
                >
            @else
                <div class="flex h-[200px] w-full shrink-0 items-center justify-center bg-slate-100 sm:h-[190px] lg:h-[180px]">
                    <div class="text-center text-slate-400">
                        <i class="bi bi-image text-3xl"></i>
                        <p class="mt-2 text-xs">Gambar belum tersedia</p>
                    </div>
                </div>
            @endif

            {{-- KONTEN KARTU --}}
            <div class="flex flex-1 flex-col p-4 sm:p-5">

                <h3 class="text-sm font-bold text-[#123B68] sm:text-[15px]">
                    {{ $category->name }}
                </h3>

                <p class="mt-2 text-xs leading-5 text-[#64748B] sm:text-[13px]">
                    {{ $category->description }}
                </p>

                {{-- TOMBOL DETAIL --}}
                <div class="mt-auto pt-4">
                    @if ($detailRoute)
                        <a
                            href="{{ route($detailRoute) }}"
                            class="inline-flex items-center gap-1 text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                        >
                            Lihat Selengkapnya <span>→</span>
                        </a>
                    @else
                        <span class="inline-flex items-center gap-1 text-[13px] font-semibold text-[#0969D8]">
                            Lihat Selengkapnya <span>→</span>
                        </span>
                    @endif
                </div>

            </div>
        </div>

    @empty
        <div class="col-span-full rounded-xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">
            <h3 class="font-semibold text-[#123B68]">
                Belum ada kategori produk.
            </h3>
            <p class="mt-2 text-sm text-slate-500">
                Silakan tambahkan kategori melalui CMS Produk &amp; Layanan.
            </p>
        </div>
    @endforelse

</div>

</div>
</section>




{{-- =========================================================
    LAYANAN KAMI
========================================================= --}}
<section id="layanan" class="overflow-hidden bg-[#EEF7FF] py-12 sm:py-16 lg:py-20">

    <div class="mx-auto max-w-[1296px] px-5 sm:px-8 lg:px-8">

        <div class="grid gap-8 lg:grid-cols-[1fr_0.95fr] lg:items-center lg:gap-12">

            {{-- BAGIAN KIRI --}}
            <div>

                <p class="text-[13px] font-bold tracking-wide text-[#0969D8] sm:text-[14px]">
                    {{ $layanan?->label ?? 'LAYANAN KAMI' }}
                </p>

                <h2 class="mt-3 max-w-[600px] text-[26px] font-bold leading-tight text-[#123B68] sm:text-[30px]">
                    {{ $layanan?->title ?? 'Teknologi Informasi & Jasa Komputer' }}
                </h2>

                <p class="mt-3 max-w-[570px] text-sm leading-6 text-[#64748B] sm:text-[14px] sm:leading-7">
                    {{ $layanan?->description ?? 'CV Arindah menyediakan layanan di bidang teknologi informasi
                    dan jasa komputer untuk mendukung kebutuhan teknologi dan
                    operasional pelanggan.' }}
                </p>

                {{-- FOTO LAYANAN --}}
                <div class="relative mt-6 sm:mt-8">

                    <div class="absolute -bottom-3 right-[-10px] h-[100px] w-[60%] rounded-2xl bg-[#DCEBFF] sm:-bottom-5 sm:right-[-25px] sm:h-[150px] sm:w-[270px]"></div>

                    <img
                        src="{{ $layanan?->image ? asset('storage/' . $layanan->image) : asset('images/layanan_kami.avif') }}"
                        alt="{{ $layanan?->title ?? 'Layanan teknologi informasi CV Arindah' }}"
                        loading="lazy"
                        class="arindah-animate arindah-service-image relative z-10 h-[230px] w-full rounded-xl object-cover shadow-sm sm:h-[285px]"
                    >

                </div>

            </div>


            

{{-- KARTU LAYANAN DINAMIS --}}
<div class="space-y-4">

    @forelse ($layananItems as $item)

        <div class="arindah-animate arindah-service-card flex min-h-[92px] items-center gap-4 rounded-xl bg-white px-4 py-5 shadow-[0_4px_16px_rgba(15,23,42,0.10)] sm:gap-5 sm:px-6">

            {{-- IKON LAYANAN --}}
            <div class="flex h-[50px] w-[50px] shrink-0 items-center justify-center rounded-lg border border-[#C9DCFF] bg-[#F6FAFF] sm:h-[54px] sm:w-[54px]">

                @switch($item->icon)

                    {{-- IKON MONITOR ASLI --}}
                    @case('monitor')
                        <svg
                            class="h-6 w-6 text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <rect x="3" y="4" width="18" height="13" rx="1.5"/>
                            <path d="M8 21h8"/>
                            <path d="M12 17v4"/>
                        </svg>
                    @break

                    {{-- IKON RODA GIGI ASLI --}}
                    @case('laptop')
                    @case('settings')
                        <svg
                            class="h-6 w-6 text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M9.7 3.6h4.6l.5 2.1c.4.2.8.4 1.2.7l2-.9 2.3 2.3-.9 2c.3.4.5.8.7 1.2l2.1.5v4.6l-2.1.5c-.2.4-.4.8-.7 1.2l.9 2-2.3 2.3-2-.9c-.4.3-.8.5-1.2.7l-.5 2.1H9.7l-.5-2.1c-.4-.2-.8-.4-1.2-.7l-2 .9-2.3-2.3.9-2c-.3-.4-.5-.8-.7-1.2l-2.1-.5v-4.6l2.1-.5c.2-.4.4-.8.7-1.2l-.9-2L6 5.5l2 .9c.4-.3.8-.5 1.2-.7l.5-2.1Z"/>
                            <circle cx="12" cy="13.8" r="3"/>
                        </svg>
                    @break

                    {{-- IKON CENTANG ASLI --}}
                    @case('network')
                    @case('building')
                    @case('briefcase')
                    @case('printer')
                    @case('wrench')
                        <svg
                            class="h-6 w-6 text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="m8 12 2.5 2.5L16.5 9"/>
                        </svg>
                    @break

                    {{-- IKON CADANGAN --}}
                    @default
                        <svg
                            class="h-6 w-6 text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="m8 12 2.5 2.5L16.5 9"/>
                        </svg>
                    @break

                @endswitch

            </div>

            {{-- JUDUL LAYANAN DARI DATABASE --}}
            <h3 class="text-sm font-medium leading-6 text-[#123B68] sm:text-base">
                {{ $item->title }}
            </h3>

        </div>

    @empty

        <div class="rounded-xl bg-white px-5 py-6 text-sm leading-6 text-[#64748B] shadow-[0_4px_16px_rgba(15,23,42,0.10)]">
            Layanan sedang diperbarui.
        </div>

    @endforelse

</div>


</div>


            </div>

        </div>
    </div>
</section>



   

{{-- =========================================================
    CTA DINAMIS PRODUK & LAYANAN - CV ARINDAH
========================================================= --}}

@if (!$cta || $cta->is_active)

    <section id="kontak" class="bg-white py-12 sm:py-16 lg:py-20">

        <div class="mx-auto max-w-[1296px] px-5 sm:px-8 lg:px-8">

            <div class="grid items-center gap-6 lg:grid-cols-[1.35fr_0.65fr] lg:gap-8">

                {{-- KARTU CTA --}}
                <div class="arindah-animate arindah-cta-card rounded-xl bg-white px-5 py-6 shadow-[0_4px_14px_rgba(15,23,42,0.12)] sm:px-8 sm:py-8">

                    {{-- JUDUL CTA --}}
                    <div class="rounded-lg border border-[#C9DCFF] bg-[#F6FAFF] px-4 py-4 text-center sm:px-6">

                        <p class="text-sm font-semibold leading-6 text-[#123B68] sm:text-base">
                            {{ $cta?->title ?? 'Butuh Produk atau Layanan untuk Kebutuhan Anda?' }}
                        </p>

                    </div>

                    {{-- DESKRIPSI CTA --}}
                    <p class="mt-4 text-sm leading-6 text-[#64748B] sm:text-[14px]">
                        {{ $cta?->description ?? 'Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut mengenai produk dan layanan yang tersedia.' }}
                    </p>

                    {{-- TOMBOL CTA --}}
                    <div class="mt-5 flex justify-center">

                        <a
                            href="{{ url('/kontak') }}"
                            class="inline-flex min-h-11 items-center justify-center rounded-lg bg-[#0969D8] px-7 py-3 text-sm font-semibold text-white shadow-[0_4px_12px_rgba(9,105,216,0.25)] transition duration-200 hover:-translate-y-0.5 hover:bg-[#075BB8] focus:outline-none focus:ring-4 focus:ring-blue-200"
                        >
                            {{ $cta?->button_text ?? 'Hubungi Kami' }}
                        </a>

                    </div>

                </div>

                {{-- FOTO CTA --}}
                <div>

                    <img
                        src="{{ $cta?->image
                            ? \Illuminate\Support\Facades\Storage::disk('public')->url($cta->image)
                            : asset('images/cta_produk_layanan.jpg') }}"
                        alt="Hubungi CV Arindah"
                        loading="lazy"
                        class="arindah-animate arindah-cta-image h-[200px] w-full rounded-xl object-cover shadow-sm sm:h-[250px] lg:h-[220px]"
                    >

                </div>

            </div>
        </div>
    </section>

@endif




    {{-- =========================================================
        STYLE ANIMASI
        HERO TIDAK DIBERI ANIMASI AGAR FOTO LANGSUNG TAMPIL
    ========================================================= --}}
    <style>
        .arindah-animate {
            opacity: 0;
            transform: translateY(22px);
            transition:
                opacity 650ms ease,
                transform 650ms cubic-bezier(0.22, 1, 0.36, 1);
            will-change: opacity, transform;
        }

        .arindah-animate.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .arindah-product-card {
            transition:
                opacity 650ms ease,
                transform 650ms cubic-bezier(0.22, 1, 0.36, 1),
                box-shadow 250ms ease;
        }

        .arindah-product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.13);
        }

        .arindah-service-image {
            transition:
                opacity 700ms ease,
                transform 700ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        .arindah-service-card {
            transition:
                box-shadow 250ms ease,
                transform 250ms ease;
        }

        .arindah-service-card:hover {
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.13);
            transform: translateY(-2px);
        }

        .arindah-cta-image {
            transition:
                transform 500ms ease,
                opacity 650ms ease;
        }

        .arindah-cta-image:hover {
            transform: scale(1.015);
        }

        @media (prefers-reduced-motion: reduce) {
            .arindah-animate,
            .arindah-animate.is-visible,
            .arindah-product-card,
            .arindah-service-image,
            .arindah-service-card,
            .arindah-cta-image {
                transition: none !important;
                transform: none !important;
                animation: none !important;
            }

            .arindah-animate {
                opacity: 1 !important;
            }
        }
    </style>


    {{-- =========================================================
        JAVASCRIPT ANIMASI SAAT SECTION MASUK KE LAYAR
    ========================================================= --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const animatedItems = document.querySelectorAll(
            '#produk .arindah-product-card, ' +
            '#layanan .arindah-service-card, ' +
            '#layanan .arindah-service-image, ' +
            '#kontak .arindah-cta-card, ' +
            '#kontak .arindah-cta-image'
        );

        // Jeda animasi kartu produk
        document.querySelectorAll('#produk .arindah-product-card')
            .forEach((item, index) => {
                item.style.transitionDelay = `${index * 90}ms`;
            });

        // Jeda animasi kartu layanan
        document.querySelectorAll('#layanan .arindah-service-card')
            .forEach((item, index) => {
                item.style.transitionDelay = `${index * 100}ms`;
            });

        // Jika browser tidak mendukung IntersectionObserver,
        // tampilkan semua elemen tanpa menunggu animasi.
        if (!('IntersectionObserver' in window)) {
            animatedItems.forEach(item => {
                item.classList.add('is-visible');
            });

            return;
        }

        const observer = new IntersectionObserver(
            (entries, currentObserver) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        currentObserver.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -35px 0px'
            }
        );

        animatedItems.forEach(item => {
            observer.observe(item);
        });

    });
    </script>

    @endsection