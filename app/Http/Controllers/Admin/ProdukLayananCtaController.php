<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayananCta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukLayananCtaController extends Controller
{
    public function edit()
    {
        $cta = ProdukLayananCta::first();

        return view('admin.produk-layanan.cta.edit', compact('cta'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'button_text' => ['required', 'string', 'max:100'],

            // Bisa menerima /kontak, email, mailto:, atau URL.
            'email' => [
                'required',
                'string',
                'max:2048',
                'regex:/^(?:\/(?!\/)[^\s]*|https?:\/\/[^\s]+|mailto:[^\s@]+@[^\s@]+\.[^\s@]+|[^\s@]+@[^\s@]+\.[^\s@]+)$/i',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_active' => ['required', 'boolean'],
        ], [
            'email.regex' => 'Tujuan tombol harus berupa /kontak, alamat email yang valid, atau URL HTTP/HTTPS.',
            'email.max' => 'Tujuan tombol maksimal 2048 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        $cta = ProdukLayananCta::first();

        if (!$cta) {
            $cta = new ProdukLayananCta();
            $cta->image = null;
        }

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('produk-layanan/cta', 'public');

            if (!$newImage) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'image' => 'Gambar gagal disimpan. Silakan coba lagi.',
                    ]);
            }

            $oldImage = $cta->image;
            $validated['image'] = $newImage;

            if (
                $oldImage &&
                str_starts_with($oldImage, 'produk-layanan/cta/') &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['image']);
        }

        $cta->fill($validated);
        $cta->save();

        return redirect()
            ->route('admin.produk-layanan.cta.edit')
            ->with('success', 'CTA Produk & Layanan berhasil diperbarui!');
    }
}
