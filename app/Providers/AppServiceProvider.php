<?php

namespace App\Providers;

use App\Observers\AdminActivityObserver;
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

use App\Models\HomepageFooter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            static $footer = null;
            static $loaded = false;

            if (! $loaded) {
                $footer = Schema::hasTable('homepage_footers')
                    ? HomepageFooter::first()
                    : null;

                $loaded = true;
            }

            $view->with('footer', $footer);
        });

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

    foreach ($models as $model) {
        $model::observe(AdminActivityObserver::class);
    }

    }
}