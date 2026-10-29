<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageGaleri extends Model
{
    protected $table = 'homepage_galeris';

    protected $fillable = [
        'title',
        'image',
        'alt_text',
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
