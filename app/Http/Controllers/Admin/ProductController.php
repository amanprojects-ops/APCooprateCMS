<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductScreenshot;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withTrashed()->orderBy('sort_order')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'slug'              => 'nullable|string|unique:products,slug|max:255',
            'tagline'           => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:2048',
            'demo_url'          => 'nullable|url|max:255',
            'docs_url'          => 'nullable|url|max:255',
            'github_url'        => 'nullable|url|max:255',
            'category'          => 'nullable|string|max:100',
            'tech_stack'        => 'nullable|array',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
            'sort_order'        => 'integer|min:0',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active']   = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load('screenshots');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'tagline'           => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description'       => 'nullable|string',
            'thumbnail'         => 'nullable|image|max:2048',
            'demo_url'          => 'nullable|url|max:255',
            'docs_url'          => 'nullable|url|max:255',
            'github_url'        => 'nullable|url|max:255',
            'category'          => 'nullable|string|max:100',
            'tech_stack'        => 'nullable|array',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
            'sort_order'        => 'integer|min:0',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
        ]);

        $validated['slug']        = $validated['slug'] ?? Str::slug($validated['name']);
        $validated['is_active']   = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) Storage::disk('public')->delete($product->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted.');
    }

    /* ---------- Screenshots sub-resource ---------- */

    public function addScreenshot(Request $request, Product $product)
    {
        $request->validate([
            'image'   => 'required|image|max:3072',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('products/screenshots', 'public');
        $product->screenshots()->create([
            'image_path' => $path,
            'caption'    => $request->caption,
            'sort_order' => $product->screenshots()->max('sort_order') + 1,
        ]);

        return back()->with('success', 'Screenshot added.');
    }

    public function deleteScreenshot(ProductScreenshot $screenshot)
    {
        Storage::disk('public')->delete($screenshot->image_path);
        $screenshot->delete();
        return back()->with('success', 'Screenshot removed.');
    }

    public function export()
    {
        return Excel::download(new ProductExport, 'products.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new ProductImport, $request->file('file'));

        return back()->with('success', 'Products imported successfully.');
    }
}
