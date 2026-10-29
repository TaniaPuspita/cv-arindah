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
    Schema::create('produk_layanan_ctas', function (Blueprint $table) {
        $table->id();
        $table->string('title')->default(
            'Butuh Produk atau Layanan untuk Kebutuhan Anda?'
        );
        $table->text('description')->nullable();
        $table->string('button_text')->default('Hubungi Kami');
        $table->string('email')->default('cv.arindah2016@gmail.com');
        $table->string('image')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_layanan_ctas');
    }
};
