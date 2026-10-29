<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicGaleriHero extends Model
{
    protected $table = 'public_galeri_heroes';

    protected $fillable = [
        // Konten bagian Koleksi
        'eyebrow',
        'title',
        'description',

        // Konten bagian Hero
        'hero_eyebrow',
        'hero_title',
        'title_highlight',
        'hero_description',
        'hero_image',
    ];
}
