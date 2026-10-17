@extends('layouts.app')

@section('title', 'Surety Bonds – Commercial, Contract & License Bonds | Surebound')

@section('content')

    <!-- ==========================================
         HERO SECTION (SURETY BOND & CONTRACT GUARANTEES)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-surety-bond.jpg') }}" 
                alt="Surety Bonds and Commercial Contract Guarantees" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'COMMERCIAL SURETY &amp; CONTRACT GUARANTEES' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Guaranteed Performance &amp;<br>Financial Compliance on Demand' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Secure project bid capacity, meet state licensing requirements, and protect contractual obligations with instant online underwriting and Treasury-listed surety backing.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#bond-quote-calculator" class="btn-primary-hero">
                        <span>Get Instant Bond Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="#bond-solutions" class="btn-outline-hero">
                        <span>Explore Bond Solutions</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card positioned over the photo in the container -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Instant Bond Issuance' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Over 98% of license and permit bonds approved instantly' }}</span>
                    </div>
                    <div class="hero-card-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR (4 SURETY PILLARS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. Instant Digital Issuance -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? 'Instant Digital Issuance' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Fast online approvals with instant downloadable e-bonds and digital power-of-attorney seals.' }}</p>
                </div>

                <!-- 2. Treasury-Listed Sureties -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5M4.5 21V10.5" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? 'Treasury-Listed (T-Listed) Sureties' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? 'Accepted by all 50 states, federal agencies, municipal boards, and commercial developers nationwide.' }}</p>
                </div>

                <!-- 3. Competitive Rates from 0.75% -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0H3m-.75 0a.75.75 0 0 1-.75-.75V4.5m0 0h1.5m0 0h16.5m0 0h1.5m0 0v.75a.75.75 0 0 1-.75.75H21m0 0h.75m-.75 0a.75.75 0 0 1-.75-.75V4.5m-18 0h18M3.75 19.5v-1.5a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 .75.75v1.5m-16.5 0h16.5" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? 'Competitive Rates from 0.75%' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Tier-1 rates tailored to your business credit, contractor track record, and bonding line history.' }}</p>
                </div>

                <!-- 4. Automated Agency Filings -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'Automated Agency Filings' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Direct electronic filing to state licensing boards and obligees to eliminate licensing delays.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         INLINE SURETY BOND QUOTE FORM (ON-PAGE)
         ========================================== -->
    <section class="quote-calculator-section" id="bond-quote-calculator">
        <div class="container">
            <div class="fleet-quote-card">
                <div class="fleet-quote-header">
                    <span class="fleet-quote-badge">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        ONLINE SURETY UNDERWRITING
                    </span>
                    <h2 class="fleet-quote-title">Calculate Your Surety Bond Quote</h2>
                    <p class="fleet-quote-subtitle">
                        Enter your business and bonding requirements below for instant rates, fast electronic power-of-attorney delivery, and underwriter review in under 2 minutes.
                    </p>
                </div>

                <!-- Success Confirmation Box -->
                <div id="bondQuoteSuccessAlert" class="fleet-alert-success" style="display: none;">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div>
                        <strong style="display: block; font-size: 16px; margin-bottom: 4px;" id="bondSuccessMsgTitle">Surety Bond Quote Request Submitted Successfully!</strong>
                        <span id="bondSuccessMsgBody" style="font-size: 14.5px; line-height: 1.5;">Your surety bond reference has been generated. Our senior bond underwriter is preparing your custom proposal now.</span>
                    </div>
                </div>

                <form id="suretyBondQuoteForm" onsubmit="submitBondQuote(event)">
                    @csrf
                    <input type="hidden" name="type" value="surety_bond">

                    <div class="fleet-quote-grid">
                        <!-- Company Name -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Company / Principal Name <span class="req">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="company_name" 
                                class="fleet-form-input" 
                                placeholder="e.g. Sterling Construction & Infrastructure LLC" 
                                required
                            >
                        </div>

                        <!-- Contact Full Name -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Contact Full Name <span class="req">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                class="fleet-form-input" 
                                placeholder="e.g. David Vance" 
                                required
                            >
                        </div>

                        <!-- Work Email -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Work Email Address <span class="req">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                class="fleet-form-input" 
                                placeholder="dvance@sterlingcontracting.com" 
                                required
                            >
                        </div>

                        <!-- Phone Number -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Direct Phone Number <span class="req">*</span>
                            </label>
                            <input 
                                type="tel" 
                                name="phone" 
                                class="fleet-form-input" 
                                placeholder="(555) 789-0123" 
                                required
                            >
                        </div>

                        <!-- Bond Type -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Surety Bond Classification <span class="req">*</span>
                            </label>
                            <select name="bond_type" class="fleet-form-select" required>
                                <option value="" disabled selected>Select bond classification...</option>
                                <option value="Contract & Performance Bond">Contract &amp; Performance Bond (Bid / Payment / Maintenance)</option>
                                <option value="Contractor License & Permit Bond">Contractor License &amp; Municipal Permit Bond</option>
                                <option value="Freight Broker BMC-84 Bond">Freight Broker BMC-84 Bond ($75k FMCSA)</option>
                                <option value="Auto Dealer & DMV Bond">Auto Dealer &amp; DMV Licensing Bond</option>
                                <option value="Court & Probate Fiduciary Bond">Court &amp; Probate Fiduciary Bond</option>
                                <option value="Fidelity & ERISA Employee Bond">Fidelity &amp; ERISA 401(k) Employee Bond</option>
                                <option value="Other Commercial Surety Bond">Other Commercial Surety Bond</option>
                            </select>
                        </div>

                        <!-- Bond Amount / Limit -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Required Bond Amount / Limit <span class="req">*</span>
                            </label>
                            <select name="bond_amount" class="fleet-form-select" required>
                                <option value="" disabled selected>Select required bond limit...</option>
                                <option value="$10,000 Standard Bond">$10,000 Standard License Bond</option>
                                <option value="$25,000 State Bond">$25,000 State Compliance Bond</option>
                                <option value="$50,000 Municipal Bond">$50,000 Municipal Contractor Bond</option>
                                <option value="$75,000 BMC-84 Bond">$75,000 FMCSA BMC-84 Bond</option>
                                <option value="$100,000 Commercial Bond">$100,000 Commercial Trade Bond</option>
                                <option value="$250,000 - $500,000 Contract Line">$250,000 - $500,000 Contract Line (No Financials)</option>
                                <option value="$1,000,000+ Enterprise Performance">$1,000,000+ Enterprise Performance Line</option>
                            </select>
                        </div>

                        <!-- State / Garaging ZIP Code -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Principal State / ZIP Code <span class="req">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="zip" 
                                class="fleet-form-input" 
                                placeholder="e.g. 75001 or State abbreviation" 
                                maxlength="10" 
                                required
                            >
                        </div>

                        <!-- Credit Rating / Underwriting Profile -->
                        <div class="fleet-form-group">
                            <label class="fleet-form-label">
                                Applicant Credit Profile
                            </label>
                            <select name="credit_tier" class="fleet-form-select">
                                <option value="Tier 1 (700+ Excellent Credit)" selected>Tier 1 (700+ Excellent Credit) – Lowest Rates</option>
                                <option value="Tier 2 (650 - 699 Good Credit)">Tier 2 (650 - 699 Good Credit)</option>
                                <option value="Tier 3 (600 - 649 Fair Credit)">Tier 3 (600 - 649 Fair Credit)</option>
                                <option value="Bad Credit / Non-Standard Program">Challenged Credit / Non-Standard Program (Approved)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="bondSubmitBtn" class="fleet-submit-btn">
                        <span id="bondSubmitBtnText">Calculate My Surety Bond Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18" id="bondSubmitIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>

                    <!-- Trust Bar -->
                    <div class="fleet-trust-bar">
                        <div class="fleet-trust-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <span>256-Bit SSL Encrypted Submission</span>
                        </div>
                        <div class="fleet-trust-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>U.S. Treasury T-Listed Surety Backing</span>
                        </div>
                        <div class="fleet-trust-item">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                            <span>Digital Power-of-Attorney &amp; e-Bonds</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- ==========================================
         SURETY BOND SOLUTIONS (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="bond-solutions">
        <div class="container">
            <p class="section-eyebrow">COMMERCIAL SURETY SOLUTIONS</p>
            <h2 class="section-title">Comprehensive Bonds for Every Commercial Requirement</h2>
            <p class="section-subtitle">Guaranteed compliance, performance, and financial credibility backed by national Treasury-approved sureties.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Contract & Performance Bonds -->
                <div class="coverage-card" onclick="openQuoteModal('Surety Bond')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_1_title'] ?? 'Contract & Performance Bonds' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_1_desc'] ?? 'Guarantees project completion, subcontractor payments, and warranty maintenance for general contractors and municipal infrastructure bids.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. License & Permit Bonds -->
                <div class="coverage-card" onclick="openQuoteModal('Surety Bond')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_2_title'] ?? 'License & Permit Bonds' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_2_desc'] ?? 'Mandatory state and municipal compliance bonds for general contractors, electricians, plumbers, HVAC technicians, and licensed trade operators.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Commercial & Court Bonds -->
                <div class="coverage-card" onclick="openQuoteModal('Surety Bond')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.5M4.5 21V10.5" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_3_title'] ?? 'Commercial & Court Bonds' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_3_desc'] ?? 'Guarantees fiduciary duties, estate administration, judicial appeals, receiverships, and guardian responsibilities required by probate courts.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Freight Broker BMC-84 Bonds -->
                <div class="coverage-card" onclick="openQuoteModal('Surety Bond')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_4_title'] ?? 'Freight Broker BMC-84 Bonds' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_4_desc'] ?? 'Meets the mandatory $75,000 USDOT/FMCSA financial security requirement for transportation freight brokers and forwarders.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Auto Dealer & DMV Bonds -->
                <div class="coverage-card" onclick="openQuoteModal('Surety Bond')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_5_title'] ?? 'Auto Dealer & DMV Bonds' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_5_desc'] ?? 'Protects car buyers and satisfies state Department of Motor Vehicles licensing mandates for wholesale and retail motor vehicle dealers.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Fidelity & ERISA Employee Bonds -->
                <div class="coverage-card" onclick="openQuoteModal('Surety Bond')">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">{{ $content['card_6_title'] ?? 'Fidelity & ERISA Employee Bonds' }}</h3>
                        <p class="coverage-card-desc">{{ $content['card_6_desc'] ?? 'Protects company assets and 401(k) pension plans against employee theft, embezzlement, fraud, and unlawful misappropriation.' }}</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         GUIDANCE / SURETY CAPACITY ADVISOR
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Surety Advisor Photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset('images/surety-advisor-consultation.jpg') }}" 
                        alt="Senior Surety Bond Underwriter Consulting Commercial Client" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'SURETY CAPACITY &amp; BONDING STRATEGY' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Expand Your Bidding Capacity with Dedicated Surety Underwriters' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'Unlike traditional commercial insurance that covers unexpected losses, surety bonds serve as a strict tripartite guarantee of your operational ability and financial integrity. At Surebound, our senior bond underwriters help growing contractors and enterprises establish generous single and aggregate bonding lines, enabling you to pursue larger public and private tenders with total confidence.' }}
                    </p>
                    <a href="#bond-quote-calculator" class="btn-learn-more">
                        <span>Calculate Bond Premium</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         WHY CHOOSE SUREBOUND FOR SURETY BONDS
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">THE SUREBOUND ADVANTAGE</p>
            <h2 class="section-title">Why Leading Enterprises &amp; Contractors Choose Surebound</h2>

            <div class="why-grid">
                <!-- 1 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_1_title'] ?? 'No Financials Required up to $500k' }}</h3>
                    <p class="why-card-desc">{{ $content['why_1_desc'] ?? 'Streamlined credit-only underwriting programs for qualified contractors on jobs up to $500,000.' }}</p>
                </div>

                <!-- 2 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_2_title'] ?? 'All 50 States & Federal Jurisdiction' }}</h3>
                    <p class="why-card-desc">{{ $content['why_2_desc'] ?? 'Licensed across all US jurisdictions with approved power-of-attorney authority for rapid dispatch.' }}</p>
                </div>

                <!-- 3 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6H2.25m0 0H3m-.75 0a.75.75 0 0 1-.75-.75V4.5m0 0h1.5m0 0h16.5m0 0h1.5m0 0v.75a.75.75 0 0 1-.75.75H21m0 0h.75m-.75 0a.75.75 0 0 1-.75-.75V4.5m-18 0h18M3.75 19.5v-1.5a.75.75 0 0 1 .75-.75h15a.75.75 0 0 1 .75.75v1.5m-16.5 0h16.5" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_3_title'] ?? 'Flexible Collateral Options' }}</h3>
                    <p class="why-card-desc">{{ $content['why_3_desc'] ?? 'Multiple non-collateral pathways and bad-credit rehabilitation programs to keep your projects moving.' }}</p>
                </div>

                <!-- 4 -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">{{ $content['why_4_title'] ?? 'Dedicated Bond Specialists' }}</h3>
                    <p class="why-card-desc">{{ $content['why_4_desc'] ?? 'Direct phone access to bond officers who understand construction bidding deadlines and tender schedules.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)
         ========================================== -->
    <section class="faq-section" id="faqs">
        <div class="container faq-container">
            <p class="section-eyebrow" style="text-align: center;">COMMON QUESTIONS</p>
            <h2 class="section-title" style="text-align: center;">Frequently Asked Questions About Surety Bonds</h2>
            <p class="section-subtitle" style="text-align: center;">Everything you need to know about commercial surety bonds, licensing obligations, rates, and underwriting.</p>

            <div class="faq-accordion">
                <!-- FAQ 1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'What is the difference between a Surety Bond and Insurance?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_1_answer'] ?? 'Commercial insurance is a two-party contract designed to protect your business against accidental loss or damage. A Surety Bond is a three-party contract (Principal, Obligee, and Surety) where the surety guarantees to the obligee that the principal will fulfill contractual or legal obligations. If the surety pays a claim, the principal is legally obligated to indemnify the surety.' }}
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'How much does a Surety Bond typically cost?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_2_answer'] ?? 'Bond costs (premiums) are a small percentage of the total bond amount, typically ranging from 0.75% to 2.5% per year for applicants with solid credit. For higher-risk bonds or non-standard credit, rates typically range from 3% to 7%. For example, a standard $10,000 contractor license bond often costs only $100 to $150 per year.' }}
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'Can I get a Surety Bond with poor or challenged credit?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_3_answer'] ?? 'Yes. Surebound partners with specialized non-standard surety markets that evaluate your operational experience, business assets, and references. We offer bad-credit bond programs for almost all license, permit, and commercial bonds.' }}
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'How quickly can I receive my official bond certificate?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_4_answer'] ?? 'Most license and permit bonds, notary bonds, and freight broker bonds are issued digitally within minutes upon payment. Complex contract performance bonds can usually be underwritten and approved within 24 to 48 hours.' }}
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_5_question'] ?? 'What happens if a claim is filed against my surety bond?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {{ $content['faq_5_answer'] ?? 'If a claim is submitted, the surety conducts a thorough investigation to determine its validity. If the claim is valid and the principal does not resolve the issue, the surety settles the claim with the obligee up to the bond penal sum. However, under the General Indemnity Agreement, the principal is legally responsible to reimburse the surety in full.' }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         BOTTOM CTA BANNER WITH MOUNTAIN SILHOUETTE
         ========================================== -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-text-wrap">
                <h2>{!! $content['cta_title'] ?? 'Ready to secure your surety bond line with competitive rates?' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Apply online in under 2 minutes or speak directly with our senior surety underwriters.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="#bond-quote-calculator" class="btn-cta-white">
                    <span>Get a Bond Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="javascript:void(0)" onclick="openQuoteModal('Surety Bond')" class="btn-cta-transparent">
                    <span>Talk to a Bond Advisor</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        function toggleFaq(btn) {
            const item = btn.parentElement;
            const wasActive = item.classList.contains('active');
            
            // Close all open items
            document.querySelectorAll('.faq-item').forEach(el => {
                el.classList.remove('active');
            });

            // Toggle current if it wasn't active
            if (!wasActive) {
                item.classList.add('active');
            }
        }

        async function submitBondQuote(e) {
            e.preventDefault();
            const form = document.getElementById('suretyBondQuoteForm');
            const submitBtn = document.getElementById('bondSubmitBtn');
            const btnText = document.getElementById('bondSubmitBtnText');
            const alertBox = document.getElementById('bondQuoteSuccessAlert');
            const alertTitle = document.getElementById('bondSuccessMsgTitle');
            const alertBody = document.getElementById('bondSuccessMsgBody');

            submitBtn.disabled = true;
            btnText.textContent = 'Calculating Bond Rate...';

            const formData = new FormData(form);

            try {
                const response = await fetch('{{ route("quotes.store") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    alertTitle.textContent = 'Surety Bond Quote Request Received (' + (data.quote_ref || 'Q-BOND') + ')';
                    alertBody.textContent = data.message || 'Thank you! Your surety bond quote request has been securely submitted. A senior bond officer is preparing your rate options now.';
                    alertBox.style.display = 'flex';
                    form.reset();
                    alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    alert('Unable to submit quote. Please verify required fields and try again.');
                }
            } catch (err) {
                console.error(err);
                alert('A network error occurred. Please check your connection and try again.');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Calculate My Surety Bond Quote';
            }
        }
    </script>
@endsection
