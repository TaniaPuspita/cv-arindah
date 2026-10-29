<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TABEL UNTUK MENYIMPAN KONTEN CMS TENTANG KAMI
        Schema::create('homepage_abouts', function (Blueprint $table) {
            $table->id();

            // LABEL DAN JUDUL
            $table->string('label')->default('TENTANG KAMI');
            $table->string('title')->default('MENGENAL CV ARINDAH');

            // DUA PARAGRAF DESKRIPSI
            $table->text('paragraph_one')->nullable();
            $table->text('paragraph_two')->nullable();

            // GAMBAR TENTANG KAMI
            $table->string('image')->nullable();

            // TIGA KATEGORI BIDANG USAHA
            $table->string('category_one')->default('Komputer & Perlengkapan');
            $table->string('category_two')->default('Elektronik & Furniture');
            $table->string('category_three')->default('Teknologi Informasi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_abouts');
    }
};
