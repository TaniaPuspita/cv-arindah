<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\ProdukLayananCategory;
use App\Models\ProdukLayananCategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukLayananCategoryDetailController extends Controller
{
    /**
     * Menampilkan halaman CMS detail kategori.
     */
    public function edit(ProdukLayananCategory $category)
    {
        $categories = ProdukLayananCategory::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $detail = $category->detail;

        return view('admin.produk-layanan.category-details.edit', [
            'categories' => $categories,
            'category' => $category,
            'detail' => $detail,
        ]);
    }

    /**
     * Menyimpan perubahan detail kategori.
     */
    public function update(Request $request, ProdukLayananCategory $category)
    {
        $validated = $request->validate([
            // HERO
            'hero_label' => 'nullable|string|max:255',
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string|max:5000',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // TENTANG KATEGORI
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string|max:5000',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'about_highlight_1_title' => 'nullable|string|max:255',
            'about_highlight_1_description' => 'nullable|string|max:2000',

            'about_highlight_2_title' => 'nullable|string|max:255',
            'about_highlight_2_description' => 'nullable|string|max:2000',

            // KEUNGGULAN
            'advantages_title' => 'nullable|string|max:255',
            'advantages_description' => 'nullable|string|max:5000',

            'advantage_1_title' => 'nullable|string|max:255',
            'advantage_1_description' => 'nullable|string|max:2000',
            'advantage_1_icon' => 'nullable|string|max:100',

            'advantage_2_title' => 'nullable|string|max:255',
            'advantage_2_description' => 'nullable|string|max:2000',
            'advantage_2_icon' => 'nullable|string|max:100',

            'advantage_3_title' => 'nullable|string|max:255',
            'advantage_3_description' => 'nullable|string|max:2000',
            'advantage_3_icon' => 'nullable|string|max:100',

            // CTA
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string|max:5000',
            'cta_button_text' => 'nullable|string|max:100',

            'cta_button_link' => [
                'nullable',
                'string',
                'max:2048',
                'regex:/^(?:(?:https?:\/\/[^\s]+)|\/(?!\/)[^\s]*|#[a-zA-Z0-9_-]+|mailto:[^\s@]+@[^\s@]+\.[^\s@]+|tel:\+?[0-9][0-9\s().-]*)$/i',
            ],

            'cta_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'cta_button_link.regex' => 'Link tombol CTA harus berupa URL, tautan relatif, anchor, email (mailto:), atau nomor telepon (tel:) yang valid.',
            'cta_button_link.max' => 'Link tombol CTA maksimal 2048 karakter.',
            'hero_image.image' => 'File hero harus berupa gambar.',
            'about_image.image' => 'File gambar tentang kategori harus berupa gambar.',
            'cta_image.image' => 'File gambar CTA harus berupa gambar.',
        ]);

        // Ambil detail kategori yang sudah ada atau buat baru.
        $detail = $category->detail;

        if (!$detail) {
            $detail = new ProdukLayananCategoryDetail();
            $detail->produk_layanan_category_id = $category->id;
        }

        // Daftar gambar yang bisa diperbarui lewat CMS.
        $imageFields = [
            'hero_image',
            'about_image',
            'cta_image',
        ];

        $oldImages = [];
        $newImages = [];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $path = $request->file($field)
                    ->store('produk-layanan/details', 'public');

                if (!$path) {
                    // Hapus upload baru jika ada gambar yang gagal disimpan.
                    foreach ($newImages as $newImage) {
                        Storage::disk('public')->delete($newImage);
                    }

                    return back()
                        ->withInput()
                        ->withErrors([
                            $field => 'Gambar gagal disimpan. Silakan coba lagi.',
                        ]);
                }

                $newImages[] = $path;

                if ($detail->{$field}) {
                    $oldImages[] = $detail->{$field};
                }

                $validated[$field] = $path;
            } else {
                // Pertahankan gambar lama jika tidak ada upload baru.
                unset($validated[$field]);
            }
        }

        // Simpan data teks dan gambar.
        $detail->fill($validated);
        $detail->save();

        // Catat aktivitas admin setelah data berhasil disimpan.
        AdminActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()?->name ?? 'Administrator',
            'action' => 'updated',
            'model_type' => class_basename($detail),
            'model_id' => $detail->id,
            'description' => 'Memperbarui Detail Kategori Produk: '
                . $category->name,
        ]);

        // Hapus gambar lama setelah data berhasil disimpan.
        foreach ($oldImages as $oldImage) {
            if (
                is_string($oldImage)
                && str_starts_with($oldImage, 'produk-layanan/details/')
                && Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        return redirect()
            ->route(
                'admin.produk-layanan.category-details.edit',
                $category
            )
            ->with('success', 'Detail kategori berhasil diperbarui!');
    }
}
