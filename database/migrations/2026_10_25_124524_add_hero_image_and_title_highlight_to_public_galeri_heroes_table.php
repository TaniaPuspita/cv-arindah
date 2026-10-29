<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('public_galeri_heroes', function (Blueprint $table) {
            $table->string('title_highlight', 200)
                ->default('Setiap Visual')
                ->after('title');

            $table->string('hero_image')
                ->nullable()
                ->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('public_galeri_heroes', function (Blueprint $table) {
            $table->dropColumn(['title_highlight', 'hero_image']);
        });
    }
};
