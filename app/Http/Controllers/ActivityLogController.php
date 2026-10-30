<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $activities = ActivityLog::with('user')
            ->when($request->action_type, function ($query, $action) {
                $query->where('action_type', $action);
            })
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        return view('activity-logs.index', compact('activities'));
    }
}
