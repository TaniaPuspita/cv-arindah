<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageKontakController extends Controller
{
    /**
     * Menampilkan form CMS Kontak Beranda.
     */
    public function edit()
    {
        $kontak = HomepageKontak::first();

        if (!$kontak) {
            abort(
                500,
                'Data Kontak Beranda belum tersedia. Jalankan HomepageKontakSeeder terlebih dahulu.'
            );
        }

        return view('admin.homepage-kontak.edit', compact('kontak'));
    }

    /**
     * Memperbarui konten CMS Kontak Beranda.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'button_text' => ['required', 'string', 'max:100'],

            // Mendukung path internal, URL HTTP/HTTPS, dan mailto.
            'button_link' => [
                'required',
                'string',
                'max:2048',
                'regex:/^(?:\/(?!\/)[^\s]*|https?:\/\/[^\s]+|mailto:[^\s@]+@[^\s@]+\.[^\s@]+)$/i',
            ],

            'background_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'button_link.regex' => 'Tautan tombol harus berupa path internal seperti /kontak, URL HTTP/HTTPS, atau email dengan awalan mailto:.',
            'button_link.max' => 'Tautan tombol maksimal 2048 karakter.',
        ]);

        // Ambil data yang sudah disediakan oleh Seeder.
        if (!$kontak = HomepageKontak::first()) {
            abort(
                500,
                'Data Kontak Beranda belum tersedia. Jalankan HomepageKontakSeeder terlebih dahulu.'
            );
        }

        // Proses upload gambar latar jika ada gambar baru.
        if ($request->hasFile('background_image')) {
            $oldImage = $kontak->background_image;

            $newImage = $request->file('background_image')
                ->store('homepage', 'public');

            if (!$newImage) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'background_image' => 'Gambar gagal disimpan. Silakan coba lagi.',
                    ]);
            }

            $validated['background_image'] = $newImage;

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
            unset($validated['background_image']);
        }

        // Simpan perubahan tanpa membuat data awal baru.
        $kontak->fill($validated);
        $kontak->save();

        return redirect()
            ->route('admin.homepage-kontak.edit')
            ->with('success', 'Konten Kontak / CTA berhasil diperbarui!');
    }
}
