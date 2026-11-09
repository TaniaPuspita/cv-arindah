<?php

namespace Database\Seeders;

use App\Models\PublicGaleriHero;
use Illuminate\Database\Seeder;

class PublicGaleriHeroSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat data awal hanya jika ID 1 belum tersedia.
        // Data CMS yang sudah tersimpan tidak ditimpa.
        PublicGaleriHero::firstOrCreate(
            ['id' => 1],
            [
                'eyebrow' => 'KOLEKSI',
                'title' => 'Produk, Aktivitas & Layanan Kami',
                'description' => 'Beragam produk untuk mendukung kebutuhan teknologi, perkantoran, elektronik, dan kebutuhan lainnya.',
                'hero_eyebrow' => 'Galeri',
                'hero_title' => 'Cerita dalam',
                'title_highlight' => 'Setiap Visual',
                'hero_description' => 'Lihat lebih dekat berbagai produk, aktivitas, dan layanan yang menjadi bagian dari CV Arindah.',
                'hero_image' => null,
            ]
        );
    }
}
