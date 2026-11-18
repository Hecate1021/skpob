<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class YouthRegistryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Optional: If you have an admin role column (like 'is_admin' or 'role'),
        // you can exclude admins from this list. For example:
        // $query->where('role', 'user');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%");
            });
        }

        // Fetch users, 10 per page
        $youths = $query->latest()->paginate(10)->withQueryString();

        return view('admin.youth.index', compact('youths'));
    }
}
