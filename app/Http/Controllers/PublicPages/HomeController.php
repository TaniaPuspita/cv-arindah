<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use App\Models\HomepageHero;
use App\Models\HomepageAbout;
use App\Models\ProductCategory;
use App\Models\HomepageService;
use App\Models\HomepageGaleri;
use App\Models\HomepageKontak;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HomepageHero::first();
        $about = HomepageAbout::first();

        $categories = ProductCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $services = HomepageService::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $galeris = HomepageGaleri::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $kontak = HomepageKontak::first();

        return view('public.home', compact(
            'hero',
            'about',
            'categories',
            'services',
            'galeris',
            'kontak'
        ));
    }
}
