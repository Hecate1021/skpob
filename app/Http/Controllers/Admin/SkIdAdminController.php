<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SkIdRequest;
use Illuminate\Http\Request;

class SkIdAdminController extends Controller
{
    // View all SK ID requests in the admin dashboard
    public function index(Request $request)
    {
        $query = \App\Models\SkIdRequest::query();

        // 1. Search Logic
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // 2. Pagination (10 requests per page, keeping search query in URL)
        $requests = $query->latest()->paginate(10)->withQueryString();

        return view('admin.sk_ids.index', compact('requests'));
    }

    // Update the status (Approve / Reject / Mark Printed)
    public function updateStatus(Request $request, SkIdRequest $skIdRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,printed',
            'remarks' => 'nullable|string'
        ]);

        $skIdRequest->update([
            'status' => $request->status,
            'remarks' => $request->remarks
        ]);

        return back()->with('success', 'SK ID request status updated to ' . ucfirst($request->status));
    }
}

