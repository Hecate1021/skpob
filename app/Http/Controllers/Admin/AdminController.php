<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SkIdRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Calculate Metrics
        $totalYouths = User::count();
        $pendingIds = SkIdRequest::where('status', 'pending')->count();

        // 2. Calculate Demographics
        $maleCount = User::where('gender', 'Male')->count();
        $femaleCount = User::where('gender', 'Female')->count();

        // 3. Fetch Recent ID Requests (Limit to latest 5)
        $recentRequests = SkIdRequest::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalYouths',
            'pendingIds',
            'maleCount',
            'femaleCount',
            'recentRequests'
        ));
    }
}
