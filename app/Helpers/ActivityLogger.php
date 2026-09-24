<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log(string $aktivitas): void
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id' => $user?->id,
            'nama_user' => $user?->name,
            'role' => $user?->role,
            'aktivitas' => $aktivitas,
            'ip_address' => Request::ip(),
        ]);
    }
}
