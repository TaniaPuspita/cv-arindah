<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProdukLayananCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'slug',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function detail(): HasOne
    // hubungkan model kategori
    {
        return $this->hasOne(
            ProdukLayananCategoryDetail::class,
            'produk_layanan_category_id'
        );
    }
}