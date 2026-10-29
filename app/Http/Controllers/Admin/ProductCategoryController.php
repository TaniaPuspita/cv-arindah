<?php //HALAMAN CARD KATEGORI PRODUK

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
    /**
     * Menampilkan daftar kategori produk.
     */
    public function index()
    {
        $categories = ProductCategory::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view(
            'admin.product-categories.index',
            compact('categories')
        );
    }

    /**
     * Menampilkan formulir tambah kategori.
     */
    public function create()
    {
        return view('admin.product-categories.create');
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                'unique:product_categories,name',
            ],
            'description' => ['required', 'string'],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['image'] = $request->file('image')
            ->store('product-categories', 'public');

        ProductCategory::create($validated);

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir edit kategori.
     */
    public function edit(ProductCategory $productCategory)
    {
        return view(
            'admin.product-categories.edit',
            compact('productCategory')
        );
    }

    /**
     * Memperbarui kategori.
     */
    public function update(
        Request $request,
        ProductCategory $productCategory
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('product_categories', 'name')
                    ->ignore($productCategory->id),
            ],
            'description' => ['required', 'string'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('product-categories', 'public');

            if ($productCategory->image) {
                Storage::disk('public')->delete($productCategory->image);
            }

            $validated['image'] = $newImage;
        } else {
            unset($validated['image']);
        }

        $productCategory->update($validated);

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil diperbarui.');
    }

    /**
     * Menghapus kategori.
     */
    public function destroy(ProductCategory $productCategory)
    {
        if ($productCategory->image) {
            Storage::disk('public')->delete($productCategory->image);
        }

        $productCategory->delete();

        return redirect()
            ->route('admin.product-categories.index')
            ->with('success', 'Kategori produk berhasil dihapus.');
    }
}
