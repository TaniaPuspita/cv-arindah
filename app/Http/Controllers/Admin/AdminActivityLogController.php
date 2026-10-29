<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminActivityLogController extends Controller
{
    /**
     * Menampilkan seluruh riwayat aktivitas admin
     * dengan pagination agar halaman tidak terlalu panjang.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $activities = AdminActivityLog::with('user')
            ->when($search, function ($query, $search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('description', 'like', "%{$search}%")
                        ->orWhere('user_name', 'like', "%{$search}%")
                        ->orWhere('model_type', 'like', "%{$search}%")
                        ->orWhere('action', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.activity-logs.index', compact(
            'activities',
            'search'
        ));
    }
}
