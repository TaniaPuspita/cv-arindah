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
        Schema::create('public_galeri_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->default('KOLEKSI');
            $table->string('title')->default('Produk, Aktivitas & Layanan Kami');
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_galeri_heroes');
    }
};
