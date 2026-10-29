<?php

namespace App\Http\Controllers\Admin;

// =========================================================
// IMPORT CONTROLLER, MODEL, REQUEST, DAN STORAGE
// =========================================================
use App\Http\Controllers\Controller;
use App\Models\HomepageAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomepageAboutController extends Controller
{
    // =====================================================
    // 1. MENAMPILKAN HALAMAN CMS TENTANG KAMI
    // =====================================================
    public function edit()
    {
        // Ambil data Tentang Kami yang sudah tersimpan
        $about = HomepageAbout::first();

        // Jika belum ada data, buat data awal
        if (!$about) {
            $about = HomepageAbout::create([
                'label' => 'TENTANG KAMI',
                'title' => 'MENGENAL CV ARINDAH',
                'paragraph_one' => 'CV Arindah bergerak dalam berbagai bidang perdagangan eceran, termasuk komputer dan perlengkapan, peralatan listrik, alat tulis, furniture, audio dan video, serta kebutuhan laboratorium dan kesehatan.',
                'paragraph_two' => 'Selain itu, CV Arindah juga memiliki aktivitas di bidang teknologi informasi dan jasa komputer lainnya.',
                'category_one' => 'Komputer & Perlengkapan',
                'category_two' => 'Elektronik & Furniture',
                'category_three' => 'Teknologi Informasi',
            ]);
        }

        // Kirim data ke halaman form CMS
        return view('admin.homepage-about.edit', compact('about'));
    }

    // =====================================================
    // 2. MENYIMPAN PERUBAHAN KONTEN TENTANG KAMI
    // =====================================================
    public function update(Request $request)
    {
        // Validasi data dari form CMS
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'paragraph_one' => ['nullable', 'string', 'max:5000'],
            'paragraph_two' => ['nullable', 'string', 'max:5000'],

            // Gambar opsional, maksimal 2 MB
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

        // Ambil data yang akan diperbarui
        $about = HomepageAbout::first();

        // Siapkan data baru jika belum ada
        if (!$about) {
            $about = new HomepageAbout();
        }

        // ================================================
        // 3. MENGELOLA UPLOAD GAMBAR
        // ================================================
        if ($request->hasFile('image')) {
            // Simpan lokasi gambar lama
            $oldImage = $about->image;

            // Simpan gambar baru ke storage/app/public/homepage
            $newImage = $request->file('image')
                ->store('homepage', 'public');

            // Simpan lokasi gambar baru ke database
            $validated['image'] = $newImage;

            // Hapus gambar lama setelah gambar baru tersimpan
            if (
                $oldImage &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            // Pertahankan gambar lama jika tidak mengganti gambar
            unset($validated['image']);
        }

        // ================================================
        // 4. SIMPAN DATA KE DATABASE
        // ================================================
        $about->fill($validated);
        $about->save();

        // Kembali ke form dengan pesan berhasil
        return redirect()
            ->route('admin.homepage-about.edit')
            ->with(
                'success',
                'Konten Tentang Kami berhasil diperbarui!'
            );
    }
}