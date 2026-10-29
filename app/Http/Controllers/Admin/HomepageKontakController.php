<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageKontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class HomepageKontakController extends Controller
{
    public function edit()
    {
        $kontak = HomepageKontak::firstOrCreate(
            ['id' => 1],
            [
                'label' => 'KONTAK',
                'title' => 'Mari Terhubung dengan CV Arindah',
                'description' => 'Punya kebutuhan produk atau layanan? Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai kebutuhan Anda.',
                'button_text' => 'Hubungi Kami',
                'button_link' => 'mailto:cv.arindah2016@gmail.com',
                'background_image' => 'images/cta_beranda.jpg',
            ]
        );

        return view('admin.homepage-kontak.edit', compact('kontak'));
    }

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

        $kontak = HomepageKontak::firstOrCreate(
            ['id' => 1],
            [
                'label' => 'KONTAK',
                'title' => 'Mari Terhubung dengan CV Arindah',
                'description' => 'Punya kebutuhan produk atau layanan? Hubungi kami untuk mendapatkan informasi lebih lanjut mengenai kebutuhan Anda.',
                'button_text' => 'Hubungi Kami',
                'button_link' => 'mailto:cv.arindah2016@gmail.com',
                'background_image' => 'images/cta_beranda.jpg',
            ]
        );

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

            if (
                $oldImage &&
                str_starts_with($oldImage, 'homepage/') &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['background_image']);
        }

        $kontak->fill($validated);
        $kontak->save();

        return redirect()
            ->route('admin.homepage-kontak.edit')
            ->with('success', 'Konten Kontak / CTA berhasil diperbarui!');
    }
}
