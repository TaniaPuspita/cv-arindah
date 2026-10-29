<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageAbout extends Model
{
    // Kolom yang boleh diisi melalui CMS
    protected $fillable = [
        'label',
        'title',
        'paragraph_one',
        'paragraph_two',
        'image',
        'category_one',
        'category_two',
        'category_three',
    ];
}
