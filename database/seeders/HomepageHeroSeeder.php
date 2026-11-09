<?php

namespace Database\Seeders;

use App\Models\HomepageHero;
use Illuminate\Database\Seeder;

class HomepageHeroSeeder extends Seeder
{
    public function run(): void
    {
        HomepageHero::firstOrCreate(
            ['id' => 1],
            [
                'label' => 'CV ARINDAH',
                'title' => 'Solusi Produk & Kebutuhan Teknologi Bisnis Anda',
                'description' => '',
                'image' => null,
                'button_text' => 'Lihat Produk',
                'button_link' => '/produk-layanan',
            ]
        );
    }
}
