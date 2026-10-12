@extends('layouts.app')

@section('content')


{{-- =========================================================
    HERO GALERI
    DISESUAIKAN DENGAN HERO TENTANG KAMI
========================================================= --}}

<section class="relative isolate overflow-hidden bg-[#EAF4FF] pt-[69px] lg:pt-[69px]">

    {{-- FOTO UNTUK MOBILE --}}
    <div class="relative h-[240px] w-full sm:h-[300px] lg:hidden">
        <img
            src="{{ asset('images/menugaleri/herogaleri.jpg') }}"
            alt="Galeri CV Arindah"
            class="h-full w-full object-cover object-center">

        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#EAF4FF] to-transparent"></div>
    </div>

    {{-- FOTO DESKTOP DI SISI KANAN --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-[62%] lg:block"
        aria-hidden="true">

        <img
            src="{{ asset('images/herogaleri.jpg') }}"
            alt=""
            class="h-full w-full object-cover object-center">

        {{-- GRADASI KIRI MENYATU DENGAN BACKGROUND --}}
        <div class="absolute inset-y-0 left-0 w-[60%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/75 to-transparent"></div>

        {{-- GRADASI BAWAH --}}
        <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-[#EAF4FF] to-transparent"></div>
    </div>

    {{-- KONTEN HERO --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-8 sm:px-10 lg:px-[32px]">

        <div class="flex items-center pb-12 pt-4 lg:min-h-[440px] lg:py-16">

            <div class="max-w-[500px]">

                {{-- LABEL --}}
                <p class="text-sm font-bold uppercase leading-6 tracking-wide text-[#0969D8]">
                    Galeri
                </p>

                {{-- JUDUL --}}
                <h1 class="mt-3 max-w-[460px] text-4xl font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-5xl lg:text-[46px] xl:text-[52px]">
                    Cerita dalam
                    <span class="text-[#0969D8]">
                        Setiap Visual
                    </span>
                </h1>

                {{-- DESKRIPSI --}}
                <p class="mt-5 max-w-[430px] text-sm leading-6 text-[#4F6683] md:text-base md:leading-7">
                    Lihat lebih dekat berbagai produk, aktivitas, dan
                    layanan yang menjadi bagian dari CV Arindah.
                </p>

                {{-- TOMBOL --}}
                <div class="mt-8 flex flex-wrap items-center gap-3">

                    {{-- HUBUNGI KAMI --}}
                    <a
                        href="{{ route('home') }}#kontak"
                        class="group inline-flex items-center gap-2 rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200">

                        Hubungi Kami

                        <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>
                    </a>

                    {{-- LIHAT GALERI --}}
                    <a
                        href="#produk-galeri"
                        class="inline-flex items-center rounded-lg border border-[#9CC3EE] bg-white/70 px-5 py-3 text-sm font-semibold text-[#0969D8] transition duration-300 hover:-translate-y-1 hover:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100">

                        Lihat Galeri
                    </a>

                </div>

            </div>

        </div>
    </div>

</section>




{{-- =========================================================
    PRODUK
========================================================= --}}
<section
    id="produk-galeri"
    class="bg-white px-5 py-14 md:px-6 lg:py-16"
>

    <div class="mx-auto max-w-7xl">


        {{-- =================================================
            SECTION HEADING
        ================================================= --}}
        <div class="mb-8 max-w-2xl">

            <div class="mb-3 flex items-center gap-3">

                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#0969D8]">
                    Produk
                </span>

            </div>


            <h2 class="text-2xl font-bold leading-tight text-[#193F6B] md:text-3xl">

                Beragam Produk untuk

                <span class="text-[#0969D8]">
                    Berbagai Kebutuhan
                </span>

            </h2>


            <p class="mt-3 max-w-2xl text-sm leading-6 text-[#71839A]">

                Beragam produk untuk mendukung kebutuhan teknologi,
                perkantoran, elektronik, dan kebutuhan lainnya.

            </p>

        </div>



        {{-- =================================================
            PRODUCT GALLERY
        ================================================= --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">


            {{-- =================================================
                PRODUK 1
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[280px] overflow-hidden rounded-2xl border border-[#E5EDF6] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.07)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.12)] md:h-[350px]"
                data-gallery="produk"
                data-index="0"
                data-image="{{ asset('images/menugaleri/galeri1.jpg') }}"
                data-title="Produk CV Arindah"
            >

                <img
                    src="{{ asset('images/menugaleri/galeri1.jpg') }}"
                    alt="Produk CV Arindah"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-5">

                    <div class="flex items-end justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-white/70">
                                Produk
                            </p>

                            <h3 class="mt-1 text-base font-semibold text-white">
                                Produk CV Arindah
                            </h3>

                        </div>


                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/90 text-[#0969D8] shadow-lg transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>



            {{-- =================================================
                PRODUK 2
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[280px] overflow-hidden rounded-2xl border border-[#E5EDF6] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.07)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.12)] md:h-[350px]"
                data-gallery="produk"
                data-index="1"
                data-image="{{ asset('images/menugaleri/gambar2.jpg') }}"
                data-title="Produk dan Perlengkapan"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar2.jpg') }}"
                    alt="Produk dan perlengkapan"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-5">

                    <div class="flex items-end justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-white/70">
                                Produk
                            </p>

                            <h3 class="mt-1 text-base font-semibold text-white">
                                Produk dan Perlengkapan
                            </h3>

                        </div>


                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/90 text-[#0969D8] shadow-lg transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>



            {{-- =================================================
                PRODUK 3
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[180px] overflow-hidden rounded-2xl border border-[#E5EDF6] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.07)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.12)]"
                data-gallery="produk"
                data-index="2"
                data-image="{{ asset('images/menugaleri/gambar3.jpg') }}"
                data-title="Perlengkapan Pendukung"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar3.jpg') }}"
                    alt="Perlengkapan pendukung"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-4">

                    <div class="flex items-center justify-between gap-3">

                        <h3 class="text-sm font-semibold text-white">
                            Perlengkapan Pendukung
                        </h3>


                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/90 text-sm text-[#0969D8] shadow-md transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>



            {{-- =================================================
                PRODUK 4
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[180px] overflow-hidden rounded-2xl border border-[#E5EDF6] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.07)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.12)]"
                data-gallery="produk"
                data-index="3"
                data-image="{{ asset('images/menugaleri/gambar4.jpg') }}"
                data-title="Laboratorium dan Peralatan"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar4.jpg') }}"
                    alt="Laboratorium dan peralatan"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-4">

                    <div class="flex items-center justify-between gap-3">

                        <h3 class="text-sm font-semibold text-white">
                            Laboratorium dan Peralatan
                        </h3>


                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/90 text-sm text-[#0969D8] shadow-md transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>

        </div>

    </div>

</section>



{{-- =========================================================
    JASA & LAYANAN
========================================================= --}}
<section
    id="layanan-galeri"
    class="bg-[#F5F9FD] px-5 py-14 md:px-6 lg:py-16"
>

    <div class="mx-auto max-w-7xl">


        {{-- =================================================
            SECTION HEADING
        ================================================= --}}
        <div class="mb-8 max-w-2xl">

            <div class="mb-3 flex items-center gap-3">

                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#0969D8]">
                    Jasa & Layanan
                </span>

            </div>


            <h2 class="text-2xl font-bold leading-tight text-[#193F6B] md:text-3xl">

                Aktivitas dan

                <span class="text-[#0969D8]">
                    Layanan CV Arindah
                </span>

            </h2>


            <p class="mt-3 max-w-2xl text-sm leading-6 text-[#71839A]">

                Aktivitas teknologi informasi dan jasa komputer yang
                menjadi bagian dari layanan CV Arindah.

            </p>

        </div>



        {{-- =================================================
            SERVICE GALLERY
        ================================================= --}}
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">


            {{-- =================================================
                JASA 1
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[280px] overflow-hidden rounded-2xl border border-[#DCE8F4] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.06)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.11)] md:h-[350px]"
                data-gallery="jasa"
                data-index="0"
                data-image="{{ asset('images/menugaleri/gambar5.jpg') }}"
                data-title="Aktivitas Teknologi Informasi"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar5.jpg') }}"
                    alt="Aktivitas teknologi informasi"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-5">

                    <div class="flex items-end justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-white/70">
                                Jasa & Layanan
                            </p>

                            <h3 class="mt-1 text-base font-semibold text-white">
                                Aktivitas Teknologi Informasi
                            </h3>

                        </div>


                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/90 text-[#0969D8] shadow-lg transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>



            {{-- =================================================
                JASA 2
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[280px] overflow-hidden rounded-2xl border border-[#DCE8F4] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.06)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.11)] md:h-[350px]"
                data-gallery="jasa"
                data-index="1"
                data-image="{{ asset('images/menugaleri/gambar6.jpg') }}"
                data-title="Presentasi dan Teknologi"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar6.jpg') }}"
                    alt="Presentasi dan teknologi"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-5">

                    <div class="flex items-end justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-bold uppercase tracking-[0.15em] text-white/70">
                                Jasa & Layanan
                            </p>

                            <h3 class="mt-1 text-base font-semibold text-white">
                                Presentasi dan Teknologi
                            </h3>

                        </div>


                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/90 text-[#0969D8] shadow-lg transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>



            {{-- =================================================
                JASA 3
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[180px] overflow-hidden rounded-2xl border border-[#DCE8F4] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.06)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.11)]"
                data-gallery="jasa"
                data-index="2"
                data-image="{{ asset('images/menugaleri/gambar7.jpg') }}"
                data-title="Konsultasi dan Kerja Sama"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar7.jpg') }}"
                    alt="Konsultasi dan kerja sama"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-4">

                    <div class="flex items-center justify-between gap-3">

                        <h3 class="text-sm font-semibold text-white">
                            Konsultasi dan Kerja Sama
                        </h3>


                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/90 text-sm text-[#0969D8] shadow-md transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>



            {{-- =================================================
                JASA 4
            ================================================= --}}
            <button
                type="button"
                class="gallery-item group relative h-[180px] overflow-hidden rounded-2xl border border-[#DCE8F4] bg-white text-left shadow-[0_8px_25px_rgba(27,69,109,0.06)] transition duration-500 hover:-translate-y-1 hover:shadow-[0_16px_35px_rgba(27,69,109,0.11)]"
                data-gallery="jasa"
                data-index="3"
                data-image="{{ asset('images/menugaleri/gambar8.jpg') }}"
                data-title="Layanan Teknologi"
            >

                <img
                    src="{{ asset('images/menugaleri/gambar8.jpg') }}"
                    alt="Layanan teknologi"
                    class="h-full w-full object-cover transition duration-700 group-hover:scale-105"
                >


                <div class="absolute inset-0 bg-gradient-to-t from-[#082B4D]/70 via-transparent to-transparent opacity-70"></div>


                <div class="absolute bottom-0 left-0 right-0 p-4">

                    <div class="flex items-center justify-between gap-3">

                        <h3 class="text-sm font-semibold text-white">
                            Layanan Teknologi
                        </h3>


                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/90 text-sm text-[#0969D8] shadow-md transition duration-300 group-hover:scale-110">
                            ↗
                        </span>

                    </div>

                </div>

            </button>

        </div>

    </div>

</section>



{{-- =========================================================
    LIGHTBOX / IMAGE PREVIEW
========================================================= --}}
<div
    id="galleryModal"
    class="fixed inset-0 z-[999] hidden items-center justify-center bg-[#071A30]/90 px-4 py-6 opacity-0 backdrop-blur-md transition-opacity duration-300"
    role="dialog"
    aria-modal="true"
    aria-label="Preview gambar galeri"
>


    {{-- =====================================================
        CLOSE
    ====================================================== --}}
    <button
        type="button"
        id="galleryClose"
        class="absolute right-5 top-5 z-30 flex h-11 w-11 items-center justify-center rounded-full border border-white/15 bg-white/10 text-2xl text-white backdrop-blur-md transition duration-300 hover:scale-105 hover:bg-white/20"
        aria-label="Tutup"
    >
        ×
    </button>


    {{-- =====================================================
        PREVIOUS
    ====================================================== --}}
    <button
        type="button"
        id="galleryPrev"
        class="absolute left-4 top-1/2 z-30 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-white/10 text-2xl text-white backdrop-blur-md transition duration-300 hover:scale-105 hover:bg-white/20 md:left-8"
        aria-label="Foto sebelumnya"
    >
        ‹
    </button>


    {{-- =====================================================
        CONTENT
    ====================================================== --}}
    <div
        id="galleryModalContent"
        class="flex max-h-full max-w-5xl scale-95 flex-col items-center transition duration-300"
    >

        {{-- IMAGE --}}
        <div
            class="overflow-hidden rounded-2xl border border-white/10 bg-white/5 p-1 shadow-[0_25px_80px_rgba(0,0,0,0.4)]"
        >

            <img
                id="galleryModalImage"
                src=""
                alt=""
                class="max-h-[72vh] max-w-[88vw] rounded-xl object-contain"
            >

        </div>


        {{-- TITLE + COUNTER --}}
        <div class="mt-4 flex items-center gap-3">

            <p
                id="galleryModalTitle"
                class="text-center text-sm font-medium text-white"
            ></p>

            <span class="h-1 w-1 rounded-full bg-white/40"></span>

            <p
                id="galleryModalCounter"
                class="text-xs font-medium text-white/60"
            ></p>

        </div>

    </div>


    {{-- =====================================================
        NEXT
    ====================================================== --}}
    <button
        type="button"
        id="galleryNext"
        class="absolute right-4 top-1/2 z-30 flex h-12 w-12 -translate-y-1/2 items-center justify-center rounded-full border border-white/15 bg-white/10 text-2xl text-white backdrop-blur-md transition duration-300 hover:scale-105 hover:bg-white/20 md:right-8"
        aria-label="Foto berikutnya"
    >
        ›
    </button>

</div>



{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       ELEMENTS
    ===================================================== */

    const modal =
        document.getElementById('galleryModal');

    const modalContent =
        document.getElementById('galleryModalContent');

    const modalImage =
        document.getElementById('galleryModalImage');

    const modalTitle =
        document.getElementById('galleryModalTitle');

    const modalCounter =
        document.getElementById('galleryModalCounter');

    const closeButton =
        document.getElementById('galleryClose');

    const prevButton =
        document.getElementById('galleryPrev');

    const nextButton =
        document.getElementById('galleryNext');


    /* =====================================================
       GALLERY DATA
    ===================================================== */

    const galleries = {

        produk: Array.from(
            document.querySelectorAll(
                '.gallery-item[data-gallery="produk"]'
            )
        ),

        jasa: Array.from(
            document.querySelectorAll(
                '.gallery-item[data-gallery="jasa"]'
            )
        )

    };


    /* =====================================================
       STATE
    ===================================================== */

    let currentGallery = [];

    let currentIndex = 0;


    /* =====================================================
       OPEN GALLERY
    ===================================================== */

    function openGallery(
        galleryName,
        index
    ) {

        currentGallery =
            galleries[galleryName] || [];

        if (!currentGallery.length) {
            return;
        }

        currentIndex = index;

        updateGallery();

        modal.classList.remove('hidden');

        modal.classList.add('flex');

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(function () {

            modal.classList.remove('opacity-0');

            modalContent.classList.remove('scale-95');

            modalContent.classList.add('scale-100');

        });

    }


    /* =====================================================
       UPDATE GALLERY
    ===================================================== */

    function updateGallery() {

        const item =
            currentGallery[currentIndex];

        if (!item) {
            return;
        }

        modalImage.src =
            item.dataset.image;

        modalImage.alt =
            item.dataset.title || 'Foto galeri';

        modalTitle.textContent =
            item.dataset.title || '';

        modalCounter.textContent =
            `${currentIndex + 1} / ${currentGallery.length}`;

    }


    /* =====================================================
       CLOSE GALLERY
    ===================================================== */

    function closeGallery() {

        modal.classList.add('opacity-0');

        modalContent.classList.remove('scale-100');

        modalContent.classList.add('scale-95');

        setTimeout(function () {

            modal.classList.add('hidden');

            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');

            modalImage.src = '';

        }, 250);

    }


    /* =====================================================
       PREVIOUS
    ===================================================== */

    function showPrevious() {

        if (!currentGallery.length) {
            return;
        }

        currentIndex =
            (currentIndex - 1 + currentGallery.length)
            % currentGallery.length;

        updateGallery();

    }


    /* =====================================================
       NEXT
    ===================================================== */

    function showNext() {

        if (!currentGallery.length) {
            return;
        }

        currentIndex =
            (currentIndex + 1)
            % currentGallery.length;

        updateGallery();

    }


    /* =====================================================
       CLICK GALLERY ITEM
    ===================================================== */

    document
        .querySelectorAll('.gallery-item')
        .forEach(function (item) {

            item.addEventListener(
                'click',
                function () {

                    const galleryName =
                        item.dataset.gallery;

                    const index =
                        Number(item.dataset.index);

                    openGallery(
                        galleryName,
                        index
                    );

                }
            );

        });


    /* =====================================================
       BUTTON EVENTS
    ===================================================== */

    closeButton.addEventListener(
        'click',
        closeGallery
    );

    prevButton.addEventListener(
        'click',
        showPrevious
    );

    nextButton.addEventListener(
        'click',
        showNext
    );


    /* =====================================================
       CLICK OUTSIDE
    ===================================================== */

    modal.addEventListener(
        'click',
        function (event) {

            if (event.target === modal) {

                closeGallery();

            }

        }
    );


    /* =====================================================
       KEYBOARD
    ===================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                modal.classList.contains('hidden')
            ) {
                return;
            }


            if (event.key === 'Escape') {

                closeGallery();

            }


            if (event.key === 'ArrowLeft') {

                showPrevious();

            }


            if (event.key === 'ArrowRight') {

                showNext();

            }

        }
    );


    /* =====================================================
       SCROLL REVEAL
    ===================================================== */

    const galleryItems =
        document.querySelectorAll('.gallery-item');


    if ('IntersectionObserver' in window) {

        const observer =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                entry.target.classList.remove(
                                    'opacity-0',
                                    'translate-y-5'
                                );

                                observer.unobserve(
                                    entry.target
                                );

                            }

                        }
                    );

                },
                {
                    threshold: 0.08
                }
            );


        galleryItems.forEach(
            function (item) {

                item.classList.add(
                    'opacity-0',
                    'translate-y-5',
                    'transition-all',
                    'duration-700'
                );

                observer.observe(item);

            }
        );

    }

});

</script>

@endsection