<?php

namespace Database\Seeders;

use App\Models\ProdukLayananCta;
use Illuminate\Database\Seeder;

class ProdukLayananCtaSeeder extends Seeder
{
    public function run(): void
    {
        // Jangan menimpa data CTA yang sudah ada.
        if (ProdukLayananCta::query()->exists()) {
            $this->command?->info(
                'Data CTA Produk & Layanan sudah tersedia. Tidak ada perubahan.'
            );

            return;
        }

        ProdukLayananCta::query()->create([
            'title' => 'Butuh Produk atau Layanan untuk Kebutuhan Anda?',
            'description' => 'Hubungi CV Arindah untuk mendapatkan informasi lebih lanjut mengenai produk dan layanan yang tersedia.',
            'button_text' => 'Hubungi Kami',
            'email' => 'cv.arindah2016@gmail.com',
            'image' => null,
            'is_active' => true,
        ]);

        $this->command?->info(
            'Data awal CTA Produk & Layanan berhasil dibuat.'
        );
    }
}
