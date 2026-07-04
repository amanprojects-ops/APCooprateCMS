@extends('layouts.frontend')

{{-- ============================================================
     HOMEPAGE — welcome.blade.php
     Dynamic: ALL data from DB via WelcomeController
     SEO:     Full meta + JSON-LD from layouts/frontend.blade.php
     Rules:   DO NOT change class names / CSS / AOS / Swiper attrs
     ============================================================ --}}

@section('content')

    {{-- ====================================================
         HERO SECTION
         - h1 / subtext from settings table
         - Hero Swiper carousel from products (with screenshots)
         ==================================================== --}}
    <section id="home" class="hero section-padding" aria-label="AmanProjects hero — Software Solutions from Bihar"
        itemscope itemtype="https://schema.org/WebSite">

        {{-- AIO sr-only trigger (map.md Part 2.5) --}}
        <p class="sr-only">
            AmanProjects offers: Laravel web development, custom SaaS application development,
            ethical hacking and penetration testing, REST API development, from Bihar, India.
        </p>

        <div class="container hero-grid">
            <div class="hero-content" data-aos="fade-right">
                <span class="badge">🔒 Security-First Software from Bihar, India</span>

                <h1 class="hero-title" itemprop="name">
                    {!! $settings['hero_headline'] ??
                        'AmanProjects — Custom <span class="text-primary">Laravel SaaS</span> Development &amp; Ethical Hacking Services from Bihar, India' !!}
                </h1>
                <p class="hero-subtitle" itemprop="description">
                    {{ $settings['hero_subtext'] ?? 'We build secure, scalable Laravel 12 SaaS products, corporate websites, and provide ethical hacking & penetration testing services for startups and businesses across India. Based in Bihar — enterprise-grade software at startup costs.' }}
                </p>

                <div class="hero-btns">
                    <a href="{{ route('services') }}" class="btn btn-primary" id="hero-cta-services">
                        Explore Services <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    <a href="#how-it-works" class="btn btn-outline" id="hero-cta-how">How It Works</a>
                </div>

                {{-- Stats bar — from DB --}}
                @if ($stats->isNotEmpty())
                    <div class="hero-stats" aria-label="AmanProjects statistics">
                        @foreach ($stats as $stat)
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="{{ 400 + $loop->index * 80 }}">
                                @if ($stat->icon)
                                    <span class="stat-icon" aria-hidden="true">{!! $stat->icon !!}</span>
                                @endif
                                <span class="stat-number counter" data-target="{{ $stat->value }}">0</span>{{ $stat->suffix }}
                                <span class="stat-label">{{ $stat->label }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- Fallback static stats --}}
                    <div class="hero-stats" aria-label="AmanProjects key statistics">
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                            <span class="stat-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            </span>
                            <span class="stat-number counter" data-target="3">0</span>+
                            <span class="stat-label">Years Experience</span>
                        </div>
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="480">
                            <span class="stat-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                            </span>
                            <span class="stat-number counter" data-target="50">0</span>+
                            <span class="stat-label">Projects Delivered</span>
                        </div>
                        <div class="stat-item" data-aos="fade-up" data-aos-delay="560">
                            <span class="stat-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" /></svg>
                            </span>
                            <span class="stat-number counter" data-target="10">0</span>+
                            <span class="stat-label">Security Audits</span>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Hero Carousel — products with screenshots --}}
            <div class="hero-image" data-aos="fade-left">
                @if ($products->isNotEmpty())
                    <div class="swiper hero-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($products as $product)
                                <div class="swiper-slide">
                                    @if ($product->screenshots->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->screenshots->first()->image_path) }}"
                                            alt="{{ $product->name }} — SaaS product by AmanProjects Bihar" loading="lazy"
                                            decoding="async" width="600" height="400">
                                    @elseif($product->thumbnail)
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                            alt="{{ $product->name }} — SaaS product by AmanProjects Bihar" loading="lazy"
                                            decoding="async" width="600" height="400">
                                    @else
                                        <div class="glass-card"
                                            style="display:flex;align-items:center;justify-content:center;min-height:300px;">
                                            <span class="stat-number">{{ $product->name }}</span>
                                        </div>
                                    @endif
                                    <div class="slide-info">
                                        <h3>{{ $product->name }}</h3>
                                        <p>{{ $product->tagline }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev" aria-label="Previous product"></div>
                        <div class="swiper-button-next" aria-label="Next product"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                @else
                    <div class="glass-card">
                        <img src="{{ asset('assets/img/hero-banner.jpg') }}"
                            alt="AmanProjects — Laravel SaaS & Ethical Hacking Services from Bihar India" loading="eager"
                            fetchpriority="high" width="600" height="400">
                        <div class="floating-badge badge-top" aria-hidden="true">
                            <i class="fas fa-shield-alt"></i> Security-First Dev
                        </div>
                        <div class="floating-badge badge-bottom" aria-hidden="true">
                            <i class="fas fa-check-circle"></i> Laravel 12 Expert
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>


    {{-- ====================================================
         FEATURES SECTION
         - Static highlights (always visible)
         ==================================================== --}}
    <section id="features" class="features section-padding" aria-label="Why Choose AmanProjects — Key Features">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <h2 class="section-title">{{ $settings['features_title'] ?? 'Why Choose AmanProjects?' }}</h2>
                <p class="section-subtitle">
                    {{ $settings['features_subtitle'] ?? 'Security-first software development for modern Indian businesses.' }}
                </p>
            </div>
            <div class="features-grid">
                @foreach ($features as $feature)
                    <article class="feature-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                        aria-label="{{ $feature->title }} feature">
                        <div class="feature-icon">{!! $feature->icon !!}</div>
                        <h3>{{ $feature->title }}</h3>
                        <p>{{ $feature->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ====================================================
         SERVICES SECTION (DB-driven)
         - is_active = true only
         - ordered by sort_order
         ==================================================== --}}
    @if ($services->isNotEmpty())
        <section id="services" class="services section-padding bg-light" aria-label="Our Software Development Services">

            {{-- AIO sr-only trigger (map.md Part 2.5) --}}
            <p class="sr-only">
                AmanProjects offers the following software development services in Bihar, India:
                Laravel web development, custom SaaS application development,
                ethical hacking and penetration testing, REST API development and integration,
                and custom software consulting for businesses across India.
            </p>

            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['services_title'] ?? 'What We Do' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['services_subtitle'] ?? 'Comprehensive software solutions for Indian startups and SMBs.' }}
                    </p>
                </div>
                <div class="services-grid">
                    @foreach ($services as $service)
                        <article class="service-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                            itemscope itemtype="https://schema.org/Service"
                            aria-label="{{ $service->title }} — AmanProjects service">
                            <div class="service-icon">
                                @if ($service->icon)
                                    {!! $service->icon !!}
                                @else
                                    <i class="fas fa-code" aria-hidden="true"></i>
                                @endif
                            </div>
                            <div class="service-content">
                                <h3 itemprop="name">{{ $service->title }}</h3>
                                <p itemprop="description">{{ $service->short_description }}</p>
                                <a href="#contact" class="btn-text" aria-label="Learn more about {{ $service->title }}">
                                    Learn More <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         PRODUCTS SHOWCASE (DB-driven)
         - is_active = true, featured first
         - each card has tech_stack tags, price, demo/buy CTAs
         ==================================================== --}}
    @if ($products->isNotEmpty())
        <section id="products" class="section-padding" aria-label="SaaS Products by AmanProjects">

            {{-- AIO sr-only trigger (map.md Part 2.5) --}}
            <p class="sr-only">
                AmanProjects SaaS products include: AP Coaching (coaching centre management software for Bihar),
                AP Library (library seat booking SaaS for Tier-2 cities), and more products under active development.
            </p>

            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['products_title'] ?? 'Our SaaS Products' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['products_subtitle'] ?? 'Purpose-built software for Indian education and service sectors.' }}
                    </p>
                </div>
                <div class="services-grid">
                    @foreach ($products as $product)
                        <article class="product-card service-card {{ $product->is_featured ? 'featured-card' : '' }}"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" itemscope
                            itemtype="https://schema.org/SoftwareApplication"
                            aria-label="{{ $product->name }} — SaaS product by AmanProjects">

                            @if ($product->is_featured)
                                <span class="featured-badge">⭐ Featured</span>
                            @endif

                            @if ($product->screenshots->isNotEmpty())
                                <div class="service-image swiper card-swiper">
                                    <div class="swiper-wrapper">
                                        @if ($product->thumbnail)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                    alt="{{ $product->name }} — {{ $product->category ?? 'SaaS' }} by AmanProjects"
                                                    title="{{ $product->name }}" loading="lazy" decoding="async" width="800"
                                                    height="450" itemprop="image" style="width:100%;height:100%;object-fit:cover;">
                                            </div>
                                        @endif
                                        @foreach ($product->screenshots as $shot)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $shot->image_path) }}"
                                                    alt="{{ $shot->caption ?? $product->name }}" loading="lazy" decoding="async" width="800"
                                                    height="450" style="width:100%;height:100%;object-fit:cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            @elseif ($product->thumbnail)
                                <div class="service-image">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                        alt="{{ $product->name }} — {{ $product->category ?? 'SaaS' }} by AmanProjects"
                                        title="{{ $product->name }}" loading="lazy" decoding="async" width="800"
                                        height="450" itemprop="image">
                                </div>
                            @endif

                            <div class="service-content">
                                @if ($product->category)
                                    <span class="category-badge">{{ $product->category }}</span>
                                @endif

                                <h3 itemprop="name">{{ $product->name }}</h3>
                                <p itemprop="description">{{ $product->tagline }}</p>

                                @if ($product->tech_stack)
                                    <div class="tech-tags" style="display:flex;flex-wrap:wrap;gap:6px;margin:10px 0;">
                                        @foreach ($product->tech_stack as $tech)
                                            <span class="tech-tag">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($product->price)
                                    <div class="price" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                        <span itemprop="priceCurrency" content="INR" style="display:none;">INR</span>
                                        <span itemprop="price" content="{{ $product->price }}"
                                            style="display:none;">{{ $product->price }}</span>
                                        ₹{{ number_format($product->price, 0) }}<span>/month</span>
                                    </div>
                                @endif

                                <div class="cta-buttons" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:15px;">
                                    @if ($product->demo_url)
                                        <a href="{{ $product->demo_url }}" target="_blank" rel="noopener noreferrer"
                                            class="btn-demo btn btn-outline"
                                            aria-label="View demo of {{ $product->name }}" itemprop="url">
                                            View Demo
                                        </a>
                                    @endif
                                    @if (isset($product->buy_url) && $product->buy_url)
                                        <a href="{{ $product->buy_url }}" target="_blank" rel="noopener noreferrer"
                                            class="btn-buy btn btn-primary" aria-label="Buy {{ $product->name }}">
                                            Buy Now
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         HOW IT WORKS (Static — always visible)
         ==================================================== --}}
    <section id="how-it-works" class="how-it-works section-padding bg-light"
        aria-label="How AmanProjects Works — Process">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <h2 class="section-title">{{ $settings['how_it_works_title'] ?? 'How It Works' }}</h2>
                <p class="section-subtitle">
                    {{ $settings['how_it_works_subtitle'] ?? 'Three simple steps to get your project off the ground.' }}
                </p>
            </div>
            <div class="steps-grid">
                @foreach ($processSteps as $step)
                    <article class="step-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                        aria-label="Step {{ $step->step_number }}: {{ $step->title }}">
                        <div class="step-number" aria-hidden="true">{{ $step->step_number }}</div>
                        <h3>{{ $step->title }}</h3>
                        <p>{{ $step->description }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ====================================================
         TECH STACK (DB-driven, grouped by category)
         ==================================================== --}}
    @if ($techStacks->isNotEmpty())
        @php
            $grouped = $techStacks->groupBy('category');

            // FontAwesome brand/solid icon map — matched by keyword (case-insensitive)
            $techIconMap = [
                'laravel'      => 'fab fa-laravel',
                'php'          => 'fab fa-php',
                'javascript'   => 'fab fa-js',
                ' js'          => 'fab fa-js',
                'typescript'   => 'fab fa-js',
                'python'       => 'fab fa-python',
                'node'         => 'fab fa-node-js',
                'react'        => 'fab fa-react',
                'vue'          => 'fab fa-vuejs',
                'angular'      => 'fab fa-angular',
                'svelte'       => 'fas fa-fire',
                'html'         => 'fab fa-html5',
                'css'          => 'fab fa-css3-alt',
                'tailwind'     => 'fas fa-wind',
                'bootstrap'    => 'fab fa-bootstrap',
                'sass'         => 'fab fa-sass',
                'git'          => 'fab fa-git-alt',
                'github'       => 'fab fa-github',
                'gitlab'       => 'fab fa-gitlab',
                'docker'       => 'fab fa-docker',
                'linux'        => 'fab fa-linux',
                'ubuntu'       => 'fab fa-ubuntu',
                'centos'       => 'fab fa-centos',
                'fedora'       => 'fab fa-fedora',
                'aws'          => 'fab fa-aws',
                'amazon'       => 'fab fa-aws',
                'azure'        => 'fas fa-cloud',
                'google cloud' => 'fab fa-google',
                'gcp'          => 'fab fa-google',
                'firebase'     => 'fas fa-fire',
                'mysql'        => 'fas fa-database',
                'mariadb'      => 'fas fa-database',
                'postgresql'   => 'fas fa-database',
                'postgres'     => 'fas fa-database',
                'sqlite'       => 'fas fa-database',
                'mongodb'      => 'fas fa-database',
                'redis'        => 'fas fa-memory',
                'nginx'        => 'fas fa-server',
                'apache'       => 'fas fa-server',
                'wordpress'    => 'fab fa-wordpress',
                'shopify'      => 'fab fa-shopify',
                'stripe'       => 'fab fa-stripe',
                'paypal'       => 'fab fa-paypal',
                'razorpay'     => 'fas fa-rupee-sign',
                'bash'         => 'fas fa-terminal',
                'shell'        => 'fas fa-terminal',
                'api'          => 'fas fa-plug',
                'rest'         => 'fas fa-plug',
                'graphql'      => 'fas fa-project-diagram',
                'websocket'    => 'fas fa-bolt',
                'socket'       => 'fas fa-bolt',
                'jwt'          => 'fas fa-key',
                'oauth'        => 'fas fa-shield-alt',
                'security'     => 'fas fa-shield-alt',
                'ssl'          => 'fas fa-lock',
                'kali'         => 'fas fa-user-secret',
                'metasploit'   => 'fas fa-user-secret',
                'burp'         => 'fas fa-bug',
                'nmap'         => 'fas fa-network-wired',
                'figma'        => 'fab fa-figma',
                'postman'      => 'fas fa-paper-plane',
                'jira'         => 'fab fa-jira',
                'trello'       => 'fab fa-trello',
                'slack'        => 'fab fa-slack',
                'java'         => 'fab fa-java',
                'flutter'      => 'fas fa-mobile-alt',
                'android'      => 'fab fa-android',
                'apple'        => 'fab fa-apple',
                'ios'          => 'fab fa-apple',
                'npm'          => 'fab fa-npm',
                'webpack'      => 'fas fa-cube',
                'vite'         => 'fas fa-bolt',
                'digitalocean' => 'fab fa-digital-ocean',
                'cloudflare'   => 'fas fa-shield-alt',
                'cpanel'       => 'fas fa-server',
                'server'       => 'fas fa-server',
                'cloud'        => 'fas fa-cloud',
                'database'     => 'fas fa-database',
                'mobile'       => 'fas fa-mobile-alt',
                'web'          => 'fas fa-globe',
                'api'          => 'fas fa-plug',
            ];

            $resolveTechIcon = function (string $name) use ($techIconMap): string {
                $lower = strtolower($name);
                foreach ($techIconMap as $keyword => $cls) {
                    if (str_contains($lower, $keyword)) {
                        return $cls;
                    }
                }
                return 'fas fa-code';
            };
        @endphp
        <section id="tech-stack" class="ts-section section-padding" aria-label="AmanProjects Technology Stack">

            {{-- Decorative background blobs --}}
            <div class="ts-blob ts-blob-1" aria-hidden="true"></div>
            <div class="ts-blob ts-blob-2" aria-hidden="true"></div>

            <div class="container" style="position:relative;z-index:1;">
                <div class="section-header text-center" data-aos="fade-up">
                    <span class="ts-eyebrow">Powered By</span>
                    <h2 class="section-title">{{ $settings['tech_stack_title'] ?? 'Our Technology Stack' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['tech_stack_subtitle'] ?? 'Battle-tested tools we use to build secure, scalable applications.' }}
                    </p>
                </div>

                @foreach ($grouped as $category => $techs)
                    <div class="ts-category-block" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        {{-- Category pill label --}}
                        <div class="ts-category-label">
                            <span class="ts-category-pill">{{ $category }}</span>
                            <div class="ts-divider-line"></div>
                        </div>

                        <div class="ts-grid">
                            @foreach ($techs as $tech)
                                <div class="ts-card" aria-label="{{ $tech->name }} technology">
                                    <div class="ts-card-inner">
                                        <div class="ts-logo-wrap">
                                            @if ($tech->logo)
                                                <img src="{{ asset('storage/' . $tech->logo) }}"
                                                    alt="{{ $tech->name }} — Technology used by AmanProjects"
                                                    loading="lazy" decoding="async" width="48" height="48">
                                            @else
                                                <div class="ts-icon-fallback">
                                                    <i class="{{ $resolveTechIcon($tech->name) }}" aria-hidden="true"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <span class="ts-name">{{ $tech->name }}</span>
                                    </div>
                                    <div class="ts-card-glow" aria-hidden="true"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif


    {{-- ====================================================
         PROJECTS / PORTFOLIO (DB-driven, is_featured only)
         ==================================================== --}}
    @if ($projects->isNotEmpty())
        <section id="portfolio" class="section-padding bg-light" aria-label="AmanProjects Portfolio — Featured Projects">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['portfolio_title'] ?? 'Featured Projects' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['portfolio_subtitle'] ?? 'Real-world solutions delivered for clients across India.' }}
                    </p>
                </div>
                <div class="services-grid">
                    @foreach ($projects as $project)
                        <article class="project-card service-card" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}"
                            aria-label="{{ $project->title }} project by AmanProjects">
                            @if ($project->screenshots->isNotEmpty())
                                <div class="service-image swiper card-swiper">
                                    <div class="swiper-wrapper">
                                        @if ($project->thumbnail)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                                    alt="{{ $project->title }} — {{ $project->category ?? 'project' }} by AmanProjects Bihar"
                                                    loading="lazy" decoding="async" width="400" height="250" style="width:100%;height:100%;object-fit:cover;">
                                            </div>
                                        @endif
                                        @foreach ($project->screenshots as $shot)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $shot->image_path) }}"
                                                    alt="{{ $shot->caption ?? $project->title }}" loading="lazy" decoding="async" width="400"
                                                    height="250" style="width:100%;height:100%;object-fit:cover;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            @elseif ($project->thumbnail)
                                <div class="service-image">
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                                        alt="{{ $project->title }} — {{ $project->category ?? 'project' }} by AmanProjects Bihar"
                                        loading="lazy" decoding="async" width="400" height="250">
                                </div>
                            @endif
                            <div class="service-content">
                                @if ($project->category)
                                    <span class="category-badge">{{ $project->category }}</span>
                                @endif
                                <h3>{{ $project->title }}</h3>

                                @if ($project->client_name)
                                    <p class="client" style="font-size:.85rem;color:var(--text-muted);margin-bottom:8px;">
                                        Client: <strong>{{ $project->client_name }}</strong>
                                    </p>
                                @endif

                                <p>{{ Str::limit($project->description, 120) }}</p>

                                @if ($project->tech_stack)
                                    <div class="tech-tags" style="display:flex;flex-wrap:wrap;gap:6px;margin:10px 0;">
                                        @foreach ($project->tech_stack as $tech)
                                            <span class="tech-tag">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($project->completed_at)
                                    <p class="date" style="font-size:.8rem;color:var(--text-muted);">
                                        Completed: {{ $project->completed_at->format('M Y') }}
                                    </p>
                                @endif

                                <div class="cta-buttons" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:15px;">
                                    @if ($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-primary" aria-label="View live demo of {{ $project->title }}">
                                            Live Demo
                                        </a>
                                    @endif
                                    @if ($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                                            class="btn btn-outline" aria-label="{{ $project->title }} GitHub repository">
                                            <i class="fab fa-github" aria-hidden="true"></i> GitHub
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         PRICING SECTION (DB-driven)
         - is_active, ordered by sort_order
         - features eager loaded, is_included toggle
         ==================================================== --}}
    @if ($plans->isNotEmpty())
        <section id="pricing" class="section-padding" aria-label="AmanProjects Pricing Plans">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['pricing_title'] ?? 'Transparent Pricing' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['pricing_subtitle'] ?? 'No hidden costs. Choose a plan that fits your business.' }}
                    </p>
                </div>
                <div class="services-grid">
                    @foreach ($plans as $plan)
                        <div class="pricing-card service-card {{ $plan->is_featured ? 'pricing-featured featured-card' : '' }}"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}"
                            aria-label="{{ $plan->name }} pricing plan">

                            @if ($plan->is_featured && $plan->badge_text)
                                <div class="popular-badge featured-badge">{{ $plan->badge_text }}</div>
                            @endif

                            <div class="service-content">
                                <h3>{{ $plan->name }}</h3>

                                @if ($plan->tagline)
                                    <p class="plan-tagline" style="color:var(--text-muted);margin-bottom:15px;">
                                        {{ $plan->tagline }}</p>
                                @endif

                                <div class="plan-price price" style="font-size:2rem;font-weight:800;margin-bottom:20px;">
                                    ₹{{ number_format($plan->price, 0) }}
                                    <span style="font-size:1rem;font-weight:400;">/{{ $plan->billing_cycle }}</span>
                                </div>

                                <ul class="features-list service-features" style="margin-bottom:20px;">
                                    @foreach ($plan->features as $feature)
                                        <li class="{{ $feature->is_included ? 'included' : 'excluded' }}"
                                            style="{{ $feature->is_included ? '' : 'text-decoration:line-through;opacity:.5;' }}">
                                            @if ($feature->is_included)
                                                <i class="fas fa-check" aria-hidden="true"
                                                    style="color:var(--primary)"></i>
                                            @else
                                                <i class="fas fa-times" aria-hidden="true" style="color:#ef4444"></i>
                                            @endif
                                            {{ $feature->feature_text }}
                                        </li>
                                    @endforeach
                                </ul>

                                <a href="{{ $plan->cta_url ?? '#contact' }}"
                                    class="btn {{ $plan->is_featured ? 'btn-primary' : 'btn-outline' }}"
                                    style="width:100%;text-align:center;"
                                    aria-label="{{ $plan->cta_text ?? 'Get Started' }} — {{ $plan->name }} plan">
                                    {{ $plan->cta_text ?? 'Get Started' }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         TESTIMONIALS (DB-driven — Swiper carousel)
         - is_active = true, featured first
         - initials avatar fallback
         ==================================================== --}}
    @if ($testimonials->isNotEmpty())
        <section id="testimonials" class="section-padding bg-light" aria-label="Client Testimonials for AmanProjects">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['testimonials_title'] ?? 'What Clients Say' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['testimonials_subtitle'] ?? 'Trusted by businesses across India.' }}</p>
                </div>
                <div class="swiper testimonials-swiper" data-aos="fade-up">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="testimonial-card {{ $testimonial->is_featured ? 'featured-testimonial' : '' }}"
                                    itemscope itemtype="https://schema.org/Review">
                                    {{-- Star Rating --}}
                                    <div class="stars" aria-label="{{ $testimonial->rating ?? 5 }} out of 5 stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span
                                                class="{{ $i <= ($testimonial->rating ?? 5) ? 'star-filled' : 'star-empty' }}"
                                                aria-hidden="true">★</span>
                                        @endfor
                                    </div>

                                    <p class="review" itemprop="reviewBody">"{{ $testimonial->review }}"</p>

                                    <div class="reviewer user-info">
                                        @if ($testimonial->client_avatar)
                                            <img src="{{ asset('storage/' . $testimonial->client_avatar) }}"
                                                alt="{{ $testimonial->client_name }} — AmanProjects client"
                                                loading="lazy" decoding="async" width="60" height="60"
                                                itemprop="image">
                                        @else
                                            <div class="avatar-initial" aria-hidden="true"
                                                style="width:48px;height:48px;border-radius:50%;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:1.2rem;flex-shrink:0;">
                                                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <strong itemprop="author">{{ $testimonial->client_name }}</strong>
                                            @if ($testimonial->client_designation)
                                                <span
                                                    style="display:block;font-size:.85rem;color:var(--text-muted);">{{ $testimonial->client_designation }}</span>
                                            @endif
                                            @if ($testimonial->client_company)
                                                <span style="display:block;font-size:.8rem;color:var(--text-muted);">@
                                                    {{ $testimonial->client_company }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination" aria-label="Testimonials pagination"></div>
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         FAQ SECTION (DB-driven — Alpine.js accordion)
         - is_active, ordered by sort_order
         ==================================================== --}}
    @if ($faqs->isNotEmpty())
        <section id="faq" class="faq section-padding" aria-label="Frequently Asked Questions about AmanProjects">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['faq_title'] ?? 'Frequently Asked Questions' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['faq_subtitle'] ?? 'Everything you need to know about working with AmanProjects.' }}
                    </p>
                </div>
                <div class="faq-accordion" data-aos="fade-up">
                    @foreach ($faqs as $faq)
                        <div class="faq-item" x-data="{ open: false }">
                            <button @click="open = !open" class="faq-question" :aria-expanded="open"
                                aria-controls="faq-answer-{{ $faq->id }}">
                                {{ $faq->question }}
                                <span x-text="open ? '−' : '+'" aria-hidden="true"></span>
                            </button>
                            <div x-show="open" x-transition class="faq-answer" id="faq-answer-{{ $faq->id }}"
                                role="region">
                                <p>{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         BLOG / CODEBB PREVIEW (DB-driven)
         - is_published = true, latest 3, featured first
         ==================================================== --}}
    @if ($posts->isNotEmpty())
        <section id="blog" class="section-padding bg-light" aria-label="CodeBB — Latest from AmanProjects Blog">
            <div class="container">
                <div class="section-header text-center" data-aos="fade-up">
                    <h2 class="section-title">{{ $settings['blog_title'] ?? 'Latest from CodeBB' }}</h2>
                    <p class="section-subtitle">
                        {{ $settings['blog_subtitle'] ?? 'Tech insights, security tips, and product updates from Bihar.' }}
                    </p>
                </div>
                <div class="services-grid">
                    @foreach ($posts as $post)
                        <article class="blog-card service-card {{ $post->is_featured ? 'featured-post' : '' }}"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" itemscope
                            itemtype="https://schema.org/BlogPosting" aria-label="{{ $post->title }} blog post">

                            @if ($post->thumbnail)
                                <div class="service-image">
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                        alt="{{ $post->title }} — AmanProjects CodeBB blog" loading="lazy"
                                        decoding="async" width="400" height="250" itemprop="image">
                                </div>
                            @endif

                            <div class="service-content">
                                @if ($post->category)
                                    <span class="post-category category-badge">{{ $post->category }}</span>
                                @endif

                                <h3 itemprop="headline">{{ $post->title }}</h3>

                                @if ($post->excerpt)
                                    <p itemprop="description">{{ Str::limit($post->excerpt, 100) }}</p>
                                @endif

                                <div class="post-meta"
                                    style="display:flex;gap:12px;font-size:.8rem;color:var(--text-muted);margin:10px 0;">
                                    @if ($post->published_at)
                                        <span itemprop="datePublished"
                                            content="{{ $post->published_at->toIso8601String() }}">
                                            <i class="fas fa-calendar" aria-hidden="true"></i>
                                            {{ $post->published_at->format('d M Y') }}
                                        </span>
                                    @endif
                                    <span><i class="fas fa-eye" aria-hidden="true"></i> {{ $post->views ?? 0 }}
                                        views</span>
                                </div>

                                <a href="{{ route('blog.show', $post->slug) }}" class="btn-text"
                                    aria-label="Read {{ $post->title }}">
                                    Read More <i class="fas fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif


    {{-- ====================================================
         ABOUT BRIEF / E-E-A-T SECTION (Part 2.4 of map.md)
         ==================================================== --}}
    <section aria-label="About AmanProjects" class="section-padding" id="about-brief" itemscope
        itemtype="https://schema.org/Organization">

        <meta itemprop="name" content="AmanProjects">
        <meta itemprop="url" content="https://amanprojects.com">
        <meta itemprop="foundingLocation" content="Bihar, India">
        <meta itemprop="description"
            content="AmanProjects is a software development company founded by Aman, a Full Stack Laravel Developer and Ethical Hacker from Bihar, India.">

        <div class="container">
            <div class="contact-grid" style="align-items:center;">
                <div data-aos="fade-right">
                    <div class="section-header" style="margin-left:0;text-align:left;">
                        <h2 class="section-title">{{ $settings['about_title'] ?? 'About AmanProjects' }}</h2>
                    </div>
                    <p itemprop="description" style="margin-bottom:20px;color:var(--text-muted);">
                        {!! $settings['about_description_1'] ?? $settings['about_text'] ?? 'Founded by Aman, a Full Stack Laravel Developer and Ethical Hacker with 3+ years of experience building SaaS products and conducting security audits. AmanProjects serves coaching centres, libraries, fintech startups, and SMBs across India with production-grade software solutions.' !!}
                    </p>
                    <div class="hero-stats" style="justify-content:flex-start;">
                        <div class="stat-item">
                            <span class="stat-number">{{ $settings['years_exp'] ?? '3+' }}</span>
                            <span class="stat-label">Years Experience</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $settings['projects_count'] ?? '50+' }}</span>
                            <span class="stat-label">Projects Done</span>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="btn btn-primary" style="margin-top:30px;"
                        id="home-about-cta">
                        Our Full Story <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
                <div data-aos="fade-left">
                    <img src="{{ isset($settings['about_image']) && $settings['about_image'] ? asset('storage/' . $settings['about_image']) : asset('assets/img/about-brief.jpg') }}"
                        alt="Aman — Full Stack Laravel Developer & Ethical Hacker from Bihar India, founder of AmanProjects"
                        loading="lazy" decoding="async" width="600" height="400"
                        style="border-radius:24px;box-shadow:var(--shadow-lg);width:100%;">
                </div>
            </div>
        </div>
    </section>


    {{-- ====================================================
         CONTACT FORM SECTION (stores to ContactInquiry DB)
         ==================================================== --}}
    <section id="contact" class="section-padding bg-light" aria-label="Contact AmanProjects — Send Enquiry" itemscope
        itemtype="https://schema.org/ContactPage">
        <div class="container">
            <div class="section-header text-center" data-aos="fade-up">
                <h2 class="section-title">Get in Touch</h2>
                <p class="section-subtitle">Have a project or need a security audit? We reply within 24 hours.</p>
            </div>
            <div class="contact-grid">
                {{-- Contact Info from settings --}}
                <aside class="contact-info" data-aos="fade-right" aria-label="AmanProjects contact details">
                    <div class="contact-info-card" itemscope itemtype="https://schema.org/Organization">
                        <meta itemprop="name" content="AmanProjects">
                        @if ($settings['phone'] ?? null)
                            <div class="info-item">
                                <div class="info-icon" aria-hidden="true"><i class="fas fa-phone-alt"></i></div>
                                <div class="info-text">
                                    <h3>Phone / WhatsApp</h3>
                                    <p><a href="tel:{{ $settings['phone'] }}"
                                            itemprop="telephone">{{ $settings['phone'] }}</a></p>
                                </div>
                            </div>
                        @endif
                        @if ($settings['email'] ?? null)
                            <div class="info-item">
                                <div class="info-icon" aria-hidden="true"><i class="fas fa-envelope"></i></div>
                                <div class="info-text">
                                    <h3>Email</h3>
                                    <p><a href="mailto:{{ $settings['email'] }}"
                                            itemprop="email">{{ $settings['email'] }}</a></p>
                                </div>
                            </div>
                        @endif
                        @if ($settings['whatsapp'] ?? null)
                            <div class="info-item">
                                <div class="info-icon" aria-hidden="true"><i class="fab fa-whatsapp"></i></div>
                                <div class="info-text">
                                    <h3>WhatsApp</h3>
                                    <p>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}"
                                            target="_blank" rel="noopener noreferrer" aria-label="WhatsApp AmanProjects">
                                            WhatsApp Us
                                        </a>
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="info-text">
                                <h3>Location</h3>
                                <p itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                    <span itemprop="addressRegion">Bihar</span>,
                                    <span itemprop="addressCountry">India</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper" data-aos="fade-left">
                    <div class="contact-info-card">
                        @if (session('success'))
                            <div class="alert-success" role="alert"
                                style="background:#d1fae5;color:#065f46;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
                                <i class="fas fa-check-circle" aria-hidden="true"></i> {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert-error" role="alert"
                                style="background:#fee2e2;color:#991b1b;padding:12px 20px;border-radius:8px;margin-bottom:20px;">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form"
                            aria-label="Contact AmanProjects enquiry form" novalidate>
                            @csrf

                            <div class="form-group">
                                <label for="cf-name">Full Name <span aria-hidden="true">*</span></label>
                                <input type="text" id="cf-name" name="name" value="{{ old('name') }}"
                                    placeholder="Your full name" required aria-required="true">
                                @error('name')
                                    <span class="error" role="alert"
                                        style="color:red;font-size:.85rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cf-email">Email Address <span aria-hidden="true">*</span></label>
                                <input type="email" id="cf-email" name="email" value="{{ old('email') }}"
                                    placeholder="you@example.com" required aria-required="true">
                                @error('email')
                                    <span class="error" role="alert"
                                        style="color:red;font-size:.85rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cf-phone">Phone Number</label>
                                <input type="tel" id="cf-phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="+91 99999 99999">
                            </div>

                            @if ($services->isNotEmpty())
                                <div class="form-group">
                                    <label for="cf-service">Interested Service</label>
                                    <select id="cf-service" name="service_interested">
                                        <option value="">Select Service (Optional)</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->title }}"
                                                {{ old('service_interested') == $service->title ? 'selected' : '' }}>
                                                {{ $service->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="cf-subject">Subject</label>
                                <input type="text" id="cf-subject" name="subject" value="{{ old('subject') }}"
                                    placeholder="e.g. Laravel SaaS Development Enquiry">
                            </div>

                            <div class="form-group">
                                <label for="cf-message">Message <span aria-hidden="true">*</span></label>
                                <textarea id="cf-message" name="message" rows="5"
                                    placeholder="Describe your project or security audit requirements..." required aria-required="true"
                                    style="width:100%;padding:12px 16px;border-radius:10px;border:1px solid #e2e8f0;background:#f8fafc;font-family:var(--font-body);resize:vertical;outline:none;">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="error" role="alert"
                                        style="color:red;font-size:.85rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" id="contact-submit-btn" class="btn btn-primary" style="width:100%;">
                                <i class="fas fa-paper-plane" aria-hidden="true"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ====================================================
         CTA BANNER
         ==================================================== --}}
    <section class="cta-banner section-padding" aria-label="Call to action — Contact AmanProjects">
        <div class="container">
            <div class="cta-card">
                <h2>{{ $settings['cta_headline'] ?? 'Ready to Build Something Secure & Scalable?' }}</h2>
                <p>{{ $settings['cta_subtext'] ?? "Let's discuss your project. Get a free consultation from a Laravel developer who also thinks like a hacker." }}
                </p>
                <div class="cta-btns">
                    <a href="#contact" class="btn btn-primary" id="cta-contact-btn">Get Free Consultation</a>
                    <a href="{{ route('services') }}" class="btn btn-outline" id="cta-services-btn">View All
                        Services</a>
                </div>
            </div>
        </div>
    </section>

@endsection


{{-- ====================================================
     PUSH: FAQ Schema + Product Schema (map.md Part 2.1 / 3.1)
     ==================================================== --}}
@push('schema')
    {{-- FAQ Schema --}}
    @if ($faqs->isNotEmpty())
        <script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($faqs as $faq)
    {
      "@type": "Question",
      "name": "{{ addslashes($faq->question) }}",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "{{ addslashes(strip_tags($faq->answer)) }}"
      }
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ]
}
</script>
    @endif

    {{-- SoftwareApplication Schema for Products --}}
    @if ($products->isNotEmpty())
        <script type="application/ld+json">
[
@foreach($products as $product)
{
  "@@context": "https://schema.org",
  "@type": "SoftwareApplication",
  "name": "{{ $product->name }}",
  "description": "{{ addslashes($product->tagline ?? $product->short_description ?? '') }}",
  "applicationCategory": "BusinessApplication",
  "operatingSystem": "Web Browser",
  "offers": {
    "@type": "Offer",
    "price": "{{ $product->price ?? '0' }}",
    "priceCurrency": "INR",
    "availability": "https://schema.org/InStock"
  },
  "provider": {
    "@id": "https://amanprojects.com/#organization"
  }
  @if(isset($product->demo_url) && $product->demo_url)
  ,"url": "{{ $product->demo_url }}"
  @endif
}{{ !$loop->last ? ',' : '' }}
@endforeach
]
</script>
    @endif
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .card-swiper { width: 100%; height: 250px; }
        .card-swiper .swiper-button-next, .card-swiper .swiper-button-prev { color: var(--primary); transform: scale(0.6); }
        .card-swiper .swiper-pagination-bullet-active { background: var(--primary); }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Hero Swiper
            if (document.querySelector('.hero-swiper')) {
                new Swiper('.hero-swiper', {
                    loop: true,
                    autoplay: { delay: 4000, disableOnInteraction: false },
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' }
                });
            }
            // Testimonials Swiper
            if (document.querySelector('.testimonials-swiper')) {
                new Swiper('.testimonials-swiper', {
                    loop: true,
                    autoplay: { delay: 5000, disableOnInteraction: false },
                    pagination: { el: '.swiper-pagination', clickable: true },
                    breakpoints: { 640: { slidesPerView: 1 }, 768: { slidesPerView: 2, spaceBetween: 20 }, 1024: { slidesPerView: 3, spaceBetween: 30 } }
                });
            }
            // Card Swipers (Products & Projects)
            const cardSwipers = document.querySelectorAll('.card-swiper');
            cardSwipers.forEach(function(swiperEl) {
                new Swiper(swiperEl, {
                    loop: true,
                    pagination: { el: swiperEl.querySelector('.swiper-pagination'), clickable: true },
                    navigation: { nextEl: swiperEl.querySelector('.swiper-button-next'), prevEl: swiperEl.querySelector('.swiper-button-prev') }
                });
            });
        });
    </script>
@endpush
