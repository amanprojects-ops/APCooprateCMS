<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\ContactInquiry;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Public AmanOS Desktop Homepage.
     */
    public function index()
    {
        $seo = [
            'title' => 'AmanOS — Windows 7 Web OS & Software Solutions | Bihar, India',
            'description' => 'AmanOS browser-based desktop environment. Custom Laravel SaaS, web applications & cybersecurity services from Bihar, India.',
            'keywords' => 'AmanOS, Laravel developer Bihar, SaaS development India, web desktop OS',
            'canonical' => url('/'),
            'og_type' => 'website',
        ];

        $settings = Setting::allKeyed();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $products = Product::where('is_active', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order')
            ->with(['screenshots' => function ($q) {
                $q->orderBy('sort_order');
            }])
            ->get();

        $posts = BlogPost::where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        // Get admin email for the login panel
        $adminEmail = User::first()?->email ?? 'admin@amanprojects.com';

        return view('welcome', compact('seo', 'settings', 'services', 'products', 'posts', 'adminEmail'));
    }

    /**
     * Handle contact form submission from AmanOS Contact Window.
     */
    public function contact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:15',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        ContactInquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? null,
            'message' => $validated['message'],
            'service_interested' => $request->input('service_interested'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'new',
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent! We will contact you soon.',
            ]);
        }

        return back()->with('success', 'Message sent! We will contact you soon.');
    }
}
