<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageFooter extends Model
{
    protected $table = 'homepage_footers';

    protected $fillable = [
        'company_name',
        'description',
        'logo',
        'tags',
        'phone',
        'email',
        'address',
        'navigation',
        'copyright_text',
        'location_text',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'navigation' => 'array',
        ];
    }
}
