<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageGaleri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageGaleriController extends Controller
{
    public function index()
    {
        $galeris = HomepageGaleri::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.homepage-galeris.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.homepage-galeris.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:5120',
            ],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['image'] = $request->file('image')
            ->store('homepage-galeris', 'public');

        HomepageGaleri::create($validated);

        return redirect()
            ->route('admin.homepage-galeris.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(HomepageGaleri $homepageGaleri)
    {
        return view(
            'admin.homepage-galeris.edit',
            compact('homepageGaleri')
        );
    }

    public function update(
        Request $request,
        HomepageGaleri $homepageGaleri
    ) {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:5120',
            ],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:1'],
            'is_active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $oldImage = $homepageGaleri->image;

            $newImage = $request->file('image')
                ->store('homepage-galeris', 'public');

            $validated['image'] = $newImage;

            // Hapus hanya file yang dikelola oleh storage Laravel.
            if (
                $oldImage &&
                !str_starts_with($oldImage, 'images/')
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['image']);
        }

        $homepageGaleri->update($validated);

        return redirect()
            ->route('admin.homepage-galeris.index')
            ->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy(HomepageGaleri $homepageGaleri)
    {
        $image = $homepageGaleri->image;

        // Jangan hapus file lama dari public/images/.
        if (
            $image &&
            !str_starts_with($image, 'images/')
        ) {
            Storage::disk('public')->delete($image);
        }

        $homepageGaleri->delete();

        return redirect()
            ->route('admin.homepage-galeris.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
