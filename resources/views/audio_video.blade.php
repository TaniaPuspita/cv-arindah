@extends('layouts.app')

@section('title', (($detail?->hero_title) ?: 'Audio & Video') . ' - CV Arindah')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA CMS
    |--------------------------------------------------------------------------
    | Desain asli dipertahankan.
    | Data teks dan gambar diambil dari $detail.
    | Jika kolom CMS kosong, gunakan konten bawaan.
    */

    $heroLabel = $detail?->hero_label ?: 'PRODUK';
    $heroTitle = $detail?->hero_title ?: 'Audio & Video';
    $heroDescription = $detail?->hero_description
        ?: 'Berbagai perlengkapan audio dan video untuk mendukung kebutuhan penggunaan perangkat audiovisual.';

    $aboutTitle = $detail?->about_title
        ?: 'Perlengkapan untuk Mendukung Kebutuhan Audiovisual';
    $aboutDescription = $detail?->about_description
        ?: 'CV Arindah menyediakan berbagai produk audio dan video sesuai dengan kategori produk yang tersedia. Produk dalam kategori ini ditujukan untuk mendukung kebutuhan penggunaan perangkat audiovisual dalam berbagai aktivitas.';

    $highlight1Title = $detail?->about_highlight_1_title ?: 'Perangkat Audio';
    $highlight1Description = $detail?->about_highlight_1_description
        ?: 'Mendukung kebutuhan suara dan penggunaan perangkat audio.';

    $highlight2Title = $detail?->about_highlight_2_title ?: 'Perangkat Video';
    $highlight2Description = $detail?->about_highlight_2_description
        ?: 'Mendukung kebutuhan tampilan dan penggunaan perangkat video.';

    $advantagesTitle = $detail?->advantages_title ?: 'Keunggulan Kategori';
    $advantagesDescription = $detail?->advantages_description
        ?: 'Pilihan produk audio dan video yang dirancang untuk membantu memenuhi kebutuhan perangkat audiovisual Anda.';

    $advantage1Title = $detail?->advantage_1_title ?: 'Beragam Pilihan';
    $advantage1Description = $detail?->advantage_1_description
        ?: 'Berbagai produk dalam kategori audio dan video yang tersedia untuk memenuhi kebutuhan Anda.';

    $advantage2Title = $detail?->advantage_2_title ?: 'Mendukung Aktivitas';
    $advantage2Description = $detail?->advantage_2_description
        ?: 'Mendukung kebutuhan penggunaan perangkat audio dan video dalam berbagai aktivitas.';

    $advantage3Title = $detail?->advantage_3_title ?: 'Informasi Lengkap';
    $advantage3Description = $detail?->advantage_3_description
        ?: 'Informasi lebih lanjut mengenai produk audio dan video dapat diperoleh melalui CV Arindah.';

    $ctaTitle = $detail?->cta_title
        ?: 'Temukan Produk yang Sesuai Kebutuhan Anda';
    $ctaDescription = $detail?->cta_description
        ?: 'Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut mengenai produk audio, video, dan layanan yang tersedia.';
    $ctaButtonText = $detail?->cta_button_text ?: 'Hubungi Kami';
    $ctaButtonLink = $detail?->cta_button_link ?: 'mailto:cv.arindah2016@gmail.com';

    /*
    |--------------------------------------------------------------------------
    | GAMBAR CMS
    |--------------------------------------------------------------------------
    | Gambar upload CMS umumnya disimpan di storage/app/public.
    | Gambar bawaan tetap memakai folder public/images.
    */

    $resolveImage = function ($path, $fallback) {
        if (blank($path)) {
            return asset($fallback);
        }

        if (\Illuminate\Support\Str::startsWith($path, ['https://', 'http://'])) {
            return $path;
        }

        if (\Illuminate\Support\Str::startsWith($path, 'produk-layanan/details/')) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        return asset(ltrim($path, '/'));
    };

    $heroImage = $resolveImage(
        $detail?->hero_image,
        'images/hero_detail_audio_video.jpg'
    );

    $aboutImage = $resolveImage(
        $detail?->about_image,
        'images/detail_audio_video.jpg'
    );

    $ctaImage = $resolveImage(
        $detail?->cta_image,
        'images/cta_produk_layanan.jpg'
    );
@endphp


{{-- =========================================================
     HERO
========================================================= --}}
<section class="relative overflow-hidden bg-white pt-0">

    <div class="relative mx-auto min-h-[430px] max-w-[1440px] overflow-hidden bg-[#EAF4FF]">

        {{-- Decorative background --}}
        <div class="absolute -right-[160px] -top-[180px] h-[520px] w-[520px] rounded-full bg-[#C9DEFF]/70"></div>

        <div class="absolute bottom-[-180px] left-[38%] h-[360px] w-[360px] rounded-full bg-white/40 blur-2xl"></div>


        {{-- HERO IMAGE DESKTOP --}}
        <div class="absolute right-0 top-0 hidden h-full w-[46%] overflow-hidden lg:block">

            <div class="absolute inset-0 z-10 bg-gradient-to-r from-[#EAF4FF] via-transparent to-transparent"></div>

            <img
                src="{{ $heroImage }}"
                alt="{{ $heroTitle }}"
                class="h-full w-full object-cover object-center transition duration-700 ease-out hover:scale-[1.035]"
            >

            <div class="absolute inset-0 bg-[#0969D8]/10"></div>

        </div>


        {{-- HERO CONTENT --}}
        <div class="relative z-20 flex min-h-[430px] items-center px-6 py-14 sm:px-8 lg:px-12">

            <div class="w-full max-w-[650px]">

                {{-- Back button --}}
                <a
                    href="{{ route('produk') }}"
                    class="group inline-flex items-center gap-2 rounded-full border border-[#C8DFFF] bg-white/90 px-4 py-2.5 text-[12px] font-semibold text-[#0969D8] shadow-[0_5px_18px_rgba(15,23,42,0.07)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#0969D8] hover:shadow-[0_8px_24px_rgba(9,105,216,0.14)]"
                >
                    <span class="transition duration-300 group-hover:-translate-x-1">←</span>
                    Kembali ke Semua Produk
                </a>


                {{-- Label --}}
                <div class="mt-10 flex items-center gap-3">

                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[13px] font-bold tracking-[1.8px] text-[#0969D8]">
                        {{ $heroLabel }}
                    </p>

                </div>


                {{-- Heading --}}
                <h1 class="mt-4 max-w-[650px] break-words text-[38px] font-bold leading-[1.08] tracking-[-1.2px] text-[#123B68] sm:text-[46px] lg:text-[50px]">

                    {{ $heroTitle }}

                    <span class="relative inline-block text-[#0969D8]">
                        <span class="absolute -bottom-1 left-0 h-[5px] w-[68%] rounded-full bg-[#BBD7FF]"></span>
                    </span>

                </h1>


                {{-- Description --}}
                <p class="mt-5 max-w-[560px] break-words text-[14px] leading-[1.75] text-[#64748B] sm:text-[15px]">
                    {{ $heroDescription }}
                </p>


                {{-- Small info --}}
                <div class="mt-7 flex flex-wrap gap-3">

                    <div class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>
                        Audio
                    </div>

                    <div class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>
                        Video
                    </div>

                    <div class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>
                        Perangkat Audiovisual
                    </div>

                </div>

            </div>

        </div>


        {{-- Mobile image --}}
        <div class="relative h-[240px] lg:hidden">

            <img
                src="{{ $heroImage }}"
                alt="{{ $heroTitle }}"
                class="h-full w-full object-cover"
                loading="eager"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-[#EAF4FF] via-transparent to-transparent"></div>

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

                <div class="absolute -bottom-4 -left-4 h-full w-full rounded-[20px] border border-[#D8E8FA]"></div>

                <div class="relative overflow-hidden rounded-[18px] bg-[#EEF7FF] shadow-[0_18px_45px_rgba(15,23,42,0.10)]">

                    <img
                        src="{{ $aboutImage }}"
                        alt="{{ $aboutTitle }}"
                        class="h-[330px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.035] sm:h-[370px] lg:h-[400px]"
                        loading="lazy"
                    >

                </div>


                {{-- Floating label --}}
                <div class="absolute -bottom-5 right-5 rounded-[12px] border border-white/70 bg-white/95 px-5 py-3 shadow-[0_10px_30px_rgba(15,23,42,0.12)] backdrop-blur-md">

                    <p class="text-[10px] font-semibold tracking-[1px] text-[#64748B]">
                        CV ARINDAH
                    </p>

                    <p class="mt-1 text-[12px] font-bold text-[#123B68]">
                        {{ $heroTitle }}
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


                <h2 class="mt-5 break-words text-[32px] font-bold leading-[1.15] tracking-[-0.8px] text-[#123B68] sm:text-[38px]">
                    {{ $aboutTitle }}
                </h2>


                <p class="mt-5 break-words text-[15px] leading-[1.8] text-[#64748B]">
                    {{ $aboutDescription }}
                </p>


                {{-- Mini highlights --}}
                <div class="mt-8 grid gap-4 sm:grid-cols-2">


                    {{-- Highlight 1 --}}
                    <div class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]">

                        <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 8h5l2-3h2l2 3h5v11H4z"/>
                                <circle cx="12" cy="13" r="3"/>
                            </svg>

                        </div>

                        <p class="mt-3 break-words text-[12px] font-bold text-[#123B68]">
                            {{ $highlight1Title }}
                        </p>

                        <p class="mt-1 break-words text-[11px] leading-[1.5] text-[#64748B]">
                            {{ $highlight1Description }}
                        </p>

                    </div>


                    {{-- Highlight 2 --}}
                    <div class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]">

                        <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="5" width="18" height="14" rx="2"/>
                                <path d="m10 9 5 3-5 3V9Z"/>
                            </svg>

                        </div>

                        <p class="mt-3 break-words text-[12px] font-bold text-[#123B68]">
                            {{ $highlight2Title }}
                        </p>

                        <p class="mt-1 break-words text-[11px] leading-[1.5] text-[#64748B]">
                            {{ $highlight2Description }}
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
<section class="relative overflow-hidden bg-[#F4F9FF] py-20 lg:py-24">

    <div class="absolute -right-32 top-20 h-72 w-72 rounded-full bg-[#DCEBFF]/60 blur-3xl"></div>

    <div class="absolute -left-32 bottom-0 h-72 w-72 rounded-full bg-white/80 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        {{-- Heading --}}
        <div class="max-w-[620px]">

            <div class="flex items-center gap-3">
                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                    KELEBIHAN PRODUK
                </p>
            </div>

            <h2 class="mt-5 break-words text-[32px] font-bold leading-[1.15] tracking-[-0.8px] text-[#123B68] sm:text-[38px]">
                {{ $advantagesTitle }}
            </h2>

            <p class="mt-4 break-words text-[14px] leading-[1.7] text-[#64748B]">
                {{ $advantagesDescription }}
            </p>

        </div>

        {{-- Cards --}}
        <div class="mt-12 grid gap-5 md:grid-cols-3">

            {{-- CARD 1: IKON GRID --}}
            <div class="group relative overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]">

                <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <rect x="3" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="14" y="3" width="7" height="7" rx="1.5"/>
                        <rect x="3" y="14" width="7" height="7" rx="1.5"/>
                        <rect x="14" y="14" width="7" height="7" rx="1.5"/>
                    </svg>

                </div>

                <p class="mt-7 break-words text-[15px] font-bold text-[#123B68]">
                    {{ $advantage1Title }}
                </p>

                <p class="mt-2 break-words text-[12px] leading-[1.7] text-[#64748B]">
                    {{ $advantage1Description }}
                </p>

            </div>

            {{-- CARD 2: IKON CHECK --}}
            <div class="group relative overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]">

                <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="m8 12 2.5 2.5L16 9"/>
                    </svg>

                </div>

                <p class="mt-7 break-words text-[15px] font-bold text-[#123B68]">
                    {{ $advantage2Title }}
                </p>

                <p class="mt-2 break-words text-[12px] leading-[1.7] text-[#64748B]">
                    {{ $advantage2Description }}
                </p>

            </div>

            {{-- CARD 3: IKON INFORMASI --}}
            <div class="group relative overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]">

                <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 11v5"/>
                        <path d="M12 8h.01"/>
                    </svg>

                </div>

                <p class="mt-7 break-words text-[15px] font-bold text-[#123B68]">
                    {{ $advantage3Title }}
                </p>

                <p class="mt-2 break-words text-[12px] leading-[1.7] text-[#64748B]">
                    {{ $advantage3Description }}
                </p>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     CTA
========================================================= --}}
<section class="relative overflow-hidden bg-[#DCEEFF] py-20 lg:py-24">

    <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/60 blur-3xl"></div>

    <div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[#B8D9FA]/70 blur-3xl"></div>


    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        <div class="grid items-stretch gap-5 lg:grid-cols-[1.25fr_0.75fr]">


            {{-- CTA CONTENT --}}
            <div class="group relative overflow-hidden rounded-[20px] border border-white/80 bg-white p-7 shadow-[0_15px_45px_rgba(15,23,42,0.08)] sm:p-9 lg:p-10">

                <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#EAF4FF] transition duration-500 group-hover:scale-125"></div>


                <div class="relative z-10">

                    <div class="flex items-center gap-3">

                        <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                        <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                            BUTUH PRODUK?
                        </p>

                    </div>


                    <h2 class="mt-5 max-w-[600px] break-words text-[28px] font-bold leading-[1.2] tracking-[-0.5px] text-[#123B68] sm:text-[34px]">
                        {{ $ctaTitle }}
                    </h2>


                    <p class="mt-4 max-w-[590px] break-words text-[13px] leading-[1.7] text-[#64748B]">
                        {{ $ctaDescription }}
                    </p>


                    <div class="mt-7">

                        <a
                            href="{{ $ctaButtonLink }}"
                            class="group/button inline-flex max-w-full items-center gap-3 rounded-[11px] bg-[#0969D8] px-6 py-3 text-[13px] font-bold text-white shadow-[0_8px_20px_rgba(9,105,216,0.22)] transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] hover:shadow-[0_12px_28px_rgba(9,105,216,0.28)]"
                        >

                            {{ $ctaButtonText }}

                            <span class="transition duration-300 group-hover/button:translate-x-1">
                                →
                            </span>

                        </a>

                    </div>

                </div>

            </div>


            {{-- CTA IMAGE --}}
            <div class="group relative min-h-[250px] overflow-hidden rounded-[20px] shadow-[0_15px_40px_rgba(15,23,42,0.10)]">

                <img
                    src="{{ $ctaImage }}"
                    alt="Hubungi CV Arindah"
                    class="h-full min-h-[250px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]"
                    loading="lazy"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-[#123B68]/45 via-transparent to-transparent"></div>


                <div class="absolute bottom-6 left-6 right-6">

                    <div class="inline-flex rounded-full border border-white/30 bg-white/15 px-4 py-2 text-[11px] font-medium text-white backdrop-blur-md">
                        CV Arindah
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection