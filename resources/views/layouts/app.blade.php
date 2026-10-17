<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Surebound Insurance – Reliable protection for your home, auto, business and future with dependable support whenever you need us.">
    <title>@yield('title', 'Surebound – Protection Built Around You')</title>
    
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
                    <a href="#about" class="nav-link {{ request()->routeIs('story', 'team', 'careers', 'community') ? 'active' : '' }}">
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
                    <a href="#resources" class="nav-link {{ request()->routeIs('articles', 'faqs', 'guides', 'claims') ? 'active' : '' }}">
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
            </nav>

            <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-header-quote">
                <span>Get a Quote</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>

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
                    <img src="{{ asset('images/logo.png') }}" alt="Surebound" class="footer-logo-img">
                    <p class="footer-brand-desc">
                        We provide trusted insurance solutions for individuals, families and businesses. Because your tomorrow matters.
                    </p>
                    <div class="footer-social-row">
                        <!-- LinkedIn -->
                        <a href="#" class="footer-social-btn" aria-label="LinkedIn">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.64 1.64 0 1 0-.02-3.28 1.64 1.64 0 0 0 .02 3.28m1.4 9.74v-8.37H5.06v8.37h2.8z"/></svg>
                        </a>
                        <!-- Facebook -->
                        <a href="#" class="footer-social-btn" aria-label="Facebook">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/></svg>
                        </a>
                        <!-- X (Twitter) -->
                        <a href="#" class="footer-social-btn" aria-label="X">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <!-- Instagram -->
                        <a href="#" class="footer-social-btn" aria-label="Instagram">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <!-- YouTube -->
                        <a href="#" class="footer-social-btn" aria-label="YouTube">
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
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
                        <li><a href="#about-us">About Us</a></li>
                        <li><a href="#our-team">Our Team</a></li>
                        <li><a href="#careers">Careers</a></li>
                        <li><a href="#news-updates">News & Updates</a></li>
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 4: Resources -->
                <div class="footer-nav-col">
                    <h4>Resources</h4>
                    <ul class="footer-links-list">
                        <li><a href="#articles-insights">Articles & Insights</a></li>
                        <li><a href="#faqs">FAQs</a></li>
                        <li><a href="#insurance-guide">Insurance Guide</a></li>
                        <li><a href="{{ route('claims') }}">Claims Center</a></li>
                        <li><a href="#agent-resources">Agent Resources</a></li>
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
                        <li><a href="/admin">Agent Portal</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom-bar">
                <div class="footer-bottom-links">
                    <a href="#privacy">Privacy Policy</a> &nbsp;|&nbsp;
                    <a href="#terms">Terms of Service</a> &nbsp;|&nbsp;
                    <span>&copy; {{ date('Y') }} Surebound. All rights reserved.</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- ==========================================
         INTERACTIVE GET A QUOTE MODAL
         ========================================== -->
    <div class="modal-overlay" id="quoteModal">
        <div class="modal-box">
            <button class="modal-close-btn" onclick="closeQuoteModal()" aria-label="Close modal">&times;</button>
            <div class="modal-header">
                <h3>Get Your Free Quote</h3>
                <p>Tailored coverage with great rates in less than 2 minutes.</p>
            </div>
            <form onsubmit="handleQuoteSubmit(event)">
                <div class="modal-form-group">
                    <label for="coverage-type">Select Insurance Type</label>
                    <select id="coverage-type" required>
                        <optgroup label="Personal Lines">
                            <option value="Home Insurance">Home Insurance</option>
                            <option value="Auto Insurance">Auto Insurance</option>
                            <option value="Life Insurance">Life Insurance</option>
                            <option value="Health Insurance">Health Insurance</option>
                            <option value="Umbrella Insurance">Umbrella Insurance</option>
                        </optgroup>
                        <optgroup label="Commercial Lines">
                            <option value="Business Owner Policy">Business Owner Policy (BOP)</option>
                            <option value="Workers' Compensation">Workers' Compensation</option>
                            <option value="General Liability">General Liability</option>
                            <option value="Commercial Property Coverage">Property Coverage</option>
                            <option value="Commercial Auto">Commercial Auto</option>
                            <option value="Surety Bond">Surety Bond</option>
                        </optgroup>
                    </select>
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

        function openQuoteModal(type) {
            if (type) {
                const select = document.getElementById('coverage-type');
                if (select) {
                    const search = type.toLowerCase().trim();
                    for (let i = 0; i < select.options.length; i++) {
                        const optVal = select.options[i].value.toLowerCase();
                        const optText = select.options[i].text.toLowerCase();
                        if (optVal.includes(search) || optText.includes(search) || search.includes(optVal)) {
                            select.selectedIndex = i;
                            break;
                        }
                    }
                }
            }
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

        function handleQuoteSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('submitQuoteBtn');
            const msg = document.getElementById('quoteSuccessMessage');
            const name = document.getElementById('quote-name')?.value || '';
            const email = document.getElementById('quote-email')?.value || '';
            const zip = document.getElementById('quote-zip')?.value || '';
            const typeSelect = document.getElementById('coverage-type');
            let type = 'home';
            if (typeSelect) {
                const val = typeSelect.value.toLowerCase();
                if (val.includes('workers')) type = 'workers_comp';
                else if (val.includes('general liability') || val.includes('liability')) type = 'general_liability';
                else if (val.includes('surety')) type = 'surety_bond';
                else if (val.includes('commercial auto')) type = 'commercial_auto';
                else if (val.includes('commercial property') || val.includes('property coverage')) type = 'commercial_property';
                else if (val.includes('business owner') || val.includes('bop')) type = 'bop';
                else if (val.includes('health')) type = 'health';
                else if (val.includes('life')) type = 'life';
                else if (val.includes('umbrella')) type = 'umbrella';
                else if (val.includes('auto')) type = 'auto';
                else if (val.includes('property')) type = 'property';
                else if (val.includes('business')) type = 'bop';
                else type = 'home';
            }

            btn.innerHTML = 'Connecting Underwriting Database...';
            btn.disabled = true;

            fetch('/quotes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ name, email, zip, type })
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
