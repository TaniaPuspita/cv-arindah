<?php

namespace Database\Seeders;

use App\Models\HomepageAbout;
use Illuminate\Database\Seeder;

class HomepageAboutSeeder extends Seeder
{
    public function run(): void
    {
        // Jangan menimpa konten CMS yang sudah ada.
        if (HomepageAbout::query()->exists()) {
            return;
        }

        HomepageAbout::create([
            'label' => 'TENTANG KAMI',
            'title' => 'MENGENAL CV ARINDAH',
            'paragraph_one' => 'CV Arindah bergerak dalam berbagai bidang perdagangan eceran, termasuk komputer dan perlengkapan, peralatan listrik, alat tulis, furniture, audio dan video, serta kebutuhan laboratorium dan kesehatan.',
            'paragraph_two' => 'Selain itu, CV Arindah juga memiliki aktivitas di bidang teknologi informasi dan jasa komputer lainnya.',
            'image' => null,
            'category_one' => 'Komputer & Perlengkapan',
            'category_two' => 'Elektronik & Furniture',
            'category_three' => 'Teknologi Informasi',
        ]);
    }
}
