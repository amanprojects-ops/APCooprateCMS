<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Exports\TestimonialExport;
use App\Imports\TestimonialImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::withTrashed()->orderBy('sort_order')->paginate(15);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'        => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'client_company'     => 'nullable|string|max:255',
            'client_avatar'      => 'nullable|image|max:1024',
            'review'             => 'required|string',
            'rating'             => 'required|integer|min:1|max:5',
            'is_active'          => 'boolean',
            'is_featured'        => 'boolean',
            'sort_order'         => 'integer|min:0',
        ]);

        $validated['is_active']   = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('client_avatar')) {
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name'        => 'required|string|max:255',
            'client_designation' => 'nullable|string|max:255',
            'client_company'     => 'nullable|string|max:255',
            'client_avatar'      => 'nullable|image|max:1024',
            'review'             => 'required|string',
            'rating'             => 'required|integer|min:1|max:5',
            'is_active'          => 'boolean',
            'is_featured'        => 'boolean',
            'sort_order'         => 'integer|min:0',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('client_avatar')) {
            if ($testimonial->client_avatar) Storage::disk('public')->delete($testimonial->client_avatar);
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }

    public function export()
    {
        return Excel::download(new TestimonialExport, 'testimonials.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new TestimonialImport, $request->file('file'));

        return back()->with('success', 'Testimonials imported successfully.');
    }
}
