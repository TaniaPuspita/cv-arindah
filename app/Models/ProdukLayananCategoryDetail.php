<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukLayananCategoryDetail extends Model
{
    protected $fillable = [
        'produk_layanan_category_id',

        // Hero
        'hero_label',
        'hero_title',
        'hero_description',
        'hero_image',

        // Tentang Kategori
        'about_title',
        'about_description',
        'about_image',
        'about_highlight_1_title',
        'about_highlight_1_description',
        'about_highlight_2_title',
        'about_highlight_2_description',

        // Keunggulan
        'advantages_title',
        'advantages_description',
        'advantage_1_title',
        'advantage_1_description',
        'advantage_1_icon',
        'advantage_2_title',
        'advantage_2_description',
        'advantage_2_icon',
        'advantage_3_title',
        'advantage_3_description',
        'advantage_3_icon',

        // CTA
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_button_link',
        'cta_image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            ProdukLayananCategory::class,
            'produk_layanan_category_id'
        );
    }
}
