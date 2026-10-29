<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    /**
     * Nilai awal halaman Tentang Kami.
     */
    private function defaultContent(): array
    {
        return [
            'hero_label' => 'TENTANG KAMI',
            'hero_title_line1' => 'Mengenal',
            'hero_title_line2' => 'Lebih Dekat',
            'hero_title_line3' => 'CV Arindah',
            'hero_description' => 'Kenali lebih dekat CV Arindah, produk yang tersedia, dan layanan teknologi informasi yang kami tawarkan.',

            'profile_label' => 'Tentang Kami',
            'profile_title' => 'Mengenal CV Arindah',
            'profile_paragraph_one' => 'CV Arindah merupakan perusahaan yang menjalankan berbagai kegiatan usaha dalam bidang perdagangan barang dan teknologi informasi. Kegiatan usaha yang tersedia mencakup berbagai kategori produk, mulai dari komputer dan teknologi, elektronik dan furniture, perlengkapan kantor, audio dan video, laboratorium dan kesehatan, hingga kebutuhan sehari-hari.',
            'profile_paragraph_two' => 'Selain kegiatan perdagangan, CV Arindah juga memiliki aktivitas di bidang teknologi informasi dan jasa komputer lainnya sebagai bagian dari kegiatan usaha perusahaan',

            'info_label' => 'CV Arindah Dalam Singkat',
            'info_title' => 'Informasi Utama Kami',
            'info_one_title' => '6 Kategori Produk',
            'info_one_description' => 'Beragam kategori produk untuk memenuhi berbagai kebutuhan pelanggan.',
            'info_two_title' => 'Teknologi Informasi',
            'info_two_description' => 'Menyediakan produk komputer dan layanan yang berkaitan dengan teknologi informasi.',
            'info_three_title' => 'Berbasis di Bali',
            'info_three_description' => 'Jalan Dewaratwati Nomor 23, Mengwitani, Mengwi, Badung, Bali.',

            'vision_mission_label' => 'Visi & Misi',
            'vision_mission_title' => 'Visi dan Misi CV Arindah',
            'vision_mission_description' => 'Landasan dan arah CV Arindah dalam memberikan produk dan layanan terbaik bagi pelanggan.',
            'vision' => 'Menjadi perusahaan yang mampu memenuhi beragam kebutuhan pelanggan melalui penyediaan produk dan layanan teknologi informasi yang sesuai dengan kebutuhan.',
            'mission_description' => 'Menjalankan kegiatan usaha dengan menyediakan produk dan informasi yang sesuai dengan kebutuhan pelanggan.',
            'mission_one_title' => 'Menyediakan Beragam Produk',
            'mission_one_description' => 'Menyediakan berbagai kategori produk untuk memenuhi kebutuhan pelanggan.',
            'mission_two_title' => 'Mendukung Kebutuhan Teknologi',
            'mission_two_description' => 'Menyediakan produk komputer dan teknologi serta aktivitas teknologi informasi sesuai dengan bidang usaha perusahaan.',
            'mission_three_title' => 'Memberikan Informasi yang Jelas',
            'mission_three_description' => 'Menyediakan informasi yang membantu pelanggan mengenali produk dan layanan yang tersedia.',

            'cta_label' => 'BUTUH INFORMASI LEBIH LANJUT?',
            'cta_title' => 'Mari Terhubung dengan CV Arindah',
            'cta_description' => 'Hubungi CV Arindah untuk mendapatkan informasi mengenai produk dan layanan yang tersedia.',
            'cta_button_text' => 'Hubungi Kami',
        ];
    }

    /**
     * Daftar field yang boleh diedit pada setiap section.
     */
    private function sectionFields(): array
    {
        return [
            'hero' => [
                'hero_label',
                'hero_title_line1',
                'hero_title_line2',
                'hero_title_line3',
                'hero_description',
                'hero_image',
            ],

            'profil' => [
                'profile_label',
                'profile_title',
                'profile_paragraph_one',
                'profile_paragraph_two',
                'profile_image',
            ],

            'informasi' => [
                'info_label',
                'info_title',
                'info_one_title',
                'info_one_description',
                'info_two_title',
                'info_two_description',
                'info_three_title',
                'info_three_description',
            ],

            'visi-misi' => [
                'vision_mission_label',
                'vision_mission_title',
                'vision_mission_description',
                'vision',
                'mission_description',
                'mission_one_title',
                'mission_one_description',
                'mission_two_title',
                'mission_two_description',
                'mission_three_title',
                'mission_three_description',
            ],

            'cta' => [
                'cta_label',
                'cta_title',
                'cta_description',
                'cta_button_text',
                'cta_image',
            ],
        ];
    }

    /**
     * Memeriksa apakah section yang diminta valid.
     */
    private function validateSection(string $section): void
    {
        abort_unless(
            array_key_exists($section, $this->sectionFields()),
            404
        );
    }

    /**
     * Menampilkan halaman CMS Tentang Kami.
     *
     * Route lama tetap dipertahankan.
     */
    public function edit()
    {
        $aboutPage = AboutPage::firstOrCreate(
            [],
            $this->defaultContent()
        );

        // Route lama membuka halaman Hero sebagai halaman awal.
        $section = 'hero';

        return view(
            'admin.about-page.edit',
            compact('aboutPage', 'section')
        );
    }

    /**
     * Menampilkan halaman edit untuk section tertentu.
     */
    
    public function editSection(string $section)
    {
        $this->validateSection($section);

        $aboutPage = AboutPage::firstOrCreate(
            [],
            $this->defaultContent()
        );

        $views = [
            'hero' => 'admin.about-page.hero.edit',
            'profil' => 'admin.about-page.profil.edit',
            'informasi' => 'admin.about-page.informasi.edit',
            'visi-misi' => 'admin.about-page.visi-misi.edit',
            'cta' => 'admin.about-page.cta.edit',
        ];

        return view($views[$section], compact('aboutPage', 'section'));
    }


    /**
     * Menyimpan perubahan konten.
     *
     * Jika $section terisi, hanya field section tersebut
     * yang boleh diperbarui.
     *
     * Jika $section null, route lama tetap dapat digunakan.
     */
    public function update(
        Request $request,
        ?string $section = null
    ) {
        if ($section !== null) {
            $this->validateSection($section);
        }

        $aboutPage = AboutPage::firstOrCreate(
            [],
            $this->defaultContent()
        );

        $rules = [
            'hero_label' => 'nullable|string|max:255',
            'hero_title_line1' => 'nullable|string|max:255',
            'hero_title_line2' => 'nullable|string|max:255',
            'hero_title_line3' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'profile_label' => 'nullable|string|max:255',
            'profile_title' => 'nullable|string|max:255',
            'profile_paragraph_one' => 'nullable|string',
            'profile_paragraph_two' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'info_label' => 'nullable|string|max:255',
            'info_title' => 'nullable|string|max:255',
            'info_one_title' => 'nullable|string|max:255',
            'info_one_description' => 'nullable|string',
            'info_two_title' => 'nullable|string|max:255',
            'info_two_description' => 'nullable|string',
            'info_three_title' => 'nullable|string|max:255',
            'info_three_description' => 'nullable|string',

            'vision_mission_label' => 'nullable|string|max:255',
            'vision_mission_title' => 'nullable|string|max:255',
            'vision_mission_description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission_description' => 'nullable|string',
            'mission_one_title' => 'nullable|string|max:255',
            'mission_one_description' => 'nullable|string',
            'mission_two_title' => 'nullable|string|max:255',
            'mission_two_description' => 'nullable|string',
            'mission_three_title' => 'nullable|string|max:255',
            'mission_three_description' => 'nullable|string',

            'cta_label' => 'nullable|string|max:255',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        /*
         * Jika mengedit satu section, validasi hanya field
         * yang dimiliki section tersebut.
         */
        if ($section !== null) {
            $allowedFields = $this->sectionFields()[$section];

            $rules = array_intersect_key(
                $rules,
                array_flip($allowedFields)
            );
        }

        $validated = $request->validate($rules);

        /*
         * Simpan field teks.
         * Field gambar diproses secara terpisah.
         */
        $textFields = array_keys($this->defaultContent());

        $textData = array_intersect_key(
            $validated,
            array_flip($textFields)
        );

        $aboutPage->fill($textData);

        /*
         * Simpan gambar baru jika diunggah.
         * Gambar lama dihapus setelah gambar baru berhasil
         * disimpan.
         */
        foreach (
            ['hero_image', 'profile_image', 'cta_image']
            as $field
        ) {
            if (
                $request->hasFile($field) &&
                (
                    $section === null ||
                    in_array(
                        $field,
                        $this->sectionFields()[$section],
                        true
                    )
                )
            ) {
                $oldImage = $aboutPage->{$field};

                $newImage = $request->file($field)
                    ->store('about-page', 'public');

                if ($newImage === false) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            $field => 'Gambar gagal disimpan. Silakan coba lagi.',
                        ]);
                }

                $aboutPage->{$field} = $newImage;

                if ($oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }

        $aboutPage->save();

        /*
         * Kembali ke section yang sedang diedit.
         */
        if ($section !== null) {
            return redirect()
                ->route(
                    'admin.about-page.section.edit',
                    ['section' => $section]
                )
                ->with(
                    'success',
                    'Konten section berhasil diperbarui!'
                );
        }

        /*
         * Redirect untuk route lama.
         */
        return redirect()
            ->route('admin.about-page.edit')
            ->with(
                'success',
                'Konten halaman Tentang Kami berhasil diperbarui!'
            );
    }

    /**
     * Menyimpan perubahan dari halaman edit section.
     */
    public function updateSection(
        Request $request,
        string $section
    ) {
        $this->validateSection($section);

        return $this->update($request, $section);
    }
}
