<?php

use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\AdminActivityLogController;
use App\Http\Controllers\Admin\ContactMessageController;
// ==========================================================
// PUBLIC CONTROLLERS
// ==========================================================

use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\HomepageAboutController;
use App\Http\Controllers\Admin\HomepageFooterController;
use App\Http\Controllers\Admin\HomepageGaleriController;
use App\Http\Controllers\Admin\HomepageHeroController;
// ==========================================================
// ADMIN CONTROLLERS
// ==========================================================

use App\Http\Controllers\Admin\HomepageKontakController;
use App\Http\Controllers\Admin\HomepageServiceController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProdukLayananCategoryDetailController;
use App\Http\Controllers\Admin\ProdukLayananController;
use App\Http\Controllers\Admin\ProdukLayananCtaController;
use App\Http\Controllers\Admin\ProdukLayananServiceItemController;
use App\Http\Controllers\Admin\PublicGaleriHeroController;
use App\Http\Controllers\Admin\PublicGaleriItemController;
use App\Http\Controllers\ContactMessageSubmissionController;
use App\Http\Controllers\PublicPages\DetailProdukController;
use App\Http\Controllers\PublicPages\GaleriController;
use App\Http\Controllers\PublicPages\HomeController;
use App\Http\Controllers\PublicPages\KontakController;
use App\Http\Controllers\PublicPages\ProdukController;
use App\Http\Controllers\PublicPages\TentangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ==========================================================
// HALAMAN PUBLIK
// ==========================================================

// Beranda
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Tentang Kami
Route::get('/tentang-kami', [TentangController::class, 'index'])
    ->name('tentang');

// Produk & Layanan
Route::get('/produk-layanan', [ProdukController::class, 'index'])
    ->name('produk');

// Detail Produk: Komputer
Route::get('/produk/komputer', [
    DetailProdukController::class,
    'komputer',
])->name('produk.komputer');

// Detail Produk: Elektronik & Furniture
Route::get('/produk/elektronik-furniture', [
    DetailProdukController::class,
    'elektronik',
])->name('produk.elektronik');

// Detail Produk: Perlengkapan Kantor
Route::get('/produk/perlengkapan_kantor', [
    DetailProdukController::class,
    'perlengkapanKantor',
])->name('produk.perlengkapan_kantor');

// Detail Produk: Audio & Video
Route::get('/produk/audio_video', [
    DetailProdukController::class,
    'audioVideo',
])->name('produk.audio_video');

// Detail Produk: Laboratorium & Kesehatan
Route::get('/produk/laboratorium_kesehatan', [
    DetailProdukController::class,
    'laboratoriumKesehatan',
])->name('produk.laboratorium_kesehatan');

// Detail Produk: Kebutuhan Sehari-hari
Route::get('/produk/kebutuhan_sehari_hari', [
    DetailProdukController::class,
    'kebutuhanSehariHari',
])->name('produk.kebutuhan_sehari_hari');

// ==========================================================
// ROUTE BARU: DETAIL KATEGORI PRODUK DINAMIS
// ==========================================================

Route::get('/produk/{slug}', [
    DetailProdukController::class,
    'show',
])->name('produk.detail');

// Galeri
Route::get('/galeri', [GaleriController::class, 'index'])
    ->name('galeri');

// Kontak
// Route ini menjadi tujuan tombol CTA Hubungi Kami.
Route::get('/kontak', [KontakController::class, 'index'])
    ->name('kontak');

// Pengiriman pesan melalui formulir Kontak
Route::post('/kontak/pesan', [
    ContactMessageSubmissionController::class,
    'store',
])->name('contact-messages.store');

// ==========================================================
// DASHBOARD DAN PROFILE
// ==========================================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'admin'])
    ->name('dashboard');

Route::view('/profile', 'profile')
    ->middleware('auth')
    ->name('profile');

// ==========================================================
// AUTHENTICATION
// ==========================================================

require __DIR__.'/auth.php';

// ==========================================================
// LOGOUT
// ==========================================================

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->middleware('auth')->name('logout');

// ==========================================================
// CMS ADMIN
// ==========================================================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // --------------------------------------------------
        // CMS BERANDA: HERO
        // --------------------------------------------------

        Route::get('/homepage-hero', [
            HomepageHeroController::class,
            'edit',
        ])->name('homepage-hero.edit');

        Route::put('/homepage-hero', [
            HomepageHeroController::class,
            'update',
        ])->name('homepage-hero.update');

        // --------------------------------------------------
        // CMS BERANDA: TENTANG KAMI
        // --------------------------------------------------

        Route::get('/homepage-about', [
            HomepageAboutController::class,
            'edit',
        ])->name('homepage-about.edit');

        Route::put('/homepage-about', [
            HomepageAboutController::class,
            'update',
        ])->name('homepage-about.update');

        // --------------------------------------------------
        // CMS BERANDA: KATEGORI PRODUK
        // --------------------------------------------------

        Route::resource(
            'product-categories',
            ProductCategoryController::class
        )->except(['show']);

        // --------------------------------------------------
        // CMS BERANDA: LAYANAN
        // --------------------------------------------------

        Route::resource(
            'homepage-services',
            HomepageServiceController::class
        )->except(['show'])
            ->parameters([
                'homepage-services' => 'homepageService',
            ]);

        // --------------------------------------------------
        // CMS BERANDA: GALERI
        // --------------------------------------------------

        Route::resource(
            'homepage-galeris',
            HomepageGaleriController::class
        )->except(['show'])
            ->parameters([
                'homepage-galeris' => 'homepageGaleri',
            ]);

        // --------------------------------------------------
        // CMS BERANDA: KONTAK / CTA
        // --------------------------------------------------

        Route::get('/homepage-kontak', [
            HomepageKontakController::class,
            'edit',
        ])->name('homepage-kontak.edit');

        Route::put('/homepage-kontak', [
            HomepageKontakController::class,
            'update',
        ])->name('homepage-kontak.update');

        // --------------------------------------------------
        // CMS FOOTER
        // --------------------------------------------------

        Route::get('/homepage-footer', [
            HomepageFooterController::class,
            'edit',
        ])->name('homepage-footer.edit');

        Route::put('/homepage-footer', [
            HomepageFooterController::class,
            'update',
        ])->name('homepage-footer.update');

        // --------------------------------------------------
        // CMS HALAMAN TENTANG KAMI
        // --------------------------------------------------

        Route::get('/about-page', [
            AboutPageController::class,
            'edit',
        ])->name('about-page.edit');

        Route::put('/about-page', [
            AboutPageController::class,
            'update',
        ])->name('about-page.update');

        Route::get('/about-page/section/{section}', [
            AboutPageController::class,
            'editSection',
        ])->where(
            'section',
            'hero|profil|informasi|visi-misi|cta'
        )->name('about-page.section.edit');

        Route::put('/about-page/section/{section}', [
            AboutPageController::class,
            'updateSection',
        ])->where(
            'section',
            'hero|profil|informasi|visi-misi|cta'
        )->name('about-page.section.update');

        // --------------------------------------------------
        // CMS PRODUK & LAYANAN: HERO
        // --------------------------------------------------

        Route::get('/produk-layanan/hero', [
            ProdukLayananController::class,
            'editHero',
        ])->name('produk-layanan.hero.edit');

        Route::put('/produk-layanan/hero', [
            ProdukLayananController::class,
            'updateHero',
        ])->name('produk-layanan.hero.update');

        // --------------------------------------------------
        // CMS PRODUK & LAYANAN: KATEGORI PRODUK
        // --------------------------------------------------

        Route::prefix('produk-layanan/kategori')
            ->name('produk-layanan.categories.')
            ->controller(ProdukLayananController::class)
            ->group(function () {

                Route::get('/', 'indexCategories')
                    ->name('index');

                Route::get('/create', 'createCategory')
                    ->name('create');

                Route::post('/', 'storeCategory')
                    ->name('store');

                Route::get('/{category}/edit', 'editCategory')
                    ->name('edit');

                Route::put('/{category}', 'updateCategory')
                    ->name('update');

                Route::delete('/{category}', 'destroyCategory')
                    ->name('destroy');
            });

        // Detail kategori produk
        Route::get(
            '/produk-layanan/category-details/{category}',
            [ProdukLayananCategoryDetailController::class, 'edit']
        )->name('produk-layanan.category-details.edit');

        Route::put(
            '/produk-layanan/category-details/{category}',
            [ProdukLayananCategoryDetailController::class, 'update']
        )->name('produk-layanan.category-details.update');

        // --------------------------------------------------
        // CMS PRODUK & LAYANAN: LAYANAN KAMI
        // --------------------------------------------------

        Route::get('/produk-layanan/layanan', [
            ProdukLayananController::class,
            'editLayanan',
        ])->name('produk-layanan.layanan.edit');

        Route::put('/produk-layanan/layanan', [
            ProdukLayananController::class,
            'updateLayanan',
        ])->name('produk-layanan.layanan.update');

        // CRUD kartu layanan
        Route::prefix('produk-layanan/layanan-items')
            ->name('produk-layanan.layanan-items.')
            ->controller(ProdukLayananServiceItemController::class)
            ->group(function () {

                Route::get('/', 'index')
                    ->name('index');

                Route::get('/create', 'create')
                    ->name('create');

                Route::post('/', 'store')
                    ->name('store');

                Route::get('/{item}/edit', 'edit')
                    ->name('edit');

                Route::put('/{item}', 'update')
                    ->name('update');

                Route::delete('/{item}', 'destroy')
                    ->name('destroy');
            });

        // --------------------------------------------------
        // CMS PRODUK & LAYANAN: CTA
        // --------------------------------------------------

        Route::get('/produk-layanan/cta', [
            ProdukLayananCtaController::class,
            'edit',
        ])->name('produk-layanan.cta.edit');

        Route::put('/produk-layanan/cta', [
            ProdukLayananCtaController::class,
            'update',
        ])->name('produk-layanan.cta.update');

        // --------------------------------------------------
        // CMS GALERI: KOLEKSI DAN HERO
        // --------------------------------------------------

        Route::put('/public-galeri-koleksi', [
            PublicGaleriHeroController::class,
            'updateKoleksi',
        ])->name('public-galeri-koleksi.update');

        Route::get('/public-galeri-heroes/edit', [
            PublicGaleriHeroController::class,
            'edit',
        ])->name('public-galeri-heroes.edit');

        Route::put('/public-galeri-heroes', [
            PublicGaleriHeroController::class,
            'update',
        ])->name('public-galeri-heroes.update');

        // --------------------------------------------------
        // CMS GALERI: FOTO GALERI
        // --------------------------------------------------

        Route::resource(
            'public-galeri-items',
            PublicGaleriItemController::class
        )->except(['show'])
            ->parameters([
                'public-galeri-items' => 'publicGaleriItem',
            ]);

        // --------------------------------------------------
        // CMS KONTAK
        // --------------------------------------------------

        Route::get('/contact-page/section/{section}', [
            ContactPageController::class,
            'editSection',
        ])->where(
            'section',
            'hero|informasi|formulir|lokasi|cta'
        )->name('contact-page.section.edit');

        Route::put('/contact-page/section/{section}', [
            ContactPageController::class,
            'updateSection',
        ])->where(
            'section',
            'hero|informasi|formulir|lokasi|cta'
        )->name('contact-page.section.update');

        // --------------------------------------------------
        // PESAN MASUK
        // --------------------------------------------------

        Route::get('/email-templates', [EmailTemplateController::class, 'index'])
            ->name('email-templates.index');

        Route::get('/email-templates/{emailTemplate}/edit', [EmailTemplateController::class, 'edit'])
            ->name('email-templates.edit');

        Route::put('/email-templates/{emailTemplate}', [EmailTemplateController::class, 'update'])
            ->name('email-templates.update');

        Route::post('/email-templates/preview', [EmailTemplateController::class, 'preview'])
            ->name('email-templates.preview');

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

        // --------------------------------------------------
        // RIWAYAT AKTIVITAS
        // --------------------------------------------------

        Route::get('/activity-logs', [
            AdminActivityLogController::class,
            'index',
        ])->name('activity-logs.index');
    });
