<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageHeroController;
use App\Http\Controllers\Admin\HomepageAboutController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\HomepageServiceController;
use App\Http\Controllers\Admin\HomepageGaleriController;
use App\Http\Controllers\Admin\HomepageKontakController;
use App\Http\Controllers\Admin\HomepageFooterController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\ProdukLayananController;
use App\Http\Controllers\Admin\ProdukLayananCategoryDetailController;
use App\Http\Controllers\Admin\ProdukLayananServiceItemController;
use App\Http\Controllers\Admin\ProdukLayananCtaController;
use App\Http\Controllers\Admin\PublicGaleriItemController;
use App\Http\Controllers\Admin\PublicGaleriHeroController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\ContactMessageSubmissionController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK: BERANDA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $hero = HomepageHero::first();
    $about = HomepageAbout::first();

    // Kategori Beranda menggunakan model khusus Beranda.
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

    return view('home', compact(
        'hero',
        'about',
        'categories',
        'services',
        'galeris',
        'kontak'
    ));
})->name('home');


/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK: TENTANG KAMI
|--------------------------------------------------------------------------
*/

Route::get('/tentang-kami', function () {
    $aboutPage = AboutPage::first();

    return view('tentang', compact('aboutPage'));
})->name('tentang');


/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK: PRODUK & LAYANAN
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK: PRODUK & LAYANAN
|--------------------------------------------------------------------------
*/



Route::get('/produk-layanan', function () {
    $hero = ProdukLayananHero::first();

    $categories = ProdukLayananCategory::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    // Data section Layanan Kami
    $layanan = ProdukLayananService::first();

    // Data kartu dari CMS Layanan Kami
    $layananItems = ProdukLayananServiceItem::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    // Data CTA khusus halaman Produk & Layanan
    $cta = ProdukLayananCta::first();

    return view('produk', compact(
        'hero',
        'categories',
        'layanan',
        'layananItems',
        'cta'
    ));
})->name('produk');






/*
|--------------------------------------------------------------------------
| HALAMAN DETAIL PRODUK
|--------------------------------------------------------------------------
*/

Route::get('/produk/komputer', function () {
    $category = ProdukLayananCategory::with('detail')
        ->where('slug', 'komputer-teknologi')
        ->where('is_active', true)
        ->firstOrFail();

    $detail = $category->detail;

    return view('komputer', compact('category', 'detail'));
})->name('produk.komputer');

Route::get('/produk/elektronik-furniture', function () {
    $category = ProdukLayananCategory::with('detail')
        ->where('slug', 'elektronik-furniture')
        ->where('is_active', true)
        ->firstOrFail();

    $detail = $category->detail;

    return view('produk_elektronik_furniture', compact('category', 'detail'));
})->name('produk.elektronik');

Route::get('/produk/perlengkapan_kantor', function () {
    $category = ProdukLayananCategory::with('detail')
        ->where('slug', 'perlengkapan-kantor')
        ->where('is_active', true)
        ->firstOrFail();

    $detail = $category->detail;

    return view('perlengkapan_kantor', compact('category', 'detail'));
})->name('produk.perlengkapan_kantor');

Route::get('/produk/audio_video', function () {
    $category = ProdukLayananCategory::with('detail')
        ->where('slug', 'audio-video')
        ->where('is_active', true)
        ->firstOrFail();

    $detail = $category->detail;

    return view('audio_video', compact('category', 'detail'));
})->name('produk.audio_video');

Route::get('/produk/laboratorium_kesehatan', function () {
    $category = ProdukLayananCategory::with('detail')
        ->where('slug', 'laboratorium-kesehatan')
        ->where('is_active', true)
        ->firstOrFail();

    $detail = $category->detail;

    return view('laboratorium_kesehatan', compact('category', 'detail'));
})->name('produk.laboratorium_kesehatan');

Route::get('/produk/kebutuhan_sehari_hari', function () {
    $category = ProdukLayananCategory::with('detail')
        ->where('slug', 'kebutuhan-sehari-hari')
        ->where('is_active', true)
        ->firstOrFail();

    $detail = $category->detail;

    return view('kebutuhan_seharihari', compact('category', 'detail'));
})->name('produk.kebutuhan_sehari_hari');




/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK: GALERI
|--------------------------------------------------------------------------
*/


Route::get('/galeri', function () {
    $hero = \App\Models\PublicGaleriHero::first();

    $galeris = \App\Models\PublicGaleriItem::where('is_active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    return view('galeri', compact('hero', 'galeris'));
})->name('galeri');




/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK: KONTAK
|--------------------------------------------------------------------------
*/


Route::get('/kontak', function () {
    $contactPage = ContactPage::first();

    return view('kontak', compact('contactPage'));
})->name('kontak');

Route::post('/kontak/pesan', [
    ContactMessageSubmissionController::class,
    'store',
])->name('contact-messages.store');



/*
|--------------------------------------------------------------------------
| DASHBOARD DAN PROFILE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route::view('/dashboard', 'admin.dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('/profile', 'profile')
    ->middleware('auth')
    ->name('profile');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| CMS ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | CMS BERANDA: HERO
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/homepage-hero',
            [HomepageHeroController::class, 'edit']
        )->name('homepage-hero.edit');

        Route::put(
            '/homepage-hero',
            [HomepageHeroController::class, 'update']
        )->name('homepage-hero.update');


        /*
        |--------------------------------------------------------------------------
        | CMS BERANDA: TENTANG KAMI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/homepage-about',
            [HomepageAboutController::class, 'edit']
        )->name('homepage-about.edit');

        Route::put(
            '/homepage-about',
            [HomepageAboutController::class, 'update']
        )->name('homepage-about.update');


        /*
        |--------------------------------------------------------------------------
        | CMS BERANDA: KATEGORI PRODUK
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'product-categories',
            ProductCategoryController::class
        )->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | CMS BERANDA: LAYANAN
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'homepage-services',
            HomepageServiceController::class
        )->except(['show'])
         ->parameters([
             'homepage-services' => 'homepageService',
         ]);


        /*
        |--------------------------------------------------------------------------
        | CMS BERANDA: GALERI
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'homepage-galeris',
            HomepageGaleriController::class
        )->except(['show'])
         ->parameters([
             'homepage-galeris' => 'homepageGaleri',
         ]);


        /*
        |--------------------------------------------------------------------------
        | CMS BERANDA: KONTAK / CTA
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/homepage-kontak',
            [HomepageKontakController::class, 'edit']
        )->name('homepage-kontak.edit');

        Route::put(
            '/homepage-kontak',
            [HomepageKontakController::class, 'update']
        )->name('homepage-kontak.update');


        /*
        |--------------------------------------------------------------------------
        | CMS FOOTER
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/homepage-footer',
            [HomepageFooterController::class, 'edit']
        )->name('homepage-footer.edit');

        Route::put(
            '/homepage-footer',
            [HomepageFooterController::class, 'update']
        )->name('homepage-footer.update');


        /*
        |--------------------------------------------------------------------------
        | CMS HALAMAN TENTANG KAMI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/about-page',
            [AboutPageController::class, 'edit']
        )->name('about-page.edit');

        Route::put(
            '/about-page',
            [AboutPageController::class, 'update']
        )->name('about-page.update');

        Route::get(
            '/about-page/section/{section}',
            [AboutPageController::class, 'editSection']
        )->where('section', 'hero|profil|informasi|visi-misi|cta')
         ->name('about-page.section.edit');

        Route::put(
            '/about-page/section/{section}',
            [AboutPageController::class, 'updateSection']
        )->where('section', 'hero|profil|informasi|visi-misi|cta')
         ->name('about-page.section.update');


        /*
        |--------------------------------------------------------------------------
        | CMS PRODUK & LAYANAN: HERO
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/produk-layanan/hero',
            [ProdukLayananController::class, 'editHero']
        )->name('produk-layanan.hero.edit');

        Route::put(
            '/produk-layanan/hero',
            [ProdukLayananController::class, 'updateHero']
        )->name('produk-layanan.hero.update');


        /*
        |--------------------------------------------------------------------------
        | CMS PRODUK & LAYANAN: KATEGORI PRODUK
        |--------------------------------------------------------------------------
        */

        Route::prefix('produk-layanan/kategori')
            ->name('produk-layanan.categories.')
            ->controller(ProdukLayananController::class)
            ->group(function () {
                Route::get('/', 'indexCategories')->name('index');
                Route::get('/create', 'createCategory')->name('create');
                Route::post('/', 'storeCategory')->name('store');
                Route::get('/{category}/edit', 'editCategory')->name('edit');
                Route::put('/{category}', 'updateCategory')->name('update');
                Route::delete('/{category}', 'destroyCategory')->name('destroy');
            });

            // CMS Detail Kategori Produk
            Route::get(
                '/produk-layanan/category-details/{category}',
                [ProdukLayananCategoryDetailController::class, 'edit']
            )->name('produk-layanan.category-details.edit');

            Route::put(
                '/produk-layanan/category-details/{category}',
                [ProdukLayananCategoryDetailController::class, 'update']
            )->name('produk-layanan.category-details.update');

            
        /*
        |--------------------------------------------------------------------------
        | CMS PRODUK & LAYANAN: LAYANAN KAMI
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/produk-layanan/layanan',
            [ProdukLayananController::class, 'editLayanan']
        )->name('produk-layanan.layanan.edit');

        Route::put(
            '/produk-layanan/layanan',
            [ProdukLayananController::class, 'updateLayanan']
        )->name('produk-layanan.layanan.update');


        // CRUD Kartu Layanan pada halaman Produk & Layanan
        Route::prefix('produk-layanan/layanan-items')
            ->name('produk-layanan.layanan-items.')
            ->controller(ProdukLayananServiceItemController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{item}/edit', 'edit')->name('edit');
                Route::put('/{item}', 'update')->name('update');
                Route::delete('/{item}', 'destroy')->name('destroy');
            });

            /*
            |--------------------------------------------------------------------------
            | CMS PRODUK & LAYANAN: CTA / HUBUNGI KAMI
            |--------------------------------------------------------------------------
            */

            Route::get(
                '/produk-layanan/cta',
                [ProdukLayananCtaController::class, 'edit']
            )->name('produk-layanan.cta.edit');

            Route::put(
                '/produk-layanan/cta',
                [ProdukLayananCtaController::class, 'update']
            )->name('produk-layanan.cta.update');

            //2 BAGIAN GALERI 
            //1.HERO
            
            Route::put(
                'public-galeri-koleksi',
                [\App\Http\Controllers\Admin\PublicGaleriHeroController::class, 'updateKoleksi']
            )->name('public-galeri-koleksi.update');

            Route::get(
                'public-galeri-heroes/edit',
                [PublicGaleriHeroController::class, 'edit']
            )->name('public-galeri-heroes.edit');

            Route::put(
                'public-galeri-heroes',
                [PublicGaleriHeroController::class, 'update']
            )->name('public-galeri-heroes.update');
            //2.FOTO GALERI
            Route::resource(
                'public-galeri-items',
                \App\Http\Controllers\Admin\PublicGaleriItemController::class
            )->except(['show'])->parameters([
                'public-galeri-items' => 'publicGaleriItem',
            ]);

            
            // CMS Kontak
            Route::get('/contact-page/section/{section}', [
                ContactPageController::class,
                'editSection',
            ])->where('section', 'hero|informasi|formulir|lokasi|cta')
            ->name('contact-page.section.edit');

            Route::put('/contact-page/section/{section}', [
                ContactPageController::class,
                'updateSection',
            ])->where('section', 'hero|informasi|formulir|lokasi|cta')
            ->name('contact-page.section.update');

            // Pesan Masuk
            Route::get('/contact-messages', [
                ContactMessageController::class,
                'index',
            ])->name('contact-messages.index');

            Route::get('/contact-messages/{contactMessage}', [
                ContactMessageController::class,
                'show',
            ])->name('contact-messages.show');

            Route::patch('/contact-messages/{contactMessage}/unread', [
                ContactMessageController::class,
                'markUnread',
            ])->name('contact-messages.unread');

            Route::delete('/contact-messages/{contactMessage}', [
                ContactMessageController::class,
                'destroy',
            ])->name('contact-messages.destroy');


            //riwayat aktivitas
            Route::get('/activity-logs', [
                \App\Http\Controllers\Admin\AdminActivityLogController::class,
                'index',
            ])->name('activity-logs.index');


    });

