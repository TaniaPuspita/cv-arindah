
@extends('layouts.app')

@section('content')

{{-- =====================================================
    DATA CMS KONTAK
===================================================== --}}
@php
    $contactPage = $contactPage ?? null;

    $heroImage = $contactPage?->hero_image
        ? asset('storage/' . $contactPage->hero_image)
        : asset('images/herokontak.jpg');

    $locationImage = $contactPage?->location_image
        ? asset('storage/' . $contactPage->location_image)
        : asset('images/kontak/lokasi_kontak.jpg');

    $ctaImage = $contactPage?->cta_image
        ? asset('storage/' . $contactPage->cta_image)
        : asset('images/kontak/cta_kontak.jpg');

    $contactEmail = $contactPage?->contact_email
        ?: 'cv.arindah2016@gmail.com';

    $contactPhone = $contactPage?->contact_phone
        ?: '+6285100821243';

    $contactAddress = $contactPage?->contact_address
        ?: 'Jalan Dewaratwati Nomor 23, Mengwitani, Mengwi, Badung, Bali';

    $locationAddress = $contactPage?->location_address
        ?: $contactAddress;

    $mapsUrl = $contactPage?->maps_url
        ?: 'https://www.google.com/maps/search/?api=1&query=Jalan+Dewaratwati+Nomor+23+Mengwitani+Mengwi+Badung+Bali';

    $ctaPhone = $contactPage?->cta_phone ?: $contactPhone;
@endphp


{{-- =====================================================
    1. HERO KONTAK
===================================================== --}}
@php
    // LABEL HERO
    $heroLabel = $contactPage?->hero_label ?: 'Kontak';

    // JUDUL HERO
    $heroTitle = $contactPage?->hero_title
        ?: 'Kami Siap Membantu Kebutuhan Anda';

    // Pisahkan judul menggunakan | jika tersedia.
    $heroTitleParts = explode('|', $heroTitle, 2);

    $heroTitleMain = trim($heroTitleParts[0]);
    $heroTitleHighlight = trim($heroTitleParts[1] ?? '');

    // Jika CMS tidak memakai |, warnai mulai kata "Kebutuhan".
    if (
        $heroTitleHighlight === '' &&
        str_contains($heroTitleMain, 'Kebutuhan')
    ) {
        $titleParts = explode('Kebutuhan', $heroTitleMain, 2);

        $heroTitleMain = trim($titleParts[0]);

        $heroTitleHighlight = 'Kebutuhan'
            . ($titleParts[1] ?? '');
    }

    // DESKRIPSI HERO
    $heroDescription = $contactPage?->hero_description
        ?: 'Jangan ragu untuk menghubungi kami. Tim kami siap memberikan informasi lebih lanjut mengenai produk dan layanan yang tersedia.';

    // TOMBOL HERO
    $heroPrimaryText = $contactPage?->hero_primary_button_text
        ?: 'Hubungi Kami';

    $heroPrimaryUrl = $contactPage?->hero_primary_button_url
        ?: '#informasi-kontak';

    $heroSecondaryText = $contactPage?->hero_secondary_button_text
        ?: 'Informasi Kontak';

    $heroSecondaryUrl = $contactPage?->hero_secondary_button_url
        ?: '#informasi-kontak';
@endphp

{{-- =====================================================
    HERO KONTAK
===================================================== --}}
<section id="hero-kontak"
    class="relative isolate scroll-mt-24 overflow-hidden bg-[#EAF4FF]">

    {{-- FOTO MOBILE --}}
    <div class="relative h-[210px] w-full overflow-hidden sm:h-[280px] lg:hidden">
        <img
            src="{{ $heroImage }}"
            alt="CV Arindah"
            class="h-full w-full object-cover object-center"
        >

        <div class="absolute inset-x-0 bottom-0 h-24
                    bg-gradient-to-t from-[#EAF4FF] to-transparent">
        </div>
    </div>

    {{-- FOTO DESKTOP --}}
    <div class="pointer-events-none absolute inset-y-0 right-0 hidden w-[62%] lg:block"
         aria-hidden="true">

        <img
            src="{{ $heroImage }}"
            alt=""
            class="h-full w-full object-cover object-center"
        >

        <div class="absolute inset-y-0 left-0 w-[60%]
                    bg-gradient-to-r from-[#EAF4FF]
                    via-[#EAF4FF]/75 to-transparent">
        </div>

        <div class="absolute inset-x-0 bottom-0 h-24
                    bg-gradient-to-t from-[#EAF4FF]/70 to-transparent">
        </div>
    </div>

    {{-- KONTEN HERO --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-4 sm:px-8 lg:px-8">
        <div class="flex items-center py-7 sm:py-10 lg:min-h-[470px] lg:py-12">

            <div class="w-full max-w-[500px]">

                {{-- LABEL --}}
                <p class="text-xs font-bold uppercase leading-6 tracking-[0.16em]
                          text-[#0969D8] sm:text-sm">
                    {{ $heroLabel }}
                </p>

                {{-- JUDUL HERO --}}
                <h1 class="mt-3 max-w-[470px] text-[32px] font-bold
                           leading-[1.12] tracking-tight text-[#193F6B]
                           sm:text-5xl lg:text-[46px] xl:text-[52px]">

                    {{ $heroTitleMain }}

                    @if ($heroTitleHighlight !== '')
                        <span class="block text-[#0969D8]">
                            {{ $heroTitleHighlight }}
                        </span>
                    @endif

                </h1>

                {{-- DESKRIPSI --}}
                <p class="mt-5 max-w-[400px] text-sm leading-6 text-[#4F6683]
                          sm:text-base sm:leading-7">
                    {{ $heroDescription }}
                </p>

                {{-- TOMBOL --}}
                <div class="mt-7 flex flex-col items-stretch gap-3
                            sm:mt-8 sm:flex-row sm:flex-wrap sm:items-center">

                    <a
                        href="{{ $heroPrimaryUrl }}"
                        class="inline-flex min-h-11 w-full items-center justify-center
                               rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold
                               text-white shadow-md shadow-blue-900/10 transition
                               duration-300 hover:-translate-y-0.5 hover:bg-[#075BBF]
                               hover:shadow-lg focus:outline-none focus:ring-4
                               focus:ring-blue-200 sm:w-auto"
                    >
                        {{ $heroPrimaryText }}
                    </a>

                    <a
                        href="{{ $heroSecondaryUrl }}"
                        class="inline-flex min-h-11 w-full items-center justify-center
                               rounded-lg border border-[#9CC3EE] bg-white/80 px-5 py-3
                               text-sm font-semibold text-[#0969D8] transition
                               duration-300 hover:-translate-y-0.5 hover:bg-white
                               focus:outline-none focus:ring-4 focus:ring-blue-100 sm:w-auto"
                    >
                        {{ $heroSecondaryText }}
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>



{{-- =====================================================
    2. INFORMASI KONTAK
===================================================== --}}
<section id="informasi-kontak"
    class="bg-[#F5F9FD] px-4 py-10 sm:px-5 sm:py-12 md:px-6 lg:py-14">

    <div class="mx-auto max-w-7xl">

        <div class="mb-8">

            <span class="inline-flex rounded-lg bg-[#CFE3FC] px-5 py-2
                         text-sm font-semibold text-[#0969D8]">
                Informasi Kontak
            </span>

            <h2 class="mt-6 text-3xl font-bold text-[#193F6B] md:text-4xl">
                {{ $contactPage?->contact_section_title ?: 'Cara Menghubungi Kami' }}
            </h2>

            <p class="mt-2 text-sm text-[#71839A] md:text-base">
                Silakan hubungi kami melalui kontak di bawah ini
                untuk mendapatkan informasi lebih lanjut.
            </p>

        </div>

        <div class="grid min-w-0 gap-4 sm:gap-5 md:grid-cols-3">

            
{{-- KARTU EMAIL --}}
<div class="min-w-0 rounded-xl border border-[#C9DDF5] bg-[#CFE3FC]
            p-4 shadow-[0_5px_18px_rgba(30,76,120,0.08)]
            transition duration-300 hover:-translate-y-1
            hover:shadow-[0_10px_25px_rgba(30,76,120,0.12)] sm:p-5">

    <div class="flex min-w-0 gap-3 sm:gap-4">

        {{-- IKON EMAIL --}}
        <div class="flex h-12 w-12 shrink-0 items-center justify-center
                    rounded-full bg-[#0969D8] text-white">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>

        </div>

        {{-- INFORMASI EMAIL --}}
        <div class="min-w-0 flex-1">

            <h3 class="text-sm font-bold text-[#193F6B]">
                Email
            </h3>

            <p class="mt-2 text-xs leading-5 text-[#71839A]">
                Kirim pertanyaan atau informasi melalui email kami.
            </p>

            <a
                href="https://mail.google.com/mail/?view=cm&fs=1&to={{ urlencode($contactEmail) }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Kirim email ke CV Arindah melalui Gmail"
                class="mt-2 inline-flex max-w-full break-all rounded-full
                       bg-white px-3 py-1 text-[10px] font-medium
                       text-[#0969D8] shadow-sm transition duration-200
                       hover:bg-[#0969D8] hover:text-white"
            >
                {{ $contactEmail }}
            </a>

        </div>
    </div>
</div>


{{-- KARTU TELEPON --}}
<div class="min-w-0 rounded-xl border border-[#C9DDF5] bg-[#CFE3FC]
            p-4 shadow-[0_5px_18px_rgba(30,76,120,0.08)]
            transition duration-300 hover:-translate-y-1
            hover:shadow-[0_10px_25px_rgba(30,76,120,0.12)] sm:p-5">

    <div class="flex min-w-0 gap-3 sm:gap-4">

        {{-- IKON TELEPON --}}
        <div class="flex h-12 w-12 shrink-0 items-center justify-center
                    rounded-full bg-[#0969D8] text-white">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.65 2.6a2 2 0 01-.45 1.85l-1.2 1.2a16 16 0 006.62 6.62l1.2-1.2a2 2 0 011.85-.45l2.6.65A2 2 0 0121 17.72V20a2 2 0 01-2 2h-1C9.716 22 2 14.284 2 5V4a2 2 0 011-1z"/>
            </svg>

        </div>

        {{-- INFORMASI TELEPON --}}
        <div class="min-w-0 flex-1">

            <h3 class="text-sm font-bold text-[#193F6B]">
                Telepon
            </h3>

            <p class="mt-2 text-xs leading-5 text-[#71839A]">
                Hubungi kami untuk informasi produk dan layanan.
            </p>

            
            <a
                href="https://wa.me/{{ preg_replace('/\D/', '', $contactPhone) }}"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Hubungi CV Arindah melalui WhatsApp"
                class="mt-2 inline-flex max-w-full break-words rounded-full
                    bg-white px-3 py-1 text-[10px] font-medium
                    text-[#0969D8] shadow-sm transition duration-200
                    hover:bg-[#0969D8] hover:text-white"
            >
                {{ $contactPhone }}
            </a>


        </div>
    </div>
</div>


            {{-- KARTU ALAMAT --}}
            <div class="min-w-0 rounded-xl border border-[#C9DDF5] bg-[#CFE3FC]
                        p-4 shadow-[0_5px_18px_rgba(30,76,120,0.08)]
                        transition duration-300 hover:-translate-y-1
                        hover:shadow-[0_10px_25px_rgba(30,76,120,0.12)] sm:p-5">

                <div class="flex min-w-0 gap-3 sm:gap-4">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center
                                rounded-full bg-[#0969D8] text-white">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 21s8-6.2 8-12a8 8 0 10-16 0c0 5.8 8 12 8 12z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>

                    </div>

                    <div class="min-w-0 flex-1">

                        <h3 class="text-sm font-bold text-[#193F6B]">
                            Alamat
                        </h3>

                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            Kunjungi alamat kami secara langsung.
                        </p>

                        <a
                            href="{{ $mapsUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-2 inline-block max-w-full break-words rounded-lg
                                   bg-white px-3 py-2 text-[10px] leading-4
                                   text-[#0969D8] shadow-sm"
                        >
                            {{ $contactAddress }}
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- =====================================================
    3. FORMULIR KIRIM PESAN DAN LOKASI
===================================================== --}}

<section class="bg-[#F5F9FD] px-4 pb-12 sm:px-5 sm:pb-14 md:px-6 lg:pb-16">

    <div class="mx-auto max-w-7xl">

        <div class="grid min-w-0 gap-5 lg:grid-cols-[1.6fr_1fr]">

            {{-- ==========================================
                FORMULIR KIRIM PESAN
            ========================================== --}}
            <div class="min-w-0 rounded-2xl border border-[#E1EAF4] bg-white
                        p-4 shadow-[0_8px_25px_rgba(27,69,109,0.08)]
                        sm:p-5 md:p-6">

                {{-- NOTIFIKASI SUKSES --}}
                @if(session('success'))
                    <div class="mb-4 rounded-lg border border-green-200
                                bg-green-50 p-4 text-sm text-green-800"
                         role="status">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- NOTIFIKASI VALIDASI --}}
                @if($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200
                                bg-red-50 p-4 text-sm text-red-700"
                         role="alert">
                        Mohon periksa kembali formulir.
                        Ada data yang perlu diperbaiki.
                    </div>
                @endif

                {{-- LABEL FORMULIR DARI CMS --}}
                <span class="inline-flex rounded-lg bg-[#CFE3FC] px-8 py-2
                             text-sm font-semibold text-[#0969D8]">
                    {{ $contactPage?->form_label ?: 'Kirim Pesan' }}
                </span>

                {{-- JUDUL FORMULIR DARI CMS --}}
                <h2 class="mt-5 max-w-xl text-2xl font-bold leading-tight
                           text-[#193F6B] sm:text-3xl md:text-4xl">
                    {{ $contactPage?->form_title ?: 'Kirim Pesan / Permintaan Informasi' }}
                </h2>

                {{-- DESKRIPSI FORMULIR DARI CMS --}}
                <p class="mt-3 max-w-xl text-sm leading-5 text-[#71839A]">
                    {{ $contactPage?->form_description ?: 'Lengkapi formulir di bawah ini untuk menyampaikan pertanyaan atau kebutuhan Anda.' }}
                </p>

                {{-- FORM PENGIRIMAN PESAN --}}
                <form
                    action="{{ route('contact-messages.store') }}"
                    method="POST"
                    class="mt-6"
                >
                    @csrf

                    {{-- NAMA DAN EMAIL --}}
                    <div class="grid gap-4 md:grid-cols-2">

                        {{-- NAMA LENGKAP --}}
                        <div>
                            <label for="nama"
                                   class="mb-2 block text-xs font-bold text-[#193F6B]">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                maxlength="255"
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full min-w-0 rounded-lg border border-[#DCE5EF]
                                       bg-white px-3 py-3 text-xs text-[#193F6B]
                                       outline-none transition placeholder:text-[#9AAABC]
                                       focus:border-[#0969D8] focus:ring-2
                                       focus:ring-[#0969D8]/10"
                                required
                            >

                            @error('nama')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div>
                            <label for="email"
                                   class="mb-2 block text-xs font-bold text-[#193F6B]">
                                Email <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                maxlength="255"
                                placeholder="Masukkan email Anda"
                                class="w-full min-w-0 rounded-lg border border-[#DCE5EF]
                                       bg-white px-3 py-3 text-xs text-[#193F6B]
                                       outline-none transition placeholder:text-[#9AAABC]
                                       focus:border-[#0969D8] focus:ring-2
                                       focus:ring-[#0969D8]/10"
                                required
                            >

                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- TELEPON DAN SUBJEK --}}
                    <div class="mt-4 grid gap-4 md:grid-cols-2">

                        {{-- NOMOR TELEPON --}}
                        <div>
                            <label for="telepon"
                                   class="mb-2 block text-xs font-bold text-[#193F6B]">
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                id="telepon"
                                name="telepon"
                                value="{{ old('telepon') }}"
                                maxlength="30"
                                placeholder="Contoh: 08123456789"
                                class="w-full min-w-0 rounded-lg border border-[#DCE5EF]
                                       bg-white px-3 py-3 text-xs text-[#193F6B]
                                       outline-none transition placeholder:text-[#9AAABC]
                                       focus:border-[#0969D8] focus:ring-2
                                       focus:ring-[#0969D8]/10"
                            >

                            @error('telepon')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- KATEGORI / SUBJEK --}}
                        <div>
                            <label for="subjek"
                                   class="mb-2 block text-xs font-bold text-[#193F6B]">
                                Kategori / Subjek
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="subjek"
                                name="subjek"
                                class="w-full min-w-0 rounded-lg border border-[#DCE5EF]
                                       bg-white px-3 py-3 text-xs text-[#71839A]
                                       outline-none transition focus:border-[#0969D8]
                                       focus:ring-2 focus:ring-[#0969D8]/10"
                                required
                            >
                                <option value="">Pilih subjek pesan</option>

                                <option value="produk"
                                    @selected(old('subjek') === 'produk')>
                                    Informasi Produk
                                </option>

                                <option value="layanan"
                                    @selected(old('subjek') === 'layanan')>
                                    Informasi Layanan
                                </option>

                                <option value="kerjasama"
                                    @selected(old('subjek') === 'kerjasama')>
                                    Kerja Sama
                                </option>

                                <option value="lainnya"
                                    @selected(old('subjek') === 'lainnya')>
                                    Lainnya
                                </option>
                            </select>

                            @error('subjek')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- PESAN --}}
                    <div class="mt-4">

                        <label for="pesan"
                               class="mb-2 block text-xs font-bold text-[#193F6B]">
                            Pesan / Rincian Kebutuhan
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="pesan"
                            name="pesan"
                            rows="4"
                            maxlength="5000"
                            placeholder="Tulis pesan Anda di sini..."
                            class="w-full min-w-0 resize-none rounded-lg border
                                   border-[#DCE5EF] bg-white px-3 py-3 text-xs
                                   text-[#193F6B] outline-none transition
                                   placeholder:text-[#9AAABC] focus:border-[#0969D8]
                                   focus:ring-2 focus:ring-[#0969D8]/10"
                            required
                        >{{ old('pesan') }}</textarea>

                        @error('pesan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- TOMBOL KIRIM DARI CMS --}}
                    <button
                        type="submit"
                        class="mt-4 flex w-full items-center justify-center gap-2
                               rounded-lg bg-[#0988F5] px-5 py-3 text-sm font-semibold
                               text-white shadow-[0_6px_15px_rgba(9,136,245,0.20)]
                               transition duration-300 hover:-translate-y-0.5
                               hover:bg-[#0879DB]
                               hover:shadow-[0_10px_20px_rgba(9,136,245,0.25)]"
                    >

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M22 2L11 13"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M22 2l-7 20-4-9-9-4 20-7z"/>
                        </svg>

                        {{ $contactPage?->form_button_text ?: 'Kirim Pesan' }}

                    </button>

                </form>

            </div>

            {{-- ==========================================
                KARTU LOKASI
            ========================================== --}}
            <div class="min-w-0 rounded-2xl border border-[#E1EAF4] bg-white
                        p-4 shadow-[0_8px_25px_rgba(27,69,109,0.08)]
                        sm:p-5 md:p-6">

                <span class="inline-flex rounded-lg bg-[#CFE3FC] px-8 py-2
                             text-sm font-semibold text-[#0969D8]">
                    Lokasi Kami
                </span>

                <h2 class="mt-5 text-2xl font-bold leading-tight text-[#193F6B]
                           sm:text-3xl md:text-4xl">
                    {{ $contactPage?->location_title ?: 'Temukan Alamat Kami' }}
                </h2>

                <p class="mt-3 text-sm leading-5 text-[#71839A]">
                    {{ $locationAddress }}
                </p>

                {{-- GAMBAR LOKASI --}}
                <div class="relative mt-5 overflow-hidden rounded-xl">

                    <img
                        src="{{ $locationImage }}"
                        alt="Lokasi CV Arindah"
                        class="h-[180px] w-full object-cover sm:h-[220px]"
                    >

                    <a
                        href="{{ $mapsUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="absolute bottom-3 left-1/2 flex w-[92%]
                               -translate-x-1/2 items-center gap-2 rounded-xl
                               bg-white px-3 py-3 shadow-lg sm:w-[85%] sm:gap-3"
                    >

                        <span class="flex h-10 w-10 shrink-0 items-center
                                     justify-center rounded-full bg-[#0969D8] text-white">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 21s8-6.2 8-12a8 8 0 10-16 0c0 5.8 8 12 8 12z"/>
                                <circle cx="12" cy="9" r="2.5"/>
                            </svg>

                        </span>

                        <span class="min-w-0 break-words text-[10px] font-semibold
                                     leading-4 text-[#193F6B]">
                            {{ $locationAddress }}
                        </span>

                    </a>
                </div>

                {{-- INFORMASI PENTING --}}
                <div class="mt-5 flex min-w-0 gap-3 rounded-xl bg-[#CFE3FC] p-3 sm:p-4">

                    <div class="flex h-10 w-10 shrink-0 items-center
                                justify-center rounded-full bg-[#0969D8] text-white">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-5 w-5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 9v4m0 4h.01M10.3 3.7l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.3l-8-14a2 2 0 00-3.4 0z"/>
                        </svg>

                    </div>

                    <div class="min-w-0">

                        <h3 class="text-xs font-bold text-[#193F6B]">
                            Informasi Penting
                        </h3>

                        <p class="mt-1 text-[10px] leading-4 text-[#5D7390]">
                            {{ $contactPage?->location_note ?: 'Untuk saat ini, lokasi belum tersedia di Google Maps. Anda dapat mencari alamat tersebut secara manual pada Google Maps dengan mengetik alamat CV Arindah.' }}
                        </p>

                    </div>
                </div>

            </div>

        </div>
    </div>

</section>



{{-- =====================================================
    4. CTA KONTAK
===================================================== --}}
<section class="bg-[#F3F8FE] px-4 py-8 sm:px-5 sm:py-10 md:px-6 lg:py-12">

    <div class="mx-auto max-w-7xl">

        <div class="overflow-hidden rounded-2xl
                    bg-gradient-to-r from-[#1976D2] via-[#287FD8] to-[#A7C8EF]
                    shadow-[0_10px_30px_rgba(30,76,120,0.14)]">

            <div class="grid items-stretch lg:grid-cols-[1.3fr_0.8fr]">

                {{-- TEKS CTA --}}
                <div class="p-5 sm:p-7 md:p-10">

                    <h2 class="max-w-xl text-2xl font-bold leading-tight
                               text-white md:text-3xl">
                        {{ $contactPage?->cta_title ?: 'Butuh Produk atau Layanan untuk Kebutuhan Anda?' }}
                    </h2>

                    <p class="mt-3 max-w-xl text-sm leading-6 text-white/90 md:text-base">
                        {{ $contactPage?->cta_description ?: 'Jangan ragu untuk menghubungi kami. Tim kami siap membantu memberikan informasi lebih lanjut mengenai produk dan layanan yang tersedia.' }}
                    </p>

                    {{-- TOMBOL WHATSAPP --}}
                    <div class="mt-6">

                        <a
                            href="https://wa.me/6285100821243"
                            target="_blank"
                            rel="noopener noreferrer"
                            aria-label="Hubungi CV Arindah melalui WhatsApp"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-lg bg-white px-5 py-3
                                   text-sm font-semibold text-[#0969D8]
                                   shadow-md transition duration-300
                                   hover:-translate-y-0.5 hover:shadow-lg
                                   focus:outline-none focus:ring-4
                                   focus:ring-white/50"
                        >

                            {{-- IKON WHATSAPP --}}
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path d="M20.52 3.48A11.78 11.78 0 0 0 12.13 0C5.53 0 .16 5.37.16 11.97c0 2.11.55 4.17 1.6 5.99L.05 24l6.2-1.63a11.96 11.96 0 0 0 5.87 1.54h.01c6.6 0 11.97-5.37 11.97-11.97a11.9 11.9 0 0 0-3.58-8.46ZM12.13 21.9a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.68.97.98-3.59-.23-.37a9.87 9.87 0 0 1-1.52-5.35c0-5.46 4.44-9.9 9.9-9.9 2.65 0 5.14 1.03 7.01 2.9a9.84 9.84 0 0 1 2.9 7c0 5.47-4.44 9.92-9.96 9.92Zm5.44-7.42c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.27-.47-2.42-1.5-.9-.8-1.5-1.78-1.67-2.08-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.49s1.07 2.89 1.22 3.09c.15.2 2.1 3.2 5.09 4.49.71.31 1.27.5 1.7.64.71.23 1.36.2 1.87.12.57-.08 1.76-.72 2.01-1.42.25-.7.25-1.3.17-1.42-.07-.12-.27-.2-.57-.35Z"/>
                            </svg>

                            HUBUNGI KAMI

                        </a>

                    </div>
                </div>

                {{-- GAMBAR CTA --}}
                <div class="relative min-h-[200px] sm:min-h-[240px]">

                    <img
                        src="{{ $ctaImage }}"
                        alt="CV Arindah"
                        class="absolute inset-0 h-full w-full object-cover"
                    >

                </div>

            </div>
        </div>
    </div>
</section>

@endsection
