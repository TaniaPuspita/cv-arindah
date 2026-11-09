<?php

namespace Database\Seeders;

use App\Models\ProdukLayananService;
use Illuminate\Database\Seeder;

class ProdukLayananServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat data awal hanya jika tabel belum memiliki data.
        // Konten CMS yang sudah ada tidak akan ditimpa.
        ProdukLayananService::firstOrCreate(
            [],
            [
                'label' => 'LAYANAN KAMI',
                'title' => 'Teknologi Informasi & Jasa Komputer',
                'description' => 'CV Arindah menyediakan layanan di bidang teknologi informasi dan jasa komputer untuk mendukung kebutuhan teknologi dan operasional pelanggan.',
                'image' => null,
                'service_1' => 'Pengadaan Perangkat Komputer & Jaringan',
                'service_2' => 'Kebutuhan Teknologi',
                'service_3' => 'Solusi Kebutuhan Usaha & Operasional',
            ]
        );
    }
}
