<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $table = 'homepage_kontaks';

        $missing = [];

        $columns = [
            'label' => fn (Blueprint $table) =>
                $table->string('label')->default('KONTAK'),

            'title' => fn (Blueprint $table) =>
                $table->string('title')
                    ->default('Mari Terhubung dengan CV Arindah'),

            'description' => fn (Blueprint $table) =>
                $table->text('description')->nullable(),

            'button_text' => fn (Blueprint $table) =>
                $table->string('button_text')->default('Hubungi Kami'),

            'button_link' => fn (Blueprint $table) =>
                $table->string('button_link')
                    ->default('mailto:cv.arindah2016@gmail.com'),

            'background_image' => fn (Blueprint $table) =>
                $table->string('background_image')->nullable(),
        ];

        foreach ($columns as $column => $definition) {
            if (!Schema::hasColumn($table, $column)) {
                $missing[$column] = $definition;
            }
        }

        if (!empty($missing)) {
            Schema::table($table, function (Blueprint $table) use ($missing) {
                foreach ($missing as $definition) {
                    $definition($table);
                }
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus kolom atau data yang sudah tersimpan.
    }
};
