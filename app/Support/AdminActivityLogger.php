<?php

namespace App\Support;

use App\Models\AdminActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminActivityLogger
{
    public static function log(
        string $action,
        string $modelType,
        ?int $modelId,
        string $description
    ): void {
        AdminActivityLog::create([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()?->name ?? 'Administrator',
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => $description,
        ]);
    }

    public static function logModel(
        string $action,
        Model $model,
        string $description
    ): void {
        self::log(
            $action,
            class_basename($model),
            $model->getKey(),
            $description
        );
    }
}
