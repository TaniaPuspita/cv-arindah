@extends('layouts.app')

@section('title', ($detail?->hero_title ?: $category->name) . ' - CV Arindah')

@section('content')

{{-- =====================================================
     HERO
===================================================== --}}

<section class="relative overflow-hidden bg-white pt-0">

    <div class="relative mx-auto min-h-[430px] max-w-[1440px] overflow-hidden bg-[#EAF4FF]">

        {{-- Decorative Background --}}
        <div class="absolute -right-[160px] -top-[180px] h-[520px] w-[520px] rounded-full bg-[#C9DEFF]/70"></div>

        <div class="absolute bottom-[-180px] left-[38%] h-[360px] w-[360px] rounded-full bg-white/40 blur-2xl"></div>

        {{-- Hero Image Desktop --}}
        <div class="absolute right-0 top-0 hidden h-full w-[46%] overflow-hidden lg:block">

            <div class="absolute inset-0 z-10 bg-gradient-to-r from-[#EAF4FF] via-transparent to-transparent"></div>

            @if ($heroImage)
                <img
                    src="{{ $heroImage }}"
                    alt="{{ $detail?->hero_title ?: $category->name }}"
                    class="h-full w-full object-cover object-center transition duration-700 ease-out hover:scale-[1.035]"
                >
            @endif

            <div class="absolute inset-0 bg-[#0969D8]/10"></div>

        </div>

        {{-- Hero Content --}}
        <div class="relative z-20 flex min-h-[430px] items-center px-6 py-14 sm:px-8 lg:px-12">

            <div class="w-full max-w-[650px]">

                <a
                    href="{{ route('produk') }}"
                    class="group inline-flex items-center gap-2 rounded-full border border-[#C8DFFF] bg-white/90 px-4 py-2.5 text-[12px] font-semibold text-[#0969D8] shadow-sm backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#0969D8]"
                >
                    <span class="transition duration-300 group-hover:-translate-x-1">←</span>
                    Kembali ke Semua Produk
                </a>

                <div class="mt-10 flex items-center gap-3">

                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[13px] font-bold tracking-[1.8px] text-[#0969D8]">
                        {{ $detail?->hero_label ?: 'PRODUK' }}
                    </p>

                </div>

                <h1 class="mt-4 max-w-[650px] break-words text-[38px] font-bold leading-[1.08] tracking-[-1.2px] text-[#123B68] sm:text-[46px] lg:text-[50px]">
                    {{ $detail?->hero_title ?: $category->name }}

                    <span class="relative inline-block text-[#0969D8]">
                        <span class="absolute -bottom-1 left-0 h-[5px] w-[68%] rounded-full bg-[#BBD7FF]"></span>
                    </span>
                </h1>

                @if (filled($detail?->hero_description))
                    <p class="mt-5 max-w-[560px] break-words text-[14px] leading-[1.75] text-[#64748B] sm:text-[15px]">
                        {{ $detail->hero_description }}
                    </p>
                @endif

                {{-- Category Chips --}}
                <div class="mt-7 flex flex-wrap gap-3">

                    @foreach ($categoryChips as $chip)

                        <div class="inline-flex items-center gap-2 rounded-full border border-[#D8E8FA] bg-white/75 px-4 py-2 text-[11px] font-medium text-[#486581] backdrop-blur-sm">

                            <span class="h-2 w-2 rounded-full bg-[#0969D8]"></span>

                            {{ $chip }}

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- Hero Image Mobile --}}
        <div class="relative h-[240px] lg:hidden">

            @if ($heroImage)
                <img
                    src="{{ $heroImage }}"
                    alt="{{ $detail?->hero_title ?: $category->name }}"
                    class="h-full w-full object-cover"
                    loading="eager"
                >
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-[#EAF4FF] via-transparent to-transparent"></div>

        </div>

    </div>

</section>


{{-- =====================================================
     TENTANG KATEGORI
===================================================== --}}

<section class="bg-white py-20 lg:py-24">

    <div class="mx-auto max-w-[1296px] px-6 lg:px-8">

        <div class="grid items-center gap-12 lg:grid-cols-[1fr_0.9fr] lg:gap-16">

            {{-- Image --}}
            <div class="group relative">

                <div class="absolute -bottom-4 -left-4 h-full w-full rounded-[20px] border border-[#D8E8FA]"></div>

                <div class="relative overflow-hidden rounded-[18px] bg-[#EEF7FF] shadow-[0_18px_45px_rgba(15,23,42,0.10)]">

                    @if ($aboutImage)
                        <img
                            src="{{ $aboutImage }}"
                            alt="{{ $detail?->about_title ?: $category->name }}"
                            class="h-[330px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.035] sm:h-[370px] lg:h-[400px]"
                            loading="lazy"
                        >
                    @else
                        <div class="flex h-[330px] w-full items-center justify-center sm:h-[370px] lg:h-[400px]">
                            <p class="text-center text-sm font-medium text-[#64748B]">
                                Gambar belum tersedia
                            </p>
                        </div>
                    @endif

                </div>

                <div class="absolute -bottom-5 right-5 rounded-[12px] border border-white/70 bg-white/95 px-5 py-3 shadow-lg backdrop-blur-md">

                    <p class="text-[10px] font-semibold tracking-[1px] text-[#64748B]">
                        CV ARINDAH
                    </p>

                    <p class="mt-1 text-[12px] font-bold text-[#123B68]">
                        {{ $category->name }}
                    </p>

                </div>

            </div>

            {{-- Text --}}
            <div>

                <div class="flex items-center gap-3">

                    <span class="h-[2px] w-8 rounded-full bg-[#0969D8]"></span>

                    <p class="text-[12px] font-bold tracking-[1.8px] text-[#0969D8]">
                        TENTANG KATEGORI
                    </p>

                </div>

                <h2 class="mt-5 break-words text-[32px] font-bold leading-[1.15] tracking-[-0.8px] text-[#123B68] sm:text-[38px]">
                    {{ $detail?->about_title ?: $category->name }}
                </h2>

                @if (filled($detail?->about_description))
                    <p class="mt-5 break-words text-[15px] leading-[1.8] text-[#64748B]">
                        {{ $detail->about_description }}
                    </p>
                @endif

                {{-- Highlights --}}
                @if (count($highlights) > 0)

                    <div class="mt-8 grid gap-4 sm:grid-cols-2">

                        @foreach ($highlights as $highlight)

                            <div class="rounded-[12px] border border-[#E3EDF8] bg-[#F8FBFF] p-4 transition duration-300 hover:-translate-y-1 hover:border-[#C8DFFF] hover:shadow-lg">

                                {{-- Highlight Icon --}}
                                <div class="flex h-9 w-9 items-center justify-center rounded-[10px] bg-[#E6F1FF] text-[#0969D8]">

                                    <i
                                        class="{{ $highlight['icon'] }}"
                                        style="font-size: 1.125rem;"
                                        aria-hidden="true"
                                    ></i>

                                </div>

                                <p class="mt-3 break-words text-[12px] font-bold text-[#123B68]">
                                    {{ $highlight['title'] }}
                                </p>

                                <p class="mt-1 break-words text-[11px] leading-[1.5] text-[#64748B]">
                                    {{ $highlight['description'] }}
                                </p>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     KEUNGGULAN
===================================================== --}}

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
                {{ $detail?->advantages_title ?: 'Keunggulan ' . $category->name }}
            </h2>

            @if (filled($detail?->advantages_description))
                <p class="mt-4 break-words text-[14px] leading-[1.7] text-[#64748B]">
                    {{ $detail->advantages_description }}
                </p>
            @endif

        </div>

        {{-- Advantage Cards --}}
        @if (count($advantages) > 0)

            <div class="mt-12 grid gap-5 md:grid-cols-3">

                @foreach ($advantages as $advantage)

                    <div class="group relative overflow-hidden rounded-[18px] border border-[#DCE9F7] bg-white p-6 shadow-[0_8px_25px_rgba(15,23,42,0.05)] transition duration-300 hover:-translate-y-2 hover:border-[#BBD7FF] hover:shadow-[0_18px_40px_rgba(9,105,216,0.12)]">

                        <div class="absolute left-0 top-0 h-1 w-0 bg-[#0969D8] transition-all duration-300 group-hover:w-full"></div>

                        {{-- Advantage Icon --}}
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-[14px] bg-[#E7F1FF] text-[#0969D8] transition duration-300 group-hover:scale-110 group-hover:bg-[#0969D8] group-hover:text-white">

                            <i
                                class="{{ $advantage['icon'] }}"
                                style="font-size: 1.25rem;"
                                aria-hidden="true"
                            ></i>

                        </div>

                        <p class="mt-7 break-words text-[15px] font-bold text-[#123B68]">
                            {{ $advantage['title'] }}
                        </p>

                        <p class="mt-2 break-words text-[12px] leading-[1.7] text-[#64748B]">
                            {{ $advantage['description'] }}
                        </p>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</section>


{{-- =====================================================
     CTA - HUBUNGI KAMI
     Tombol diarahkan langsung ke halaman Kontak
===================================================== --}}

<section class="relative overflow-hidden bg-[#DCEEFF] py-20 lg:py-24">

    <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-white/60 blur-3xl"></div>

    <div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-[#B8D9FA]/70 blur-3xl"></div>

    <div class="relative z-10 mx-auto max-w-[1296px] px-6 lg:px-8">

        <div class="grid items-stretch gap-5 lg:grid-cols-[1.25fr_0.75fr]">

            {{-- CTA Content --}}
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
                        {{ $detail?->cta_title ?: 'Butuh Produk atau Layanan?' }}
                    </h2>

                    @if (filled($detail?->cta_description))
                        <p class="mt-4 max-w-[590px] break-words text-[13px] leading-[1.7] text-[#64748B]">
                            {{ $detail->cta_description }}
                        </p>
                    @endif

                    <div class="mt-7">

                        {{-- TOMBOL HUBUNGI KAMI: MENUJU HALAMAN KONTAK --}}
                        <a
                            href="{{ route('kontak') }}"
                            class="group/button inline-flex max-w-full items-center gap-3 rounded-[11px] bg-[#0969D8] px-6 py-3 text-[13px] font-bold text-white shadow-[0_8px_20px_rgba(9,105,216,0.22)] transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200"
                        >

                            {{ $detail?->cta_button_text ?: 'Hubungi Kami' }}

                            <span class="transition duration-300 group-hover/button:translate-x-1">
                                →
                            </span>

                        </a>

                    </div>

                </div>

            </div>

            {{-- CTA Image --}}
            <div class="group relative min-h-[250px] overflow-hidden rounded-[20px] shadow-[0_15px_40px_rgba(15,23,42,0.10)]">

                @if ($ctaImage)
                    <img
                        src="{{ $ctaImage }}"
                        alt="Hubungi CV Arindah"
                        class="h-full min-h-[250px] w-full object-cover transition duration-700 ease-out group-hover:scale-[1.04]"
                        loading="lazy"
                    >
                @else
                    <div class="flex min-h-[250px] h-full items-center justify-center bg-[#C9DEFF]">
                        <span class="text-sm font-medium text-[#123B68]">
                            CV Arindah
                        </span>
                    </div>
                @endif

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
