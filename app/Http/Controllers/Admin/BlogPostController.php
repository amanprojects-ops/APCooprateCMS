<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Exports\BlogPostExport;
use App\Imports\BlogPostImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::withTrashed()->latest()->paginate(15);
        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog-posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|unique:blog_posts,slug|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|max:3072',
            'category'         => 'nullable|string|max:100',
            'tags'             => 'nullable|string',
            'is_published'     => 'boolean',
            'is_featured'      => 'boolean',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $validated['slug']         = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['tags']         = $validated['tags']
            ? array_map('trim', explode(',', $validated['tags']))
            : null;

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('blog', 'public');
        }

        BlogPost::create($validated);
        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog-posts.edit', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:blog_posts,slug,' . $blogPost->id,
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'thumbnail'        => 'nullable|image|max:3072',
            'category'         => 'nullable|string|max:100',
            'tags'             => 'nullable|string',
            'is_published'     => 'boolean',
            'is_featured'      => 'boolean',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $validated['slug']         = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published');
        $validated['is_featured']  = $request->boolean('is_featured');
        $validated['tags']         = $validated['tags']
            ? array_map('trim', explode(',', $validated['tags']))
            : null;

        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = $blogPost->published_at ?? now();
        }

        if ($request->hasFile('thumbnail')) {
            if ($blogPost->thumbnail) Storage::disk('public')->delete($blogPost->thumbnail);
            $validated['thumbnail'] = $request->file('thumbnail')->store('blog', 'public');
        }

        $blogPost->update($validated);
        return redirect()->route('admin.blog-posts.index')->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return back()->with('success', 'Blog post deleted.');
    }

    public function export()
    {
        return Excel::download(new BlogPostExport, 'blog_posts.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|extensions:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new BlogPostImport, $request->file('file'));

        return back()->with('success', 'Blog posts imported successfully.');
    }
}
