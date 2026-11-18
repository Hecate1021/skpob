<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('event_date', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'status' => 'required|in:upcoming,ongoing,completed',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/projects'), $filename);
            $imagePath = 'uploads/projects/' . $filename;
        }

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'status' => $request->status,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'status' => 'required|in:upcoming,ongoing,completed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $project->fill($request->only(['title', 'description', 'event_date', 'status']));

        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image_path && File::exists(public_path($project->image_path))) {
                File::delete(public_path($project->image_path));
            }

            $file = $request->file('image');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/projects'), $filename);
            $project->image_path = 'uploads/projects/' . $filename;
        }

        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image_path && File::exists(public_path($project->image_path))) {
            File::delete(public_path($project->image_path));
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }
}
