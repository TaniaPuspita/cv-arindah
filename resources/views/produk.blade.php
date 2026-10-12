@extends('layouts.app')

@section('title', 'Produk & Layanan - CV Arindah')

@section('content')



{{-- =========================================================
    HERO PRODUK & LAYANAN
    BACKGROUND DISESUAIKAN DENGAN BERANDA DAN TENTANG KAMI
========================================================== --}}

<section class="relative isolate overflow-hidden bg-[#EAF4FF]">

    {{-- BACKGROUND FOTO DI SEBELAH KANAN UNTUK DESKTOP --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-[62%] lg:block"
        aria-hidden="true">

        <img
            src="{{ asset('images/heroproduklayanan.jpg') }}"
            alt=""
            class="h-full w-full object-cover object-center">

        {{-- GRADASI KIRI MENYATU DENGAN BACKGROUND --}}
        <div class="absolute inset-y-0 left-0 w-[60%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/75 to-transparent"></div>

        {{-- GRADASI BAWAH --}}
        <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#EAF4FF]/80 to-transparent"></div>

    </div>

    {{-- BACKGROUND FOTO UNTUK MOBILE --}}
    <div class="relative h-[220px] w-full sm:h-[280px] lg:hidden">

        <img
            src="{{ asset('images/hero_produk_layanan.jpg') }}"
            alt="Produk dan layanan CV Arindah"
            class="h-full w-full object-cover object-center">

        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#EAF4FF] to-transparent"></div>

    </div>

    {{-- KONTEN HERO --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-8 sm:px-10 lg:px-[32px]">

        <div class="flex items-center pb-12 pt-10 sm:pt-12 lg:min-h-[440px] lg:py-20">

            {{-- KONTEN KIRI --}}
            <div class="max-w-[500px]">

                {{-- LABEL --}}
                <p class="text-sm font-bold uppercase leading-6 tracking-wide text-[#0969D8]">
                    PRODUK & LAYANAN
                </p>

                {{-- JUDUL --}}
                <h1 class="mt-3 max-w-[460px] text-4xl font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-5xl lg:text-[46px] xl:text-[52px]">
                    Solusi untuk Mendukung
                    <span class="block text-[#0969D8]">
                        Berbagai Kebutuhan
                    </span>
                    Anda
                </h1>

                {{-- DESKRIPSI --}}
                <p class="mt-5 max-w-[430px] text-sm leading-6 text-[#64748B] md:text-base md:leading-7">
                    CV Arindah menyediakan layanan yang mendukung
                    kebutuhan pelanggan dalam memperoleh berbagai
                    produk dan perlengkapan secara praktis, cepat,
                    dan terpercaya.
                </p>

                {{-- BUTTON --}}
                <div class="mt-8">
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
    KATEGORI PRODUK
========================================================== --}}
<section
    id="produk"  
    class="bg-white py-16 lg:py-20"
>

    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">


        {{-- HEADER --}}
        <div class="mb-9">

            <p class="text-[14px] font-bold tracking-wide text-[#0969D8]">
                PRODUK
            </p>


            <h2 class="mt-3 text-[30px] font-bold leading-tight text-[#123B68] lg:text-[32px]">
                Mendukung Kebutuhan Anda dengan Solusi yang Tepat
            </h2>


            <p class="mt-2 max-w-[700px] text-[14px] leading-6 text-[#64748B]">
                Setiap kebutuhan memiliki karakteristik yang berbeda.
                CV Arindah menyediakan berbagai pilihan produk
                yang dapat membantu pelanggan dalam mendapatkan
                produk dan perlengkapan yang sesuai dengan kebutuhan.
            </p>

        </div>



        {{-- PRODUCT CARDS --}}
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">


            {{-- CARD 1 --}}
            <div class="overflow-hidden rounded-[12px] bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

                <img
                    src="/images/komputer_teknologi.jpg"
                    alt="Komputer & Teknologi"
                    class="h-[170px] w-full object-cover"
                >

                <div class="p-4">

                    <h3 class="text-[13px] font-bold text-[#123B68]">
                        Komputer & Teknologi
                    </h3>

                    <p class="mt-2 text-[11px] leading-[1.5] text-[#64748B]">
                        Komputer, laptop, printer, aksesori,
                        dan perlengkapan teknologi lainnya.
                    </p>

                    <a
                        href="{{ route('produk.komputer') }}"
                        class="mt-4 inline-flex items-center text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                    >
                        Lihat Selengkapnya
                        <span class="ml-1">→</span>
                    </a>

                </div>

            </div>



            {{-- CARD 2 --}}
            <div class="overflow-hidden rounded-[12px] bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

                <img
                    src="/images/furnitur.jpg"
                    alt="Elektronik & Furniture"
                    class="h-[170px] w-full object-cover"
                >

                <div class="p-4">

                    <h3 class="text-[13px] font-bold text-[#123B68]">
                        Elektronik & Furniture
                    </h3>

                    <p class="mt-2 text-[11px] leading-[1.5] text-[#64748B]">
                        Peralatan listrik rumah tangga,
                        penerangan, elektronik, dan furniture.
                    </p>

                    <a
                        href="{{ route('produk.elektronik') }}"
                        class="mt-4 inline-flex items-center text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                    >
                        Lihat Selengkapnya
                        <span class="ml-1">→</span>
                    </a>

                </div>

            </div>



            {{-- CARD 3 --}}
            <div class="overflow-hidden rounded-[12px] bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

                <img
                    src="/images/perlengkapan_kantor.jpg"
                    alt="Perlengkapan Kantor"
                    class="h-[170px] w-full object-cover"
                >

                <div class="p-4">

                    <h3 class="text-[13px] font-bold text-[#123B68]">
                        Perlengkapan Kantor
                    </h3>

                    <p class="mt-2 text-[11px] leading-[1.5] text-[#64748B]">
                        Alat tulis, perlengkapan kantor,
                        serta kebutuhan perlengkapan lainnya.
                    </p>

                    <a
                        href="{{ route('produk.perlengkapan_kantor') }}"
                        class="mt-4 inline-flex items-center text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                    >
                        Lihat Selengkapnya
                        <span class="ml-1">→</span>
                    </a>

                </div>

            </div>



            {{-- CARD 4 --}}
            <div class="overflow-hidden rounded-[12px] bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

                <img
                    src="/images/kamera_audio.jpg"
                    alt="Audio & Video"
                    class="h-[170px] w-full object-cover"
                >

                <div class="p-4">

                    <h3 class="text-[13px] font-bold text-[#123B68]">
                        Audio & Video
                    </h3>

                    <p class="mt-2 text-[11px] leading-[1.5] text-[#64748B]">
                        Peralatan audio, video, dan perlengkapannya
                        untuk kebutuhan pribadi maupun profesional.
                    </p>

                     <a
                        href="{{ route('produk.audio_video') }}"
                        class="mt-4 inline-flex items-center text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                    >
                        Lihat Selengkapnya
                        <span class="ml-1">→</span>
                    </a>

                </div>

            </div>



            {{-- CARD 5 --}}
            <div class="overflow-hidden rounded-[12px] bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

                <img
                    src="/images/laboratorium_kesehatan.jpg"
                    alt="Laboratorium & Kesehatan"
                    class="h-[170px] w-full object-cover"
                >

                <div class="p-4">

                    <h3 class="text-[13px] font-bold text-[#123B68]">
                        Laboratorium & Kesehatan
                    </h3>

                    <p class="mt-2 text-[11px] leading-[1.5] text-[#64748B]">
                        Peralatan laboratorium, farmasi,
                        dan alat kesehatan.
                    </p>

                    <a
                        href="{{ route('produk.laboratorium_kesehatan') }}"
                        class="mt-4 inline-flex items-center text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                    >
                        Lihat Selengkapnya
                        <span class="ml-1">→</span>
                    </a>

                </div>

            </div>



            {{-- CARD 6 --}}
            <div class="overflow-hidden rounded-[12px] bg-white shadow-[0_3px_12px_rgba(15,23,42,0.10)]">

                <img
                    src="/images/kebutuhan sehari-hari.jpg"
                    alt="Kebutuhan Sehari-hari"
                    class="h-[170px] w-full object-cover"
                >

                <div class="p-4">

                    <h3 class="text-[13px] font-bold text-[#123B68]">
                        Kebutuhan Sehari-hari
                    </h3>

                    <p class="mt-2 text-[11px] leading-[1.5] text-[#64748B]">
                        Makanan, minuman, pakaian, kosmetik,
                        parfum, dan kebutuhan lainnya.
                    </p>

                    <a
                        href="{{ route('produk.kebutuhan_sehari_hari') }}"
                        class="mt-4 inline-flex items-center text-[13px] font-semibold text-[#0969D8] transition hover:gap-2"
                    >
                        Lihat Selengkapnya
                        <span class="ml-1">→</span>
                    </a>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- =========================================================
    LAYANAN KAMI
========================================================== --}}
<section
    id="layanan"
    class="bg-[#EEF7FF] py-16 lg:py-20"
>

    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">


        <div class="grid gap-12 lg:grid-cols-[1fr_0.95fr] lg:items-center">


            {{-- =================================================
                KIRI
            ================================================== --}}
            <div>

                <p class="text-[14px] font-bold tracking-wide text-[#0969D8]">
                    LAYANAN KAMI
                </p>


                <h2 class="mt-3 max-w-[600px] text-[30px] font-bold leading-[1.15] text-[#123B68]">
                    Teknologi Informasi & Jasa Komputer
                </h2>


                <p class="mt-3 max-w-[570px] text-[14px] leading-[1.5] text-[#64748B]">
                    CV Arindah menyediakan layanan di bidang teknologi informasi
                    dan jasa komputer untuk mendukung kebutuhan teknologi dan
                    operasional pelanggan.
                </p>


                {{-- FOTO LAYANAN --}}
                <div class="relative mt-8 max-w-[570px]">

                    <div class="absolute -bottom-5 right-[-25px] h-[150px] w-[270px] rounded-[16px] bg-[#EEF7FF]">
                    </div>

                    <img
                        src="/images/layanan_kami.avif"
                        alt="Layanan teknologi informasi CV Arindah"
                        class="relative z-10 h-[285px] w-full rounded-[12px] object-cover shadow-sm"
                    >

                </div>

            </div>



            {{-- =================================================
                KANAN — SERVICE CARDS
            ================================================== --}}
            <div class="space-y-4">


                {{-- SERVICE 1 --}}
                <div class="flex min-h-[92px] items-center gap-5 rounded-[12px] bg-white px-6 py-4 shadow-[0_4px_16px_rgba(15,23,42,0.10)]">

                    <div class="flex h-[54px] w-[54px] shrink-0 items-center justify-center rounded-[9px] border border-[#C9DCFF] bg-[#F6FAFF]">

                        <svg
                            class="h-[24px] w-[24px] text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="3" y="4" width="18" height="13" rx="1.5"/>
                            <path d="M8 21h8"/>
                            <path d="M12 17v4"/>
                        </svg>

                    </div>


                    <h3 class="text-[16px] font-medium leading-[1.2] text-[#123B68]">
                        Pengadaan Perangkat<br>
                        Komputer & Jaringan
                    </h3>

                </div>



                {{-- =================================================
                    SERVICE 2 — ICON GEAR
                    DIBUAT ULANG SUPAYA TENGAH DAN PROPORSIONAL
                ================================================== --}}
                <div class="flex min-h-[92px] items-center gap-5 rounded-[12px] bg-white px-6 py-4 shadow-[0_4px_16px_rgba(15,23,42,0.10)]">


                    {{-- ICON BOX --}}
                    <div class="flex h-[54px] w-[54px] shrink-0 items-center justify-center rounded-[9px] border border-[#C9DCFF] bg-[#F6FAFF]">


                        <svg
                            class="h-[25px] w-[25px] text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            {{-- GEAR --}}
                            <path
                                d="M9.7 3.6h4.6l.5 2.1c.4.2.8.4 1.2.7l2-.9 2.3 2.3-.9 2c.3.4.5.8.7 1.2l2.1.5v4.6l-2.1.5c-.2.4-.4.8-.7 1.2l.9 2-2.3 2.3-2-.9c-.4.3-.8.5-1.2.7l-.5 2.1H9.7l-.5-2.1c-.4-.2-.8-.4-1.2-.7l-2 .9-2.3-2.3.9-2c-.3-.4-.5-.8-.7-1.2l-2.1-.5v-4.6l2.1-.5c.2-.4.4-.8.7-1.2l-.9-2L6 5.5l2 .9c.4-.3.8-.5 1.2-.7l.5-2.1Z"
                            />

                            {{-- TENGAH GEAR --}}
                            <circle
                                cx="12"
                                cy="13.8"
                                r="3"
                            />

                        </svg>


                    </div>


                    <h3 class="text-[16px] font-medium text-[#123B68]">
                        Kebutuhan Teknologi
                    </h3>


                </div>



                {{-- SERVICE 3 --}}
                <div class="flex min-h-[92px] items-center gap-5 rounded-[12px] bg-white px-6 py-4 shadow-[0_4px_16px_rgba(15,23,42,0.10)]">

                    <div class="flex h-[54px] w-[54px] shrink-0 items-center justify-center rounded-[9px] border border-[#C9DCFF] bg-[#F6FAFF]">

                        <svg
                            class="h-[24px] w-[24px] text-[#0969D8]"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="12" cy="12" r="9"/>
                            <path d="m8 12 2.5 2.5L16.5 9"/>
                        </svg>

                    </div>


                    <h3 class="max-w-[300px] text-[16px] font-medium leading-[1.2] text-[#123B68]">
                        Solusi Kebutuhan<br>
                        Usaha & Operasional
                    </h3>

                </div>


            </div>


        </div>

    </div>

</section>



{{-- =========================================================
    CTA KHUSUS PRODUK & LAYANAN
    BUKAN CTA BERANDA
========================================================== --}}
<section
    id="kontak"
    class="bg-white py-16 lg:py-20"
>

    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">


        <div class="grid items-center gap-5 lg:grid-cols-[1.35fr_0.65fr]">


            {{-- =================================================
                CTA CARD
            ================================================== --}}
            <div
                class="rounded-[12px] bg-white px-8 py-8 shadow-[0_4px_14px_rgba(15,23,42,0.12)]"
            >

                {{-- BOX PERTANYAAN --}}
                <div
                    class="rounded-[7px] border border-[#C9DCFF] bg-[#F6FAFF] px-6 py-4 text-center"
                >

                    <p class="text-[13px] font-medium text-[#123B68]">
                        Butuh Produk atau Layanan untuk Kebutuhan Anda?
                    </p>

                </div>


                {{-- DESKRIPSI --}}
                <p class="mt-4 max-w-[620px] text-[12px] leading-[1.55] text-[#64748B]">
                    Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut
                    mengenai produk dan layanan yang tersedia.
                </p>


                {{-- BUTTON --}}
                <div class="mt-5 flex justify-center">

                    <a
                        href="mailto:cv.arindah2016@gmail.com"
                        class="inline-flex items-center justify-center rounded-[8px] bg-[#0969D8] px-7 py-2.5 text-[14px] font-semibold text-white shadow-[0_4px_12px_rgba(9,105,216,0.25)] transition duration-200 hover:bg-[#075bb8]"
                    >
                        Hubungi Kami
                    </a>

                </div>

            </div>



            {{-- =================================================
                CTA IMAGE
            ================================================== --}}
            <div>

                <img
                    src="/images/cta_produk_layanan.jpg"
                    alt="Hubungi CV Arindah"
                    class="h-[190px] w-full rounded-[10px] object-cover shadow-sm"
                >

            </div>


        </div>

    </div>

</section>


@endsection