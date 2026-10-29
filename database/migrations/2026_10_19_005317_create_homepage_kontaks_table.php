<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('homepage_kontaks', function (Blueprint $table) {
            $table->id();
            $table->string('label')->default('KONTAK');
            $table->string('title')->default('Mari Terhubung dengan CV Arindah');
            $table->text('description')->nullable();
            $table->string('button_text')->default('Hubungi Kami');
            $table->string('button_link')->default('mailto:cv.arindah2016@gmail.com');
            $table->string('background_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_kontaks');
    }
};
