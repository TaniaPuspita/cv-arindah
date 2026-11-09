<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        // Jangan menimpa konten yang sudah dikelola melalui CMS.
        if (AboutPage::query()->exists()) {
            return;
        }

        AboutPage::create([
            // HERO TENTANG KAMI
            'hero_label' => 'TENTANG KAMI',
            'hero_title_line1' => 'Mengenal',
            'hero_title_line2' => 'Lebih Dekat',
            'hero_title_line3' => 'CV Arindah',
            'hero_description' => 'Kenali lebih dekat CV Arindah, produk yang tersedia, dan layanan teknologi informasi yang kami tawarkan.',
            'hero_image' => null,

            // PROFIL PERUSAHAAN
            'profile_label' => 'Tentang Kami',
            'profile_title' => 'Mengenal CV Arindah',
            'profile_paragraph_one' => 'CV Arindah merupakan perusahaan yang menjalankan berbagai kegiatan usaha dalam bidang perdagangan barang dan teknologi informasi. Kegiatan usaha yang tersedia mencakup berbagai kategori produk, mulai dari komputer dan teknologi, elektronik dan furniture, perlengkapan kantor, audio dan video, laboratorium dan kesehatan, hingga kebutuhan sehari-hari.',
            'profile_paragraph_two' => 'Selain kegiatan perdagangan, CV Arindah juga memiliki aktivitas di bidang teknologi informasi dan jasa komputer lainnya sebagai bagian dari kegiatan usaha perusahaan.',
            'profile_image' => null,

            // INFORMASI UTAMA
            'info_label' => 'CV Arindah Dalam Singkat',
            'info_title' => 'Informasi Utama Kami',
            'info_one_title' => '6 Kategori Produk',
            'info_one_description' => 'Beragam kategori produk untuk memenuhi berbagai kebutuhan pelanggan.',
            'info_two_title' => 'Teknologi Informasi',
            'info_two_description' => 'Menyediakan produk komputer dan layanan yang berkaitan dengan teknologi informasi.',
            'info_three_title' => 'Berbasis di Bali',
            'info_three_description' => 'Jalan Dewaratwati Nomor 23, Mengwitani, Mengwi, Badung, Bali.',

            // VISI DAN MISI
            'vision_mission_label' => 'Visi & Misi',
            'vision_mission_title' => 'Visi dan Misi CV Arindah',
            'vision_mission_description' => 'Landasan dan arah CV Arindah dalam memberikan produk dan layanan terbaik bagi pelanggan.',
            'vision' => 'Menjadi perusahaan yang mampu memenuhi beragam kebutuhan pelanggan melalui penyediaan produk dan layanan teknologi informasi yang sesuai dengan kebutuhan.',
            'mission_description' => 'Menjalankan kegiatan usaha dengan menyediakan produk dan informasi yang sesuai dengan kebutuhan pelanggan.',
            'mission_one_title' => 'Menyediakan Beragam Produk',
            'mission_one_description' => 'Menyediakan berbagai kategori produk untuk memenuhi kebutuhan pelanggan.',
            'mission_two_title' => 'Mendukung Kebutuhan Teknologi',
            'mission_two_description' => 'Menyediakan produk komputer dan teknologi serta aktivitas teknologi informasi sesuai dengan bidang usaha perusahaan.',
            'mission_three_title' => 'Memberikan Informasi yang Jelas',
            'mission_three_description' => 'Menyediakan informasi yang membantu pelanggan mengenali produk dan layanan yang tersedia.',

            // CTA TENTANG KAMI
            'cta_label' => 'BUTUH INFORMASI LEBIH LANJUT?',
            'cta_title' => 'Mari Terhubung dengan CV Arindah',
            'cta_description' => 'Hubungi CV Arindah untuk mendapatkan informasi mengenai produk dan layanan yang tersedia.',
            'cta_button_text' => 'Hubungi Kami',
            'cta_image' => null,
        ]);
    }
}
