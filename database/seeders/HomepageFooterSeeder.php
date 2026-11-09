<?php

namespace Database\Seeders;

use App\Models\HomepageFooter;
use Illuminate\Database\Seeder;

class HomepageFooterSeeder extends Seeder
{
    /**
     * Mengisi data awal Footer jika tabel masih kosong.
     */
    public function run(): void
    {
        // Jangan menimpa data Footer yang sudah tersedia.
        if (HomepageFooter::query()->exists()) {
            $this->command?->info(
                'Data Footer sudah tersedia. Tidak ada perubahan.'
            );

            return;
        }

        HomepageFooter::create([
            'company_name' => 'CV Arindah',
            'description' => 'Menyediakan berbagai kebutuhan produk dan perlengkapan untuk mendukung kebutuhan pelanggan.',
            'tags' => ['Teknologi', 'Produk', 'Solusi'],
            'phone' => '+62 851-0082-1243',
            'email' => 'cv.arindah2016@gmail.com',
            'address' => 'Jalan Dewarawati Nomor 23, Mengwitani, Mengwi, Badung, Bali',
            'navigation' => [
                ['route' => 'home', 'label' => 'Beranda'],
                ['route' => 'tentang', 'label' => 'Tentang Kami'],
                ['route' => 'produk', 'label' => 'Produk & Layanan'],
                ['route' => 'galeri', 'label' => 'Galeri'],
                ['route' => 'kontak', 'label' => 'Kontak'],
            ],
            'copyright_text' => 'CV Arindah. All rights reserved.',
            'location_text' => 'Badung, Bali, Indonesia',
        ]);

        $this->command?->info(
            'Data awal Footer berhasil dibuat.'
        );
    }
}
