<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SkIdRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkIdController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_number' => 'required|string|max:20',
            'emergency_contact_address' => 'required|string|max:255',
            'id_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('id_photo');
        $filename = time() . '_id_' . Auth::id() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/sk_ids/photos'), $filename);
        $photoPath = 'uploads/sk_ids/photos/' . $filename;

        // Auto-fills personal data from the User table into the ID Request
        $user = Auth::user();

        SkIdRequest::create([
            'user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'dob' => $user->dob,
            'gender' => $user->gender,
            'address' => $user->address,
            'contact_number' => $user->contact_number,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_number' => $request->emergency_contact_number,
            'emergency_contact_address' => $request->emergency_contact_address,
            'id_photo_path' => $photoPath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'SK ID application submitted successfully!');
    }

    public function requestReplacement(Request $request)
{
    $existingId = SkIdRequest::where('user_id', Auth::id())
        ->whereIn('status', ['approved', 'printed'])
        ->latest()
        ->first();

    if ($existingId) {
        // Revert status to pending and flag it as a replacement for the admin
        $existingId->update([
            'status' => 'pending',
            'remarks' => 'LOST ID REPLACEMENT REQUESTED'
        ]);

        return back()->with('success', 'Your replacement request has been submitted to the admin.');
    }

    return back()->with('error', 'No active SK ID found to replace.');
}

public function update(Request $request)
{
    $skId = SkIdRequest::where('user_id', Auth::id())->latest()->first();

    if (!$skId) {
        return back()->with('error', 'No active SK ID application found to update.');
    }

    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'dob' => 'required|date|before:today',
        'gender' => 'required|in:Male,Female',
        'address' => 'required|string',
        'contact_number' => 'required|string|max:20',
        'emergency_contact_name' => 'required|string|max:255',
        'emergency_contact_number' => 'required|string|max:20',
        'id_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Optional during update
        'emergency_contact_address' => 'required|string|max:255',
    ]);

    // Handle new photo upload if provided
    if ($request->hasFile('id_photo')) {
        $file = $request->file('id_photo');
        $filename = time() . '_id_' . Auth::id() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/sk_ids/photos'), $filename);
        $skId->id_photo_path = 'uploads/sk_ids/photos/' . $filename;
    }

    // Update other fields
    $skId->fill($request->except(['id_photo']));

    // SECURITY: If the ID was already approved or printed, changing details requires re-approval
    if (in_array($skId->status, ['approved', 'printed']) && $skId->isDirty()) {
        $skId->status = 'pending';
        $skId->remarks = 'User updated their details. Requires re-verification.';
    }

    $skId->save();

    return back()->with('success', 'SK ID details updated successfully.');
}
}
