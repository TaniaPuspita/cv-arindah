<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayananServiceItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdukLayananServiceItemController extends Controller
{
    /**
     * Menampilkan daftar kartu layanan.
     */
    public function index()
    {
        $items = ProdukLayananServiceItem::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view(
            'admin.produk-layanan.layanan-items.index',
            compact('items')
        );
    }

    /**
     * Menampilkan form tambah kartu.
     */
    public function create()
    {
        return view('admin.produk-layanan.layanan-items.create');
    }

    /**
     * Menyimpan kartu baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => [
                'required',
                'string',
                Rule::in([
                    'monitor',
                    'laptop',
                    'network',
                    'settings',
                    'building',
                    'briefcase',
                    'printer',
                    'wrench',
                ]),
            ],
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        ProdukLayananServiceItem::create($validated);

        return redirect()
            ->route('admin.produk-layanan.layanan-items.index')
            ->with('success', 'Kartu layanan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit kartu.
     */
    public function edit(ProdukLayananServiceItem $item)
    {
        return view(
            'admin.produk-layanan.layanan-items.edit',
            compact('item')
        );
    }

    /**
     * Memperbarui kartu.
     */
    public function update(
        Request $request,
        ProdukLayananServiceItem $item
    ) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => [
                'required',
                'string',
                Rule::in([
                    'monitor',
                    'laptop',
                    'network',
                    'settings',
                    'building',
                    'briefcase',
                    'printer',
                    'wrench',
                ]),
            ],
            'sort_order' => 'required|integer|min:1',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $item->update($validated);

        return redirect()
            ->route('admin.produk-layanan.layanan-items.index')
            ->with('success', 'Kartu layanan berhasil diperbarui!');
    }

    /**
     * Menghapus kartu.
     */
    public function destroy(ProdukLayananServiceItem $item)
    {
        $item->delete();

        return redirect()
            ->route('admin.produk-layanan.layanan-items.index')
            ->with('success', 'Kartu layanan berhasil dihapus!');
    }
}
