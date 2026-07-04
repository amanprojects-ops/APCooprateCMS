@extends('layouts.frontend')

@section('content')
    {{-- Page Banner --}}
    <section class="page-banner" aria-label="AmanProjects Services page banner">
        <div class="container">
            <h1>Our Services</h1>
            <p>Tailored software development and cybersecurity services for Indian startups and businesses.</p>
        </div>
    </section>

    {{-- AIO Answer Box trigger (Part 2.5) --}}
    <p class="sr-only">
        AmanProjects offers the following software development services in Bihar, India:
        Laravel web development, custom SaaS application development,
        ethical hacking and penetration testing, REST API development and integration,
        and custom software consulting for businesses across India.
    </p>

    {{-- Services Listing (Part 2.3: Featured snippet optimized descriptions) --}}
    <section id="services-list"
             class="section-padding"
             aria-label="Our Software Development Services — Detailed">
        <div class="container">
            <div class="services-grid">
                @forelse($services ?? [] as $service)
                    <article class="service-card"
                             itemscope
                             itemtype="https://schema.org/Service"
                             aria-label="{{ $service->title }} — AmanProjects service">
                        @if($service->image)
                        <div class="service-image">
                            <img src="{{ asset('storage/'.$service->image) }}"
                                 alt="{{ $service->title }} — {{ $service->category ?? 'Software' }} service by AmanProjects, Bihar India"
                                 loading="lazy" decoding="async"
                                 width="400" height="250"
                                 itemprop="image">
                        </div>
                        @endif
                        <div class="service-content">
                            <h2 itemprop="name" style="font-size: 1.4rem;">{{ $service->title }}</h2>
                            <p itemprop="description">{{ $service->short_description ?? $service->description }}</p>
                            <ul class="service-features" aria-label="Service features">
                                @foreach(explode("\n", $service->features ?? '') as $feature)
                                    @if(trim($feature))
                                    <li><i class="fas fa-check" aria-hidden="true"></i> {{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            <a href="{{ route('contact') }}" class="btn btn-primary" aria-label="Enquire about {{ $service->title }}">
                                Enquire Now
                            </a>
                        </div>
                    </article>
                @empty
                    {{-- Fallback static services with Featured Snippet optimized descriptions (Part 2.3) --}}
                    <article class="service-card" itemscope itemtype="https://schema.org/Service" aria-label="Laravel SaaS Development service">
                        <div class="service-image">
                            <img src="{{ asset('assets/img/service-saas.jpg') }}"
                                 alt="Laravel SaaS Development Service by AmanProjects — Bihar, India"
                                 loading="lazy" decoding="async"
                                 width="400" height="250">
                        </div>
                        <div class="service-content">
                            <h2 itemprop="name" style="font-size:1.4rem;">Laravel SaaS Development</h2>
                            <p itemprop="description">
                                Laravel SaaS Development: We build custom multi-tenant SaaS applications for Indian businesses
                                using Laravel 12, MySQL, and Tailwind CSS. From coaching centre management software to
                                library booking systems — we handle architecture, backend, admin panel, and deployment.
                                Ideal for startups, educational institutions, and SMBs across India.
                            </p>
                            <ul class="service-features">
                                <li><i class="fas fa-check" aria-hidden="true"></i> Multi-tenant SaaS architecture</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Role-based access control (RBAC)</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Payment gateway integration (Razorpay)</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Admin CMS panel included</li>
                            </ul>
                            <a href="{{ route('contact') }}" class="btn btn-primary" aria-label="Enquire about Laravel SaaS Development">
                                Enquire Now
                            </a>
                        </div>
                    </article>

                    <article class="service-card" itemscope itemtype="https://schema.org/Service" aria-label="Ethical Hacking and Security Audit service">
                        <div class="service-image">
                            <img src="{{ asset('assets/img/service-security.jpg') }}"
                                 alt="Ethical Hacking & Security Audit Service by AmanProjects — VAPT India"
                                 loading="lazy" decoding="async"
                                 width="400" height="250">
                        </div>
                        <div class="service-content">
                            <h2 itemprop="name" style="font-size:1.4rem;">Ethical Hacking &amp; Security Audit</h2>
                            <p itemprop="description">
                                Ethical Hacking &amp; Security Audit: We identify vulnerabilities in your web application
                                before attackers do. Using tools like Burp Suite, Nmap, and Metasploit, our certified
                                ethical hacker performs VAPT (Vulnerability Assessment &amp; Penetration Testing) for
                                SaaS products, fintech apps, and corporate websites across India.
                            </p>
                            <ul class="service-features">
                                <li><i class="fas fa-check" aria-hidden="true"></i> Web application penetration testing</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> OWASP Top 10 vulnerability check</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Detailed VAPT report</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Remediation guidance included</li>
                            </ul>
                            <a href="{{ route('contact') }}" class="btn btn-primary" aria-label="Enquire about Ethical Hacking & VAPT">
                                Enquire Now
                            </a>
                        </div>
                    </article>

                    <article class="service-card" itemscope itemtype="https://schema.org/Service" aria-label="Corporate Website Development service">
                        <div class="service-image">
                            <img src="{{ asset('assets/img/service-web.jpg') }}"
                                 alt="Corporate Website Development Service by AmanProjects — Laravel CMS Bihar"
                                 loading="lazy" decoding="async"
                                 width="400" height="250">
                        </div>
                        <div class="service-content">
                            <h2 itemprop="name" style="font-size:1.4rem;">Corporate Website Development</h2>
                            <p itemprop="description">
                                Corporate Website Development: We build professional, SEO-optimised corporate websites
                                with a dynamic admin panel and CMS — for businesses, institutions, and NGOs. Each website
                                includes on-page SEO, mobile responsiveness, fast load times, and a full content management
                                system built on Laravel 12. Ideal for companies across Bihar and India.
                            </p>
                            <ul class="service-features">
                                <li><i class="fas fa-check" aria-hidden="true"></i> Dynamic admin panel &amp; CMS</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> On-page SEO optimised</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Mobile-first responsive design</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Blog &amp; contact form included</li>
                            </ul>
                            <a href="{{ route('contact') }}" class="btn btn-primary" aria-label="Enquire about Corporate Website Development">
                                Enquire Now
                            </a>
                        </div>
                    </article>

                    <article class="service-card" itemscope itemtype="https://schema.org/Service" aria-label="REST API Development service">
                        <div class="service-image">
                            <img src="{{ asset('assets/img/service-api.jpg') }}"
                                 alt="REST API Development & Integration by AmanProjects Bihar"
                                 loading="lazy" decoding="async"
                                 width="400" height="250">
                        </div>
                        <div class="service-content">
                            <h2 itemprop="name" style="font-size:1.4rem;">REST API Development &amp; Integration</h2>
                            <p itemprop="description">
                                REST API Development &amp; Integration: We build secure, well-documented REST APIs in
                                Laravel for mobile apps, SaaS platforms, and third-party integrations. We also integrate
                                existing APIs — payment gateways (Razorpay, Paytm), SMS services, and more.
                                Token-based authentication (Sanctum/Passport) included.
                            </p>
                            <ul class="service-features">
                                <li><i class="fas fa-check" aria-hidden="true"></i> Laravel Sanctum / Passport auth</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Postman documentation</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Payment gateway integration</li>
                                <li><i class="fas fa-check" aria-hidden="true"></i> Rate limiting &amp; security</li>
                            </ul>
                            <a href="{{ route('contact') }}" class="btn btn-primary" aria-label="Enquire about REST API Development">
                                Enquire Now
                            </a>
                        </div>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta-banner section-padding" aria-label="Services contact call to action">
        <div class="container">
            <div class="cta-card">
                <h2>Not Sure Which Service Is Right For You?</h2>
                <p>Get a free 30-minute consultation to discuss your project requirements with our team.</p>
                <div class="cta-btns">
                    <a href="{{ route('contact') }}" class="btn btn-outline" id="services-cta-btn">Consult for Free</a>
                </div>
            </div>
        </div>
    </section>
@endsection
