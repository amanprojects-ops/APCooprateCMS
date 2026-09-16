<!doctype html>
<html lang="en" translate="no">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AmanOS Admin — Login</title>
  <link rel="stylesheet" href="{{ asset('amanos/css/os.css') }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/desktop.css') }}" />
  <link rel="stylesheet" href="{{ asset('amanos/css/admin.css') }}" />
</head>
<body class="admin-body">

<div id="login-screen" class="login-screen" aria-label="Admin Login">
  <div class="login-bg"></div>

  <div class="login-clock-area">
    <div id="login-time" class="login-time">00:00</div>
    <div id="login-date" class="login-date">Monday, January 1</div>
  </div>

  <div class="login-panel">
    <div class="lpanel-avatar">
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
    <div class="lpanel-name">AmanOS Administrator</div>

    <form method="POST" action="{{ route('admin.login.post') }}" style="width:100%;max-width:280px;margin:0 auto;">
      @csrf
      <div style="margin-bottom:10px;">
        <input
          type="email"
          name="email"
          value="{{ old('email', 'admin@amanprojects.com') }}"
          class="lpanel-input"
          placeholder="Email Address"
          required
          style="width:100%;box-sizing:border-box;"
        />
      </div>
      <div class="lpanel-password-row" style="margin-bottom:10px;">
        <input
          type="password"
          name="password"
          class="lpanel-input"
          placeholder="Password"
          required
          style="width:100%;"
        />
        <button type="submit" class="lpanel-submit" aria-label="Sign in" title="Sign in">
          <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 8 L13 8 M9 4 L13 8 L9 12" stroke="#fff" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>

      @if($errors->any())
        <div class="lpanel-error" style="display:block;margin-top:6px;">{{ $errors->first() }}</div>
      @endif

      @if(session('success'))
        <div style="color:#00ff41;font-size:12px;margin-top:6px;">{{ session('success') }}</div>
      @endif
    </form>

    <div style="margin-top:14px;font-size:12px;">
      <a href="{{ route('home') }}" style="color:#fff;text-decoration:none;opacity:0.8;">← Back to AmanOS Desktop</a>
    </div>
  </div>
</div>

<script>
function updateClock() {
  const now = new Date();
  const h = String(now.getHours()).padStart(2, '0');
  const m = String(now.getMinutes()).padStart(2, '0');
  const timeElem = document.getElementById('login-time');
  const dateElem = document.getElementById('login-date');
  if (timeElem) timeElem.textContent = `${h}:${m}`;
  if (dateElem) {
    const options = { weekday: 'long', month: 'long', day: 'numeric' };
    dateElem.textContent = now.toLocaleDateString('en-US', options);
  }
}
setInterval(updateClock, 1000);
updateClock();
</script>
</body>
</html>
