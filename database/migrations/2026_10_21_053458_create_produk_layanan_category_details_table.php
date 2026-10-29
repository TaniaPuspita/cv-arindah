<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_layanan_category_details', function (Blueprint $table) {
            $table->id();

            // Relasi kategori dengan nama indeks pendek
            $table->unsignedBigInteger('produk_layanan_category_id');

            $table->unique(
                'produk_layanan_category_id',
                'plcd_category_unique'
            );

            $table->foreign(
                'produk_layanan_category_id',
                'plcd_category_fk'
            )
                ->references('id')
                ->on('produk_layanan_categories')
                ->cascadeOnDelete();

            // HERO
            $table->string('hero_label')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();

            // TENTANG KATEGORI
            $table->string('about_title')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();

            $table->string('about_highlight_1_title')->nullable();
            $table->text('about_highlight_1_description')->nullable();

            $table->string('about_highlight_2_title')->nullable();
            $table->text('about_highlight_2_description')->nullable();

            // KEUNGGULAN
            $table->string('advantages_title')->nullable();
            $table->text('advantages_description')->nullable();

            $table->string('advantage_1_title')->nullable();
            $table->text('advantage_1_description')->nullable();
            $table->string('advantage_1_icon')->nullable();

            $table->string('advantage_2_title')->nullable();
            $table->text('advantage_2_description')->nullable();
            $table->string('advantage_2_icon')->nullable();

            $table->string('advantage_3_title')->nullable();
            $table->text('advantage_3_description')->nullable();
            $table->string('advantage_3_icon')->nullable();

            // CTA
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_link')->nullable();
            $table->string('cta_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_layanan_category_details');
    }
};
