<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('public_galeri_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->enum('category', ['produk', 'jasa']);
            $table->string('image');
            $table->string('alt_text', 255)->nullable();
            $table->string('image_position', 100)->default('center');
            $table->unsignedInteger('sort_order')->default(1);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('public_galeri_items');
    }
};
