<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactInquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services'          => Service::count(),
            'products'          => Product::count(),
            'projects'          => Project::count(),
            'blog_posts'        => BlogPost::count(),
            'testimonials'      => Testimonial::count(),
            'new_inquiries'     => ContactInquiry::where('status', 'new')->count(),
            'published_posts'   => BlogPost::where('is_published', true)->count(),
            'active_services'   => Service::where('is_active', true)->count(),
        ];

        $recent_inquiries = ContactInquiry::latest()->take(5)->get();
        $recent_posts     = BlogPost::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_inquiries', 'recent_posts'));
    }
}
