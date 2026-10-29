<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicGaleriItem extends Model
{
    protected $table = 'public_galeri_items';

    protected $fillable = [
        'title',
        'category',
        'image',
        'alt_text',
        'image_position',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
