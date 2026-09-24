<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = ActivityLog::when($request->search, function ($query, $search) {
            $query->where('nama_user', 'like', "%{$search}%")
                ->orWhere('aktivitas', 'like', "%{$search}%");
        })->latest()->paginate(15)->withQueryString();

        return view('logs.index', compact('logs'));
    }
}
