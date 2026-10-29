<?php

namespace App\Observers;

use App\Models\AdminActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminActivityObserver
{
    private function record(Model $model, string $action): void
    {
        $user = Auth::user();

        $labels = [
            'HomepageHero' => 'Hero Beranda',
            'HomepageAbout' => 'Tentang Kami Beranda',
            'ProductCategory' => 'Kategori Beranda',
            'HomepageService' => 'Layanan Beranda',
            'HomepageGaleri' => 'Galeri Beranda',
            'HomepageKontak' => 'Kontak Beranda',
            'AboutPage' => 'Halaman Tentang Kami',
            'ProdukLayananHero' => 'Hero Produk & Layanan',
            'ProdukLayananCategory' => 'Kategori Produk & Layanan',
            'ProdukLayananService' => 'Layanan Produk & Layanan',
            'ProdukLayananServiceItem' => 'Item Layanan',
            'ProdukLayananCta' => 'CTA Produk & Layanan',
            'PublicGaleriHero' => 'Hero Galeri',
            'PublicGaleriItem' => 'Foto Galeri',
            'ContactPage' => 'Halaman Kontak',
        ];

        $className = class_basename($model);
        $label = $labels[$className] ?? 'Konten CMS';

        $actionLabels = [
            'created' => 'Menambahkan',
            'updated' => 'Memperbarui',
            'deleted' => 'Menghapus',
        ];

        $actionText = $actionLabels[$action] ?? 'Mengubah';

        AdminActivityLog::create([
            'user_id' => $user?->id,
            'user_name' => $user?->name ?? 'Administrator',
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'description' => $actionText . ' ' . $label,
        ]);
    }

    public function created(Model $model): void
    {
        $this->record($model, 'created');
    }

    public function updated(Model $model): void
    {
        $this->record($model, 'updated');
    }

    public function deleted(Model $model): void
    {
        $this->record($model, 'deleted');
    }
}
