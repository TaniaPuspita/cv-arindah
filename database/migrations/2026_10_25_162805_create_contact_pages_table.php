<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();

            // Hero Kontak
            $table->string('hero_label')->default('Kontak');
            $table->string('hero_title')->default(
                'Kami Siap Membantu Kebutuhan Anda'
            );
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // Informasi Kontak
            $table->string('contact_section_title')->default(
                'Cara Menghubungi Kami'
            );
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->text('contact_address')->nullable();

            // Lokasi Kami
            $table->string('location_title')->default(
                'Temukan Alamat Kami'
            );
            $table->text('location_address')->nullable();
            $table->text('location_note')->nullable();
            $table->string('maps_url')->nullable();
            $table->string('location_image')->nullable();

            // CTA Kontak
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_phone')->nullable();
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
