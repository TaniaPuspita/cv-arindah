
@extends('layouts.app')

@section('title', ($category->name ?? 'Elektronik & Furniture') . ' - CV Arindah')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA CMS DAN NILAI CADANGAN
    |--------------------------------------------------------------------------
    */

    $detail = $detail ?? $category->detail ?? null;

    $heroLabel = $detail?->hero_label ?: 'PRODUK';
    $heroTitle = $detail?->hero_title ?: 'Elektronik & Furniture';
    $heroDescription = $detail?->hero_description
        ?: 'Peralatan listrik, penerangan, elektronik, serta furniture untuk berbagai kebutuhan.';

    $aboutTitle = $detail?->about_title
        ?: 'Perlengkapan yang Mendukung Aktivitas';

    $aboutDescription = $detail?->about_description
        ?: 'CV Arindah menyediakan berbagai produk elektronik dan furniture sesuai dengan kategori produk yang tersedia. Produk dalam kategori ini dapat mendukung kebutuhan penggunaan perangkat elektronik sekaligus melengkapi berbagai kebutuhan ruang.';

    $highlight1Title = $detail?->about_highlight_1_title ?: 'Produk Elektronik';
    $highlight1Description = $detail?->about_highlight_1_description
        ?: 'Mendukung kebutuhan perangkat dan aktivitas digital.';

    $highlight2Title = $detail?->about_highlight_2_title ?: 'Furniture';
    $highlight2Description = $detail?->about_highlight_2_description
        ?: 'Melengkapi kebutuhan ruang kerja dan ruang lainnya.';

    $advantagesTitle = $detail?->advantages_title ?: 'Keunggulan Kategori';
    $advantagesDescription = $detail?->advantages_description
        ?: 'Pilihan produk yang dirancang untuk membantu memenuhi kebutuhan perangkat, ruang, dan aktivitas Anda.';

    $advantage1Title = $detail?->advantage_1_title ?: 'Beragam Pilihan';
    $advantage1Description = $detail?->advantage_1_description
        ?: 'Berbagai produk elektronik dan furniture dalam kategori yang tersedia.';

    $advantage2Title = $detail?->advantage_2_title ?: 'Mendukung Aktivitas';
    $advantage2Description = $detail?->advantage_2_description
        ?: 'Membantu melengkapi kebutuhan ruang kerja, belajar, maupun ruang lainnya.';

    $advantage3Title = $detail?->advantage_3_title ?: 'Informasi Lengkap';
    $advantage3Description = $detail?->advantage_3_description
        ?: 'Informasi lebih lanjut mengenai produk dapat diperoleh melalui CV Arindah.';

    $ctaTitle = $detail?->cta_title ?: 'Temukan Produk yang Sesuai Kebutuhan Anda';
    $ctaDescription = $detail?->cta_description
        ?: 'Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut mengenai produk dan layanan yang tersedia.';

    $ctaButtonText = $detail?->cta_button_text ?: 'Hubungi Kami';
    $ctaButtonLink = $detail?->cta_button_link ?: 'mailto:cv.arindah2016@gmail.com';

    /*
    |--------------------------------------------------------------------------
    | RESOLUSI GAMBAR
    |--------------------------------------------------------------------------
    | Mendukung gambar lama di public/images dan gambar unggahan CMS.
    */

    $imageUrl = function ($path, $fallback) {
        $path = $path ?: $fallback;

        if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }

        return asset($fallback);
    };

    $heroImage = $imageUrl(
        $detail?->hero_image,
        'images/furnitur.jpg'
    );

    $aboutImage = $imageUrl(
        $detail?->about_image,
        'images/detail.furniture.jpg'
    );

    $ctaImage = $imageUrl(
        $detail?->cta_image,
        'images/cta_produk_layanan.jpg'
    );
@endphp

{{-- =========================================================
     HERO
========================================================= --}}
<section class="relative overflow-hidden bg-white pt-0">

    <div class="relative mx-auto min-h-[430px] max-w-[1440px] overflow-hidden bg-[#EAF4FF]">

        {{-- Dekorasi latar --}}
        <div class="pointer-events-none absolute -right-[160px] -top-[180px] h-[520px] w-[520px] rounded-full bg-[#C9DEFF]/70"></div>

        <div class="pointer-events-none absolute bottom-[-180px] left-[38%] h-[360px] w-[360px] rounded-full bg-white/40 blur-2xl"></div>

        {{-- Gambar hero desktop --}}
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
        <div class="relative z-20 flex min-h-[430px] items-center px-5 py-10 sm:px-8 sm:py-14 lg:px-12">

            <div class="w-full max-w-[650px]">

                <a
                    href="{{ route('produk') }}"
                    class="group inline-flex max-w-full items-center gap-2 rounded-full border border-[#C8DFFF] bg-white/90 px-3.5 py-2.5 text-xs font-semibold text-[#0969D8] shadow-[0_5px_18px_rgba(15,23,42,0.07)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#0969D8] hover:shadow-[0_8px_24px_rgba(9,105,216,0.14)] sm:px-4"
                >
                    <span class="transition duration-300 group-hover:-translate-x-1">←</span>
                    <span>Kembali ke Semua Produk</span>
                </a>

                <div class="mt-7 flex items-center gap-3 sm:mt-10">
                    <span class="h-[2px] w-8 shrink-0 rounded-full bg-[#0969D8]"></span>

                    <p class="text-xs font-bold tracking-[1.8px] text-[#0969D8]">
                        {{ $heroLabel }}
                    </p>
                </div>

                <h1 class="mt-4 max-w-[650px] break-words text-[32px] font-bold leading-[1.12] tracking-[-1px] text-[#123B68] sm:text-[42px] sm:tracking-[-1.2px] lg:text-[50px]">

                    @if (str_contains($heroTitle, '&'))
                        @php
                            $heroParts = explode('&', $heroTitle, 2);
                        @endphp

                        {{ trim($heroParts[0]) }} &amp;

                        <span class="relative inline-block text-[#0969D8]">
                            {{ trim($heroParts[1]) }}

                            <span class="absolute -bottom-1 left-0 h-[5px] w-[68%] rounded-full bg-[#BBD7FF]"></span>
                        </span>
                    @else
                        <span class="text-[#0969D8]">{{ $heroTitle }}</span>
                    @endif

                </h1>

                <p class="mt-5 max-w-[560px] break-words text-sm leading-7 text-[#64748B] sm:text-[15px]">
                    {{ $heroDescription }}
                </p>

                {{-- Label kategori --}}
                <div class="mt-6 flex flex-wrap gap-2.5 sm:mt-7 sm:gap-3">

                    @foreach (['Elektronik', 'Furniture', 'Kebutuhan Ruang'] as $tag)
                        <div class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-3.5 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm sm:px-4">
                            <span class="h-2 w-2 shrink-0 rounded-full bg-[#0969D8]"></span>
                            {{ $tag }}
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- Gambar hero mobile --}}
        <div class="relative h-[210px] overflow-hidden sm:h-[280px] lg:hidden">

            <img
                src="{{ $heroImage }}"
                alt="{{ $heroTitle }}"
                class="h-full w-full object-cover object-center"
                loading="eager"
            >

            <div class="absolute inset-0 bg-gradient-to-t from-[#EAF4FF] via-[#EAF4FF]/10 to-transparent"></div>
        </div>

    </div>
</section>

{{-- =========================================================
     TENTANG KATEGORI
========================================================= --}}
<section class="overflow-hidden bg-white py-14 sm:py-20 lg:py-24">

    <div class="mx-auto max-w-[1296px] px-5 sm:px-6 lg:px-8">

        <div class="grid items-center gap-10 lg:grid-cols-[1fr_0.9fr] lg:gap-16">

            {{-- Gambar kategori --}}
            <div class="group relative mx-1 mb-3 min-w-0 sm:mx-0">

                <div class="absolute -bottom-3 -left-3 h-full w-full rounded-[18px] border border-[#D8E8FA] sm:-bottom-4 sm:-left-4 sm:rounded-[20px]"></div>

                <div class="relative overflow-hidden rounded-[16px] bg-[#EEF7FF] shadow-[0_18px_45px_rgba(15,23,42,0.10)] sm:rounded-[18px]">

                    <img
                        src="{{ $aboutImage }}"
                        alt="{{ $aboutTitle }}"
                        class="h-[230px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.035] sm:h-[330px] md:h-[370px] lg:h-[400px]"
                        loading="lazy"
                    >

                </div>

                {{-- Label gambar --}}
                <div class="absolute -bottom-4 right-2 max-w-[calc(100%-16px)] rounded-xl border border-white/70 bg-white/95 px-3.5 py-3 shadow-[0_10px_30px_rgba(15,23,42,0.12)] backdrop-blur-md sm:-bottom-5 sm:right-5 sm:px-5">

                    <p class="text-[10px] font-semibold tracking-[1px] text-[#64748B]">
                        CV ARINDAH
                    </p>

                    <p class="mt-1 break-words text-xs font-bold text-[#123B68]">
                        {{ $category->name ?? 'Elektronik & Furniture' }}
                    </p>
                </div>

            </div>

            {{-- Teks kategori --}}
            <div class="min-w-0">

                <div class="flex items-center gap-3">
                    <span class="h-[2px] w-8 shrink-0 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[11px] font-bold tracking-[1.5px] text-[#0969D8] sm:text-xs sm:tracking-[1.8px]">
                        TENTANG KATEGORI
                    </p>
                </div>

                <h2 class="mt-4 break-words text-[27px] font-bold leading-[1.2] tracking-[-0.6px] text-[#123B68] sm:mt-5 sm:text-[34px] sm:tracking-[-0.8px] lg:text-[38px]">
                    {{ $aboutTitle }}
                </h2>

                <p class="mt-4 break-words text-sm leading-7 text-[#64748B] sm:mt-5 sm:text-[15px] sm:leading-[1.8]">
                    {{ $aboutDescription }}
                </p>

                {{-- Highlight --}}
                <div class="mt-6 grid grid-cols-1 gap-3 sm:mt-8 sm:grid-cols-2 sm:gap-4">

                    {{-- Highlight 1 --}}
                    <div class="min-w-0 rounded-xl border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]">

                        <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                            {{-- Ikon perangkat, konsisten dengan halaman Komputer --}}
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <path d="M8 20v-3h8v3"/>
                                <path d="M7 8h10"/>
                            </svg>

                        </div>

                        <p class="mt-3 break-words text-xs font-bold text-[#123B68]">
                            {{ $highlight1Title }}
                        </p>

                        <p class="mt-1 break-words text-[11px] leading-[1.6] text-[#64748B]">
                            {{ $highlight1Description }}
                        </p>
                    </div>

                    {{-- Highlight 2 --}}
                    <div class="min-w-0 rounded-xl border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-[0_10px_25px_rgba(15,23,42,0.06)]">

                        <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                            {{-- Ikon rumah/ruang --}}
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M4 10.5 12 4l8 6.5"/>
                                <path d="M6 9.5V20h12V9.5"/>
                                <path d="M9.5 20v-6h5v6"/>
                            </svg>

                        </div>

                        <p class="mt-3 break-words text-xs font-bold text-[#123B68]">
                            {{ $highlight2Title }}
                        </p>

                        <p class="mt-1 break-words text-[11px] leading-[1.6] text-[#64748B]">
                            {{ $highlight2Description }}
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
<section class="relative overflow-hidden bg-[#F4F9FF] py-14 sm:py-20 lg:py-24">

    <div class="pointer-events-none absolute -right-32 top-20 h-72 w-72 rounded-full bg-[#DCEBFF]/60 blur-3xl"></div>

    <div class="pointer-events-none absolute -left-32 bottom-0 h-72 w-72 rounded-full bg-white/80 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1296px] px-5 sm:px-6 lg:px-8">

        {{-- Judul keunggulan --}}
        <div class="max-w-[620px]">

            <div class="flex items-center gap-3">
                <span class="h-[2px] w-8 shrink-0 rounded-full bg-[#0969D8]"></span>

                <p class="text-[11px] font-bold tracking-[1.5px] text-[#0969D8] sm:text-xs sm:tracking-[1.8px]">
                    KELEBIHAN PRODUK
                </p>
            </div>

            <h2 class="mt-4 break-words text-[28px] font-bold leading-[1.2] tracking-[-0.6px] text-[#123B68] sm:mt-5 sm:text-[34px] sm:tracking-[-0.8px] lg:text-[38px]">
                {{ $advantagesTitle }}
            </h2>

            <p class="mt-4 break-words text-sm leading-7 text-[#64748B]">
                {{ $advantagesDescription }}
            </p>
        </div>

        {{-- Kartu keunggulan --}}
        <div class="mt-8 grid grid-cols-1 gap-4 sm:mt-12 sm:gap-5 md:grid-cols-3">

            {{-- CARD 1 --}}
            <div class="group relative min-w-0 overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-5 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-1 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)] sm:p-6 md:hover:-translate-y-2">

                <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                    {{-- Ikon grid, sama dengan halaman Komputer --}}
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>

                </div>

                <p class="mt-6 break-words text-[15px] font-bold text-[#123B68] sm:mt-7">
                    {{ $advantage1Title }}
                </p>

                <p class="mt-2 break-words text-xs leading-7 text-[#64748B]">
                    {{ $advantage1Description }}
                </p>
            </div>

            {{-- CARD 2 --}}
            <div class="group relative min-w-0 overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-5 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-1 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)] sm:p-6 md:hover:-translate-y-2">

                <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                    {{-- Ikon centang, sama dengan halaman Komputer --}}
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="m8 12 2.5 2.5L16 9"/>
                    </svg>

                </div>

                <p class="mt-6 break-words text-[15px] font-bold text-[#123B68] sm:mt-7">
                    {{ $advantage2Title }}
                </p>

                <p class="mt-2 break-words text-xs leading-7 text-[#64748B]">
                    {{ $advantage2Description }}
                </p>
            </div>

            {{-- CARD 3 --}}
            <div class="group relative min-w-0 overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-5 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-1 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)] sm:p-6 md:hover:-translate-y-2">

                <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                <div class="flex h-12 w-12 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                    {{-- Ikon informasi, sama dengan halaman Komputer --}}
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 10v6"/>
                        <path d="M12 7h.01"/>
                    </svg>

                </div>

                <p class="mt-6 break-words text-[15px] font-bold text-[#123B68] sm:mt-7">
                    {{ $advantage3Title }}
                </p>

                <p class="mt-2 break-words text-xs leading-7 text-[#64748B]">
                    {{ $advantage3Description }}
                </p>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================
     CTA
========================================================= --}}
<section class="relative overflow-hidden bg-[#DCEEFF] py-14 sm:py-20 lg:py-24">

    <div class="pointer-events-none absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/60 blur-3xl"></div>

    <div class="pointer-events-none absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[#B8D9FA]/70 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1296px] px-5 sm:px-6 lg:px-8">

        <div class="grid items-stretch gap-5 lg:grid-cols-[1.25fr_0.75fr]">

            {{-- Konten CTA --}}
            <div class="group relative min-w-0 overflow-hidden rounded-[20px] border border-white/80 bg-white p-6 shadow-[0_15px_45px_rgba(15,23,42,0.08)] sm:p-9 lg:p-10">

                <div class="pointer-events-none absolute -right-16 -top-16 h-40 w-40 rounded-full bg-[#EAF4FF] transition duration-500 group-hover:scale-125"></div>

                <div class="relative z-10">

                    <div class="flex items-center gap-3">
                        <span class="h-[2px] w-8 shrink-0 rounded-full bg-[#0969D8]"></span>

                        <p class="text-[11px] font-bold tracking-[1.5px] text-[#0969D8] sm:text-xs sm:tracking-[1.8px]">
                            BUTUH PRODUK?
                        </p>
                    </div>

                    <h2 class="mt-5 break-words text-[26px] font-bold leading-[1.2] tracking-[-0.5px] text-[#123B68] sm:text-[32px] lg:text-[34px]">
                        {{ $ctaTitle }}
                    </h2>

                    <p class="mt-4 max-w-[590px] break-words text-sm leading-7 text-[#64748B]">
                        {{ $ctaDescription }}
                    </p>

                    <div class="mt-6 sm:mt-7">

                        <a
                            href="{{ $ctaButtonLink }}"
                            class="group/button inline-flex max-w-full items-center justify-center gap-3 rounded-[11px] bg-[#0969D8] px-5 py-3 text-center text-[13px] font-bold text-white shadow-[0_8px_20px_rgba(9,105,216,0.22)] transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] hover:shadow-[0_12px_28px_rgba(9,105,216,0.28)] sm:px-6"
                        >
                            <span>{{ $ctaButtonText }}</span>
                            <span class="transition duration-300 group-hover/button:translate-x-1">→</span>
                        </a>

                    </div>
                </div>
            </div>

            {{-- Gambar CTA --}}
            <div class="group relative min-h-[220px] overflow-hidden rounded-[20px] shadow-[0_15px_40px_rgba(15,23,42,0.10)] sm:min-h-[280px] lg:min-h-[250px]">

                <img
                    src="{{ $ctaImage }}"
                    alt="Hubungi CV Arindah"
                    class="absolute inset-0 h-full w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]"
                    loading="lazy"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-[#123B68]/55 via-transparent to-transparent"></div>

                <div class="absolute bottom-5 left-5 right-5 sm:bottom-6 sm:left-6 sm:right-6">

                    <div class="inline-flex rounded-full border border-white/30 bg-white/15 px-4 py-2 text-[11px] font-medium text-white backdrop-blur-md">
                        CV Arindah
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
