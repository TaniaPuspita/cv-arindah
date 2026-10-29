<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicGaleriHero;
use App\Models\PublicGaleriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PublicGaleriItemController extends Controller
{
    /**
     * Menampilkan konten Koleksi dan daftar foto.
     */
    public function index()
    {
        $hero = PublicGaleriHero::firstOrCreate(
            ['id' => 1],
            [
                'eyebrow' => 'KOLEKSI',
                'title' => 'Produk, Aktivitas & Layanan Kami',
                'description' => 'Beragam produk untuk mendukung kebutuhan teknologi, perkantoran, elektronik, dan kebutuhan lainnya.',
            ]
        );

        $items = PublicGaleriItem::query()
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.public-galeri-items.index',
            compact('hero', 'items')
        );
    }

    /**
     * Menampilkan form tambah foto.
     */
    public function create()
    {
        return view('admin.public-galeri-items.create');
    }

    /**
     * Menyimpan foto baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:150',
            ],
            'category' => [
                'required',
                Rule::in(['produk', 'jasa']),
            ],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:5120',
            ],
            'alt_text' => [
                'nullable',
                'string',
                'max:255',
            ],
            'image_position' => [
                'required',
                Rule::in([
                    'center',
                    'center top',
                    'center bottom',
                    'left center',
                    'right center',
                ]),
            ],
            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],
            'is_active' => [
                'required',
                Rule::in(['0', '1', 0, 1]),
            ],
        ]);

        $validated['image'] = $request->file('image')
            ->store('public-galeri-items', 'public');

        $validated['is_active'] = (bool) $validated['is_active'];

        PublicGaleriItem::create($validated);

        return redirect()
            ->route('admin.public-galeri-items.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit foto.
     */
    public function edit(PublicGaleriItem $publicGaleriItem)
    {
        return view('admin.public-galeri-items.edit', [
            'galeri' => $publicGaleriItem,
        ]);
    }

    /**
     * Memperbarui data foto.
     */
    public function update(
        Request $request,
        PublicGaleriItem $publicGaleriItem
    ) {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:150',
            ],
            'category' => [
                'required',
                Rule::in(['produk', 'jasa']),
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:5120',
            ],
            'alt_text' => [
                'nullable',
                'string',
                'max:255',
            ],
            'image_position' => [
                'required',
                Rule::in([
                    'center',
                    'center top',
                    'center bottom',
                    'left center',
                    'right center',
                ]),
            ],
            'sort_order' => [
                'required',
                'integer',
                'min:1',
            ],
            'is_active' => [
                'required',
                Rule::in(['0', '1', 0, 1]),
            ],
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $publicGaleriItem->image;

            $validated['image'] = $request->file('image')
                ->store('public-galeri-items', 'public');

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['image']);
        }

        $validated['is_active'] = (bool) $validated['is_active'];

        $publicGaleriItem->update($validated);

        return redirect()
            ->route('admin.public-galeri-items.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    /**
     * Menghapus foto.
     */
    public function destroy(PublicGaleriItem $publicGaleriItem)
    {
        if ($publicGaleriItem->image) {
            Storage::disk('public')->delete($publicGaleriItem->image);
        }

        $publicGaleriItem->delete();

        return redirect()
            ->route('admin.public-galeri-items.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
