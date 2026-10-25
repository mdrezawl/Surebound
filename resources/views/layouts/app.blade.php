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
                    <a href="{{ route('home') }}" aria-label="Surebound Home" style="display:inline-block;">
                        <img src="{{ asset('images/logo.png') }}" alt="Surebound" class="footer-logo-img">
                    </a>
                    <p class="footer-brand-desc">
                        We provide trusted insurance solutions for individuals, families and businesses. Because your tomorrow matters.
                    </p>
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
            const phone = document.getElementById('quote-phone')?.value || '';
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
                body: JSON.stringify({ name, email, phone, zip, type })
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
