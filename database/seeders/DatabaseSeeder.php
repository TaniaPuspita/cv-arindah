<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Data awal CMS Beranda.
        $this->call([
            HomepageHeroSeeder::class,
            HomepageAboutSeeder::class,
            HomepageGaleriSeeder::class,
            HomepageKontakSeeder::class,

            // Konten awal CMS halaman Tentang Kami.
            AboutPageSeeder::class,

            // Konten awal CMS halaman Kontak.
            ContactPageSeeder::class,

            // Kategori awal produk.
            ProductCategorySeeder::class,

            // Konten awal halaman Produk & Layanan.
            ProdukLayananHeroSeeder::class,
            ProdukLayananServiceSeeder::class,
            ProdukLayananCtaSeeder::class,

            // Data awal CMS Footer.
            HomepageFooterSeeder::class,

            // Data awal Hero Galeri Publik.
            PublicGaleriHeroSeeder::class,
            EmailTemplateSeeder::class,
        ]);

        // Buat akun pengujian hanya jika email belum terdaftar.
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );
    }
}
