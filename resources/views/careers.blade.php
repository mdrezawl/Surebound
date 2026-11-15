@extends('layouts.app')

@section('title', 'Careers at Surebound – Join Our Insurance Team | Tampa, FL')
@section('meta_description', 'Explore career opportunities at Surebound Insurance in Tampa, FL. Join our team of licensed commercial and personal insurance professionals.')

@section('content')

    <!-- ==========================================
         HERO SECTION
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/careers_hero.jpg') }}" 
                alt="Careers at Surebound Insurance in Tampa" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'CAREERS AT SUREBOUND' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Build Your Insurance Career<br>with Surebound in Tampa' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'We are building a modern, client-focused independent agency in Tampa, FL. Join a collaborative team that values integrity, professional growth, and client advocacy.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#open-positions" class="btn-primary-hero">
                        <span>View Open Roles &darr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="mailto:careers@sureboundinsurance.com" class="btn-outline-hero">
                        <span>Email Your Resume</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Now Hiring</span>
                        <span class="hero-card-label">Tampa, FL Office</span>
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
         OPEN POSITIONS (3 CARDS)
         ========================================== -->
    <section class="coverage-section" id="open-positions">
        <div class="container">
            <p class="section-eyebrow">CAREER OPPORTUNITIES</p>
            <h2 class="section-title">Open Positions in Tampa, FL</h2>
            <p class="section-subtitle">We are looking for motivated insurance professionals to join our growing agency.</p>

            <div class="coverage-cards-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));">
                <!-- Role 1 -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21" />
                            </svg>
                        </div>
                        <p style="font-size: 12px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; margin-bottom: 6px;">COMMERCIAL LINES &bull; FULL-TIME</p>
                        <h3 class="coverage-card-title">Commercial Lines Account Manager</h3>
                        <p class="coverage-card-desc">Manage renewals, endorsements, certificate of insurance (COI) issuance, and policyholder service for small to mid-sized business clients. Requires active Florida 2-20 or 4-40 license.</p>
                        <div style="margin-top: 14px;">
                            <a href="mailto:careers@sureboundinsurance.com?subject=Application:%20Commercial%20Lines%20Account%20Manager" style="color: #2563eb; font-weight: 600; text-decoration: underline;">Apply for this position &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Role 2 -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <p style="font-size: 12px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; margin-bottom: 6px;">PERSONAL LINES &bull; FULL-TIME</p>
                        <h3 class="coverage-card-title">Personal Lines Account Specialist</h3>
                        <p class="coverage-card-desc">Help Florida homeowners and drivers quote, bind, and optimize their property, flood, auto, and umbrella policies across multiple carrier portals. Florida 2-20 or 4-40 required.</p>
                        <div style="margin-top: 14px;">
                            <a href="mailto:careers@sureboundinsurance.com?subject=Application:%20Personal%20Lines%20Account%20Specialist" style="color: #2563eb; font-weight: 600; text-decoration: underline;">Apply for this position &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Role 3 -->
                <div class="coverage-card" style="cursor: default;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                        </div>
                        <p style="font-size: 12px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; margin-bottom: 6px;">CLIENT SERVICES &bull; FULL-TIME</p>
                        <h3 class="coverage-card-title">Client Care &amp; Support Specialist</h3>
                        <p class="coverage-card-desc">Serve as first point of contact for policy inquiries, billing coordination with mortgage escrow companies, document requests, and claims routing in our Tampa office.</p>
                        <div style="margin-top: 14px;">
                            <a href="mailto:careers@sureboundinsurance.com?subject=Application:%20Client%20Care%20and%20Support%20Specialist" style="color: #2563eb; font-weight: 600; text-decoration: underline;">Apply for this position &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Continuing Education</h3>
                    <p class="value-item-desc">We sponsor CE courses, professional designations (CIC, CISR, CPCU), and advanced licensing.</p>
                </div>

                <!-- 2 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Competitive Benefits</h3>
                    <p class="value-item-desc">Comprehensive group health coverage, retirement matching, and generous paid time off.</p>
                </div>

                <!-- 3 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Prime Downtown Office</h3>
                    <p class="value-item-desc">Work in the heart of downtown Tampa at 100 N Tampa St, Suite 2500.</p>
                </div>

                <!-- 4 -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Client-First Culture</h3>
                    <p class="value-item-desc">A professional environment focused on genuine advisory service rather than high-pressure quotas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         APPLICATION INSTRUCTIONS
         ========================================== -->
    <section class="simpler-section">
        <div class="container">
            <div class="simpler-grid">
                <div class="simpler-image-frame">
                    <picture>
                        <source srcset="{{ asset('images/advisor-meeting.webp') }}" type="image/webp">
                        <img 
                            src="{{ asset('images/advisor-meeting.png') }}" 
                            alt="Surebound insurance team collaborating in Tampa" 
                            class="simpler-image"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <div class="simpler-content">
                    <p class="simpler-eyebrow">HOW TO APPLY</p>
                    <h2 class="simpler-title">Ready to Join Surebound?</h2>
                    <p class="simpler-paragraph">
                        To apply for any open role, send your resume and a brief introduction covering your Florida insurance experience to <strong>careers@sureboundinsurance.com</strong>. Include the position title in the subject line. We look forward to hearing from you.
                    </p>
                    <a href="mailto:careers@sureboundinsurance.com" class="btn-learn-more">
                        <span>Email Your Resume &rarr;</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
