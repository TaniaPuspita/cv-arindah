<?php

namespace Database\Seeders;

use App\Models\HomepageGaleri;
use Illuminate\Database\Seeder;

class HomepageGaleriSeeder extends Seeder
{
    public function run(): void
    {
        $fotos = [
            [
                'title' => 'Galeri 1',
                'image' => 'images/menugaleri/galeri1.jpg',
                'alt_text' => 'Foto galeri CV Arindah 1',
                'sort_order' => 1,
            ],
            [
                'title' => 'Galeri 2',
                'image' => 'images/menugaleri/gambar2.avif',
                'alt_text' => 'Foto galeri CV Arindah 2',
                'sort_order' => 2,
            ],
            [
                'title' => 'Galeri 3',
                'image' => 'images/menugaleri/gambar3.jpg',
                'alt_text' => 'Foto galeri CV Arindah 3',
                'sort_order' => 3,
            ],
            [
                'title' => 'Galeri 4',
                'image' => 'images/menugaleri/gambar4.jpg',
                'alt_text' => 'Foto galeri CV Arindah 4',
                'sort_order' => 4,
            ],
            [
                'title' => 'Galeri 5',
                'image' => 'images/menugaleri/gambar5.jpg',
                'alt_text' => 'Foto galeri CV Arindah 5',
                'sort_order' => 5,
            ],
            [
                'title' => 'Galeri 6',
                'image' => 'images/menugaleri/gambar6.jpg',
                'alt_text' => 'Foto galeri CV Arindah 6',
                'sort_order' => 6,
            ],
            [
                'title' => 'Galeri 7',
                'image' => 'images/menugaleri/gambar7.jpg',
                'alt_text' => 'Foto galeri CV Arindah 7',
                'sort_order' => 7,
            ],
            [
                'title' => 'Galeri 8',
                'image' => 'images/menugaleri/gambar8.jpg',
                'alt_text' => 'Foto galeri CV Arindah 8',
                'sort_order' => 8,
            ],
        ];

        foreach ($fotos as $foto) {
            HomepageGaleri::firstOrCreate(
                ['image' => $foto['image']],
                array_merge($foto, [
                    'is_active' => true,
                ])
            );
        }
    }
}
