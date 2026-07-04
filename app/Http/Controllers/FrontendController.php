<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Shared site settings (loaded from DB Settings model).
     */
    private function getSettings(): array
    {
        return \App\Models\Setting::allKeyed();
    }

    /**
     * About page
     */
    public function about()
    {
        $settings    = $this->getSettings();

        $seo = [
            'title'       => $settings['about_seo_title'] ?? 'About AmanProjects — Laravel Developer & Ethical Hacker from Bihar, India',
            'description' => $settings['about_seo_description'] ?? 'Learn about AmanProjects — founded by Aman, a Full Stack Laravel Developer and Ethical Hacker from Bihar, India. 3+ years of SaaS development and security audit experience.',
            'keywords'    => $settings['about_seo_keywords'] ?? 'about AmanProjects, Laravel developer Bihar, ethical hacker India, software company Bihar, Aman developer',
            'canonical'   => url('/about'),
            'og_type'     => 'profile',
        ];

        $breadcrumbs = [
            ['name' => 'About', 'url' => url('/about')],
        ];

        $techStacks  = collect([]);

        return view('frontend.about', compact('seo', 'breadcrumbs', 'settings', 'techStacks'));
    }

    /**
     * Services page
     */
    public function services()
    {
        $settings = $this->getSettings();

        $seo = [
            'title'       => $settings['services_seo_title'] ?? 'Services — Laravel SaaS Development, Ethical Hacking & Web Development | AmanProjects Bihar',
            'description' => $settings['services_seo_description'] ?? 'AmanProjects offers Laravel SaaS development, ethical hacking & VAPT, corporate website development, and REST API integration. Based in Bihar, India — serving businesses nationwide.',
            'keywords'    => $settings['services_seo_keywords'] ?? 'Laravel SaaS development Bihar, ethical hacking services India, VAPT Bihar, corporate website development Bihar, REST API development India',
            'canonical'   => url('/services'),
            'og_type'     => 'website',
        ];

        $breadcrumbs = [
            ['name' => 'Services', 'url' => url('/services')],
        ];

        $services = collect([]);

        return view('frontend.services', compact('seo', 'breadcrumbs', 'settings', 'services'));
    }

    /**
     * Contact page
     */
    public function contact()
    {
        $settings = $this->getSettings();

        $seo = [
            'title'       => $settings['contact_seo_title'] ?? 'Contact AmanProjects — Hire a Laravel Developer or Ethical Hacker from Bihar, India',
            'description' => $settings['contact_seo_description'] ?? 'Contact AmanProjects for custom Laravel SaaS development, ethical hacking, VAPT, and corporate website projects. Based in Bihar, India. Quick response within 24 hours.',
            'keywords'    => $settings['contact_seo_keywords'] ?? 'contact AmanProjects, hire Laravel developer Bihar, hire ethical hacker India, software development enquiry Bihar',
            'canonical'   => url('/contact'),
            'robots'      => 'index, follow',
        ];

        $breadcrumbs = [
            ['name' => 'Contact', 'url' => url('/contact')],
        ];

        return view('frontend.contact', compact('seo', 'breadcrumbs', 'settings'));
    }

    /**
     * Handle contact form submission
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|min:10|max:2000',
        ]);

        // TODO: Store to DB or send mail using Mail::to()
        // Mail::to('hello@amanprojects.com')->send(new ContactMail($validated));

        return redirect()->route('contact')->with('success', 'Your message has been sent! We will respond within 24 hours.');
    }
}
