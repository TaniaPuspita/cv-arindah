<?php

namespace App\Http\Controllers\PublicPages;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;

class KontakController extends Controller
{
    public function index()
    {
        $contactPage = ContactPage::first();

        return view('public.kontak', compact('contactPage'));
    }
}
