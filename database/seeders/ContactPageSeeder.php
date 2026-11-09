<?php

namespace Database\Seeders;

use App\Models\ContactPage;
use Illuminate\Database\Seeder;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        ContactPage::firstOrCreate(
            ['id' => 1],
            [
                // Hero Kontak
                'hero_label' => 'Kontak',
                'hero_title' => 'Kami Siap Membantu Kebutuhan Anda',
                'hero_description' => 'Jangan ragu untuk menghubungi kami. Tim kami siap memberikan informasi lebih lanjut mengenai produk dan layanan yang tersedia.',

                // Informasi Kontak
                'contact_section_title' => 'Cara Menghubungi Kami',
                'contact_email' => 'cv.arindah2016@gmail.com',
                'contact_phone' => '+6285100821243',
                'contact_address' => 'Jalan Dewaratwati Nomor 23, Mengwitani, Mengwi, Badung, Bali',

                // Formulir Kirim Pesan
                'form_label' => 'Kirim Pesan',
                'form_title' => 'Kirim Pesan / Permintaan Informasi',
                'form_description' => 'Lengkapi formulir di bawah ini untuk menyampaikan pertanyaan atau kebutuhan Anda.',
                'form_button_text' => 'Kirim Pesan',

                // Lokasi Kami
                'location_title' => 'Temukan Alamat Kami',
                'location_address' => 'Jalan Dewaratwati Nomor 23, Mengwitani, Mengwi, Badung, Bali',
                'location_note' => 'Untuk saat ini, lokasi belum tersedia di Google Maps. Anda dapat mencari alamat tersebut secara manual.',
                'maps_url' => 'https://www.google.com/maps/search/?api=1&query=Jalan+Dewaratwati+Nomor+23+Mengwitani+Mengwi+Badung+Bali',

                // CTA Kontak
                'cta_title' => 'Butuh Produk atau Layanan untuk Kebutuhan Anda?',
                'cta_description' => 'Hubungi tim kami untuk mendapatkan informasi lebih lanjut mengenai produk dan layanan CV Arindah.',
                'cta_phone' => '+6285100821243',
            ]
        );
    }
}
