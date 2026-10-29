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
        Schema::create('homepage_footers', function (Blueprint $table) {
            $table->id();

            // Identitas perusahaan
            $table->string('company_name')->default('CV Arindah');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();

            // Tag kategori
            $table->json('tags')->nullable();

            // Informasi kontak
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // Menu navigasi footer
            $table->json('navigation')->nullable();

            // Copyright dan lokasi
            $table->string('copyright_text')->nullable();
            $table->string('location_text')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homepage_footers');
    }

};
