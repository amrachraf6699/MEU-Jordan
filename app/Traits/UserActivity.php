<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait UserActivity
{
    public function MakeActivity($activity ,Request $request)
    {
        \App\Models\UserActivity::create(
            [
                'user_id' => auth()->id(),
                'activity' => $activity,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]
        );
    }
}
