<!doctype html>
<html lang="en" translate="no">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $settings['site_name'] ?? 'AmanOS' }} — Windows 7 Web OS</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="description" content="{{ $seo['description'] ?? 'AmanOS browser desktop environment' }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/os.css') }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/desktop.css') }}" />
</head>
<body>

<!-- ===== BOOT SCREEN ===== -->
<div id="boot-screen" class="boot-screen" aria-live="polite">
  <div class="boot-logo">
    <svg viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg" class="boot-win-logo">
      <path d="M4 12 L38 7 L38 38 L4 38 Z"  fill="#F25022"/>
      <path d="M42 6 L76 1 L76 38 L42 38 Z" fill="#7FBA00"/>
      <path d="M4 42 L38 42 L38 73 L4 68 Z" fill="#00A4EF"/>
      <path d="M42 42 L76 42 L76 79 L42 74 Z" fill="#FFB900"/>
    </svg>
    <div class="boot-os-name">{{ $settings['site_name'] ?? 'AmanOS' }}</div>
  </div>
  <div class="boot-spinner">
    <div class="boot-dot"></div>
    <div class="boot-dot"></div>
    <div class="boot-dot"></div>
    <div class="boot-dot"></div>
    <div class="boot-dot"></div>
  </div>
</div>

<!-- ===== LOGIN SCREEN ===== -->
<div id="login-screen" class="login-screen hidden" aria-label="Login">
  <div class="login-bg"></div>

  <div class="login-clock-area">
    <div id="login-time" class="login-time">00:00</div>
    <div id="login-date" class="login-date">Monday, January 1</div>
  </div>

  <div id="login-user-select" class="login-panel">
    <h2 class="login-heading">Sign in to {{ $settings['site_name'] ?? 'AmanOS' }}</h2>
    <div class="login-user-cards">

      <button class="login-user-card" id="card-aman" onclick="selectUser('aman')" aria-label="Login as Aman">
        <div class="luc-avatar">
          <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <radialGradient id="av1" cx="40%" cy="30%" r="65%">
                <stop offset="0%" stop-color="#fde8c8"/>
                <stop offset="100%" stop-color="#d4956a"/>
              </radialGradient>
              <linearGradient id="av2" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#5ab4f0"/>
                <stop offset="100%" stop-color="#1565c0"/>
              </linearGradient>
            </defs>
            <ellipse cx="32" cy="56" rx="22" ry="12" fill="url(#av2)"/>
            <ellipse cx="32" cy="48" rx="17" ry="10" fill="url(#av2)"/>
            <rect x="27" y="33" width="10" height="9" rx="4" fill="url(#av1)"/>
            <circle cx="32" cy="27" r="14" fill="url(#av1)"/>
            <ellipse cx="32" cy="15" rx="14" ry="7" fill="#5a3010"/>
            <ellipse cx="19" cy="22" rx="5" ry="9" fill="#5a3010"/>
            <ellipse cx="45" cy="22" rx="5" ry="9" fill="#5a3010"/>
            <ellipse cx="27" cy="27" rx="2.2" ry="2.5" fill="#3a2010"/>
            <ellipse cx="37" cy="27" rx="2.2" ry="2.5" fill="#3a2010"/>
            <circle cx="28" cy="26" r="0.8" fill="#fff"/>
            <circle cx="38" cy="26" r="0.8" fill="#fff"/>
            <path d="M27 31 Q32 35 37 31" stroke="#b07050" stroke-width="1.5" fill="none" stroke-linecap="round"/>
          </svg>
        </div>
        <div class="luc-name">Aman</div>
        <div class="luc-hint">Password protected</div>
      </button>

      <button class="login-user-card" id="card-guest" onclick="selectUser('guest')" aria-label="Login as Guest">
        <div class="luc-avatar luc-avatar--guest">
          <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
            <circle cx="32" cy="32" r="30" fill="rgba(255,255,255,0.08)" stroke="rgba(255,255,255,0.3)" stroke-width="1.5"/>
            <circle cx="32" cy="24" r="12" fill="rgba(255,255,255,0.5)"/>
            <ellipse cx="32" cy="52" rx="19" ry="12" fill="rgba(255,255,255,0.4)"/>
          </svg>
        </div>
        <div class="luc-name">Guest</div>
        <div class="luc-hint">No password needed</div>
      </button>

    </div>
  </div>

  <div id="login-password-panel" class="login-panel hidden">
    <div class="lpanel-avatar">
      <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
        <ellipse cx="32" cy="56" rx="22" ry="12" fill="url(#av2)"/>
        <ellipse cx="32" cy="48" rx="17" ry="10" fill="url(#av2)"/>
        <rect x="27" y="33" width="10" height="9" rx="4" fill="url(#av1)"/>
        <circle cx="32" cy="27" r="14" fill="url(#av1)"/>
        <ellipse cx="32" cy="15" rx="14" ry="7" fill="#5a3010"/>
        <ellipse cx="19" cy="22" rx="5" ry="9" fill="#5a3010"/>
        <ellipse cx="45" cy="22" rx="5" ry="9" fill="#5a3010"/>
        <ellipse cx="27" cy="27" rx="2.2" ry="2.5" fill="#3a2010"/>
        <ellipse cx="37" cy="27" rx="2.2" ry="2.5" fill="#3a2010"/>
        <circle cx="28" cy="26" r="0.8" fill="#fff"/>
        <circle cx="38" cy="26" r="0.8" fill="#fff"/>
        <path d="M27 31 Q32 35 37 31" stroke="#b07050" stroke-width="1.5" fill="none" stroke-linecap="round"/>
      </svg>
    </div>
    <div class="lpanel-name">Aman</div>

    <div class="lpanel-password-row">
      {{-- Hidden email field — populated from DB admin email so doLogin() AJAX knows which email to use --}}
      <input type="hidden" id="login-email-input" value="{{ $adminEmail ?? 'admin@amanprojects.com' }}" />
      <input
        type="password"
        id="login-password-input"
        class="lpanel-input"
        placeholder="Password"
        aria-label="Password"
        onkeydown="handlePasswordKey(event)"
        autocomplete="current-password"
      />
      <button class="lpanel-submit" id="login-submit-btn" onclick="doLogin()" aria-label="Sign in" title="Sign in">
        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 8 L13 8 M9 4 L13 8 L9 12" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>

    <div id="login-error" class="lpanel-error hidden">Incorrect password. Try again.</div>

    <button class="lpanel-back" onclick="backToUserSelect()" aria-label="Back to user selection">
      ← Back
    </button>
  </div>

  <div id="login-welcome" class="login-welcome hidden">
    <div class="lwelcome-avatar">
      <svg id="lwelcome-avatar-svg" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"></svg>
    </div>
    <div id="lwelcome-name" class="lwelcome-name">Welcome</div>
    <div class="boot-spinner lwelcome-spinner">
      <div class="boot-dot"></div>
      <div class="boot-dot"></div>
      <div class="boot-dot"></div>
      <div class="boot-dot"></div>
      <div class="boot-dot"></div>
    </div>
  </div>

</div>

<!-- ===== DESKTOP ===== -->
<div id="desktop" class="desktop">

  <!-- Desktop Icons -->
  <div class="desktop-icons-area">

    <!-- About Us -->
    <div class="desktop-icon" data-window="win-about" tabindex="0" aria-label="About Us">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <radialGradient id="ug2" cx="40%" cy="25%" r="65%">
              <stop offset="0%" stop-color="#fde8c8"/>
              <stop offset="100%" stop-color="#d4956a"/>
            </radialGradient>
            <linearGradient id="ug3" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" stop-color="#5ab4f0"/>
              <stop offset="100%" stop-color="#1565c0"/>
            </linearGradient>
          </defs>
          <ellipse cx="24" cy="42" rx="17" ry="10" fill="url(#ug3)"/>
          <ellipse cx="24" cy="36" rx="13" ry="8" fill="url(#ug3)"/>
          <rect x="20" y="25" width="8" height="7" rx="3" fill="url(#ug2)"/>
          <circle cx="24" cy="20" r="11" fill="url(#ug2)"/>
          <ellipse cx="24" cy="11" rx="11" ry="5" fill="#5a3010"/>
          <ellipse cx="14" cy="17" rx="4" ry="7" fill="#5a3010"/>
          <ellipse cx="34" cy="17" rx="4" ry="7" fill="#5a3010"/>
          <ellipse cx="20" cy="20" rx="1.8" ry="2" fill="#3a2010"/>
          <ellipse cx="28" cy="20" rx="1.8" ry="2" fill="#3a2010"/>
          <path d="M20 24 Q24 27 28 24" stroke="#b07050" stroke-width="1.2" fill="none" stroke-linecap="round"/>
        </svg>
      </div>
      <div class="label">About Us</div>
    </div>

    <!-- Services -->
    <div class="desktop-icon" data-window="win-services" tabindex="0" aria-label="Services">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="mon1" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" stop-color="#8ec8f0"/>
              <stop offset="100%" stop-color="#1a6aad"/>
            </linearGradient>
            <linearGradient id="mon2" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" stop-color="#e8f4ff"/>
              <stop offset="100%" stop-color="#5aa8e8"/>
            </linearGradient>
          </defs>
          <rect x="4" y="4" width="40" height="30" rx="3" fill="url(#mon1)"/>
          <rect x="6" y="6" width="36" height="26" rx="2" fill="#1a4878"/>
          <rect x="8" y="8" width="32" height="22" rx="1" fill="url(#mon2)"/>
          <rect x="20" y="34" width="8" height="5" fill="#888"/>
          <rect x="14" y="39" width="20" height="3" rx="1.5" fill="#888"/>
        </svg>
      </div>
      <div class="label">Services</div>
    </div>

    <!-- Portfolio -->
    <div class="desktop-icon" data-window="win-portfolio" tabindex="0" aria-label="Portfolio">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="bf1" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" stop-color="#f5c842"/>
              <stop offset="100%" stop-color="#c88a10"/>
            </linearGradient>
          </defs>
          <rect x="17" y="6" width="14" height="7" rx="3" fill="#6a3e08"/>
          <rect x="4" y="13" width="40" height="28" rx="3" fill="url(#bf1)"/>
          <rect x="4" y="24" width="40" height="6" fill="#6a3e08"/>
          <rect x="20" y="22" width="8" height="10" rx="2" fill="#6a3e08"/>
        </svg>
      </div>
      <div class="label">Portfolio</div>
    </div>

    <!-- Contact Us -->
    <div class="desktop-icon" data-window="win-contact" tabindex="0" aria-label="Contact Us">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="env1" x1="0%" y1="0%" x2="0%" y2="100%">
              <stop offset="0%" stop-color="#a8d8a8"/>
              <stop offset="100%" stop-color="#2e8b2e"/>
            </linearGradient>
          </defs>
          <rect x="4" y="10" width="40" height="28" rx="3" fill="url(#env1)"/>
          <polygon points="4,10 24,26 44,10" fill="rgba(255,255,255,0.4)"/>
          <text x="24" y="32" text-anchor="middle" font-family="Segoe UI,Arial" font-size="10" font-weight="bold" fill="rgba(0,100,0,0.6)">@</text>
        </svg>
      </div>
      <div class="label">Contact Us</div>
    </div>

    <!-- Blog -->
    <div class="desktop-icon" data-window="win-blog" tabindex="0" aria-label="Blog">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <rect x="8" y="3" width="30" height="38" rx="2" fill="#e0e8f8"/>
          <polygon points="30,3 38,11 30,11" fill="#3a6ab0"/>
          <rect x="12" y="16" width="18" height="2" rx="1" fill="#3a6ab0"/>
          <rect x="12" y="21" width="22" height="1.5" rx="0.75" fill="#7090c0"/>
          <rect x="12" y="25" width="20" height="1.5" rx="0.75" fill="#7090c0"/>
        </svg>
      </div>
      <div class="label">Blog</div>
    </div>

    <!-- My Computer -->
    <div class="desktop-icon" data-window="win-mycomputer" tabindex="0" aria-label="My Computer">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <rect x="4" y="3" width="40" height="30" rx="4" fill="#b0b0b0"/>
          <rect x="8" y="7" width="32" height="22" rx="2" fill="#4898e0"/>
          <rect x="20" y="33" width="8" height="5" fill="#787878"/>
          <rect x="12" y="38" width="24" height="4" rx="2" fill="#787878"/>
        </svg>
      </div>
      <div class="label">My Computer</div>
    </div>

  </div>

  <!-- APP WINDOWS -->

  <!-- About Us Window -->
  <div id="win-about" class="os-window active draggable resizable" style="left:80px;top:60px;width:520px;height:400px;">
    <div class="title-bar">
      <div class="title-bar-icon">
        <svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="5" r="3" fill="#fff"/><path d="M2 14c0-3.314 2.686-6 6-6s6 2.686 6 6" fill="#fff"/></svg>
      </div>
      <div class="title-bar-text">About Us</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space" style="overflow:auto;">
      <div class="about-hero">
        <div class="about-avatar">
          <svg viewBox="0 0 80 80" fill="none"><circle cx="40" cy="28" r="18" fill="#4fc3f7"/><path d="M8 80c0-17.673 14.327-32 32-32s32 14.327 32 32" fill="#0288d1"/></svg>
        </div>
        <div>
          <h2 class="header-group" style="margin:0 0 4px;">{{ $settings['about_title'] ?? 'Hi, I\'m Aman 👋' }}</h2>
          <p class="instruction" style="margin:0;">{{ $settings['about_subtitle'] ?? 'Full-stack Developer & Creative Designer' }}</p>
        </div>
      </div>
      <fieldset>
        <legend>Who We Are</legend>
        <p style="margin:4px 0;">{{ $settings['about_description_1'] ?? 'We are a passionate team of developers and designers building modern web experiences. Our mission is to deliver clean, fast, and beautiful digital products that make a real impact.' }}</p>
        @if(!empty($settings['about_description_2']))
          <p style="margin:4px 0;">{{ $settings['about_description_2'] }}</p>
        @endif
      </fieldset>
      <fieldset>
        <legend>Our Tech Stack</legend>
        <div class="skill-tags">
          <span class="skill-tag">Laravel 12</span>
          <span class="skill-tag">PHP 8.5</span>
          <span class="skill-tag">JavaScript</span>
          <span class="skill-tag">MySQL</span>
          <span class="skill-tag">Tailwind CSS</span>
          <span class="skill-tag">REST APIs</span>
          <span class="skill-tag">Ethical Hacking / VAPT</span>
        </div>
      </fieldset>
      <section style="display:flex;gap:6px;justify-content:flex-end;margin-top:8px;">
        <button class="default" onclick="openWindow('win-contact')">Contact Me</button>
        <button onclick="openWindow('win-portfolio')">See Portfolio</button>
      </section>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- Services Window -->
  <div id="win-services" class="os-window draggable resizable" style="left:160px;top:100px;width:540px;height:420px;">
    <div class="title-bar">
      <div class="title-bar-icon">
        <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="2" width="12" height="9" rx="1" fill="#fff"/><rect x="6" y="11" width="4" height="2" fill="#cce"/><rect x="4" y="13" width="8" height="1" rx="0.5" fill="#cce"/></svg>
      </div>
      <div class="title-bar-text">Our Services</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space" style="overflow:auto;">
      <p class="instruction"><span class="instruction-primary">What We Offer</span><br>{{ $settings['services_subtitle'] ?? 'Premium digital services crafted with care.' }}</p>
      <div class="services-grid">
        @forelse($services as $service)
          <div class="service-card">
            <div class="service-icon">{!! $service->icon ?? '⚡' !!}</div>
            <strong>{{ $service->title }}</strong>
            <p>{{ $service->short_description ?? $service->description }}</p>
          </div>
        @empty
          <div class="service-card"><div class="service-icon">🌐</div><strong>Web Development</strong><p>Custom websites built with modern frameworks.</p></div>
          <div class="service-card"><div class="service-icon">📱</div><strong>Mobile Apps</strong><p>Cross-platform mobile applications.</p></div>
          <div class="service-card"><div class="service-icon">🔒</div><strong>Security Audits</strong><p>VAPT & pen testing for web applications.</p></div>
        @endforelse
      </div>
      <section style="display:flex;gap:6px;justify-content:flex-end;margin-top:8px;">
        <button class="default" onclick="openWindow('win-contact')">Get a Quote</button>
      </section>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- Portfolio Window -->
  <div id="win-portfolio" class="os-window draggable resizable" style="left:200px;top:80px;width:580px;height:450px;">
    <div class="title-bar">
      <div class="title-bar-icon">
        <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="4" width="12" height="9" rx="1" fill="#fff"/><rect x="5" y="2" width="6" height="3" rx="1" fill="#ffd"/></svg>
      </div>
      <div class="title-bar-text">Portfolio / Products</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space" style="overflow:auto;">
      <p class="instruction"><span class="instruction-primary">Our Featured Products & Projects</span></p>
      <div class="portfolio-grid">
        @forelse($products as $product)
          <div class="portfolio-card">
            <div class="portfolio-thumb" style="background:linear-gradient(135deg,#667eea,#764ba2);">
              @if($product->image_url)
                <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:4px;" />
              @else
                <span>{{ $product->category ?? 'Product' }}</span>
              @endif
            </div>
            <p><strong>{{ $product->name }}</strong><br><small>{{ $product->short_description ?? Str::limit($product->description, 50) }}</small></p>
          </div>
        @empty
          <div class="portfolio-card">
            <div class="portfolio-thumb" style="background:linear-gradient(135deg,#667eea,#764ba2);"><span>SaaS Platform</span></div>
            <p><strong>AP Coaching SaaS</strong><br><small>Laravel + MySQL</small></p>
          </div>
          <div class="portfolio-card">
            <div class="portfolio-thumb" style="background:linear-gradient(135deg,#f093fb,#f5576c);"><span>Library Management</span></div>
            <p><strong>AP Library App</strong><br><small>Laravel + Vue</small></p>
          </div>
        @endforelse
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- Contact Us Window -->
  <div id="win-contact" class="os-window draggable resizable" style="left:240px;top:90px;width:440px;height:460px;">
    <div class="title-bar">
      <div class="title-bar-icon">
        <svg viewBox="0 0 16 16" fill="none"><rect x="1" y="3" width="14" height="10" rx="1" fill="#fff"/><path d="M1 5l7 5 7-5" stroke="#6bf" stroke-width="1.5"/></svg>
      </div>
      <div class="title-bar-text">Contact Us</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space" style="overflow:auto;">
      <p class="instruction"><span class="instruction-primary">Get in Touch</span><br>We'd love to hear from you. Send us a message!</p>
      <form id="contactForm" onsubmit="handleContactFormSubmit(event)">
        @csrf
        <div class="form-row">
          <label for="cf-name">Your Name</label>
          <input type="text" id="cf-name" name="name" placeholder="John Doe" required />
        </div>
        <div class="form-row">
          <label for="cf-email">Email Address</label>
          <input type="email" id="cf-email" name="email" placeholder="john@example.com" required />
        </div>
        <div class="form-row">
          <label for="cf-phone">Phone Number</label>
          <input type="text" id="cf-phone" name="phone" placeholder="+91 9876543210" />
        </div>
        <div class="form-row">
          <label for="cf-subject">Subject</label>
          <input type="text" id="cf-subject" name="subject" placeholder="Project Inquiry" />
        </div>
        <div class="form-row">
          <label for="cf-msg">Message</label>
          <textarea id="cf-msg" name="message" rows="4" placeholder="Tell us about your project..." required style="width:100%;box-sizing:border-box;resize:vertical;"></textarea>
        </div>
        <div class="contact-links" style="margin-top:8px;font-size:12px;">
          <a href="mailto:{{ $settings['email'] ?? 'hello@amanprojects.in' }}">📧 {{ $settings['email'] ?? 'hello@amanprojects.in' }}</a>
          <a href="tel:{{ $settings['phone'] ?? '+91 98765 43210' }}">📞 {{ $settings['phone'] ?? '+91 98765 43210' }}</a>
        </div>
        <section style="display:flex;gap:6px;justify-content:flex-end;margin-top:8px;">
          <button type="submit" class="default">Send Message</button>
          <button type="reset">Clear</button>
        </section>
      </form>
      <div id="contact-success" style="display:none;" class="contact-success-msg">
        ✅ Message sent! We'll get back to you soon.
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- Blog Window -->
  <div id="win-blog" class="os-window draggable resizable" style="left:280px;top:80px;width:520px;height:430px;">
    <div class="title-bar">
      <div class="title-bar-icon">
        <svg viewBox="0 0 16 16" fill="none"><rect x="2" y="1" width="12" height="14" rx="1" fill="#fff"/><rect x="4" y="5" width="8" height="1.2" fill="#aaf"/><rect x="4" y="8" width="6" height="1.2" fill="#ccf"/></svg>
      </div>
      <div class="title-bar-text">Blog</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space" style="overflow:auto;">
      <p class="instruction"><span class="instruction-primary">Latest Articles</span></p>
      <div class="blog-list">
        @forelse($posts as $post)
          <div class="blog-post">
            <div class="blog-meta"><span class="blog-cat">{{ $post->category ?? 'Tech' }}</span><span class="blog-date">{{ $post->published_at ? $post->published_at->format('M d, Y') : now()->format('M d, Y') }}</span></div>
            <h3>{{ $post->title }}</h3>
            <p>{{ Str::limit(strip_tags($post->content), 120) }}</p>
          </div>
        @empty
          <div class="blog-post">
            <div class="blog-meta"><span class="blog-cat">Web Dev</span><span class="blog-date">Aug 2026</span></div>
            <h3>Building a Windows 7 UI in Pure CSS</h3>
            <p>A deep dive into recreating the iconic Aero glass design using modern CSS features...</p>
          </div>
          <div class="blog-post">
            <div class="blog-meta"><span class="blog-cat">Security</span><span class="blog-date">Jul 2026</span></div>
            <h3>SaaS Security Best Practices in Laravel 12</h3>
            <p>Essential security configurations and VAPT check points for Laravel apps...</p>
          </div>
        @endforelse
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- My Computer Window -->
  <div id="win-mycomputer" class="os-window draggable resizable" style="left:320px;top:70px;width:480px;height:360px;">
    <div class="title-bar">
      <div class="title-bar-icon">
        <svg viewBox="0 0 16 16" fill="none"><rect x="1" y="2" width="14" height="9" rx="1" fill="#9ec"/><rect x="6" y="11" width="4" height="2" fill="#9ec"/><rect x="4" y="13" width="8" height="1" rx="0.5" fill="#9ec"/></svg>
      </div>
      <div class="title-bar-text">My Computer</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body" style="padding:0;overflow:auto;display:flex;flex-direction:column;">
      <ul role="menubar" class="can-hover">
        <li role="menuitem" tabindex="0">File
          <ul role="menu">
            <li role="menuitem"><button onclick="closeActiveWindow()">Close</button></li>
          </ul>
        </li>
        <li role="menuitem" tabindex="0">Help
          <ul role="menu">
            <li role="menuitem"><button onclick="openWindow('win-about')">About AmanOS</button></li>
          </ul>
        </li>
      </ul>
      <div class="explorer-body">
        <div class="explorer-sidebar">
          <div class="sidebar-section">System Folders</div>
          <ul class="tree-view">
            <li>📁 Desktop</li>
            <li>📁 Documents</li>
            <li>📁 Downloads</li>
            <li>📁 Pictures</li>
          </ul>
        </div>
        <div class="explorer-main">
          <div class="explorer-item" ondblclick="openWindow('win-about')">
            <div class="ei-icon"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><circle cx="16" cy="10" r="7" fill="#4a9ad4"/><ellipse cx="16" cy="25" rx="10" ry="7" fill="#1a6aad"/></svg></div><span>About Us</span>
          </div>
          <div class="explorer-item" ondblclick="openWindow('win-services')">
            <div class="ei-icon"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><rect x="1" y="2" width="30" height="20" rx="2" fill="#5ab0e8"/><rect x="2" y="3" width="28" height="18" rx="1" fill="#d0eaff"/><rect x="12" y="22" width="8" height="3" fill="#888"/><rect x="8" y="25" width="16" height="3" rx="1" fill="#888"/></svg></div><span>Services</span>
          </div>
          <div class="explorer-item" ondblclick="openWindow('win-portfolio')">
            <div class="ei-icon"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><rect x="11" y="2" width="10" height="6" rx="2" fill="#b07010"/><rect x="2" y="8" width="28" height="20" rx="2" fill="#f0b830"/><rect x="2" y="15" width="28" height="5" fill="#b07010"/></svg></div><span>Portfolio</span>
          </div>
          <div class="explorer-item" ondblclick="openWindow('win-contact')">
            <div class="ei-icon"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="6" width="28" height="20" rx="2" fill="#5abe5a"/><polygon points="2,6 16,18 30,6" fill="#90d890"/></svg></div><span>Contact</span>
          </div>
          <div class="explorer-item" ondblclick="openWindow('win-blog')">
            <div class="ei-icon"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><rect x="4" y="1" width="20" height="28" rx="2" fill="#c8d8f0"/><polygon points="18,1 24,1 24,7" fill="#7090c0"/><rect x="7" y="10" width="12" height="2.5" rx="1" fill="#3060a0"/></svg></div><span>Blog</span>
          </div>
        </div>
      </div>
      <div class="status-bar">
        <p class="status-bar-field">5 objects</p>
        <p class="status-bar-field">AmanOS v1.0</p>
        <p class="status-bar-field">Ready</p>
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

</div>

<div id="start-menu" class="start-menu" aria-hidden="true">
  <div class="start-menu-left">
    <div class="start-user-panel">
      <div class="start-user-avatar">
        <svg viewBox="0 0 40 40" fill="none"><circle cx="20" cy="13" r="9" fill="#4fc3f7"/><path d="M4 40c0-8.837 7.163-16 16-16s16 7.163 16 16" fill="#0288d1"/></svg>
      </div>
      <span class="start-user-name">Guest</span>
    </div>
    <div class="start-pinned-divider"></div>
    <ul class="start-app-list">
      <li class="start-app-item" onclick="launchApp('win-about')">
        <span class="start-app-icon">👤</span>
        <span>About Us</span>
      </li>
      <li class="start-app-item" onclick="launchApp('win-services')">
        <span class="start-app-icon">🖥️</span>
        <span>Services</span>
      </li>
      <li class="start-app-item" onclick="launchApp('win-portfolio')">
        <span class="start-app-icon">💼</span>
        <span>Portfolio</span>
      </li>
      <li class="start-app-item" onclick="launchApp('win-contact')">
        <span class="start-app-icon">📧</span>
        <span>Contact Us</span>
      </li>
      <li class="start-app-item" onclick="launchApp('win-blog')">
        <span class="start-app-icon">📝</span>
        <span>Blog</span>
      </li>
      <li class="start-app-item" onclick="launchApp('win-mycomputer')">
        <span class="start-app-icon">💻</span>
        <span>My Computer</span>
      </li>
    </ul>
  </div>
  <div class="start-menu-right">
    <ul class="start-right-list">
      <li onclick="launchApp('win-mycomputer')"><span class="sr-icon">💻</span> My Computer</li>
      <li onclick="launchApp('win-about')"><span class="sr-icon">📄</span> Documents</li>
      <li class="start-divider"></li>
      <li onclick="window.location.href='{{ route('admin.login') }}'"><span class="sr-icon">🔧</span> Control Panel</li>
      <li class="start-divider"></li>
      <li onclick="confirmShutdown()"><span class="sr-icon">🔴</span> Shut Down</li>
    </ul>
  </div>
</div>

<!-- ===== TASKBAR ===== -->
<div id="taskbar" class="taskbar">
  <button id="start-btn" class="start-button" onclick="toggleStartMenu()" title="Start">
    <span class="start-orb"></span>
    <span class="start-label">Start</span>
  </button>

  <div class="quick-launch" id="quick-launch">
    <button class="ql-btn" title="About Us" onclick="launchApp('win-about')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="6" r="4" fill="#a8d8f8"/><ellipse cx="10" cy="16" rx="7" ry="4" fill="#4a9ad4"/></svg>
    </button>
    <button class="ql-btn" title="Services" onclick="launchApp('win-services')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="2" width="16" height="12" rx="1.5" fill="#5ab0e8"/><rect x="3" y="3" width="14" height="10" rx="1" fill="#d0eaff"/></svg>
    </button>
    <button class="ql-btn" title="Portfolio" onclick="launchApp('win-portfolio')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="7" y="2" width="6" height="4" rx="1.5" fill="#c08020"/><rect x="2" y="5" width="16" height="12" rx="1.5" fill="#f0b830"/></svg>
    </button>
    <button class="ql-btn" title="Contact Us" onclick="launchApp('win-contact')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="4" width="16" height="12" rx="1.5" fill="#5abe5a"/><polygon points="2,4 10,11 18,4" fill="#90d890"/></svg>
    </button>
    <button class="ql-btn" title="Blog" onclick="launchApp('win-blog')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="1" width="12" height="16" rx="1.5" fill="#c8d8f0"/><polygon points="11,1 15,5 11,5" fill="#7090c0"/></svg>
    </button>
    <div class="ql-sep"></div>
  </div>

  <div id="taskbar-buttons" class="taskbar-buttons"></div>

  <div class="system-tray">
    <div class="tray-icons">
      <svg title="Network Connected" viewBox="0 0 16 16" style="width:16px;height:16px;cursor:default;" xmlns="http://www.w3.org/2000/svg"><path d="M2 10 Q8 4 14 10" stroke="#8cf" stroke-width="1.5" fill="none"/><path d="M4 12 Q8 7 12 12" stroke="#8cf" stroke-width="1.5" fill="none"/><circle cx="8" cy="14" r="1.5" fill="#8cf"/></svg>
      <svg title="Sound" viewBox="0 0 16 16" style="width:16px;height:16px;cursor:default;" xmlns="http://www.w3.org/2000/svg"><polygon points="3,5 7,5 10,2 10,14 7,11 3,11" fill="#8cf"/><path d="M12 5 Q14 8 12 11" stroke="#8cf" stroke-width="1.2" fill="none"/></svg>
    </div>
    <div class="tray-clock">
      <div id="tray-time" class="tray-time">12:00</div>
      <div id="tray-date" class="tray-date">Mon 1/1</div>
    </div>
    <button class="show-desktop-btn" id="show-desktop-btn" title="Show Desktop"></button>
  </div>
</div>

<!-- Shutdown / User Switch Dialog -->
<div id="shutdown-dialog" class="os-window" role="dialog" style="display:none;position:fixed;left:50%;top:50%;transform:translate(-50%,-50%);width:380px;z-index:9999;">
  <div class="title-bar active">
    <div class="title-bar-text">Shut Down {{ $settings['site_name'] ?? 'AmanOS' }}</div>
    <div class="title-bar-controls">
      <button aria-label="Close" onclick="document.getElementById('shutdown-dialog').style.display='none'"></button>
    </div>
  </div>
  <div class="window-body has-space">
    <p style="margin-bottom:14px;font-size:12px;color:#333;">What do you want the computer to do?</p>

    {{-- User tiles — switch user options --}}
    <div style="display:flex;gap:12px;justify-content:center;margin-bottom:16px;">

      {{-- Guest tile --}}
      <button onclick="switchToGuest()" style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 16px;background:rgba(255,255,255,0.5);border:1px solid rgba(0,0,0,0.15);border-radius:6px;cursor:pointer;width:100px;transition:background 0.15s;" onmouseover="this.style.background='rgba(60,127,177,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.5)'">
        <div style="width:48px;height:48px;border-radius:50%;background:rgba(100,150,200,0.2);border:1px solid rgba(100,150,200,0.4);display:flex;align-items:center;justify-content:center;">
          <svg viewBox="0 0 40 40" width="40" height="40" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="18" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.4)" stroke-width="1"/>
            <circle cx="20" cy="15" r="8" fill="rgba(255,255,255,0.5)"/>
            <ellipse cx="20" cy="33" rx="13" ry="9" fill="rgba(255,255,255,0.4)"/>
          </svg>
        </div>
        <span style="font-size:11px;font-family:'Segoe UI',sans-serif;color:#1a3050;font-weight:600;">Guest</span>
        <span style="font-size:10px;color:#667;font-family:'Segoe UI',sans-serif;">Browse as guest</span>
      </button>

      {{-- Admin tile --}}
      <button onclick="switchToAdmin()" style="display:flex;flex-direction:column;align-items:center;gap:6px;padding:12px 16px;background:rgba(255,255,255,0.5);border:1px solid rgba(0,0,0,0.15);border-radius:6px;cursor:pointer;width:100px;transition:background 0.15s;" onmouseover="this.style.background='rgba(60,127,177,0.12)'" onmouseout="this.style.background='rgba(255,255,255,0.5)'">
        <div style="width:48px;height:48px;border-radius:50%;overflow:hidden;border:2px solid rgba(90,180,240,0.6);background:linear-gradient(135deg,#1a4a80,#0d2444);">
          <svg viewBox="0 0 64 64" width="48" height="48" xmlns="http://www.w3.org/2000/svg">
            <defs>
              <radialGradient id="sd-av1" cx="40%" cy="30%" r="65%"><stop offset="0%" stop-color="#fde8c8"/><stop offset="100%" stop-color="#d4956a"/></radialGradient>
              <linearGradient id="sd-av2" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#5ab4f0"/><stop offset="100%" stop-color="#1565c0"/></linearGradient>
            </defs>
            <ellipse cx="32" cy="56" rx="22" ry="12" fill="url(#sd-av2)"/>
            <rect x="27" y="33" width="10" height="9" rx="4" fill="url(#sd-av1)"/>
            <circle cx="32" cy="27" r="14" fill="url(#sd-av1)"/>
            <ellipse cx="32" cy="15" rx="14" ry="7" fill="#5a3010"/>
          </svg>
        </div>
        <span style="font-size:11px;font-family:'Segoe UI',sans-serif;color:#1a3050;font-weight:600;">Admin</span>
        <span style="font-size:10px;color:#667;font-family:'Segoe UI',sans-serif;">Aman Login</span>
      </button>

    </div>

    <div style="border-top:1px solid rgba(0,0,0,0.1);padding-top:10px;display:flex;justify-content:space-between;align-items:center;">
      <span style="font-size:11px;color:#666;">Or:</span>
      <div style="display:flex;gap:6px;">
        <button onclick="doShutdown()">&#x1F534; Shut Down</button>
        <button onclick="document.getElementById('shutdown-dialog').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div id="shutdown-screen" style="display:none;position:fixed;inset:0;background:#000;z-index:99999;">
  <div style="color:#fff;font-size:18pt;font-family:'Segoe UI',sans-serif;margin-bottom:16px;">Shutting down...</div>
</div>

<!-- Right-click Context Menu -->
<div id="ctx-menu" class="ctx-menu">
  <div class="ctx-item" onclick="sortDesktopIcons()">Sort Icons by Name</div>
  <div class="ctx-item" onclick="refreshDesktop()">Refresh</div>
  <div class="ctx-sep"></div>
  <div class="ctx-item" onclick="openWallpaperPicker()">Personalize / Wallpaper…</div>
  <div class="ctx-sep"></div>
  <div class="ctx-item" onclick="launchApp('win-mycomputer')">My Computer</div>
</div>

<!-- Wallpaper Picker Panel -->
<div id="wp-picker" class="wp-picker">
  <div class="wp-picker-title">
    <span>Choose Wallpaper</span>
    <button onclick="document.getElementById('wp-picker').classList.remove('open')">✕</button>
  </div>
  <div class="wp-grid">
    <div class="wp-swatch wp-aurora-swatch" data-wp="wp-aurora" onclick="setWallpaper('wp-aurora',this)" title="Aurora"><span>Aurora</span></div>
    <div class="wp-swatch wp-bliss-swatch"  data-wp="wp-bliss"  onclick="setWallpaper('wp-bliss',this)"  title="Bliss"><span>Bliss</span></div>
    <div class="wp-swatch wp-dusk-swatch"   data-wp="wp-dusk"   onclick="setWallpaper('wp-dusk',this)"   title="Dusk"><span>Dusk</span></div>
    <div class="wp-swatch wp-night-swatch"  data-wp="wp-night"  onclick="setWallpaper('wp-night',this)"  title="Night"><span>Night</span></div>
    <div class="wp-swatch wp-forest-swatch" data-wp="wp-forest" onclick="setWallpaper('wp-forest',this)" title="Forest"><span>Forest</span></div>
    <div class="wp-swatch wp-energy-swatch" data-wp="wp-energy" onclick="setWallpaper('wp-energy',this)" title="Energy"><span>Energy</span></div>
  </div>
</div>

<script src="{{ asset('amanos/js/ui.js') }}"></script>
<script>
function handleContactFormSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);

    fetch("{{ route('contact.submit') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Accept": "application/json"
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            form.reset();
            document.getElementById('contact-success').style.display = 'block';
            document.getElementById('contact-success').innerText = '✅ ' + data.message;
        }
    })
    .catch(err => {
        form.submit();
    });
}

/** Shutdown dialog: switch to Guest mode — close dialog and enter guest desktop */
function switchToGuest() {
  document.getElementById('shutdown-dialog').style.display = 'none';
  // If still on login screen, just enter the desktop as guest
  const desktop = document.getElementById('desktop');
  if (desktop) {
    const loginScreen = document.getElementById('login-screen');
    if (loginScreen && !loginScreen.classList.contains('hidden')) {
      // Animate welcome for guest then enter desktop
      showWelcome('guest', 'Guest');
    }
    // Already on desktop — nothing to do
  }
}

/** Shutdown dialog: switch to Admin — navigate to the Laravel admin login page */
function switchToAdmin() {
  document.getElementById('shutdown-dialog').style.display = 'none';
  window.location.href = '{{ route('admin.login') }}';
}
</script>
</body>
</html>
