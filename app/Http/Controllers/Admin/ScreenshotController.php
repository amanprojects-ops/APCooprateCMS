<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProductScreenshot;
use App\Models\ProjectScreenshot;
use App\Exports\ScreenshotExport;
use App\Imports\ScreenshotImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ScreenshotController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $projects = Project::orderBy('title')->get();
        
        $productScreenshots = ProductScreenshot::with('product')->get();
        $projectScreenshots = ProjectScreenshot::with('project')->get();

        return view('admin.screenshots.index', compact('products', 'projects', 'productScreenshots', 'projectScreenshots'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'target_type' => 'required|in:product,project',
            'target_id'   => 'required|integer',
            'image'       => 'required|image|max:3072',
            'caption'     => 'nullable|string|max:255',
        ]);

        if ($request->target_type === 'product') {
            $product = Product::findOrFail($request->target_id);
            $path = $request->file('image')->store('products/screenshots', 'public');
            $product->screenshots()->create([
                'image_path' => $path,
                'caption'    => $request->caption,
                'sort_order' => $product->screenshots()->max('sort_order') + 1,
            ]);
        } else {
            $project = Project::findOrFail($request->target_id);
            $path = $request->file('image')->store('projects/screenshots', 'public');
            $project->screenshots()->create([
                'image_path' => $path,
                'caption'    => $request->caption,
                'sort_order' => $project->screenshots()->max('sort_order') + 1,
            ]);
        }

        return back()->with('success', 'Screenshot uploaded successfully.');
    }

    public function export()
    {
        return Excel::download(new ScreenshotExport, 'screenshots.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new ScreenshotImport, $request->file('file'));

        return back()->with('success', 'Screenshots imported successfully.');
    }
}
