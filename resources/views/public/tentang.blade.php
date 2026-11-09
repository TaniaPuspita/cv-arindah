@extends('layouts.app')

@section('content')



{{-- =========================================================
    HERO TENTANG KAMI
========================================================= --}}

<section class="relative isolate overflow-hidden bg-[#EAF4FF]">

    {{-- GAMBAR MOBILE --}}
    <div class="relative h-[210px] w-full sm:h-[250px] lg:hidden">
        <img
            src="{{ $aboutPage?->hero_image
                ? asset('storage/' . $aboutPage->hero_image)
                : asset('images/hero_tentangkami.jpg') }}"
            alt="Tentang CV Arindah"
            class="h-full w-full object-cover object-center">

        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#EAF4FF] to-transparent"></div>
    </div>

    {{-- GAMBAR DESKTOP --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-[62%] lg:block"
        aria-hidden="true">

        <img
            src="{{ $aboutPage?->hero_image
                ? asset('storage/' . $aboutPage->hero_image)
                : asset('images/hero_tentangkami.jpg') }}"
            alt=""
            class="h-full w-full object-cover object-center">

        {{-- GRADASI AGAR MENYATU DENGAN AREA TEKS --}}
        <div class="absolute inset-y-0 left-0 w-[65%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/80 to-transparent"></div>

        <div class="absolute inset-x-0 bottom-0 h-16 bg-gradient-to-t from-[#EAF4FF]/40 to-transparent"></div>
    </div>

    {{-- AREA KONTEN --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-5 sm:px-8 lg:px-8">

        <div class="flex items-center py-9 sm:py-11 lg:min-h-[470px] lg:py-10">

            <div class="w-full max-w-[500px]">

                {{-- LABEL --}}
                <p class="text-sm font-bold uppercase leading-6 tracking-wide text-[#0969D8]">
                    {{ $aboutPage?->hero_label ?: 'TENTANG KAMI' }}
                </p>

                {{-- JUDUL --}}
                <h1 class="mt-3 max-w-[460px] text-4xl font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-5xl lg:text-[46px] xl:text-[52px]">
                    {{ $aboutPage?->hero_title_line1 ?: 'Mengenal' }}
                    <span class="block">{{ $aboutPage?->hero_title_line2 ?: 'Lebih Dekat' }}</span>
                    <span class="block text-[#0969D8]">{{ $aboutPage?->hero_title_line3 ?: 'CV Arindah' }}</span>
                </h1>

                {{-- DESKRIPSI --}}
                <p class="mt-5 max-w-[420px] text-sm leading-6 text-[#4F6683] md:text-base md:leading-7">
                    {{ $aboutPage?->hero_description ?: 'Mengenal lebih dekat profil, kegiatan usaha, serta aktivitas CV Arindah dalam menyediakan berbagai kebutuhan produk dan layanan teknologi informasi.' }}
                </p>

                {{-- TOMBOL --}}
                <div class="mt-7 flex flex-wrap items-center gap-3">

                    <a
                        href="{{ route('kontak') }}"
                        class="group inline-flex min-h-[44px] items-center justify-center gap-2 rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-0.5 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200">

                        Hubungi Kami

                        <span class="transition-transform duration-300 group-hover:translate-x-1">
                        </span>
                    </a>

                    <a
                        href="{{ route('produk') }}"
                        class="inline-flex min-h-[44px] items-center justify-center rounded-lg border border-[#9CC3EE] bg-white/80 px-5 py-3 text-sm font-semibold text-[#0969D8] transition duration-300 hover:-translate-y-0.5 hover:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100">

                        Lihat Produk
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>





{{-- =========================================================
    2. MENGENAL LEBIH DEKAT
========================================================= --}}
<section class="bg-white px-5 py-14 md:px-6 lg:py-16">
    <div class="mx-auto max-w-6xl">
        <div class="grid items-center gap-10 lg:grid-cols-[0.85fr_1.15fr]">

            {{-- IMAGE --}}
            <div class="relative">
                <div class="absolute -bottom-4 -left-4 h-full w-full rounded-2xl bg-[#EAF4FF]"></div>

                <div class="group relative overflow-hidden rounded-2xl border border-[#E3ECF5] bg-white shadow-[0_12px_35px_rgba(27,69,109,0.08)]">
                    <img
                        src="{{ $aboutPage && $aboutPage->profile_image
                            ? asset('storage/' . $aboutPage->profile_image)
                            : asset('images/tentangkami/detail_tentangkami.jpg') }}"
                        alt="Aktivitas CV Arindah"
                        class="h-[280px] w-full object-cover transition duration-700 group-hover:scale-105 md:h-[320px]">
                </div>
            </div>

            {{-- TEXT --}}
            <div>
                <span class="text-xs font-bold uppercase tracking-[0.15em] text-[#0969D8]">
                    {{ $aboutPage && $aboutPage->profile_label
                        ? $aboutPage->profile_label
                        : 'Tentang Kami' }}
                </span>

                <h2 class="mt-2 text-2xl font-bold text-[#193F6B] md:text-3xl">
                    {{ $aboutPage && $aboutPage->profile_title
                        ? $aboutPage->profile_title
                        : 'Mengenal CV Arindah' }}
                </h2>

                <div class="mt-4 h-1 w-12 rounded-full bg-[#0969D8]"></div>

                <div class="mt-5 space-y-4 text-sm leading-6 text-[#687C95]">
                    <p>
                        {{ $aboutPage && $aboutPage->profile_paragraph_one
                            ? $aboutPage->profile_paragraph_one
                            : 'CV Arindah merupakan perusahaan yang menjalankan berbagai kegiatan usaha dalam bidang perdagangan barang dan teknologi informasi. Kegiatan usaha yang tersedia mencakup berbagai kategori produk, mulai dari komputer dan teknologi, elektronik dan furniture, perlengkapan kantor, audio dan video, laboratorium dan kesehatan, hingga kebutuhan sehari-hari.' }}
                    </p>

                    <p>
                        {{ $aboutPage && $aboutPage->profile_paragraph_two
                            ? $aboutPage->profile_paragraph_two
                            : 'Selain kegiatan perdagangan, CV Arindah juga memiliki aktivitas di bidang teknologi informasi dan jasa komputer lainnya sebagai bagian dari kegiatan usaha perusahaan.' }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>





{{-- =========================================================
    3. INFORMASI UTAMA
========================================================= --}}
<section class="bg-[#F3F8FE] px-5 py-14 md:px-6 lg:py-16">
    <div class="mx-auto max-w-7xl">

        <div class="mb-8">
            <span class="text-xs font-bold uppercase tracking-[0.15em] text-[#0969D8]">
                {{ $aboutPage?->info_label ?: 'CV Arindah Dalam Singkat' }}
            </span>

            <h2 class="mt-2 text-2xl font-bold text-[#193F6B] md:text-3xl">
                {{ $aboutPage?->info_title ?: 'Informasi Utama Kami' }}
            </h2>
        </div>

        <div class="grid gap-5 md:grid-cols-3">

            {{-- CARD 1 --}}
            <div class="group relative overflow-hidden rounded-2xl border border-[#C9DDF5] bg-[#CFE3FC] p-6 shadow-[0_8px_22px_rgba(27,69,109,0.06)] transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_16px_32px_rgba(27,69,109,0.12)]">
                <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-white/20 transition duration-500 group-hover:scale-125"></div>

                <div class="relative flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white shadow-sm transition duration-500 group-hover:rotate-3 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-[#193F6B]">
                            {{ $aboutPage?->info_one_title ?: '6 Kategori Produk' }}
                        </h3>
                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            {{ $aboutPage?->info_one_description ?: 'Beragam kategori produk untuk memenuhi berbagai kebutuhan pelanggan.' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="group relative overflow-hidden rounded-2xl border border-[#C9DDF5] bg-[#CFE3FC] p-6 shadow-[0_8px_22px_rgba(27,69,109,0.06)] transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_16px_32px_rgba(27,69,109,0.12)]">
                <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-white/20 transition duration-500 group-hover:scale-125"></div>

                <div class="relative flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white shadow-sm transition duration-500 group-hover:-rotate-3 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <rect x="3" y="4" width="18" height="13" rx="2"/>
                            <path stroke-linecap="round" d="M8 21h8M12 17v4"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-[#193F6B]">
                            {{ $aboutPage?->info_two_title ?: 'Teknologi Informasi' }}
                        </h3>
                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            {{ $aboutPage?->info_two_description ?: 'Aktivitas teknologi informasi dan jasa komputer lainnya sebagai bagian dari kegiatan usaha perusahaan.' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="group relative overflow-hidden rounded-2xl border border-[#C9DDF5] bg-[#CFE3FC] p-6 shadow-[0_8px_22px_rgba(27,69,109,0.06)] transition-all duration-500 hover:-translate-y-2 hover:shadow-[0_16px_32px_rgba(27,69,109,0.12)]">
                <div class="pointer-events-none absolute -right-10 -top-10 h-28 w-28 rounded-full bg-white/20 transition duration-500 group-hover:scale-125"></div>

                <div class="relative flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white shadow-sm transition duration-500 group-hover:rotate-3 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s8-6.2 8-12a8 8 0 10-16 0c0 5.8 8 12 8 12z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-[#193F6B]">
                            {{ $aboutPage?->info_three_title ?: 'Berbasis di Bali' }}
                        </h3>
                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            {{ $aboutPage?->info_three_description ?: 'Jalan Dewaratwati Nomor 23, Mengwitani, Mengwi, Badung, Bali.' }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




{{-- =========================================================
    4. VISI & MISI
========================================================= --}}
<section class="relative overflow-hidden bg-white px-5 py-16 md:px-6 lg:py-20">

    <div class="pointer-events-none absolute -left-32 top-20 h-72 w-72 rounded-full bg-[#EAF4FF]"></div>
    <div class="pointer-events-none absolute -right-40 bottom-0 h-80 w-80 rounded-full bg-[#F3F8FE]"></div>

    <div class="relative mx-auto max-w-6xl">

        {{-- SECTION HEADER --}}
        <div class="mb-10 text-center">
            <div class="mb-3 flex items-center justify-center gap-3">
                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>
                <span class="text-xs font-bold uppercase tracking-[0.2em] text-[#0969D8]">
                    {{ $aboutPage?->vision_mission_label ?: 'Visi & Misi' }}
                </span>
                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>
            </div>

            <h2 class="text-3xl font-bold text-[#193F6B] md:text-4xl">
                {{ $aboutPage?->vision_mission_title ?: 'Visi dan Misi CV Arindah' }}
            </h2>

            <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-[#71839A]">
                {{ $aboutPage?->vision_mission_description ?: 'Landasan dan arah CV Arindah dalam memberikan produk dan layanan terbaik bagi pelanggan.' }}
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">

            {{-- VISI --}}
            <div class="group relative overflow-hidden rounded-3xl border border-[#DFEAF5] bg-white p-7 shadow-[0_10px_35px_rgba(27,69,109,0.08)] transition-all duration-500 hover:-translate-y-2 hover:border-[#C4DCF5] hover:shadow-[0_20px_45px_rgba(27,69,109,0.14)] md:p-8">

                <div class="absolute left-0 top-0 h-full w-1.5 bg-[#0969D8] transition-all duration-500 group-hover:w-2"></div>
                <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#F0F7FF] transition duration-500 group-hover:scale-125"></div>

                <div class="relative flex items-center gap-5">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-[#0969D8] text-white shadow-[0_8px_20px_rgba(9,105,216,0.20)] transition duration-500 group-hover:rotate-3 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <circle cx="12" cy="12" r="9"/>
                            <circle cx="12" cy="12" r="5"/>
                            <circle cx="12" cy="12" r="1.5" fill="currentColor" stroke="none"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#7B91AA]">
                            Arah Perusahaan
                        </p>
                        <h3 class="mt-1 text-2xl font-bold text-[#0969D8]">
                            Visi
                        </h3>
                    </div>
                </div>

                <div class="relative my-6 h-px bg-[#E6EEF7]"></div>

                <p class="relative text-base font-medium leading-8 text-[#526A84] md:text-lg">
                    {{ $aboutPage?->vision ?: 'Menjadi perusahaan yang mampu memenuhi beragam kebutuhan pelanggan melalui penyediaan produk dan layanan teknologi informasi yang sesuai dengan kebutuhan.' }}
                </p>

                <div class="relative mt-7 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#0969D8]"></span>
                    <span class="h-1.5 w-8 rounded-full bg-[#D9E9FA] transition-all duration-500 group-hover:w-12 group-hover:bg-[#0969D8]"></span>
                    <span class="text-[10px] font-semibold uppercase tracking-wider text-[#8A9DB3]">
                        CV Arindah
                    </span>
                </div>
            </div>

            {{-- MISI --}}
            <div class="group relative overflow-hidden rounded-3xl border border-[#DFEAF5] bg-white p-7 shadow-[0_10px_35px_rgba(27,69,109,0.08)] transition-all duration-500 hover:-translate-y-2 hover:border-[#C4DCF5] hover:shadow-[0_20px_45px_rgba(27,69,109,0.14)] md:p-8">

                <div class="absolute left-0 top-0 h-full w-1.5 bg-[#0969D8] transition-all duration-500 group-hover:w-2"></div>
                <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#F0F7FF] transition duration-500 group-hover:scale-125"></div>

                <div class="relative flex items-center gap-5">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-[#0969D8] text-white shadow-[0_8px_20px_rgba(9,105,216,0.20)] transition duration-500 group-hover:-rotate-3 group-hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <circle cx="12" cy="12" r="9"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"/>
                        </svg>
                    </div>

                    <div>
                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#7B91AA]">
                            Fokus Perusahaan
                        </p>
                        <h3 class="mt-1 text-2xl font-bold text-[#0969D8]">
                            Misi
                        </h3>
                    </div>
                </div>

                <div class="relative my-6 h-px bg-[#E6EEF7]"></div>

                <p class="relative text-sm leading-6 text-[#71839A]">
                    {{ $aboutPage?->mission_description ?: 'Memberikan produk dan layanan yang dapat membantu memenuhi kebutuhan pelanggan serta mendukung kebutuhan teknologi informasi.' }}
                </p>

                <div class="relative mt-5 space-y-4">

                    {{-- MISSION 01 --}}
                    <div class="group/item flex gap-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#CFE2F7] bg-[#F3F8FE] text-sm font-bold text-[#0969D8] transition duration-300 group-hover/item:bg-[#0969D8] group-hover/item:text-white">
                            01
                        </div>

                        <div>
                            <h4 class="text-sm font-bold text-[#0969D8]">
                                {{ $aboutPage?->mission_one_title ?: 'Menyediakan Beragam Produk' }}
                            </h4>
                            <p class="mt-1 text-xs leading-5 text-[#71839A]">
                                {{ $aboutPage?->mission_one_description ?: 'Menyediakan berbagai kategori produk untuk memenuhi kebutuhan pelanggan.' }}
                            </p>
                        </div>
                    </div>

                    {{-- MISSION 02 --}}
                    <div class="group/item flex gap-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#CFE2F7] bg-[#F3F8FE] text-sm font-bold text-[#0969D8] transition duration-300 group-hover/item:bg-[#0969D8] group-hover/item:text-white">
                            02
                        </div>

                        <div>
                            <h4 class="text-sm font-bold text-[#0969D8]">
                                {{ $aboutPage?->mission_two_title ?: 'Mendukung Kebutuhan Teknologi' }}
                            </h4>
                            <p class="mt-1 text-xs leading-5 text-[#71839A]">
                                {{ $aboutPage?->mission_two_description ?: 'Menyediakan produk komputer dan teknologi serta aktivitas teknologi informasi sesuai dengan bidang usaha perusahaan.' }}
                            </p>
                        </div>
                    </div>

                    {{-- MISSION 03 --}}
                    <div class="group/item flex gap-4">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-[#CFE2F7] bg-[#F3F8FE] text-sm font-bold text-[#0969D8] transition duration-300 group-hover/item:bg-[#0969D8] group-hover/item:text-white">
                            03
                        </div>

                        <div>
                            <h4 class="text-sm font-bold text-[#0969D8]">
                                {{ $aboutPage?->mission_three_title ?: 'Memberikan Informasi yang Jelas' }}
                            </h4>
                            <p class="mt-1 text-xs leading-5 text-[#71839A]">
                                {{ $aboutPage?->mission_three_description ?: 'Menyediakan informasi yang membantu pelanggan mengenali produk dan layanan yang tersedia.' }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>




{{-- =========================================================
    5. CTA
========================================================= --}}
<section class="relative overflow-hidden bg-[#EAF4FF] px-5 py-10 md:px-6 lg:py-14">

    {{-- Decorative --}}
    <div class="pointer-events-none absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/70 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[#C8DEFF]/70 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl">
        <div class="grid items-stretch gap-5 lg:grid-cols-[1.25fr_0.75fr]">

            {{-- CTA CONTENT --}}
            <div class="group relative overflow-hidden rounded-2xl border border-white/80 bg-white p-7 shadow-[0_15px_45px_rgba(15,23,42,0.08)] sm:p-9">

                <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#EAF4FF] transition duration-500 group-hover:scale-125"></div>

                <div class="relative z-10">

                    {{-- CTA LABEL --}}
                    <div class="flex items-center gap-3">
                        <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                        <p class="text-xs font-bold tracking-[0.15em] text-[#0969D8]">
                            {{ $aboutPage?->cta_label ?: 'BUTUH INFORMASI LEBIH LANJUT?' }}
                        </p>
                    </div>

                    {{-- CTA TITLE --}}
                    @php
                        $ctaTitle = $aboutPage?->cta_title
                            ?: 'Mari Terhubung dengan CV Arindah';

                        $highlightText = 'CV Arindah';
                    @endphp

                    <h2 class="mt-5 text-2xl font-bold leading-tight text-[#123B68] md:text-3xl">
                        @if(\Illuminate\Support\Str::contains($ctaTitle, $highlightText))
                            {{ \Illuminate\Support\Str::before($ctaTitle, $highlightText) }}<span class="text-[#0969D8]">{{ $highlightText }}</span>{{ \Illuminate\Support\Str::after($ctaTitle, $highlightText) }}
                        @else
                            {{ $ctaTitle }}
                        @endif
                    </h2>

                    {{-- CTA DESCRIPTION --}}
                    <p class="mt-3 max-w-xl text-sm leading-6 text-[#64748B]">
                        {{ $aboutPage?->cta_description ?: 'Hubungi CV Arindah untuk mendapatkan informasi mengenai produk dan layanan yang tersedia.' }}
                    </p>

                    
{{-- CTA BUTTON --}}
<div class="mt-6 flex justify-center">
    <a href="{{ route('kontak') }}"
       class="group inline-flex items-center gap-2 rounded-lg bg-[#0988F5] px-5 py-3 text-sm font-semibold text-white shadow-[0_7px_18px_rgba(9,136,245,0.22)] transition duration-300 hover:-translate-y-1 hover:bg-[#0879DB] hover:shadow-lg">

        {{ $aboutPage?->cta_button_text ?: 'Hubungi Kami' }}

        <span class="transition duration-300 group-hover:translate-x-1">
            <i class="bi bi-arrow-right"></i>
        </span>
    </a>
</div>


                </div>
            </div>

            {{-- CTA IMAGE --}}
            <div class="group relative min-h-[230px] overflow-hidden rounded-2xl shadow-[0_15px_40px_rgba(15,23,42,0.10)]">

                <img
                    src="{{ $aboutPage?->cta_image ? asset('storage/' . $aboutPage->cta_image) : asset('images/tentangkami/cta_tentangkami.jpg') }}"
                    alt="Hubungi CV Arindah"
                    class="h-full min-h-[230px] w-full object-cover transition duration-700 group-hover:scale-105"
                    loading="lazy"
                    onerror="this.onerror=null; this.src='{{ asset('images/tentangkami/cta_tentangkami.jpg') }}';">

                <div class="absolute inset-0 bg-gradient-to-t from-[#123B68]/35 via-transparent to-transparent"></div>

                <div class="absolute bottom-5 left-5 rounded-full border border-white/30 bg-white/15 px-4 py-2 text-[10px] font-semibold text-white backdrop-blur-md">
                    CV Arindah
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
