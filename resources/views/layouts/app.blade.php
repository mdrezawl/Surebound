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
    
    <!-- Google Fonts: Crimson Pro & Inter (Brand Guidelines 2026) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:wght@700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/surebound.css') }}?v={{ file_exists(public_path('css/surebound.css')) ? filemtime(public_path('css/surebound.css')) : '2.0' }}">
    <link rel="stylesheet" href="{{ asset('css/surebound-modal.css') }}?v={{ file_exists(public_path('css/surebound-modal.css')) ? filemtime(public_path('css/surebound-modal.css')) : '2.0' }}">
    <link rel="stylesheet" href="{{ asset('css/quote-flow.css') }}?v={{ file_exists(public_path('css/quote-flow.css')) ? filemtime(public_path('css/quote-flow.css')) : '1.0' }}">
    <!-- AI Search & LLM Discovery Manifest (https://llmstxt.org) -->
    <link rel="llms-txt" type="text/markdown" href="{{ url('/llms.txt') }}" title="LLM Machine-Readable Manifest">
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
                <div class="nav-dropdown {{ request()->routeIs('life-insurance', 'personal-coverage') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('life-insurance', 'personal-coverage') ? 'active' : '' }}">
                        <span>Personal</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('life-insurance') }}" class="{{ request()->routeIs('life-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('life-insurance'))<span class="active-dot">•</span>@endif Life Insurance
                        </a>
                    </div>
                </div>

                <!-- Commercial -->
                <div class="nav-dropdown {{ request()->routeIs('business-insurance', 'property-insurance', 'liability-insurance', 'group-benefits', 'workers-compensation', 'commercial-auto-insurance', 'surety-bond') ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="nav-link {{ request()->routeIs('business-insurance', 'property-insurance', 'liability-insurance', 'group-benefits', 'workers-compensation', 'commercial-auto-insurance', 'surety-bond') ? 'active' : '' }}">
                        <span>Commercial</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <div class="dropdown-flyout">
                        <a href="{{ route('business-insurance') }}" class="{{ request()->routeIs('business-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('business-insurance'))<span class="active-dot">•</span>@endif Business Owner Policy (BOP)
                        </a>
                        <a href="{{ route('liability-insurance') }}" class="{{ request()->routeIs('liability-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('liability-insurance'))<span class="active-dot">•</span>@endif General Liability
                        </a>
                        <a href="{{ route('property-insurance') }}" class="{{ request()->routeIs('property-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('property-insurance'))<span class="active-dot">•</span>@endif Commercial Property
                        </a>
                        <a href="{{ route('workers-compensation') }}" class="{{ request()->routeIs('workers-compensation') ? 'active' : '' }}">
                            @if(request()->routeIs('workers-compensation'))<span class="active-dot">•</span>@endif Workers' Compensation
                        </a>
                        <a href="{{ route('commercial-auto-insurance') }}" class="{{ request()->routeIs('commercial-auto-insurance') ? 'active' : '' }}">
                            @if(request()->routeIs('commercial-auto-insurance'))<span class="active-dot">•</span>@endif Commercial Auto
                        </a>
                        <a href="{{ route('surety-bond') }}" class="{{ request()->routeIs('surety-bond') ? 'active' : '' }}">
                            @if(request()->routeIs('surety-bond'))<span class="active-dot">•</span>@endif Surety Bond
                        </a>
                        <a href="{{ route('group-benefits') }}" class="{{ request()->routeIs('group-benefits') ? 'active' : '' }}">
                            @if(request()->routeIs('group-benefits'))<span class="active-dot">•</span>@endif Group Employee Benefits
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
                        <a href="mailto:{{ $siteContact['support_email'] ?? 'support@sureboundinsurance.com' }}" style="display: inline-flex; align-items: center; gap: 8px; color: #94a3b8; text-decoration: none; transition: color 0.2s;">
                            <svg style="width: 14px; height: 14px; color: #38bdf8; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            <span>{{ $siteContact['support_email'] ?? 'support@sureboundinsurance.com' }}</span>
                        </a>
                        <div style="display: inline-flex; align-items: flex-start; gap: 8px; color: #94a3b8;">
                            <svg style="width: 14px; height: 14px; color: #38bdf8; flex-shrink: 0; margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                            <span>{{ $siteContact['hq_address'] ?? '100 N Tampa St, Suite 2500, Tampa, FL 33602' }}</span>
                        </div>
                    </div>

                    <div class="footer-social-row" style="margin-top: 18px; display: flex; align-items: center; gap: 10px;">
                        <a href="{{ $siteContact['facebook_url'] ?? 'https://www.facebook.com/share/1FMYaUktDN/' }}" target="_blank" rel="noopener noreferrer" class="footer-social-btn" aria-label="Follow Surebound on Facebook" title="Facebook">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Coverage -->
                <div class="footer-nav-col">
                    <h4>Coverage</h4>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('business-insurance') }}">Business Owner Policy (BOP)</a></li>
                        <li><a href="{{ route('liability-insurance') }}">General Liability</a></li>
                        <li><a href="{{ route('property-insurance') }}">Commercial Property</a></li>
                        <li><a href="{{ route('workers-compensation') }}">Workers' Compensation</a></li>
                        <li><a href="{{ route('commercial-auto-insurance') }}">Commercial Auto</a></li>
                        <li><a href="{{ route('life-insurance') }}">Life Insurance</a></li>
                        <li><a href="{{ route('surety-bond') }}">Surety Bond</a></li>
                        <li><a href="{{ route('group-benefits') }}">Group Benefits</a></li>
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
         INTERACTIVE GET A QUOTE MULTI-STEP FLOW MODAL
         ========================================== -->
    <div class="modal-overlay" id="quoteModal" role="dialog" aria-modal="true" aria-labelledby="quoteModalTitle" aria-hidden="true">
        <div class="modal-box quote-flow-modal-box">
            <button class="quote-modal-close" onclick="closeQuoteModal()" aria-label="Close quote dialog">&times;</button>
            <div class="quote-flow-modal-header">
                <a href="{{ url('/') }}" aria-label="Surebound Home" style="display: inline-flex; align-items: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Surebound Insurance">
                </a>
            </div>
            <div id="quoteModalTitle" style="display:none;">Request an Insurance Quote</div>
            <main class="quote-flow-card" id="quoteFlowCard" aria-live="polite">
                <div style="display:none;"><input type="tel" id="quote-phone"></div>
            </main>
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

    <script src="{{ asset('js/quote-flow.js') }}?v={{ file_exists(public_path('js/quote-flow.js')) ? filemtime(public_path('js/quote-flow.js')) : '1.0' }}"></script>
    <script src="{{ asset('js/surebound-modal.js') }}"></script>
    @yield('scripts')
</body>
</html>
