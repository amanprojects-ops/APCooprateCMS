@extends('layouts.frontend')

@section('content')
    {{-- Page Banner --}}
    <section class="page-banner" aria-label="About AmanProjects page banner">
        <div class="container">
            <h1>About AmanProjects</h1>
            <p>Security-first software development company founded by a Full Stack Laravel Developer and Ethical Hacker from Bihar, India.</p>
        </div>
    </section>

    {{-- Who We Are (Part 2.4: E-E-A-T, itemscope/Organization) --}}
    <section class="section-padding"
             id="about"
             aria-label="About AmanProjects — Founded by Aman, Laravel Developer & Ethical Hacker"
             itemscope
             itemtype="https://schema.org/Organization">

        <meta itemprop="name" content="AmanProjects">
        <meta itemprop="url" content="https://amanprojects.com">
        <meta itemprop="foundingLocation" content="Bihar, India">
        <meta itemprop="foundingDate" content="2021">
        <meta itemprop="description" content="AmanProjects is a software development company founded by Aman, a Full Stack Laravel Developer and Ethical Hacker from Bihar, India. Specializing in SaaS development, cybersecurity audits, and custom web applications.">

        <div class="container">
            <div class="contact-grid" style="align-items: center;">
                <div class="about-image">
                    <img src="{{ isset($settings['about_image']) && $settings['about_image'] ? asset('storage/' . $settings['about_image']) : asset('assets/img/about.jpg') }}"
                         alt="Aman — Full Stack Laravel Developer & Ethical Hacker from Bihar India, founder of AmanProjects"
                         loading="lazy" decoding="async"
                         width="600" height="500"
                         style="border-radius: 24px; box-shadow: var(--shadow-lg);"
                         itemprop="image">
                </div>
                <div class="about-content">
                    <div class="section-header" style="margin-left: 0; text-align: left;">
                        <h2 class="section-title">{{ $settings['about_title'] ?? 'Who We Are' }}</h2>
                        <p>
                            {!! $settings['about_subtitle'] ?? 'Founded in 2021, AmanProjects was built with a single mission: to deliver <strong>enterprise-grade software at startup costs</strong> to Indian businesses.' !!}
                        </p>
                    </div>
                    <p itemprop="description" style="margin-bottom: 20px; color: var(--text-muted);">
                        {!! $settings['about_description_1'] ?? 'Founded by <strong itemprop="founder">Aman</strong>, a Full Stack Laravel Developer and Ethical Hacker with <strong>3+ years of experience</strong> building SaaS products and conducting security audits. AmanProjects serves coaching centres, libraries, fintech startups, and SMBs across India with production-grade software solutions.' !!}
                    </p>
                    <p style="margin-bottom: 30px; color: var(--text-muted);">
                        {!! $settings['about_description_2'] ?? 'We combine deep development expertise with hands-on ethical hacking knowledge — meaning every product we build is designed to be <strong>secure by default</strong>, not as an afterthought.' !!}
                    </p>
                    <div class="hero-stats" style="justify-content: flex-start;">
                        <div class="stat-item">
                            <span class="stat-number">3+</span>
                            <span class="stat-label">Years of Experience</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Projects Delivered</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">10+</span>
                            <span class="stat-label">Security Audits</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Core Values --}}
    <section class="section-padding bg-light" aria-label="AmanProjects Core Values">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Our Core Values</h2>
                <p class="section-subtitle">The principles that drive every line of code we write at AmanProjects.</p>
            </div>
            <div class="features-grid">
                <article class="feature-card" aria-label="Security-First value">
                    <div class="feature-icon"><i class="fas fa-shield-alt" aria-hidden="true"></i></div>
                    <h3>Security First</h3>
                    <p>We never bolt on security at the end. Every application is built by an ethical hacker who thinks offensively from day one.</p>
                </article>
                <article class="feature-card" aria-label="Transparency value">
                    <div class="feature-icon"><i class="fas fa-handshake" aria-hidden="true"></i></div>
                    <h3>Transparency</h3>
                    <p>Clear communication, honest timelines, and transparent pricing. No hidden costs, no surprises.</p>
                </article>
                <article class="feature-card" aria-label="Innovation value">
                    <div class="feature-icon"><i class="fas fa-rocket" aria-hidden="true"></i></div>
                    <h3>Continuous Innovation</h3>
                    <p>We stay ahead of the technology curve — Laravel 12, modern DevOps, and evolving cybersecurity techniques.</p>
                </article>
            </div>
        </div>
    </section>

    {{-- Technology Stack --}}
    <section class="section-padding" aria-label="AmanProjects Technology Stack">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Our Technology Stack</h2>
                <p class="section-subtitle">Battle-tested tools we use to build secure, scalable applications.</p>
            </div>
            <div class="features-grid">
                @if(isset($techStacks) && $techStacks->isNotEmpty())
                    @foreach($techStacks as $tech)
                    <article class="feature-card text-center" aria-label="{{ $tech->name }} technology">
                        @if($tech->logo)
                        <div class="feature-icon">
                            <img src="{{ asset('storage/'.$tech->logo) }}"
                                 alt="{{ $tech->name }} — Technology used by AmanProjects"
                                 loading="lazy" decoding="async"
                                 width="40" height="40">
                        </div>
                        @else
                        <div class="feature-icon"><i class="fas fa-code" aria-hidden="true"></i></div>
                        @endif
                        <h3>{{ $tech->name }}</h3>
                        @if($tech->description)
                        <p>{{ $tech->description }}</p>
                        @endif
                    </article>
                    @endforeach
                @else
                    <article class="feature-card text-center" aria-label="Laravel technology">
                        <div class="feature-icon"><i class="fab fa-laravel" aria-hidden="true"></i></div>
                        <h3>Laravel 12</h3>
                        <p>The PHP framework for web artisans — our primary tool for robust backend development.</p>
                    </article>
                    <article class="feature-card text-center" aria-label="MySQL technology">
                        <div class="feature-icon"><i class="fas fa-database" aria-hidden="true"></i></div>
                        <h3>MySQL &amp; Redis</h3>
                        <p>Relational database design and caching for performant, data-driven applications.</p>
                    </article>
                    <article class="feature-card text-center" aria-label="Security tools">
                        <div class="feature-icon"><i class="fas fa-bug" aria-hidden="true"></i></div>
                        <h3>Burp Suite / Nmap</h3>
                        <p>Industry-standard penetration testing tools for comprehensive security audits.</p>
                    </article>
                @endif
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-banner section-padding" aria-label="Contact AmanProjects call to action">
        <div class="container">
            <div class="cta-card">
                <h2>Let's Build Something Great Together</h2>
                <p>Whether you need a SaaS product, a corporate website, or a security audit — we're ready to help.</p>
                <div class="cta-btns">
                    <a href="{{ route('contact') }}" class="btn btn-primary" id="about-cta-contact">Get in Touch</a>
                    <a href="{{ route('services') }}" class="btn btn-outline" id="about-cta-services">Our Services</a>
                </div>
            </div>
        </div>
    </section>
@endsection
