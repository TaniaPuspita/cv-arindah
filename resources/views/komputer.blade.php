@extends('layouts.app')

@section('title', ($detail?->hero_title ?: $category->name) . ' - CV Arindah')

@section('content')

@php
    // DATA CMS
    $heroLabel = $detail?->hero_label ?: 'PRODUK';
    $heroTitle = $detail?->hero_title ?: $category->name;

    $heroDescription = $detail?->hero_description
        ?: ($category->description ?: 'Temukan berbagai produk yang sesuai dengan kebutuhan Anda.');

    $aboutTitle = $detail?->about_title ?: 'Perlengkapan yang Mendukung Kebutuhan Digital';

    $aboutDescription = $detail?->about_description
        ?: 'CV Arindah menyediakan berbagai produk untuk mendukung kebutuhan pelanggan.';

    $aboutHighlight1Title = $detail?->about_highlight_1_title ?: 'Produk Komputer';
    $aboutHighlight1Description = $detail?->about_highlight_1_description
        ?: 'Berbagai pilihan produk untuk menunjang aktivitas dan kebutuhan digital.';

    $aboutHighlight2Title = $detail?->about_highlight_2_title ?: 'Teknologi';
    $aboutHighlight2Description = $detail?->about_highlight_2_description
        ?: 'Pilihan produk teknologi untuk mendukung aktivitas sehari-hari.';

    $advantagesTitle = $detail?->advantages_title ?: 'Keunggulan Kategori';

    $advantagesDescription = $detail?->advantages_description
        ?: 'Temukan pilihan produk komputer dan teknologi untuk memenuhi berbagai kebutuhan Anda.';

    $advantage1Title = $detail?->advantage_1_title ?: 'Beragam Pilihan';
    $advantage1Description = $detail?->advantage_1_description
        ?: 'Tersedia beragam pilihan produk untuk mendukung kebutuhan digital.';

    $advantage2Title = $detail?->advantage_2_title ?: 'Pilihan Sesuai Kebutuhan';
    $advantage2Description = $detail?->advantage_2_description
        ?: 'Pilih produk yang sesuai dengan kebutuhan kerja maupun aktivitas sehari-hari.';

    $advantage3Title = $detail?->advantage_3_title ?: 'Informasi Lengkap';
    $advantage3Description = $detail?->advantage_3_description
        ?: 'Informasi produk membantu Anda menentukan pilihan yang sesuai.';

    $ctaTitle = $detail?->cta_title ?: 'Temukan Produk yang Sesuai Kebutuhan Anda';
    $ctaDescription = $detail?->cta_description
        ?: 'Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut.';

    $ctaButtonText = $detail?->cta_button_text ?: 'Hubungi Kami';
    $ctaButtonLink = $detail?->cta_button_link ?: 'mailto:cv.arindah2016@gmail.com';

    // URL GAMBAR: mendukung public/images dan upload CMS
    $imageUrl = function ($path, $fallback) {
        $path = $path ?: $fallback;

        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
    };

    $heroImage = $imageUrl(
        $detail?->hero_image,
        'images/hero_detail_komputer.jpg'
    );

    $mobileHeroImage = $heroImage;

    $aboutImage = $imageUrl(
        $detail?->about_image,
        'images/detail_komputrer_teknologi.jpg'
    );

    $ctaImage = $imageUrl(
        $detail?->cta_image,
        'images/cta_produk_layanan.jpg'
    );

    $advantages = [
        [
            'title' => $advantage1Title,
            'description' => $advantage1Description,
            'icon' => 'grid',
        ],
        [
            'title' => $advantage2Title,
            'description' => $advantage2Description,
            'icon' => 'check',
        ],
        [
            'title' => $advantage3Title,
            'description' => $advantage3Description,
            'icon' => 'info',
        ],
    ];

    $heroTitleParts = explode('&', $heroTitle, 2);
@endphp

{{-- =========================================================
     HERO
========================================================= --}}
<section class="relative overflow-hidden bg-white pt-0">

    <div class="relative mx-auto min-h-0 max-w-[1440px] overflow-hidden bg-[#EAF4FF] lg:min-h-[430px]">

        {{-- Dekorasi background --}}
        <div class="absolute -right-[160px] -top-[180px] h-[520px] w-[520px] rounded-full bg-[#C9DEFF]/70"></div>
        <div class="absolute bottom-[-180px] left-[38%] h-[360px] w-[360px] rounded-full bg-white/40 blur-2xl"></div>

        {{-- Gambar desktop --}}
        <div class="absolute right-0 top-0 hidden h-full w-[46%] overflow-hidden lg:block">

            <div class="absolute inset-0 z-10 bg-gradient-to-r from-[#EAF4FF] via-transparent to-transparent"></div>

            <img
                src="{{ $heroImage }}"
                alt="{{ $heroTitle }}"
                class="h-full w-full object-cover object-center transition duration-700 ease-out hover:scale-[1.035]"
            >

            <div class="absolute inset-0 bg-[#0969D8]/10"></div>
        </div>

        {{-- Konten hero --}}
        <div class="relative z-20 flex min-h-0 items-center px-4 py-9 sm:px-8 sm:py-12 lg:min-h-[430px] lg:px-12 lg:py-14">

            <div class="w-full max-w-[650px]">

                <a
                    href="{{ route('produk') }}"
                    class="group inline-flex items-center gap-2 rounded-full border border-[#C8DFFF] bg-white/90 px-4 py-2.5 text-[12px] font-semibold text-[#0969D8] shadow-[0_5px_18px_rgba(15,23,42,0.07)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#0969D8] hover:shadow-[0_8px_24px_rgba(9,105,216,0.14)]"
                >
                    <span class="transition duration-300 group-hover:-translate-x-1">←</span>
                    Kembali ke Semua Produk
                </a>

                <div class="mt-7 flex items-center gap-3 sm:mt-10">
                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[13px] font-bold tracking-[1.8px] text-[#0969D8]">
                        {{ $heroLabel }}
                    </p>
                </div>

                <h1 class="mt-4 max-w-[650px] break-words text-[32px] font-bold leading-[1.12] tracking-[-0.8px] text-[#123B68] sm:text-[42px] sm:tracking-[-1px] lg:text-[50px] lg:tracking-[-1.2px]">
                    @if (count($heroTitleParts) === 2)
                        {{ trim($heroTitleParts[0]) }} &amp;

                        <span class="relative inline-block text-[#0969D8]">
                            {{ trim($heroTitleParts[1]) }}

                            <span class="absolute -bottom-1 left-0 h-[5px] w-[68%] rounded-full bg-[#BBD7FF]"></span>
                        </span>
                    @else
                        <span class="relative inline-block text-[#0969D8]">
                            {{ $heroTitle }}

                            <span class="absolute -bottom-1 left-0 h-[5px] w-[68%] rounded-full bg-[#BBD7FF]"></span>
                        </span>
                    @endif
                </h1>

                <p class="mt-5 max-w-[560px] text-[14px] leading-[1.75] text-[#64748B] sm:text-[15px]">
                    {{ $heroDescription }}
                </p>

                {{-- Chips --}}
                <div class="mt-6 flex flex-wrap gap-2 sm:mt-7 sm:gap-3">
                    @foreach (['Komputer', 'Teknologi', 'Perlengkapan Digital'] as $chip)
                        <div class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>
                            {{ $chip }}
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        {{-- Gambar mobile --}}
        <div class="relative h-[190px] sm:h-[250px] lg:hidden">
            <img
                src="{{ $mobileHeroImage }}"
                alt="{{ $heroTitle }}"
                class="h-full w-full object-cover"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-[#EAF4FF] via-transparent to-transparent"></div>
        </div>

    </div>
</section>

{{-- =========================================================
     TENTANG KATEGORI
========================================================= --}}
<section class="bg-white py-14 sm:py-20 lg:py-24">

    <div class="mx-auto max-w-[1296px] px-4 sm:px-6 lg:px-8">

        <div class="grid items-center gap-9 sm:gap-12 lg:grid-cols-[1fr_0.9fr] lg:gap-16">

            {{-- GAMBAR --}}
            <div class="group relative">

                <div class="absolute -bottom-4 -left-4 h-full w-full rounded-[20px] border border-[#D8E8FA]"></div>

                <div class="relative overflow-hidden rounded-[18px] bg-[#EEF7FF] shadow-[0_18px_45px_rgba(15,23,42,0.10)]">

                    <img
                        src="{{ $aboutImage }}"
                        alt="{{ $aboutTitle }}"
                        class="h-[250px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.035] sm:h-[330px] lg:h-[400px]"
                    >

                </div>

                {{-- Label gambar --}}
                <div class="absolute -bottom-4 right-2 max-w-[calc(100%-1rem)] rounded-[12px] border border-white/70 bg-white/95 px-4 py-3 shadow-[0_10px_30px_rgba(15,23,42,0.12)] backdrop-blur-md sm:-bottom-5 sm:right-5 sm:px-5">

                    <p class="text-[10px] font-semibold tracking-[1px] text-[#64748B]">
                        CV ARINDAH
                    </p>

                    <p class="mt-1 text-[12px] font-bold text-[#123B68]">
                        {{ $category->name }}
                    </p>

                </div>
            </div>

            {{-- KONTEN --}}
            <div>

                <div class="flex items-center gap-3">
                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                        TENTANG KATEGORI
                    </p>
                </div>

                <h2 class="mt-5 break-words text-[28px] font-bold leading-[1.2] tracking-[-0.6px] text-[#123B68] sm:text-[34px] sm:tracking-[-0.8px] lg:text-[38px]">
                    {{ $aboutTitle }}
                </h2>

                <p class="mt-5 text-[15px] leading-[1.8] text-[#64748B]">
                    {{ $aboutDescription }}
                </p>

                {{-- Highlight --}}
                <div class="mt-6 grid min-w-0 gap-3 sm:mt-8 sm:grid-cols-2 sm:gap-4">

                    {{-- Highlight 1 --}}
                    <div class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]">

                        <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <path d="M8 20v-3h8v3"/>
                                <path d="M7 8h10"/>
                            </svg>

                        </div>

                        <p class="mt-3 text-[12px] font-bold text-[#123B68]">
                            {{ $aboutHighlight1Title }}
                        </p>

                        <p class="mt-1 text-[11px] leading-[1.5] text-[#64748B]">
                            {{ $aboutHighlight1Description }}
                        </p>

                    </div>

                    {{-- Highlight 2 --}}
                    <div class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]">

                        <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <rect x="4" y="4" width="16" height="13" rx="2"/>
                                <path d="M8 21h8"/>
                                <path d="M12 17v4"/>
                            </svg>

                        </div>

                        <p class="mt-3 text-[12px] font-bold text-[#123B68]">
                            {{ $aboutHighlight2Title }}
                        </p>

                        <p class="mt-1 text-[11px] leading-[1.5] text-[#64748B]">
                            {{ $aboutHighlight2Description }}
                        </p>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================
     KEUNGGULAN KATEGORI
========================================================= --}}
<section class="relative overflow-hidden bg-[#F6FAFF] py-14 sm:py-20 lg:py-24">

    <div class="absolute -right-32 top-20 h-72 w-72 rounded-full bg-[#DCEBFF]/70 blur-3xl"></div>
    <div class="absolute -left-32 bottom-0 h-72 w-72 rounded-full bg-white/80 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        <div class="max-w-[620px]">

            <div class="flex items-center gap-3">
                <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                    KELEBIHAN PRODUK
                </p>
            </div>

            <h2 class="mt-5 break-words text-[28px] font-bold leading-[1.2] tracking-[-0.6px] text-[#123B68] sm:text-[34px] sm:tracking-[-0.8px] lg:text-[38px]">
                {{ $advantagesTitle }}
            </h2>

            <p class="mt-4 text-[14px] leading-[1.7] text-[#64748B]">
                {{ $advantagesDescription }}
            </p>

        </div>

        <div class="mt-8 grid gap-4 sm:mt-12 sm:gap-5 md:grid-cols-3">

            @foreach ($advantages as $advantage)

                <div class="group relative min-w-0 overflow-hidden rounded-[18px] border border-[#D8E7F7] bg-white p-5 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-1 hover:border-[#A9CCFF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)] sm:p-6 md:hover:-translate-y-2">

                    <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                    {{-- Icon SVG --}}
                    <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E8F2FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                        @if ($advantage['icon'] === 'grid')

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

                        @elseif ($advantage['icon'] === 'check')

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

                        @else

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

                        @endif

                    </div>

                    <p class="mt-7 text-[15px] font-bold text-[#123B68]">
                        {{ $advantage['title'] }}
                    </p>

                    <p class="mt-2 text-[12px] leading-[1.7] text-[#64748B]">
                        {{ $advantage['description'] }}
                    </p>

                </div>

            @endforeach

        </div>
    </div>
</section>

{{-- =========================================================
     CTA
========================================================= --}}
<section class="relative overflow-hidden bg-[#DCEEFF] py-14 sm:py-20 lg:py-24">

    <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/60 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[#B8D9FA]/70 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        <div class="grid min-w-0 items-stretch gap-4 sm:gap-5 lg:grid-cols-[1.25fr_0.75fr]">

            {{-- CTA CONTENT --}}
            <div class="group relative min-w-0 overflow-hidden rounded-[20px] border border-white/80 bg-white p-5 shadow-[0_15px_45px_rgba(15,23,42,0.08)] sm:p-9 lg:p-10">

                <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#EAF4FF] transition duration-500 group-hover:scale-125"></div>

                <div class="relative z-10">

                    <div class="flex items-center gap-3">
                        <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                        <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                            BUTUH PRODUK?
                        </p>
                    </div>

                    <h2 class="mt-5 max-w-[600px] break-words text-[25px] font-bold leading-[1.2] tracking-[-0.5px] text-[#123B68] sm:text-[30px] lg:text-[34px]">
                        {{ $ctaTitle }}
                    </h2>

                    <p class="mt-4 max-w-[590px] text-[13px] leading-[1.7] text-[#64748B]">
                        {{ $ctaDescription }}
                    </p>

                    <div class="mt-7">

                        <a
                            href="{{ $ctaButtonLink }}"
                            class="group inline-flex items-center gap-3 rounded-[11px] bg-[#0969D8] px-6 py-3 text-[13px] font-bold text-white shadow-[0_8px_20px_rgba(9,105,216,0.22)] transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] hover:shadow-[0_12px_28px_rgba(9,105,216,0.28)]"
                        >
                            {{ $ctaButtonText }}

                            <span class="transition duration-300 group-hover:translate-x-1">→</span>
                        </a>

                    </div>
                </div>
            </div>

            {{-- CTA IMAGE --}}
            <div class="group relative min-h-[200px] min-w-0 overflow-hidden rounded-[20px] shadow-[0_15px_40px_rgba(15,23,42,0.10)] sm:min-h-[250px]">

                <img
                    src="{{ $ctaImage }}"
                    alt="Hubungi CV Arindah"
                    class="h-[220px] min-h-[220px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04] sm:h-full sm:min-h-[250px]"
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