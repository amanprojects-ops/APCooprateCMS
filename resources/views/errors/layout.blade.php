<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - AP Corporate CMS</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-primary: #090d16;
            --bg-secondary: #111625;
            --text-primary: #f3f4f6;
            --text-secondary: #9ca3af;
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.15);
            --accent: #d946ef;
            --accent-glow: rgba(217, 70, 239, 0.15);
            --border: rgba(255, 255, 255, 0.08);
            --card-bg: rgba(17, 22, 37, 0.6);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated Background Blobs */
        .background-glows {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            pointer-events: none;
        }

        .glow-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.4;
            animation: float 20s infinite ease-in-out;
        }

        .glow-blob-1 {
            top: -10%;
            left: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            animation-delay: 0s;
        }

        .glow-blob-2 {
            bottom: -10%;
            right: -10%;
            width: 50vw;
            height: 50vw;
            background: radial-gradient(circle, var(--accent) 0%, transparent 70%);
            animation-delay: -5s;
        }

        .glow-blob-3 {
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 35vw;
            height: 35vw;
            background: radial-gradient(circle, #06b6d4 0%, transparent 70%);
            animation: float-center 25s infinite ease-in-out;
            opacity: 0.25;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.95);
            }
        }

        @keyframes float-center {
            0%, 100% {
                transform: translate(-50%, -50%) translate(0, 0);
            }
            50% {
                transform: translate(-50%, -50%) translate(-40px, 40px);
            }
        }

        /* Error Container */
        .error-wrapper {
            position: relative;
            z-index: 2;
            width: 90%;
            max-width: 580px;
            padding: 40px;
            text-align: center;
        }

        /* Glassmorphism Card */
        .error-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 50px 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4),
                        inset 0 1px 0 rgba(255, 255, 255, 0.1);
            transform: translateY(0);
            animation: card-appear 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes card-appear {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Error Code Styling */
        .error-code {
            font-size: 130px;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #a78bfa 0%, #ec4899 50%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
            display: inline-block;
            filter: drop-shadow(0 4px 10px rgba(99, 102, 241, 0.2));
            animation: pulse-glow 3s infinite ease-in-out;
        }

        @keyframes pulse-glow {
            0%, 100% {
                filter: drop-shadow(0 4px 10px rgba(99, 102, 241, 0.2));
            }
            50% {
                filter: drop-shadow(0 8px 25px rgba(236, 72, 153, 0.4));
            }
        }

        .error-title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--text-primary);
            letter-spacing: -0.5px;
        }

        .error-message {
            font-size: 16px;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: 35px;
            max-width: 420px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Interactive Buttons */
        .actions-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            padding: 14px 28px;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #4f46e5 100%);
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4),
                        inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6),
                        inset 0 1px 0 rgba(255, 255, 255, 0.2);
            background: linear-gradient(135deg, #818cf8 0%, #6366f1 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.04);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .btn-secondary:active {
            transform: translateY(0);
        }

        /* Branding footer */
        .branding-footer {
            margin-top: 30px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.3);
            letter-spacing: 0.5px;
            animation: fade-in 1.5s ease forwards;
        }

        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @media (max-width: 480px) {
            .error-card {
                padding: 40px 20px;
            }
            .error-code {
                font-size: 100px;
            }
            .error-title {
                font-size: 22px;
            }
            .btn {
                width: 100%;
            }
            .actions-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="background-glows">
        <div class="glow-blob glow-blob-1"></div>
        <div class="glow-blob glow-blob-2"></div>
        <div class="glow-blob glow-blob-3"></div>
    </div>

    <div class="error-wrapper">
        <div class="error-card">
            <div class="error-code">@yield('code')</div>
            <h1 class="error-title">@yield('title')</h1>
            <p class="error-message">@yield('message')</p>
            
            <div class="actions-group">
                <a href="{{ url('/') }}" class="btn btn-primary">
                    <i class="fa-solid fa-house"></i> Back to Home
                </a>
                <button onclick="window.history.back()" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Go Back
                </button>
            </div>
        </div>
        
        <div class="branding-footer">
            &copy; {{ date('Y') }} AP Corporate CMS. All rights reserved.
        </div>
    </div>
</body>
</html>
