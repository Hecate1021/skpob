<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisclosureDocument;
use App\Models\DisclosureCategory; // Import the new model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DisclosureController extends Controller
{
    public function index()
    {
        // Eager load the category relationship to prevent N+1 query issues
        $documents = DisclosureDocument::with('category')->orderBy('year', 'desc')->get();

        // Fetch all dynamic categories for the dropdown menu
        $categories = DisclosureCategory::orderBy('name')->get();

        return view('admin.disclosure.index', compact('documents', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'disclosure_category_id' => 'required|exists:disclosure_categories,id', // Validates against DB
            'year' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'document' => 'required|mimes:pdf|max:5120',
        ]);

        $file = $request->file('document');
        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->move(public_path('uploads/disclosures'), $filename);

        DisclosureDocument::create([
            'title' => $request->title,
            'disclosure_category_id' => $request->disclosure_category_id, // Save the ID
            'year' => $request->year,
            'file_path' => 'uploads/disclosures/' . $filename,
        ]);

        return redirect()->route('admin.disclosure.index')
            ->with('success', 'Document uploaded successfully!');
    }

    public function edit(DisclosureDocument $disclosure)
    {
        $categories = DisclosureCategory::orderBy('name')->get();
        return view('admin.disclosure.edit', compact('disclosure', 'categories'));
    }

    public function update(Request $request, DisclosureDocument $disclosure)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'disclosure_category_id' => 'required|exists:disclosure_categories,id',
            'year' => 'required|integer|min:2020|max:' . (date('Y') + 1),
            'document' => 'nullable|mimes:pdf|max:5120',
        ]);

        $disclosure->title = $request->title;
        $disclosure->disclosure_category_id = $request->disclosure_category_id;
        $disclosure->year = $request->year;

        if ($request->hasFile('document')) {
            $oldPath = public_path($disclosure->file_path);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('document');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/disclosures'), $filename);

            $disclosure->file_path = 'uploads/disclosures/' . $filename;
        }

        $disclosure->save();

        return redirect()->route('admin.disclosure.index')
            ->with('success', 'Document updated successfully!');
    }

    public function destroy(DisclosureDocument $disclosure)
    {
        $fullPath = public_path($disclosure->file_path);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }

        $disclosure->delete();

        return redirect()->route('admin.disclosure.index')
            ->with('success', 'Document deleted successfully.');
    }
}

