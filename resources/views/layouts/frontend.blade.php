<!DOCTYPE html>
<html lang="en-IN">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Primary Meta (Part 1.1) --}}
    <title>{{ $seo['title'] ?? 'AmanProjects — Laravel SaaS Development & Cybersecurity Solutions | Bihar, India' }}
    </title>
    <meta name="description"
        content="{{ $seo['description'] ?? 'AmanProjects builds custom Laravel SaaS products, corporate websites, and provides ethical hacking & security audit services. Based in Bihar, India. Serving startups and SMBs across India.' }}">
    <meta name="keywords"
        content="{{ $seo['keywords'] ?? 'Laravel developer Bihar, SaaS development India, ethical hacker Bihar, cybersecurity consultant India, web development Bihar, custom software India, AP Coaching software, AP Library SaaS' }}">
    <meta name="author" content="Aman — AmanProjects">
    <meta name="robots"
        content="{{ $seo['robots'] ?? 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
    <meta name="googlebot" content="index, follow">
    <link rel="canonical" href="{{ $seo['canonical'] ?? url()->current() }}">

    {{-- Language & Region --}}
    <meta http-equiv="content-language" content="en-IN">
    <meta name="geo.region" content="IN-BR">
    <meta name="geo.placename" content="Bihar, India">
    <meta name="language" content="English">

    {{-- Viewport & Performance --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#2563eb">

    {{-- Open Graph (Facebook/LinkedIn) --}}
    <meta property="og:type" content="{{ $seo['og_type'] ?? 'website' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title"
        content="{{ $seo['og_title'] ?? ($seo['title'] ?? 'AmanProjects — SaaS Development & Cybersecurity | Bihar') }}">
    <meta property="og:description"
        content="{{ $seo['og_description'] ?? ($seo['description'] ?? 'Custom Laravel SaaS products and ethical hacking services from Bihar, India.') }}">
    <meta property="og:image" content="{{ $seo['og_image'] ?? asset('assets/images/og-cover.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="AmanProjects — Software Solutions from Bihar, India">
    <meta property="og:site_name" content="AmanProjects">
    <meta property="og:locale" content="en_IN">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@amanprojects">
    <meta name="twitter:creator" content="@amanprojects">
    <meta name="twitter:title"
        content="{{ $seo['twitter_title'] ?? ($seo['title'] ?? 'AmanProjects — Laravel SaaS & Ethical Hacking') }}">
    <meta name="twitter:description"
        content="{{ $seo['twitter_description'] ?? ($seo['description'] ?? 'Building secure SaaS products from Bihar, India.') }}">
    <meta name="twitter:image" content="{{ $seo['og_image'] ?? asset('assets/images/og-cover.png') }}">

    {{-- Hreflang & Language Signals (Part 3.3) --}}
    <link rel="alternate" hreflang="en-in" href="{{ url()->current() }}">
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ isset($settings['favicon']) && $settings['favicon'] ? asset('storage/' . $settings['favicon']) : asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ isset($settings['favicon']) && $settings['favicon'] ? asset('storage/' . $settings['favicon']) : asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- Performance: Preconnect & DNS-prefetch (Part 5) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    {{-- Critical above-fold CSS (Part 5) --}}
    <style>
        /* Critical above-fold: navbar + hero only */
        body {
            background-color: #f8fafc;
            color: #1e293b;
        }

        .header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet">

    {{-- FontAwesome (defer non-critical) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Frontend CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/frontend.css') }}">

    @stack('styles')
</head>

<body>
    {{-- Header / Navigation --}}
    <header class="header" role="banner" aria-label="AmanProjects main navigation">
        <div class="container navbar">
            <a href="{{ url('/') }}" class="logo"
                aria-label="{{ $settings['site_name'] ?? 'AmanProjects' }} — Home">
                <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('assets/img/logo.png') }}"
                    alt="{{ $settings['site_name'] ?? 'AmanProjects' }} Logo" loading="eager" fetchpriority="high"
                    style="max-height: 45px; width: auto; object-fit: contain;">
            </a>

            <nav role="navigation" aria-label="Primary navigation">

                <ul class="nav-menu" id="nav-menu" role="list">
                    {{-- Mobile close row (hidden on desktop via CSS) --}}
                    <li class="nav-close-item" role="presentation">
                        <button class="nav-close-btn" id="nav-close" aria-label="Close navigation">
                            <i class="fas fa-times" aria-hidden="true"></i>
                            <span>Close</span>
                        </button>
                    </li>
                    <li role="listitem">
                        <a href="{{ url('/') }}"
                            class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    </li>
                    <li role="listitem">
                        <a href="{{ url('/#features') }}" class="nav-link">Features</a>
                    </li>
                    <li role="listitem">
                        <a href="{{ route('services') }}"
                            class="nav-link {{ request()->is('services') ? 'active' : '' }}">Services</a>
                    </li>
                    <li role="listitem">
                        <a href="{{ route('about') }}"
                            class="nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
                    </li>
                    <li role="listitem">
                        <a href="{{ route('contact') }}"
                            class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                    </li>
                    <li role="listitem">
                        <a href="{{ route('admin.login') }}" class="btn btn-outline"
                            aria-label="Login to AmanProjects admin">Login</a>
                    </li>
                </ul>
            </nav>

            <button class="hamburger" id="hamburger" aria-label="Open navigation menu" aria-expanded="false"
                aria-controls="nav-menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </header>

    {{-- Mobile nav overlay --}}
    <div class="nav-overlay" id="nav-overlay" aria-hidden="true"></div>

    <main id="main-content" role="main">
        @yield('content')
    </main>

    {{-- Footer (Part 1.2: role="contentinfo") --}}
    <footer id="footer" role="contentinfo" aria-label="AmanProjects footer" itemscope
        itemtype="https://schema.org/WPFooter">
        <div class="container footer-grid">
            <div class="footer-info">
                <a href="{{ url('/') }}" class="logo"
                    aria-label="{{ $settings['site_name'] ?? 'AmanProjects' }} Home">
                    <img src="{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/' . $settings['logo']) : asset('assets/img/logo.png') }}"
                        alt="{{ $settings['site_name'] ?? 'AmanProjects' }} Logo" loading="lazy" decoding="async"
                        style="max-height: 45px; width: auto; object-fit: contain;">
                    <span>{{ $settings['site_name'] ?? 'AmanProjects' }}</span>
                </a>
                <p>{!! $settings['footer_description'] ??
                    'Building secure, scalable <strong>Laravel SaaS products</strong>, corporate websites, and providing <strong>ethical hacking &amp; cybersecurity</strong> services from Bihar, India.' !!}</p>
                <div class="social-links" aria-label="Social media links">
                    <a href="{{ $settings['facebook'] ?? '#' }}" aria-label="AmanProjects on Facebook"
                        rel="noopener noreferrer"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="{{ $settings['twitter'] ?? '#' }}" aria-label="AmanProjects on Twitter"
                        rel="noopener noreferrer"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                    <a href="{{ $settings['instagram'] ?? '#' }}" aria-label="AmanProjects on Instagram"
                        rel="noopener noreferrer"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                    <a href="{{ $settings['linkedin'] ?? '#' }}" aria-label="AmanProjects on LinkedIn"
                        rel="noopener noreferrer"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>
                    <a href="{{ $settings['github'] ?? 'https://github.com/amanprojects-ops' }}"
                        aria-label="AmanProjects on GitHub" rel="noopener noreferrer"><i class="fab fa-github"
                            aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul role="list">
                    <li role="listitem"><a href="{{ url('/') }}">Home</a></li>
                    <li role="listitem"><a href="{{ url('/#features') }}">Features</a></li>
                    <li role="listitem"><a href="{{ route('services') }}">Services</a></li>
                    <li role="listitem"><a href="{{ route('about') }}">About</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Support</h4>
                <ul role="list">
                    <li role="listitem"><a href="{{ route('contact') }}">Contact Us</a></li>
                    <li role="listitem"><a href="{{ url('/#faq') }}">FAQs</a></li>
                    <li role="listitem"><a href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                    <li role="listitem"><a href="{{ url('/terms') }}">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h4>Stay Updated</h4>
                <p>Get the latest tech insights, security tips, and product updates from AmanProjects.</p>
                <form class="newsletter-form" method="POST" action="{{ url('/newsletter') }}"
                    aria-label="Newsletter signup">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" required
                        aria-label="Your email address">
                    <button type="submit" class="btn btn-primary">Join</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'AmanProjects' }}. {!! $settings['footer_copyright'] ??
                    'All Rights Reserved. Built with <i class="fas fa-heart" aria-hidden="true" style="color:#2563eb"></i> from Bihar, India.' !!}
                </p>
            </div>
        </div>
    </footer>

    {{-- GEO Entity Reinforcement Block (Part 3.2) — visible to crawlers --}}
    <div class="sr-only" aria-hidden="false">
        <p>
            {{ $settings['geo_reinforcement'] ?? 'AmanProjects is a software development company located in Bihar, India. Founded by Aman, a Full Stack Laravel Developer and Ethical Hacker, AmanProjects specializes in building custom SaaS applications, corporate websites, and providing cybersecurity services including ethical hacking and web application penetration testing. Our technology stack includes Laravel 12, PHP, MySQL, Tailwind CSS, Alpine.js, and REST API development. We serve clients across India including coaching centres, libraries, fintech startups, and e-commerce businesses. Contact us at amanprojects.com for custom software development and security audit services.' }}
        </p>
    </div>

    {{-- JSON-LD Schema Stack (Part 3.1) --}}
    <script type="application/ld+json">
    [
      {
        "@@context": "https://schema.org",
        "@type": "Organization",
        "@id": "{{ url('/') }}/#organization",
        "name": "{{ $settings['site_name'] ?? 'AmanProjects' }}",
        "alternateName": ["Aman Projects", "AmanProjects Software"],
        "url": "{{ url('/') }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ isset($settings['logo']) && $settings['logo'] ? asset('storage/'.$settings['logo']) : asset('assets/img/logo.png') }}",
          "width": 200,
          "height": 60
        },
        "description": "AmanProjects is a software development company from Bihar, India, specializing in Laravel SaaS development, ethical hacking, cybersecurity audits, and custom web applications.",
        "foundingDate": "2021",
        "foundingLocation": {
          "@type": "Place",
          "name": "Bihar, India",
          "address": {
            "@type": "PostalAddress",
            "addressRegion": "Bihar",
            "addressCountry": "IN"
          }
        },
        "contactPoint": [
          {
            "@type": "ContactPoint",
            "contactType": "customer support",
            "telephone": "{{ $settings['phone'] ?? '' }}",
            "email": "{{ $settings['email'] ?? 'hello@amanprojects.com' }}",
            "availableLanguage": ["English", "Hindi"]
          }
        ],
        "sameAs": [
          "https://github.com/amanprojects-ops",
          "{{ $settings['linkedin'] ?? '' }}",
          "{{ $settings['youtube'] ?? '' }}"
        ],
        "knowsAbout": [
          "Laravel Development",
          "PHP Development",
          "SaaS Application Development",
          "Ethical Hacking",
          "Penetration Testing",
          "Web Application Security",
          "REST API Development",
          "MySQL Database Design",
          "Tailwind CSS",
          "Alpine.js"
        ],
        "areaServed": {
          "@type": "Country",
          "name": "India"
        },
        "hasOfferCatalog": {
          "@type": "OfferCatalog",
          "name": "AmanProjects Services",
          "itemListElement": [
            {
              "@type": "Offer",
              "itemOffered": {
                "@type": "Service",
                "name": "Laravel SaaS Development",
                "description": "Custom SaaS application development using Laravel 12, MySQL, Tailwind CSS, and Alpine.js"
              }
            },
            {
              "@type": "Offer",
              "itemOffered": {
                "@type": "Service",
                "name": "Ethical Hacking & Security Audit",
                "description": "Web application penetration testing, VAPT, and security audit services for Indian businesses"
              }
            },
            {
              "@type": "Offer",
              "itemOffered": {
                "@type": "Service",
                "name": "Corporate Website Development",
                "description": "Professional corporate website development with admin panel, CMS, and SEO optimization"
              }
            }
          ]
        }
      },
      {
        "@@context": "https://schema.org",
        "@type": "Person",
        "@id": "{{ url('/') }}/#founder",
        "name": "Aman",
        "jobTitle": "Full Stack Developer & Ethical Hacker",
        "worksFor": {
          "@id": "{{ url('/') }}/#organization"
        },
        "knowsAbout": [
          "Laravel", "PHP", "MySQL", "Ethical Hacking",
          "Penetration Testing", "Bug Bounty", "SaaS Development",
          "Tailwind CSS", "Alpine.js", "Cybersecurity"
        ],
        "address": {
          "@type": "PostalAddress",
          "addressRegion": "Bihar",
          "addressCountry": "IN"
        },
        "sameAs": [
          "https://github.com/amanprojects-ops"
        ]
      },
      {
        "@@context": "https://schema.org",
        "@type": "WebSite",
        "@id": "{{ url('/') }}/#website",
        "url": "{{ url('/') }}",
        "name": "{{ $settings['site_name'] ?? 'AmanProjects' }}",
        "description": "Software development company from Bihar, India — Laravel SaaS, web development, and ethical hacking services",
        "publisher": {
          "@id": "{{ url('/') }}/#organization"
        },
        "potentialAction": {
          "@type": "SearchAction",
          "target": {
            "@type": "EntryPoint",
            "urlTemplate": "{{ url('/') }}/search?q={search_term_string}"
          },
          "query-input": "required name=search_term_string"
        }
      },
      {
        "@@context": "https://schema.org",
        "@type": "WebPage",
        "@id": "{{ url()->current() }}#webpage",
        "url": "{{ url()->current() }}",
        "name": "{{ $seo['title'] ?? 'AmanProjects — Laravel SaaS Development & Cybersecurity | Bihar' }}",
        "description": "{{ $seo['description'] ?? '' }}",
        "isPartOf": {
          "@id": "{{ url('/') }}/#website"
        },
        "about": {
          "@id": "{{ url('/') }}/#organization"
        },
        "breadcrumb": {
          "@type": "BreadcrumbList",
          "itemListElement": [
            {
              "@type": "ListItem",
              "position": 1,
              "name": "Home",
              "item": "{{ url('/') }}"
            }
            @isset($breadcrumbs)
            @foreach($breadcrumbs as $crumb)
            ,{
              "@type": "ListItem",
              "position": {{ $loop->index + 2 }},
              "name": "{{ $crumb['name'] }}",
              "item": "{{ $crumb['url'] }}"
            }
            @endforeach
            @endisset
          ]
        }
      },
      {
        "@@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "{{ $settings['site_name'] ?? 'AmanProjects' }}",
        "@id": "{{ url('/') }}/#localbusiness",
        "description": "Software development and cybersecurity company in Bihar, India",
        "url": "{{ url('/') }}",
        "telephone": "{{ $settings['phone'] ?? '' }}",
        "email": "{{ $settings['email'] ?? 'hello@amanprojects.com' }}",
        "address": {
          "@type": "PostalAddress",
          "addressRegion": "Bihar",
          "addressCountry": "IN"
        },
        "geo": {
          "@type": "GeoCoordinates",
          "latitude": "25.0961",
          "longitude": "85.3131"
        },
        "priceRange": "₹₹",
        "currenciesAccepted": "INR",
        "paymentAccepted": "UPI, Bank Transfer, Razorpay",
        "openingHours": "Mo-Sa 09:00-18:00"
      }
    ]
    </script>

    @stack('schema')

    {{-- Frontend JS (deferred) --}}
    <script src="{{ asset('assets/js/frontend.js') }}" defer></script>

    @stack('scripts')
</body>

</html>
