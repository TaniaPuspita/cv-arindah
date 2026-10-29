<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageKontak extends Model
{
    protected $table = 'homepage_kontaks';

    protected $fillable = [
        'label',
        'title',
        'description',
        'button_text',
        'button_link',
        'background_image',
    ];
}
