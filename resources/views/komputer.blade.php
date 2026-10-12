@extends('layouts.app')

@section('title', 'Komputer & Teknologi - CV Arindah')

@section('content')

{{-- =========================================================
     HERO
========================================================= --}}
<section class="relative overflow-hidden bg-white pt-[78px]">

    <div
        class="relative mx-auto min-h-[430px] max-w-[1440px] overflow-hidden bg-[#EAF4FF]"
    >

        {{-- Decorative background --}}
        <div
            class="absolute -right-[160px] -top-[180px] h-[520px] w-[520px] rounded-full bg-[#C9DEFF]/70"
        ></div>

        <div
            class="absolute bottom-[-180px] left-[38%] h-[360px] w-[360px] rounded-full bg-white/40 blur-2xl"
        ></div>


        {{-- HERO IMAGE --}}
        <div
            class="absolute right-0 top-0 hidden h-full w-[46%] overflow-hidden lg:block"
        >

            <div
                class="absolute inset-0 z-10 bg-gradient-to-r from-[#EAF4FF] via-transparent to-transparent"
            ></div>

            <img
                src="/images/hero_detail_komputer.jpg"
                alt="Komputer dan Teknologi CV Arindah"
                class="h-full w-full object-cover object-center transition duration-700 ease-out hover:scale-[1.035]"
            >

            {{-- Image overlay --}}
            <div class="absolute inset-0 bg-[#0969D8]/10"></div>

        </div>


        {{-- HERO CONTENT --}}
        <div
            class="relative z-20 flex min-h-[430px] items-center px-6 py-14 sm:px-8 lg:px-12"
        >

            <div class="w-full max-w-[650px]">

                {{-- Back button --}}
                <a
                    href="{{ route('produk') }}"
                    class="group inline-flex items-center gap-2 rounded-full border border-[#C8DFFF] bg-white/90 px-4 py-2.5 text-[12px] font-semibold text-[#0969D8] shadow-[0_5px_18px_rgba(15,23,42,0.07)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#0969D8] hover:shadow-[0_8px_24px_rgba(9,105,216,0.14)]"
                >

                    <span class="transition duration-300 group-hover:-translate-x-1">
                        ←
                    </span>

                    Kembali ke Semua Produk

                </a>


                {{-- Label --}}
                <div class="mt-10 flex items-center gap-3">

                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[13px] font-bold tracking-[1.8px] text-[#0969D8]">
                        PRODUK
                    </p>

                </div>


                {{-- Heading --}}
                <h1
                    class="mt-4 max-w-[650px] text-[38px] font-bold leading-[1.08] tracking-[-1.2px] text-[#123B68] sm:text-[46px] lg:text-[50px]"
                >

                    Komputer &

                    <span class="relative inline-block text-[#0969D8]">

                        Teknologi

                        <span
                            class="absolute -bottom-1 left-0 h-[5px] w-[68%] rounded-full bg-[#BBD7FF]"
                        ></span>

                    </span>

                </h1>


                {{-- Description --}}
                <p
                    class="mt-5 max-w-[560px] text-[14px] leading-[1.75] text-[#64748B] sm:text-[15px]"
                >
                    Berbagai produk komputer dan teknologi untuk mendukung
                    kebutuhan kerja, pendidikan, maupun aktivitas digital
                    sehari-hari.
                </p>


                {{-- Small info --}}
                <div class="mt-7 flex flex-wrap gap-3">

                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm"
                    >

                        <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>

                        Komputer

                    </div>


                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm"
                    >

                        <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>

                        Teknologi

                    </div>


                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm"
                    >

                        <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>

                        Perlengkapan Digital

                    </div>

                </div>

            </div>

        </div>


        {{-- Mobile image --}}
        <div class="relative h-[240px] lg:hidden">

            <img
                src="/images/komputer_teknologi.jpg"
                alt="Komputer dan Teknologi CV Arindah"
                class="h-full w-full object-cover"
            >

            <div
                class="absolute inset-0 bg-gradient-to-t from-[#EAF4FF] via-transparent to-transparent"
            ></div>

        </div>

    </div>

</section>


{{-- =========================================================
     TENTANG KATEGORI
========================================================= --}}
<section class="bg-white py-20 lg:py-24">

    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">

        <div class="grid items-center gap-12 lg:grid-cols-[1fr_0.9fr] lg:gap-16">


            {{-- IMAGE --}}
            <div class="group relative">

                {{-- Decorative frame --}}
                <div
                    class="absolute -bottom-4 -left-4 h-full w-full rounded-[20px] border border-[#D8E8FA]"
                ></div>


                <div
                    class="relative overflow-hidden rounded-[18px] bg-[#EEF7FF] shadow-[0_18px_45px_rgba(15,23,42,0.10)]"
                >

                    <img
                        src="/images/detail_komputrer_teknologi.jpg"
                        alt="Produk komputer dan teknologi"
                        class="h-[330px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.035] sm:h-[370px] lg:h-[400px]"
                    >

                </div>


                {{-- Floating label --}}
                <div
                    class="absolute -bottom-5 right-5 rounded-[12px] border border-white/70 bg-white/95 px-5 py-3 shadow-[0_10px_30px_rgba(15,23,42,0.12)] backdrop-blur-md"
                >

                    <p class="text-[10px] font-semibold tracking-[1px] text-[#64748B]">
                        CV ARINDAH
                    </p>

                    <p class="mt-1 text-[12px] font-bold text-[#123B68]">
                        Komputer & Teknologi
                    </p>

                </div>

            </div>


            {{-- TEXT --}}
            <div>

                <div class="flex items-center gap-3">

                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                        TENTANG KATEGORI
                    </p>

                </div>


                <h2
                    class="mt-5 text-[32px] font-bold leading-[1.15] tracking-[-0.8px] text-[#123B68] sm:text-[38px]"
                >

                    Perlengkapan yang

                    <span class="text-[#0969D8]">
                        Mendukung Kebutuhan Digital
                    </span>

                </h2>


                <p class="mt-5 text-[15px] leading-[1.8] text-[#64748B]">
                    CV Arindah menyediakan berbagai produk komputer dan
                    teknologi sesuai dengan kebutuhan pelanggan. Produk dalam
                    kategori ini dapat mendukung aktivitas kerja, pendidikan,
                    penggunaan perangkat digital, maupun berbagai kebutuhan
                    teknologi lainnya.
                </p>


                {{-- Mini highlights --}}
                <div class="mt-8 grid gap-4 sm:grid-cols-2">


                    {{-- Highlight 1 --}}
                    <div
                        class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]"
                    >

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]"
                        >

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <rect
                                    x="3"
                                    y="4"
                                    width="18"
                                    height="16"
                                    rx="2"
                                />

                                <path d="M8 20v-3h8v3"/>

                                <path d="M7 8h10"/>

                            </svg>

                        </div>


                        <p class="mt-3 text-[12px] font-bold text-[#123B68]">
                            Produk Komputer
                        </p>

                        <p class="mt-1 text-[11px] leading-[1.5] text-[#64748B]">
                            Mendukung kebutuhan perangkat dan aktivitas digital.
                        </p>

                    </div>


                    {{-- Highlight 2 --}}
                    <div
                        class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]"
                    >

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]"
                        >

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >

                                <rect
                                    x="4"
                                    y="4"
                                    width="16"
                                    height="13"
                                    rx="2"
                                />

                                <path d="M8 21h8"/>

                                <path d="M12 17v4"/>

                            </svg>

                        </div>


                        <p class="mt-3 text-[12px] font-bold text-[#123B68]">
                            Teknologi
                        </p>

                        <p class="mt-1 text-[11px] leading-[1.5] text-[#64748B]">
                            Mendukung aktivitas kerja, pendidikan, dan kebutuhan lainnya.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     KEUNGGULAN
========================================================= --}}
<section class="relative overflow-hidden bg-[#F6FAFF] py-20 lg:py-24">

    {{-- Decorative --}}
    <div
        class="absolute -right-32 top-20 h-72 w-72 rounded-full bg-[#DCEBFF]/70 blur-3xl"
    ></div>

    <div
        class="absolute -left-32 bottom-0 h-72 w-72 rounded-full bg-white/80 blur-3xl"
    ></div>


    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        {{-- Heading --}}
        <div class="max-w-[620px]">

            <div class="flex items-center gap-3">

                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                    KELEBIHAN PRODUK
                </p>

            </div>


            <h2
                class="mt-5 text-[32px] font-bold leading-[1.15] tracking-[-0.8px] text-[#123B68] sm:text-[38px]"
            >

                Keunggulan

                <span class="text-[#0969D8]">
                    Kategori
                </span>

            </h2>


            <p class="mt-4 text-[14px] leading-[1.7] text-[#64748B]">
                Pilihan produk komputer dan teknologi yang dirancang untuk
                membantu memenuhi kebutuhan perangkat, pekerjaan, pendidikan,
                dan aktivitas digital Anda.
            </p>

        </div>


        {{-- Cards --}}
        <div class="mt-12 grid gap-5 md:grid-cols-3">


            {{-- CARD 1 --}}
            <div
                class="group relative overflow-hidden rounded-[18px] border border-[#D8E7F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#A9CCFF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]"
            >

                <div
                    class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"
                ></div>


                <div
                    class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E8F2FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white"
                >

                    <svg
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <path d="m12 3 8 4-8 4-8-4 8-4Z"/>

                        <path d="m4 12 8 4 8-4"/>

                        <path d="m4 17 8 4 8-4"/>

                    </svg>

                </div>


                <p class="mt-7 text-[15px] font-bold text-[#123B68]">
                    Beragam Pilihan
                </p>


                <p class="mt-2 text-[12px] leading-[1.7] text-[#64748B]">
                    Berbagai produk komputer dan teknologi dalam kategori
                    yang tersedia untuk memenuhi kebutuhan Anda.
                </p>

            </div>


            {{-- CARD 2 --}}
            <div
                class="group relative overflow-hidden rounded-[18px] border border-[#D8E7F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#A9CCFF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]"
            >

                <div
                    class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"
                ></div>


                <div
                    class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E8F2FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white"
                >

                    <svg
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <rect
                            x="7"
                            y="7"
                            width="10"
                            height="13"
                            rx="2"
                        />

                        <path d="M9 7V5a3 3 0 0 1 6 0v2"/>

                        <path d="M4 10h3"/>

                        <path d="M17 10h3"/>

                    </svg>

                </div>


                <p class="mt-7 text-[15px] font-bold text-[#123B68]">
                    Pilihan Sesuai Kebutuhan
                </p>


                <p class="mt-2 text-[12px] leading-[1.7] text-[#64748B]">
                    Pilihan produk yang dapat disesuaikan dengan kebutuhan
                    kerja, pendidikan, maupun penggunaan lainnya.
                </p>

            </div>


            {{-- CARD 3 --}}
            <div
                class="group relative overflow-hidden rounded-[18px] border border-[#D8E7F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#A9CCFF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]"
            >

                <div
                    class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"
                ></div>


                <div
                    class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E8F2FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white"
                >

                    <svg
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                        />

                        <path d="M12 10v6"/>

                        <path d="M12 7h.01"/>

                    </svg>

                </div>


                <p class="mt-7 text-[15px] font-bold text-[#123B68]">
                    Informasi Lengkap
                </p>


                <p class="mt-2 text-[12px] leading-[1.7] text-[#64748B]">
                    Informasi lebih lanjut mengenai produk komputer dan
                    teknologi dapat diperoleh melalui CV Arindah.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     CTA
========================================================= --}}
<section class="relative overflow-hidden bg-[#DCEEFF] py-20 lg:py-24">

    {{-- Decorative --}}
    <div
        class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/60 blur-3xl"
    ></div>

    <div
        class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[#B8D9FA]/70 blur-3xl"
    ></div>


    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        <div
            class="grid items-stretch gap-5 lg:grid-cols-[1.25fr_0.75fr]"
        >


            {{-- CTA CONTENT --}}
            <div
                class="group relative overflow-hidden rounded-[20px] border border-white/80 bg-white p-7 shadow-[0_15px_45px_rgba(15,23,42,0.08)] sm:p-9 lg:p-10"
            >

                {{-- Decorative circle --}}
                <div
                    class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#EAF4FF] transition duration-500 group-hover:scale-125"
                ></div>


                <div class="relative z-10">

                    <div class="flex items-center gap-3">

                        <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                        <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                            BUTUH PRODUK?
                        </p>

                    </div>


                    <h2
                        class="mt-5 max-w-[600px] text-[28px] font-bold leading-[1.2] tracking-[-0.5px] text-[#123B68] sm:text-[34px]"
                    >

                        Temukan Produk yang

                        <span class="text-[#0969D8]">
                            Sesuai Kebutuhan Anda
                        </span>

                    </h2>


                    <p
                        class="mt-4 max-w-[590px] text-[13px] leading-[1.7] text-[#64748B]"
                    >
                        Hubungi CV Arindah untuk mendapatkan informasi lebih
                        lanjut mengenai produk komputer, teknologi, dan layanan
                        yang tersedia.
                    </p>


                    <div class="mt-7">

                        <a
                            href="mailto:cv.arindah2016@gmail.com"
                            class="group inline-flex items-center gap-3 rounded-[11px] bg-[#0969D8] px-6 py-3 text-[13px] font-bold text-white shadow-[0_8px_20px_rgba(9,105,216,0.22)] transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] hover:shadow-[0_12px_28px_rgba(9,105,216,0.28)]"
                        >

                            Hubungi Kami

                            <span class="transition duration-300 group-hover:translate-x-1">
                                →
                            </span>

                        </a>

                    </div>

                </div>

            </div>


            {{-- CTA IMAGE --}}
            <div
                class="group relative min-h-[250px] overflow-hidden rounded-[20px] shadow-[0_15px_40px_rgba(15,23,42,0.10)]"
            >

                <img
                    src="/images/cta_produk_layanan.jpg"
                    alt="Hubungi CV Arindah"
                    class="h-full min-h-[250px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]"
                >

                <div
                    class="absolute inset-0 bg-gradient-to-t from-[#123B68]/45 via-transparent to-transparent"
                ></div>


                <div class="absolute bottom-6 left-6 right-6">

                    <div
                        class="inline-flex rounded-full border border-white/30 bg-white/15 px-4 py-2 text-[11px] font-medium text-white backdrop-blur-md"
                    >
                        CV Arindah
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection