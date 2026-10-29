
@extends('admin.layouts.app')

@section('title', 'CMS Layanan Kami')
@section('page-title', 'CMS Produk & Layanan')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')

<div class="min-h-screen bg-[#F4F7FC] px-4 py-6 sm:px-6 lg:px-8">

    {{-- HEADER HALAMAN --}}
    <div class="mb-6">
        <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#0969D8]">
            Content Management System
        </p>

        <div class="mt-2 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <h1 class="text-2xl font-bold text-[#123B68] sm:text-3xl">
                    Layanan Kami
                </h1>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    Kelola konten Layanan Kami pada halaman Produk &amp; Layanan CV Arindah.
                </p>
            </div>

            <a href="{{ route('produk') }}"
               target="_blank"
               class="inline-flex items-center justify-center gap-2 self-start rounded-xl border border-[#D8E6F8] bg-white px-4 py-2.5 text-sm font-semibold text-[#0969D8] transition hover:bg-[#EEF5FF] sm:self-auto">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 3h7v7"/>
                    <path d="M10 14 21 3"/>
                    <path d="M19 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6"/>
                </svg>
                Lihat Halaman
            </a>
        </div>
    </div>

    {{-- NOTIFIKASI BERHASIL --}}
    @if (session('success'))
        <div class="mb-5 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="m5 12 4 4L19 6"/>
            </svg>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- NOTIFIKASI VALIDASI --}}
    @if ($errors->any())
        <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-semibold">Periksa kembali data yang kamu masukkan.</p>
            <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- INFORMASI SECTION --}}
    <div class="mb-6 rounded-2xl border border-[#E8EEF7] bg-white p-5 shadow-sm sm:p-6">
        <div class="flex items-start gap-4">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#E8F1FF] text-[#0969D8]">
                <svg class="h-6 w-6" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Z"/>
                    <path d="M3 9h18"/>
                </svg>
            </div>

            <div class="min-w-0 flex-1">
                <h2 class="text-lg font-bold text-[#123B68]">
                    Pengaturan Layanan Kami
                </h2>
                <p class="mt-1 text-sm leading-6 text-slate-500">
                    Ubah teks, gambar, dan daftar layanan yang ditampilkan pada halaman Produk &amp; Layanan.
                </p>

                <div class="mt-4 h-px w-full max-w-md bg-slate-100"></div>
            </div>
        </div>
    </div>

    {{-- FORM EDIT --}}
    <form action="{{ route('admin.produk-layanan.layanan.update') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">

            {{-- KONTEN UTAMA --}}
            <div class="overflow-hidden rounded-2xl border border-[#E8EEF7] bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#E8F1FF] text-[#0969D8]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"/>
                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-[#123B68]">
                                Konten Utama
                            </h2>
                            <p class="mt-1 text-xs text-slate-500">
                                Judul dan deskripsi bagian Layanan Kami.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 p-5 sm:p-6">

                    {{-- LABEL --}}
                    <div>
                        <label for="label" class="mb-2 block text-sm font-semibold text-slate-700">
                            Label Section <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="label"
                               name="label"
                               value="{{ old('label', $layanan->label) }}"
                               required
                               maxlength="100"
                               placeholder="Contoh: LAYANAN KAMI"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#0969D8] focus:ring-4 focus:ring-blue-100">

                        @error('label')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- JUDUL --}}
                    <div>
                        <label for="title" class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Layanan <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="title"
                               name="title"
                               value="{{ old('title', $layanan->title) }}"
                               required
                               maxlength="255"
                               placeholder="Masukkan judul layanan"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#0969D8] focus:ring-4 focus:ring-blue-100">

                        @error('title')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div>
                        <label for="description" class="mb-2 block text-sm font-semibold text-slate-700">
                            Deskripsi Layanan <span class="text-red-500">*</span>
                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  maxlength="3000"
                                  required
                                  placeholder="Masukkan deskripsi layanan..."
                                  class="w-full resize-y rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm leading-6 text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-[#0969D8] focus:ring-4 focus:ring-blue-100">{{ old('description', $layanan->description) }}</textarea>

                        <div class="mt-1.5 flex justify-between gap-3">
                            <p class="text-xs text-slate-400">
                                Deskripsi tampil di bawah judul layanan.
                            </p>
                            @error('description')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            {{-- GAMBAR LAYANAN --}}
            <div class="overflow-hidden rounded-2xl border border-[#E8EEF7] bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#E8F1FF] text-[#0969D8]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <path d="m21 15-5-5L5 21"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-[#123B68]">
                                Gambar Layanan
                            </h2>
                            <p class="mt-1 text-xs text-slate-500">
                                Kelola foto yang ditampilkan di sisi kiri section.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid gap-6 p-5 sm:p-6 lg:grid-cols-2 lg:items-start">

                    {{-- PREVIEW --}}
                    <div>
                        <p class="mb-2 text-sm font-semibold text-slate-700">
                            Preview Gambar
                        </p>

                        <div class="overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                            <img id="image-preview"
                                 src="{{ $layanan->image ? asset('storage/' . $layanan->image) : asset('images/layanan_kami.avif') }}"
                                 alt="Preview gambar Layanan Kami"
                                 class="h-56 w-full object-cover sm:h-64"
                                 onerror="this.onerror=null; this.src='{{ asset('images/layanan_kami.avif') }}';">
                        </div>

                        <p class="mt-2 text-xs leading-5 text-slate-400">
                            Gambar akan mengikuti area foto di landing page.
                        </p>
                    </div>

                    {{-- INPUT GAMBAR --}}
                    <div>
                        <label for="image" class="mb-2 block text-sm font-semibold text-slate-700">
                            Upload Gambar Baru
                        </label>

                        <label for="image"
                               class="flex min-h-44 cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-[#C9DCFF] bg-[#F8FBFF] px-5 py-7 text-center transition hover:border-[#0969D8] hover:bg-[#EEF5FF]">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#E8F1FF] text-[#0969D8]">
                                <svg class="h-6 w-6" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.8"
                                     stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 16V4"/>
                                    <path d="m7 9 5-5 5 5"/>
                                    <path d="M20 16.5v2A1.5 1.5 0 0 1 18.5 20h-13A1.5 1.5 0 0 1 4 18.5v-2"/>
                                </svg>
                            </div>

                            <span class="mt-3 text-sm font-semibold text-[#123B68]">
                                Klik untuk memilih gambar
                            </span>
                            <span class="mt-1 text-xs text-slate-400">
                                JPG, JPEG, PNG, WEBP, atau AVIF
                            </span>
                            <span class="mt-1 text-xs text-slate-400">
                                Ukuran maksimal 2 MB
                            </span>
                        </label>

                        <input type="file"
                               id="image"
                               name="image"
                               accept=".jpg,.jpeg,.png,.webp,.avif,image/jpeg,image/png,image/webp,image/avif"
                               class="sr-only">

                        <p id="image-name" class="mt-3 break-all text-xs text-slate-500">
                            Belum ada gambar baru yang dipilih.
                        </p>

                        @error('image')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- DAFTAR LAYANAN --}}
            <div class="overflow-hidden rounded-2xl border border-[#E8EEF7] bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#E8F1FF] text-[#0969D8]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="1.8"
                                 stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7" rx="1"/>
                                <rect x="14" y="3" width="7" height="7" rx="1"/>
                                <rect x="3" y="14" width="7" height="7" rx="1"/>
                                <rect x="14" y="14" width="7" height="7" rx="1"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="font-bold text-[#123B68]">
                                Daftar Layanan
                            </h2>
                            <p class="mt-1 text-xs text-slate-500">
                                Ubah teks pada ketiga kartu layanan di halaman publik.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 p-5 sm:p-6">

                    {{-- LAYANAN 1 --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="mb-3 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#E8F1FF] text-sm font-bold text-[#0969D8]">
                                01
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-[#123B68]">
                                    Layanan Pertama
                                </h3>
                                <p class="mt-1 text-xs text-slate-400">
                                    Pengadaan perangkat komputer dan jaringan.
                                </p>
                            </div>
                        </div>

                        <label for="service_1" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Layanan <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="service_1"
                               name="service_1"
                               value="{{ old('service_1', $layanan->service_1) }}"
                               required
                               maxlength="255"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#0969D8] focus:ring-4 focus:ring-blue-100">

                        @error('service_1')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- LAYANAN 2 --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="mb-3 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#E8F1FF] text-sm font-bold text-[#0969D8]">
                                02
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-[#123B68]">
                                    Layanan Kedua
                                </h3>
                                <p class="mt-1 text-xs text-slate-400">
                                    Kebutuhan teknologi.
                                </p>
                            </div>
                        </div>

                        <label for="service_2" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Layanan <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="service_2"
                               name="service_2"
                               value="{{ old('service_2', $layanan->service_2) }}"
                               required
                               maxlength="255"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#0969D8] focus:ring-4 focus:ring-blue-100">

                        @error('service_2')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- LAYANAN 3 --}}
                    <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="mb-3 flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-[#E8F1FF] text-sm font-bold text-[#0969D8]">
                                03
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-[#123B68]">
                                    Layanan Ketiga
                                </h3>
                                <p class="mt-1 text-xs text-slate-400">
                                    Solusi kebutuhan usaha dan operasional.
                                </p>
                            </div>
                        </div>

                        <label for="service_3" class="mb-2 block text-sm font-medium text-slate-700">
                            Nama Layanan <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               id="service_3"
                               name="service_3"
                               value="{{ old('service_3', $layanan->service_3) }}"
                               required
                               maxlength="255"
                               class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-[#0969D8] focus:ring-4 focus:ring-blue-100">

                        @error('service_3')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="flex flex-col-reverse gap-3 rounded-2xl border border-[#E8EEF7] bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-6">

                <p class="text-xs leading-5 text-slate-400">
                    Pastikan semua perubahan sudah benar sebelum disimpan.
                </p>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <button type="reset"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                        Reset Form
                    </button>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0969D8] px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0757B5] focus:outline-none focus:ring-4 focus:ring-blue-100">
                        <svg class="h-4 w-4" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="1.8"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"/>
                            <path d="M17 21v-8H7v8"/>
                            <path d="M7 3v5h8"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- PREVIEW GAMBAR SEBELUM DISIMPAN --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const imageName = document.getElementById('image-name');

        if (!imageInput || !imagePreview || !imageName) {
            return;
        }

        imageInput.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (!file) {
                imageName.textContent = 'Belum ada gambar baru yang dipilih.';
                return;
            }

            imageName.textContent = 'Gambar dipilih: ' + file.name;

            if (!file.type.startsWith('image/')) {
                imageName.textContent = 'File harus berupa gambar.';
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
        });
    });
</script>
@endsection
