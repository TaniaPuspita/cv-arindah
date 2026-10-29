<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('public_galeri_heroes', function (Blueprint $table) {
            $table->string('hero_eyebrow', 100)
                ->default('Galeri');

            $table->string('hero_title', 200)
                ->default('Cerita dalam');

            $table->text('hero_description')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('public_galeri_heroes', function (Blueprint $table) {
            $table->dropColumn([
                'hero_eyebrow',
                'hero_title',
                'hero_description',
            ]);
        });
    }
};
