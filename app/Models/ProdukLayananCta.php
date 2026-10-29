<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukLayananCta extends Model
{
    protected $table = 'produk_layanan_ctas';

    protected $fillable = [
        'title',
        'description',
        'button_text',
        'email',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
