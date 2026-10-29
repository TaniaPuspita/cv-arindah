<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukLayananHero extends Model
{
    protected $fillable = [
        'label',
        'title',
        'description',
        'image',
        'button_text',
        'button_link',
    ];
}