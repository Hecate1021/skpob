<?php

namespace App\Http\Controllers;

use App\Models\DisclosureCategory;
use App\Models\User;
use App\Models\Project; // 1. Import the Project model

class LandingPageController extends Controller
{
    public function index()
    {
        $youthCount = User::where('role', 'kabataan')->count();

        // 2. Fetch the 3 most recent projects based on event date
        $projects = Project::orderBy('event_date', 'desc')->take(3)->get();

        $categories = DisclosureCategory::with(['documents' => function($query) {
            $query->orderBy('year', 'desc');
        }])->get();

        $disclosureData = [];
        foreach ($categories as $category) {
            $files = [];
            foreach ($category->documents as $doc) {
                $files[] = [
                    'year' => $doc->year,
                    'title' => $doc->title,
                    'desc' => 'Uploaded ' . $doc->created_at->format('M d, Y'),
                    'url' => asset($doc->file_path),
                ];
            }
            $disclosureData[$category->id] = $files;
        }

        // 3. Add $projects to the compact() array
        return view('landing.index', compact('categories', 'disclosureData', 'youthCount', 'projects'));
    }

    public function projects()
{
    // Fetch 9 projects per page (perfect for a 3-column grid)
    $projects = Project::orderBy('event_date', 'desc')->paginate(9);

    return view('landing.projects', compact('projects'));
}
}
