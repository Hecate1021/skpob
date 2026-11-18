<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DisclosureCategory;
use Illuminate\Http\Request;

class DisclosureCategoryController extends Controller
{
    public function index()
    {
        $categories = DisclosureCategory::withCount('documents')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'icon' => 'required|string|max:50',
            'theme_color' => 'required|in:emerald,blue,amber,purple,red,gray',
        ]);

        DisclosureCategory::create($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'New Book Category created successfully!');
    }

    public function edit(DisclosureCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, DisclosureCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'icon' => 'required|string|max:50',
            'theme_color' => 'required|in:emerald,blue,amber,purple,red,gray',
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Book Category updated successfully!');
    }

    public function destroy(DisclosureCategory $category)
    {
        $category->delete(); // This will also cascade delete all documents inside it

        return redirect()->route('admin.categories.index')
            ->with('success', 'Book Category and all its documents deleted!');
    }
}
