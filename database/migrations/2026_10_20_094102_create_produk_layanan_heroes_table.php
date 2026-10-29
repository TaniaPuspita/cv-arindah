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
        Schema::create('produk_layanan_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('label')->default('PRODUK & LAYANAN');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('button_text')->default('Lihat Produk');
            $table->string('button_link')->default('#produk');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_layanan_heroes');
    }
};
