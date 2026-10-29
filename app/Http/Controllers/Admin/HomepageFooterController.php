<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomepageFooter;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomepageFooterController extends Controller
{
    /**
     * Menampilkan halaman CMS Footer.
     */
    public function edit()
    {
        $footer = HomepageFooter::first();

        if (!$footer) {
            $footer = HomepageFooter::create([
                'company_name' => 'CV Arindah',
                'description' => 'Menyediakan berbagai kebutuhan produk dan perlengkapan untuk mendukung kebutuhan pelanggan.',
                'tags' => ['Teknologi', 'Produk', 'Solusi'],
                'phone' => '+62 851-0082-1243',
                'email' => 'cv.arindah2016@gmail.com',
                'address' => 'Jalan Dewarawati Nomor 23, Mengwitani, Mengwi, Badung, Bali',
                'navigation' => [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'tentang', 'label' => 'Tentang Kami'],
                    ['route' => 'produk', 'label' => 'Produk & Layanan'],
                    ['route' => 'galeri', 'label' => 'Galeri'],
                    ['route' => 'kontak', 'label' => 'Kontak'],
                ],
                'copyright_text' => 'CV Arindah. All rights reserved.',
                'location_text' => 'Badung, Bali, Indonesia',
            ]);
        }

        return view('admin.homepage-footer.edit', compact('footer'));
    }

    /**
     * Menyimpan perubahan CMS Footer.
     */
    public function update(Request $request)
    {
        $footer = HomepageFooter::first();

        if (!$footer) {
            return redirect()
                ->route('admin.homepage-footer.edit')
                ->with(
                    'error',
                    'Data footer belum tersedia. Silakan buka halaman CMS Footer terlebih dahulu.'
                );
        }

        // Validasi data form.
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'string', 'max:100'],

            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],

            'navigation' => ['required', 'array', 'size:5'],
            'navigation.*.label' => [
                'required',
                'string',
                'max:100',
            ],
            'navigation.*.route' => [
                'required',
                'in:home,tentang,produk,galeri,kontak',
            ],

            'copyright_text' => [
                'nullable',
                'string',
                'max:255',
            ],
            'location_text' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        // Rapikan tag.
        $validated['tags'] = array_values(
            array_filter(
                $validated['tags'] ?? [],
                fn ($tag) => is_string($tag) && trim($tag) !== ''
            )
        );

        // Rapikan navigasi.
        $validated['navigation'] = array_map(
            fn ($item) => [
                'route' => $item['route'],
                'label' => trim($item['label']),
            ],
            $validated['navigation']
        );

        // Upload logo baru jika ada.
        if ($request->hasFile('logo')) {
            $newLogo = $request->file('logo')
                ->store('homepage-footer', 'public');

            if ($newLogo) {
                // Hapus logo lama setelah logo baru berhasil diunggah.
                if ($footer->logo) {
                    Storage::disk('public')->delete($footer->logo);
                }

                $validated['logo'] = $newLogo;
            }
        }

        // Simpan perubahan Footer.
        $footer->fill($validated);
        $footer->save();

        // Catat aktivitas admin setelah data berhasil disimpan.
        AdminActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()?->name ?? 'Administrator',
            'action' => 'updated',
            'model_type' => class_basename($footer),
            'model_id' => $footer->id,
            'description' => 'Memperbarui Footer Website',
        ]);

        return redirect()
            ->route('admin.homepage-footer.edit')
            ->with('success', 'Data footer berhasil diperbarui!');
    }
}
