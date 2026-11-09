<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use App\Models\PublicGaleriHero;
use App\Models\PublicGaleriItem;

class GaleriController extends Controller
{
    public function index()
    {
        $hero = PublicGaleriHero::first();

        $galeris = PublicGaleriItem::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('public.galeri', compact(
            'hero',
            'galeris'
        ));
    }
}
