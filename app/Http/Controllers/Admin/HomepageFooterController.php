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
     * Mengambil data Footer yang sudah tersedia di database.
     */
    private function getFooter(): HomepageFooter
    {
        $footer = HomepageFooter::query()->first();

        abort_if(
            !$footer,
            500,
            'Data footer belum tersedia. Jalankan HomepageFooterSeeder terlebih dahulu.'
        );

        return $footer;
    }

    /**
     * Menampilkan halaman CMS Footer.
     */
    public function edit()
    {
        $footer = $this->getFooter();

        return view('admin.homepage-footer.edit', compact('footer'));
    }

    /**
     * Menyimpan perubahan CMS Footer.
     */
    public function update(Request $request)
    {
        $footer = $this->getFooter();

        // Validasi data form.
        $validated = $request->validate([
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'tags' => [
                'nullable',
                'array',
            ],
            'tags.*' => [
                'nullable',
                'string',
                'max:100',
            ],
            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'address' => [
                'nullable',
                'string',
            ],
            'navigation' => [
                'required',
                'array',
                'size:5',
            ],
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

        // Simpan logo baru jika ada.
        $oldLogo = $footer->logo;
        $newLogo = null;

        if ($request->hasFile('logo')) {
            $newLogo = $request->file('logo')
                ->store('homepage-footer', 'public');

            if ($newLogo === false) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'logo' => 'Logo gagal diunggah. Silakan coba lagi.',
                    ]);
            }

            $validated['logo'] = $newLogo;
        }

        // Simpan perubahan Footer.
        $footer->fill($validated);
        $footer->save();

        // Hapus logo lama setelah logo baru berhasil disimpan.
        if (
            $newLogo !== null &&
            $oldLogo &&
            $oldLogo !== $newLogo
        ) {
            Storage::disk('public')->delete($oldLogo);
        }

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
