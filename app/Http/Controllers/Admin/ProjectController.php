<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectScreenshot;
use App\Exports\ProjectExport;
use App\Imports\ProjectImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::withTrashed()->orderBy('sort_order')->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|unique:projects,slug|max:255',
            'client_name'  => 'nullable|string|max:255',
            'description'  => 'required|string',
            'thumbnail'    => 'nullable|image|max:3072',
            'demo_url'     => 'nullable|url|max:255',
            'github_url'   => 'nullable|url|max:255',
            'tech_stack'   => 'nullable|array',
            'category'     => 'nullable|string|max:100',
            'is_featured'  => 'boolean',
            'is_active'    => 'boolean',
            'completed_at' => 'nullable|date',
            'sort_order'   => 'integer|min:0',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active']   = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        Project::create($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function edit(Project $project)
    {
        $project->load('screenshots');
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255|unique:projects,slug,' . $project->id,
            'client_name'  => 'nullable|string|max:255',
            'description'  => 'required|string',
            'thumbnail'    => 'nullable|image|max:3072',
            'demo_url'     => 'nullable|url|max:255',
            'github_url'   => 'nullable|url|max:255',
            'tech_stack'   => 'nullable|array',
            'category'     => 'nullable|string|max:100',
            'is_featured'  => 'boolean',
            'is_active'    => 'boolean',
            'completed_at' => 'nullable|date',
            'sort_order'   => 'integer|min:0',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) Storage::disk('public')->delete($project->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($validated);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project deleted.');
    }

    public function addScreenshot(Request $request, Project $project)
    {
        $request->validate(['image' => 'required|image|max:3072', 'caption' => 'nullable|string|max:255']);
        $path = $request->file('image')->store('projects/screenshots', 'public');
        $project->screenshots()->create([
            'image_path' => $path,
            'caption'    => $request->caption,
            'sort_order' => $project->screenshots()->max('sort_order') + 1,
        ]);
        return back()->with('success', 'Screenshot added.');
    }

    public function deleteScreenshot(ProjectScreenshot $screenshot)
    {
        Storage::disk('public')->delete($screenshot->image_path);
        $screenshot->delete();
        return back()->with('success', 'Screenshot removed.');
    }

    public function export()
    {
        return Excel::download(new ProjectExport, 'projects.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new ProjectImport, $request->file('file'));

        return back()->with('success', 'Projects imported successfully.');
    }
}
