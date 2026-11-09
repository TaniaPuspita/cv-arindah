<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayananHero;
use App\Models\ProdukLayananCategory;
use App\Models\ProdukLayananService;
use App\Models\ProdukLayananServiceItem;
use App\Models\ProdukLayananCta;

class ProdukController extends Controller
{
    public function index()
    {
        $hero = ProdukLayananHero::first();

        $categories = ProdukLayananCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $layanan = ProdukLayananService::first();

        $layananItems = ProdukLayananServiceItem::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $cta = ProdukLayananCta::first();

        return view('public.produk', compact(
            'hero',
            'categories',
            'layanan',
            'layananItems',
            'cta'
        ));
    }
}
