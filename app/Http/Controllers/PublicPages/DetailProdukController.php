<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayananCategory;
use Illuminate\Support\Facades\Storage;

class DetailProdukController extends Controller
{
    /**
     * Menampilkan halaman detail berdasarkan slug kategori.
     */
    private function showCategoryDetail(string $slug)
    {
        $category = ProdukLayananCategory::with('detail')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $detail = $category->detail;

        /*
         * HERO IMAGE
         * Prioritas:
         * 1. Gambar hero dari CMS.
         * 2. Gambar kategori.
         */
        $heroImage = $this->resolveDetailImage(
            $detail?->hero_image ?: $category->image
        );

        /*
         * ABOUT IMAGE
         * Prioritas:
         * 1. Gambar About dari CMS.
         * 2. Gambar fallback kategori lama.
         * 3. Gambar kategori.
         */
        $aboutImageFallbacks = [
            'elektronik-furniture' =>
                'images/detail.furniture.jpg',

            'perlengkapan-kantor' =>
                'images/detail_perlengkapan_kantor.jpg',

            'audio-video' =>
                'images/detail_audio_video.jpg',

            'laboratorium-kesehatan' =>
                'images/detail_laboratorium_kesehatan.jpg',

            'kebutuhan-sehari-hari' =>
                'images/detail_kebutuhan_seharihari.jpg',
        ];

        $aboutImage = $this->resolveDetailImage(
            $detail?->about_image
                ?: ($aboutImageFallbacks[$slug] ?? $category->image)
        );

        /*
         * CTA IMAGE
         * Prioritas:
         * 1. Gambar CTA dari CMS.
         * 2. Gambar CTA default.
         */
        $ctaImage = $this->resolveDetailImage(
            $detail?->cta_image
                ?: 'images/cta_produk_layanan.jpg'
        );

        /*
         * CATEGORY CHIPS
         * Memisahkan nama kategori berdasarkan tanda &.
         */
        $categoryChips = preg_split(
            '/\s*&\s*/',
            $category->name,
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        /*
         * HIGHLIGHTS
         * Mengambil informasi utama dari CMS.
         */
        $highlights = [
            [
                'icon' => 'bi bi-lightbulb',
                'title' => $detail?->about_highlight_1_title,
                'description' =>
                    $detail?->about_highlight_1_description,
            ],
            [
                'icon' => 'bi bi-check-circle',
                'title' => $detail?->about_highlight_2_title,
                'description' =>
                    $detail?->about_highlight_2_description,
            ],
        ];

        $highlights = array_values(array_filter(
            $highlights,
            fn ($item) =>
                filled($item['title'])
                || filled($item['description'])
        ));

        /*
         * DEFAULT ICONS
         * Digunakan jika ikon belum diisi di CMS.
         */
        $defaultIcons = [
            'bi bi-grid',
            'bi bi-check-circle',
            'bi bi-info-circle',
        ];

        /*
         * ADVANTAGES
         * Mengambil tiga data keunggulan dari CMS.
         */
        $advantages = [];

        for ($i = 1; $i <= 3; $i++) {
            $titleField = 'advantage_' . $i . '_title';
            $descriptionField =
                'advantage_' . $i . '_description';
            $iconField = 'advantage_' . $i . '_icon';

            $title = $detail?->{$titleField};
            $description = $detail?->{$descriptionField};
            $icon = $detail?->{$iconField};

            if (filled($title) || filled($description)) {
                $advantages[] = [
                    'icon' => filled($icon)
                        ? $icon
                        : $defaultIcons[$i - 1],

                    'title' => $title,
                    'description' => $description,
                ];
            }
        }

        /*
         * MENAMPILKAN HALAMAN DETAIL KATEGORI
         */
        return view(
            'public.produk-layanan.detail.index',
            compact(
                'category',
                'detail',
                'heroImage',
                'aboutImage',
                'ctaImage',
                'categoryChips',
                'highlights',
                'advantages'
            )
        );
    }

    /**
     * Menampilkan detail kategori berdasarkan slug URL.
     * Digunakan untuk kategori yang ditambahkan melalui CMS.
     */
    public function show(string $slug)
    {
        return $this->showCategoryDetail($slug);
    }

    /**
     * Mengubah path gambar menjadi URL yang bisa ditampilkan.
     */
    private function resolveDetailImage(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        // Jika path berupa URL lengkap.
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Jika path sudah berupa path absolut.
        if (str_starts_with($path, '/')) {
            return $path;
        }

        // Jika gambar berada di storage public.
        if (str_starts_with(
            $path,
            'produk-layanan/details/'
        )) {
            return Storage::disk('public')->url($path);
        }

        // Jika gambar berada di folder public.
        return asset($path);
    }

    /**
     * Detail Komputer & Teknologi.
     */
    public function komputer()
    {
        return $this->showCategoryDetail('komputer-teknologi');
    }

    /**
     * Detail Elektronik & Furniture.
     */
    public function elektronik()
    {
        return $this->showCategoryDetail('elektronik-furniture');
    }

    /**
     * Detail Perlengkapan Kantor.
     */
    public function perlengkapanKantor()
    {
        return $this->showCategoryDetail('perlengkapan-kantor');
    }

    /**
     * Detail Audio & Video.
     */
    public function audioVideo()
    {
        return $this->showCategoryDetail('audio-video');
    }

    /**
     * Detail Laboratorium & Kesehatan.
     */
    public function laboratoriumKesehatan()
    {
        return $this->showCategoryDetail('laboratorium-kesehatan');
    }

    /**
     * Detail Kebutuhan Sehari-hari.
     */
    public function kebutuhanSehariHari()
    {
        return $this->showCategoryDetail('kebutuhan-sehari-hari');
    }
}
