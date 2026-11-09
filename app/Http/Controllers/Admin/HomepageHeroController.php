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
            abort(
                500,
                'Data Hero belum tersedia. Jalankan HomepageHeroSeeder terlebih dahulu.'
            );
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

        // Ambil data Hero yang sudah disediakan oleh Seeder.
        $hero = HomepageHero::first();

        if (!$hero) {
            abort(
                500,
                'Data Hero belum tersedia. Jalankan HomepageHeroSeeder terlebih dahulu.'
            );
        }

        // Simpan gambar baru jika admin mengunggahnya.
        if ($request->hasFile('image')) {
            $oldImage = $hero->image;

            $newImage = $request->file('image')
                ->store('homepage', 'public');

            if (!$newImage) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'image' => 'Gambar gagal disimpan. Silakan coba lagi.',
                    ]);
            }

            $validated['image'] = $newImage;

            // Hapus gambar lama setelah gambar baru berhasil disimpan.
            if (
                $oldImage &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru.
            unset($validated['image']);
        }

        // Simpan perubahan konten Hero.
        $hero->fill($validated);
        $hero->save();

        // Catat aktivitas setelah perubahan berhasil disimpan.
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
