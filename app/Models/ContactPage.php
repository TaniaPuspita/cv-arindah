<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $table = 'contact_pages';

    protected $fillable = [
        'hero_label',
        'hero_title',
        'hero_description',
        'hero_image',

        'contact_section_title',
        'contact_email',
        'contact_phone',
        'contact_address',

        'form_label',
        'form_title',
        'form_description',
        'form_button_text',

        'location_title',
        'location_address',
        'location_note',
        'maps_url',
        'location_image',

        'cta_title',
        'cta_description',
        'cta_phone',
        'cta_image',
    ];
}
