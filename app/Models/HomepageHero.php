<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageHero extends Model
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