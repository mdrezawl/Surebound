<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enterprise Setup & Deployment Wizard | Surebound</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #070B14;
            --bg-card: rgba(15, 23, 42, 0.75);
            --bg-card-solid: #0f172a;
            --bg-input: rgba(30, 41, 59, 0.6);
            --border-card: rgba(255, 255, 255, 0.08);
            --border-subtle: rgba(255, 255, 255, 0.12);
            --border-focus: #3b82f6;
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --primary-glow: rgba(37, 99, 235, 0.35);
            --accent: #06b6d4;
            --accent-glow: rgba(6, 182, 212, 0.3);
            --success: #10b981;
            --success-glow: rgba(16, 185, 129, 0.25);
            --danger: #ef4444;
            --warning: #f59e0b;
            --text-title: #f8fafc;
            --text-body: #94a3b8;
            --text-muted: #64748b;
            --radius-lg: 18px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(37, 99, 235, 0.18) 0%, transparent 45%),
                radial-gradient(circle at 85% 85%, rgba(6, 182, 212, 0.12) 0%, transparent 45%),
                radial-gradient(circle at 50% 50%, rgba(16, 185, 129, 0.05) 0%, transparent 60%);
            background-attachment: fixed;
            color: var(--text-body);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2.5rem 1.5rem;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle grid ambient */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.015) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 0;
        }

        .setup-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 680px;
        }

        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(37, 99, 235, 0.3);
            color: #60a5fa;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .brand-badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #3b82f6;
            box-shadow: 0 0 10px #3b82f6;
            animation: pulseDot 2s infinite;
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.8); }
        }

        .brand-logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 16px;
            background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
            border: 1px solid rgba(96, 165, 250, 0.3);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
            margin-bottom: 1rem;
        }

        .brand-header h1 {
            color: var(--text-title);
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            margin-bottom: 0.35rem;
        }

        .brand-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Card Container */
        .setup-card {
            background: var(--bg-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-card);
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.04);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        /* Stepper Navigation */
        .stepper-header {
            background: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid var(--border-card);
            padding: 1.5rem 2rem;
        }

        .stepper-track {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .stepper-track::before {
            content: '';
            position: absolute;
            top: 18px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: rgba(255, 255, 255, 0.08);
            z-index: 1;
        }

        .step-item {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            background: transparent;
        }

        .step-bubble {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #1e293b;
            border: 2px solid rgba(255, 255, 255, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 700;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .step-item.active .step-bubble {
            background: var(--primary);
            border-color: #60a5fa;
            color: #ffffff;
            box-shadow: 0 0 20px var(--primary-glow);
            transform: scale(1.08);
        }

        .step-item.completed .step-bubble {
            background: var(--success);
            border-color: #34d399;
            color: #ffffff;
            box-shadow: 0 0 15px var(--success-glow);
        }

        .step-title {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--text-muted);
            transition: color 0.2s ease;
        }

        .step-item.active .step-title {
            color: #60a5fa;
        }

        .step-item.completed .step-title {
            color: #34d399;
        }

        /* Card Content Body */
        .card-body {
            padding: 2.25rem 2.25rem;
        }

        .step-heading-group {
            margin-bottom: 1.75rem;
        }

        .step-heading-group h2 {
            color: var(--text-title);
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-heading-group p {
            color: var(--text-body);
            font-size: 0.925rem;
            margin-top: 0.35rem;
            line-height: 1.5;
        }

        /* Form Elements */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.825rem;
            font-weight: 700;
            color: #cbd5e1;
            letter-spacing: 0.02em;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-muted);
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-input {
            width: 100%;
            background: var(--bg-input);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            color: var(--text-title);
            padding: 0.85rem 1rem 0.85rem 2.75rem;
            font-size: 0.95rem;
            font-weight: 500;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input.no-icon {
            padding-left: 1rem;
        }

        .form-input:focus {
            background: rgba(15, 23, 42, 0.9);
            border-color: var(--border-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-input::placeholder {
            color: #475569;
        }

        /* Checkbox styling */
        .checkbox-container {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid var(--border-subtle);
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: border-color 0.2s ease;
            margin-bottom: 1.5rem;
        }

        .checkbox-container:hover {
            border-color: rgba(96, 165, 250, 0.4);
        }

        .checkbox-input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .checkbox-text h4 {
            color: var(--text-title);
            font-size: 0.9rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }

        .checkbox-text p {
            color: var(--text-body);
            font-size: 0.8rem;
            line-height: 1.4;
        }

        /* Requirements List */
        .req-list {
            list-style: none;
            margin-bottom: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .req-item {
            background: rgba(30, 41, 59, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 0.85rem 1.15rem;
            border-radius: var(--radius-md);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 600;
            color: #cbd5e1;
            transition: all 0.2s ease;
        }

        .req-item:hover {
            background: rgba(30, 41, 59, 0.55);
            border-color: rgba(255, 255, 255, 0.09);
        }

        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .badge-pass {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #34d399;
        }

        .badge-fail {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
        }

        .alert-info {
            background: rgba(37, 99, 235, 0.12);
            border: 1px solid rgba(37, 99, 235, 0.3);
            color: #93c5fd;
        }

        /* Buttons */
        .actions-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.75rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0.95rem 1.75rem;
            border-radius: var(--radius-md);
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px var(--primary-glow);
            width: 100%;
        }

        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            box-shadow: 0 6px 25px rgba(37, 99, 235, 0.45);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: rgba(30, 41, 59, 0.8);
            border: 1px solid var(--border-subtle);
            color: #cbd5e1;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .btn-secondary:hover {
            background: rgba(51, 65, 85, 0.8);
            color: #ffffff;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none !important;
        }

        /* STEP 5: Purge Summary & Complete */
        .celebrate-icon-wrap {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.1) 100%);
            border: 2px solid rgba(16, 185, 129, 0.4);
            box-shadow: 0 0 35px var(--success-glow);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
            animation: bounceIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }

        .purge-card {
            background: rgba(15, 23, 42, 0.9);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            margin: 1.5rem 0;
            text-align: left;
        }

        .purge-card-header {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #34d399;
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .purge-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .purge-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: #94a3b8;
            background: rgba(0, 0, 0, 0.25);
            padding: 6px 12px;
            border-radius: 6px;
        }

        .purge-item-status {
            color: #34d399;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .credentials-pill {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid var(--border-subtle);
            border-radius: var(--radius-md);
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.875rem;
        }

        .footer-note {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .footer-note a {
            color: #60a5fa;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .card-body {
                padding: 1.5rem 1.25rem;
            }
            .form-row {
                grid-template-columns: 1fr;
            }
            .stepper-header {
                padding: 1.25rem 1rem;
            }
            .step-title {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="setup-wrapper">
        
        <!-- Brand Header -->
        <div class="brand-header">
            <div class="brand-logo-wrap">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3 7V12C3 17.52 6.84 22.74 12 24C17.16 22.74 21 17.52 21 12V7L12 2Z" fill="url(#shield_grad)"/>
                    <path d="M10 15.5L6.5 12L7.91 10.59L10 12.67L16.09 6.59L17.5 8L10 15.5Z" fill="#ffffff"/>
                    <defs>
                        <linearGradient id="shield_grad" x1="3" y1="2" x2="21" y2="24" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#3B82F6"/>
                            <stop offset="1" stop-color="#1D4ED8"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>
            <h1>Surebound</h1>
            <p>Enterprise Deployment & Setup Wizard</p>
            <div style="margin-top: 0.75rem;">
                <span class="brand-badge">
                    <span class="brand-badge-dot"></span>
                    PHP {{ PHP_VERSION }} • Setup Wizard Active
                </span>
            </div>
        </div>

        <!-- Setup Card Container -->
        <div class="setup-card">
            
            <!-- Stepper Progress Tracker -->
            <div class="stepper-header">
                <div class="stepper-track">
                    <div class="step-item {{ $step >= 1 ? 'active' : '' }} {{ $step > 1 ? 'completed' : '' }}">
                        <div class="step-bubble">
                            @if($step > 1) ✓ @else 1 @endif
                        </div>
                        <span class="step-title">Checks</span>
                    </div>
                    <div class="step-item {{ $step >= 2 ? 'active' : '' }} {{ $step > 2 ? 'completed' : '' }}">
                        <div class="step-bubble">
                            @if($step > 2) ✓ @else 2 @endif
                        </div>
                        <span class="step-title">Database</span>
                    </div>
                    <div class="step-item {{ $step >= 3 ? 'active' : '' }} {{ $step > 3 ? 'completed' : '' }}">
                        <div class="step-bubble">
                            @if($step > 3) ✓ @else 3 @endif
                        </div>
                        <span class="step-title">Migrate</span>
                    </div>
                    <div class="step-item {{ $step >= 4 ? 'active' : '' }} {{ $step > 4 ? 'completed' : '' }}">
                        <div class="step-bubble">
                            @if($step > 4) ✓ @else 4 @endif
                        </div>
                        <span class="step-title">Admin</span>
                    </div>
                    <div class="step-item {{ $step >= 5 ? 'active' : '' }} {{ $step > 5 ? 'completed' : '' }}">
                        <div class="step-bubble">
                            @if($step == 5) ★ @else 5 @endif
                        </div>
                        <span class="step-title">Purge & Done</span>
                    </div>
                </div>
            </div>

            <!-- Card Body Content -->
            <div class="card-body">

                <!-- Flash Alerts -->
                @if(session('error'))
                    <div class="alert alert-error">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                <!-- STEP 1: Requirements Check -->
                @if($step == 1)
                    <div class="step-heading-group">
                        <h2>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                            Server Compatibility Checks
                        </h2>
                        <p>Verifying server requirements, PHP extensions, and file system write permissions.</p>
                    </div>

                    <ul class="req-list">
                        @foreach($requirements as $requirement => $passed)
                            <li class="req-item">
                                <span>{{ $requirement }}</span>
                                @if($passed)
                                    <span class="badge-status badge-pass">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                        Verified
                                    </span>
                                @else
                                    <span class="badge-status badge-fail">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                        Required
                                    </span>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    @if($allRequirementsPassed)
                        <div class="alert alert-success">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <div>Your server fully meets all requirements. Ready to configure database.</div>
                        </div>
                        <a href="{{ route('setup.database') }}" class="btn btn-primary">
                            Continue to Database Setup &rarr;
                        </a>
                    @else
                        <div class="alert alert-error">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <div>Please resolve missing requirements before continuing with installation.</div>
                        </div>
                        <button class="btn btn-primary" disabled>Requirements Not Met</button>
                    @endif
                @endif

                <!-- STEP 2: Database Configuration -->
                @if($step == 2)
                    <div class="step-heading-group">
                        <h2>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
                            Database Configuration
                        </h2>
                        <p>Provide your MySQL database credentials. The wizard will test connection before saving.</p>
                    </div>

                    <form action="{{ route('setup.database.save') }}" method="POST">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Database Host</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                                    </span>
                                    <input type="text" name="db_host" class="form-input" value="{{ old('db_host', $currentConfig['host'] ?? '127.0.0.1') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Database Port</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    </span>
                                    <input type="text" name="db_port" class="form-input" value="{{ old('db_port', $currentConfig['port'] ?? '3306') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Database Name</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </span>
                                <input type="text" name="db_database" class="form-input" value="{{ old('db_database', $currentConfig['database'] ?? 'Surebound') }}" required placeholder="e.g. Surebound">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Database Username</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    </span>
                                    <input type="text" name="db_username" class="form-input" value="{{ old('db_username', $currentConfig['username'] ?? 'root') }}" required placeholder="e.g. root">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Database Password</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </span>
                                    <input type="password" name="db_password" class="form-input" value="{{ old('db_password', $currentConfig['password'] ?? '') }}" placeholder="Blank if none">
                                </div>
                            </div>
                        </div>

                        <div class="actions-group">
                            <a href="{{ route('setup.welcome') }}" class="btn btn-secondary">&larr; Back</a>
                            <button type="submit" class="btn btn-primary">Connect & Save Credentials &rarr;</button>
                        </div>
                    </form>
                @endif

                <!-- STEP 3: Run Database Migrations -->
                @if($step == 3)
                    <div class="step-heading-group">
                        <h2>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                            Execute Database Migrations
                        </h2>
                        <p>Database credentials saved. We will now structure the database tables, relations, and indices.</p>
                    </div>

                    <div class="alert alert-info">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <div>Database connection tested and active. Migrations will create schemas for users, policies, claims, invoices, and CMS content.</div>
                    </div>

                    <form action="{{ route('setup.migrations.run') }}" method="POST">
                        @csrf
                        
                        <label class="checkbox-container">
                            <input type="checkbox" name="seed_demo_data" value="1" checked class="checkbox-input">
                            <div class="checkbox-text">
                                <h4>Seed realistic demo data & insurance records (Recommended)</h4>
                                <p>Pre-populates realistic quotes, active insurance policies, real-time claims, invoices, API settings, and CMS content so the platform is immediately functional.</p>
                            </div>
                        </label>

                        <div class="actions-group">
                            <a href="{{ route('setup.database') }}" class="btn btn-secondary">&larr; Back</a>
                            <button type="submit" class="btn btn-primary" onclick="this.innerHTML='Executing Migrations & Seeds...'; this.style.opacity='0.7';">
                                Run Migrations & Build Database &rarr;
                            </button>
                        </div>
                    </form>
                @endif

                <!-- STEP 4: Administrator Account Creation -->
                @if($step == 4)
                    <div class="step-heading-group">
                        <h2>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Create Super Administrator Account
                        </h2>
                        <p>Configure the master administrative account to manage all underwriting, claims, and policies.</p>
                    </div>

                    <form action="{{ route('setup.admin.save') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Administrator Full Name</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                </span>
                                <input type="text" name="name" class="form-input" required placeholder="e.g. Md Rezawl" value="{{ old('name', 'Md Rezawl') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Administrator Email Address</label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                </span>
                                <input type="email" name="email" class="form-input" required placeholder="e.g. admin@surebound.com" value="{{ old('email', 'admin@surebound.com') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Master Password (Min 8 chars)</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </span>
                                    <input type="password" name="password" class="form-input" required minlength="8" placeholder="••••••••">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-wrapper">
                                    <span class="input-icon">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    </span>
                                    <input type="password" name="password_confirmation" class="form-input" required minlength="8" placeholder="••••••••">
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <div><strong>Production Security Lock:</strong> Submitting this step will mark the installation as complete and trigger the automatic removal of installer files for security.</div>
                        </div>

                        <div class="actions-group">
                            <button type="submit" class="btn btn-primary" onclick="this.innerHTML='Creating Admin & Finalizing...'; this.style.opacity='0.7';">
                                Create Admin & Finish Setup &rarr;
                            </button>
                        </div>
                    </form>
                @endif

                <!-- STEP 5: Complete & Auto-Purge Confirmation -->
                @if($step == 5)
                    <div style="text-align: center; padding: 0.5rem 0;">
                        
                        <div class="celebrate-icon-wrap">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <polyline points="22 4 12 14.01 9 11.01"/>
                            </svg>
                        </div>

                        <h2 style="color: var(--text-title); font-size: 1.65rem; font-weight: 800; margin-bottom: 0.5rem;">
                            🎉 Setup & Installation Complete!
                        </h2>
                        
                        <p style="color: var(--text-body); font-size: 0.95rem; line-height: 1.5; max-width: 520px; margin: 0 auto 1.5rem;">
                            Surebound has been successfully installed, configured, and secured on your server.
                        </p>

                        <!-- Auto-Purge Security Audit Card -->
                        <div class="purge-card">
                            <div class="purge-card-header">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                Automatic Security Clean-up Executed
                            </div>

                            <p style="font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.85rem; line-height: 1.4;">
                                Unnecessary installer files and setup wizards have been permanently and automatically purged from the server to protect against unauthorized re-installation:
                            </p>

                            <ul class="purge-list">
                                @if(!empty($purgedFiles))
                                    @foreach($purgedFiles as $purgedFile)
                                        <li class="purge-item">
                                            <span>{{ $purgedFile }}</span>
                                            <span class="purge-item-status">✓ Auto-Purged</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="purge-item">
                                        <span>app/Http/Controllers/SetupController.php</span>
                                        <span class="purge-item-status">✓ Auto-Purged</span>
                                    </li>
                                    <li class="purge-item">
                                        <span>resources/views/setup.blade.php</span>
                                        <span class="purge-item-status">✓ Auto-Purged</span>
                                    </li>
                                    <li class="purge-item">
                                        <span>routes/setup.php</span>
                                        <span class="purge-item-status">✓ Auto-Purged</span>
                                    </li>
                                @endif
                                <li class="purge-item">
                                    <span>Temporary caches (views, routes, config)</span>
                                    <span class="purge-item-status">✓ Flushed</span>
                                </li>
                                <li class="purge-item">
                                    <span>storage/installed</span>
                                    <span class="purge-item-status">✓ Lock Active</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Credentials summary -->
                        <div class="credentials-pill">
                            <div style="text-align: left;">
                                <div style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Super Admin Account</div>
                                <div style="color: var(--text-title); font-weight: 700; margin-top: 2px;">{{ $adminEmail ?? 'admin@surebound.com' }}</div>
                            </div>
                            <div style="text-align: right;">
                                <span class="badge-status badge-pass">Production Locked</span>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <a href="{{ route('login') }}" class="btn btn-primary" style="padding: 1.1rem 2rem; font-size: 1.05rem;">
                            Login to Admin Portal &rarr;
                        </a>

                        <div class="footer-note">
                            Setup is locked. Any future attempts to access <code>/setup</code> will automatically redirect to the login page.
                        </div>

                    </div>
                @endif

            </div>
        </div>

        <div class="footer-note" style="margin-top: 2rem;">
            &copy; {{ date('Y') }} Surebound Insurance Services. All rights reserved.
        </div>

    </div>

</body>
</html>
