<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\HomepageHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomepageHeroController extends Controller
{
    /**
     * Menampilkan form CMS Hero.
     */
    public function edit()
    {
        $hero = HomepageHero::first();

        if (!$hero) {
            $hero = HomepageHero::create([
                'label' => 'CV ARINDAH',
                'title' => 'Solusi Produk & Kebutuhan Teknologi Bisnis Anda',
                'description' => '',
                'image' => null,
                'button_text' => 'Lihat Produk',
                'button_link' => '/produk-layanan',
            ]);
        }

        return view('admin.homepage-hero.edit', compact('hero'));
    }

    /**
     * Menyimpan perubahan konten Hero.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'button_text' => ['required', 'string', 'max:100'],
            'button_link' => [
                'required',
                'string',
                'max:255',
                'regex:/^\/(?!\/)|^https?:\/\/.+/i',
            ],
        ]);

        $hero = HomepageHero::first();

        if (!$hero) {
            $hero = new HomepageHero();
        }

        // Simpan gambar baru jika admin mengunggahnya.
        if ($request->hasFile('image')) {
            $oldImage = $hero->image;

            $newImage = $request->file('image')
                ->store('homepage', 'public');

            $validated['image'] = $newImage;

            // Hapus gambar lama setelah gambar baru berhasil disimpan.
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru.
            unset($validated['image']);
        }

        $hero->fill($validated);
        $hero->save();

        // Catat aktivitas setelah perubahan Hero berhasil disimpan.
        AdminActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()?->name ?? 'Administrator',
            'action' => 'updated',
            'model_type' => class_basename($hero),
            'model_id' => $hero->id,
            'description' => 'Memperbarui Hero Beranda',
        ]);

        return redirect()
            ->route('admin.homepage-hero.edit')
            ->with('success', 'Konten hero Beranda berhasil diperbarui!');
    }
}
