<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;

class TentangController extends Controller
{
    public function index()
    {
        $aboutPage = AboutPage::first();

        return view('public.tentang', compact('aboutPage'));
    }
}
