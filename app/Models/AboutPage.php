<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    protected $table = 'about_pages';

    protected $fillable = [
        'hero_label',
        'hero_title_line1',
        'hero_title_line2',
        'hero_title_line3',
        'hero_description',
        'hero_image',

        'profile_label',
        'profile_title',
        'profile_paragraph_one',
        'profile_paragraph_two',
        'profile_image',

        'info_label',
        'info_title',
        'info_one_title',
        'info_one_description',
        'info_two_title',
        'info_two_description',
        'info_three_title',
        'info_three_description',

        'vision_mission_label',
        'vision_mission_title',
        'vision_mission_description',
        'vision',
        'mission_description',
        'mission_one_title',
        'mission_one_description',
        'mission_two_title',
        'mission_two_description',
        'mission_three_title',
        'mission_three_description',

        'cta_label',
        'cta_title',
        'cta_description',
        'cta_button_text',
        'cta_image',
    ];
}
