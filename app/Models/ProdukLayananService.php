<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukLayananService extends Model
{
    protected $table = 'produk_layanan_services';

    protected $fillable = [
        'label',
        'title',
        'description',
        'image',
        'service_1',
        'service_2',
        'service_3',
    ];
}
