<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomepageKontak;

class HomepageKontakSeeder extends Seeder
{
    public function run(): void
    {
        HomepageKontak::firstOrCreate(
            ['id' => 1],
            [
                'label' => 'KONTAK',
                'title' => 'Mari Terhubung dengan CV Arindah',
                'description' => 'Punya kebutuhan produk atau layanan? Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai kebutuhan Anda.',
                'button_text' => 'Hubungi Kami',
                'button_link' => 'mailto:cv.arindah2016@gmail.com',
                'background_image' => 'images/cta_beranda.jpg',
            ]
        );
    }
}
