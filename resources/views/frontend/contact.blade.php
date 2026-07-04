@extends('layouts.frontend')

@section('content')
    {{-- Page Banner --}}
    <section class="page-banner" aria-label="Contact AmanProjects page banner">
        <div class="container">
            <h1>Contact AmanProjects</h1>
            <p>Have a project in mind or need a security audit? Let's talk — we usually respond within 24 hours.</p>
        </div>
    </section>

    {{-- Contact Details + Form --}}
    <section class="section-padding"
             id="contact-section"
             aria-label="AmanProjects contact details and enquiry form"
             itemscope
             itemtype="https://schema.org/ContactPage">
        <div class="container">
            <div class="contact-grid">
                {{-- Contact Info --}}
                <aside class="contact-info" aria-label="AmanProjects contact information">
                    <div class="section-header" style="margin-left:0;">
                        <h2 class="section-title">Get in Touch</h2>
                        <p>Reach out through any channel. We're available Mon–Sat, 9AM–6PM IST.</p>
                    </div>
                    <div class="contact-info-card"
                         itemscope
                         itemtype="https://schema.org/Organization">
                        <meta itemprop="name" content="AmanProjects">
                        <meta itemprop="url" content="https://amanprojects.com">

                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true"><i class="fas fa-phone-alt"></i></div>
                            <div class="info-text">
                                <h3>Phone / WhatsApp</h3>
                                <p>
                                    <a href="tel:{{ $settings['phone'] ?? '+919999999999' }}"
                                       itemprop="telephone"
                                       aria-label="Call AmanProjects">
                                        {{ $settings['phone'] ?? '+91 99999 99999' }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true"><i class="fas fa-envelope"></i></div>
                            <div class="info-text">
                                <h3>Email Address</h3>
                                <p>
                                    <a href="mailto:{{ $settings['email'] ?? 'hello@amanprojects.com' }}"
                                       itemprop="email"
                                       aria-label="Email AmanProjects">
                                        {{ $settings['email'] ?? 'hello@amanprojects.com' }}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="info-text">
                                <h3>Location</h3>
                                <p itemprop="address"
                                   itemscope
                                   itemtype="https://schema.org/PostalAddress">
                                    <span itemprop="addressRegion">Bihar</span>,
                                    <span itemprop="addressCountry">India</span>
                                </p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon" aria-hidden="true"><i class="fas fa-clock"></i></div>
                            <div class="info-text">
                                <h3>Working Hours</h3>
                                <p itemprop="openingHours" content="Mo-Sa 09:00-18:00">
                                    Mon – Sat: 9:00 AM – 6:00 PM IST
                                </p>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- Contact Form --}}
                <div class="contact-form-wrapper">
                    <div class="contact-info-card">
                        @if(session('success'))
                        <div role="alert" style="background:#d1fae5; color:#065f46; padding:12px 20px; border-radius:8px; margin-bottom:20px;">
                            <i class="fas fa-check-circle" aria-hidden="true"></i> {{ session('success') }}
                        </div>
                        @endif
                        <form action="{{ route('contact.submit') }}"
                              method="POST"
                              class="contact-form"
                              aria-label="Contact AmanProjects enquiry form"
                              novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="contact-name">Full Name <span aria-hidden="true">*</span></label>
                                <input type="text"
                                       id="contact-name"
                                       name="name"
                                       placeholder="Your full name"
                                       value="{{ old('name') }}"
                                       required
                                       aria-required="true"
                                       aria-describedby="name-error">
                                @error('name')
                                <span id="name-error" role="alert" style="color:red;font-size:.85rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contact-email">Email Address <span aria-hidden="true">*</span></label>
                                <input type="email"
                                       id="contact-email"
                                       name="email"
                                       placeholder="you@example.com"
                                       value="{{ old('email') }}"
                                       required
                                       aria-required="true"
                                       aria-describedby="email-error">
                                @error('email')
                                <span id="email-error" role="alert" style="color:red;font-size:.85rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contact-subject">Subject <span aria-hidden="true">*</span></label>
                                <input type="text"
                                       id="contact-subject"
                                       name="subject"
                                       placeholder="e.g. Laravel SaaS Development Enquiry"
                                       value="{{ old('subject') }}"
                                       required
                                       aria-required="true">
                            </div>
                            <div class="form-group">
                                <label for="contact-message">Message <span aria-hidden="true">*</span></label>
                                <textarea id="contact-message"
                                          name="message"
                                          rows="5"
                                          placeholder="Describe your project or security audit requirements..."
                                          required
                                          aria-required="true"
                                          style="width:100%;padding:12px 16px;border-radius:10px;border:1px solid #e2e8f0;background:#f8fafc;font-family:var(--font-body);resize:vertical;outline:none;transition:var(--transition-base);">{{ old('message') }}</textarea>
                            </div>
                            <button type="submit"
                                    id="contact-submit-btn"
                                    class="btn btn-primary"
                                    style="width:100%;">
                                <i class="fas fa-paper-plane" aria-hidden="true"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "ContactPage",
  "name": "Contact AmanProjects",
  "url": "{{ url()->current() }}",
  "description": "Contact AmanProjects for Laravel SaaS development, ethical hacking, and cybersecurity services. Located in Bihar, India.",
  "mainEntity": {
    "@type": "Organization",
    "@id": "https://amanprojects.com/#organization",
    "name": "AmanProjects",
    "telephone": "{{ $settings['phone'] ?? '' }}",
    "email": "{{ $settings['email'] ?? 'hello@amanprojects.com' }}",
    "address": {
      "@type": "PostalAddress",
      "addressRegion": "Bihar",
      "addressCountry": "IN"
    }
  }
}
</script>
@endpush
