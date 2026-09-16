<!doctype html>
<html lang="en" translate="no">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $settings['site_name'] ?? 'AmanOS' }} — Admin Desktop</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/os.css') }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/desktop.css') }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/admin.css') }}" />
</head>
<body class="admin-body">

<!-- ===== WELCOME TRANSITION SCREEN ===== -->
<div id="admin-welcome" class="admin-welcome-screen">
  <div class="awelcome-avatar">
    <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="aw1" cx="40%" cy="30%" r="65%">
          <stop offset="0%" stop-color="#fde8c8"/>
          <stop offset="100%" stop-color="#d4956a"/>
        </radialGradient>
        <linearGradient id="aw2" x1="0%" y1="0%" x2="0%" y2="100%">
          <stop offset="0%" stop-color="#5ab4f0"/>
          <stop offset="100%" stop-color="#1565c0"/>
        </linearGradient>
      </defs>
      <ellipse cx="32" cy="56" rx="22" ry="12" fill="url(#aw2)"/>
      <ellipse cx="32" cy="48" rx="17" ry="10" fill="url(#aw2)"/>
      <rect x="27" y="33" width="10" height="9" rx="4" fill="url(#aw1)"/>
      <circle cx="32" cy="27" r="14" fill="url(#aw1)"/>
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
  <div class="awelcome-name">Welcome, {{ Auth::user()->name ?? 'Aman' }}</div>
  <div class="awelcome-role">Administrator</div>
  <div class="boot-spinner">
    <div class="boot-dot"></div><div class="boot-dot"></div><div class="boot-dot"></div>
    <div class="boot-dot"></div><div class="boot-dot"></div>
  </div>
</div>

<!-- ===== ADMIN DESKTOP ===== -->
<div id="admin-desktop" class="desktop admin-desktop--hidden">

  <!-- Desktop Icons -->
  <div class="desktop-icons-area">

    <div class="desktop-icon" data-window="win-dashboard" tabindex="0" aria-label="Dashboard">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs><linearGradient id="dg1" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#64c8ff"/><stop offset="100%" stop-color="#1565c0"/></linearGradient></defs>
          <rect x="3" y="3" width="20" height="20" rx="3" fill="url(#dg1)"/>
          <rect x="25" y="3" width="20" height="9" rx="3" fill="url(#dg1)" opacity=".8"/>
          <rect x="25" y="14" width="20" height="9" rx="3" fill="url(#dg1)" opacity=".6"/>
          <rect x="3" y="25" width="9" height="20" rx="3" fill="url(#dg1)" opacity=".6"/>
          <rect x="14" y="25" width="31" height="20" rx="3" fill="url(#dg1)" opacity=".8"/>
        </svg>
      </div>
      <div class="label">Dashboard</div>
    </div>

    <div class="desktop-icon" data-window="win-users" tabindex="0" aria-label="Users">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs><linearGradient id="ug-a" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#a8d8f8"/><stop offset="100%" stop-color="#1a7bc4"/></linearGradient></defs>
          <circle cx="18" cy="16" r="9" fill="url(#ug-a)"/>
          <ellipse cx="18" cy="36" rx="14" ry="8" fill="url(#ug-a)" opacity=".9"/>
          <circle cx="34" cy="18" r="7" fill="url(#ug-a)" opacity=".7"/>
          <ellipse cx="34" cy="36" rx="10" ry="7" fill="url(#ug-a)" opacity=".5"/>
        </svg>
      </div>
      <div class="label">Users</div>
    </div>

    <div class="desktop-icon" data-window="win-messages" tabindex="0" aria-label="Messages">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs><linearGradient id="mg1" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#a8d8a8"/><stop offset="100%" stop-color="#2e8b2e"/></linearGradient></defs>
          <rect x="4" y="8" width="40" height="28" rx="3" fill="url(#mg1)"/>
          <polygon points="4,8 24,24 44,8" fill="rgba(255,255,255,0.35)"/>
          <rect x="28" y="2" width="18" height="18" rx="9" fill="#e84040"/>
          <text x="37" y="15" text-anchor="middle" font-size="11" font-weight="bold" fill="#fff">{{ $messagesCount }}</text>
        </svg>
      </div>
      <div class="label">Messages</div>
    </div>

    <div class="desktop-icon" data-window="win-analytics" tabindex="0" aria-label="Analytics">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <defs><linearGradient id="ag1" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#ffe066"/><stop offset="100%" stop-color="#c88a10"/></linearGradient></defs>
          <rect x="4" y="4" width="40" height="34" rx="3" fill="rgba(255,255,255,0.1)" stroke="#c88a10" stroke-width="1.5"/>
          <rect x="8" y="28" width="6" height="8" rx="1" fill="url(#ag1)"/>
          <rect x="17" y="20" width="6" height="16" rx="1" fill="url(#ag1)" opacity=".9"/>
          <rect x="26" y="14" width="6" height="22" rx="1" fill="url(#ag1)" opacity=".8"/>
          <rect x="35" y="22" width="6" height="14" rx="1" fill="url(#ag1)" opacity=".7"/>
        </svg>
      </div>
      <div class="label">Analytics</div>
    </div>

    <div class="desktop-icon" data-window="win-files" tabindex="0" aria-label="File Manager">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 12 L4 42 L44 42 L44 16 L22 16 L18 10 L4 10 Z" fill="#ffe066"/>
          <path d="M4 12 L4 42 L44 42 L44 16 L22 16 Z" fill="#ffd020"/>
        </svg>
      </div>
      <div class="label">File Manager</div>
    </div>

    <div class="desktop-icon" data-window="win-settings" tabindex="0" aria-label="Settings">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <path d="M24 4 L28 12 L36 10 L38 18 L46 20 L42 28 L46 36 L38 38 L36 46 L28 44 L24 44 L20 44 L12 46 L10 38 L2 36 L6 28 L2 20 L10 18 L12 10 L20 12 Z" fill="#b0b0b0"/>
          <circle cx="24" cy="24" r="9" fill="#888"/>
          <circle cx="24" cy="24" r="5" fill="#e0e0e0"/>
        </svg>
      </div>
      <div class="label">Settings</div>
    </div>

    <div class="desktop-icon" data-window="win-syslog" tabindex="0" aria-label="System Log">
      <div class="di-img">
        <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
          <rect x="4" y="4" width="40" height="40" rx="4" fill="#0d1a0d"/>
          <rect x="8" y="10" width="24" height="2" rx="1" fill="#00ff41"/>
          <rect x="8" y="15" width="18" height="2" rx="1" fill="#00cc33" opacity=".8"/>
          <rect x="8" y="20" width="28" height="2" rx="1" fill="#00aa22" opacity=".7"/>
          <rect x="8" y="25" width="14" height="2" rx="1" fill="#ffaa00" opacity=".9"/>
          <rect x="8" y="30" width="22" height="2" rx="1" fill="#00cc33" opacity=".6"/>
        </svg>
      </div>
      <div class="label">System Log</div>
    </div>

  </div>

  <!-- ========================
       DASHBOARD WINDOW
       ======================== -->
  <div id="win-dashboard" class="os-window draggable resizable" style="left:180px;top:40px;width:620px;height:440px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><rect x="1" y="1" width="7" height="7" rx="1" fill="#4af"/><rect x="9" y="1" width="6" height="3" rx="0.5" fill="#4af" opacity=".8"/><rect x="1" y="9" width="3" height="6" rx="0.5" fill="#4af" opacity=".6"/><rect x="5" y="9" width="10" height="6" rx="0.5" fill="#4af" opacity=".8"/></svg></div>
      <div class="title-bar-text">Dashboard — Admin Overview</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space admin-scroll">
      <div class="dash-cards">
        <div class="dash-card dash-card--blue">
          <div class="dc-icon">👥</div>
          <div class="dc-val" id="stat-users">{{ $usersCount }}</div>
          <div class="dc-label">Total Users</div>
        </div>
        <div class="dash-card dash-card--green">
          <div class="dc-icon">📧</div>
          <div class="dc-val" id="stat-msgs">{{ $messagesCount }}</div>
          <div class="dc-label">Messages</div>
        </div>
        <div class="dash-card dash-card--yellow">
          <div class="dc-icon">💼</div>
          <div class="dc-val" id="stat-products">{{ $productsCount }}</div>
          <div class="dc-label">Products</div>
        </div>
        <div class="dash-card dash-card--red">
          <div class="dc-icon">⚡</div>
          <div class="dc-val" id="stat-services">{{ $servicesCount }}</div>
          <div class="dc-label">Services</div>
        </div>
      </div>

      <div class="dash-section-title">Weekly Visitors</div>
      <div class="dash-chart-wrap">
        <canvas id="admin-chart" width="560" height="140" style="width:100%;height:140px;display:block;"></canvas>
      </div>

      <div class="dash-section-title">System Status</div>
      <div style="background:rgba(255,255,255,0.5);border:1px solid rgba(0,0,0,0.1);padding:10px;border-radius:4px;margin-bottom:12px;">
        <p style="margin:0 0 4px;font-weight:bold;">AmanOS Engine: <span style="color:green;">&#9679; Active &amp; Running</span></p>
        <p style="margin:0;font-size:12px;color:#555;">Framework: Laravel {{ app()->version() }} &nbsp;|&nbsp; PHP: {{ phpversion() }}</p>
      </div>

      <div class="dash-section-title">Recent Activity</div>
      <table class="admin-table">
        <thead><tr><th>Time</th><th>Event</th><th>User</th><th>Status</th></tr></thead>
        <tbody id="activity-log">
          <tr><td>Now</td><td>Admin Login</td><td>{{ Auth::user()->name }}</td><td><span class="badge badge--green">Success</span></td></tr>
          @foreach($contactInquiries->take(4) as $inquiry)
            <tr><td>{{ $inquiry->created_at->format('H:i') }}</td><td>Contact Inquiry</td><td>{{ $inquiry->name }}</td><td><span class="badge badge--blue">{{ ucfirst($inquiry->status) }}</span></td></tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- ========================
       USERS WINDOW
       ======================== -->
  <div id="win-users" class="os-window draggable resizable closed" style="left:140px;top:60px;width:620px;height:430px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><circle cx="6" cy="5" r="3.5" fill="#a8d8f8"/><ellipse cx="6" cy="13" rx="5" ry="3" fill="#a8d8f8" opacity=".8"/><circle cx="12" cy="6" r="2.5" fill="#a8d8f8" opacity=".6"/></svg></div>
      <div class="title-bar-text">User Management</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body" style="padding:0;display:flex;flex-direction:column;height:calc(100% - 30px);overflow:hidden;">
      <div class="admin-toolbar">
        <button class="admin-btn admin-btn--primary" onclick="openAddUserDialog()">+ Add User</button>
        <input type="text" id="user-search-input" class="admin-search" placeholder="Search users…" oninput="filterUsers(this.value)" />
      </div>
      <div class="admin-scroll" style="flex:1;overflow:auto;">
        <table class="admin-table" id="users-table">
          <thead><tr><th style="width:36px;"></th><th>Name</th><th>Role</th><th>Status</th><th>Last Login</th><th>Actions</th></tr></thead>
          <tbody id="users-tbody">
            {{-- Populated by admin.js renderUsers() --}}
          </tbody>
        </table>
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- Add User Dialog -->
  <div id="dlg-add-user" class="os-window" role="dialog" style="display:none;position:fixed;left:50%;top:50%;transform:translate(-50%,-50%);width:320px;z-index:9998;">
    <div class="title-bar">
      <div class="title-bar-text">Add New User</div>
      <div class="title-bar-controls">
        <button aria-label="Close" onclick="document.getElementById('dlg-add-user').style.display='none'"></button>
      </div>
    </div>
    <div class="window-body has-space">
      <div style="margin-bottom:8px;">
        <label style="display:block;font-size:12px;margin-bottom:3px;">Username</label>
        <input type="text" id="nu-name" style="width:100%;box-sizing:border-box;" placeholder="Enter username" />
      </div>
      <div style="margin-bottom:8px;">
        <label style="display:block;font-size:12px;margin-bottom:3px;">Role</label>
        <select id="nu-role" style="width:100%;box-sizing:border-box;font:12px 'Segoe UI',sans-serif;padding:4px 7px;border:1px solid #bbb;border-radius:3px;">
          <option value="viewer">Viewer</option>
          <option value="editor">Editor</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <div style="margin-bottom:8px;">
        <label style="display:block;font-size:12px;margin-bottom:3px;">Password</label>
        <input type="password" id="nu-pw" style="width:100%;box-sizing:border-box;" placeholder="Min. 4 characters" />
      </div>
      <div id="nu-err" style="color:#c00;font-size:11px;margin-bottom:6px;min-height:14px;"></div>
      <section style="display:flex;gap:6px;justify-content:flex-end;">
        <button class="default admin-btn admin-btn--primary" onclick="addUser()">Create User</button>
        <button onclick="document.getElementById('dlg-add-user').style.display='none'">Cancel</button>
      </section>
    </div>
  </div>

  <!-- ========================
       MESSAGES WINDOW
       ======================== -->
  <div id="win-messages" class="os-window draggable resizable closed" style="left:200px;top:55px;width:610px;height:450px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><rect x="1" y="3" width="14" height="10" rx="1.5" fill="#5abe5a"/><polygon points="1,3 8,9 15,3" fill="rgba(255,255,255,.4)"/></svg></div>
      <div class="title-bar-text">Messages / Contact Submissions</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body" style="padding:0;display:flex;height:calc(100% - 30px);overflow:hidden;">
      <div class="msg-list" id="msg-list">
        {{-- Populated by admin.js renderMessageList() --}}
      </div>
      <div class="msg-detail" id="msg-detail">
        <div class="msg-detail-empty">Select a message to read</div>
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- ========================
       ANALYTICS WINDOW
       ======================== -->
  <div id="win-analytics" class="os-window draggable resizable closed" style="left:160px;top:50px;width:650px;height:470px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><rect x="2" y="8" width="3" height="6" rx="0.5" fill="#ffe066"/><rect x="7" y="5" width="3" height="9" rx="0.5" fill="#ffe066" opacity=".9"/><rect x="12" y="2" width="3" height="12" rx="0.5" fill="#ffe066" opacity=".8"/></svg></div>
      <div class="title-bar-text">Analytics &amp; Traffic</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space admin-scroll">
      <div class="analytics-grid" style="grid-template-columns:repeat(4,1fr);margin-bottom:14px;">
        <div class="analytics-card">
          <div class="analytics-card-title">Page Views</div>
          <div class="analytics-big-num">4,821</div>
          <div class="analytics-trend analytics-trend--up">&#8593; 12% this week</div>
        </div>
        <div class="analytics-card">
          <div class="analytics-card-title">Unique Visitors</div>
          <div class="analytics-big-num">1,204</div>
          <div class="analytics-trend analytics-trend--up">&#8593; 8% this week</div>
        </div>
        <div class="analytics-card">
          <div class="analytics-card-title">Bounce Rate</div>
          <div class="analytics-big-num">34%</div>
          <div class="analytics-trend analytics-trend--down">&#8595; 3% this week</div>
        </div>
        <div class="analytics-card">
          <div class="analytics-card-title">Avg. Session</div>
          <div class="analytics-big-num">2:47</div>
          <div class="analytics-trend analytics-trend--up">&#8593; 22s this week</div>
        </div>
      </div>

      <div class="dash-section-title">Weekly Visitor Chart</div>
      <div class="dash-chart-wrap" style="margin-bottom:14px;">
        <canvas id="admin-chart" width="580" height="160" style="width:100%;height:160px;display:block;"></canvas>
      </div>

      <div class="dash-section-title">Traffic Sources</div>
      <div id="traffic-bars" class="analytics-bar-list"></div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- ========================
       FILE MANAGER WINDOW
       ======================== -->
  <div id="win-files" class="os-window draggable resizable closed" style="left:170px;top:55px;width:580px;height:420px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><path d="M1 4 L1 14 L15 14 L15 6 L7 6 L5 3 Z" fill="#ffe066"/></svg></div>
      <div class="title-bar-text">File Manager</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body" style="padding:0;display:flex;flex-direction:column;height:calc(100% - 30px);overflow:hidden;">
      <div class="fm-toolbar">
        <button class="admin-btn" onclick="fmGoUp()">&#11014; Up</button>
        <div class="fm-path" id="fm-path">/ root</div>
        <button class="admin-btn" onclick="fmNewFolder()">&#128193; New Folder</button>
        <button class="admin-btn" onclick="fmUpload()">&#11014; Upload</button>
      </div>
      <div class="fm-body" id="fm-body">
        <div style="padding:12px;font-size:12px;">&#128193; Loading…</div>
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- ========================
       SETTINGS WINDOW
       ======================== -->
  <div id="win-settings" class="os-window draggable resizable closed" style="left:150px;top:50px;width:540px;height:490px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="3" fill="#ccc"/><path d="M8 1v2M8 13v2M1 8h2M13 8h2M3.2 3.2l1.4 1.4M11.4 11.4l1.4 1.4M3.2 12.8l1.4-1.4M11.4 4.6l1.4-1.4" stroke="#aaa" stroke-width="1.5" stroke-linecap="round"/></svg></div>
      <div class="title-bar-text">Site Settings</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body has-space admin-scroll">
      <form action="{{ route('admin.settings.update') }}" method="POST" id="settings-form">
        @csrf
        <div class="dash-section-title">General</div>
        <div class="settings-group">
          <label>Site Title</label>
          <input type="text" name="settings[site_name]" value="{{ $settings['site_name'] ?? 'AmanProjects' }}" />
        </div>
        <div class="settings-group">
          <label>Admin Email</label>
          <input type="email" name="settings[email]" value="{{ $settings['email'] ?? 'hello@amanprojects.in' }}" />
        </div>
        <div class="settings-group">
          <label>Phone</label>
          <input type="text" name="settings[phone]" value="{{ $settings['phone'] ?? '+91 98765 43210' }}" />
        </div>
        <div class="settings-group">
          <label>Hero Headline</label>
          <input type="text" name="settings[hero_headline]" value="{{ $settings['hero_headline'] ?? 'Building Software That Works For You' }}" />
        </div>
        <div class="settings-group">
          <label>About Title</label>
          <input type="text" name="settings[about_title]" value="{{ $settings['about_title'] ?? "Hi, I'm Aman" }}" />
        </div>

        <div class="dash-section-title" style="margin-top:12px;">Wallpaper</div>
        <div class="settings-group">
          <label>Desktop Theme</label>
          <select name="settings[wallpaper]" id="set-wallpaper">
            @php $wp = $settings['wallpaper'] ?? 'wp-aurora'; @endphp
            <option value="wp-aurora"  {{ $wp === 'wp-aurora'  ? 'selected' : '' }}>Aurora (Default)</option>
            <option value="wp-bliss"   {{ $wp === 'wp-bliss'   ? 'selected' : '' }}>Bliss (Green Hills)</option>
            <option value="wp-dusk"    {{ $wp === 'wp-dusk'    ? 'selected' : '' }}>Dusk (Purple Sunset)</option>
            <option value="wp-night"   {{ $wp === 'wp-night'   ? 'selected' : '' }}>Night Sky</option>
            <option value="wp-forest"  {{ $wp === 'wp-forest'  ? 'selected' : '' }}>Forest Green</option>
            <option value="wp-energy"  {{ $wp === 'wp-energy'  ? 'selected' : '' }}>Energy Blue</option>
          </select>
        </div>

        <div style="margin-top:14px;display:flex;gap:8px;">
          <button type="submit" class="admin-btn admin-btn--primary">&#128190; Save Changes</button>
          <button type="reset">Reset</button>
        </div>
      </form>

      <div class="dash-section-title" style="margin-top:18px;">Change Password</div>
      <div class="settings-group">
        <label>Current Password</label>
        <input type="password" id="set-pw-old" placeholder="Current password" />
      </div>
      <div class="settings-group">
        <label>New Password</label>
        <input type="password" id="set-pw-new" placeholder="Min. 4 characters" />
      </div>
      <div class="settings-group">
        <label>Confirm Password</label>
        <input type="password" id="set-pw-confirm" placeholder="Repeat new password" />
      </div>
      <div id="set-pw-msg" style="font-size:11px;margin-bottom:6px;min-height:14px;margin-left:160px;"></div>
      <div style="margin-left:160px;">
        <button class="admin-btn admin-btn--primary" onclick="changePassword()">Update Password</button>
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

  <!-- ========================
       SYSTEM LOG WINDOW
       ======================== -->
  <div id="win-syslog" class="os-window draggable resizable closed" style="left:190px;top:60px;width:600px;height:420px;">
    <div class="title-bar">
      <div class="title-bar-icon"><svg viewBox="0 0 16 16" fill="none"><rect x="1" y="1" width="14" height="14" rx="2" fill="#0d1a0d"/><rect x="2" y="4" width="8" height="1.5" rx="0.5" fill="#00ff41"/></svg></div>
      <div class="title-bar-text">System Log</div>
      <div class="title-bar-controls">
        <button aria-label="Minimize" title="Minimize"></button>
        <button aria-label="Maximize" title="Maximize"></button>
        <button aria-label="Close" title="Close"></button>
      </div>
    </div>
    <div class="window-body" style="padding:0;display:flex;flex-direction:column;height:calc(100% - 30px);overflow:hidden;">
      <div class="syslog-toolbar">
        <select id="log-filter" onchange="renderLogs()">
          <option value="all">All Levels</option>
          <option value="info">INFO only</option>
          <option value="warn">WARN only</option>
          <option value="error">ERROR only</option>
        </select>
        <button class="admin-btn" onclick="clearLogs()" style="background:#1a2a1a;border-color:#006618;color:#00cc33;min-width:unset;padding:3px 10px;">Clear</button>
        <button class="admin-btn" onclick="exportLogs()" style="background:#1a2a1a;border-color:#006618;color:#00cc33;min-width:unset;padding:3px 10px;">Export</button>
        <div style="flex:1;"></div>
        <span id="stat-logs" style="font-size:10px;color:#4a9a4a;">Live</span>
      </div>
      <div class="syslog-body" id="syslog-body">
        {{-- Populated by admin.js renderLogs() --}}
      </div>
    </div>
    <div class="resize-handle n" data-dir="n"></div><div class="resize-handle s" data-dir="s"></div>
    <div class="resize-handle e" data-dir="e"></div><div class="resize-handle w" data-dir="w"></div>
    <div class="resize-handle nw" data-dir="nw"></div><div class="resize-handle ne" data-dir="ne"></div>
    <div class="resize-handle sw" data-dir="sw"></div><div class="resize-handle se" data-dir="se"></div>
  </div>

</div>{{-- end admin-desktop --}}

<!-- ===== TASKBAR ===== -->
<div id="taskbar" class="taskbar">
  <button id="start-btn" class="start-button" onclick="toggleStartMenu()" title="Start">
    <span class="start-orb"></span>
    <span class="start-label">Start</span>
  </button>

  <div class="quick-launch" id="quick-launch">
    <button class="ql-btn" title="Dashboard" onclick="launchApp('win-dashboard')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="1" y="1" width="8" height="8" rx="1" fill="#4af"/><rect x="11" y="1" width="8" height="3" rx="0.5" fill="#4af" opacity=".8"/><rect x="1" y="11" width="3" height="8" rx="0.5" fill="#4af" opacity=".6"/><rect x="5" y="11" width="14" height="8" rx="0.5" fill="#4af" opacity=".8"/></svg>
    </button>
    <button class="ql-btn" title="Users" onclick="launchApp('win-users')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="6" r="4" fill="#a8d8f8"/><ellipse cx="7" cy="15" rx="6" ry="4" fill="#a8d8f8" opacity=".8"/></svg>
    </button>
    <button class="ql-btn" title="Messages" onclick="launchApp('win-messages')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="1" y="3" width="18" height="13" rx="1.5" fill="#5abe5a"/><polygon points="1,3 10,10 19,3" fill="rgba(255,255,255,.4)"/></svg>
    </button>
    <button class="ql-btn" title="Analytics" onclick="launchApp('win-analytics')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="11" width="3" height="7" rx="0.5" fill="#ffe066"/><rect x="7" y="7" width="3" height="11" rx="0.5" fill="#ffe066" opacity=".9"/><rect x="12" y="3" width="3" height="15" rx="0.5" fill="#ffe066" opacity=".8"/></svg>
    </button>
    <button class="ql-btn" title="Settings" onclick="launchApp('win-settings')">
      <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="3.5" fill="#ccc"/><path d="M10 2v2M10 16v2M2 10h2M16 10h2" stroke="#aaa" stroke-width="1.5" stroke-linecap="round"/></svg>
    </button>
    <div class="ql-sep"></div>
  </div>

  <div id="taskbar-buttons" class="taskbar-buttons"></div>

  <div class="system-tray">
    <div class="tray-icons">
      <span class="admin-tray-badge" title="Admin Mode">&#128737;&#65039;</span>
    </div>
    <div class="tray-clock">
      <div id="tray-time" class="tray-time">12:00</div>
      <div id="tray-date" class="tray-date">Mon 1/1</div>
    </div>
    <button class="show-desktop-btn" id="show-desktop-btn" title="Show Desktop"></button>
  </div>
</div>

<!-- Start Menu (proper two-panel Win7 layout) -->
<div id="start-menu" class="start-menu" aria-hidden="true">
  <div class="start-menu-left">
    <div class="start-user-panel">
      <div class="start-user-avatar">
        <svg viewBox="0 0 40 40" fill="none">
          <defs>
            <radialGradient id="sm-av1" cx="40%" cy="30%" r="65%"><stop offset="0%" stop-color="#fde8c8"/><stop offset="100%" stop-color="#d4956a"/></radialGradient>
            <linearGradient id="sm-av2" x1="0%" y1="0%" x2="0%" y2="100%"><stop offset="0%" stop-color="#5ab4f0"/><stop offset="100%" stop-color="#1565c0"/></linearGradient>
          </defs>
          <ellipse cx="20" cy="36" rx="14" ry="8" fill="url(#sm-av2)"/>
          <rect x="17" y="21" width="6" height="6" rx="2.5" fill="url(#sm-av1)"/>
          <circle cx="20" cy="16" r="9" fill="url(#sm-av1)"/>
          <ellipse cx="20" cy="9" rx="9" ry="5" fill="#5a3010"/>
        </svg>
      </div>
      <span class="start-user-name">{{ Auth::user()->name ?? 'Admin' }} <span style="font-size:10px;opacity:0.6;">(Admin)</span></span>
    </div>
    <div class="start-pinned-divider"></div>
    <ul class="start-app-list">
      <li class="start-app-item" onclick="launchApp('win-dashboard')"><span class="start-app-icon">&#128202;</span><span>Dashboard</span></li>
      <li class="start-app-item" onclick="launchApp('win-users')"><span class="start-app-icon">&#128101;</span><span>User Management</span></li>
      <li class="start-app-item" onclick="launchApp('win-messages')"><span class="start-app-icon">&#128231;</span><span>Messages</span></li>
      <li class="start-app-item" onclick="launchApp('win-analytics')"><span class="start-app-icon">&#128200;</span><span>Analytics</span></li>
      <li class="start-app-item" onclick="launchApp('win-files')"><span class="start-app-icon">&#128193;</span><span>File Manager</span></li>
      <li class="start-app-item" onclick="launchApp('win-syslog')"><span class="start-app-icon">&#128187;</span><span>System Log</span></li>
    </ul>
  </div>
  <div class="start-menu-right">
    <ul class="start-right-list">
      <li onclick="launchApp('win-settings')"><span class="sr-icon">&#9881;&#65039;</span> Settings</li>
      <li onclick="window.open('{{ route('home') }}','_blank')"><span class="sr-icon">&#127760;</span> View Site</li>
      <li class="start-divider"></li>
      <li onclick="confirmShutdown()"><span class="sr-icon">&#128308;</span> Shut Down</li>
      <li onclick="document.getElementById('logout-form').submit();" style="color:#ffaaaa;"><span class="sr-icon">&#128274;</span> Log Out</li>
    </ul>
  </div>
</div>

<!-- Shutdown dialog -->
<div id="shutdown-dialog" class="os-window" role="dialog" style="display:none;position:fixed;left:50%;top:50%;transform:translate(-50%,-50%);width:300px;z-index:9999;">
  <div class="title-bar">
    <div class="title-bar-text">Shut Down AmanOS Admin</div>
    <div class="title-bar-controls">
      <button aria-label="Close" onclick="document.getElementById('shutdown-dialog').style.display='none'"></button>
    </div>
  </div>
  <div class="window-body has-space" style="text-align:center;">
    <p>Are you sure you want to shut down?</p>
    <section style="display:flex;gap:6px;justify-content:center;margin-top:8px;">
      <button class="default" onclick="doShutdown()">Shut Down</button>
      <button onclick="document.getElementById('shutdown-dialog').style.display='none'">Cancel</button>
    </section>
  </div>
</div>
<div id="shutdown-screen" style="display:none;position:fixed;inset:0;background:#000;z-index:99999;align-items:center;justify-content:center;flex-direction:column;"></div>

<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
  @csrf
</form>

{{-- Pass DB contact inquiries into admin.js so it renders real DB messages --}}
<script>
window._DB_MESSAGES = @json($dbMessages);
</script>
<script src="{{ asset('amanos/js/ui.js') }}"></script>
<script src="{{ asset('amanos/js/admin.js') }}"></script>
</body>
</html>
