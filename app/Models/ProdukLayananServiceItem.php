<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukLayananServiceItem extends Model
{
    protected $table = 'produk_layanan_service_items';

    protected $fillable = [
        'title',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];
}
