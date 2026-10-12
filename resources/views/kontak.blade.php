@extends('layouts.app')

@section('content')




{{-- =========================================================
    1. HERO KONTAK
========================================================= --}}
<section class="relative isolate scroll-mt-24 overflow-hidden bg-[#EAF4FF]">

    {{-- FOTO MOBILE: di atas teks, memudar ke bawah --}}
    <div class="relative h-[240px] w-full sm:h-[300px] lg:hidden">
        <img
            src="{{ asset('images/kontak/hero_kontak.jpg') }}"
            alt="Layanan pelanggan CV Arindah"
            class="!h-full !w-full !rounded-none object-cover object-center"
            style="border-radius: 0 !important; clip-path: none !important;"
        >

        <div
            class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-[#EAF4FF] to-transparent"
        ></div>
    </div>

    {{-- FOTO DESKTOP: memenuhi sisi kanan tanpa sudut membulat --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 hidden w-[62%] lg:block"
        aria-hidden="true"
    >
        <img
            src="{{ asset('images/herokontak.jpg') }}"
            alt=""
            class="!h-full !w-full !rounded-none !object-cover !object-center"
            style="border-radius: 0 !important; clip-path: none !important; mask: none !important;"
        >

        {{-- Gradasi kiri menyatu dengan background --}}
        <div
            class="absolute inset-y-0 left-0 w-[60%] bg-gradient-to-r from-[#EAF4FF] via-[#EAF4FF]/75 to-transparent"
        ></div>

        {{-- Gradasi bawah --}}
        <div
            class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-[#EAF4FF] to-transparent"
        ></div>
    </div>

    {{-- KONTEN TEKS --}}
    <div class="relative z-10 mx-auto max-w-[1440px] px-8 lg:px-[32px]">
        <div class="flex items-center pb-12 pt-4 lg:min-h-[440px] lg:py-20">

            <div class="max-w-[460px]">

                {{-- LABEL --}}
                <p class="text-sm font-bold uppercase leading-6 tracking-wide text-[#0969D8]">
                    Kontak
                </p>

                {{-- JUDUL --}}
                <h1 class="mt-3 text-4xl font-bold leading-[1.12] tracking-tight text-[#123B68] sm:text-5xl lg:text-[46px] xl:text-[52px]">
                    Kami Siap
                    <span class="block">Membantu</span>
                    <span class="block text-[#0969D8]">
                        Kebutuhan Anda
                    </span>
                </h1>

                {{-- DESKRIPSI --}}
                <p class="mt-5 max-w-[400px] text-sm leading-6 text-[#4F6683] md:text-base md:leading-7">
                    Jangan ragu untuk menghubungi kami. Tim kami siap
                    memberikan informasi lebih lanjut mengenai produk
                    dan layanan yang tersedia.
                </p>

                {{-- TOMBOL --}}
                <div class="mt-8 flex flex-wrap items-center gap-3">

                    {{-- TOMBOL UTAMA --}}
                    <a
                        href="#informasi-kontak"
                        class="group inline-flex items-center gap-2 rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:bg-[#075BBF] focus:outline-none focus:ring-4 focus:ring-blue-200"
                    >
                        Hubungi Kami
                        <span class="inline-block transition-transform duration-300 group-hover:translate-x-1">
                            →
                        </span>
                    </a>

                    {{-- TOMBOL SEKUNDER --}}
                    <a
                        href="#informasi-kontak"
                        class="inline-flex items-center rounded-lg border border-[#9CC3EE] bg-white/70 px-5 py-3 text-sm font-semibold text-[#0969D8] transition duration-300 hover:-translate-y-1 hover:bg-white focus:outline-none focus:ring-4 focus:ring-blue-100"
                    >
                        Informasi Kontak
                    </a>

                </div>

            </div>
        </div>
    </div>

</section>






{{-- =========================================================
    INFORMASI KONTAK
========================================================= --}}
<section
    id="informasi-kontak"
    class="bg-[#F5F9FD] px-5 py-12 md:px-6 lg:py-14"
>

    <div class="mx-auto max-w-7xl">


        {{-- =================================================
            SECTION TITLE
        ================================================= --}}
        <div class="mb-8">

            <span
                class="inline-flex rounded-lg bg-[#CFE3FC] px-5 py-2 text-sm font-semibold text-[#0969D8]"
            >
                Informasi Kontak
            </span>


            <h2 class="mt-6 text-3xl font-bold text-[#193F6B] md:text-4xl">

                Cara Menghubungi Kami

            </h2>


            <p class="mt-2 text-sm text-[#71839A] md:text-base">

                Silakan hubungi kami melalui kontak di bawah ini
                untuk mendapatkan informasi lebih lanjut.

            </p>

        </div>



        {{-- =================================================
            CONTACT CARDS
        ================================================= --}}
        <div class="grid gap-5 md:grid-cols-3">


            {{-- EMAIL --}}
            <div
                class="rounded-xl border border-[#C9DDF5] bg-[#CFE3FC] p-5 shadow-[0_5px_18px_rgba(30,76,120,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_10px_25px_rgba(30,76,120,0.12)]"
            >

                <div class="flex gap-4">

                    {{-- ICON --}}
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                            />
                        </svg>

                    </div>


                    <div class="min-w-0">

                        <h3 class="text-sm font-bold text-[#193F6B]">
                            Email
                        </h3>

                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            Kirim pertanyaan atau informasi
                            melalui email kami.
                        </p>

                        <a
                            href="mailto:cv.arindah2016@gmail.com"
                            class="mt-2 inline-flex max-w-full rounded-full bg-white px-3 py-1 text-[10px] font-medium text-[#0969D8] shadow-sm"
                        >
                            cv.arindah2016@gmail.com
                        </a>

                    </div>

                </div>

            </div>



            {{-- TELEPON --}}
            <div
                class="rounded-xl border border-[#C9DDF5] bg-[#CFE3FC] p-5 shadow-[0_5px_18px_rgba(30,76,120,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_10px_25px_rgba(30,76,120,0.12)]"
            >

                <div class="flex gap-4">

                    {{-- ICON --}}
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.65 2.6a2 2 0 01-.45 1.85l-1.2 1.2a16 16 0 006.62 6.62l1.2-1.2a2 2 0 011.85-.45l2.6.65A2 2 0 0121 17.72V20a2 2 0 01-2 2h-1C9.716 22 2 14.284 2 5V4a2 2 0 011-1z"
                            />
                        </svg>

                    </div>


                    <div>

                        <h3 class="text-sm font-bold text-[#193F6B]">
                            Telepon
                        </h3>

                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            Hubungi kami untuk informasi
                            produk dan layanan.
                        </p>

                        <a
                            href="tel:+6285100821243"
                            class="mt-2 inline-flex rounded-full bg-white px-3 py-1 text-[10px] font-medium text-[#0969D8] shadow-sm"
                        >
                            +6285100821243
                        </a>

                    </div>

                </div>

            </div>



            {{-- ALAMAT --}}
            <div
                class="rounded-xl border border-[#C9DDF5] bg-[#CFE3FC] p-5 shadow-[0_5px_18px_rgba(30,76,120,0.08)] transition duration-300 hover:-translate-y-1 hover:shadow-[0_10px_25px_rgba(30,76,120,0.12)]"
            >

                <div class="flex gap-4">

                    {{-- ICON --}}
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 21s8-6.2 8-12a8 8 0 10-16 0c0 5.8 8 12 8 12z"
                            />

                            <circle
                                cx="12"
                                cy="9"
                                r="2.5"
                            />
                        </svg>

                    </div>


                    <div>

                        <h3 class="text-sm font-bold text-[#193F6B]">
                            Alamat
                        </h3>

                        <p class="mt-2 text-xs leading-5 text-[#71839A]">
                            Kunjungi alamat kami secara
                            langsung.
                        </p>

                        <a
                            href="https://www.google.com/maps/search/?api=1&query=Jalan+Dewaratwati+Nomor+23+Mengwitani+Mengwi+Badung+Bali"
                            target="_blank"
                            class="mt-2 inline-block rounded-lg bg-white px-3 py-2 text-[10px] leading-4 text-[#0969D8] shadow-sm"
                        >
                            Jalan Dewaratwati Nomor 23,
                            Mengwitani, Mengwi,
                            Badung, Bali
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    FORM + LOCATION
========================================================= --}}
<section class="bg-[#F5F9FD] px-5 pb-14 md:px-6 lg:pb-16">

    <div class="mx-auto max-w-7xl">

        <div class="grid gap-5 lg:grid-cols-[1.6fr_1fr]">


            {{-- =================================================
                FORM
            ================================================= --}}
            <div
                class="rounded-2xl border border-[#E1EAF4] bg-white p-5 shadow-[0_8px_25px_rgba(27,69,109,0.08)] md:p-6"
            >

                {{-- LABEL --}}
                <span
                    class="inline-flex rounded-lg bg-[#CFE3FC] px-8 py-2 text-sm font-semibold text-[#0969D8]"
                >
                    Kirim Pesan
                </span>


                <h2 class="mt-5 max-w-xl text-3xl font-bold leading-[0.95] text-[#193F6B] md:text-4xl">

                    Kirim Pesan /
                    Permintaan
                    <span class="block">
                        Informasi
                    </span>

                </h2>


                <p class="mt-3 max-w-xl text-sm leading-5 text-[#71839A]">

                    Lengkapi formulir di bawah ini untuk menyampaikan
                    pertanyaan atau kebutuhan Anda.

                </p>


                {{-- FORM --}}
                <form
                    action="#"
                    method="POST"
                    class="mt-6"
                >

                    @csrf


                    {{-- ROW 1 --}}
                    <div class="grid gap-4 md:grid-cols-2">


                        {{-- NAMA --}}
                        <div>

                            <label
                                for="nama"
                                class="mb-2 block text-xs font-bold text-[#193F6B]"
                            >
                                Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full rounded-lg border border-[#DCE5EF] bg-white px-3 py-3 text-xs text-[#193F6B] outline-none transition placeholder:text-[#9AAABC] focus:border-[#0969D8] focus:ring-2 focus:ring-[#0969D8]/10"
                                required
                            >

                        </div>


                        {{-- EMAIL --}}
                        <div>

                            <label
                                for="email"
                                class="mb-2 block text-xs font-bold text-[#193F6B]"
                            >
                                Email
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Masukkan email Anda"
                                class="w-full rounded-lg border border-[#DCE5EF] bg-white px-3 py-3 text-xs text-[#193F6B] outline-none transition placeholder:text-[#9AAABC] focus:border-[#0969D8] focus:ring-2 focus:ring-[#0969D8]/10"
                                required
                            >

                        </div>

                    </div>



                    {{-- ROW 2 --}}
                    <div class="mt-4 grid gap-4 md:grid-cols-2">


                        {{-- TELEPON --}}
                        <div>

                            <label
                                for="telepon"
                                class="mb-2 block text-xs font-bold text-[#193F6B]"
                            >
                                Nomor Telepon
                            </label>

                            <input
                                type="text"
                                id="telepon"
                                name="telepon"
                                placeholder="Contoh : 08123456789"
                                class="w-full rounded-lg border border-[#DCE5EF] bg-white px-3 py-3 text-xs text-[#193F6B] outline-none transition placeholder:text-[#9AAABC] focus:border-[#0969D8] focus:ring-2 focus:ring-[#0969D8]/10"
                            >

                        </div>


                        {{-- SUBJEK --}}
                        <div>

                            <label
                                for="subjek"
                                class="mb-2 block text-xs font-bold text-[#193F6B]"
                            >
                                Kategori / Subjek
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="subjek"
                                name="subjek"
                                class="w-full rounded-lg border border-[#DCE5EF] bg-white px-3 py-3 text-xs text-[#71839A] outline-none transition focus:border-[#0969D8] focus:ring-2 focus:ring-[#0969D8]/10"
                                required
                            >

                                <option value="">
                                    Pilih subjek pesan
                                </option>

                                <option value="produk">
                                    Informasi Produk
                                </option>

                                <option value="layanan">
                                    Informasi Layanan
                                </option>

                                <option value="kerjasama">
                                    Kerja Sama
                                </option>

                                <option value="lainnya">
                                    Lainnya
                                </option>

                            </select>

                        </div>

                    </div>



                    {{-- PESAN --}}
                    <div class="mt-4">

                        <label
                            for="pesan"
                            class="mb-2 block text-xs font-bold text-[#193F6B]"
                        >
                            Pesan / Rincian Kebutuhan
                            <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            id="pesan"
                            name="pesan"
                            rows="4"
                            placeholder="Tulis pesan Anda di sini......"
                            class="w-full resize-none rounded-lg border border-[#DCE5EF] bg-white px-3 py-3 text-xs text-[#193F6B] outline-none transition placeholder:text-[#9AAABC] focus:border-[#0969D8] focus:ring-2 focus:ring-[#0969D8]/10"
                            required
                        ></textarea>

                    </div>



                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="mt-4 flex w-full items-center justify-center gap-2 rounded-lg bg-[#0988F5] px-5 py-3 text-sm font-semibold text-white shadow-[0_6px_15px_rgba(9,136,245,0.20)] transition duration-300 hover:-translate-y-0.5 hover:bg-[#0879DB] hover:shadow-[0_10px_20px_rgba(9,136,245,0.25)]"
                    >

                        {{-- Send Icon --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 2L11 13"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M22 2l-7 20-4-9-9-4 20-7z"
                            />
                        </svg>

                        Kirim Pesan

                    </button>

                </form>

            </div>



            {{-- =================================================
                LOCATION
            ================================================= --}}
            <div
                class="rounded-2xl border border-[#E1EAF4] bg-white p-5 shadow-[0_8px_25px_rgba(27,69,109,0.08)] md:p-6"
            >

                {{-- LABEL --}}
                <span
                    class="inline-flex rounded-lg bg-[#CFE3FC] px-8 py-2 text-sm font-semibold text-[#0969D8]"
                >
                    Lokasi Kami
                </span>


                <h2 class="mt-5 text-3xl font-bold leading-[0.95] text-[#193F6B] md:text-4xl">

                    Temukan Alamat
                    <span class="block">
                        Kami
                    </span>

                </h2>


                <p class="mt-3 text-sm leading-5 text-[#71839A]">

                    CV Arindah beralamat di Jalan Dewaratwati
                    Nomor 23, Mengwitani, Mengwi, Badung, Bali.

                </p>


                {{-- MAP IMAGE --}}
                <div class="relative mt-5 overflow-hidden rounded-xl">

                    <img
                        src="{{ asset('images/kontak/lokasi_kontak.jpg') }}"
                        alt="Lokasi CV Arindah"
                        class="h-[180px] w-full object-cover"
                    >


                    {{-- MAP ADDRESS --}}
                    <a
                        href="https://www.google.com/maps/search/?api=1&query=Jalan+Dewaratwati+Nomor+23+Mengwitani+Mengwi+Badung+Bali"
                        target="_blank"
                        class="absolute bottom-3 left-1/2 flex w-[85%] -translate-x-1/2 items-center gap-3 rounded-xl bg-white px-3 py-3 shadow-lg"
                    >

                        <span
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 21s8-6.2 8-12a8 8 0 10-16 0c0 5.8 8 12 8 12z"
                                />

                                <circle
                                    cx="12"
                                    cy="9"
                                    r="2.5"
                                />
                            </svg>

                        </span>


                        <span class="text-[10px] font-semibold leading-4 text-[#193F6B]">

                            Jalan Dewaratwati Nomor 23,
                            Mengwitani, Mengwi,
                            Badung, Bali

                        </span>

                    </a>

                </div>



                {{-- INFO PENTING --}}
                <div
                    class="mt-5 flex gap-3 rounded-xl bg-[#CFE3FC] p-4"
                >

                    <div
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#0969D8] text-white"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v4m0 4h.01M10.3 3.7l-8 14A2 2 0 004 21h16a2 2 0 001.7-3.3l-8-14a2 2 0 00-3.4 0z"
                            />
                        </svg>

                    </div>


                    <div>

                        <h3 class="text-xs font-bold text-[#193F6B]">
                            Informasi Penting
                        </h3>

                        <p class="mt-1 text-[10px] leading-4 text-[#5D7390]">

                            Untuk saat ini, lokasi belum tersedia di
                            Google Maps. Anda dapat mencari alamat tersebut
                            secara manual pada Google Maps dengan mengetik:
                            <strong>
                                "Jalan Dewaratwati Nomor 23,
                                Mengwitani, Mengwi, Badung, Bali".
                            </strong>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    CTA
========================================================= --}}
<section class="bg-[#F3F8FE] px-5 py-10 md:px-6 lg:py-12">

    <div class="mx-auto max-w-7xl">

        <div
            class="overflow-hidden rounded-2xl bg-gradient-to-r from-[#1976D2] via-[#287FD8] to-[#A7C8EF] shadow-[0_10px_30px_rgba(30,76,120,0.14)]"
        >

            <div class="grid items-stretch lg:grid-cols-[1.3fr_0.8fr]">


                {{-- TEXT --}}
                <div class="p-7 md:p-10">

                    <h2 class="max-w-xl text-2xl font-bold leading-tight text-white md:text-3xl">

                        Butuh Produk atau Layanan untuk Kebutuhan
                        Anda ?

                    </h2>


                    <p class="mt-3 max-w-xl text-sm leading-6 text-white/90 md:text-base">

                        Jangan ragu untuk menghubungi kami. Tim kami siap
                        membantu memberikan informasi lebih lanjut mengenai
                        produk dan layanan yang tersedia.

                    </p>


                    <div class="mt-6">

                        <a
                            href="tel:+6285100821243"
                            class="inline-flex items-center gap-2 rounded-lg bg-white px-5 py-3 text-sm font-semibold text-[#0969D8] shadow-md transition duration-300 hover:-translate-y-0.5 hover:shadow-lg"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h2.28a2 2 0 011.94 1.515l.65 2.6a2 2 0 01-.45 1.85l-1.2 1.2a16 16 0 006.62 6.62l1.2-1.2a2 2 0 011.85-.45l2.6.65A2 2 0 0121 17.72V20a2 2 0 01-2 2h-1C9.716 22 2 14.284 2 5V4a2 2 0 011-1z"
                                />
                            </svg>

                            HUBUNGI KAMI

                        </a>

                    </div>

                </div>



                {{-- IMAGE --}}
                <div class="relative min-h-[240px]">

                    <img
                        src="{{ asset('images/kontak/cta_kontak.jpg') }}"
                        alt="Tim CV Arindah"
                        class="absolute inset-0 h-full w-full object-cover"
                    >

                </div>

            </div>

        </div>

    </div>

</section>

@endsection