<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'CV Arindah')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-white text-slate-800 antialiased">


    {{-- =========================================================
        NAVBAR
    ========================================================== --}}

    <header
        class="fixed left-0 top-0 z-50 w-full border-b border-slate-100 bg-white/95 backdrop-blur-md"
    >

        <nav
            class="mx-auto flex h-[78px] max-w-[1296px] items-center px-6 lg:px-8"
        >


            {{-- =================================================
                LOGO
            ================================================== --}}

            <a
                href="#beranda"
                class="flex shrink-0 items-center"
            >

                <img
                    src="/images/cv arindah.png"
                    alt="CV Arindah"
                    class="h-[46px] w-auto object-contain"
                >

            </a>



            {{-- =================================================
                MENU NAVBAR
            ================================================== --}}

            <div
                class="ml-auto hidden items-center gap-8 lg:flex"
            >

                {{-- BERANDA --}}
                <a
                href="{{ route('home') }}"
                class="whitespace-nowrap text-sm font-semibold transition duration-200
                    {{ request()->routeIs('home') ? 'text-[#0969D8] border-b-2 border-[#193F6B] pb-2' : 'text-slate-600 hover:text-[#0969D8]' }}"
            >
                Beranda
            </a>



                {{-- TENTANG KAMI --}}
            <a
                href="{{ route('tentang') }}"
                class="whitespace-nowrap text-sm font-semibold transition duration-200
                    {{ request()->routeIs('tentang') ? 'text-[#0969D8] border-b-2 border-[#193F6B] pb-2' : 'text-slate-600 hover:text-[#0969D8]' }}"
            >
                Tentang Kami
            </a>


                {{-- PRODUK & LAYANAN --}}
                <a
                    href="{{ route('produk') }}"
                    class="whitespace-nowrap text-sm font-semibold transition duration-200
                        {{ request()->routeIs('produk') ? 'text-[#0969D8] border-b-2 border-[#193F6B] pb-2' : 'text-slate-600 hover:text-[#0969D8]' }}"
                >
                    Produk & Layanan
                </a>


                {{-- GALERI --}}
                <a
                    href="{{ route('galeri') }}"
                    class="whitespace-nowrap text-sm font-semibold transition duration-200
                        {{ request()->routeIs('galeri') ? 'text-[#0969D8] border-b-2 border-[#193F6B] pb-2' : 'text-slate-600 hover:text-[#0969D8]' }}"
                >
                    Galeri
                </a>


                {{-- KONTAK --}}
                <a
                    href="{{ route('kontak') }}"
                    class="whitespace-nowrap text-sm font-semibold transition duration-200
                        {{ request()->routeIs('kontak') ? 'text-[#0969D8] border-b-2 border-[#193F6B] pb-2' : 'text-slate-600 hover:text-[#0969D8]' }}"
                >
                    Kontak
                </a>

            </div>



            {{-- =================================================
                BUTTON HUBUNGI KAMI
            ================================================== --}}

            <a
                href="{{ route('kontak') }}"
                class="ml-8 hidden shrink-0 rounded-lg bg-[#0969D8] px-5 py-3 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-[#075bb8] hover:shadow-md lg:block"
            >
                Hubungi Kami
            </a>

        </nav>

    </header>



    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <main>

        @yield('content')

    </main>



    {{-- =========================================================
        FOOTER
    ========================================================== --}}

    <footer class="bg-[#14549B] text-white">


        {{-- =====================================================
            FOOTER CONTAINER
        ====================================================== --}}

        <div
            class="mx-auto max-w-[1296px] px-6 py-14 lg:px-8"
        >


            {{-- =================================================
                FOOTER MAIN GRID
            ================================================== --}}

            <div
                class="grid gap-x-16 gap-y-12 md:grid-cols-[1.35fr_0.85fr_1fr]"
            >


                {{-- =================================================
                    KOLOM 1 — BRAND
                ================================================== --}}

                <div>


                    {{-- LOGO --}}

                    <div
                        class="inline-flex items-center rounded-xl bg-white px-5 py-3 shadow-sm"
                    >

                        <img
                            src="/images/cv arindah.png"
                            alt="CV Arindah"
                            class="h-[52px] w-auto object-contain"
                        >

                    </div>



                    {{-- DESKRIPSI --}}

                    <p
                        class="mt-5 max-w-[340px] text-sm leading-6 text-white/75"
                    >
                        Distributor & penyedia kebutuhan teknologi
                        dan produk pendukung untuk membantu
                        kebutuhan bisnis dan operasional Anda.
                    </p>



                    {{-- TAGLINE --}}

                    <p
                        class="mt-5 text-xs font-semibold uppercase tracking-[0.12em] text-white/50"
                    >
                        Teknologi • Produk • Solusi
                    </p>


                </div>



                {{-- =================================================
                    KOLOM 2 — MENU
                ================================================== --}}

                <div>


                    <h3
                        class="text-sm font-bold text-white"
                    >
                        Menu
                    </h3>



                    <div
                        class="mt-5 space-y-3"
                    >


                        {{-- BERANDA --}}

                        <a
                            href="#beranda"
                            class="block text-sm text-white/70 transition duration-200 hover:translate-x-1 hover:text-white"
                        >
                            Beranda
                        </a>



                        {{-- TENTANG KAMI --}}

                        <a
                            href="#tentang"
                            class="block text-sm text-white/70 transition duration-200 hover:translate-x-1 hover:text-white"
                        >
                            Tentang Kami
                        </a>



                        {{-- PRODUK & LAYANAN --}}

                        <a
                            href="#produk"
                            class="block text-sm text-white/70 transition duration-200 hover:translate-x-1 hover:text-white"
                        >
                            Produk & Layanan
                        </a>



                        {{-- LAYANAN --}}

                        <a
                            href="#layanan"
                            class="block text-sm text-white/70 transition duration-200 hover:translate-x-1 hover:text-white"
                        >
                            Layanan
                        </a>



                        {{-- GALERI --}}

                        <a
                            href="#galeri"
                            class="block text-sm text-white/70 transition duration-200 hover:translate-x-1 hover:text-white"
                        >
                            Galeri
                        </a>



                        {{-- KONTAK --}}

                        <a
                            href="#kontak"
                            class="block text-sm text-white/70 transition duration-200 hover:translate-x-1 hover:text-white"
                        >
                            Kontak
                        </a>


                    </div>


                </div>



                {{-- =================================================
                    KOLOM 3 — HUBUNGI KAMI
                ================================================== --}}

                <div class="md:pl-6">


                    <h3
                        class="text-sm font-bold text-white"
                    >
                        Hubungi Kami
                    </h3>



                    {{-- TELEPON --}}

                    <div
                        class="mt-5"
                    >

                        <p
                            class="text-xs font-semibold uppercase tracking-wide text-white/45"
                        >
                            Telepon
                        </p>


                        <a
                            href="tel:085100821243"
                            class="mt-1 block text-sm text-white/75 transition duration-200 hover:text-white"
                        >
                            +6285100821243
                        </a>

                    </div>



                    {{-- EMAIL --}}

                    <div
                        class="mt-5"
                    >

                        <p
                            class="text-xs font-semibold uppercase tracking-wide text-white/45"
                        >
                            Email
                        </p>


                        <a
                            href="mailto:cv.arindah2016@gmail.com"
                            class="mt-1 block text-sm text-white/75 transition duration-200 hover:text-white"
                        >
                            cv.arindah2016@gmail.com
                        </a>

                    </div>



                    {{-- ALAMAT --}}

                    <div
                        class="mt-5"
                    >

                        <p
                            class="text-xs font-semibold uppercase tracking-wide text-white/45"
                        >
                            Alamat
                        </p>


                        <p
                            class="mt-1 max-w-[330px] text-sm leading-6 text-white/75"
                        >
                            Jalan Dewarawati Nomor 23,
                            Mengwitani, Mengwi,
                            Badung, Bali
                        </p>

                    </div>


                </div>


            </div>



            {{-- =================================================
                DIVIDER
            ================================================== --}}

            <div
                class="mt-12 border-t border-white/15"
            ></div>



            {{-- =================================================
                FOOTER BOTTOM
            ================================================== --}}

            <div
                class="flex flex-col gap-3 pt-6 text-center md:flex-row md:items-center md:justify-between md:text-left"
            >


                {{-- COPYRIGHT --}}

                <p
                    class="text-xs text-white/55"
                >
                    © {{ date('Y') }} CV Arindah. All rights reserved.
                </p>



                {{-- LOCATION --}}

                <p
                    class="text-xs text-white/45"
                >
                    Badung, Bali, Indonesia
                </p>


            </div>


        </div>


    </footer>


</body>

</html>