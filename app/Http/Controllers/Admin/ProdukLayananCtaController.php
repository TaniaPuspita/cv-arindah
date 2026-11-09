<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProdukLayananCta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukLayananCtaController extends Controller
{
    /**
     * Mengambil data CTA yang sudah tersedia di database.
     * Tidak membuat record baru secara otomatis.
     */
    private function getCta(): ProdukLayananCta
    {
        $cta = ProdukLayananCta::query()->first();

        abort_if(
            !$cta,
            500,
            'Data CTA Produk & Layanan belum tersedia. Jalankan ProdukLayananCtaSeeder terlebih dahulu.'
        );

        return $cta;
    }

    /**
     * Menampilkan halaman edit CTA.
     */
    public function edit()
    {
        $cta = $this->getCta();

        return view(
            'admin.produk-layanan.cta.edit',
            compact('cta')
        );
    }

    /**
     * Memperbarui data CTA.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'button_text' => [
                'required',
                'string',
                'max:100',
            ],

            // Mendukung path internal, email, mailto:, dan URL HTTP/HTTPS.
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

            'is_active' => [
                'required',
                'boolean',
            ],
        ], [
            'email.regex' => 'Tujuan tombol harus berupa /kontak, alamat email yang valid, atau URL HTTP/HTTPS.',
            'email.max' => 'Tujuan tombol maksimal 2048 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ]);

        // Mengambil data yang sudah ada, bukan membuat record baru.
        $cta = $this->getCta();

        $oldImage = $cta->image;
        $newImage = null;

        // Jika pengguna mengunggah gambar baru.
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

            $validated['image'] = $newImage;
        } else {
            // Jika tidak ada gambar baru, pertahankan gambar lama.
            unset($validated['image']);
        }

        // Simpan perubahan data CTA.
        $cta->fill($validated);
        $cta->save();

        // Hapus gambar lama setelah data berhasil disimpan.
        if (
            $newImage &&
            $oldImage &&
            $oldImage !== $newImage &&
            str_starts_with($oldImage, 'produk-layanan/cta/') &&
            Storage::disk('public')->exists($oldImage)
        ) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.produk-layanan.cta.edit')
            ->with(
                'success',
                'CTA Produk & Layanan berhasil diperbarui!'
            );
    }
}
