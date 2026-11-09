<?php

namespace Database\Seeders;

use App\Models\ProdukLayananHero;
use Illuminate\Database\Seeder;

class ProdukLayananHeroSeeder extends Seeder
{
    public function run(): void
    {
        // Buat data awal hanya jika belum ada.
        // Tidak menimpa konten CMS yang sudah tersimpan.
        ProdukLayananHero::firstOrCreate(
            [],
            [
                'label' => 'PRODUK & LAYANAN',
                'title' => 'Solusi untuk Mendukung Berbagai Kebutuhan Anda',
                'description' => 'CV Arindah menyediakan layanan yang mendukung kebutuhan pelanggan dalam memperoleh berbagai produk dan perlengkapan secara praktis, cepat, dan terpercaya.',
                'image' => null,
                'button_text' => 'Lihat Produk',
                'button_link' => '#produk',
            ]
        );
    }
}
