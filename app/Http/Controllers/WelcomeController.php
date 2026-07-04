<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Product;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\PricingPlan;
use App\Models\BlogPost;
use App\Models\TechStack;
use App\Models\Stat;
use App\Models\Faq;
use App\Models\ContactInquiry;
use App\Models\Feature;
use App\Models\ProcessStep;

class WelcomeController extends Controller
{
    /**
     * Homepage — loads ALL dynamic sections from DB.
     * SEO array kept from map.md (Part 5 of map.md).
     */
    public function index()
    {
        // SEO (map.md Part 5)
        $seo = [
            'title'       => 'AmanProjects — Laravel SaaS Development & Cybersecurity | Bihar, India',
            'description' => 'Custom Laravel SaaS, corporate websites & ethical hacking services from Bihar, India. Security-first software development for Indian startups & SMBs.',
            'keywords'    => 'Laravel developer Bihar, SaaS development India, ethical hacker India, web development Bihar, cybersecurity Bihar, AP Coaching software, AP Library SaaS',
            'og_image'    => asset('assets/images/og-cover.png'),
            'canonical'   => url('/'),
            'og_type'     => 'website',
        ];

        // Settings — from DB (map2.md Step 1)
        $settings = Setting::allKeyed();

        // Stats bar
        $stats = Stat::where('is_active', true)
                     ->orderBy('sort_order')
                     ->get();

        // Services section
        $services = Service::where('is_active', true)
                           ->orderBy('sort_order')
                           ->get();

        // Products showcase (featured first, with screenshots eager loaded)
        $products = Product::where('is_active', true)
                           ->orderBy('is_featured', 'desc')
                           ->orderBy('sort_order')
                           ->with(['screenshots' => function ($q) {
                               $q->orderBy('sort_order');
                           }])
                           ->get();

        // Projects / Portfolio (featured only)
        $projects = Project::where('is_active', true)
                           ->where('is_featured', true)
                           ->orderBy('sort_order')
                           ->with(['screenshots' => function ($q) {
                               $q->orderBy('sort_order');
                           }])
                           ->get();

        // Testimonials (featured first)
        $testimonials = Testimonial::where('is_active', true)
                                   ->orderBy('is_featured', 'desc')
                                   ->orderBy('sort_order')
                                   ->get();

        // Pricing plans (with features eager loaded)
        $plans = PricingPlan::where('is_active', true)
                            ->orderBy('sort_order')
                            ->with(['features' => function ($q) {
                                $q->orderBy('sort_order');
                            }])
                            ->get();

        // Blog / CodeBB preview (latest 3 published, featured first)
        $posts = BlogPost::where('is_published', true)
                         ->orderBy('is_featured', 'desc')
                         ->orderBy('published_at', 'desc')
                         ->limit(3)
                         ->get();

        // Tech stack (grouped by category)
        $techStacks = TechStack::where('is_active', true)
                               ->orderBy('category')
                               ->orderBy('sort_order')
                               ->get();

        // FAQs
        $faqs = Faq::where('is_active', true)
                   ->orderBy('sort_order')
                   ->get();

        // Features
        $features = Feature::where('is_active', true)
                           ->orderBy('sort_order')
                           ->get();

        // Process Steps
        $processSteps = ProcessStep::where('is_active', true)
                                   ->orderBy('sort_order')
                                   ->get();

        return view('welcome', compact(
            'seo', 'settings', 'stats', 'services', 'products',
            'projects', 'testimonials', 'plans', 'posts',
            'techStacks', 'faqs', 'features', 'processSteps'
        ));
    }

    /**
     * Handle contact form submission — store to DB.
     */
    public function contact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:100',
            'phone'   => 'nullable|string|max:15',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        ContactInquiry::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'subject'            => $request->subject,
            'message'            => $request->message,
            'service_interested' => $request->service_interested,
            'ip_address'         => $request->ip(),
            'user_agent'         => $request->userAgent(),
            'status'             => 'new',
        ]);

        return back()->with('success', 'Message sent! We will contact you soon.');
    }
}
