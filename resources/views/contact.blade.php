@extends('layouts.app')

@section('title', 'Contact Surebound Insurance | Tampa, FL')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS REPLICA)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/tampa_advisor_meeting.jpg') }}" 
                alt="Direct Client Advisory and Insurance Support in Tampa, Florida" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'DIRECT CLIENT ADVISORY &amp; SUPPORT' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Connect with a Licensed Advisor –<br>We\'re Here For You' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Whether you need customized policy guidance, rapid claims assistance, or billing adjustments, our credentialed advisors and underwriters are ready to help.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#contact-inquiry-form" class="btn-primary-hero">
                        <span>Send an Inquiry</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $content['claims_phone'] ?? '+18132141731') }}" class="btn-outline-hero">
                        <span>24/7 Claims: {{ $content['claims_phone'] ?? '+1 813-214-1731' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card positioned over the photo in the container -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">{{ $content['hero_card_sub'] ?? 'Direct Advisor Access' }}</span>
                        <span class="hero-card-label">{{ $content['hero_card_label'] ?? 'Prompt response during business hours' }}</span>
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
         DARK NAVY VALUE PROPOSITION BAR (4 DIRECT CHANNELS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. General Client Care -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_1_title'] ?? '+1 813-214-1731' }}</h3>
                    <p class="value-item-desc">{{ $content['value_1_desc'] ?? 'Client Care Desk • Mon–Fri, 8am–8pm EST • Direct policy support & endorsements.' }}</p>
                </div>

                <!-- 2. 24/7 Rapid Claims Hotline -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_2_title'] ?? '+1 813-214-1731' }}</h3>
                    <p class="value-item-desc">{{ $content['value_2_desc'] ?? '24/7 Emergency Claims • Available 365 days a year with immediate adjuster dispatch.' }}</p>
                </div>

                <!-- 3. Commercial & Underwriting Desk -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_3_title'] ?? '+1 813-214-1731' }}</h3>
                    <p class="value-item-desc">{{ $content['value_3_desc'] ?? 'Commercial Desk • Mon–Fri, 8:30am–6pm EST • Business policies & surety bonding lines.' }}</p>
                </div>

                <!-- 4. Direct Email Portal -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">{{ $content['value_4_title'] ?? 'support@sureboundinsurance.com' }}</h3>
                    <p class="value-item-desc">{{ $content['value_4_desc'] ?? 'Digital Intake • Certified correspondence • Inquiries answered promptly during business hours.' }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         MAIN INTERACTIVE CONTACT & FORM SECTION
         ========================================== -->
    <section class="contact-main-section" id="contact-inquiry-form">
        <div class="container">
            <div class="contact-grid">
                
                <!-- Left Column: Information, Live Status & Channels -->
                <div class="contact-info-panel">
                    <!-- Live Status Badge -->
                    <div class="contact-live-status">
                        <span class="contact-status-dot"></span>
                        <span>{{ $content['live_status_text'] ?? 'Client Support Center: Online & Open Now' }}</span>
                    </div>

                    <p class="section-eyebrow">{!! $content['section_eyebrow'] ?? 'DIRECT COMMUNICATION' !!}</p>
                    <h2 class="section-title">{!! $content['section_title'] ?? 'Talk with a Licensed Insurance Specialist' !!}</h2>
                    <p class="contact-lead-desc">
                        {{ $content['lead_desc'] ?? 'At Surebound, you won\'t encounter robotic phone trees or overseas call centers. You will be connected directly with certified American underwriters and local advisors who take time to understand your unique liabilities, property assets, and family goals.' }}
                    </p>

                    <!-- Contact Channels List -->
                    <div class="contact-channels-grid">
                        <!-- Customer Service -->
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $content['channel_1_value'] ?? '+18132141731') }}" class="contact-channel-card">
                            <div class="contact-channel-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                            </div>
                            <div class="contact-channel-details">
                                <div class="contact-channel-header">
                                    <span class="contact-channel-title">{{ $content['channel_1_title'] ?? 'Policy & Account Service' }}</span>
                                    <span class="contact-channel-badge">{{ $content['channel_1_badge'] ?? 'Mon–Fri, 8am–8pm EST' }}</span>
                                </div>
                                <div class="contact-channel-value">{{ $content['channel_1_value'] ?? '+1 813-214-1731' }}</div>
                                <div class="contact-channel-sub">{{ $content['channel_1_sub'] ?? 'Policy renewals, endorsements, deductible adjustments & billing.' }}</div>
                            </div>
                        </a>

                        <!-- 24/7 Claims Support -->
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $content['channel_2_value'] ?? '+18132141731') }}" class="contact-channel-card">
                            <div class="contact-channel-icon" style="background: #fef2f2; color: #dc2626;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <div class="contact-channel-details">
                                <div class="contact-channel-header">
                                    <span class="contact-channel-title">{{ $content['channel_2_title'] ?? 'Emergency Claims Hotline' }}</span>
                                    <span class="contact-channel-badge urgent">{{ $content['channel_2_badge'] ?? '24/7/365 Rapid Response' }}</span>
                                </div>
                                <div class="contact-channel-value" style="color: #dc2626;">{{ $content['channel_2_value'] ?? '+1 813-214-1731' }}</div>
                                <div class="contact-channel-sub">{{ $content['channel_2_sub'] ?? 'Immediate first-notice-of-loss intake and emergency adjuster dispatch.' }}</div>
                            </div>
                        </a>

                        <!-- Commercial & Underwriting Desk -->
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $content['channel_3_value'] ?? '+18132141731') }}" class="contact-channel-card">
                            <div class="contact-channel-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </div>
                            <div class="contact-channel-details">
                                <div class="contact-channel-header">
                                    <span class="contact-channel-title">{{ $content['channel_3_title'] ?? 'Commercial & Surety Desk' }}</span>
                                    <span class="contact-channel-badge">{{ $content['channel_3_badge'] ?? 'Mon–Fri, 8:30am–6pm EST' }}</span>
                                </div>
                                <div class="contact-channel-value">{{ $content['channel_3_value'] ?? '+1 813-214-1731' }}</div>
                                <div class="contact-channel-sub">{{ $content['channel_3_sub'] ?? 'Commercial Auto, General Liability, BOP & Treasury-listed bonds.' }}</div>
                            </div>
                        </a>

                        <!-- Email Desk -->
                        <a href="mailto:{{ $content['channel_4_value'] ?? 'support@sureboundinsurance.com' }}" class="contact-channel-card">
                            <div class="contact-channel-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div class="contact-channel-details">
                                <div class="contact-channel-header">
                                    <span class="contact-channel-title">{{ $content['channel_4_title'] ?? 'Official Inquiries & Documentation' }}</span>
                                    <span class="contact-channel-badge">{{ $content['channel_4_badge'] ?? 'Same-Day Response' }}</span>
                                </div>
                                <div class="contact-channel-value">{{ $content['channel_4_value'] ?? 'support@sureboundinsurance.com' }}</div>
                                <div class="contact-channel-sub">{{ $content['channel_4_sub'] ?? 'Proof of insurance, escrow requests, loss payee forms & certificates.' }}</div>
                            </div>
                        </a>
                    </div>

                    <!-- Tampa Office Location Box -->
                    <div class="contact-hq-card">
                        <div class="contact-hq-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        <div class="contact-hq-content">
                            <h4>{!! $content['hq_title'] ?? 'Tampa Office' !!}</h4>
                            <p>{!! $content['hq_address'] ?? 'Tampa, Florida' !!}</p>
                            <div class="contact-hq-hours">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="14" height="14">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>{!! $content['hq_hours'] ?? 'Mon–Fri 8:30 AM – 5:30 PM EST' !!}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Secure Online Message & Inquiry Form -->
                <div class="contact-form-card">
                    <div class="contact-form-header">
                        <h3 class="contact-form-title">{!! $content['form_title'] ?? 'Send a Secure Message' !!}</h3>
                        <p class="contact-form-subtitle">
                            {{ $content['form_subtitle'] ?? 'Please provide your inquiry details below. Our routing system will immediately connect your message to the appropriate licensed underwriter or advisor.' }}
                        </p>
                    </div>

                    <form id="sureboundContactForm" onsubmit="handleContactSubmit(event)">
                        @csrf
                        <div class="contact-form-grid">
                            <!-- First Name -->
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="contactFirstName">
                                    <span>First Name</span>
                                    <span class="req">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="contactFirstName" 
                                    name="first_name" 
                                    class="contact-form-input" 
                                    placeholder="Jane" 
                                    required
                                >
                            </div>

                            <!-- Last Name -->
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="contactLastName">
                                    <span>Last Name</span>
                                    <span class="req">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="contactLastName" 
                                    name="last_name" 
                                    class="contact-form-input" 
                                    placeholder="Doe" 
                                    required
                                >
                            </div>

                            <!-- Email Address -->
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="contactEmail">
                                    <span>Email Address</span>
                                    <span class="req">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="contactEmail" 
                                    name="email" 
                                    class="contact-form-input" 
                                    placeholder="jane.doe@example.com" 
                                    required
                                >
                            </div>

                            <!-- Phone Number -->
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="contactPhone">
                                    <span>Phone Number</span>
                                    <span class="req">*</span>
                                </label>
                                <input 
                                    type="tel" 
                                    id="contactPhone" 
                                    name="phone" 
                                    class="contact-form-input" 
                                    placeholder="(555) 000-0000" 
                                    required
                                >
                            </div>

                            <!-- Department / Category -->
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="contactDepartment">
                                    <span>Inquiry Department</span>
                                    <span class="req">*</span>
                                </label>
                                <select id="contactDepartment" name="department" class="contact-form-select" required>
                                    <option value="" disabled selected>Select a department...</option>
                                    <option value="Commercial & Business Lines">Commercial &amp; Business Lines (BOP / GL)</option>
                                    <option value="Commercial Property">Commercial Property Insurance</option>
                                    <option value="Commercial Fleet Auto">Commercial Auto &amp; Fleet</option>
                                    <option value="Workers Compensation">Workers' Compensation</option>
                                    <option value="Life Insurance">Life Insurance</option>
                                    <option value="Surety Bonds & Licensing">Surety Bonds &amp; Licensing</option>
                                    <option value="Group Employee Benefits">Group Employee Benefits</option>
                                    <option value="Specialty & Surplus">Specialty &amp; Surplus Coverage</option>
                                    <option value="Existing Claim Support">Existing Claim Support</option>
                                    <option value="Billing & Escrow Payments">Billing &amp; Escrow Payments</option>
                                    <option value="General Question / Other">General Question / Other</option>
                                </select>
                            </div>

                            <!-- Policy Number (Optional) -->
                            <div class="contact-form-group">
                                <label class="contact-form-label" for="contactPolicyNumber">
                                    <span>Policy # (If Existing Client)</span>
                                    <span style="font-size: 12px; color: var(--color-text-muted); font-weight: normal;">Optional</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="contactPolicyNumber" 
                                    name="policy_number" 
                                    class="contact-form-input" 
                                    placeholder="e.g. SB-POL-984210"
                                >
                            </div>

                            <!-- Preferred Contact Method -->
                            <div class="contact-form-group full-width">
                                <label class="contact-form-label">
                                    <span>Preferred Response Method</span>
                                </label>
                                <div class="contact-method-options">
                                    <div class="contact-method-chip">
                                        <input type="radio" id="prefEmail" name="contact_method" value="email" checked>
                                        <label for="prefEmail">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                            </svg>
                                            Email Response
                                        </label>
                                    </div>
                                    <div class="contact-method-chip">
                                        <input type="radio" id="prefPhone" name="contact_method" value="phone">
                                        <label for="prefPhone">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                            </svg>
                                            Phone Call
                                        </label>
                                    </div>
                                    <div class="contact-method-chip">
                                        <input type="radio" id="prefEither" name="contact_method" value="either">
                                        <label for="prefEither">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                            Either Method
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Message -->
                            <div class="contact-form-group full-width">
                                <label class="contact-form-label" for="contactMessage">
                                    <span>How Can We Help You?</span>
                                    <span class="req">*</span>
                                </label>
                                <textarea 
                                    id="contactMessage" 
                                    name="message" 
                                    class="contact-form-textarea" 
                                    rows="4" 
                                    placeholder="Please share details regarding your policy inquiry, property address, claim circumstances, or questions..." 
                                    required
                                ></textarea>
                            </div>

                            <!-- Consent Checkbox -->
                            <div class="contact-form-group full-width">
                                <label class="contact-consent-label">
                                    <input type="checkbox" id="contactConsentCheck" required>
                                    <span>I agree to receive communications regarding my insurance inquiry from a licensed Surebound representative in accordance with the <a href="{{ route('privacy') }}" target="_blank" style="text-decoration: underline; color: inherit;">Privacy Policy</a>.</span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="contactSubmitButton" class="contact-submit-btn">
                            <span>{{ $content['form_button_text'] ?? 'Send Message to Advisor' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="18" height="18">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </button>

                        <div id="contactFormStatus" style="display: none; margin-top: 15px; padding: 12px 16px; border-radius: 8px; font-size: 14.5px; font-weight: 500;"></div>

                        <!-- Security / Compliance Disclaimer -->
                        <div class="contact-form-security">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                            <span>{!! $content['form_security_badge'] ?? '256-Bit SSL Encrypted &bull; Strictly Confidential Under State &amp; Federal Insurance Privacy Regulations' !!}</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <!-- ==========================================
         HUMAN ADVOCACY GUIDANCE SECTION
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Corporate team meeting photo -->
                <div class="simpler-image-frame">
                    <img 
                        src="{{ asset($content['team_image'] ?? 'images/tampa_team_meeting.jpg') }}" 
                        alt="Surebound Executive Leadership and Senior Underwriters – Tampa, Florida" 
                        class="simpler-image"
                    >
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">{!! $content['guidance_eyebrow'] ?? 'DEDICATED ADVOCACY' !!}</p>
                    <h2 class="simpler-title">{!! $content['guidance_title'] ?? 'Real Human Advisors.<br>Zero Robotic Runarounds.' !!}</h2>
                    <p class="simpler-paragraph">
                        {{ $content['guidance_text'] ?? 'When unexpected emergencies or complex policy decisions arise, you shouldn\'t have to battle automated phone trees. At Surebound, every individual, family, and enterprise account is matched with dedicated licensed underwriters and claims specialists who know your account history by name.' }}
                    </p>
                    <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                        <a href="{{ route('team') }}" class="btn-learn-more">
                            <span>Meet Our Leadership Team</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                        <a href="{{ route('story') }}" class="btn-outline-hero" style="background: transparent;">
                            <span>Our Mission &amp; Values</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         FREQUENTLY ASKED QUESTIONS (FAQ ACCORDION)
         ========================================== -->
    <section class="faq-section" id="faqs">
        <div class="container faq-container">
            <p class="section-eyebrow" style="text-align: center;">{!! $content['faq_eyebrow'] ?? 'COMMON QUESTIONS' !!}</p>
            <h2 class="section-title" style="text-align: center;">{!! $content['faq_title'] ?? 'Client Support &amp; Contact FAQs' !!}</h2>
            <p class="section-subtitle" style="text-align: center;">{{ $content['faq_subtitle'] ?? 'Everything you need to know about reaching your dedicated Surebound team.' }}</p>

            <div class="faq-accordion">
                <!-- Q1 -->
                <div class="faq-item active">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_1_question'] ?? 'How quickly will a licensed advisor respond to my message?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {!! $content['faq_1_answer'] ?? 'Inquiries submitted through our online secure form during standard business hours (Monday through Friday, 8:30 AM – 5:30 PM EST) are reviewed and responded to promptly by a licensed insurance advisor. Messages received outside business hours are answered early the following business morning. For immediate assistance, call us directly at (813) 214-1731.' !!}
                    </div>
                </div>

                <!-- Q2 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_2_question'] ?? 'How do I report an urgent loss or file a claim after hours?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {!! $content['faq_2_answer'] ?? 'Our emergency claims hotline (+1 813-214-1731) is staffed 24 hours a day, 7 days a week, 365 days a year. Whether you experience a vehicular collision, home pipe burst, severe storm roof damage, or commercial property incident, an emergency claims adjuster is always standing by to dispatch emergency mitigation crews and issue immediate living expense or repair authorizations.' !!}
                    </div>
                </div>

                <!-- Q3 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_3_question'] ?? 'Where should mortgage lenders or escrow agents send proof-of-insurance requests?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {!! $content['faq_3_answer'] ?? 'Title companies, mortgage lenders, and escrow officers can send verification requests, mortgagee clause updates, and loss payee change notices directly to <strong>support@sureboundinsurance.com</strong>. Include the insured policyholder\'s full name, property address, and loan number for automated same-day certificate issuance.' !!}
                    </div>
                </div>

                <!-- Q4 -->
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        <span>{{ $content['faq_4_question'] ?? 'Can I update my coverage limits, vehicle details, or payment methods online?' }}</span>
                        <div class="faq-icon">+</div>
                    </button>
                    <div class="faq-answer">
                        {!! $content['faq_4_answer'] ?? 'Yes. Existing Surebound policyholders can log into our secure <a href="' . route('login') . '" style="color: var(--color-primary); font-weight: 600; text-decoration: underline;">User Client Portal</a> to view policies, download auto ID cards, request policy endorsements, add vehicles or drivers, and submit one-time or recurring premium payments.' !!}
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==========================================
         BOTTOM CTA BANNER
         ========================================== -->
    <section class="cta-banner-section">
        <div class="container">
            <div class="cta-text-wrap">
                <h2>{!! $content['cta_title'] ?? 'Looking for an immediate insurance rate?' !!}</h2>
                <p>{{ $content['cta_subtitle'] ?? 'Get a personalized policy quote tailored to your vehicle, property, or business in under 2 minutes.' }}</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal('Custom Tailored Quote')" class="btn-cta-white">
                    <span>{{ $content['cta_button_text'] ?? 'Start Instant Quote' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $content['cta_phone'] ?? '+18132141731') }}" class="btn-cta-transparent">
                    <span>Call {{ $content['cta_phone'] ?? '+1 813-214-1731' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
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

        function handleContactSubmit(event) {
            event.preventDefault();
            const form = document.getElementById('sureboundContactForm');
            const btn = document.getElementById('contactSubmitButton');
            const statusDiv = document.getElementById('contactFormStatus');
            const originalHtml = btn.innerHTML;

            const firstName = document.getElementById('contactFirstName')?.value || '';
            const lastName = document.getElementById('contactLastName')?.value || '';
            const email = document.getElementById('contactEmail')?.value || '';
            const phone = document.getElementById('contactPhone')?.value || '';
            const department = document.getElementById('contactDepartment')?.value || '';
            const policyNumber = document.getElementById('contactPolicyNumber')?.value || '';
            const methodRadio = form.querySelector('input[name="contact_method"]:checked');
            const contactMethod = methodRadio ? methodRadio.value : 'either';
            const message = document.getElementById('contactMessage')?.value || '';

            btn.disabled = true;
            btn.innerHTML = '<span>Sending Message to Advisor...</span>';
            if (statusDiv) {
                statusDiv.style.display = 'none';
            }

            fetch('{{ route("contact.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    first_name: firstName,
                    last_name: lastName,
                    email: email,
                    phone: phone,
                    department: department,
                    policy_number: policyNumber,
                    contact_method: contactMethod,
                    message: message
                })
            })
            .then(async r => {
                const data = await r.json().catch(() => ({}));
                if (!r.ok || !data.success) {
                    const errMsg = data.message || (data.errors ? Object.values(data.errors).flat().join(' ') : 'Unable to send message at this time.');
                    throw new Error(errMsg);
                }
                return data;
            })
            .then(data => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;

                if (window.SureboundModal && typeof SureboundModal.alert === 'function') {
                    SureboundModal.alert({
                        title: 'Inquiry Received',
                        message: 'Thank you for reaching out! Your inquiry #' + (data.inquiry_id || 'Received') + ' has been logged. A licensed advisor from our Tampa office will follow up with you shortly.',
                        type: 'success',
                        icon: 'shield-check',
                        buttonText: 'Done'
                    });
                } else if (statusDiv) {
                    statusDiv.style.display = 'block';
                    statusDiv.style.background = '#e6f4ea';
                    statusDiv.style.color = '#137333';
                    statusDiv.style.border = '1px solid #ceead6';
                    statusDiv.innerHTML = '✓ Inquiry #' + (data.inquiry_id || 'Received') + ' received. An advisor will contact you shortly.';
                } else {
                    alert('Thank you! Your inquiry #' + (data.inquiry_id || '') + ' has been received.');
                }

                // Fire analytics event
                if (typeof gtag === 'function') {
                    gtag('event', 'generate_lead', {
                        event_category: 'Contact',
                        event_label: department,
                        value: data.inquiry_id
                    });
                }

                form.reset();
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;

                if (statusDiv) {
                    statusDiv.style.display = 'block';
                    statusDiv.style.background = '#fce8e6';
                    statusDiv.style.color = '#c5221f';
                    statusDiv.style.border = '1px solid #fad2cf';
                    statusDiv.innerHTML = '⚠️ ' + (err.message || 'Submission failed. Please try again or call us directly at <a href="tel:8132141731" style="color:inherit;font-weight:700;">(813) 214-1731</a>.');
                } else {
                    alert('Submission error: ' + err.message + '\nPlease call us directly at (813) 214-1731.');
                }
            });
        }
    </script>
@endsection
