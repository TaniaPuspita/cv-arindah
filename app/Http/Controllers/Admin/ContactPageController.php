<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactPageController extends Controller
{
    /**
     * Mengambil data halaman Kontak yang sudah tersimpan di database.
     */
    private function getContactPage(): ContactPage
    {
        $contactPage = ContactPage::query()->first();

        abort_if(
            !$contactPage,
            500,
            'Data halaman Kontak belum tersedia. Jalankan ContactPageSeeder terlebih dahulu.'
        );

        return $contactPage;
    }

    /**
     * Daftar bagian CMS halaman Kontak dan field yang dapat diedit.
     */
    private function sectionFields(): array
    {
        return [
            'hero' => [
                'title' => 'Hero Kontak',
                'fields' => [
                    'hero_label',
                    'hero_title',
                    'hero_description',
                    'hero_image',
                ],
            ],

            'informasi' => [
                'title' => 'Informasi Kontak',
                'fields' => [
                    'contact_section_title',
                    'contact_email',
                    'contact_phone',
                    'contact_address',
                ],
            ],

            'formulir' => [
                'title' => 'Formulir Kirim Pesan',
                'fields' => [
                    'form_label',
                    'form_title',
                    'form_description',
                    'form_button_text',
                ],
            ],

            'lokasi' => [
                'title' => 'Lokasi Kami',
                'fields' => [
                    'location_title',
                    'location_address',
                    'location_note',
                    'maps_url',
                    'location_image',
                ],
            ],

            'cta' => [
                'title' => 'CTA Kontak',
                'fields' => [
                    'cta_title',
                    'cta_description',
                    'cta_phone',
                    'cta_image',
                ],
            ],
        ];
    }

    /**
     * Menampilkan halaman edit untuk bagian CMS Kontak.
     */
    public function editSection(string $section)
    {
        $sections = $this->sectionFields();

        abort_unless(isset($sections[$section]), 404);

        $contactPage = $this->getContactPage();
        $sectionData = $sections[$section];

        return view(
            'admin.contact-page.edit-section',
            compact('contactPage', 'section', 'sectionData')
        );
    }

    /**
     * Memvalidasi dan menyimpan perubahan CMS halaman Kontak.
     */
    public function updateSection(Request $request, string $section)
    {
        $sections = $this->sectionFields();

        abort_unless(isset($sections[$section]), 404);

        $contactPage = $this->getContactPage();
        $fields = $sections[$section]['fields'];

        /*
         * VALIDASI DATA
         */

        $rules = [];

        // Field yang menggunakan teks pendek.
        $shortTextFields = [
            'hero_label',
            'hero_title',
            'contact_section_title',
            'contact_email',
            'contact_phone',
            'form_label',
            'form_title',
            'form_button_text',
            'location_title',
            'maps_url',
            'cta_title',
            'cta_phone',
        ];

        // Field yang menggunakan teks panjang.
        $longTextFields = [
            'hero_description',
            'contact_address',
            'form_description',
            'location_address',
            'location_note',
            'cta_description',
        ];

        foreach ($fields as $field) {
            if (str_ends_with($field, '_image')) {
                $rules[$field] = [
                    'nullable',
                    'image',
                    'max:5120',
                ];
            } elseif (in_array($field, $shortTextFields, true)) {
                $rules[$field] = [
                    'nullable',
                    'string',
                    'max:255',
                ];
            } elseif (in_array($field, $longTextFields, true)) {
                $rules[$field] = [
                    'nullable',
                    'string',
                    'max:5000',
                ];
            }
        }

        // Validasi khusus email.
        if (in_array('contact_email', $fields, true)) {
            $rules['contact_email'] = [
                'nullable',
                'email',
                'max:255',
            ];
        }

        // Validasi khusus URL Google Maps.
        if (in_array('maps_url', $fields, true)) {
            $rules['maps_url'] = [
                'nullable',
                'url',
                'max:2000',
            ];
        }

        $validated = $request->validate($rules);

        /*
         * PROSES UPLOAD GAMBAR
         */

        foreach ($fields as $field) {
            if (!str_ends_with($field, '_image')) {
                continue;
            }

            if ($request->hasFile($field)) {
                $oldImage = $contactPage->{$field};

                $validated[$field] = $request
                    ->file($field)
                    ->store('contact-page', 'public');

                // Hapus gambar lama setelah gambar baru tersimpan.
                if (
                    $oldImage &&
                    Storage::disk('public')->exists($oldImage)
                ) {
                    Storage::disk('public')->delete($oldImage);
                }
            } else {
                // Jangan mengubah gambar jika tidak ada file baru.
                unset($validated[$field]);
            }
        }

        /*
         * SIMPAN PERUBAHAN
         */

        $contactPage->update($validated);

        return redirect()
            ->route('admin.contact-page.section.edit', $section)
            ->with(
                'success',
                'Konten ' .
                $sections[$section]['title'] .
                ' berhasil diperbarui.'
            );
    }
}