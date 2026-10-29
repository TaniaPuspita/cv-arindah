<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\ContactMessage;
use App\Models\HomepageHero;
use App\Models\HomepageAbout;
use App\Models\ProductCategory;
use App\Models\HomepageService;
use App\Models\HomepageGaleri;
use App\Models\HomepageKontak;
use App\Models\AboutPage;
use App\Models\ProdukLayananHero;
use App\Models\ProdukLayananCategory;
use App\Models\ProdukLayananService;
use App\Models\ProdukLayananServiceItem;
use App\Models\ProdukLayananCta;
use App\Models\PublicGaleriHero;
use App\Models\PublicGaleriItem;
use App\Models\ContactPage;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | JUMLAH KONTEN CMS
        |--------------------------------------------------------------------------
        */

        $models = [
            HomepageHero::class,
            HomepageAbout::class,
            ProductCategory::class,
            HomepageService::class,
            HomepageGaleri::class,
            HomepageKontak::class,
            AboutPage::class,
            ProdukLayananHero::class,
            ProdukLayananCategory::class,
            ProdukLayananService::class,
            ProdukLayananServiceItem::class,
            ProdukLayananCta::class,
            PublicGaleriHero::class,
            PublicGaleriItem::class,
            ContactPage::class,
        ];

        $totalKonten = 0;

        foreach ($models as $model) {
            $totalKonten += $model::count();
        }

        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS ADMIN HARI INI
        |--------------------------------------------------------------------------
        */

        $todayActivities = AdminActivityLog::query()
            ->whereBetween('created_at', [
                Carbon::today(),
                Carbon::tomorrow(),
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERBARU
        |--------------------------------------------------------------------------
        */

        $recentActivities = AdminActivityLog::with('user')
            ->latest()
            ->take(6)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PESAN PENGUNJUNG
        |--------------------------------------------------------------------------
        */

        $totalMessages = ContactMessage::count();

        $unreadMessages = ContactMessage::where('is_read', false)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | RINGKASAN DASHBOARD
        |--------------------------------------------------------------------------
        */

        // Lima halaman utama website.
        $totalPages = 5;

        // Lima kategori utama CMS.
        $totalCategories = 5;

        return view('admin.dashboard', compact(
            'totalKonten',
            'totalPages',
            'totalCategories',
            'todayActivities',
            'recentActivities',
            'totalMessages',
            'unreadMessages'
        ));
    }
}
