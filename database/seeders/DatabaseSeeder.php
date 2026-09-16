<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Default admin seeder
        $roleId = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Full access to all modules',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Aman',
            'username' => 'admin',
            'email' => 'admin@amanprojects.com',
            'mobile' => '9876543210',
            'role_id' => $roleId,
            'password' => Hash::make('password'),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ─────────────────────────────────────────────────────────
        // 1. SETTINGS
        // ─────────────────────────────────────────────────────────
        $settings = [
            // General
            ['key' => 'site_name',         'value' => 'AmanProjects',                          'type' => 'text',     'group' => 'general'],
            ['key' => 'phone',             'value' => '+91 98765 43210',                        'type' => 'text',     'group' => 'general'],
            ['key' => 'whatsapp',          'value' => '+91 98765 43210',                        'type' => 'text',     'group' => 'general'],
            ['key' => 'email',             'value' => 'hello@amanprojects.in',                  'type' => 'text',     'group' => 'general'],
            ['key' => 'address',           'value' => 'India',                                  'type' => 'textarea', 'group' => 'general'],
            ['key' => 'logo',              'value' => null,                                     'type' => 'image',    'group' => 'general'],
            ['key' => 'favicon',           'value' => null,                                     'type' => 'image',    'group' => 'general'],

            // About settings
            ['key' => 'about_title',         'value' => 'Who We Are',                            'type' => 'text',     'group' => 'about'],
            ['key' => 'about_subtitle',      'value' => 'Founded in 2021, AmanProjects was built with a single mission: to deliver enterprise-grade software at startup costs to Indian businesses.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_description_1', 'value' => 'Founded by Aman, a Full Stack Laravel Developer and Ethical Hacker with 3+ years of experience building SaaS products and conducting security audits. AmanProjects serves coaching centres, libraries, fintech startups, and SMBs across India with production-grade software solutions.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_description_2', 'value' => 'We combine deep development expertise with hands-on ethical hacking knowledge — meaning every product we build is designed to be secure by default, not as an afterthought.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_image',         'value' => null,                                    'type' => 'image',    'group' => 'about'],
            ['key' => 'years_exp',           'value' => '3+',                                    'type' => 'text',     'group' => 'about'],
            ['key' => 'projects_count',      'value' => '50+',                                   'type' => 'text',     'group' => 'about'],

            // SEO
            ['key' => 'meta_title',        'value' => 'AmanProjects – Software Solutions & SaaS Products', 'type' => 'text',     'group' => 'seo'],
            ['key' => 'meta_description',  'value' => 'We build modern web apps, SaaS products, and software solutions for businesses worldwide.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'website_feature_image', 'value' => null,                                 'type' => 'image',    'group' => 'seo'],

            ['key' => 'about_seo_title',   'value' => 'About AmanProjects — Laravel Developer & Ethical Hacker from Bihar, India', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'about_seo_description', 'value' => 'Learn about AmanProjects — founded by Aman, a Full Stack Laravel Developer and Ethical Hacker from Bihar, India. 3+ years of SaaS development and security audit experience.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'about_seo_keywords', 'value' => 'about AmanProjects, Laravel developer Bihar, ethical hacker India, software company Bihar, Aman developer', 'type' => 'textarea', 'group' => 'seo'],

            ['key' => 'services_seo_title', 'value' => 'Services — Laravel SaaS Development, Ethical Hacking & Web Development | AmanProjects Bihar', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'services_seo_description', 'value' => 'AmanProjects offers Laravel SaaS development, ethical hacking & VAPT, corporate website development, and REST API integration. Based in Bihar, India — serving businesses nationwide.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'services_seo_keywords', 'value' => 'Laravel SaaS development Bihar, ethical hacking services India, VAPT Bihar, corporate website development Bihar, REST API development India', 'type' => 'textarea', 'group' => 'seo'],

            ['key' => 'contact_seo_title', 'value' => 'Contact AmanProjects — Hire a Laravel Developer or Ethical Hacker from Bihar, India', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'contact_seo_description', 'value' => 'Contact AmanProjects for custom Laravel SaaS development, ethical hacking, VAPT, and corporate website projects. Based in Bihar, India. Quick response within 24 hours.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'contact_seo_keywords', 'value' => 'contact AmanProjects, hire Laravel developer Bihar, hire ethical hacker India, software development enquiry Bihar', 'type' => 'textarea', 'group' => 'seo'],

            // Social
            ['key' => 'facebook',          'value' => 'https://facebook.com/amanprojects',     'type' => 'url',      'group' => 'social'],
            ['key' => 'twitter',           'value' => 'https://twitter.com/amanprojects',      'type' => 'url',      'group' => 'social'],
            ['key' => 'instagram',         'value' => 'https://instagram.com/amanprojects',    'type' => 'url',      'group' => 'social'],
            ['key' => 'youtube',           'value' => 'https://youtube.com/@amanprojects',     'type' => 'url',      'group' => 'social'],
            ['key' => 'github',            'value' => 'https://github.com/amanprojects',       'type' => 'url',      'group' => 'social'],
            ['key' => 'linkedin',          'value' => 'https://linkedin.com/in/amanprojects',  'type' => 'url',      'group' => 'social'],

            // Hero
            ['key' => 'hero_headline',     'value' => 'Building Software That Works For You',  'type' => 'text',     'group' => 'hero'],
            ['key' => 'hero_subtext',      'value' => 'We craft modern web applications, SaaS products, and automation tools that help businesses scale with confidence.', 'type' => 'textarea', 'group' => 'hero'],

            // Sections
            ['key' => 'features_title',    'value' => 'Why Choose AmanProjects?', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'features_subtitle', 'value' => 'Security-first software development for modern Indian businesses.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'services_title',    'value' => 'What We Do', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'services_subtitle', 'value' => 'Comprehensive software solutions for Indian startups and SMBs.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'products_title',    'value' => 'Our SaaS Products', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'products_subtitle', 'value' => 'Purpose-built software for Indian education and service sectors.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'how_it_works_title', 'value' => 'How It Works', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'how_it_works_subtitle', 'value' => 'Three simple steps to get your project off the ground.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'tech_stack_title',  'value' => 'Our Technology Stack', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'tech_stack_subtitle', 'value' => 'Battle-tested tools we use to build secure, scalable applications.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'portfolio_title',   'value' => 'Featured Projects', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'portfolio_subtitle', 'value' => 'Real-world solutions delivered for clients across India.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'pricing_title',     'value' => 'Transparent Pricing', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'pricing_subtitle',  'value' => 'No hidden costs. Choose a plan that fits your business.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'testimonials_title', 'value' => 'What Clients Say', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'testimonials_subtitle', 'value' => 'Trusted by businesses across India.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'faq_title',         'value' => 'Frequently Asked Questions', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'faq_subtitle',      'value' => 'Everything you need to know about working with AmanProjects.', 'type' => 'textarea', 'group' => 'sections'],
            ['key' => 'blog_title',        'value' => 'Latest from CodeBB', 'type' => 'text', 'group' => 'sections'],
            ['key' => 'blog_subtitle',     'value' => 'Tech insights, security tips, and product updates from Bihar.', 'type' => 'textarea', 'group' => 'sections'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
