<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_pages', function (Blueprint $table) {
            $table->string('form_label')
                ->default('Kirim Pesan');

            $table->string('form_title')
                ->default('Kirim Pesan / Permintaan Informasi');

            $table->text('form_description')
                ->nullable();

            $table->string('form_button_text')
                ->default('Kirim Pesan');
        });
    }

    public function down(): void
    {
        Schema::table('contact_pages', function (Blueprint $table) {
            $table->dropColumn([
                'form_label',
                'form_title',
                'form_description',
                'form_button_text',
            ]);
        });
    }
};
