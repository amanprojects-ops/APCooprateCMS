<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use App\Exports\TechStackExport;
use App\Imports\TechStackImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TechStackController extends Controller
{
    public function index()
    {
        $stacks = TechStack::orderBy('sort_order')->orderBy('name')->paginate(20);
        return view('admin.tech-stacks.index', compact('stacks'));
    }

    public function create()
    {
        return view('admin.tech-stacks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|max:1024',
            'category'   => 'nullable|string|max:100',
            'is_active'  => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('tech-stacks', 'public');
        }

        TechStack::create($validated);
        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech stack added.');
    }

    public function edit(TechStack $techStack)
    {
        return view('admin.tech-stacks.edit', compact('techStack'));
    }

    public function update(Request $request, TechStack $techStack)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|max:1024',
            'category'   => 'nullable|string|max:100',
            'is_active'  => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($techStack->logo) Storage::disk('public')->delete($techStack->logo);
            $validated['logo'] = $request->file('logo')->store('tech-stacks', 'public');
        }

        $techStack->update($validated);
        return redirect()->route('admin.tech-stacks.index')->with('success', 'Tech stack updated.');
    }

    public function destroy(TechStack $techStack)
    {
        if ($techStack->logo) Storage::disk('public')->delete($techStack->logo);
        $techStack->delete();
        return back()->with('success', 'Tech stack deleted.');
    }

    public function export()
    {
        return Excel::download(new TechStackExport, 'tech_stacks.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new TechStackImport, $request->file('file'));

        return back()->with('success', 'Tech stacks imported successfully.');
    }
}
