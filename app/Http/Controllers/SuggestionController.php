<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    // Saves the suggestion from the landing page
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'suggestion' => 'required|string',
        ]);

        Suggestion::create([
            'name' => $request->name ?? 'Anonymous Youth',
            'suggestion' => $request->suggestion,
        ]);

        return back()->with('success', 'Thank you! Your idea has been submitted to the SK Council.');
    }

    // Displays the suggestions in the Admin Dashboard
    public function index()
    {
        $suggestions = Suggestion::latest()->paginate(10);
        return view('admin.suggestions.index', compact('suggestions'));
    }
}
