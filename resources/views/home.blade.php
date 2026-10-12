@extends('layouts.app')

@section('title', 'CV Arindah')

@section('content')


{{-- =========================================================
    1. HERO
========================================================= --}}

<section id="beranda" class="relative isolate scroll-mt-24 overflow-hidden bg-[#EAF4FF]">

    {{-- BACKGROUND GAMBAR DI SEBELAH KANAN --}}
    <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-[62%] lg:block" aria-hidden="true">

        <img
            src="{{ asset('images/hero.png.png') }}"
            alt=""
            class="h-full w-full object-cover object-center">

        {{-- GRADASI KIRI MENYATU DENGAN BACKGROUND BIRU --}}
        <div class="absolute inset-y-0 left-0 w-[60%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/75 to-transparent"></div>

        {{-- GRADASI BAWAH --}}
        <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#EAF4FF]/80 to-transparent"></div>

    </div>

    {{-- BACKGROUND GAMBAR UNTUK MOBILE --}}
    <div class="relative h-[220px] w-full sm:h-[280px] lg:hidden">
        <img
            src="{{ asset('images/hero.png.png') }}"
            alt="Produk teknologi CV Arindah"
            class="h-full w-full object-cover object-center">

        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#EAF4FF] to-transparent"></div>
    </div>

    {{-- TEKS HERO --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-8 sm:px-10 lg:px-[32px]">

        <div class="flex items-center pb-12 pt-10 sm:pt-12 lg:min-h-[440px] lg:py-20">

            <div class="max-w-[500px]">

                <p class="text-sm font-bold uppercase leading-6 tracking-wide text-[#0969D8]">
                    CV ARINDAH
                </p>

                <h1 class="mt-3 max-w-[440px] text-4xl font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-5xl lg:text-[46px] xl:text-[52px]">
                    Solusi Produk &
                    <span class="block text-[#0969D8]">Kebutuhan Teknologi</span>
                    Bisnis Anda
                </h1>

                <p class="mt-5 max-w-[400px] text-sm leading-6 text-[#4F6683] md:text-base md:leading-7">
                    Menyediakan berbagai kebutuhan produk dan perlengkapan untuk mendukung kebutuhan pelanggan.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a
                        href="#produk"
                        class="inline-flex items-center rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200">
                        Lihat Produk
                    </a>
                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    2. TENTANG KAMI
========================================================= --}}
<section id="tentang" class="bg-white py-16 lg:py-20">
    <div class="mx-auto grid max-w-[1296px] items-center gap-12 px-6 lg:grid-cols-[1fr_1.15fr] lg:px-8">
        <div class="relative">
            <div class="absolute -bottom-5 left-5 h-[110px] w-[110px] rounded-[18px] bg-[#EEF7FF]"></div>

            <img src="{{ asset('images/tentang_kami.jpeg') }}"
                 alt="Tentang CV Arindah"
                 class="relative z-10 h-[300px] w-full rounded-[14px] object-cover shadow-sm sm:h-[360px]">
        </div>

        <div>
            <p class="text-sm font-bold tracking-wide text-[#0969D8]">TENTANG KAMI</p>

            <h2 class="mt-3 text-3xl font-bold leading-tight text-[#123B68]">
                MENGENAL CV ARINDAH
            </h2>

            <div class="mt-4 max-w-[650px] space-y-3 text-sm leading-6 text-[#64748B]">
                <p>
                    CV Arindah bergerak dalam berbagai bidang perdagangan eceran,
                    termasuk komputer dan perlengkapan, peralatan listrik, alat tulis,
                    furniture, audio dan video, serta kebutuhan laboratorium dan kesehatan.
                </p>

                <p>
                    Selain itu, CV Arindah juga memiliki aktivitas di bidang teknologi
                    informasi dan jasa komputer lainnya.
                </p>
            </div>

            <div class="mt-7 grid grid-cols-3 gap-4 sm:gap-6">
                <div>
                    <p class="text-sm font-bold leading-5 text-[#123B68]">
                        Komputer &<br>Perlengkapan
                    </p>
                    <div class="mt-4 h-[2px] w-16 bg-[#C9DCFF]"></div>
                </div>

                <div>
                    <p class="text-sm font-bold leading-5 text-[#123B68]">
                        Elektronik &<br>Furniture
                    </p>
                    <div class="mt-4 h-[2px] w-16 bg-[#C9DCFF]"></div>
                </div>

                <div>
                    <p class="text-sm font-bold leading-5 text-[#123B68]">
                        Teknologi Informasi
                    </p>
                    <div class="mt-4 h-[2px] w-16 bg-[#C9DCFF]"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
    3. PRODUK & LAYANAN
========================================================= --}}
<section id="produk" class="bg-[#EEF7FF] py-16 lg:py-20">
    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">
        <div class="mb-9">
            <p class="text-sm font-bold tracking-wide text-[#0969D8]">PRODUK & LAYANAN</p>

            <h2 class="mt-3 text-3xl font-bold leading-tight text-[#123B68]">
                KATEGORI PRODUK
            </h2>

            <p class="mt-2 max-w-[700px] text-sm leading-6 text-[#64748B]">
                Berbagai pilihan produk yang kami sediakan sesuai dengan kebutuhan Anda.
            </p>
        </div>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            {{-- CARD 1 --}}
            <div class="group overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('images/komputer_teknologi.jpg') }}"
                     alt="Komputer & Teknologi"
                     class="h-[190px] w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="p-5">
                    <h3 class="text-base font-bold text-[#123B68]">Komputer & Teknologi</h3>
                    <p class="mt-2 text-sm leading-6 text-[#64748B]">
                        Komputer, laptop, printer, aksesori, dan perlengkapan teknologi lainnya.
                    </p>
                    <a href="{{ route('produk.komputer') }}"
                       class="mt-4 inline-flex text-sm font-semibold text-[#0969D8] transition hover:translate-x-1 hover:underline">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="group overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('images/furnitur.jpg') }}"
                     alt="Elektronik & Furniture"
                     class="h-[190px] w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="p-5">
                    <h3 class="text-base font-bold text-[#123B68]">Elektronik & Furniture</h3>
                    <p class="mt-2 text-sm leading-6 text-[#64748B]">
                        Peralatan listrik rumah tangga, penerangan, elektronik, dan furniture.
                    </p>
                    <a href="{{ route('produk.elektronik') }}"
                       class="mt-4 inline-flex text-sm font-semibold text-[#0969D8] transition hover:translate-x-1 hover:underline">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="group overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('images/perlengkapan_kantor.jpg') }}"
                     alt="Perlengkapan Kantor"
                     class="h-[190px] w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="p-5">
                    <h3 class="text-base font-bold text-[#123B68]">Perlengkapan Kantor</h3>
                    <p class="mt-2 text-sm leading-6 text-[#64748B]">
                        Alat tulis, perlengkapan kantor, serta kebutuhan perlengkapan lainnya.
                    </p>
                    <a href="{{ route('produk.perlengkapan_kantor') }}"
                       class="mt-4 inline-flex text-sm font-semibold text-[#0969D8] transition hover:translate-x-1 hover:underline">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>

            {{-- CARD 4 --}}
            <div class="group overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('images/kamera_audio.jpg') }}"
                     alt="Audio & Video"
                     class="h-[190px] w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="p-5">
                    <h3 class="text-base font-bold text-[#123B68]">Audio & Video</h3>
                    <p class="mt-2 text-sm leading-6 text-[#64748B]">
                        Peralatan audio, video, dan perlengkapannya untuk kebutuhan pribadi maupun profesional.
                    </p>
                    <a href="{{ route('produk.audio_video') }}"
                       class="mt-4 inline-flex text-sm font-semibold text-[#0969D8] transition hover:translate-x-1 hover:underline">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>

            {{-- CARD 5 --}}
            <div class="group overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('images/laboratorium_kesehatan.jpg') }}"
                     alt="Laboratorium & Kesehatan"
                     class="h-[190px] w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="p-5">
                    <h3 class="text-base font-bold text-[#123B68]">Laboratorium & Kesehatan</h3>
                    <p class="mt-2 text-sm leading-6 text-[#64748B]">
                        Peralatan laboratorium, farmasi, dan alat kesehatan.
                    </p>
                    <a href="{{ route('produk.laboratorium_kesehatan') }}"
                       class="mt-4 inline-flex text-sm font-semibold text-[#0969D8] transition hover:translate-x-1 hover:underline">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>

            {{-- CARD 6 --}}
            <div class="group overflow-hidden rounded-xl bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                <img src="{{ asset('images/kebutuhan sehari-hari.jpg') }}"
                     alt="Kebutuhan Sehari-hari"
                     class="h-[190px] w-full object-cover transition duration-500 group-hover:scale-105">

                <div class="p-5">
                    <h3 class="text-base font-bold text-[#123B68]">Kebutuhan Sehari-hari</h3>
                    <p class="mt-2 text-sm leading-6 text-[#64748B]">
                        Makanan, minuman, pakaian, kosmetik, parfum, dan kebutuhan lainnya.
                    </p>
                    <a href="{{ route('produk.kebutuhan_sehari_hari') }}"
                       class="mt-4 inline-flex text-sm font-semibold text-[#0969D8] transition hover:translate-x-1 hover:underline">
                        Lihat Selengkapnya →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
    4. LAYANAN KAMI
========================================================= --}}
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
                {{-- SERVICE 1 --}}
                <div class="flex min-h-[105px] items-center gap-5 rounded-xl bg-white px-5 py-5 shadow-[0_4px_16px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:px-7">
                    <div class="flex h-[62px] w-[62px] shrink-0 items-center justify-center rounded-lg border border-[#C9DCFF] bg-[#F6FAFF]">
                        <svg class="h-7 w-7 text-[#0969D8]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="13" rx="1.5"/>
                            <path d="M8 21h8M12 17v4"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-medium leading-6 text-[#123B68] sm:text-lg">
                        Pengadaan Perangkat<br>Komputer & Jaringan
                    </h3>
                </div>

                {{-- SERVICE 2 --}}
                <div class="flex min-h-[105px] items-center gap-5 rounded-xl bg-white px-5 py-5 shadow-[0_4px_16px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:px-7">
                    <div class="flex h-[62px] w-[62px] shrink-0 items-center justify-center rounded-lg border border-[#C9DCFF] bg-[#F6FAFF]">
                        <svg class="h-7 w-7 text-[#0969D8]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path d="M9.7 3.6h4.6l.5 2.1c.4.2.8.4 1.2.7l2-.9 2.3 2.3-.9 2c.3.4.5.8.7 1.2l2.1.5v4.6l-2.1.5c-.2.4-.4.8-.7 1.2l.9 2-2.3 2.3-2-.9c-.4.3-.8.5-1.2.7l-.5 2.1H9.7l-.5-2.1c-.4-.2-.8-.4-1.2-.7l-2 .9-2.3-2.3.9-2c-.3-.4-.5-.8-.7-1.2l-2.1-.5v-4.6l2.1-.5c.2-.4.4-.8.7-1.2l-.9-2L6 5.5l2 .9c.4-.3.8-.5 1.2-.7l.5-2.1Z"/>
                            <circle cx="12" cy="13.8" r="3"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-medium text-[#123B68] sm:text-lg">
                        Kebutuhan Teknologi
                    </h3>
                </div>

                {{-- SERVICE 3 --}}
                <div class="flex min-h-[105px] items-center gap-5 rounded-xl bg-white px-5 py-5 shadow-[0_4px_16px_rgba(15,23,42,0.10)] transition duration-300 hover:-translate-y-1 hover:shadow-lg sm:px-7">
                    <div class="flex h-[62px] w-[62px] shrink-0 items-center justify-center rounded-lg border border-[#C9DCFF] bg-[#F6FAFF]">
                        <svg class="h-7 w-7 text-[#0969D8]" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="m8 12 2.5 2.5L16.5 9"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-medium leading-6 text-[#123B68] sm:text-lg">
                        Solusi Kebutuhan<br>Usaha & Operasional
                    </h3>
                </div>
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
            <p class="text-sm font-bold tracking-[2px] text-[#0969D8]">GALERI</p>

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
            <button type="button"
                    id="galeri-prev"
                    aria-label="Foto sebelumnya"
                    class="galeri-nav absolute left-0 top-1/2 z-50 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-xl text-[#123B68] shadow-lg hover:bg-[#0969D8] hover:text-white sm:left-2 sm:h-12 sm:w-12">
                &#8592;
            </button>

            {{-- VIEWPORT FOTO --}}
            <div id="galeri-viewport" class="overflow-hidden px-1 py-5 sm:px-4">
                <div id="galeri-track" class="relative flex items-center gap-4 sm:gap-5">
                    {{-- FOTO 1 --}}
                    <div class="galeri-slide relative h-[210px] w-[75%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-lg sm:h-[260px] sm:w-[38%] lg:h-[265px] lg:w-[25%]">
                        <img src="{{ asset('images/menugaleri/galeri1.jpg') }}"
                             alt="Dokumentasi produk CV Arindah"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 2 --}}
                    <div class="galeri-slide relative h-[250px] w-[78%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-xl sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]">
                        <img src="{{ asset('images/menugaleri/gambar2.jpg') }}"
                             alt="Pilihan produk CV Arindah"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 3 --}}
                    <div class="galeri-slide relative h-[290px] w-[85%] shrink-0 overflow-hidden rounded-[24px] border-4 border-white bg-white shadow-2xl sm:h-[340px] sm:w-[48%] lg:h-[360px] lg:w-[34%]">
                        <img src="{{ asset('images/menugaleri/gambar3.jpg') }}"
                             alt="Dokumentasi utama CV Arindah"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 4 --}}
                    <div class="galeri-slide relative h-[250px] w-[78%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-xl sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]">
                        <img src="{{ asset('images/menugaleri/gambar4.jpg') }}"
                             alt="Dokumentasi aktivitas CV Arindah"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 5 --}}
                    <div class="galeri-slide relative h-[210px] w-[75%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-lg sm:h-[260px] sm:w-[38%] lg:h-[265px] lg:w-[25%]">
                        <img src="{{ asset('images/menugaleri/gambar5.jpg') }}"
                             alt="Dokumentasi layanan CV Arindah"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 6 --}}
                    <div class="galeri-slide relative h-[250px] w-[78%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-xl sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]">
                        <img src="{{ asset('images/menugaleri/gambar6.jpg') }}"
                             alt="Dokumentasi kegiatan CV Arindah"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 7 --}}
                    <div class="galeri-slide relative h-[250px] w-[78%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-xl sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]">
                        <img src="{{ asset('images/menugaleri/gambar7.jpg') }}"
                             alt="Dokumentasi produk lainnya"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>

                    {{-- FOTO 8 --}}
                    <div class="galeri-slide relative h-[250px] w-[78%] shrink-0 overflow-hidden rounded-2xl border-4 border-white bg-white shadow-xl sm:h-[300px] sm:w-[42%] lg:h-[310px] lg:w-[28%]">
                        <img src="{{ asset('images/menugaleri/gambar8.jpg') }}"
                             alt="Dokumentasi layanan lainnya"
                             class="h-full w-full object-cover"
                             loading="lazy"
                             draggable="false">
                    </div>
                </div>
            </div>

            {{-- PANAH KANAN --}}
            <button type="button"
                    id="galeri-next"
                    aria-label="Foto berikutnya"
                    class="galeri-nav absolute right-0 top-1/2 z-50 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white text-xl text-[#123B68] shadow-lg hover:bg-[#0969D8] hover:text-white sm:right-2 sm:h-12 sm:w-12">
                &#8594;
            </button>
        </div>

        {{-- COUNTER FOTO --}}
        <div class="mt-2 flex items-center justify-center gap-3">
            <span id="galeri-counter" class="text-xs font-medium text-slate-500">
                1 / 8
            </span>

            <div class="h-1.5 w-24 overflow-hidden rounded-full bg-[#DCE8F7]">
                <div id="galeri-progress"
                     class="h-full rounded-full bg-[#0969D8]"
                     style="width: 12.5%; transition: width 700ms cubic-bezier(.22,.8,.24,1);">
                </div>
            </div>
        </div>

        {{-- TOMBOL JELAJAHI GALERI --}}
        <div class="mt-6 flex justify-center">
            <a href="{{ route('galeri') }}"
               class="inline-flex items-center rounded-xl bg-[#0969D8] px-7 py-3.5 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075bb8] hover:shadow-lg">
                Jelajahi Galeri
            </a>
        </div>
    </div>
</section>

{{-- =========================================================
    6. CTA / KONTAK
========================================================= --}}
<section id="kontak" class="relative overflow-hidden py-16 lg:py-20">
    <img src="{{ asset('images/cta_beranda.jpg') }}"
         alt=""
         class="absolute inset-0 h-full w-full object-cover">

    <div class="absolute inset-0 bg-slate-950/65"></div>

    <div class="relative mx-auto flex min-h-[390px] max-w-[1296px] items-center justify-center px-6 lg:px-8">
        <div class="w-full max-w-[820px] rounded-2xl bg-white px-8 py-12 text-center shadow-[0_10px_35px_rgba(0,0,0,0.18)] lg:px-16">
            <p class="text-xs font-semibold tracking-wide text-[#0969D8]">KONTAK</p>

            <h2 class="mt-4 text-2xl font-bold leading-tight text-[#123B68] sm:text-3xl">
                Mari Terhubung dengan CV Arindah
            </h2>

            <p class="mx-auto mt-3 max-w-[560px] text-sm leading-6 text-[#64748B]">
                Punya kebutuhan produk atau layanan? Hubungi kami untuk
                mendapatkan informasi lebih lanjut mengenai kebutuhan Anda.
            </p>

            <a href="mailto:cv.arindah2016@gmail.com"
               class="mt-7 inline-flex items-center justify-center rounded-lg bg-[#0969D8] px-8 py-3 text-sm font-semibold text-white shadow-md transition hover:-translate-y-1 hover:bg-[#075bb8]">
                Hubungi Kami
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