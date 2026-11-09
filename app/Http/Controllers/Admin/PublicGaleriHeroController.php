<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PublicGaleriHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicGaleriHeroController extends Controller
{
    /**
     * Mengambil data Galeri Hero yang sudah tersedia.
     * Data awal disiapkan melalui Seeder, bukan Controller.
     */
    private function getHero(): PublicGaleriHero
    {
        return PublicGaleriHero::query()->findOrFail(1);
    }

    /**
     * Menampilkan form CMS Hero Galeri.
     */
    public function edit()
    {
        $hero = $this->getHero();

        return view(
            'admin.public-galeri-heroes.edit',
            compact('hero')
        );
    }

    /**
     * Menyimpan perubahan Hero Galeri.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'hero_eyebrow' => [
                'required',
                'string',
                'max:100',
            ],
            'hero_title' => [
                'required',
                'string',
                'max:200',
            ],
            'title_highlight' => [
                'required',
                'string',
                'max:200',
            ],
            'hero_description' => [
                'nullable',
                'string',
                'max:2000',
            ],
            'hero_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,avif',
                'max:5120',
            ],
        ]);

        $hero = $this->getHero();

        if ($request->hasFile('hero_image')) {
            $newImage = $request->file('hero_image')
                ->store('public-galeri-hero', 'public');

            if (!$newImage) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'hero_image' => 'Gambar gagal disimpan. Silakan coba lagi.',
                    ]);
            }

            $oldImage = $hero->hero_image;

            $validated['hero_image'] = $newImage;

            $hero->update($validated);

            if (
                $oldImage &&
                $oldImage !== $newImage &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['hero_image']);

            $hero->update($validated);
        }

        return redirect()
            ->route('admin.public-galeri-heroes.edit')
            ->with(
                'success',
                'Hero Galeri berhasil diperbarui.'
            );
    }

    /**
     * Memperbarui konten bagian Koleksi.
     */
    public function updateKoleksi(Request $request)
    {
        $validated = $request->validate([
            'eyebrow' => [
                'required',
                'string',
                'max:100',
            ],
            'title' => [
                'required',
                'string',
                'max:200',
            ],
            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $hero = $this->getHero();

        $hero->update($validated);

        return redirect()
            ->route('admin.public-galeri-items.index')
            ->with(
                'success',
                'Konten Koleksi berhasil diperbarui.'
            );
    }
}
