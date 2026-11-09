<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageAboutController extends Controller
{
    /**
     * Menampilkan form CMS Tentang Kami di Beranda.
     */
    public function edit()
    {
        $about = HomepageAbout::first();

        if (!$about) {
            abort(
                500,
                'Data Tentang Kami di Beranda belum tersedia. Jalankan HomepageAboutSeeder terlebih dahulu.'
            );
        }

        return view('admin.homepage-about.edit', compact('about'));
    }

    /**
     * Menyimpan perubahan konten Tentang Kami di Beranda.
     */
    public function update(Request $request)
    {
        // Validasi data dari form CMS.
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'paragraph_one' => ['nullable', 'string', 'max:5000'],
            'paragraph_two' => ['nullable', 'string', 'max:5000'],

            // Gambar opsional, maksimal 2 MB.
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'category_one' => ['required', 'string', 'max:255'],
            'category_two' => ['required', 'string', 'max:255'],
            'category_three' => ['required', 'string', 'max:255'],
        ]);

        // Ambil data yang sudah disediakan oleh Seeder.
        $about = HomepageAbout::first();

        if (!$about) {
            abort(
                500,
                'Data Tentang Kami di Beranda belum tersedia. Jalankan HomepageAboutSeeder terlebih dahulu.'
            );
        }

        // Proses upload gambar baru jika ada.
        if ($request->hasFile('image')) {
            $oldImage = $about->image;

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

            // Hapus gambar lama hanya jika dikelola oleh storage Laravel.
            if (
                $oldImage &&
                str_starts_with($oldImage, 'homepage/') &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            // Pertahankan gambar lama jika tidak ada upload baru.
            unset($validated['image']);
        }

        // Simpan perubahan tanpa membuat data awal baru.
        $about->fill($validated);
        $about->save();

        return redirect()
            ->route('admin.homepage-about.edit')
            ->with(
                'success',
                'Konten Tentang Kami berhasil diperbarui!'
            );
    }
}
