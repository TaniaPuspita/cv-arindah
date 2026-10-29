<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageService extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'image',
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
