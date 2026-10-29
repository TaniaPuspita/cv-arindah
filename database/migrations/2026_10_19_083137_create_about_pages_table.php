<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();

            // 1. HERO TENTANG KAMI
            $table->string('hero_label')->default('TENTANG KAMI');
            $table->string('hero_title_line1')->default('Mengenal');
            $table->string('hero_title_line2')->default('Lebih Dekat');
            $table->string('hero_title_line3')->default('CV Arindah');
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // 2. PROFIL PERUSAHAAN
            $table->string('profile_label')->default('Tentang Kami');
            $table->string('profile_title')->default('Mengenal CV Arindah');
            $table->text('profile_paragraph_one')->nullable();
            $table->text('profile_paragraph_two')->nullable();
            $table->string('profile_image')->nullable();

            // 3. INFORMASI UTAMA
            $table->string('info_label')->default('CV Arindah Dalam Singkat');
            $table->string('info_title')->default('Informasi Utama Kami');

            $table->string('info_one_title')->default('6 Kategori Produk');
            $table->text('info_one_description')->nullable();

            $table->string('info_two_title')->default('Teknologi Informasi');
            $table->text('info_two_description')->nullable();

            $table->string('info_three_title')->default('Berbasis di Bali');
            $table->text('info_three_description')->nullable();

            // 4. VISI DAN MISI
            $table->string('vision_mission_label')->default('Visi & Misi');
            $table->string('vision_mission_title')->default('Visi dan Misi CV Arindah');
            $table->text('vision_mission_description')->nullable();

            $table->text('vision')->nullable();
            $table->text('mission_description')->nullable();

            $table->string('mission_one_title')->default('Menyediakan Beragam Produk');
            $table->text('mission_one_description')->nullable();

            $table->string('mission_two_title')->default('Mendukung Kebutuhan Teknologi');
            $table->text('mission_two_description')->nullable();

            $table->string('mission_three_title')->default('Memberikan Informasi yang Jelas');
            $table->text('mission_three_description')->nullable();

            // 5. CTA TENTANG KAMI
            $table->string('cta_label')->default('BUTUH INFORMASI LEBIH LANJUT?');
            $table->string('cta_title')->default('Mari Terhubung dengan CV Arindah');
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->default('Hubungi Kami');
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
