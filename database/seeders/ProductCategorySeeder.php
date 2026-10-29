<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Komputer & Teknologi',
                'description' => 'Komputer, laptop, printer, aksesori, dan berbagai perlengkapan teknologi lainnya.',
                'image' => 'images/komputer_teknologi.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Elektronik & Furniture',
                'description' => 'Peralatan listrik, penerangan, elektronik, serta furniture untuk berbagai kebutuhan.',
                'image' => 'images/furnitur.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Perlengkapan Kantor',
                'description' => 'Alat tulis, perlengkapan administrasi, dan kebutuhan penunjang aktivitas kantor.',
                'image' => 'images/perlengkapan_kantor.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Audio & Video',
                'description' => 'Berbagai peralatan audio, video, dan perlengkapan untuk kebutuhan pribadi maupun profesional.',
                'image' => 'images/kamera_audio.jpg',
                'sort_order' => 4,
            ],
            [
                'name' => 'Laboratorium & Kesehatan',
                'description' => 'Peralatan laboratorium, farmasi, dan perlengkapan kesehatan sesuai kebutuhan.',
                'image' => 'images/laboratorium_kesehatan.jpg',
                'sort_order' => 5,
            ],
            [
                'name' => 'Kebutuhan Sehari-hari',
                'description' => 'Berbagai kebutuhan sehari-hari, seperti makanan, minuman, pakaian, kosmetik, dan produk lainnya.',
                'image' => 'images/kebutuhan sehari-hari.jpg',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            ProductCategory::firstOrCreate(
                ['name' => $category['name']],
                array_merge($category, ['is_active' => true])
            );
        }
    }
}