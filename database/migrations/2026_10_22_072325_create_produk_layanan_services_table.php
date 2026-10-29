<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_layanan_services', function (Blueprint $table) {
            $table->id();

            $table->string('label')->default('LAYANAN KAMI');
            $table->string('title')->default('Teknologi Informasi & Jasa Komputer');
            $table->text('description')->nullable();
            $table->string('image')->nullable();

            $table->string('service_1')
                ->default('Pengadaan Perangkat Komputer & Jaringan');

            $table->string('service_2')
                ->default('Kebutuhan Teknologi');

            $table->string('service_3')
                ->default('Solusi Kebutuhan Usaha & Operasional');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_layanan_services');
    }
};
