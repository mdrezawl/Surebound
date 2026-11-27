@extends('layouts.app')

@section('title', 'Tampa, FL Insurance Agency | Surebound Insurance')
@section('meta_description', 'Surebound Insurance is an independent insurance agency in Tampa, FL offering commercial liability, property, workers\' comp, commercial auto, and life insurance solutions.')

@section('content')

    <!-- ==========================================
         HERO SECTION (FULL BLEED REPLICA)
         ========================================== -->
    <section class="hero-section">
        <!-- Right side full bleed photo with seamless alpha mask & right royal blue gradient -->
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset('images/hero-family.jpg') }}" 
                alt="Protection Built Around You" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <!-- Left: Headline & Actions -->
            <div class="hero-content">
                <p class="hero-eyebrow">Independent Insurance Agency in Tampa, FL</p>
                <h1 class="hero-title">Insurance help from<br>people here in Tampa.</h1>
                <p class="hero-subtitle">
                    Talk to our team about commercial property, general liability, workers' comp, commercial auto, and life insurance. We will help you understand the available options and request coverage that fits your needs.
                </p>
                <div class="hero-buttons">
                    <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-primary-hero">
                        <span>Request a Quote</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    <a href="tel:8132141731" class="btn-outline-hero">
                        <span>Call (813) 214-1731</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Floating Card positioned over the photo in the container -->
            <div class="hero-card-positioner">
                <div class="hero-floating-card">
                    <div class="hero-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <div class="hero-card-text">
                        <span class="hero-card-sub">Coverage that</span>
                        <span class="hero-card-label">fits your needs</span>
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
         OUR COVERAGE SECTION (6 CARDS)
         ========================================== -->
    <section class="coverage-section" id="coverage">
        <div class="container">
            <p class="section-eyebrow">OUR COVERAGE</p>
            <h2 class="section-title">Coverage for What Matters</h2>
            <p class="section-subtitle">From everyday life to the unexpected, we've got you covered.</p>

            <div class="coverage-cards-grid">
                <!-- 1. Business Owner Policy (BOP) -->
                <div class="coverage-card" onclick="window.location.href='{{ route('business-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.75c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12l1.5 3H1.5L3 3Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Business Owner Policy (BOP)</h3>
                        <p class="coverage-card-desc">Property and liability combined in one seamless package.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 2. General Liability -->
                <div class="coverage-card" onclick="window.location.href='{{ route('liability-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">General Liability</h3>
                        <p class="coverage-card-desc">Bodily injury, property damage, and defense coverage.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 3. Commercial Property -->
                <div class="coverage-card" onclick="window.location.href='{{ route('property-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6h1.5m-1.5 3h1.5m-1.5 3h1.5M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Commercial Property</h3>
                        <p class="coverage-card-desc">Safeguard buildings, inventory, and essential equipment.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 4. Workers' Compensation -->
                <div class="coverage-card" onclick="window.location.href='{{ route('workers-compensation') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Workers' Compensation</h3>
                        <p class="coverage-card-desc">Statutory medical care and wage loss protection for staff.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 5. Commercial Auto -->
                <div class="coverage-card" onclick="window.location.href='{{ route('commercial-auto-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Commercial Auto</h3>
                        <p class="coverage-card-desc">Reliable protection for company trucks, vans, and fleets.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>

                <!-- 6. Life Insurance -->
                <div class="coverage-card" onclick="window.location.href='{{ route('life-insurance') }}'" style="cursor: pointer;">
                    <div>
                        <div class="coverage-icon-box">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <h3 class="coverage-card-title">Life Insurance</h3>
                        <p class="coverage-card-desc">Protect your family and business partners with certainty.</p>
                    </div>
                    <span class="coverage-card-arrow">&rarr;</span>
                </div>
            </div>
            
            <!-- Carousel Dots for Mobile -->
            <div class="coverage-pagination-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    @php
        $partnersContent = $partnersContent ?? \App\Models\PageContent::getForPage('partners', \App\Http\Controllers\AdminController::getDefaultPartnersContent());
        $partnersCount = (int) ($partnersContent['partners_count'] ?? 10);
        $partnersList = [];
        for ($i = 1; $i <= $partnersCount; $i++) {
            if (!empty($partnersContent["partner_{$i}_name"])) {
                $partnersList[$i] = [
                    'name' => $partnersContent["partner_{$i}_name"],
                    'logo' => $partnersContent["partner_{$i}_logo"] ?? '',
                    'active' => $partnersContent["partner_{$i}_active"] ?? '1',
                    'desc' => $partnersContent["partner_{$i}_desc"] ?? '',
                ];
            }
        }
    @endphp

    @if(($partnersContent['section_enabled'] ?? '1') === '1')
    <!-- ==========================================
         MINIMAL INSURANCE PARTNERS STRIP
         ========================================== -->
    <section class="partners-strip-section" id="insurance-partners" aria-label="Insurance Carrier Partners">
        <div class="container">
            <div class="partners-header">
                <h2 class="section-title partners-heading">{{ $partnersContent['section_title'] ?? 'Coverage Backed by Trusted Names' }}</h2>
                <p class="section-subtitle partners-subtitle">{{ $partnersContent['section_subtitle'] ?? 'We work with leading insurance carriers to help you find the right coverage.' }}</p>
            </div>

            <div class="partners-grid">
                @foreach($partnersList as $partner)
                    @if(($partner['active'] ?? '1') === '1')
                    <div class="partner-logo-item" title="{{ $partner['name'] }}">
                        @php
                            $logoSrc = $partner['logo'] ?: 'images/logo.png';
                            if (!str_starts_with($logoSrc, 'http://') && !str_starts_with($logoSrc, 'https://') && !str_starts_with($logoSrc, '/')) {
                                $logoSrc = asset($logoSrc);
                            }
                        @endphp
                        <img src="{{ $logoSrc }}" alt="{{ $partner['name'] }}" class="partner-logo-img" loading="lazy" width="180" height="46">
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- ==========================================
         DARK NAVY VALUE PROPOSITION BAR (4 PILLARS)
         ========================================== -->
    <section class="value-bar-section">
        <div class="container">
            <div class="value-bar-grid">
                <!-- 1. 24/7 Support -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- Headset -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">24/7 Support</h3>
                    <p class="value-item-desc">We're here when you need us, anytime, day or night.</p>
                </div>

                <!-- 2. Expert Guidance -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- People / Team -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Expert Guidance</h3>
                    <p class="value-item-desc">Work with experienced insurance professionals.</p>
                </div>

                <!-- 3. Tailored Coverage -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- Shield Check -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Tailored Coverage</h3>
                    <p class="value-item-desc">Flexible plans for your unique needs.</p>
                </div>

                <!-- 4. Claims Assistance -->
                <div class="value-item">
                    <div class="value-icon-circle">
                        <!-- Document with folded corner -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                    </div>
                    <h3 class="value-item-title">Claims Assistance</h3>
                    <p class="value-item-desc">A simpler process when it matters most.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         INSURANCE MADE SIMPLER / MEET THE FOUNDER
         ========================================== -->
    <section class="simpler-section" id="founder-guidance">
        <div class="container">
            <div class="simpler-grid">
                <!-- Left: Founder portrait photo -->
                <div class="simpler-image-frame simpler-image-frame-founder">
                    <picture>
                        <source srcset="{{ asset('images/karry-founder-v2.webp') }}?v={{ file_exists(public_path('images/karry-founder-v2.webp')) ? filemtime(public_path('images/karry-founder-v2.webp')) : time() }}" type="image/webp">
                        <img 
                            src="{{ asset('images/karry-founder-v2.jpg') }}?v={{ file_exists(public_path('images/karry-founder-v2.jpg')) ? filemtime(public_path('images/karry-founder-v2.jpg')) : time() }}" 
                            alt="Karry, Founder of Surebound Insurance" 
                            class="simpler-image"
                            width="472"
                            height="541"
                            loading="lazy"
                        >
                    </picture>
                </div>

                <!-- Right: Content -->
                <div class="simpler-content">
                    <p class="simpler-eyebrow">OUR GUIDANCE</p>
                    <h2 class="simpler-title">Insurance Made Simpler</h2>
                    <p class="simpler-paragraph">
                        I’m Karry, founder of Surebound Insurance. My background in both personal and commercial insurance helps me work with families and business owners. I’ll walk you through what your policy covers, where you may have gaps, and which options fit your budget.
                    </p>
                    <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-learn-more">
                        <span>Learn More</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         BRAND GUIDELINES 2026: PULL QUOTES & TESTIMONIAL
         ========================================== -->
    @php
        $homeInsuranceContent = $homeInsuranceContent ?? \App\Models\PageContent::getForPage('home-insurance', \App\Http\Controllers\AdminController::getDefaultHomeInsuranceContent());
        $quotesEnabled = ($homeInsuranceContent['quotes_enabled'] ?? '0') === '1';
        $quotesCount = (int) ($homeInsuranceContent['quotes_count'] ?? 0);
        $quotesList = [];

        for ($qi = 1; $qi <= max(0, $quotesCount); $qi++) {
            $quoteText = $homeInsuranceContent["quote_{$qi}_text"] ?? '';
            $quoteActive = $homeInsuranceContent["quote_{$qi}_active"] ?? '0';
            if ($quoteActive === '1' && trim($quoteText) !== '') {
                $quotesList[] = [
                    'text' => $quoteText,
                    'author' => $homeInsuranceContent["quote_{$qi}_author"] ?? '',
                    'role' => $homeInsuranceContent["quote_{$qi}_role"] ?? '',
                    'badge' => $homeInsuranceContent["quote_{$qi}_badge"] ?? 'Verified Client',
                ];
            }
        }
    @endphp

    @if($quotesEnabled && count($quotesList) > 0)
    <section class="pull-quote-section" id="pull-quote-section" style="display: none;">
        <div class="container pull-quote-container">
            @if(count($quotesList) === 1)
                {{-- Single Quote: Fixed and static without slider controls --}}
                @php
                    $singleQuote = $quotesList[0];
                    $initials = 'SB';
                    if (!empty($singleQuote['author'])) {
                        $parts = preg_split('/\s+/', trim($singleQuote['author']));
                        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                    }
                @endphp
                <div class="brand-pull-quote-card">
                    <div class="brand-quote-badge-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                            <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z"/>
                        </svg>
                    </div>
                    <span class="brand-quote-mark sr-only" style="display:none;">&ldquo;</span>
                    <blockquote class="brand-quote-text">
                        {{ $singleQuote['text'] }}
                    </blockquote>
                    <div class="brand-quote-attribution">
                        <div class="brand-quote-author-wrap">
                            <div class="brand-quote-avatar" aria-hidden="true">
                                <span>{{ $initials }}</span>
                            </div>
                            <div class="brand-quote-author-info">
                                <span class="brand-quote-author">{{ $singleQuote['author'] }}</span>
                                @if(!empty($singleQuote['role']))
                                    <span class="brand-quote-role">{{ $singleQuote['role'] }}</span>
                                @endif
                            </div>
                        </div>
                        @if(!empty($singleQuote['badge']))
                            <div class="brand-quote-badge">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="15" height="15">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $singleQuote['badge'] }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                {{-- Multiple Quotes: Sliding Carousel --}}
                <div class="quote-slider-wrapper" id="quoteSliderWrapper">
                    <div class="quote-slider-track" id="quoteSliderTrack">
                        @foreach($quotesList as $index => $q)
                            @php
                                $qInitials = 'SB';
                                if (!empty($q['author'])) {
                                    $parts = preg_split('/\s+/', trim($q['author']));
                                    $qInitials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
                                }
                            @endphp
                            <div class="quote-slide {{ $index === 0 ? 'active' : '' }}" data-quote-slide="{{ $index }}">
                                <div class="brand-pull-quote-card">
                                    <div class="brand-quote-badge-icon" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="22" height="22">
                                            <path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311 1.804.167 3.226 1.648 3.226 3.489a3.5 3.5 0 0 1-3.5 3.5c-1.073 0-2.099-.49-2.748-1.179z"/>
                                        </svg>
                                    </div>
                                    <span class="brand-quote-mark sr-only" style="display:none;">&ldquo;</span>
                                    <blockquote class="brand-quote-text">
                                        {{ $q['text'] }}
                                    </blockquote>
                                    <div class="brand-quote-attribution">
                                        <div class="brand-quote-author-wrap">
                                            <div class="brand-quote-avatar" aria-hidden="true">
                                                <span>{{ $qInitials }}</span>
                                            </div>
                                            <div class="brand-quote-author-info">
                                                <span class="brand-quote-author">{{ $q['author'] }}</span>
                                                @if(!empty($q['role']))
                                                    <span class="brand-quote-role">{{ $q['role'] }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        @if(!empty($q['badge']))
                                            <div class="brand-quote-badge">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" width="15" height="15">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                                </svg>
                                                <span>{{ $q['badge'] }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="quote-slider-controls">
                        <button type="button" class="quote-slider-arrow quote-prev" id="quotePrevBtn" aria-label="Previous Perspective">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </button>

                        <div class="quote-slider-dots" id="quoteSliderDots">
                            @foreach($quotesList as $index => $q)
                                <button type="button" class="quote-slider-dot {{ $index === 0 ? 'active' : '' }}" data-slide-index="{{ $index }}" aria-label="Go to perspective {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                        <button type="button" class="quote-slider-arrow quote-next" id="quoteNextBtn" aria-label="Next Perspective">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="20" height="20">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endif

    <!-- ==========================================
         WHY CHOOSE SUREBOUND SECTION
         ========================================== -->
    <section class="why-section">
        <div class="container">
            <p class="section-eyebrow">WHY CHOOSE SUREBOUND</p>
            <h2 class="section-title">The Right Support. When It Matters.</h2>

            <div class="why-grid">
                <!-- 1. Personalized Solutions -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Personalized Solutions</h3>
                    <p class="why-card-desc">Coverage designed around your unique needs and goals.</p>
                </div>

                <!-- 2. Experienced Guidance -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Experienced Guidance</h3>
                    <p class="why-card-desc">Trusted advice from knowledgeable professionals.</p>
                </div>

                <!-- 3. Responsive Service -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Responsive Service</h3>
                    <p class="why-card-desc">Quick answers and support when you need it most.</p>
                </div>

                <!-- 4. Straightforward Claims Support -->
                <div class="why-card">
                    <div class="why-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <h3 class="why-card-title">Straightforward Claims Support</h3>
                    <p class="why-card-desc">A smooth, hassle-free claims process.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ==========================================
         RESOURCES & INSIGHTS SECTION
         ========================================== -->
    <section class="resources-section" id="articles">
        <div class="container">
            <div class="resources-layout">
                <!-- Left Info Column -->
                <div class="resources-info-col">
                    <p class="resources-eyebrow">NEWS &amp; RESOURCES</p>
                    <h2 class="resources-title">Resources &amp; Insights</h2>
                    <p class="resources-desc">Helpful articles, practical tips and expert advice to keep you informed and prepared.</p>
                </div>

                <!-- Right Articles Area -->
                <div class="resources-content-col">
                    <div class="resources-top-link">
                        <a href="{{ route('articles') }}" class="btn-view-all-articles">
                            <span>View All Articles</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>

                    <div class="articles-grid">
                        <!-- Card 1: Home & Lifestyle -->
                        <div class="article-card">
                            <div class="article-image-box">
                                <img 
                                    src="{{ asset('images/article-house-hires.jpg') }}" 
                                    alt="Beautiful suburban home"
                                >
                            </div>
                            <div class="article-body">
                                <p class="article-tag">HOME &amp; LIFESTYLE</p>
                                <h3 class="article-card-title">Understanding Your Coverage</h3>
                                <p class="article-card-desc">Learn what your policy includes and how it protects you.</p>
                                <div class="article-arrow-wrap">
                                    <span class="article-arrow">&rarr;</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Preparedness -->
                        <div class="article-card">
                            <div class="article-image-box">
                                <img 
                                    src="{{ asset('images/article-rain-hires.jpg') }}" 
                                    alt="Person with umbrella on rainy street"
                                >
                            </div>
                            <div class="article-body">
                                <p class="article-tag">PREPAREDNESS</p>
                                <h3 class="article-card-title">Preparing for the Unexpected</h3>
                                <p class="article-card-desc">Simple steps to help you stay ready for life's surprises.</p>
                                <div class="article-arrow-wrap">
                                    <span class="article-arrow">&rarr;</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Business -->
                        <div class="article-card">
                            <div class="article-image-box">
                                <img 
                                    src="{{ asset('images/article-office-hires.jpg') }}" 
                                    alt="Modern office desk workspace"
                                >
                            </div>
                            <div class="article-body">
                                <p class="article-tag">BUSINESS</p>
                                <h3 class="article-card-title">Insurance Tips for Businesses</h3>
                                <p class="article-card-desc">Practical ways to protect your assets and support long-term growth.</p>
                                <div class="article-arrow-wrap">
                                    <span class="article-arrow">&rarr;</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Carousel Dots for Mobile -->
                    <div class="articles-pagination-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
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
                <h2>Ready to protect what matters?</h2>
                <p>Get a personalized quote and discover the right coverage for you.</p>
            </div>
            <div class="cta-button-group">
                <a href="javascript:void(0)" onclick="openQuoteModal()" class="btn-cta-white">
                    <span>Get a Quote</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $siteContact['primary_phone'] ?? '+1 813-214-1731') }}" class="btn-cta-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="15" height="15">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                    <span>Talk to an Expert: {{ $siteContact['primary_phone'] ?? '+1 813-214-1731' }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Auto Slide Script for Articles (Mobile) -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const articlesGrid = document.querySelector('.articles-grid');
            const dots = document.querySelectorAll('.articles-pagination-dots .dot');
            
            if (articlesGrid && dots.length > 0) {
                let currentIndex = 0;
                const totalCards = dots.length;
                let isUserInteracting = false;
                let autoSlideInterval;
                
                const updateDots = (index) => {
                    dots.forEach(d => d.classList.remove('active'));
                    if (dots[index]) {
                        dots[index].classList.add('active');
                    }
                };

                const slideTo = (index) => {
                    if (!articlesGrid) return;
                    const cardWidth = articlesGrid.offsetWidth;
                    articlesGrid.scrollTo({
                        left: index * cardWidth,
                        behavior: 'smooth'
                    });
                    updateDots(index);
                };

                const startAutoSlide = () => {
                    clearInterval(autoSlideInterval);
                    autoSlideInterval = setInterval(() => {
                        // Only auto-slide on mobile where slider is active
                        if (!isUserInteracting && window.innerWidth <= 768) {
                            currentIndex = (currentIndex + 1) % totalCards;
                            slideTo(currentIndex);
                        }
                    }, 3000); // 3 seconds
                };

                const stopAutoSlide = () => {
                    clearInterval(autoSlideInterval);
                };

                // Sync dots on manual scroll
                articlesGrid.addEventListener('scroll', () => {
                    if (window.innerWidth <= 768) {
                        const scrollLeft = articlesGrid.scrollLeft;
                        const cardWidth = articlesGrid.offsetWidth;
                        const newIndex = Math.round(scrollLeft / cardWidth);
                        if (newIndex !== currentIndex && newIndex < totalCards) {
                            currentIndex = newIndex;
                            updateDots(currentIndex);
                        }
                    }
                }, { passive: true });

                // Pause on interaction
                articlesGrid.addEventListener('touchstart', () => { isUserInteracting = true; stopAutoSlide(); }, {passive: true});
                articlesGrid.addEventListener('touchend', () => { 
                    isUserInteracting = false; 
                    setTimeout(startAutoSlide, 3000); // Wait a bit before restarting
                }, {passive: true});
                
                // Start initially
                startAutoSlide();
            }

            // Coverage Cards Auto-scroll logic
            const coverageGrid = document.querySelector('.coverage-cards-grid');
            const coverageDots = document.querySelectorAll('.coverage-pagination-dots .dot');
            
            if (coverageGrid && coverageDots.length > 0) {
                let covIndex = 0;
                const totalCovCards = coverageDots.length; // 6 cards
                let covAutoSlideInterval;
                let covInteracting = false;

                const updateCovDots = (index) => {
                    coverageDots.forEach((dot, i) => {
                        dot.classList.toggle('active', i === index);
                    });
                };

                const slideCovTo = (index) => {
                    const firstCard = coverageGrid.querySelector('.coverage-card');
                    if(firstCard) {
                        const cardWidth = firstCard.offsetWidth + 16; // width + gap
                        coverageGrid.scrollTo({
                            left: index * cardWidth,
                            behavior: 'smooth'
                        });
                        updateCovDots(index);
                    }
                };

                const startCovAutoSlide = () => {
                    clearInterval(covAutoSlideInterval);
                    covAutoSlideInterval = setInterval(() => {
                        if (!covInteracting && window.innerWidth <= 768) {
                            // On 50% width, max scroll index is totalCards - 2
                            if (covIndex >= totalCovCards - 2) {
                                covIndex = 0;
                            } else {
                                covIndex++;
                            }
                            slideCovTo(covIndex);
                        }
                    }, 3000);
                };

                const stopCovAutoSlide = () => {
                    clearInterval(covAutoSlideInterval);
                };

                coverageGrid.addEventListener('scroll', () => {
                    if (window.innerWidth <= 768) {
                        const firstCard = coverageGrid.querySelector('.coverage-card');
                        if (firstCard) {
                            const scrollLeft = coverageGrid.scrollLeft;
                            const cardWidth = firstCard.offsetWidth + 16;
                            const newIndex = Math.round(scrollLeft / cardWidth);
                            if (newIndex !== covIndex && newIndex < totalCovCards) {
                                covIndex = newIndex;
                                updateCovDots(covIndex);
                            }
                        }
                    }
                }, { passive: true });

                coverageGrid.addEventListener('touchstart', () => { covInteracting = true; stopCovAutoSlide(); }, {passive: true});
                coverageGrid.addEventListener('touchend', () => { 
                    covInteracting = false; 
                    setTimeout(startCovAutoSlide, 3000); 
                }, {passive: true});
                
                startCovAutoSlide();
            }

            // Brand Quote Carousel Slider (Multiple Quotes)
            const quoteSliderWrapper = document.getElementById('quoteSliderWrapper');
            if (quoteSliderWrapper) {
                const slides = quoteSliderWrapper.querySelectorAll('.quote-slide');
                const dots = quoteSliderWrapper.querySelectorAll('.quote-slider-dot');
                const prevBtn = document.getElementById('quotePrevBtn');
                const nextBtn = document.getElementById('quoteNextBtn');
                let currentSlide = 0;
                let autoSlideTimer = null;
                const totalSlides = slides.length;
                const SLIDE_DURATION = 3000; // Exactly 3 seconds auto-scroll interval

                function resetDotProgress() {
                    dots.forEach((dot, i) => {
                        dot.classList.remove('active');
                        if (i === currentSlide) {
                            // Force reflow to replay CSS progress animation from 0%
                            void dot.offsetWidth;
                            dot.classList.add('active');
                        }
                    });
                }

                function showSlide(index, direction) {
                    if (totalSlides <= 1) return;
                    
                    if (index >= totalSlides) index = 0;
                    if (index < 0) index = totalSlides - 1;

                    slides.forEach((slide, i) => {
                        slide.classList.remove('active', 'slide-prev-exit');
                        if (i === currentSlide && i !== index && direction === 'next') {
                            slide.classList.add('slide-prev-exit');
                        }
                    });

                    currentSlide = index;
                    slides[currentSlide].classList.add('active');
                    resetDotProgress();
                }

                function nextSlide() {
                    showSlide(currentSlide + 1, 'next');
                }

                function prevSlide() {
                    showSlide(currentSlide - 1, 'prev');
                }

                function startAutoplay() {
                    stopAutoplay();
                    quoteSliderWrapper.classList.remove('is-paused');
                    autoSlideTimer = setInterval(nextSlide, SLIDE_DURATION);
                }

                function stopAutoplay() {
                    if (autoSlideTimer) {
                        clearInterval(autoSlideTimer);
                        autoSlideTimer = null;
                    }
                    quoteSliderWrapper.classList.add('is-paused');
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', () => {
                        prevSlide();
                        startAutoplay();
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', () => {
                        nextSlide();
                        startAutoplay();
                    });
                }

                dots.forEach(dot => {
                    dot.addEventListener('click', () => {
                        const targetIndex = parseInt(dot.getAttribute('data-slide-index'), 10);
                        if (!isNaN(targetIndex) && targetIndex !== currentSlide) {
                            showSlide(targetIndex, targetIndex > currentSlide ? 'next' : 'prev');
                            startAutoplay();
                        }
                    });
                });

                // Pause autoplay on mouse enter / resume on mouse leave
                quoteSliderWrapper.addEventListener('mouseenter', stopAutoplay);
                quoteSliderWrapper.addEventListener('mouseleave', startAutoplay);

                // Touch swipe support
                let touchStartX = 0;
                let touchEndX = 0;

                quoteSliderWrapper.addEventListener('touchstart', (e) => {
                    touchStartX = e.changedTouches[0].screenX;
                    stopAutoplay();
                }, { passive: true });

                quoteSliderWrapper.addEventListener('touchend', (e) => {
                    touchEndX = e.changedTouches[0].screenX;
                    const diff = touchStartX - touchEndX;
                    if (Math.abs(diff) > 40) {
                        if (diff > 0) {
                            nextSlide();
                        } else {
                            prevSlide();
                        }
                    }
                    startAutoplay();
                }, { passive: true });

                startAutoplay();
            }
        });
    </script>
@endsection
