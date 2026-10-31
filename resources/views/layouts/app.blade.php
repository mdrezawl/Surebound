<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php
        $seoService = app(\App\Services\SeoService::class);
        $seoMeta = $seoService->getMetadataForRequest();
        $fallbackTitle = $seoMeta?->seo_title ?: 'Surebound – Protection Built Around You';
    @endphp
    <title>@yield('title', $fallbackTitle)</title>
    @include('partials.seo-head')
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    
    <!-- Google Fonts: Inter (Brand Guidelines 2026) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/surebound.css') }}?v={{ file_exists(public_path('css/surebound.css')) ? filemtime(public_path('css/surebound.css')) : '2.0' }}">
    <link rel="stylesheet" href="{{ asset('css/surebound-modal.css') }}?v={{ file_exists(public_path('css/surebound-modal.css')) ? filemtime(public_path('css/surebound-modal.css')) : '2.0' }}">
    @yield('head')

    <!-- Marketing Pixels & Social Meta Tags (Google, Meta/FB, LinkedIn, Twitter, TikTok) -->
    @include('partials.marketing-head')
</head>
<body>
    <!-- Marketing Body Tags & Fallbacks (GTM, Meta, LinkedIn noscript) -->
    @include('partials.marketing-body')

    <!-- ==========================================
         MAIN HEADER
         ========================================== -->
    <header class="site-header" id="site-header">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 8px;">
                <a href="{{ url('/') }}" class="brand-logo-link">
                    <img src="{{ asset('images/logo.png') }}" alt="Surebound" class="brand-logo-img">
                </a>

            </div>

            <nav class="main-nav" id="main-nav">
                <!-- Personal -->
                <div class="nav-dropdown {{ request()->routeIs('home-insurance', 'auto-insurance', 'life-insurance', 'health-insurance', 'umbrella-insurance', 'personal-coverage', 'specialty-coverage') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('home-insurance', 'auto-insurance', 'life-insurance', 'health-insurance', 'umbrella-insurance', 'personal-coverage', 'specialty-coverage') ? 'active' : '' }}">
                        <span>Personal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('home-insurance') }}" class="{{ request()->routeIs('home-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('home-insurance'))<span class="active-dot">•</span>@endif Home Insurance
                        </a>
                        <a href="{{ route('auto-insurance') }}" class="{{ request()->routeIs('auto-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('auto-insurance'))<span class="active-dot">•</span>@endif Auto Insurance
                        </a>
                        <a href="{{ route('life-insurance') }}" class="{{ request()->routeIs('life-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('life-insurance'))<span class="active-dot">•</span>@endif Life Insurance
                        </a>
                        <a href="{{ route('health-insurance') }}" class="{{ request()->routeIs('health-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('health-insurance'))<span class="active-dot">•</span>@endif Health Insurance
                        </a>
                        <a href="{{ route('umbrella-insurance') }}" class="{{ request()->routeIs('umbrella-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('umbrella-insurance'))<span class="active-dot">•</span>@endif Umbrella Insurance
                        </a>
                    </div>
                </div>

                <!-- Commercial -->
                <div class="nav-dropdown {{ request()->routeIs('business-insurance', 'property-insurance', 'liability-insurance', 'group-benefits', 'commercial-auto-insurance', 'surety-bond') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('business-insurance', 'property-insurance', 'liability-insurance', 'group-benefits', 'commercial-auto-insurance', 'surety-bond') ? 'active' : '' }}">
                        <span>Commercial</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('business-insurance') }}" class="{{ request()->routeIs('business-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('business-insurance'))<span class="active-dot">•</span>@endif Business Owner Policy (BOP)
                        </a>
                        <a href="{{ route('group-benefits') }}" class="{{ request()->routeIs('group-benefits') ? 'active' : '' }}">
                            @if(request()->routeIs('group-benefits'))<span class="active-dot">•</span>@endif Workers' Compensation
                        </a>
                        <a href="{{ route('liability-insurance') }}" class="{{ request()->routeIs('liability-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('liability-insurance'))<span class="active-dot">•</span>@endif General Liability
                        </a>
                        <a href="{{ route('property-insurance') }}" class="{{ request()->routeIs('property-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('property-insurance'))<span class="active-dot">•</span>@endif Property Coverage
                        </a>
                        <a href="{{ route('commercial-auto-insurance') }}" class="{{ request()->routeIs('commercial-auto-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('commercial-auto-insurance'))<span class="active-dot">•</span>@endif Commercial Auto
                        </a>
                        <a href="{{ route('surety-bond') }}" class="{{ request()->routeIs('surety-bond') ? 'active' : '' }}">
                            @if(request()->routeIs('surety-bond'))<span class="active-dot">•</span>@endif Surety Bond
                        </a>
                    </div>
                </div>

                <!-- Coverage -->
                <div class="nav-dropdown {{ request()->routeIs('coverage', 'custom-quote', 'compare') ? 'active' : '' }}">
                    <a href="{{ route('coverage') }}" class="nav-link {{ request()->routeIs('coverage', 'custom-quote', 'compare') ? 'active' : '' }}">
                        Coverage
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('coverage') }}" class="{{ request()->routeIs('coverage') ? 'active' : '' }}">
                            @if(request()->routeIs('coverage'))<span class="active-dot">•</span>@endif All Coverage Solutions
                        </a>
                        <a href="{{ route('custom-quote') }}" class="{{ request()->routeIs('custom-quote') ? 'active' : '' }}">
                            @if(request()->routeIs('custom-quote'))<span class="active-dot">•</span>@endif Custom Tailored Plans
                        </a>
                        <a href="{{ route('compare') }}" class="{{ request()->routeIs('compare') ? 'active' : '' }}">
                            @if(request()->routeIs('compare'))<span class="active-dot">•</span>@endif Compare Policies
                        </a>
                    </div>
                </div>

                <!-- About Us -->
                <div class="nav-dropdown {{ request()->routeIs('story', 'team', 'careers', 'community') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('story', 'team', 'careers', 'community') ? 'active' : '' }}">
                        About Us
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('story') }}" class="{{ request()->routeIs('story') ? 'active' : '' }}">
                            @if(request()->routeIs('story'))<span class="active-dot">•</span>@endif Our Mission
                        </a>
                        <a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'active' : '' }}">
                            @if(request()->routeIs('team'))<span class="active-dot">•</span>@endif Leadership Team
                        </a>
                        <a href="{{ route('careers') }}" class="{{ request()->routeIs('careers') ? 'active' : '' }}">
                            @if(request()->routeIs('careers'))<span class="active-dot">•</span>@endif Careers
                        </a>
                        <a href="{{ route('community') }}" class="{{ request()->routeIs('community') ? 'active' : '' }}">
                            @if(request()->routeIs('community'))<span class="active-dot">•</span>@endif Community Impact
                        </a>
                    </div>
                </div>

                <!-- Resources -->
                <div class="nav-dropdown {{ request()->routeIs('articles', 'faqs', 'guides', 'claims') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('articles', 'faqs', 'guides', 'claims') ? 'active' : '' }}">
                        Resources
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('articles') }}" class="{{ request()->routeIs('articles') ? 'active' : '' }}">
                            @if(request()->routeIs('articles'))<span class="active-dot">•</span>@endif Articles & Insights
                        </a>
                        <a href="{{ route('faqs') }}" class="{{ request()->routeIs('faqs') ? 'active' : '' }}">
                            @if(request()->routeIs('faqs'))<span class="active-dot">•</span>@endif Frequently Asked Questions
                        </a>
                        <a href="{{ route('guides') }}" class="{{ request()->routeIs('guides') ? 'active' : '' }}">
                            @if(request()->routeIs('guides'))<span class="active-dot">•</span>@endif Insurance Guides
                        </a>
                        <a href="{{ route('claims') }}">Claims Help Center</a>
                    </div>
                </div>

                <!-- Mobile Action Buttons -->
                <div class="mobile-nav-actions">
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-mobile-login">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span>Client Portal</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-mobile-login">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>
                            <span>Login / Sign In</span>
                        </a>
                    @endauth
                    <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-mobile-quote">
                        <span>Get a Free Quote &rarr;</span>
                    </a>
                </div>
            </nav>

            <div class="header-actions">
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="btn-header-login">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <span>Portal</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-header-login">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                        <span>Login</span>
                    </a>
                @endauth

                <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-header-quote">
                    <span>Get a Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <button class="mobile-toggle" id="mobile-toggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <!-- ==========================================
         PAGE CONTENT
         ========================================== -->
    <main>
        @yield('content')
    </main>

    <!-- ==========================================
         SITE FOOTER
         ========================================== -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-main-grid">
                <!-- Col 1: Brand & Bio -->
                <div class="footer-brand-col">
                    <a href="{{ route('home') }}" aria-label="Surebound Home" style="display:inline-block;">
                        <img src="{{ asset('images/logo.png') }}" alt="Surebound" class="footer-logo-img">
                    </a>
                    <p class="footer-brand-desc">
                        We provide trusted insurance solutions for individuals, families and businesses. Because your tomorrow matters.
                    </p>
                    <div class="footer-contact-details" style="margin-top: 18px; display: flex; flex-direction: column; gap: 8px; font-size: 0.8125rem; color: #94a3b8;">
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteContact['primary_phone'] ?? '+1 813-214-1731') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #f8fafc; text-decoration: none; font-weight: 600; transition: color 0.2s;">
                            <svg style="width: 14px; height: 14px; color: #38bdf8; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ $siteContact['primary_phone'] ?? '+1 813-214-1731' }}</span>
                        </a>
                        <a href="mailto:{{ $siteContact['support_email'] ?? 'support@surebound.com' }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; transition: color 0.2s;">
                            <svg style="width: 14px; height: 14px; color: #38bdf8; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            <span>{{ $siteContact['support_email'] ?? 'support@surebound.com' }}</span>
                        </a>
                        <div style="display: inline-flex; align-items: flex-start; gap: 8px; color: #94a3b8;">
                            <svg style="width: 14px; height: 14px; color: #38bdf8; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            <span>{{ $siteContact['hq_address'] ?? '100 N Tampa St, Suite 2500, Tampa, FL 33602' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Col 2: Coverage -->
                <div class="footer-nav-col">
                    <h4>Coverage</h4>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('home-insurance') }}">Home Insurance</a></li>
                        <li><a href="{{ route('auto-insurance') }}">Auto Insurance</a></li>
                        <li><a href="{{ route('life-insurance') }}">Life Insurance</a></li>
                        <li><a href="{{ route('health-insurance') }}">Health Insurance</a></li>
                        <li><a href="{{ route('umbrella-insurance') }}">Umbrella Insurance</a></li>
                        <li><a href="{{ route('business-insurance') }}">Business Insurance</a></li>
                        <li><a href="{{ route('commercial-auto-insurance') }}">Commercial Auto</a></li>
                        <li><a href="{{ route('surety-bond') }}">Surety Bond</a></li>
                    </ul>
                </div>

                <!-- Col 3: Company -->
                <div class="footer-nav-col">
                    <h4>Company</h4>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('story') }}">About Us</a></li>
                        <li><a href="{{ route('team') }}">Our Team</a></li>
                        <li><a href="{{ route('careers') }}">Careers</a></li>
                        <li><a href="{{ route('community') }}">News &amp; Updates</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 4: Resources -->
                <div class="footer-nav-col">
                    <h4>Resources</h4>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('articles') }}">Articles &amp; Insights</a></li>
                        <li><a href="{{ route('faqs') }}">FAQs</a></li>
                        <li><a href="{{ route('guides') }}">Insurance Guide</a></li>
                        <li><a href="{{ route('claims') }}">Claims Center</a></li>
                        <li><a href="{{ route('compare') }}">Agent Resources</a></li>
                    </ul>
                </div>

                <!-- Col 5: Support -->
                <div class="footer-nav-col">
                    <h4>Support</h4>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('claims') }}">Claims</a></li>
                        <li><a href="{{ route('payment') }}">Make a Payment</a></li>
                        <li><a href="{{ route('login') }}">Sign In</a></li>
                        <li><a href="{{ route('register') }}">Create Account</a></li>
                        <li><a href="{{ route('admin.dashboard') }}">Agent Portal</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <div class="footer-bottom-links">
                    <a href="{{ route('privacy') }}">Privacy Policy</a> &nbsp;|&nbsp;
                    <a href="{{ route('terms') }}">Terms of Service</a> &nbsp;|&nbsp;
                    <span>&copy; {{ date('Y') }} Surebound. All rights reserved.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- ==========================================
         INTERACTIVE GET A QUOTE MODAL
         ========================================== -->
    <div class="modal-overlay" id="quoteModal">
        <div class="modal-box" style="max-height: 92vh; overflow-y: auto;">
            <button class="modal-close-btn" onclick="closeQuoteModal()" aria-label="Close modal">&times;</button>
            <div class="modal-header">
                <h3>Get Your Free Quote</h3>
                <p>Tailored coverage with great rates in less than 2 minutes.</p>
            </div>
            <form onsubmit="handleQuoteSubmit(event)">
                <div class="modal-form-group">
                    <label for="coverage-type">Select Insurance Type</label>
                    <select id="coverage-type" required onchange="handleCoverageTypeChange()">
                        <optgroup label="Commercial Lines">
                            <option value="Business Owner Policy">Business Owner Policy (BOP)</option>
                            <option value="Commercial Property Coverage">Commercial Property Coverage</option>
                            <option value="General Liability">General Liability</option>
                            <option value="Workers' Compensation">Workers' Compensation</option>
                            <option value="Commercial Auto">Commercial Auto Insurance</option>
                            <option value="Surety Bond">Surety Bond</option>
                            <option value="Group Employee Benefits">Group Employee Benefits</option>
                            <option value="Specialty & Surplus Coverage">Specialty & Surplus Coverage</option>
                        </optgroup>
                        <optgroup label="Personal Lines">
                            <option value="Home Insurance">Homeowners Insurance</option>
                            <option value="Auto Insurance">Personal Auto Insurance</option>
                            <option value="Life Insurance">Life Insurance</option>
                            <option value="Health Insurance">Health Insurance</option>
                            <option value="Umbrella Insurance">Umbrella Liability</option>
                            <option value="Personal Coverage">Personal Comprehensive Coverage</option>
                        </optgroup>
                    </select>
                </div>

                <div class="modal-form-group">
                    <label for="quote-amount">Desired Coverage Amount / Limit</label>
                    <select id="quote-amount" onchange="handleQuoteAmountChange()">
                        <!-- dynamically populated depending on selected insurance line -->
                    </select>
                </div>

                <div class="modal-form-group" id="custom-amount-group" style="display: none;">
                    <label for="quote-custom-amount">Specify Custom Amount / Details</label>
                    <input type="text" id="quote-custom-amount" placeholder="e.g. $1,500,000 or $5,000/mo">
                </div>

                <div class="modal-form-group">
                    <label for="quote-name">Full Name</label>
                    <input type="text" id="quote-name" placeholder="John Doe" required>
                </div>
                <div class="modal-form-group">
                    <label for="quote-email">Email Address</label>
                    <input type="email" id="quote-email" placeholder="john@example.com" required>
                </div>
                <div class="modal-form-group">
                    <label for="quote-phone">Phone Number</label>
                    <input type="tel" id="quote-phone" placeholder="(555) 000-0000" required>
                </div>
                <div class="modal-form-group">
                    <label for="quote-zip">ZIP / Postal Code</label>
                    <input type="text" id="quote-zip" placeholder="e.g. 90210" required>
                </div>
                <button type="submit" class="btn-submit-modal" id="submitQuoteBtn">
                    View Instant Quote Estimate &rarr;
                </button>
            </form>
            <div id="quoteSuccessMessage" style="display:none; margin-top:16px; padding:12px; background:#e8f4fc; border-radius:8px; color:#1255db; text-align:center; font-weight:600; font-size: 16px;">
                ✓ Request received! An agent is matching the best plan for you right now.
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sticky Header scroll elevation
        window.addEventListener('scroll', function() {
            const header = document.getElementById('site-header');
            if (header) {
                if (window.scrollY > 15) {
                    header.classList.add('is-sticky');
                } else {
                    header.classList.remove('is-sticky');
                }
            }
        }, { passive: true });

        const AMOUNT_TIERS = {
            'business': [
                { value: '$500,000 BOP Standard', label: '$500,000 (Small Business Starter)' },
                { value: '$1,000,000 BOP Commercial Standard', label: '$1,000,000 (Commercial Standard - Most Popular)' },
                { value: '$2,000,000 BOP Enterprise Limit', label: '$2,000,000 (Enterprise Growth Tier)' },
                { value: '$5,000,000+ Comprehensive Commercial', label: '$5,000,000+ (High-Limit Commercial)' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'property': [
                { value: '$250,000 Property Base', label: '$250,000 (Commercial Property Base)' },
                { value: '$500,000 Property Standard', label: '$500,000 (Standard Commercial Property)' },
                { value: '$1,000,000 Premier Property Limit', label: '$1,000,000 (Premier Property Coverage)' },
                { value: '$2,500,000+ High-Value Commercial', label: '$2,500,000+ (High-Value Commercial)' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'liability': [
                { value: '$1M Occ / $2M Agg Standard', label: '$1M Occurrence / $2M General Aggregate (Recommended)' },
                { value: '$2M Occ / $4M Agg Expanded', label: '$2M Occurrence / $4M Expanded Aggregate' },
                { value: '$5,000,000 Commercial Umbrella', label: '$5,000,000 (Excess Commercial Liability)' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'workers': [
                { value: 'Statutory Limits / $500,000 Employers Liability', label: 'Statutory Limits / $500,000 Employer Liability' },
                { value: 'Statutory Limits / $1,000,000 Employers Liability', label: 'Statutory Limits / $1,000,000 Employer Liability (Recommended)' },
                { value: 'Statutory Limits / $2,000,000 Enterprise Employer', label: 'Statutory Limits / $2,000,000 Enterprise Coverage' },
                { value: 'custom', label: 'Other / Specify Headcount & Payroll...' }
            ],
            'commercial_auto': [
                { value: '$500,000 Combined Single Limit', label: '$500,000 Combined Single Limit (CSL)' },
                { value: '$1,000,000 Combined Single Limit', label: '$1,000,000 Combined Single Limit (Recommended)' },
                { value: '$2,000,000 Commercial Fleet Tier', label: '$2,000,000 (Commercial Fleet / Heavy Vehicles)' },
                { value: 'custom', label: 'Other / Specify Fleet Size & Budget...' }
            ],
            'surety': [
                { value: '$25,000 Bond Penal Sum', label: '$25,000 License & Permit Bond' },
                { value: '$50,000 Commercial Surety Bond', label: '$50,000 Commercial Surety Bond' },
                { value: '$100,000 Performance & Payment Bond', label: '$100,000 Performance / Payment Bond' },
                { value: '$250,000+ Contract Surety Limit', label: '$250,000+ Contract / Construction Bond' },
                { value: 'custom', label: 'Other / Specify Required Bond Amount...' }
            ],
            'group_benefits': [
                { value: 'Small Group Tier (2-20 Employees)', label: 'Small Group Plan (2 - 20 Employees)' },
                { value: 'Mid-Market Tier (21-100 Employees)', label: 'Mid-Market Comprehensive (21 - 100 Employees)' },
                { value: 'Enterprise Group (100+ Employees)', label: 'Enterprise Executive Group (100+ Employees)' },
                { value: 'custom', label: 'Other / Specify Employee Headcount...' }
            ],
            'specialty': [
                { value: '$1,000,000 Specialty Surplus', label: '$1,000,000 Excess & Surplus Limit' },
                { value: '$2,000,000 High-Hazard Risk Tier', label: '$2,000,000 Inland Marine / High-Hazard' },
                { value: '$5,000,000+ Tailored Policy', label: '$5,000,000+ Manuscript Specialized Policy' },
                { value: 'custom', label: 'Other / Specify Custom Limit...' }
            ],
            'home': [
                { value: '$250,000 Dwelling ($100k Liability)', label: '$250,000 Dwelling ($100,000 Liability)' },
                { value: '$500,000 Dwelling ($300k Liability)', label: '$500,000 Dwelling ($300,000 Liability - Recommended)' },
                { value: '$750,000 Dwelling ($500k Liability)', label: '$750,000 Dwelling ($500,000 Liability)' },
                { value: '$1,000,000+ High-Value Home Protection', label: '$1,000,000+ High-Value Home Protection' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'auto': [
                { value: '$50k/$100k/$50k State Plus', label: '$50,000 / $100,000 / $50,000 (State Plus)' },
                { value: '$100k/$300k/$100k Standard Protection', label: '$100,000 / $300,000 / $100,000 (Recommended)' },
                { value: '$250k/$500k/$250k Premium Shield', label: '$250,000 / $500,000 / $250,000 (Premium Shield)' },
                { value: '$500,000 Combined Single Limit', label: '$500,000 Combined Single Limit (Maximum Security)' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'life': [
                { value: '$250,000 Term Life Protection', label: '$250,000 Term Life Coverage' },
                { value: '$500,000 Family Protection Shield', label: '$500,000 Term / Whole Life (Recommended)' },
                { value: '$1,000,000 Key Person / Family Shield', label: '$1,000,000 Executive Term / Key Person' },
                { value: '$2,000,000+ High-Net-Worth Estate Plan', label: '$2,000,000+ High-Net-Worth Estate Plan' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'health': [
                { value: 'Bronze Essential Plan (HSA Eligible)', label: 'Bronze Essential Plan (HSA Eligible)' },
                { value: 'Silver Balanced Plan (Low Copays)', label: 'Silver Balanced Plan (Low Copays - Popular)' },
                { value: 'Gold Comprehensive Plan (Low Deductible)', label: 'Gold Comprehensive Plan (Low Deductible)' },
                { value: 'Platinum Zero-Deductible Elite Care', label: 'Platinum Zero-Deductible Elite Care' },
                { value: 'custom', label: 'Other / Specify Monthly Premium Budget...' }
            ],
            'umbrella': [
                { value: '$1,000,000 Personal Excess Liability', label: '$1,000,000 Personal Excess Liability' },
                { value: '$2,000,000 Personal Umbrella Recommended', label: '$2,000,000 Personal Umbrella (Recommended)' },
                { value: '$5,000,000 High-Net-Worth Shield', label: '$5,000,000 High-Net-Worth Umbrella' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ],
            'personal': [
                { value: '$250,000 Bundle Protection', label: '$250,000 Bundle (Home + Auto)' },
                { value: '$500,000 Multi-Policy Premier Shield', label: '$500,000 Multi-Policy Protection (Recommended)' },
                { value: '$1,000,000 Premier Family Bundle', label: '$1,000,000 Premier Family Umbrella Bundle' },
                { value: 'custom', label: 'Other / Specify Custom Amount...' }
            ]
        };

        function getCoverageCategory(raw) {
            const s = (raw || '').toLowerCase().trim();
            if (s.includes('workers')) return 'workers';
            if (s.includes('commercial auto') || s.includes('business auto') || s.includes('fleet')) return 'commercial_auto';
            if (s.includes('general liability') || s.includes('liability')) return 'liability';
            if (s.includes('commercial property') || s.includes('property')) return 'property';
            if (s.includes('surety') || s.includes('bond')) return 'surety';
            if (s.includes('group') || s.includes('benefit')) return 'group_benefits';
            if (s.includes('business') || s.includes('commercial') || s.includes('bop') || s.includes('enterprise')) return 'business';
            if (s.includes('specialty') || s.includes('surplus')) return 'specialty';
            if (s.includes('umbrella')) return 'umbrella';
            if (s.includes('health') || s.includes('medical')) return 'health';
            if (s.includes('life')) return 'life';
            if (s.includes('auto') || s.includes('car') || s.includes('vehicle')) return 'auto';
            if (s.includes('personal')) return 'personal';
            if (s.includes('home') || s.includes('house') || s.includes('dwelling')) return 'home';
            return 'business';
        }

        function detectPageInsuranceType() {
            const path = window.location.pathname.toLowerCase();
            if (path.includes('business-insurance')) return 'Business Owner Policy';
            if (path.includes('property-insurance')) return 'Commercial Property Coverage';
            if (path.includes('liability-insurance')) return 'General Liability';
            if (path.includes('commercial-auto')) return 'Commercial Auto';
            if (path.includes('surety-bond')) return 'Surety Bond';
            if (path.includes('group-benefits')) return 'Group Employee Benefits';
            if (path.includes('specialty-coverage')) return 'Specialty & Surplus Coverage';
            if (path.includes('auto-insurance')) return 'Auto Insurance';
            if (path.includes('life-insurance')) return 'Life Insurance';
            if (path.includes('health-insurance')) return 'Health Insurance';
            if (path.includes('umbrella-insurance')) return 'Umbrella Insurance';
            if (path.includes('personal-coverage')) return 'Personal Coverage';
            if (path.includes('home-insurance')) return 'Home Insurance';
            return null;
        }

        function findCoverageOptionIndex(select, search) {
            if (!select || !search) return -1;
            const s = search.toLowerCase().trim();

            let target = '';
            if (s.includes('business') || s.includes('commercial quote') || s.includes('commercial insurance') || s.includes('bop') || s.includes('commercial')) {
                target = 'business owner policy';
            } else if (s.includes('commercial auto')) {
                target = 'commercial auto';
            } else if (s.includes('property')) {
                target = 'property';
            } else if (s.includes('liability')) {
                target = 'general liability';
            } else if (s.includes('workers')) {
                target = 'workers';
            } else if (s.includes('surety') || s.includes('bond')) {
                target = 'surety bond';
            } else if (s.includes('group') || s.includes('benefit')) {
                target = 'group';
            } else if (s.includes('specialty') || s.includes('surplus')) {
                target = 'specialty';
            } else if (s.includes('auto') || s.includes('car')) {
                target = 'auto insurance';
            } else if (s.includes('home')) {
                target = 'home insurance';
            } else if (s.includes('life')) {
                target = 'life insurance';
            } else if (s.includes('health')) {
                target = 'health insurance';
            } else if (s.includes('umbrella')) {
                target = 'umbrella insurance';
            } else if (s.includes('personal')) {
                target = 'personal coverage';
            }

            if (target) {
                for (let i = 0; i < select.options.length; i++) {
                    const optVal = select.options[i].value.toLowerCase();
                    const optText = select.options[i].text.toLowerCase();
                    if (optVal.includes(target) || optText.includes(target)) {
                        return i;
                    }
                }
            }

            for (let i = 0; i < select.options.length; i++) {
                const optVal = select.options[i].value.toLowerCase();
                const optText = select.options[i].text.toLowerCase();
                if (optVal.includes(s) || optText.includes(s) || s.includes(optVal)) {
                    return i;
                }
            }
            return -1;
        }

        function handleCoverageTypeChange(presetAmount) {
            const typeSelect = document.getElementById('coverage-type');
            const amountSelect = document.getElementById('quote-amount');
            if (!typeSelect || !amountSelect) return;

            const cat = getCoverageCategory(typeSelect.value);
            const tiers = AMOUNT_TIERS[cat] || AMOUNT_TIERS['business'];

            amountSelect.innerHTML = '';
            tiers.forEach(t => {
                const opt = document.createElement('option');
                opt.value = t.value;
                opt.textContent = t.label;
                amountSelect.appendChild(opt);
            });

            if (presetAmount) {
                const searchAmt = presetAmount.toLowerCase();
                let matched = false;
                for (let i = 0; i < amountSelect.options.length; i++) {
                    if (amountSelect.options[i].value.toLowerCase().includes(searchAmt) || 
                        amountSelect.options[i].text.toLowerCase().includes(searchAmt)) {
                        amountSelect.selectedIndex = i;
                        matched = true;
                        break;
                    }
                }
                if (!matched) {
                    amountSelect.value = 'custom';
                    const customInput = document.getElementById('quote-custom-amount');
                    if (customInput) customInput.value = presetAmount;
                }
            } else {
                amountSelect.selectedIndex = tiers.length > 1 ? 1 : 0;
            }

            handleQuoteAmountChange();
        }

        function handleQuoteAmountChange() {
            const amountSelect = document.getElementById('quote-amount');
            const customGroup = document.getElementById('custom-amount-group');
            if (!amountSelect || !customGroup) return;

            if (amountSelect.value === 'custom') {
                customGroup.style.display = 'block';
                const customInput = document.getElementById('quote-custom-amount');
                if (customInput) customInput.focus();
            } else {
                customGroup.style.display = 'none';
            }
        }

        function openQuoteModal(type, amount) {
            const select = document.getElementById('coverage-type');
            const detectedType = type || detectPageInsuranceType();
            if (select && detectedType) {
                const idx = findCoverageOptionIndex(select, detectedType);
                if (idx >= 0) {
                    select.selectedIndex = idx;
                }
            }
            handleCoverageTypeChange(amount);

            const modal = document.getElementById('quoteModal');
            if (modal) modal.classList.add('active');
        }

        function closeQuoteModal() {
            const modal = document.getElementById('quoteModal');
            if (modal) modal.classList.remove('active');
        }

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            const modal = document.getElementById('quoteModal');
            if (e.target === modal) {
                closeQuoteModal();
            }
        });

        // Initialize coverage amounts when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            handleCoverageTypeChange();
        });

        function handleQuoteSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('submitQuoteBtn');
            const msg = document.getElementById('quoteSuccessMessage');
            const name = document.getElementById('quote-name')?.value || '';
            const email = document.getElementById('quote-email')?.value || '';
            const phone = document.getElementById('quote-phone')?.value || '';
            const zip = document.getElementById('quote-zip')?.value || '';
            const typeSelect = document.getElementById('coverage-type');
            const amountSelect = document.getElementById('quote-amount');
            const customAmountInput = document.getElementById('quote-custom-amount');

            let type = 'home';
            if (typeSelect) {
                const val = typeSelect.value.toLowerCase();
                if (val.includes('workers')) type = 'workers_comp';
                else if (val.includes('general liability') || val.includes('liability')) type = 'general_liability';
                else if (val.includes('surety')) type = 'surety_bond';
                else if (val.includes('commercial auto')) type = 'commercial_auto';
                else if (val.includes('commercial property') || val.includes('property coverage') || val.includes('property')) type = 'commercial_property';
                else if (val.includes('business owner') || val.includes('bop') || val.includes('business')) type = 'bop';
                else if (val.includes('group') || val.includes('benefit')) type = 'group_benefits';
                else if (val.includes('specialty') || val.includes('surplus')) type = 'specialty';
                else if (val.includes('health')) type = 'health';
                else if (val.includes('life')) type = 'life';
                else if (val.includes('umbrella')) type = 'umbrella';
                else if (val.includes('auto')) type = 'auto';
                else if (val.includes('personal')) type = 'personal';
                else type = 'home';
            }

            let coverageAmount = '';
            if (amountSelect) {
                if (amountSelect.value === 'custom') {
                    const customVal = customAmountInput?.value?.trim();
                    coverageAmount = customVal ? ('Custom Amount: ' + customVal) : 'Custom Amount Requested';
                } else {
                    coverageAmount = amountSelect.options[amountSelect.selectedIndex]?.text || amountSelect.value;
                }
            }

            const sourcePage = window.location.pathname + window.location.search + window.location.hash;

            btn.innerHTML = 'Connecting Underwriting Database...';
            btn.disabled = true;

            fetch('/quotes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name,
                    email,
                    phone,
                    zip,
                    type,
                    coverage_amount: coverageAmount,
                    amount: coverageAmount,
                    coverage_tier: coverageAmount,
                    source_page: sourcePage
                })
            })
            .then(r => r.json())
            .then(data => {
                btn.style.display = 'none';
                msg.textContent = '✓ Quote Request #' + (data.quote_ref || 'Received') + ' saved! An underwriter is matching your rates.';
                msg.style.display = 'block';
                setTimeout(() => {
                    closeQuoteModal();
                    btn.style.display = 'block';
                    btn.disabled = false;
                    btn.innerHTML = 'View Instant Quote Estimate &rarr;';
                    msg.style.display = 'none';
                }, 2600);
            })
            .catch(() => {
                btn.style.display = 'none';
                msg.textContent = '✓ Request received! An agent is matching the best plan for you right now.';
                msg.style.display = 'block';
                setTimeout(() => {
                    closeQuoteModal();
                    btn.style.display = 'block';
                    btn.disabled = false;
                    btn.innerHTML = 'View Instant Quote Estimate &rarr;';
                    msg.style.display = 'none';
                }, 2200);
            });
        }

        // Mobile menu toggle with accordion support
        const toggleBtn = document.getElementById('mobile-toggle');
        const mainNav = document.getElementById('main-nav');
        if (toggleBtn && mainNav) {
            toggleBtn.addEventListener('click', () => {
                const isOpen = mainNav.classList.toggle('is-open');
                toggleBtn.classList.toggle('is-active', isOpen);
                document.body.classList.toggle('mobile-menu-open', isOpen);
            });

            // Handle mobile accordion dropdowns
            mainNav.querySelectorAll('.nav-dropdown').forEach(dropdown => {
                const link = dropdown.querySelector('.nav-link');
                if (link) {
                    link.addEventListener('click', (e) => {
                        if (window.innerWidth <= 860) {
                            e.preventDefault();
                            // Toggle this dropdown and close others
                            const wasActive = dropdown.classList.contains('active-mobile');
                            mainNav.querySelectorAll('.nav-dropdown').forEach(d => d.classList.remove('active-mobile'));
                            if (!wasActive) {
                                dropdown.classList.add('active-mobile');
                            }
                        }
                    });
                }
            });

            // Close mobile menu when clicking any sub-link
            mainNav.querySelectorAll('.dropdown-flyout a').forEach(link => {
                link.addEventListener('click', () => {
                    mainNav.classList.remove('is-open');
                    toggleBtn.classList.remove('is-active');
                    document.body.classList.remove('mobile-menu-open');
                });
            });
        }
    </script>

    <script src="{{ asset('js/surebound-modal.js') }}"></script>
    @yield('scripts')
</body>
</html>
