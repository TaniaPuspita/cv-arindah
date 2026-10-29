<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayananHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProdukLayananCategory;
use Illuminate\Support\Str;
use App\Models\ProdukLayananService;

class ProdukLayananController extends Controller
{
    /**
     * Nilai awal Hero Produk & Layanan.
     */
    private function defaultContent(): array
    {
        return [
            'label' => 'PRODUK & LAYANAN',
            'title' => 'Solusi untuk Mendukung Berbagai Kebutuhan Anda',
            'description' => 'CV Arindah menyediakan layanan yang mendukung kebutuhan pelanggan dalam memperoleh berbagai produk dan perlengkapan secara praktis, cepat, dan terpercaya.',
            'image' => null,
            'button_text' => 'Lihat Produk',
            'button_link' => '#produk',
        ];
    }

    /**
     * Menampilkan form CMS Hero.
     */
    public function editHero()
    {
        $hero = ProdukLayananHero::firstOrCreate(
            [],
            $this->defaultContent()
        );

        return view('admin.produk-layanan.hero.edit', compact('hero'));
    }

    /**
     * Menyimpan perubahan Hero.
     */
    public function updateHero(Request $request)
    {
        $hero = ProdukLayananHero::firstOrCreate(
            [],
            $this->defaultContent()
        );

        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'button_text' => 'required|string|max:100',
            'button_link' => [
                'required',
                'string',
                'max:255',
                'regex:/^\/(?!\/)|^https?:\/\/.+|^#[a-zA-Z0-9_-]+$/i',
            ],
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('produk-layanan', 'public');

            if ($newImage === false) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'image' => 'Gambar gagal disimpan. Silakan coba lagi.',
                    ]);
            }

            $oldImage = $hero->image;
            $validated['image'] = $newImage;

            if (
                $oldImage &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['image']);
        }

        $hero->fill($validated);
        $hero->save();

        return redirect()
            ->route('admin.produk-layanan.hero.edit')
            ->with('success', 'Hero Produk & Layanan berhasil diperbarui!');
    }

    
    /**
     * Menampilkan daftar kategori produk.
     */
    public function indexCategories()
    {
        $categories = ProdukLayananCategory::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view(
            'admin.produk-layanan.categories.index',
            compact('categories')
        );
    }

    /**
     * Menampilkan form tambah kategori.
     */
    public function createCategory()
    {
        return view('admin.produk-layanan.categories.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'slug' => 'required|string|max:255|alpha_dash|unique:produk_layanan_categories,slug',
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('produk-layanan/categories', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        ProdukLayananCategory::create($validated);

        return redirect()
            ->route('admin.produk-layanan.categories.index')
            ->with('success', 'Kategori produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit kategori.
     */
    public function editCategory(ProdukLayananCategory $category)
    {
        return view(
            'admin.produk-layanan.categories.edit',
            compact('category')
        );
    }

    /**
     * Memperbarui kategori.
     */
    public function updateCategory(
        Request $request,
        ProdukLayananCategory $category
    ) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'slug' => 'required|string|max:255|alpha_dash|unique:produk_layanan_categories,slug,' . $category->id,
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('produk-layanan/categories', 'public');

            if ($category->image) {
                \Illuminate\Support\Facades\Storage::disk('public')
                    ->delete($category->image);
            }

            $validated['image'] = $newImage;
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = $request->boolean('is_active');

        $category->update($validated);

        return redirect()
            ->route('admin.produk-layanan.categories.index')
            ->with('success', 'Kategori produk berhasil diperbarui!');
    }

    /**
     * Menghapus kategori.
     */
    public function destroyCategory(ProdukLayananCategory $category)
    {
        if ($category->image) {
            \Illuminate\Support\Facades\Storage::disk('public')
                ->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('admin.produk-layanan.categories.index')
            ->with('success', 'Kategori produk berhasil dihapus!');
    }

    
    /**
     * Menampilkan halaman edit section Produk, Layanan, atau CTA.
     */
    public function editSection(string $section)
    {
        abort_unless(
            in_array($section, ['produk', 'layanan', 'cta'], true),
            404
        );

        // View section yang sudah disiapkan di project.
        $views = [
            'produk' => 'admin.produk-layanan.produk.edit',
            'layanan' => 'admin.produk-layanan.layanan.edit',
            'cta' => 'admin.produk-layanan.cta.edit',
        ];

        abort_unless(view()->exists($views[$section]), 404);

        return view($views[$section], compact('section'));
    }

    /**
     * Memproses penyimpanan section.
     *
     * Implementasi penyimpanan disesuaikan setelah
     * model dan field untuk masing-masing section dipastikan.
     */
    public function updateSection(Request $request, string $section)
    {
        abort_unless(
            in_array($section, ['produk', 'layanan', 'cta'], true),
            404
        );

        return back()->with(
            'success',
            'Section valid, tetapi fungsi penyimpanannya perlu disesuaikan dengan struktur data section.'
        );
    }

    
/**
 * Menampilkan form CMS Layanan Kami.
 */
public function editLayanan()
{
    $layanan = ProdukLayananService::firstOrCreate(
        [],
        [
            'label' => 'LAYANAN KAMI',
            'title' => 'Teknologi Informasi & Jasa Komputer',
            'description' => 'CV Arindah menyediakan layanan di bidang teknologi informasi dan jasa komputer untuk mendukung kebutuhan teknologi dan operasional pelanggan.',
            'service_1' => 'Pengadaan Perangkat Komputer & Jaringan',
            'service_2' => 'Kebutuhan Teknologi',
            'service_3' => 'Solusi Kebutuhan Usaha & Operasional',
        ]
    );

    return view(
        'admin.produk-layanan.layanan.edit',
        compact('layanan')
    );
}

/**
 * Menyimpan perubahan CMS Layanan Kami.
 */
public function updateLayanan(Request $request)
{
    $layanan = ProdukLayananService::firstOrCreate(
        [],
        [
            'label' => 'LAYANAN KAMI',
            'title' => 'Teknologi Informasi & Jasa Komputer',
            'description' => 'CV Arindah menyediakan layanan di bidang teknologi informasi dan jasa komputer untuk mendukung kebutuhan teknologi dan operasional pelanggan.',
            'service_1' => 'Pengadaan Perangkat Komputer & Jaringan',
            'service_2' => 'Kebutuhan Teknologi',
            'service_3' => 'Solusi Kebutuhan Usaha & Operasional',
        ]
    );

    $validated = $request->validate([
        'label' => 'required|string|max:100',
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:3000',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        'service_1' => 'required|string|max:255',
        'service_2' => 'required|string|max:255',
        'service_3' => 'required|string|max:255',
    ]);

    if ($request->hasFile('image')) {
        $newImage = $request->file('image')
            ->store('produk-layanan', 'public');

        if (!$newImage) {
            return back()
                ->withInput()
                ->withErrors([
                    'image' => 'Gambar gagal disimpan. Silakan coba lagi.',
                ]);
        }

        $oldImage = $layanan->image;

        $validated['image'] = $newImage;

        if (
            $oldImage &&
            \Illuminate\Support\Facades\Storage::disk('public')
                ->exists($oldImage)
        ) {
            \Illuminate\Support\Facades\Storage::disk('public')
                ->delete($oldImage);
        }
    } else {
        unset($validated['image']);
    }

    $layanan->update($validated);

    return redirect()
        ->route('admin.produk-layanan.layanan.edit')
        ->with('success', 'Layanan Kami berhasil diperbarui!');
}



}
