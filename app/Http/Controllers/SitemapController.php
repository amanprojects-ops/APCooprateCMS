<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Generate the XML sitemap dynamically (map.md Part 4).
     */
    public function index()
    {
        $pages = [
            ['url' => '/',         'priority' => '1.0', 'changefreq' => 'weekly'],
            ['url' => '/services', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/about',    'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/contact',  'priority' => '0.7', 'changefreq' => 'monthly'],
        ];

        // Replace with real model queries when available:
        // $products = \App\Models\Product::where('is_active', true)->get();
        // $posts    = \App\Models\BlogPost::where('is_published', true)->get();
        // $services = \App\Models\Service::where('is_active', true)->get();

        $products = collect([]);
        $posts    = collect([]);
        $services = collect([]);

        return response()
            ->view('sitemap', compact('pages', 'products', 'posts', 'services'))
            ->header('Content-Type', 'application/xml');
    }
}
