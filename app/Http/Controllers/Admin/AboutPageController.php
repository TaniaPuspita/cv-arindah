<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    /**
     * Mengambil data halaman Tentang Kami yang sudah tersedia.
     * Data awal dikelola melalui AboutPageSeeder.
     */
    private function getAboutPage(): AboutPage
    {
        $aboutPage = AboutPage::query()->first();

        abort_if(
            !$aboutPage,
            500,
            'Data halaman Tentang Kami belum tersedia. Jalankan AboutPageSeeder terlebih dahulu.'
        );

        return $aboutPage;
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
     * Route lama tetap dipertahankan.
     */
    public function edit()
    {
        $aboutPage = $this->getAboutPage();

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

        $aboutPage = $this->getAboutPage();

        $views = [
            'hero' => 'admin.about-page.hero.edit',
            'profil' => 'admin.about-page.profil.edit',
            'informasi' => 'admin.about-page.informasi.edit',
            'visi-misi' => 'admin.about-page.visi-misi.edit',
            'cta' => 'admin.about-page.cta.edit',
        ];

        return view(
            $views[$section],
            compact('aboutPage', 'section')
        );
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

        $aboutPage = $this->getAboutPage();

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
         * Ambil field teks dari model, lalu kecualikan
         * field gambar yang diproses secara terpisah.
         */
        $textFields = array_diff(
            $aboutPage->getFillable(),
            ['hero_image', 'profile_image', 'cta_image']
        );

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
