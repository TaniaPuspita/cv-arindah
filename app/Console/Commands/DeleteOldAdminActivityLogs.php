<?php

namespace App\Console\Commands;

use App\Models\AdminActivityLog;
use Illuminate\Console\Command;

class DeleteOldAdminActivityLogs extends Command
{
    protected $signature = 'activity-logs:delete-old';

    protected $description = 'Menghapus riwayat aktivitas admin yang berusia lebih dari 30 hari';

    public function handle(): int
    {
        $jumlahDihapus = AdminActivityLog::where(
            'created_at',
            '<',
            now()->subDays(30)
        )->delete();

        $this->info(
            "Berhasil menghapus {$jumlahDihapus} riwayat aktivitas admin."
        );

        return self::SUCCESS;
    }
}
