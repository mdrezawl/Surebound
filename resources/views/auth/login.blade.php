<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sign in to your Surebound Insurance account to manage policies, quotes, and claims.">
    <title>Sign In – Surebound Insurance</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    
    <!-- Fonts: Inter (Brand Guidelines 2026) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/surebound-modal.css') }}">
    
    <style>
        /* Brand Guidelines 2026: Minion Variable Concept Bold */
        @font-face {
            font-family: 'Minion Variable Concept';
            src: local('Minion Variable Concept Bold'),
                 local('Minion Variable Concept'),
                 local('MinionVariableConcept-Bold'),
                 local('MinionPro-Bold'),
                 url('/fonts/minion/MinionPro-Bold.otf') format('opentype'),
                 url('/fonts/minion/MinionPro-Bold.ttf') format('truetype');
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Minion Variable Concept';
            src: local('Minion Variable Concept'),
                 local('MinionVariableConcept-Regular'),
                 local('MinionPro-Regular'),
                 url('/fonts/minion/MinionPro-Regular.otf') format('opentype');
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        :root {
            --font-headline: 'Minion Variable Concept', 'Minion Pro', Georgia, serif;
            --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            
            --color-primary: #195acd;
            --color-primary-hover: #1247a8;
            --color-navy: #0b1a48;
            --color-navy-dark: #071336;
            --color-sky-light: #f0f6ff;
            --color-sky: #e1edfe;
            --color-text-dark: #0b1a48;
            --color-text-body: #475569;
            --color-text-muted: #64748b;
            --color-card-border: #e2e8f0;
            
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-pill: 9999px;
            
            --shadow-subtle: 0 4px 20px rgba(11, 26, 72, 0.05);
            --shadow-card: 0 20px 45px rgba(11, 26, 72, 0.08), 0 1px 3px rgba(11, 26, 72, 0.04);
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-sans);
            min-height: 100vh;
            background: linear-gradient(145deg, #edf4fc 0%, #f7faff 40%, #f0f6ff 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            color: var(--color-text-body);
            position: relative;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Ambient background lighting */
        .ambient-glow-1 {
            position: absolute;
            top: -150px;
            left: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(25, 90, 205, 0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .ambient-glow-2 {
            position: absolute;
            bottom: -150px;
            right: -150px;
            width: 550px;
            height: 550px;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 2;
        }

        /* Top Brand Navigation */
        .auth-top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding: 0 4px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 15.5px;
            font-weight: 500;
            color: var(--color-text-muted);
            text-decoration: none;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .back-link:hover {
            color: var(--color-primary);
            transform: translateX(-2px);
        }

        .auth-badge-portal {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #ffffff;
            border: 1px solid var(--color-card-border);
            padding: 4px 10px;
            border-radius: var(--radius-pill);
            font-size: 13.5px;
            font-weight: 600;
            color: var(--color-navy);
            box-shadow: 0 2px 6px rgba(11, 26, 72, 0.04);
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background-color: #10b981;
        }

        /* Main Auth Card */
        .auth-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-card);
            padding: 40px 36px;
            position: relative;
            overflow: hidden;
        }

        .auth-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #195acd 0%, #38bdf8 100%);
        }

        /* Brand Logo */
        .auth-brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logo-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            margin-bottom: 20px;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .brand-logo-link:hover {
            transform: scale(1.02);
            opacity: 0.95;
        }

        .brand-logo-img {
            height: 44px;
            width: auto;
            max-width: 220px;
            object-fit: contain;
            display: block;
        }

        .auth-title {
            font-family: var(--font-headline);
            font-size: 28px;
            font-weight: 700;
            color: var(--color-navy);
            letter-spacing: 0;
            font-kerning: normal;
            font-feature-settings: "kern" 1, "liga" 1;
            text-rendering: optimizeLegibility;
            text-transform: none;
            line-height: 1.25;
            margin-bottom: 6px;
        }

        .auth-subtitle {
            font-size: 15.5px;
            color: var(--color-text-muted);
            line-height: 1.5;
        }

        /* Alerts */
        .error-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            font-size: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-alert {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1d4ed8;
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            font-size: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form Groups */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14.5px;
            font-weight: 600;
            color: var(--color-navy);
            margin-bottom: 7px;
            letter-spacing: 0;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            font-family: var(--font-sans);
            font-size: 16px;
            color: var(--color-navy);
            background: #ffffff;
            border: 1.5px solid var(--color-card-border);
            border-radius: var(--radius-sm);
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(25, 90, 205, 0.15);
        }

        .form-input:focus + .input-icon,
        .input-wrap:focus-within .input-icon {
            color: var(--color-primary);
        }

        .toggle-password-btn {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        }

        .toggle-password-btn:hover {
            color: var(--color-navy);
        }

        /* Form Options (Remember & Forgot) */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 15px;
        }

        .checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--color-text-body);
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input {
            width: 16px;
            height: 16px;
            border-radius: 4px;
            border: 1.5px solid var(--color-card-border);
            accent-color: var(--color-primary);
            cursor: pointer;
        }

        .forgot-link {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease, text-decoration 0.2s ease;
        }

        .forgot-link:hover {
            color: var(--color-primary-hover);
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #195acd 0%, #1346a0 100%);
            color: #ffffff;
            font-family: var(--font-sans);
            font-size: 17px;
            font-weight: 600;
            border: none;
            border-radius: var(--radius-sm);
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(25, 90, 205, 0.28);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(25, 90, 205, 0.35);
            background: linear-gradient(135deg, #144eb7 0%, #0d3680 100%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Divider & Switch */
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 24px 0;
            color: #94a3b8;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .auth-divider span {
            padding: 0 12px;
        }

        .auth-footer {
            text-align: center;
            font-size: 15.5px;
            color: var(--color-text-muted);
        }

        .auth-footer a {
            color: var(--color-primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .auth-footer a:hover {
            color: var(--color-primary-hover);
            text-decoration: underline;
        }

        /* Security Assurance */
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 24px;
            font-size: 13.5px;
            color: #94a3b8;
        }

        .security-note svg {
            width: 14px;
            height: 14px;
            color: #10b981;
        }
    </style>
</head>
<body>

    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="auth-wrapper">
        <!-- Top Nav Link -->
        <div class="auth-top-nav">
            <a href="/" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                <span>Back to Home</span>
            </a>
            <div class="auth-badge-portal">
                <span class="status-dot"></span>
                <span>Secure Portal</span>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="auth-card">
            <!-- Brand Logo Header -->
            <div class="auth-brand-header">
                <a href="/" class="brand-logo-link" aria-label="Surebound Home">
                    <img src="{{ asset('images/logo.png') }}" alt="Surebound" class="brand-logo-img">
                </a>
                <h1 class="auth-title">Sign in to your account</h1>
                <p class="auth-subtitle">Manage your policies, quotes, and claims in one secure place.</p>
            </div>

            @if ($errors->any())
                <div class="error-alert">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            @if (session('info'))
                <div class="info-alert">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <span>{{ session('info') }}</span>
                </div>
            @endif

            <!-- Sign In Form -->
            <form action="{{ route('login.post') }}" method="POST" id="loginForm" onsubmit="handleLoginSubmit(event)">
                @csrf
                
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <div class="input-wrap">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="form-input" 
                            value="{{ old('email') }}" 
                            required 
                            placeholder="name@example.com"
                            autocomplete="email"
                            autofocus
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            class="form-input" 
                            value="" 
                            required 
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-password-btn" onclick="togglePasswordVisibility()" aria-label="Toggle password visibility">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" id="remember" checked>
                        <span>Keep me signed in</span>
                    </label>
                    <a href="javascript:void(0)" onclick="SureboundModal.alert({ title: 'Password Reset Assistance', message: 'Password reset instructions will be delivered to your registered policyholder email address within a few moments.', type: 'info', buttonText: 'Close' })" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Sign In</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            <div class="auth-divider">
                <span>New to Surebound?</span>
            </div>

            <div class="auth-footer">
                <span>Don't have an account yet? </span>
                <a href="/register">Create an account</a>
            </div>
        </div>

        <!-- Security Note -->
        <div class="security-note">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd" />
            </svg>
            <span>256-Bit SSL Encrypted Insurance Portal</span>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const pwdInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />`;
            } else {
                pwdInput.type = 'password';
                eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />`;
            }
        }

        // Form submission handler
        function handleLoginSubmit(e) {
            // Only intercept for offline static preview files (.html or file://)
            if (window.location.protocol === 'file:' || window.location.pathname.endsWith('.html')) {
                e.preventDefault();
                const btn = document.getElementById('submitBtn');
                btn.innerHTML = '<span>Signing in...</span>';
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 400);
                return;
            }

            // Normal server-side Laravel submission: show loading feedback
            const btn = document.getElementById('submitBtn');
            btn.innerHTML = '<span>Signing in...</span>';
            btn.style.opacity = '0.7';
            btn.style.pointerEvents = 'none';
        }
    </script>
    <script src="{{ asset('js/surebound-modal.js') }}"></script>
</body>
</html>
